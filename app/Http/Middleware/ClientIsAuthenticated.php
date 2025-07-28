<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // تحقق من أن المستخدم قد قام بتسجيل الدخول باستخدام guard "client"
        if (!Auth::guard('client')->check()) {
            return redirect()->route('client.login'); // إعادة التوجيه إلى صفحة تسجيل الدخول
        }

        return $next($request); // السماح بالوصول إلى الصفحة إذا كان المستخدم مسجلاً دخوله
    }
}
