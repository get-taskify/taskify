@extends('layouts.app')

@section('content')

    <h1>device_default_task Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('device_default_task.create') }}">Add new</a>
    <div class="card mb-4">
        <div class="card-header">device_default_task</div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th style="border: solid 3px black">finished</th>
                        <th style="border: solid 3px black">repair_object_id</th>
                        <th style="border: solid 3px black">default_task_id</th>
                        <th style="border: solid 3px black">Created at</th>
                        <th style="border: solid 3px black">Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($device_default_tasks as $device_default_task)

                        <tr>
                            <td style="border: solid 3px black">{{ $device_default_task->finished }}</td>
                            <td style="border: solid 3px black">{{ $device_default_task->repair_object_id }}</td>
                            <td style="border: solid 3px black">{{ $device_default_task->default_task_id }}</td>
                            <td style="border: solid 3px black">{{ $device_default_task->created_at }}</td>
                            <td style="border: solid 3px black">{{ $device_default_task->updated_at }}</td>
                            <td style="border: solid 3px black"><a href="{{ URL::route('device_default_task.edit', $device_default_task) }}">Edit</a></td>
                            <td style="border: solid 3px black">
                                <form method="POST" action="{{ route('device_default_task.destroy', $device_default_task) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
