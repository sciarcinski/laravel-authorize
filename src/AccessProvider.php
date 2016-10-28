<?php

namespace Sciarcinski\LaravelAuthorize;

use Blade;
use Illuminate\Support\ServiceProvider;

class AccessProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBlade();
        
        $this->publishes([
            __DIR__.'/../config/access.php' => config_path('access.php'),
        ]);
    }
    
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/access.php', 'access');
        
        $this->app->singleton('access', function ($app) {
            return new Access($app);
        });
    }
    
    /**
     * Register blade
     */
    protected function registerBlade()
    {
        Blade::directive('role', function ($arguments) {
            return "<?php if (Access::hasRole{$arguments}): ?>";
        });
        
        Blade::directive('permission', function ($arguments) {
            return "<?php if (Access::hasPermission{$arguments}): ?>";
        });
        
        Blade::directive('endauth', function () {
            return '<?php endif; ?>';
        });
    }
    
    /**
     *  Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['access'];
    }
}
