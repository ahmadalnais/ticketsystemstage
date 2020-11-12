<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use App\User;
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
        'App\User' => 'App\Policies\UserPolicy',
        'App\Project' => 'App\Policies\ProjectPolicy',
        'App\Role' => 'App\Policies\RolePolicy',
        'App\Permission' => 'App\Policies\PermissionsPolicy',
        'App\Ticket' => 'App\Policies\TicketPolicy',
        'App\Reply' => 'App\Policies\ReplyPolicy',
        'App\Company' => 'App\Policies\CompanyPolicy',
        'App\Quotation' => 'App\Policies\QuotationPolicy',
        'App\phase' => 'App\Policies\PhasePolicy',
        'App\Feature' => 'App\Policies\FeaturePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
    }
}
