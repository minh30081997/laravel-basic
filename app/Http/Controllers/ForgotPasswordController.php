<?php

namespace App\Http\Controllers;

use App\ForgotPassword;
use App\Http\Requests\RequestResetPassword;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Test;
use App\ResetPassword;
use App\Mail\ResetPasswordEmail;

class ForgotPasswordController extends Controller
{
    // Solution 1
    public function getFormResetPassword()
    {
        return view('email.email');
    }

    public function sendCodeResetPassword(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('message', 'Email khong ton tai');
        }

        $token = bcrypt(md5(time() . $email));

        $userForgot = new ForgotPassword();

        $userForgot->token = $token;
        $userForgot->email = $email;
        $userForgot->created_at = Carbon::now();

        $userForgot->save();

        $url = route('get.link.reset.password', ['email' => $email, 'token' => $userForgot->token]);
        $data = [
            'route' => $url,
        ];

        Mail::send('email.reset', $data, function ($message) use ($email) {
            $message->to($email, 'Reset password')->subject('Lay lai mat khau');
        });

        return redirect()->back()->with('message', 'Link lay lai mat khau da duoc gui den mail cua ban');
    }

    public function resetPassword(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        $user = User::where('email', $email)->first();
        $userForgot = ForgotPassword::where([
            'email' => $email,
            'token' => $token,
        ])->first();

        if (!$userForgot) {
            return redirect()->back()->with('message', 'Duong dan khong dung. Xin thu lai');
        }
        return view('email.reset_password', ['email' => $email, 'token' => $token]);
    }

    public function saveResetPassword(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        $userForgot = ForgotPassword::where([
            'email' => $email,
        ])->first();

        if (!$userForgot) {
            return redirect()->back()->with('message', 'Duong dan khong dung. Xin thu lai');
        }

        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        return redirect('login')->with('message', 'Doi mat khau thanh cong');
    }

    // Solution 2
    // public function getForm()
    // {
    //     return view('gmail.form_send_token');
    // }

    // public function sendToken(Request $request) 
    // {
    //     $email = $request->input('email');
    //     $token = bcrypt(md5(time().$email));

    //     $emailForgot = ForgotPassword::where('email', $email)->first();
    //     $user = User::where('email', $email)->first();

    //     if (!$user) {
    //         return redirect()->back()->with('message', 'Email khong ton tai');
    //     }

    //     if ($emailForgot) {
    //         $emailForgot->email = $email;
    //         $emailForgot->token = $token;
    //         $emailForgot->created_at = Carbon::now();

    //         $emailForgot->save();
    //     }

    //     $url = route('get.reset', ['email' => $email, 'token' => $token]);

    //     $data = [
    //         'route' => $url,
    //         'user' => $user,
    //     ];

    //     Mail::send('gmail.email_content', $data, function ($message) use($email) {
    //         $message->to($email)->subject('Reset Password');
    //     });

    //     return redirect()->back()->with('message', 'Link lay lai password da duoc gui');
    // }

    // public function getReset(Request $request)
    // {
    //     $email = $request->email; 
    //     // $email = $request['email'];
    //     $token = $request->token;

    //     $emailForgot = ForgotPassword::where([
    //         'email' => $email,
    //         'token' => $token,
    //     ])->first();

    //     if (!$emailForgot) {
    //         return redirect()->back()->with('message', 'Link reset password khong dung');
    //     }

    //     return view('gmail.form_reset_password', ['emailForgot' => $emailForgot]);
    // }

    // public function saveReset(RequestResetPassword $requestResetPassword) {
    //     $email = $requestResetPassword->email;
    //     $password = $requestResetPassword->password;
    //     $token = $requestResetPassword->token;

    //     $emailForgot = ForgotPassword::where([
    //         'email' => $email,
    //         'token' => $token,
    //     ])->first();  

    //     if (!$emailForgot) {
    //         return redirect()->back()->with('message', 'Link reset password khong dung');
    //     }

    //     $user = User::where([
    //         'email' => $email,
    //     ])->first();

    //     $user->email = $email;
    //     $user->password = bcrypt($password);
    //     $user->save();

    //     return redirect('/login')->with('message', 'Thay doi mat khau thanh cong');
    // }

    // Solution 3
    public function getForm()
    {
        return view('gmail.form_send_token');
    }

    public function sendToken(Request $request, ResetPassword $emailForgot)
    {
        $email = $request->email;

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('message', 'Email khong ton tai');
        }

        $token = $emailForgot->createResetPassword($email);

        $url = route('get.reset', ['email' => $email, 'token' => $token]);

        $data = [
            'route' => $url,
            'user' => $user,
        ];

        $mail = new ResetPasswordEmail($data);
        Mail::to($email)->send($mail);

        return redirect()->back()->with('message', 'Link lay lai mat khau da duoc gui toi mail cua ban');
    }

    public function getReset(Request $request)
    {
        $email = $request->email;
        $token = $request->token;

        $emailForgot = ResetPassword::where([
            'email' => $email,
            'token' => $token,
        ])->first();

        if (!$emailForgot) {
            return redirect()->back()->with('message', 'Duong link sai');
        }

        return view('gmail.form_reset_password', ['emailForgot' => $emailForgot]);
    }

    public function saveReset(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        $password = $request->password;

        $emailForgot = ResetPassword::where([
            'email' => $email,
            'token' => $token,
        ])->first();

        if (!$emailForgot) {
            return redirect()->back()->with('message', 'Duong link sai');
        }

        $user = User::where('email', $email)->update([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        return redirect('/login')->with('message', 'Thay doi mat khau thanh cong');
    }
}
