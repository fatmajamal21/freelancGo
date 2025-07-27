<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.login', compact('guard'));
    }

    public function login(Request $request)
    {
        $guard = $request->route('guard');

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        //         $credentials = $request->validate([
        //     'email' => [
        //         'required', 
        //         'email', 
        //         'unique:users,email', 
        //         'trim', 
        //     ],
        //     'password' => [
        //         'required', 
        //         'string', 
        //         'min:8', 
        //         'confirmed', 
        //         'regex:/[A-Z]/',  
        //         'regex:/[a-z]/',  
        //         'regex:/[0-9]/',  
        //         'regex:/[@$!%*?&]/', 
        //     ],
        // ], [
        //     'email.unique' => 'البريد الإلكتروني الذي أدخلته مستخدم بالفعل.',
        //     'password.regex' => 'يجب أن تحتوي كلمة المرور على حرف كبير، حرف صغير، رقم، ورمز خاص.',
        //     'password.confirmed' => 'كلمات المرور غير متطابقة.',
        // ]);


        if (Auth::guard($guard)->attempt($credentials, $request->filled('remember'))) {
            return redirect()->route("$guard.index");
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->except('password'));
    }
}
