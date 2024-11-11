<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        View::composer(['*'], function ($view) {
            if (Auth::check()) {
                // Carregar notificações
                $notificacoes = Auth::user()->notificacoes()->orderBy('created_at', 'desc')->get();
                $naoLidasCount = $notificacoes->where('lido', false)->count();
    
                // Passar as variáveis para a view
                $view->with('notificacoes', $notificacoes);
                $view->with('naoLidasCount', $naoLidasCount);
            }
        });
    }
}
