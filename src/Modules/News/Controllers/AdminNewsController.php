<?php namespace MissionControl\News\Modules\News\Controllers;

use App\Http\Controllers\Controller;
use Eyeweb\MissionControl\Modules\Admins\Repositories\AdminRepository;
use MissionControl\News\Modules\News\Models\News;
use MissionControl\News\Modules\News\Repositories\NewsRepository;
use MissionControl\News\Modules\News\Requests\NewsRequest;
use MissionControl\News\Modules\NewsCategories\Repositories\NewsCategoryRepository;

/**
 * Class AdminNewsController
 * @package MissionControl\News\Modules\News\Controllers
 */
class AdminNewsController extends Controller
{
    /**
     * @var NewsRepository
     */
    private $newsRepo;

    /**
     * @var NewsCategoryRepository
     */
    private $newscategoryRepo;

    /**
     * @var AdminRepository
     */
    private $adminRepo;

    /**
     * AdminNewsController constructor.
     * @param NewsRepository $newsRepo
     * @param NewsCategoryRepository $newscategoryRepo
     * @param AdminRepository $adminRepo
     */
    function __construct(NewsRepository $newsRepo, NewsCategoryRepository $newscategoryRepo, AdminRepository $adminRepo)
    {
        $this->newsRepo = $newsRepo;
        $this->newscategoryRepo = $newscategoryRepo;
        $this->adminRepo = $adminRepo;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        $filter = request()->has('filter') ? request()->input('filter') : false;

        $articles = $this->newsRepo->getAllFiltered($filter, 40, 'id', 'asc');

        return view('News::Admin.index', compact('articles', 'filter'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create()
    {
        $newscategories = $this->newscategoryRepo->getAll();
        $authors = $this->adminRepo->getAll();

        return view('News::Admin.create', compact('newscategories', 'authors'));
    }

    /**
     * @param NewsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsRequest $request)
    {
        if($article = $this->newsRepo->create($request->except('categories'))) {
            $article->categories()->sync(request()->input('categories'));
            return redirect()
                ->route('mc-admin.' . config('news.slug', 'news') . '.edit', ['news' => $article->id])
                ->with('flash_message', 'The news was added successfully.')
                ->with('flash_message_type', 'success');
        }
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function edit(News $news)
    {
        $article = $news;
        $newscategories = $this->newscategoryRepo->getAll();
        $authors = $this->adminRepo->getAll();

        return view('News::Admin.edit', compact('article', 'newscategories', 'authors'));
    }

    /**
     * @param NewsRequest $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsRequest $request, News $news)
    {
        if($article = $this->newsRepo->update($news->id, $request->except('categories'))) {
            $article->categories()->sync(request()->input('categories'));
            return back()
                ->with('flash_message', 'The news update was completed successfully .')
                ->with('flash_message_type', 'success');
        }
    }

    /**
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $news)
    {
        if($this->newsRepo->delete($news->id)) {
            return redirect()
                ->route('mc-admin.' . config('news.slug', 'news') . '.index')
                ->with('flash_message', 'The news was deleted')
                ->with('flash_message_type', 'success');
        }
        return back();
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function confirmDelete(News $news)
    {
        $destroyRoute = route('mc-admin.' . config('news.slug', 'news') . '.destroy', $news->id);
        return view('Admins::Admin.partials.confirm-delete', compact('destroyRoute'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        if($this->newsRepo->restore($id)) {
            return redirect()
                ->route('mc-admin.' . config('news.slug', 'news') . '.index')
                ->with('flash_message', 'The news was restored')
                ->with('flash_message_type', 'success');
        }
        return back();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function confirmRestore($id)
    {
        $news = $this->newsRepo->getById($id);
        $restoreRoute = route('mc-admin.' . config('news.slug', 'news') . '.restore', $news->id);
        return view('Admins::Admin.partials.confirm-restore', compact('restoreRoute'));
    }
	
	/**
	 * @return mixed
	 */
	public function search()
	{
		$terms = request()->input('terms');
		
		$results = $this->newsRepo->searchByTitle($terms, 10)->each(function($item, $key) {
			$item->id = $item->id;
			$item->value = $item->title;
		});
		
		if(request()->ajax()) {
			return $results;
		}
	}
}
