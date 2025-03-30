<?php

namespace App\Policies;

use App\Models\Research;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ResearchPolicy
{
	public function viewAny(User $user) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board', 'member']);
	}
	
	public function view(User $user, Research $research) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board', 'member']);
	}
	
	public function create(User $user) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board']);
	}
	
	public function update(User $user, Research $research) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin']);
	}
	
	public function delete(User $user, Research $research) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin']);
	}
	
	public function restore(User $user, Research $research) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board']);
	}
	
	public function forceDelete(User $user, Research $research) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board']);
	}
}
