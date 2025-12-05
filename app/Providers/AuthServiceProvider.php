<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Letter;
use App\Models\Report;
use App\Policies\LetterPolicy;
use App\Policies\ReportPolicy;
use App\Models\Resident;
use App\Policies\ResidentPolicy;
use App\Models\RT;
use App\Policies\RTPolicy;
use App\Models\RW;
use App\Policies\RWPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Letter::class => LetterPolicy::class,
        Report::class => ReportPolicy::class,
        Resident::class => ResidentPolicy::class,
        RT::class => RTPolicy::class,
        RW::class => RWPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Additional gates could be defined here if needed
    }
}
