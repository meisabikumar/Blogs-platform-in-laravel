@extends('layouts.app')

@section('content')
<div class="jumbotron text-centre">
    {{-- <h3>{{$title}}</h3> --}}
<h1>Welcome to Laravel index</h1>  
<p>this is laravel application youtube </p>
<p><a class="btn btn-primary btn-lg" href="/login" role="button">login</a>  <a class="btn btn-success btn-lg" href="/register" role="button">register</a> </p>
</div>
@endsection

