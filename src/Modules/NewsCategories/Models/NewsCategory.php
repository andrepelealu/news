<?php namespace MissionControl\News\Modules\NewsCategories\Models;

use Eloquent, SoftDeletingTrait;
use Karl456\Presenter\Traits\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use MissionControl\News\Modules\News\Models\News;
use Illuminate\Support\Str;

/**
 * Class NewsCategory
 * @package MissionControl\News\Modules\NewsCategories\Models
 */
class NewsCategory extends Eloquent
{
    use PresentableTrait;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var string
     */
    protected $presenter = 'MissionControl\News\Modules\NewsCategories\Presenters\NewsCategoryPresenter';

    /**
     * @var string
     */
    protected $table = "newscategories";
    /**
     * @var array
     */
    protected $guarded = [
        'id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * @return mixed
     */
    public function articles()
    {
        return $this->belongsToMany(News::class, 'news_to_categories', 'article_id', 'category_id');
    }

    /**
     * @return mixed
     */
    public function publishedarticles()
    {
        return $this->belongsToMany(News::class, 'news_to_categories', 'article_id', 'category_id')
            ->where('news.published', true)
            ->orderBy('published_date', 'desc');
    }

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
