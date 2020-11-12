<?php

namespace App\Policies;

use App\Phase;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any phases.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can view the phase.
     *
     * @param  \App\User  $user
     * @param  \App\Phase  $phase
     * @return mixed
     */
    public function view(User $user, Phase $phase)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can create phases.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can update the phase.
     *
     * @param  \App\User  $user
     * @param  \App\Phase  $phase
     * @return mixed
     */
    public function update(User $user, Phase $phase)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can delete the phase.
     *
     * @param  \App\User  $user
     * @param  \App\Phase  $phase
     * @return mixed
     */
    public function delete(User $user, Phase $phase)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can restore the phase.
     *
     * @param  \App\User  $user
     * @param  \App\Phase  $phase
     * @return mixed
     */
    public function restore(User $user, Phase $phase)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can permanently delete the phase.
     *
     * @param  \App\User  $user
     * @param  \App\Phase  $phase
     * @return mixed
     */
    public function forceDelete(User $user, Phase $phase)
    {
        return $user->hasRole('Admin');
    }
}
