@extends('layouts.app')

@section('content')

    <h1>repair_object Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <form method="POST" action="{{ route('repair_object.update', $repair_object) }}">
        @method('PUT')
        @csrf
        <span>Name:</span>
        <input type="text" name="name" value="{{ $repair_object->name }}" />

        <button type="submit">Save</button>
    </form>

@endsection
