<?php

namespace App\Http\Middleware;

use App\Autobuy\CaptchaString;
use Closure;

class CheckCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $captchaCode = $request->input(CaptchaString::CAPTCHA_FILE_NAME);
        if (! captcha_check($captchaCode)) {
            flash()->error('验证码错误');
            return redirect()->back();
        }
        return $next($request);
    }
}
