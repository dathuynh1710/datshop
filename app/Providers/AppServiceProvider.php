<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Auth\CustomUserProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\AclUser;
use App\Models\AclPermission;
use Illuminate\Pagination\Paginator;

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
        Paginator::defaultView('vendor.pagination.bootstrap-5');
        Paginator::defaultSimpleView('vendor.pagination.simple-bootstrap-5');
        // Sử dụng CustomUserProvider để xác thực tài khoản
        $this->app->auth->provider('custom', function ($app, array $config) {
            return new CustomUserProvider($app['hash'], $config['model']);
        });

        $allPermissions = AclPermission::all();
        // dd($allPermissions);
        foreach ($allPermissions as $permission) {
            Gate::define($permission->name, function (AclUser $user) use ($permission) {
                return shopHasPermission($user, $permission->name);
            });
        }
    }
}
