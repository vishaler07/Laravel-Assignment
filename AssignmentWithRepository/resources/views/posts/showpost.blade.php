@extends('layouts.app')
@extends('layouts.sidebar')
@section('content')
<div style="margin-left:350px;">
<a href="/admin/posts">Go back</a>

<h3>{{$posts->title}}</h3>
<h4>{{$posts->body}}</h4>
<br>
<br>

@if(!Auth::guest())
    {{-- @if(Auth::user()->id==$post->user_id) --}}
    @if($is_admin==true)
        <a href="/posts/{{$posts->id}}/edit">Edit</a><br>
        {!!Form::open(['action' => ['\App\Http\Controllers\PostsController@destroy', $posts->id], 'method' => 'POST'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete')}}
        {!!Form::close()!!}
    @endif
@endif
</div>
@endsection