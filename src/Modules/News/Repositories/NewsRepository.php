<?php namespace MissionControl\News\Modules\News\Repositories;

use Carbon\Carbon;
use Eyeweb\MissionControl\EloquentRepository;
use Illuminate\Support\Facades\DB;
use MissionControl\News\Modules\News\Models\News;

/**
 * Class NewsRepository
 * @package MissionControl\News\Modules\News\Repositories
 */
class NewsRepository extends EloquentRepository implements NewsInterface
{
    /**
     * @var News
     */
    private $model;

    /**
     * NewsRepository constructor.
     * @param News $model
     */
    function __construct(News $model)
    {
        parent::__construct($model);

        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getArchive()
    {
        return $this->model->select(DB::raw('published_date, YEAR(published_date) as year, MONTH(published_date) as month, MONTHNAME(published_date) as month_name, COUNT(*) as post_count'))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()
            ->groupBy('year');
    }

    /**
     * @param $year
     * @param $month
     * @param bool $published
     * @param bool $paginate
     * @param string $sort_by
     * @param string $sort_direction
     * @return mixed
     */
    public function getByArchive($year, $month, $published = true, $paginate = false, $sort_by = 'published_date', $sort_direction = 'desc')
    {
        $query = $this->model->whereBetween('published_date', [
            Carbon::createFromDate($year, Carbon::createFromFormat('M', $month)->month, 1),
            Carbon::createFromDate($year, Carbon::createFromFormat('M', $month)->month, 1)->endOfMonth()
        ]);
        if($published) {
            $query->where('published', true);
        }
        $query->orderBy($sort_by, $sort_direction);
        if($paginate) {
            return $query->paginate($paginate);
        }
        return $query->get();
    }

    /**
     * @param $category_id
     * @param bool $published
     * @param bool $paginate
     * @param string $sort_by
     * @param string $sort_direction
     * @return mixed
     */
    public function getByCategoryId($category_id, $published = true, $paginate = false, $sort_by = 'published_date', $sort_direction = 'desc')
    {
        $query = $this->model->whereHas('categories', function($query) use ($category_id) {
            $query->where('category_id', $category_id);
        });
        if($published) {
            $query->where('published', true);
        }
        $query->orderBy($sort_by, $sort_direction);
        if($paginate) {
            return $query->paginate($paginate);
        }
        return $query->get();
    }

    /**
     * @param bool $limit
     * @param bool $ignore_id
     * @return mixed
     */
    public function getLatestArticles($limit = false, $ignore_id = false)
    {
        $query = $this->model->orderBy('published_date', 'desc');
        if($ignore_id) {
            $query->where('id', '!=', $ignore_id);
        }
        return $query->take($limit)->get();
    }
	
	/**
	 * @param $title
	 * @param bool $limit
	 * @return bool
	 */
	public function searchByTitle($title, $limit = false)
	{
		if($title == '') {
			return false;
		}
		
		$query = $this->model->where(function($query) use ($title) {
			$query->where('title', 'like', '%' . $title . '%');
		});
		
		if($limit) {
			$query->take($limit);
		}
		
		return $query->get();
	}
}
