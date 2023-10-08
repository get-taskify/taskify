@extends('layouts.app')

@section('content')

    <h1>News Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <form method="POST" action="{{ route('news.update', $news) }}">
        @method('PUT')
        @csrf
        <span>Text:</span>
        <input type="text" name="text" value="{{ $news->text }}" />

        <button type="submit">Save</button>
    </form>

@endsection
