<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Worker;
use App\Policies\ReportPolicy;
use App\Policies\WorkerPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Worker::class => WorkerPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('report-forming', [ReportPolicy::class, 'form']);
        //
    }
}
