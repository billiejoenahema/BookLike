<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


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
    protected function redirectTo() {
        session()->flash('flash_message', 'ログインしました');
        return '/reviews';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        return view('auth.login');
    }

    // for guest user
    public function guestUserLogin()
    {
        $email = 'guestuser@example.com';
        $password = 'guestuser+password';

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // 認証に成功
            session()->flash('flash_message', 'ゲストユーザーでログインしました');
            return redirect('/reviews');
        }
    }
}
