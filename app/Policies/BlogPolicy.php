<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{
	public function viewAny(User $user) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board', 'member']);
	}
	
	public function view(User $user, Blog $blog) : bool
	{
		return $user->payment_verified && (in_array($user->role, ['admin', 'board', 'member']));
	}
	
	public function create(User $user) : bool
	{
		return $user->payment_verified && in_array($user->role, ['admin', 'board']);
	}
	
	public function update(User $user, Blog $blog) : bool
	{
		return $user->payment_verified && (in_array($user->role,
					['admin', 'board']) || $user->id === $blog->user_id);
	}
	
	public function delete(User $user, Blog $blog) : bool
	{
		return $user->payment_verified && (in_array($user->role,
					['admin', 'board']) || $user->id === $blog->user_id);
	}
}