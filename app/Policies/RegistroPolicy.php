<?php

namespace App\Policies;

use App\Models\RegistroHora;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistroPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
         if ($user->hasRole('Supervisor')) {
             return true;
         }
    }


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RegistroHora  $registroHora
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RegistroHora $registroHora)
    {
      //  dd($user->id); // === $registroHora->user_id);
        dd($registroHora->tarea);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RegistroHora  $registroHora
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RegistroHora $registroHora)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RegistroHora  $registroHora
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RegistroHora $registroHora)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RegistroHora  $registroHora
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RegistroHora $registroHora)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RegistroHora  $registroHora
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RegistroHora $registroHora)
    {
        //
    }
}
