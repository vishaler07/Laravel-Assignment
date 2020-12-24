@extends('layouts.app')
@extends('layouts.sidebar')
@section('content')
<center><h1>Create Post</h1></center>
<div style="margin-left:350px; max-width:700px;">
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
</div>
@endsection