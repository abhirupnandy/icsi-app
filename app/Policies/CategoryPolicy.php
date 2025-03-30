<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
	public function viewAny(User $user) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board', 'member']);
	}
	
	public function view(User $user, Category $category) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board', 'member']);
	}
	
	public function create(User $user) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board']);
	}
	
	public function update(User $user, Category $category) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board']);
	}
	
	public function delete(User $user, Category $category) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board']);
	}
	
	public function restore(User $user, Category $category) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board']);
	}
	
	public function forceDelete(User $user, Category $category) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board']);
	}
}