<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Show profile of user
     *
     * @return Renderable
     */
    public function show()
    {
        $user = Auth::user();

        return view('backend.profile.show', compact('user'));
    }

    /**
     * Update profile.
     *
     * @param ProfileUpdateRequest $request
     *
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        try {
            $attributes = $request->only(['name', 'email', 'password']);

            if($attributes['password']) {
                $attributes['password'] = app('hash')->make($attributes['password']);
            } else {
                unset($attributes['password']);
            }
            $this->userRepository->update($attributes, authUserId());
            $request->session()->flash('success', 'The profile has been successfully updated.');
        } catch (Exception $exception) {
            Log::error($exception);
            $request->session()->flash('error', 'An error occurred while updating the user.');
        }

        return redirect()->route('backend.profile.show');
    }
}
