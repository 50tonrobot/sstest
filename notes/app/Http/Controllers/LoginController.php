<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserSession;
use App\User;
use DB;

class LoginController extends Controller
{
  public function AuthenticateLoginRequest(Request $request)
  {

    $validator = Validator::make($request->all(), [
        'password' => 'required',
        'email' => 'required|email'
    ]);

    if ($validator->fails())
    {
      $errors = $validator->errors()->all();
      return view('login',compact('errors'));
    }

    $user = DB::table('users')->where('email', $request->email)->first();
    if(!empty($user) && password_verify( $request->password , $user->password))
    {
      $result = DB::select("SELECT UUID() as id");
      $update = DB::select("
        INSERT INTO user_sessions (user_id,id,created_at,updated_at)
        VALUES ({$user->id},'{$result[0]->id}',now(),now()) 
        ON DUPLICATE KEY UPDATE user_sessions.id = '{$result[0]->id}',user_sessions.updated_at=now()");

      setcookie('notes_app_session', $result[0]->id, time() + (86400 * 30), "/"); // 86400 = 1 day
      return redirect()->route('dashboard');
    }
    else
    {
      //kick back out to login
      setcookie('notes_app_session', '', time() + (86400 * 30), "/"); // 86400 = 1 day
      return redirect()->route('login',['error'=>'Login Failed']);
    }
  }

  public function Logout()
  {
      setcookie('notes_app_session', '', time() + (86400 * 30), "/"); // 86400 = 1 day
      return redirect()->route('login',['error'=>'You are Logged out']);
  }

  public static function currentAuthenticatedUser() {
    $session = UserSession::find($_COOKIE['notes_app_session']);
    return User::find($session->user_id);
  }
}