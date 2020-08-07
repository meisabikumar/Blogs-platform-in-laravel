@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    <a href="/posts/create" class="btn btn-primary">Create Post</a><hr>
                    <h3>Your Blogs Posts </h3>
                    @if (count($posts)>0)
                        <table class="table table-striped  table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                <tr>
                                    <td scope="row">{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                    <td>
                                        {!! Form::open(['action'=> ['PostController@destroy',$post->id],'method'=>'POST','class'=>'pull-right']) !!}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Delete',['class'=>'btn btn-danger']) }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>                            
                                @endforeach
                                
                            </tbody>
                        </table>
                    @else
                        <p>you have no posts</p>                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
