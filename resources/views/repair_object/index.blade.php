@extends('layouts.app')

@section('content')

    <h1>repair_object Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('repair_object.create') }}">Add new</a>
    <div class="card mb-4">
        <div class="card-header">repair_objects</div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th style="border: solid 3px black">Name</th>
                        <th style="border: solid 3px black">Created at</th>
                        <th style="border: solid 3px black">Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($repair_objects as $repair_object)

                        <tr>
                            <td style="border: solid 3px black">{{ $repair_object->name }}</td>
                            <td style="border: solid 3px black">{{ $repair_object->created_at }}</td>
                            <td style="border: solid 3px black">{{ $repair_object->updated_at }}</td>
                            <td style="border: solid 3px black"><a href="{{ URL::route('repair_object.edit', $repair_object) }}">Edit</a></td>
                            <td style="border: solid 3px black">
                                <form method="POST" action="{{ route('repair_object.destroy', $repair_object) }}">
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
