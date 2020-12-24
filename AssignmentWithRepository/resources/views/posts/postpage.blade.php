@extends('layouts.app')

@section('content')
@if($is_admin==true)
    


    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="max-width:210px;">

        <div class="fa-2x pl-3 font-weight-bold " style="color: #ffffff";>Admin Block</div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a class= href="#" class="d-block">Admin</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="/admin/home" class="nav-link " id="dashboard_active">
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="/admin/posts" class="nav-link " id="post_active">
                            <p>
                                Posts
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <a href="/posts/create" style="float:right; padding:30px">Create Post</a>
@endif

@if(count($posts)>0)

    <table class="table" style="float:right; max-width:900px;">
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
            @if($is_admin==true)
                <td><a href="/posts/{{$post->id}}/edit">Edit</a><br><a href="/posts/{{$post->id}}">Delete</a></td>
            @endif
        </tr>


    
    @endforeach

    </tbody>
    </table>

@else
    <center><h3>You have no posts.</h3></center>

@endif
@endsection