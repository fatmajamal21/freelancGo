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

class AuthController extends Controller
{
    function indexLogin(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.login', compact('guard'));
    }

    function login(Request $request)
    {
        $guard = $request->route('guard');
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8']
        ]);

        if (Auth::guard($guard)->attempt($data, $request->filled('remember'))) {
            return redirect()->route("{$guard}.dashboard");
        }
        return redirect()->back();
    }

    function indexRegister(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.register', compact('guard'));
    }

    public function register(Request $request)
    {
        // Generate token and create the user
        $guard = $request->route('guard');
        $provider = config("auth.guards.$guard.provider");
        $modelClass = config("auth.providers.$provider.model");
        $token = Str::random();

        $user = $modelClass::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'verification_token' => $token,
            'verification_token_sent_at' => now(),
        ]);

        // Send notification with verification token
        $user->notify(new VerifyEmailNotification($token, $guard));

        // Redirect to the confirmation page and pass the email
        return redirect()->route('confirmation')->with('email', $request->email);
    }


    function dashboard(Request $request)
    {
        $guard = $request->route('guard');
        return view($guard . '.dashboard');
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

        // تعيين broker حسب الguard
        $broker = $this->getPasswordBroker($guard);


        $status = Password::broker($broker)->sendResetLink(
            $request->only('email')
        );

        // إرسال المستخدم إلى صفحة التأكيد في حال تم إرسال الرابط بنجاح
        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->route('confirmation')->with('status', 'تم إرسال رابط الاستعادة بنجاح!');
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }



    public function showResetForm(Request $request, $token = null)
    {
        $guard = $request->route('guard');
        $email = $request->query('email');

        return view('auth.reset-password', compact('guard', 'token', 'email'));
    }




    public function resetPassword(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed', // التأكد من تطابق كلمة المرور مع التأكيد
            'token' => 'required|string',
        ]);

        // تحديد الـ broker بناءً على الـ guard
        $guard = $request->route('guard');
        $broker = $this->getPasswordBroker($guard);

        // محاولة إعادة تعيين كلمة المرور باستخدام الـ broker
        $status = Password::broker($broker)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // تحديث كلمة المرور للمستخدم
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        // التحقق من النتيجة
        return $status === Password::PASSWORD_RESET
            ? redirect()->route($guard . '.login')->with('status', 'تم تحديث كلمة المرور بنجاح.')  // إعادة التوجيه بعد النجاح
            : back()->withErrors(['email' => [__($status)]]);  // إعادة التوجيه في حال الخطأ
    }


    // Helper method لتحديد broker حسب guard
    protected function getPasswordBroker($guard)
    {
        return match ($guard) {
            'admin' => 'admins',
            'freelancer' => 'freelancers',
            'client' => 'clients',
            default => 'users',
        };
    }
}
