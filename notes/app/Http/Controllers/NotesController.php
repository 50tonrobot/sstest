<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Note;
use Illuminate\Http\Request;
use DateTime;

class NotesController extends Controller
{
  public $user;

  public function __construct()
  {
    //$this->middleware('whoami'); doesn't work
    $RetrieveAuthenticatedUser = new \App\Http\Middleware\RetrieveAuthenticatedUser;
    $this->user = $RetrieveAuthenticatedUser->getUserObject();
  }

  private function prepare_note($note)
  {
    $author = User::find($note->user_id);
    $note->author_name = $author->name;
    $note->created_at = new DateTime($note->created_at);
    $note->updated_at = new DateTime($note->updated_at);
    $note->author_info = ($note->created_at != $note->updated_at) ?
      "edited by: {$note->author_name}, ".date_format($note->updated_at, 'D h:ia') :
      "created by: {$note->author_name}, ".date_format($note->created_at, 'D h:ia');
  }

  public function index($errors = null)
  {
    //unsuccessfully tried $notes = Note::with('user')->get();
    $notes = Note::all();
    foreach ($notes as $note) {
      $this->prepare_note($note);
    }
    $user  = $this->user;
    return view('dashboard',compact(['user','notes','errors']));
  }

  public function create(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'body' => 'required'
    ]);

    if ($validator->fails())
    {
      return $this->index($validator->errors()->all());
    }

    $note = new Note;
    $note->title = $request->title;
    $note->body = $request->body;
    $this->user->notes()->save($note);

    return $this->index();
  }

  //tried public function delete(Note $note) but it didn't work
  public function delete($note_id)
  {
    $note = Note::find($note_id);

    return ($note->delete()) ? 'true':'false';
  }

  public function read($note_id)
  {
    $user = $this->user;
    $note = Note::find($note_id);
    $this->prepare_note($note);

    return view('read',compact(['user','note']));
  }

  public function edit($note_id)
  {
    $user = $this->user;
    $note = Note::find($note_id);
    $this->prepare_note($note);

    return view('edit',compact(['user','note']));
  }

  public function update(Request $request, $note_id)
  {
    $user = $this->user;
    $note = Note::find($note_id);

    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'body' => 'required'
    ]);

    if ($validator->fails())
    {
      $errors = $validator->errors()->all();
      return view('edit',compact(['user','note','errors']));
    }

    $note->title = $request->title;
    $note->body = $request->body;

    $note->save();

    return redirect("note/{$note_id}");
  }
}