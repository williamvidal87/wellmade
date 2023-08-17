<?php

namespace App\Providers;

use App\Contract\IncentiveInterface;
use App\Contract\StockManagementInterface;
use App\Contract\TransactionInterface;
use App\Service\IncentiveService;
use App\Service\StockManagementService;
use App\Service\TransactionService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StockManagementInterface::class, StockManagementService::class);
        $this->app->bind(TransactionInterface::class, TransactionService::class);
        $this->app->bind(IncentiveInterface::class, IncentiveService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Schema::defaultStringLength(191);//To solve wamp sepecified key error
         Schema::defaultStringLength(125); //To solve spatie sepecified key error
        date_default_timezone_set('Asia/Manila');
    }
}
