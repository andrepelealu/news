<?php namespace MissionControl\News\Modules\NewsCategories\Controllers;

use App\Http\Controllers\Controller;
use MissionControl\News\Modules\NewsCategories\Repositories\NewsCategoryRepository;

/**
 * Class NewsCategoryController
 * @package MissionControl\News\Modules\NewsCategories\Controllers
 */
class NewsCategoryController extends Controller
{
    /**
     * @var NewsCategoriesRepo
     */
    private $newscategoryRepo;

    /**
     * NewsCategoryController constructor.
     * @param NewsCategoryRepository $newscategoryRepo
     */
    function __construct(NewsCategoryRepository $newscategoryRepo)
    {
        $this->newscategoryRepo = $newscategoryRepo;
    }
}
