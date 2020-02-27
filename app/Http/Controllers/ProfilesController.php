<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    /**
     * Profile view function
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $user)
    {
        $series = $user->seriesBeingWatched();
        return view('profile', compact('user', 'series'));
    }

    /**
     * @param Request $request
     * @param User $reqUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request, User $reqUser)
    {
        $user = auth()->user();
        $validateArr = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,id,'.$user->id,
        ];

        if($request->filled('password')){
            $validateArr['password'] = 'required|string|min:6|confirmed';
        }

        $this->validate($request, $validateArr);

        $data = $request->only(['email', 'name']);
        $data['username'] = str_slug($data['name']);
        if($request->filled('password')){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success', 'Your profile updated successfully.');
        return redirect()->route('profile', $user->username);
    }
}
