@extends('layouts.app')
@section('content')
<h1>Create Post</h1>
{!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
    {{Form::label('title','Title')}}
    {{Form::text('title','', ['class' => 'form-control','placeholder'=>'Title'])}}

{!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST']) !!}
    {{Form::label('body','Body')}}
    {{Form::textarea('body','', ['class' => 'form-control','placeholder'=>'Body Text'])}}
    {{Form::file('cover_image')}}
    <br><br>
    {{Form::submit('Submit')}}
{!! Form::close() !!}
@endsection