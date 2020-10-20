<?php

namespace App\Http\Controllers\Admin;    // Auth→Adminに変更

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;              // 追加
use Illuminate\Support\Facades\Auth;      // 追加

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';  // '/adminを追加変更
    protected $redirectTo = '/admin/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout'); ↓に変更
        $this->middleware('guest:admin')->except('logout'); //変更
    }
    
     public function showLoginForm()  //追加
    {
        return view('admin.login');  //変更
    }
 
    protected function guard()  //追加
    {
        return Auth::guard('admin');  //変更
    }
    
    public function logout(Request $request)  //追加
    {
        Auth::guard('admin')->logout();  //変更
        $request->session()->flush();
        $request->session()->regenerate();
 
        return redirect('/admin/login');  //変更
    }
    
    public function username()
    {
        return 'name'; //ユーザー名
    }
}
