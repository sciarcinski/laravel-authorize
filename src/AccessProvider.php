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
    }
    
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
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
            return "<?php if (role{$arguments}): ?>";
        });
        
        Blade::directive('roles', function ($arguments) {
            return "<?php if (roles{$arguments}): ?>";
        });
        
        Blade::directive('permission', function ($arguments) {
            return "<?php if (permission{$arguments}): ?>";
        });
        
        Blade::directive('permissions', function ($arguments) {
            return "<?php if (permissions{$arguments}): ?>";
        });
        
        Blade::directive('endauth', function () {
            return '<?php endif; ?>';
        });
    }
}
