<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Equip;
use App\Models\EquipCheck;
use App\Models\Income;
use App\Models\IncomeSource;
use App\Models\Material;
use App\Models\MaterialCat;
use App\Models\MaterialType;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\Receipt;
use App\Models\Request as ModelReq;
use App\Models\Role;
use App\Models\User;
use App\Models\Worker;
use App\Policies\EquipCheckPolicy;
use App\Policies\EquipPolicy;
use App\Policies\IncomePolicy;
use App\Policies\MaterialPolicy;
use App\Policies\OrderPolicy;
use App\Policies\PurchasePolicy;
use App\Policies\ReceiptPolicy;
use App\Policies\ReportPolicy;
use App\Policies\RequestPolicy;
use App\Policies\RolesPolicy;
use App\Policies\UserPolicy;
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
        EquipCheck::class => EquipCheckPolicy::class,
        Equip::class => EquipPolicy::class,
        Material::class => MaterialPolicy::class,
        MaterialCat::class => MaterialPolicy::class,
        MaterialType::class => MaterialPolicy::class,
        Order::class => OrderPolicy::class,
        Purchase::class => PurchasePolicy::class,
        Receipt::class => ReceiptPolicy::class,
        ModelReq::class => RequestPolicy::class,
        Role::class => RolesPolicy::class,
        User::class => UserPolicy::class,
        Worker::class => WorkerPolicy::class,
        IncomeSource::class => IncomePolicy::class,
        Income::class => IncomePolicy::class,
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
