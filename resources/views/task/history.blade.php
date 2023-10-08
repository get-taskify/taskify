@extends('layouts.app')

@section('content')

<style>
    table, td, th {
        border: 1px solid white;
    }
</style>

<h1>Task History</h1>
<table>
    <tr>
        <td>Text</td>
        <td>Repair Object</td>
        <td>User</td>
        <td>Operation</td>
        <td>Time</td>
    </tr>
    @foreach ($tasks as $task)
    <tr>
        <td>{{$task->text}}</td>
        <td><a href="{{ URL::Route('repair_object.index', [$task->repair_object_id]) }}">{{\App\Models\Repair_object::find($task->repair_object_id)->name}}</a></td>
        <td>{{\App\Models\User::find($task->done_by_user_id)->name}}</td>
        <td>{{$task->operation}}</td>
        <td>{{$task->historical_timestamp}}</td>
    </tr>
    @endforeach
</table>




@endsection
