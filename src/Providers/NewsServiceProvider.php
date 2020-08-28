<?php namespace MissionControl\News\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class NewsServiceProvider
 * @package MissionControl\News\Providers
 */
class NewsServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Modules/News/Config/news.php' => config_path('news.php'),
            __DIR__ . '/../Modules/NewsCategories/Config/newscategories.php' => config_path('newscategories.php'),
        ], 'config');
    }

    /**
     *
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../Modules/News/Config/news.php', 'news');
        $this->mergeConfigFrom(__DIR__ . '/../Modules/NewsCategories/Config/newscategories.php', 'newscategories');
    }

}
