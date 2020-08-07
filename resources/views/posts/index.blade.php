@extends('layouts.app')

@section('content')

{{-- {{$cover_images = json_decode($post->cover_image)}} --}}


    <h1>posts</h1>
    
    @if (count($posts)>0)
        @foreach ($posts as $post)

        
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <h1></h1>
                        {{-- <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="no image"> --}}
                        
                        
                       

                       @foreach(json_decode($post->cover_image, true) as $value)                            
                         <img style="width:200px;" src="/storage/cover_images/{{ $value }}" alt="no image">
                    @endforeach                        
                        
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                </div>
               
            </div>
            
        @endforeach
        {{$posts->links()}}

        
    @else
        <p>No post found</p>
    @endif
@endsection
