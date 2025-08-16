<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\VerifyEmailNotifcation;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use PHPUnit\Event\Code\Throwable;

class AuthController extends Controller
{
    function indexLogin(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.login', compact('guard'));
    }

    // function login(Request $request)
    // {
    //     $guard = $request->route('guard');
    //     $data = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required', 'string', 'min:8']
    //     ]);


    //     // dd([
    //     //     'guard' => $guard,
    //     //     'data' => $data,
    //     //     'user_found' => \App\Models\Admin::where('email', $data['email'])->first(),
    //     //     'password_matches' => Hash::check(
    //     //         $data['password'],
    //     //         optional(\App\Models\Admin::where('email', $data['email'])->first())->password
    //     //     ),
    //     // ]);

    //     if (Auth::guard($guard)->attempt($data, $request->filled('remember'))) {
    //         return redirect()->route("{$guard}.dashboard");
    //     }
    //     return redirect()->back();
    // }
    // تنفيذ تسجيل الدخول
    public function login(Request $request)
    {
        $guard = $request->route('guard');
        $table = config("auth.guards.$guard.provider");

        // فلديشن قوي
        $data = $request->validate([
            'email' => "required|string|email:rfc,dns|exists:$table,email|max:255",
            'password' => [
                'required',
                'string',
                'min:8',
                'max:64',
                'regex:/[A-Z]/',          // لازم حرف كبير
                'regex:/[a-z]/',          // لازم حرف صغير
                'regex:/[0-9]/',          // لازم رقم
                'regex:/[^A-Za-z0-9]/',   // لازم رمز خاص
            ],
        ], [
            'email.required'   => 'البريد الإلكتروني مطلوب',
            'email.email'      => 'صيغة البريد غير صحيحة',
            'email.exists'     => 'هذا البريد غير مسجل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min'     => 'كلمة المرور يجب ألا تقل عن 8 أحرف',
            'password.regex'   => 'كلمة المرور يجب أن تحتوي على حرف كبير وصغير ورقم ورمز',
        ]);

        try {
            // محاولة تسجيل الدخول
            if (Auth::guard($guard)->attempt($data, $request->filled('remember'))) {
                $request->session()->regenerate();
                return redirect()->route("$guard.dashboard");
            }

            // لو كلمة المرور أو الإيميل خطأ
            return redirect()
                ->back()
                ->withErrors(['email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة'])
                ->withInput($request->only('email', 'remember'));
        } catch (Throwable $e) {
            // أي خطأ غير متوقع
            return redirect()
                ->route('login-error')
                ->with('error', 'حدث خطأ غير متوقع أثناء تسجيل الدخول');
        }
    }
    function indexRegister(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.register', compact('guard'));
    }

    function register(Request $request)
    {
        $guard = $request->route('guard');
        $provider = config("auth.guards.$guard.provider");
        $modelClass = config("auth.providers.$provider.model");
        $token = Str::random();
        $user = $modelClass::create([
            'fullname' => $request->fullname,
            'username' => $request->fullname,
            'phone' => '059252525',
            'country' => 'gaza',
            'email' => $request->email,
            'password' => $request->password,
            'verification_token' => $token,
            'verification_token_sent_at' => now(),
        ]);

        $user->notify(new VerifyEmailNotification($token, $guard));
        return redirect()->route('con');
    }


    function dashboard(Request $request)
    {
        $guard = $request->route('guard');
        return view($guard . '.dashboard', compact('guard'));
    }

    public function indexForgetPassword(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.forget-password', compact('guard'));
    }

    public function forgetPassword(Request $request)
    {
        $guard = $request->route('guard');
        $request->validate(['email' => 'required|email']);


        $broker = $this->getPasswordBroker($guard);

        $status = Password::broker($broker)->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token = null)
    {
        $guard = $request->route('guard');
        $email = $request->query('email');

        return view('auth.reset-password', compact('guard', 'token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $guard = $request->route('guard');
        $broker = $this->getPasswordBroker($guard);

        $status = Password::broker($broker)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route("$guard.login")->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    protected function getPasswordBroker($guard)
    {
        return match ($guard) {
            'admin' => 'admins',
            'freelancer' => 'freelancers',
            default => 'users',
        };
    }


    function logout(Request $request)
    {
        $guard = $request->route('guard');
        Auth::guard($guard)->logout();
        return redirect()->route("$guard.login");
    }
}
