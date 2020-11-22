@extends('layouts.app')
@section('content')
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Update a post</h1>
            @include('partials.errors')
            <form method="post" action="{{ route('posts.update', $post->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="first_name">Title:</label>
                    <input type="text" class="form-control" name="title" value={{ $post->title }} />
                </div>
                <div class="form-group">
                    <label for="last_name">Details:</label>
                    <textarea class="form-control" name="details" rows="5">{{ $post->details }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
