@extends('layouts.app')

@section('content')

    <h1>Pc Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('pc.index') }}">Pcs</a>
    <br />
    <form method="POST" action="{{ route('pc.store') }}">
        @csrf
        <span>repair_object_id:</span>
        <input type="number" name="repair_object_id" value="" />
        <br/>
        <span>brand:</span>
        <input type="text" name="brand" value="" />
        <br/>
        <span>cpu:</span>
        <input type="text" name="cpu" value="" />
        <br/>
        <span>ram:</span>
        <input type="number" name="ram" value="" />
        <br/>
        <span>storage:</span>
        <input type="number" name="storage" value="" />
        <br/>
        <span>architecture:</span>
        <input type="text" name="architecture" value="" />
        <br/>
        <span>bios_key:</span>
        <input type="text" name="bios_key" value="" />
        <br/>
        <span>pc_type:</span>
        <input type="number" name="pc_type" value="" />
        <br/>
        <span>system_language:</span>
        <input type="text" name="system_language" value="" />
        <br/>

        <button type="submit">Save</button>
    </form>

@endsection
