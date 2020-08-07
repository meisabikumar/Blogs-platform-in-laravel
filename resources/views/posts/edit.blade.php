@extends('layouts.app')

@section('content')
    <h1>edit posts</h1>
    {!! Form::open(['action' => ['PostController@update', $post->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title,['class'=>'form-control','placeholder'=>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
            {{-- {{Form::file('cover_image[]',['multiple'])}}            --}}

        </div>
        {{Form::hidden('_method', 'PUT') }}
        {{ Form::submit('submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
    
@endsection
