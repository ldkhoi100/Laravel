<?php

namespace App\Policies;

use App\Posts;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the posts.
     *
     * @param  \App\User  $user
     * @param  \App\Posts  $posts
     * @return mixed
     */
    public function view(User $user, Posts $posts)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the posts.
     *
     * @param  \App\User  $user
     * @param  \App\Posts  $posts
     * @return mixed
     */
    public function update(User $user, Posts $posts)
    {
        //
        return $user->id === 2;
    }

    /**
     * Determine whether the user can delete the posts.
     *
     * @param  \App\User  $user
     * @param  \App\Posts  $posts
     * @return mixed
     */
    public function delete(User $user, Posts $posts)
    {
        //
    }

    /**
     * Determine whether the user can restore the posts.
     *
     * @param  \App\User  $user
     * @param  \App\Posts  $posts
     * @return mixed
     */
    public function restore(User $user, Posts $posts)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the posts.
     *
     * @param  \App\User  $user
     * @param  \App\Posts  $posts
     * @return mixed
     */
    public function forceDelete(User $user, Posts $posts)
    {
        //
    }

    // Superadmin
    public function before(User $user)
    {
        // if ($user->id === 2) {
        //     return true;
        // }
    }
}