<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\PaymentVerified;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Yebor974\Filament\RenewPassword\Contracts\RenewPasswordContract;
use Yebor974\Filament\RenewPassword\Traits\RenewPassword;

class User extends Authenticatable implements RenewPasswordContract, HasAvatar
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
	use RenewPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
	    'phone',
	    'payment_verified',
	    'role',
	    'board_member_role',
	    'bio',
	    'orcid_id',
	    'scholar_url',
	    'website_url',
	    'force_renew_password',
	    'trans_ID',
	    'trans_amount',
	    'trans_date',
	    'membership_type',
	    'membership_start_date',
	    'membership_end_date',
	    'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
	
	public function blogs()
	{
		return $this->hasMany(Blog::class);
	}
	
	public function sendPaymentVerificationEmail($status, $trans_ID, $trans_amount, $trans_date)
	{
		if ($status) {
			// Ensure transaction amount is valid
			$trans_amount = is_numeric($trans_amount) ? (float) $trans_amount : 0.00;
			
			// Convert transaction date to timestamp
			$trans_date_obj = Carbon::parse($trans_date);
			$formatted_trans_date = $trans_date_obj->format('d-F-Y'); // DD-MMMM-YYYY format
			
			// Update user details
			$this->update([
				'payment_verified' => true,
				'trans_ID' => $trans_ID,
				'trans_amount' => $trans_amount,
				'trans_date' => $trans_date_obj->timestamp, // Store as timestamp
			]);
			
			$this->refresh(); // Ensure latest values are used
			
			// Send email notification
			try {
				$this->notify(new PaymentVerified($this, $trans_ID, $trans_amount,
					$formatted_trans_date));
				\Log::info("✅ Payment verification email sent to {$this->email} (Transaction ID: $trans_ID)");
			} catch (\Exception $e) {
				\Log::error("❌ Email sending failed for {$this->email}: ".$e->getMessage());
			}
			
			// Send admin notification
			Notification::make()
			            ->title('✅ Payment Verified')
			            ->success()
			            ->body("Payment has been successfully verified.<br>
                    <strong>User:</strong> {$this->name} <br>
                    <strong>Email:</strong> {$this->email} <br>
                    <strong>Transaction ID:</strong> {$this->trans_ID} <br>
                    <strong>Amount:</strong> ₹".number_format($this->trans_amount, 2)." <br>
                    <strong>Date:</strong> {$formatted_trans_date}")
			            ->send();
		} else {
			// If payment verification is revoked
			$this->update([
				'payment_verified' => false,
				'trans_ID' => null,
				'trans_amount' => null,
				'trans_date' => null,
			]);
			
			$this->refresh();
			
			Notification::make()
			            ->title('❌ Payment Revoked')
			            ->danger()
			            ->body("Payment verification has been revoked.<br>
                    <strong>User:</strong> {$this->name} <br>
                    <strong>Email:</strong> {$this->email}")
			            ->send();
		}
	}
	
	
	public function getFilamentAvatarUrl() : ?string
	{
		// TODO: Implement getFilamentAvatarUrl() method.
		return $this->avatar
			? Storage::url($this->avatar)
			: null;
	}
}
