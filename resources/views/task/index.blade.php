@extends('layouts.app')


@section('content')

    <h1>Task Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('task.create') }}">Add new</a>
    <br />
    <a href="{{URL::route('task.history')}}">History</a>
    <div class="card mb-4 text-dark">
        <div class="card-header">Tasks</div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th style="border: solid 3px black">Text</th>
                        <th style="border: solid 3px black">Finished</th>
                        <th style="border: solid 3px black">Repair Object</th>
                        <th style="border: solid 3px black">done_by_user_id</th>
                        <th style="border: solid 3px black">Created at</th>
                        <th style="border: solid 3px black">Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)

                        <tr>
                            <td style="border: solid 3px black">{{ $task->text }}</td>
                            <td style="border: solid 3px black">{{ $task->finished }}</td>
                            <td style="border: solid 3px black">{{ $task->repair_object_id }}</td>
                            <td style="border: solid 3px black">{{ $task->done_by_user_id }}</td>
                            <td style="border: solid 3px black">{{ $task->created_at }}</td>
                            <td style="border: solid 3px black">{{ $task->updated_at }}</td>
                            <td style="border: solid 3px black"><a href="{{ URL::route('task.edit', $task) }}">Edit</a></td>
                            <td style="border: solid 3px black">
                                <form method="POST" action="{{ route('task.destroy', $task) }}">
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
