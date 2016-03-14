@extends('layout')

@section('head')
  <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@stop

@section('header')
@include('welcome')
@stop

@section('content')

@if (!empty($notes))
<div class='well'>
<h4>Your Notes</h4>
<ul class='notes-list list-group'>
@foreach ($notes as $note)
  <li class='list-group-item editable' data-note-id='{{ $note->id }}'><span class='note-title'>{{ $note->title }}</span><span class="glyphicon glyphicon-trash" data-note-id="{{ $note->id }}"></span><span class='author-info'>({{ $note->author_info }})</span></li>
@endforeach
</ul>
@else
<div>{{ $user->name }}, You have no notes yet</div>
@endif
</div>

<form method='post' action='/dashboard'>
  <div class='note-form form-group well'>
  <h4>Add Note</h4>
  <input name='title' type='text' class='form-control' placeholder='Title' />
  <textarea name='body' class='form-control' placeholder='Body'></textarea>
  <button class='btn btn-primary' type='submit'>Save Note</button>
</form>
<div style='clear:both'></div>
@if (!empty($errors)) 
  <div class="alert alert-warning">
    <h4>Error:</h4>
@foreach ($errors as $error)
    <div>{{ $error }}</div>
@endforeach
  </div>
@endif
@stop

@section('footer')
<script src="/js/dashboard.js"></script>
@stop
