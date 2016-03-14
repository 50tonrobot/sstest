<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App;
use DB;
use DateTime;
use DateInterval;
use App\User;
use App\UserSession;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty($_COOKIE['notes_app_session']))
        {
            return redirect()->route('login',['error'=>'Not Logged in']);
        }
        else
        {
            $session = UserSession::find($_COOKIE['notes_app_session']);

            if($session)
            {
                $currentTime = new DateTime('now');
                $currentTime->sub(new DateInterval('PT15M')); //sessions can be up to 15 minutes old
                $sessionTime = new DateTime($session->updated_at);
                if($sessionTime < $currentTime)
                {
                    return redirect()->route('login',['error'=>'Session Expired']);
                }
                else
                {
                  $user = User::find($session->user_id);

                  //dd($this->auth);
                  //rotate and persist session cookie
                  $update = DB::select("UPDATE user_sessions SET updated_at=now()");
                }
            }
            else
            {
                return redirect()->route('login',['error'=>'Not Logged in']);
            }
        }
        /*
        if ($this->auth->guard($guard)->guest()) {
            return response('Unauthorized.', 401);
        }
        */

        return $next($request);
    }
}
