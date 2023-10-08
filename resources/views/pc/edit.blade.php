@extends('layouts.app')

@section('content')

    <h1>Pc Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <form method="POST" action="{{ route('pc.update', $pc) }}">
        @method('PUT')
        @csrf
        <span>repair_object_id:</span>
        <input type="text" name="repair_object_id" value="{{ $pc->id }}" />
        <br/>
        <input type="text" name="brand" value="{{ $pc->brand }}" />
        <input type="text" name="cpu" value="{{ $pc->cpu }}" />
        <input type="number" name="ram" value="{{ $pc->ram }}" />
        <input type="number" name="storage" value="{{ $pc->storage }}" />
        <input type="text" name="architecture" value="{{ $pc->architecture }}" />
        <input type="text" name="bios_key" value="{{ $pc->bios_key }}" />
        <input type="number" name="pc_type" value="{{ $pc->pc_type }}" />
        <input type="text" name="system_language" value="{{ $pc->system_language }}" />

        <button type="submit">Save</button>
    </form>

@endsection
