<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Traits\AddonHelper;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use App\CentralLogics\Helpers;

class AppServiceProvider extends ServiceProvider
{
    use AddonHelper;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $dbHost = config('database.connections.mysql.host');
        error_log('🔍 DEBUG: APP_BOOT: DB_HOST=' . $dbHost);
        error_log('🔍 DEBUG: APP_BOOT: DB_PORT=' . config('database.connections.mysql.port'));
        error_log('🔍 DEBUG: APP_BOOT: DB_DATABASE=' . config('database.connections.mysql.database'));

        if (empty($dbHost)) {
            $error = "\n\n🚨 CRITICAL ERROR: YOUR RAILWAY VARIABLES ARE MISSING! 🚨\n" .
                "The 'DB_HOST' variable is empty.\n" .
                "Please go to Railway > Variables and set 'DB_HOST'.\n\n";
            fwrite(STDERR, $error);
            die($error);
        }

        try {
            Config::set('addon_admin_routes', $this->get_addon_admin_routes());
            Config::set('get_payment_publish_status', $this->get_payment_publish_status());
            Paginator::useBootstrap();
            foreach (Helpers::get_view_keys() as $key => $value) {
                view()->share($key, $value);
            }
        } catch (\Exception $e) {

        }

    }
}
