<?php namespace MissionControl\News\Modules\NewsCategories\Controllers;

use App\Http\Controllers\Controller;
use MissionControl\News\Modules\NewsCategories\Models\NewsCategory;
use MissionControl\News\Modules\NewsCategories\Requests\NewsCategoryRequest;
use MissionControl\News\Modules\NewsCategories\Repositories\NewsCategoryRepository;

/**
 * Class AdminNewsCategoryController
 * @package MissionControl\News\Modules\NewsCategories\Controllers
 */
class AdminNewsCategoryController extends Controller
{
    /**
     * @var NewsCategoryRepository
     */
    private $newscategoryRepo;

    /**
     * AdminNewsCategoryController constructor.
     * @param NewsCategoryRepository $newscategoryRepo
     */
    function __construct(NewsCategoryRepository $newscategoryRepo)
    {
        $this->newscategoryRepo = $newscategoryRepo;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        $filter = request()->has('filter') ? request()->input('filter') : false;

        $newscategories = $this->newscategoryRepo->getAllFiltered($filter, 10, 'id', 'asc');

        return view('NewsCategories::Admin.index', compact('newscategories', 'filter'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create()
    {
        return view('NewsCategories::Admin.create');
    }

    /**
     * @param NewsCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsCategoryRequest $request)
    {
        if($newscategory = $this->newscategoryRepo->create($request->input())) {
            return redirect()
                ->route('mc-admin.' . config('newscategories.slug', 'newscategories') . '.edit', $newscategory->id)
                ->with('flash_message', 'The news category was added successfully.')
                ->with('flash_message_type', 'success');
        }
    }

    /**
     * @param NewsCategory $newscategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function edit(NewsCategory $newscategory)
    {
        $newscategories = $this->newscategoryRepo->getAll();

        return view('NewsCategories::Admin.edit', compact('newscategory', 'newscategories'));
    }

    /**
     * @param NewsCategoryRequest $request
     * @param NewsCategory $newscategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsCategoryRequest $request, NewsCategory $newscategory)
    {
        if($newscategory = $this->newscategoryRepo->update($newscategory->id, $request->input())) {
            return back()
                ->with('flash_message', 'The news category update was completed successfully .')
                ->with('flash_message_type', 'success');
        }
    }

    /**
     * @param NewsCategory $newscategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(NewsCategory $newscategory)
    {
        if($this->newscategoryRepo->delete($newscategory->id, false)) {
            return redirect()
                ->route('mc-admin.' . config('newscategories.slug', 'newscategories') . '.index')
                ->with('flash_message', 'The news category was deleted')
                ->with('flash_message_type', 'success');
        }
        return back();
    }

    /**
     * @param NewsCategory $newscategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|string|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function confirmDelete(NewsCategory $newscategory)
    {
        $destroyRoute = route('mc-admin.' . config('newscategories.slug', 'newscategories') . '.destroy', $newscategory->id);
        return view('Admins::Admin.partials.confirm-delete', compact('destroyRoute'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        if($this->newscategoryRepo->restore($id)) {
            return redirect()
                ->route('mc-admin.' . config('newscategories.slug', 'newscategories') . '.index')
                ->with('flash_message', 'The news category was restored')
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
        $newscategory = $this->newscategoryRepo->getById($id);
        $restoreRoute = route('mc-admin.' . config('newscategories.slug', 'newscategories') . '.restore', $newscategory->id);
        return view('Admins::Admin.partials.confirm-restore', compact('restoreRoute'));
    }
}