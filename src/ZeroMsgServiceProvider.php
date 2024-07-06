<?php

namespace Megoxv\ZeroMsg;

use Illuminate\Support\ServiceProvider;
use Megoxv\ZeroMsg\Services\ZeroMsgClient;

class ZeroMsgServiceProvider extends ServiceProvider
{
   public function register(): void
   {
      //Register Config file
      $this->mergeConfigFrom(__DIR__ . '/../config/zeromsg.php', 'zeromsg');

      //Publish Config
      $this->publishes([
         __DIR__ . '/../config/zeromsg.php' => config_path('zeromsg.php'),
      ], 'zeromsg-config');
   }

   public function boot(): void
   {
      $this->mergeConfigFrom(__DIR__ . '/../config/zeromsg.php', 'zeromsg');

      $this->app->singleton('zeromsg', function ($app) {
         return new ZeroMsgClient();
      });
   }
}
