@extends('layouts.app')

@section('content')
    <h1>create posts</h1>
    {!! Form::open(['action' => 'PostController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '',['class'=>'form-control','placeholder'=>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body text'])}}
        </div>
        <div class="form-group">
            {{-- {{Form::file('cover_image')}} --}}
            {{Form::file('cover_image[]',['multiple'])}}           

        </div>
        {!! Form::submit('submit', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
    
@endsection
