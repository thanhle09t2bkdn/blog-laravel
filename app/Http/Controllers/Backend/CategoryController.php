<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Http\Requests\Categories\CategoryCreateRequest;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    /**
     * Repository
     *
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * Constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Renderable|void
     */
    public function index(Request $request)
    {
        try {
            $list = $this->categoryRepository->paginate();

            return view('backend.categories.index', compact('list'));
        } catch (Exception $exception) {
            Log::error($exception);
            abort(500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable|void
     */
    public function create()
    {
        try {
            return view('backend.categories.create');
        } catch (Exception $exception) {
            Log::error($exception);
            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryCreateRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CategoryCreateRequest $request)
    {
        try {
            $attributes = $request->only(array_keys($this->categoryRepository->makeModel()->rules()));
            $item = $this->categoryRepository->create($attributes);

            $request->session()->flash('success', 'The brand has been successfully created.');

            if ($request->get('action') === 'edit') {
                return redirect()->route('backend.categories.edit', $item->id);
            }

            return redirect()->route('backend.categories.show', $item->id);
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while creating the brand.');
        }

        return redirect()->route('backend.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param mixed $id
     *
     * @return View|RedirectResponse
     */
    public function show(Request $request, $id)
    {
        try {
            $item = $this->categoryRepository->getById($id);

            return view('backend.categories.show', compact('item'));
        } catch (ModelNotFoundException $exception) {
            $request->session()->flash('error', 'Sorry, the page you are looking for could not be found.');
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while showing the brand.');
        }

        return redirect()->route('backend.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param string $id
     *
     * @return View|RedirectResponse
     */
    public function edit(Request $request, string $id)
    {
        try {
            $item = $this->categoryRepository->getById($id);

            return view('backend.categories.edit', compact('item'));
        } catch (ModelNotFoundException $e) {
            $request->session()->flash('error', 'Sorry, the page you are looking for could not be found.');
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while showing the brand.');
        }

        return redirect()->route('backend.categories.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param mixed $id
     *
     * @return RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            $attributes = $request->only(array_keys($this->categoryRepository->makeModel()->rules()));
            $this->categoryRepository->update($attributes, $id);

            $request->session()->flash('success', 'The category has been successfully updated.');

            if ($request->get('action') === 'edit') {
                return redirect()->route('backend.categories.edit', $id);
            }

            return redirect()->route('backend.categories.show', $id);
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while updating the category.');
        }

        return redirect()->route('backend.categories.index');
    }

    /**
     * Delete multiple items
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function delete(Request $request)
    {
        try {
            $ids = $request->get('id');
            if (empty($ids)) {
                $request->session()->flash('error', 'Please choose any categories to delete.');
            } else {
                $this->categoryRepository->deleteByIds($ids);
                $request->session()->flash('success', 'The categories has been successfully deleted.');
            }
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while deleting the categories.');
        }

        return redirect()->route('backend.categories.index');
    }
}
