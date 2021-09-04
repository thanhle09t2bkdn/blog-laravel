<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserInfoRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Repository
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
            $list = $this->userRepository->paginate();
            $roleNames = User::$roleNames;

            return view('users.index', compact('list', 'roleNames'));
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
            $roleNames = User::$roleNames;

            return view('users.create', compact('roleNames'));
        } catch (Exception $exception) {
            Log::error($exception);
            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     *
     * @return RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        try {
            $attributes = $request->only(array_keys($this->userRepository->makeModel()->rules()));
            $attributes['password'] = app('hash')->make($attributes['password']);
            if (!empty($request->get('is_active'))) {
                $attributes['email_verified_at'] = Carbon::now();
            } else {
                $attributes['email_verified_at'] = null;
            }
            $item = $this->userRepository->create($attributes);

            $request->session()->flash('success', 'The user has been successfully created.');

            if ($request->get('action') === 'edit') {
                return redirect()->route('users.edit', $item->id);
            }

            return redirect()->route('users.show', $item->id);
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while creating the user.');
            return redirect()->route('users.index');
        }
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
            $item = $this->userRepository->getById($id);

            return view('users.show', compact('item'));
        } catch (ModelNotFoundException $exception) {
            $request->session()->flash('error', 'Sorry, the page you are looking for could not be found.');
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while showing the user.');
        }

        return redirect()->route('users.index');
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
            $item = $this->userRepository->getById($id);
            $roleNames = User::$roleNames;

            return view('users.edit', compact('item', 'roleNames'));
        } catch (ModelNotFoundException $e) {
            $request->session()->flash('error', 'Sorry, the page you are looking for could not be found.');
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while showing the user.');
        }

        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param mixed $id
     *
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $attributes = $request->only(array_keys($this->userRepository->makeModel()->rules()));
            if($attributes['password']) {
                $attributes['password'] = app('hash')->make($attributes['password']);
            } else {
                unset($attributes['password']);
            }
            if (!empty($request->get('is_active'))) {
                $attributes['email_verified_at'] = Carbon::now();
            } else {
                $attributes['email_verified_at'] = null;
            }
            $this->userRepository->update($attributes, $id);

            $request->session()->flash('success', 'The user has been successfully updated.');

            if ($request->get('action') === 'edit') {
                return redirect()->route('users.edit', $id);
            }

            return redirect()->route('users.show', $id);
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while updating the user.');
        }

        return redirect()->route('users.index');
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
                $request->session()->flash('error', 'Please choose any users to delete.');
            } else {
                $this->userRepository->deleteByIds($ids);
                $request->session()->flash('success', 'The users has been successfully deleted.');
            }
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while deleting the users.');
        }

        return redirect()->route('users.index');
    }
}
