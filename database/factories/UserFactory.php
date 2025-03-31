<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
	/**
	 * The current password being used by the factory.
	 */
	protected static ?string $password;
	
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() : array
	{
		// Membership start date within last 5 years
		$startDate = Carbon::now()->subYears(rand(0, 5));
		
		// Membership end date should be after start date
		$endDate = (clone $startDate)->addYears(rand(1, 5));
		
		$role = fake()->randomElement(['board', 'member']);
		
		return [
			'name' => fake()->name(),
			'email' => fake()->unique()->safeEmail(),
			'email_verified_at' => now(),
			'password' => static::$password ??= Hash::make('password'),
			'phone' => fake()->phoneNumber(),
			'payment_verified' => fake()->boolean(),
			'role' => $role,
			'board_member_role' => $role === 'board' ? fake()->randomElement([
				'president',
				'vice_president',
				'general_secretary',
				'joint_secretary',
				'treasurer',
				'executive_committee',
				'former_president',
				'former_general_secretary',
				'former_vice_president',
			]) : null,
			'remember_token' => Str::random(10),
			'trans_ID' => strtoupper(Str::random(6)),
			'trans_amount' => fake()->randomFloat(2, 0, 1000),
			'membership_type' => fake()->randomElement(['lifetime', 'annual', 'institutional']),
			'membership_start_date' => $startDate->format('F d, Y'),
			'membership_end_date' => $endDate->format('F d, Y'),
			'avatar' => 'avatars/fake.png',
		];
	}
	
	/**
	 * Indicate that the model's email address should be unverified.
	 */
	public function unverified() : static
	{
		return $this->state(fn(array $attributes) => [
			'email_verified_at' => null,
		]);
	}
}
