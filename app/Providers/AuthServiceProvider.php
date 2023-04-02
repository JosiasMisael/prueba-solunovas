<?php

namespace App\Providers;

use App\Models\RegistroHora;
use App\Policies\RegistroPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        RegistroHora::class => RegistroPolicy::class,

       //  'App\RegistroHora' => 'App\Policies\RegistroPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
