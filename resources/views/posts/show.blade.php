@extends('layouts.app')
@section('content')
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">{{ $post->title }}</h1>
            <p>
                {!!  $post->details !!}
            </p>

        </div>
    </div>
@endsection
