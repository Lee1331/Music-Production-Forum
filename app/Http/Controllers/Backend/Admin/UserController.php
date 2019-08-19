<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Image;
use DB;
use File;
use App\Http\Requests\UserRequest;
class UserController extends AdminParentController{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admin = Auth::user();
        $users = User::orderBy('id')->paginate($this->displayNumber);
        return view('backend.admin.user.index', compact('admin','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        //
        return view('backend.admin.user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
            $user = new User;
            $user->email = $request->input('email');
            $user->name = $request->input('name');
            $user->bio = $request->input('bio');
            $user->password = Hash::make($request->input('password'));
            $user->profile_image = $request->input('profile_image');
            $user->email_verified_at = now();
            $user->save();

            return view('backend.admin.user.create')->with('success', 'User added');
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(User $user)
    {
        return view('backend.admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request,  User $user)
    {
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->bio = $request->input('bio');

        if($request->hasFile('profile_image')){
            $user->profile_image = $user->addImage('profile_image', $request);
        }

        $user->update();
        return redirect('/backend/admin/user')->with('success', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->destroyProfileImage();
        $user->delete();
        return redirect('/backend/admin/user')->with('success', 'User removed');
    }
}
