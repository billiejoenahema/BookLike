<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\LoginUserComposer;
use Illuminate\Support\Facades\Storage;
use View;

class ViewComposerServiceProvider extends ServiceProvider
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
      View::composer(
        '*', 'App\Http\ViewComposers\LoginUserComposer'
      );

      View::composer('*', function($view) {
        $view->with('storage', Storage::disk('s3'));
      });
    }
}