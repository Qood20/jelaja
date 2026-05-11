<?php

namespace App\Providers;

use App\Models\Destination;
use App\Policies\DestinationPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }

    /**
     * Register policies for models.
     */
    protected function registerPolicies(): void
    {
        \Illuminate\Support\Facades\Gate::policy(Destination::class, DestinationPolicy::class);
    }
}
