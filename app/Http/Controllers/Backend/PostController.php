<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostCreateRequest;
use App\Http\Requests\Posts\PostUpdateRequest;
use App\Repositories\PostRepository;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    /**
     * Repository
     *
     * @var PostRepository
     */
    private $postRepository;

    /**
     * Constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
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
            $list = $this->postRepository->paginate();

            return view('backend.posts.index', compact('list'));
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
            return view('backend.posts.create');
        } catch (Exception $exception) {
            Log::error($exception);
            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostCreateRequest $request
     *
     * @return RedirectResponse
     */
    public function store(PostCreateRequest $request)
    {
        try {
            $attributes = $request->only(array_keys($this->postRepository->makeModel()->rules()));
            $item = $this->postRepository->create($attributes);

            $request->session()->flash('success', 'The brand has been successfully created.');

            if ($request->get('action') === 'edit') {
                return redirect()->route('backend.posts.edit', $item->id);
            }

            return redirect()->route('backend.posts.show', $item->id);
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while creating the brand.');
        }

        return redirect()->route('backend.posts.index');
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
            $item = $this->postRepository->getById($id);

            return view('backend.posts.show', compact('item'));
        } catch (ModelNotFoundException $exception) {
            $request->session()->flash('error', 'Sorry, the page you are looking for could not be found.');
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while showing the brand.');
        }

        return redirect()->route('backend.posts.index');
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
            $item = $this->postRepository->getById($id);

            return view('backend.posts.edit', compact('item'));
        } catch (ModelNotFoundException $e) {
            $request->session()->flash('error', 'Sorry, the page you are looking for could not be found.');
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while showing the brand.');
        }

        return redirect()->route('backend.posts.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param mixed $id
     *
     * @return RedirectResponse
     */
    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $attributes = $request->only(array_keys($this->postRepository->makeModel()->rules()));
            $this->postRepository->update($attributes, $id);

            $request->session()->flash('success', 'The post has been successfully updated.');

            if ($request->get('action') === 'edit') {
                return redirect()->route('backend.posts.edit', $id);
            }

            return redirect()->route('backend.posts.show', $id);
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while updating the post.');
        }

        return redirect()->route('backend.posts.index');
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
                $request->session()->flash('error', 'Please choose any posts to delete.');
            } else {
                $this->postRepository->deleteByIds($ids);
                $request->session()->flash('success', 'The posts has been successfully deleted.');
            }
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while deleting the posts.');
        }

        return redirect()->route('backend.posts.index');
    }
}
