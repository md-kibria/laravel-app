<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\Category;
use App\Models\SiteSetting;
use App\Services\SmartBillService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

use Illuminate\Support\Facades\Config;
use App\View\Components\Schema\Article;
use App\View\Components\Schema\Product;
use App\View\Components\Schema\WebPage;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Schema\Organization;
use App\View\Components\Schema\SchemaWrapper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the SmartBillService
        $this->app->singleton(SmartBillService::class, function ($app) {
            return new SmartBillService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        if (!session()->put('lang')) {
            session()->put('lang', 'ro');
        }

        $categories = Category::all();

        Config::set('categories', $categories);
        
        $siteSettings = SiteSetting::first();
        
        Config::set('logo', asset('/storage/' . $siteSettings->logo));
        Config::set('favicon', asset('/storage/' . $siteSettings->favicon));
        Config::set('site_title', $siteSettings->title);
        Config::set('site_description', $siteSettings->description);
        Config::set('site_email', $siteSettings->email);
        Config::set('site_phone', $siteSettings->phone);
        Config::set('site_address', $siteSettings->city.', '.$siteSettings->country);
        Config::set('site_url', $siteSettings->url);
        
        $msgs = Message::where('is_read', false)->orderBy('created_at', 'desc')->limit(5)->get();
        $msg_count = Message::where('is_read', false)->count();
        Config::set('msg_count', $msg_count);
        Config::set('msgs', $msgs);


        Blade::component('schema.organization', Organization::class);
        Blade::component('schema.web-page', WebPage::class);
        Blade::component('schema.article', Article::class);
        Blade::component('schema.product', Product::class);
        Blade::component('schema.schema-wrapper', SchemaWrapper::class);
    }
}
