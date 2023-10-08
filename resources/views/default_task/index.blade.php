@extends('layouts.app')

@section('content')

    <h1>Default_task Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('default_task.create') }}">Add new</a>
    <div class="card mb-4">
        <div class="card-header">Default_task</div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th style="border: solid 3px black">device_type</th>
                        <th style="border: solid 3px black">text</th>
                        <th style="border: solid 3px black">done_by_user</th>
                        <th style="border: solid 3px black">Created at</th>
                        <th style="border: solid 3px black">Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($default_tasks as $default_task)

                        <tr>
                            <td style="border: solid 3px black">{{ $default_task->device_type }}</td>
                            <td style="border: solid 3px black">{{ $default_task->text }}</td>
                            <td style="border: solid 3px black">{{ $default_task->done_by_user_id }}</td>
                            <td style="border: solid 3px black">{{ $default_task->created_at }}</td>
                            <td style="border: solid 3px black">{{ $default_task->updated_at }}</td>
                            <td style="border: solid 3px black"><a href="{{ URL::route('default_task.edit', $default_task) }}">Edit</a></td>
                            <td style="border: solid 3px black">
                                <form method="POST" action="{{ route('default_task.destroy', $default_task) }}">
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
