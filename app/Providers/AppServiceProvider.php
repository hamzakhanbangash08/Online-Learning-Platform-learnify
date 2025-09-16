<?php
namespace App\Providers;

use App\Http\Middleware\CheckRole;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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

       
    Paginator::useBootstrapFive();

        //
        // apply dynamic mail from
        $fromEmail = setting('from_email', config('mail.from.address'));
        $fromName  = setting('from_name', config('mail.from.name'));
        if ($fromEmail) {
            config(['mail.from.address' => $fromEmail]);
            config(['mail.from.name' => $fromName]);
        }

        // share site_name across views
        view()->share('site_name', setting('site_name', config('app.name')));

        //
        // profile image show akrta ho
        // Har view ke sath current user ka data share hoga
        View::composer('*', function ($view) {
            $view->with('authUser', Auth::user());
        });

        // 
        // 🔹 Register custom middleware for Laravel 11
        $router = $this->app['router'];
        $router->aliasMiddleware('checkrole', CheckRole::class);
    }
}
