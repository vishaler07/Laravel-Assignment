

@extends('layouts.app')

@section('content')

<a href="/posts/create">Create Post</a>

@if(count($posts)>0)

    <table class="table">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Body</th>
        <th scope="col">Options</th>
        </tr>
    </thead>
    <tbody>

    @foreach ($posts as $post)
        <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
            <td><a href="/posts/{{$post->id}}/edit">Edit</a><br><a href="/posts/{{$post->id}}">Delete</a></td>
        </tr>


    
    @endforeach

    </tbody>
    </table>

@else
    <center><h3>You have no posts.</h3></center>

@endif
@endsection