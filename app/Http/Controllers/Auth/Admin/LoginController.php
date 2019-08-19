<?php

namespace App\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    //
    public function __construct(){
        //use this middleware except on the logout function
        $this->middleware('guest:admin')->except('logout');
        //logout
    }

    public function showAdminLoginForm(){
        return view('admin.login');
    }

    public function loginAdmin(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        //"The intended method on the redirector will redirect the user to the URL they were attempting to access before being intercepted by the authentication middleware. - https://laravel.com/docs/5.7/authentication"
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], false)){
            //return redirect()->intended(route('admin.index'));
            //Auth::logoutOtherDevices($request->password);
            return redirect()->route('admin.home');
        }
        else{
            //return redirect('admin.login')->withInput($request->only('email', 'remember'));
            return redirect('admin.login')->withInput($request->only('email'));
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        return redirect('/admin/login');
    }
}
