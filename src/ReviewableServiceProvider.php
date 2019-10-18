<?php


namespace Reviewable;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ReviewableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()){
            $this->registerPublishing();
        }
        $this->registerResources();
        $this->loadViews();
    }

    /**
     * Load and publish views
     */
    public function loadViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'reviewable');
        $this->publishes([
            __DIR__.'/../resources/views/layouts/app.blade.php' => resource_path('views/vendor/ruhusa/layouts/app.blade.php'),
            __DIR__.'/../resources/views/acl/permission.blade.php' => resource_path('views/vendor/ruhusa/acl/permission.blade.php'),
            __DIR__.'/../resources/views/acl/role.blade.php' => resource_path('views/vendor/ruhusa/acl/role.blade.php'),
            __DIR__.'/../resources/views/acl/role-form-body.blade.php' => resource_path('views/vendor/ruhusa/acl/role-form-body.blade.php'),
            __DIR__.'/../resources/views/acl/permission-form-body.blade.php' => resource_path('views/vendor/ruhusa/acl/permission-form-body.blade.php'),
            __DIR__.'/../resources/views/acl/partials/_role-form.blade.php' => resource_path('views/vendor/ruhusa/acl/partials/_role-form.blade.php'),
            __DIR__.'/../resources/views/acl/partials/_permission-form.blade.php' => resource_path('views/vendor/ruhusa/acl/partials/_permission-form.blade.php'),
        ],'reviewable-views');
    }

    /**
     * Register
     */
    public function register()
    {
        $this->registerServiceProvider();
    }

    /**
     * Register resources
     */
    private function registerResources()
    {
        $this->registerRoutes();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Package route
     */
    public function registerRoutes()
    {
        Route::group($this->routeConfig(), function (){
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    /**
     * Package route config
     *
     * @return array
     */
    protected function routeConfig()
    {
        return [
            'prefix' => config('reviewable.route-prefix'),
            'middleware' => config('reviewable.route-middleware')
        ];
    }

    /**
     * Publish resources
     */
    private function registerPublishing()
    {
        //this is to allow you to modify the tables according to your project need
        $this->publishes([
            __DIR__.'/../database/migrations/2018_10_12_000000_create_permissions_table.php' =>
                'database/migrations/2018_10_12_000000_create_permissions_table.php',
            __DIR__.'/../database/migrations/2018_10_12_000000_create_roles_table.php' =>
                'database/migrations/2018_10_12_000000_create_roles_table.php',
            __DIR__.'/../database/migrations/2018_11_24_105604_create_users_permissions_table.php' =>
                'database/migrations/2018_11_24_105604_create_users_permissions_table.php',
            __DIR__.'/../database/migrations/2018_11_24_105604_create_users_roles_table.php' =>
                'database/migrations/2018_11_24_105604_create_users_roles_table.php',
            __DIR__.'/../database/migrations/2018_11_24_110643_create_roles_permissions_table.php' =>
                'database/migrations/2018_11_24_110643_create_roles_permissions_table.php',
            __DIR__ . '/../config/ruhusa.php' => 'config/ruhusa.php'

        ], 'reviewable');
    }

    /**
     * Register event service provider
     */
    protected function registerServiceProvider()
    {
        $this->app->register(EventServiceProvider::class);
    }
}
