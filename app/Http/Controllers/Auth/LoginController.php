<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\ActivationService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $activationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest')->except('logout');
        $this->activationService = $activationService;
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->active) {
            $this->activationService->sendActivationMail($user);
            Auth::logout();
            return back()->with('warning', 'Bạn cần xác thực tài khoản, chúng tôi đã gửi mã xác thực vào email của bạn, hãy kiểm tra và làm theo hướng dẫn.');
        }
        return redirect()->intended($this->redirectPath());
    }
}
