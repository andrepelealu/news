<?php namespace MissionControl\News\Modules\News\Models;

use Carbon\Carbon;
use Eloquent, SoftDeletingTrait;
use Eyeweb\MissionControl\Modules\Admins\Models\Admin;
use Karl456\Presenter\Traits\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use MissionControl\News\Modules\NewsCategories\Models\NewsCategory;

/**
 * Class News
 * @package MissionControl\News\Modules\News\Models
 */
class News extends Eloquent
{
    use PresentableTrait;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'published_date'
    ];

    /**
     * @var string
     */
    protected $presenter = 'MissionControl\News\Modules\News\Presenters\NewsPresenter';

    /**
     * @var string
     */
    protected $table = "news";

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
    public function categories()
    {
        return $this->belongsToMany(NewsCategory::class, 'news_to_categories', 'article_id', 'category_id');
    }

    /**
     * @return mixed
     */
    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id', 'id');
    }

    /**
     * @param $value
     */
    public function setPublishedDateAttribute($value)
    {
        $this->attributes['published_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}
