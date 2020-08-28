<?php namespace MissionControl\News\Modules\News\Controllers;

use App\Http\Controllers\Controller;
use Eyeweb\MissionControl\Modules\Pages\Repositories\PageRepository;
use MissionControl\News\Modules\News\Repositories\NewsRepository;
use MissionControl\News\Modules\NewsCategories\Repositories\NewsCategoryRepository;

/**
 * Class NewsController
 * @package MissionControl\News\Modules\News\Controllers
 */
class NewsController extends Controller
{
    /**
     * @var NewsRepository
     */
    private $newsRepo;

    /**
     * @var PageRepository
     */
    private $pageRepo;

    /**
     * @var NewsCategoryRepository
     */
    private $newscategoryRepo;

    /**
     * NewsController constructor.
     * @param NewsRepository $newsRepo
     * @param NewsCategoryRepository $newscategoryRepo
     * @param PageRepository $pageRepo
     */
    function __construct(NewsRepository $newsRepo, NewsCategoryRepository $newscategoryRepo, PageRepository $pageRepo)
    {
        $this->newsRepo = $newsRepo;
        $this->pageRepo = $pageRepo;
        $this->newscategoryRepo = $newscategoryRepo;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        $articles = $this->newsRepo->getAllFiltered('published', 20, 'published_date', 'desc');
        $archive = $this->newsRepo->getArchive();
        $newscategories = $this->newscategoryRepo->getAllFiltered('published');

        $page = $this->pageRepo->getBySlug(config('news.slug', 'news'));
        $pagecontent = $page->preparePageContent();

        return view('News::Frontend.index', compact('articles', 'archive', 'newscategories', 'page', 'pagecontent'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function show($slug)
    {
        $archive = $this->newsRepo->getArchive();
        $newscategories = $this->newscategoryRepo->getAllFiltered('published');

        if($category = $this->newscategoryRepo->getBySlug($slug, null, false)) {
            $articles = $this->newsRepo->getByCategoryId($category->id, true, 20);
            return view('News::Frontend.category', compact('category', 'articles', 'archive', 'newscategories'));
        }
        if($article = $this->newsRepo->getBySlug($slug)) {
            $previousArticles = $this->newsRepo->getLatestArticles(2, $article->id);
            return view('News::Frontend.show', compact('article', 'newscategories', 'archive', 'previousArticles'));
        }
        abort(404);
    }

    /**
     * @param $year
     * @param $month
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function archive($year, $month)
    {
        $articles = $this->newsRepo->getByArchive($year, $month, true, 20, 'published_date', 'desc');

        $archive = $this->newsRepo->getArchive();
        $newscategories = $this->newscategoryRepo->getAllFiltered('published');

        return view('News::Frontend.archive', compact('articles', 'archive', 'newscategories'));
    }
}
