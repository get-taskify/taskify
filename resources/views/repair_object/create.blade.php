@extends('layouts.app')

@section('content')

    <h1>repair_object Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('repair_object.index') }}">repair_object</a>
    <br />
    <form method="POST" action="{{ route('repair_object.store') }}">
        @csrf
        <span>Name:</span>
        <input type="text" name="name" value="" />
        <br/>

        <button type="submit">Save</button>
    </form>

@endsection
