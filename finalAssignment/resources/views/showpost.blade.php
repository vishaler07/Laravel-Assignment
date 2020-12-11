@extends('layouts.app')
@section('content')
<a href="/posts">Go back</a>
<h3>{{$post->title}}</h3>
<h4>{{$post->body}}</h4>
<br>
<br>

@if(!Auth::guest())
    @if(Auth::user()->id==$post->user_id)
        <a href="/posts/{{$post->id}}/edit">Edit</a><br>
        {!!Form::open(['action' => ['\App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete')}}
        {!!Form::close()!!}
    @endif
@endif
@endsection