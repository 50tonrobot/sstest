@extends('layout')
@section('header')
<h3>Login</h3>
@stop
@section('content')
<form id='login_form' class='login' action='/login' method='post' role="form">
  <div class='form-group well well-sm col-md-6 col-md-offset-3'>
    <div><input class='login_input required form-control' type='text' name='email' value='' placeholder='Email'/></div>
    <div><input class='login_input form-control' type='password' name='password' value='' placeholder='Password'/></div>
    <div><button class='btn btn-primary' type='submit'>Sign In</button></div>
  </div>
</form>
@if (!empty($errors)) 
  <div class="alert alert-warning col-md-6 col-md-offset-3">
    <h4>Error:</h4>
@foreach ($errors as $error)
    <div>{{ $error }}</div>
@endforeach
  </div>
@endif
@stop