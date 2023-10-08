@extends('layouts.app')

@section('content')
<h1>Create News</h1>
<form method="POST" action="{{ route('news.store') }}">
    @csrf
    <textarea name="text" id="" cols="30" rows="10">

    </textarea>
    <p><input type="submit" value="Create"></p>
</form>


@endsection
