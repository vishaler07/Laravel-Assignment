@extends('layouts.app')
@section('content')
<h1>Edit Post</h1>
<img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}"><br><br>
{!! Form::open(['action' => ['App\Http\Controllers\PostsController@update',$post->id], 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
    {{Form::label('title','Title')}}
    {{Form::text('title',$post->title, ['class' => 'form-control','placeholder'=>'Title'])}}

{!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST']) !!}
    {{Form::label('body','Body')}}
    {{Form::textarea('body',$post->body, ['class' => 'form-control','placeholder'=>'Body Text'])}}
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit')}}
{!! Form::close() !!}
@endsection