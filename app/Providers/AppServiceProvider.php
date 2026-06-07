<?php

namespace App\Providers;
use Illuminate\Support\Facades\DB;
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
        // Jalankan hanya di environment lokal/development
        if ($this->app->environment('local')) {
            DB::listen(function ($query) {
                // Menggabungkan query SQL dengan data bindings-nya agar terlihat murni
                $sql = $query->sql;
                foreach ($query->bindings as $binding) {
                    if (is_string($binding)) {
                        $binding = "'{$binding}'";
                    } elseif ($binding === null) {
                        $binding = 'NULL';
                    }
                    $sql = preg_replace('/\?/', $binding, $sql, 1);
                }

                //error_log otomatis melempar pesan langsung ke stdout terminal php artisan serve
                error_log("[SQL LOG] {$sql} ({$query->time}ms)");
            });
        }
    }
}
