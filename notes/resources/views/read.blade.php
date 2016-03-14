@extends('layout')

@section('head')
  <link rel="stylesheet" type="text/css" href="/css/read.css">
@stop

@section('header')
@include('welcome')
@stop

@section('content')
  <div class='note-view well'>
    <h3 class='note-title'>{{ $note->title }}</h3>
    <div class='note-body'>{{ $note->body }}</div>
    <div class='author-info'>(This note {{ $note->author_info }})<span class='modifier-options'><a href='/dashboard' class='btn btn-primary'>Back</a><a id='edit-note' href='/note/{{ $note->id }}/edit' class='btn btn-primary'>Edit</a><button id='delete-note' data-note-id='{{ $note->id }}' class='btn btn-danger'>Delete</button></span></div>
    <div style='clear:both'></div>
  </div>
@stop

@section('footer')
<script src="/js/read.js"></script>
@stop
