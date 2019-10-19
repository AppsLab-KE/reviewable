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
            __DIR__.'/../resources/public/css/app.css' => public_path('vendor/reviewable/css/app.css'),
            __DIR__.'/../resources/public/js/app.js' => public_path('vendor/reviewable/js/app.js'),
            __DIR__.'/../resources/views/layouts/app.blade.php' => resource_path('views/vendor/reviewable/layouts/app.blade.php'),
            __DIR__.'/../resources/views/reviewable/permission.blade.php' => resource_path('views/vendor/reviewable/reviewable/permission.blade.php'),
            __DIR__.'/../resources/views/reviewable/role.blade.php' => resource_path('views/vendor/reviewable/reviews/review.blade.php'),
            __DIR__.'/../resources/views/reviewable/role-form-body.blade.php' => resource_path('views/vendor/reviewable/reviewable/role-form-body.blade.php'),
            __DIR__.'/../resources/views/reviewable/permission-form-body.blade.php' => resource_path('views/vendor/reviewable/reviewable/permission-form-body.blade.php'),
            __DIR__.'/../resources/views/reviewable/partials/_role-form.blade.php' => resource_path('views/vendor/reviewable/reviewable/partials/_role-form.blade.php'),
            __DIR__.'/../resources/views/reviewable/partials/_permission-form.blade.php' => resource_path('views/vendor/reviewable/reviewable/partials/_permission-form.blade.php'),
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
            __DIR__ . '/../config/reviewable.php' => 'config/reviewable.php',
            __DIR__.'/../database/migrations/2018_10_12_000000_create_monitors_table.php' =>
                'database/migrations/2018_10_12_000000_create_monitors_table.php',
            __DIR__.'/../database/migrations/2018_10_12_000000_create_occurrences_table.php' =>
                'database/migrations/2018_10_12_000000_create_occurrences_table.php',
            __DIR__.'/../database/migrations/2018_10_12_000000_create_reviews_table.php' =>
                'database/migrations/2018_10_12_000000_create_reviews_table.php',
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
