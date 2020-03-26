<?php

namespace App\Providers;

use App\Http\Repositories\PostRepository;
use App\Http\Repositories\PostRepositoryInterface;
use App\Http\Services\PostService;
use App\Http\Services\PostServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(PostServiceInterface::class, PostService::class);
       $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
