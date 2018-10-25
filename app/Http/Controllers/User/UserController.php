<?php

namespace App\Http\Controllers\User;

use App\Models\Interests\Interests;
use App\Models\User\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Profile view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $interests = \auth()->user()->interests;

        return view('user.profile.user_profile',compact('interests'));
    }

    /**
     * Update user profile
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|max:120',
            'email' => 'required|string|max:60',
            'phone_number' => 'nullable|string|max:40',
            'dob' => 'nullable|string|max:20',
            'is_student' => 'nullable|boolean',
            'occupation' => 'nullable|string|max:30',
        ]);

        if ($validator->fails()){
            return back()->with('error', 'There was an error processing your input.')->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $profile = (Auth::user()->profile == null) ? new UserProfile(): Auth::user()->profile;
        $profile->user_id = $user->id;
        $profile->phone_number = ($request->phone_number != null) ? $request->phone_number : $profile->phone_number;
        $profile->dob = ($request->dob != null) ? $request->dob : $profile->dob ;
        $profile->is_student = ($request->is_student == null) ? 0 : 1;
        $profile->occupation = ($request->occupation != null) ? $request->occupation : $profile->occupation;
        $profile->save();
        $user->save();

        return back()->with('success', 'Success. Your profile was updated successfully');
    }


}

