@extends('layout')

@section('header')
@include('welcome')
@stop

@section('content')
<div class='note-form form-group well'>
  <form method='post' action='/note/{{ $note->id }}/edit'>
    <input type='hidden' name='_method' value='PATCH'/>
    <input name='title' type='text' class='form-control' placeholder='Title' value='{{ $note->title }}' />
    <textarea name='body' class='form-control' placeholder='Body'>{{ $note->body }}</textarea>
    <button class='btn btn-primary' type='submit'>Update Note</button>
    <a class='btn btn-primary' href='/note/{{ $note->id }}'>Cancel</a>
  </form>
</div>
@if (!empty($errors)) 
  <div class="alert alert-warning">
    <h4>Error:</h4>
@foreach ($errors as $error)
    <div>{{ $error }}</div>
@endforeach
  </div>
@endif
@stop