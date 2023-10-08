@extends('layouts.app')

@section('title', 'Edit Workshop')

@section('content')

    <h1>Workshop Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <form method="POST" action="{{ route('workshop.update', $workshop) }}">
        @method('PUT')
        @csrf
        <span>Name:</span>
        <input type="text" name="name" value="{{ $workshop->name }}" />
        <br/>
        <span>Address:</span>
        <input type="text" name="address" value="{{ $workshop->address }}" />

        <button type="submit">Save</button>
    </form>

@endsection
