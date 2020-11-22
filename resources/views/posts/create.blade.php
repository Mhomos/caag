@extends('layouts.app')
@section('content')
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a post</h1>
            <div>
                @include('partials.errors')
                <form method="post" action="{{ route('posts.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">Title:</label>
                        <input type="text" class="form-control" name="title"/>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Details:</label>
                        <textarea class="form-control" name="details" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add post</button>
                </form>
            </div>
        </div>
    </div>
@endsection
