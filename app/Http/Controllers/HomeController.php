<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\ForumCategory;
use Image;

use App\ForumThread;

use App\Http\Requests\UserRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    /**
     * Users must be authenticated to access the routes from this controller
     * Note that ':' specifies the guard we are using, by defualt the guard is set to 'web'
     *
     * @return void
     */
        $this->middleware('auth')->except('show');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $threads = $user->getThreads();
        return view('user.home', compact('user', 'threads'));
    }
    /**
     * Show the edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function edit(Request $request, User $user)
    {
        \abort_if($user->id !== Auth::user()->id, 403);
        return view('backend.user.edit', compact('user'));
    }
    /**
     * Update the users account
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(UserRequest $request, User $user)
    {
        \abort_if($user->id !== Auth::user()->id, 403);
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->bio = $request->input('bio');

        if($request->hasFile('profile_image')){
            $user->profile_image = $user->addImage('profile_image', $request);
        }
        $user->update();
        return redirect('home')->with('success', 'account updated');
    }

    public function show(User $user){
        $threads = $user->getThreads();
        return view('backend.user.show', compact('user', 'threads'));
    }
}
