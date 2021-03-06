<?php

namespace  jaycct\advantageacl;

use Illuminate\Support\ServiceProvider;

use jaycct\advantageacl\View\Components\AdvantageaclListModule;
use jaycct\advantageacl\View\Components\AdvantageaclAddModule;
use jaycct\advantageacl\View\Components\AdvantageaclEditModule;

use jaycct\advantageacl\View\Components\AdvantageaclListRole;
use jaycct\advantageacl\View\Components\AdvantageaclAddRole;
use jaycct\advantageacl\View\Components\AdvantageaclEditRole;

class AdvantageAclServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/./../publishable/database/migrations');
        $this->loadViewsFrom(__DIR__.'/./../resources/views','advantageacl');
        
		
		$this->publishes([
            __DIR__.'/./../resources/views' => resource_path('views/advantageacl/'),
        ],'views');
		
		$this->publishes([
            __DIR__.'/./../resources/lang' => resource_path('lang'),
        ],'lang');

        $this->app['router']->namespace('jaycct\advantageacl\Http\Controllers')
            ->middleware(['web'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/Routes/advantageacl.php');
            });

        $this->publishes([__DIR__.'/./../public' => public_path(''),
        ], 'asset');

        $this->publishes([__DIR__.'/./../publishable/database/migrations' => database_path('migrations'),
        ], 'migration');

        $this->publishes([__DIR__.'/./../config/' => 'config/',
        ], 'config');


        $this->publishes([__DIR__.'/Routes/advantageacl.php' => 'routes/advantageacl.php',
        ], 'route');

        $this->publishes([__DIR__.'/Http/Controllers' => 'app/http/controllers/',
        ], 'controller');

        $this->publishes([__DIR__.'/Http/Middleware' => 'app/http/Middleware/',
        ], 'middleware');

        $this->publishes([__DIR__.'/Http/Requests' => 'app/http/Requests/',
        ], 'requests');

        $this->publishes([__DIR__.'/Models' => 'app/Models/',
        ], 'Models');

        $this->publishes([__DIR__.'/Repositories' => 'app/Repositories/',
        ], 'repositories');

        $this->publishes([__DIR__.'/Traits' => 'app/Traits/',
        ], 'traits');

        $this->loadViewComponentsAs('courier', [
            AdvantageaclListModule::class,
            AdvantageaclAddModule::class,
            AdvantageaclEditModule::class,
            AdvantageaclListRole::class,
            AdvantageaclAddRole::class,
            AdvantageaclEditRole::class
        ]);
    }
}
