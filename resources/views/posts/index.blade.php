@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">
                Posts
                <a href="{{route('posts.create')}}" class="btn btn-outline-info float-right mt-5">Add new post</a>
            </h1>
            @include('partials.flash-messages')
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td>Details</td>
                    <td>Edit</td>
                    <td >Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{\Illuminate\Support\Str::limit($post->details, 100)}}</td>
                        <td>
                            <a href="{{ route('posts.edit',$post->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td>
                            <a href="{{ route('posts.show',$post->id)}}" class="btn btn-primary btn-sm">Show</a>
                            <form action="{{ route('posts.destroy', $post->id)}}" method="post" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
        </div>
@endsection
