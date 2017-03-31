<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () {
    $RetrieveAuthenticatedUser = new \App\Http\Middleware\RetrieveAuthenticatedUser;
    $this->user = $RetrieveAuthenticatedUser->getUserObject();
    if($this->user)
      return redirect()->route('dashboard');
    else
      return redirect()->route('login');
});

$app->get('login', ['as' => 'login', function () {
    $RetrieveAuthenticatedUser = new \App\Http\Middleware\RetrieveAuthenticatedUser;
    $this->user = $RetrieveAuthenticatedUser->getUserObject();
    if($this->user)
      return redirect()->route('dashboard');
    else
      return view('login');
}]);
/*
$app->post('login', function (Request $request) {
    $this->validate($request, [
        'password' => 'required',
        'email' => 'required|email|unique:users'
    ]);

    // Store User...
});
*/

$app->post('login', 'LoginController@AuthenticateLoginRequest');
$app->get('logout', 'LoginController@Logout');


$app->group(['middleware' => 'auth'], function () use ($app) {

    $app->get('dashboard', ['as' => 'dashboard',
      'uses' => 'NotesController@index']);

    $app->get('note/{note}', 'NotesController@read');

    $app->get('note/{note}/edit', 'NotesController@edit');

    $app->post('dashboard', ['as' => 'dashboard',
      'uses' => 'NotesController@create']);

    $app->delete('note/{note}', 'NotesController@delete');

    $app->patch('note/{note}/edit',['as' => 'edit',
      'uses' => 'NotesController@update']);
    /*
    $app->get('dashboard', ['as' => 'dashboard', function () {
        return view('dashboard');
    }]);
    */


});
