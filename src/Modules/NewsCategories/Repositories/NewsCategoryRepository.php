<?php namespace MissionControl\News\Modules\NewsCategories\Repositories;

use Eyeweb\MissionControl\EloquentRepository;
use MissionControl\News\Modules\NewsCategories\Models\NewsCategory;

/**
 * Class NewsCategoryRepository
 * @package MissionControl\News\Modules\NewsCategories\Repositories
 */
class NewsCategoryRepository extends EloquentRepository implements NewsCategoryInterface
{
    /**
     * @var NewsCategory
     */
    private $model;

    /**
     * NewsCategoryRepository constructor.
     * @param NewsCategory $model
     */
    function __construct(NewsCategory $model)
    {
        parent::__construct($model);

        $this->model = $model;
    }
}
