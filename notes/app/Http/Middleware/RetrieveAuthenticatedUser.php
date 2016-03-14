<?php

namespace App\Http\Middleware;

use App\User;
use App\UserSession;
use DB;

class RetrieveAuthenticatedUser
{
  public function getUserObject()
  {
    if(isset($_COOKIE['notes_app_session']))
      $session = UserSession::find($_COOKIE['notes_app_session']);

    if(isset($session))
      $user = User::find($session->user_id);

    if(isset($user))
      return $user;
    else
      return false;
  }
}

