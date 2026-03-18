<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
      view()->composer([
        'components.forms.*',
        'components.language',
      ],
        'App\Http\ViewComposers\Language'
      );
      
      view()->composer([
        'components.forms.movie-admin-form',
      ],
        'App\Http\ViewComposers\CategoryMovie'
      );
    }
}