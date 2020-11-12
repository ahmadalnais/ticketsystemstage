<?php

namespace App\Providers;

use App\Observers\BevestigEmailObserver;
use App\Observers\CustomerObserver;
use App\Observers\QuotationObserve;
use App\Observers\ReplyObserver;
use App\Observers\TicketObserver;
use App\Observers\UserObserver;
use App\Quotation;
use App\Reply;
use App\Ticket;
use App\User;
use IDF\WorldClockCard\WorldClock;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::serving(function () {
            Ticket::observe(TicketObserver::class);
            Ticket::observe(CustomerObserver::class);
            Reply::observe(ReplyObserver::class);
            User::observe(UserObserver::class);
            User::observe(BevestigEmailObserver::class);
            Quotation::observe(QuotationObserve::class);
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        // Gate::define('viewNova', function ($user) {
        //     return in_array($user->email, [
        //         //
        //     ]);
        // });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            // new Help,
        (new WorldClock())
        ->timezones([
            'Europe/Amsterdam',
            'Asia/Dubai',
            'America/Los_Angeles',
            'Europe/Berlin',
            'Europe/London',
        ])
        ->timeFormat('h:i') // Optional, time format. Default is: 'h:i:s'
        ->updatePeriod(1000) // Optional, to set updating time period in millisecond. Default is 1000 ms (1sec)
        ->nightRange(22, 6) // Optional, to set range of night hours. Default is [19; 6).
        ->hideContinents() // Optional, hide continents from timezone-names.
        ->timezoneDescriptions([ // Optional, add text description to timezones.
            'Europe/Amsterdam' => 'Groningen', 
        ])
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            //new NovaSms,
            \Vyuldashev\NovaPermission\NovaPermissionTool::make()->canSee(function ($request) {
                    return $request->user()->can('view-permission', $this);
                }),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
