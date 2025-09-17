<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Store;
use App\Models\Category;

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
        // Share trending stores and top categories data with all frontend views
        View::composer('frontend.*', function ($view) {
            $trendingStores = Store::where('show_trending', 1)
                ->where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->take(20)
                ->get();
            
            $topCategories = Category::where('show_top', 1)
                ->where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->take(10)
                ->get();
            
            $view->with([
                'trendingStores' => $trendingStores,
                'topCategories' => $topCategories
            ]);
        });
    }
}
