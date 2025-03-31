<?php

namespace App\Livewire;

use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class UpdateProfileComponent extends Component implements HasForms
{
	use InteractsWithForms;
	
	public ?array $data = [];
	
	public static function getSort() : int
	{
		return 0; // Adjust sorting priority if needed
	}
	
	public function mount(): void
	{
		$this->form->fill(Auth::user()->only([
			'avatar', 'bio', 'orcid_id', 'website_url', 'scholar_url',
		]));
	}
	
	public function form(Form $form): Form
	{
		return $form
			->schema([
				Section::make('Your Profile')
				       ->aside()
				       ->description('Please update your profile here.')
				       ->schema([
					       FileUpload::make('avatar')
					                 ->label('Profile Picture')
					                 ->avatar()
					                 ->imageEditor()
					                 ->circleCropper()
					                 ->directory('avatars')
					                 ->helperText('Upload your profile picture.'),
					       
					       PhoneInput::make('phone')
					                 ->label('Phone')
					                 ->defaultCountry('IN')
					                 ->initialCountry('IN')
					                 ->displayNumberFormat(PhoneInputNumberType::NATIONAL)
					                 ->placeholder('Enter phone of user'),
					       
					       Textarea::make('bio')
					               ->label('Bio')
					               ->placeholder('Please enter your bio here.')
					               ->helperText('Please enter your bio.'),
					       
					       Fieldset::make('Links')
					               ->schema([
						               TextInput::make('orcid_id')
						                        ->label('ORCID ID')
						                        ->placeholder('0000-0000-0000-0000')
						                        ->helperText('Please enter your ORCID ID.'),
						               TextInput::make('website_url')
						                        ->label('Website URL')
						                        ->url()
						                        ->placeholder('https://example.com')
						                        ->helperText('Please enter your website URL.'),
						               TextInput::make('scholar_url')
						                        ->label('Google Scholar URL')
						                        ->placeholder('https://example.com')
						                        ->helperText('Please enter your Google Scholar URL.'),
					               ]),
				       ]),
			])
			->statePath('data');
	}
	
	public function save(): void
	{
		$user = Auth::user();
		$data = $this->form->getState();
		
		//		if (isset($data['avatar'])) {
		//			$data['avatar'] = $data['avatar']; // The file is automatically handled by Filament
		//		}
		
		$user->update($data);
		
		Notification::make()
		            ->title('Your profile information has been saved successfully.')
		            ->success()
		            ->send();
	}
	
	public function render(): View
	{
		return view('livewire.update-profile-component');
	}
}

