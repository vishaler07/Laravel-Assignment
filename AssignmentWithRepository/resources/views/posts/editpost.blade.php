@extends('layouts.app')
@extends('layouts.sidebar')
@section('content')
<p style="margin-top:0px;"><strong><center>Edit Post</center></strong></p>
@if($post->cover_image!='noimage.jpg')
    <img style="width:17%; height:17% margin:auto; margin-left:800px;" src="/storage/cover_images/{{$post->cover_image}}"><br><br>
@endif
<div style="margin-left:350px; max-width:700px;">
{!! Form::open(['action' => ['App\Http\Controllers\PostsController@update',$post->id], 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
    {{Form::label('title','Title')}}
    {{Form::text('title',$post->title, ['class' => 'form-control','placeholder'=>'Title'])}}

{!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST']) !!}
    {{Form::label('body','Body')}}
    {{Form::textarea('body',$post->body, ['class' => 'form-control','placeholder'=>'Body Text'])}}
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit')}}
{!! Form::close() !!}
</div>
@endsection