@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-dark">Go back</a>
    <h1>{{$post->title}}</h1>
    {{-- {{$post->cover_image}} --}}
    {{-- <img style="width:200px;" src="/storage/cover_images/{{$post->cover_image}}" alt="no image"> --}}
    
    @foreach(json_decode($post->cover_image, true) as $value)                         
        <img style="width:200px;" src="/storage/cover_images/{{ $value }}  " alt="no image">
    @endforeach

    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at }}  by {{$post->user->name}}</small>
    <hr>

    @if(!Auth::guest())
        @if (Auth::user()->id== $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>

            {!! Form::open(['action'=> ['PostController@destroy',$post->id],'method'=>'POST','class'=>'pull-right']) !!}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete',['class'=>'btn btn-danger']) }}
            {!! Form::close() !!}
                
        @endif
    @endif
@endsection
