@extends('layouts.app')

@section('content')
    <h3>{{$title}}</h3>
    <h1>Welcome to Laravel Services</h1>   

    @if (count($services)>0)
        <ul class="list-group">
            @foreach ($services as $service)
            <li class="list-group-item">{{$service}}</li>            
            @endforeach
        </ul>     
    @endif
@endsection

