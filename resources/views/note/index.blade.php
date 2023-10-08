@extends('layouts.app')

@section('content')

    <h1>note Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('note.create') }}">Add new</a>
    <div class="card mb-4">
        <div class="card-header">notes</div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th style="border: solid 3px black">user_id</th>
                        <th style="border: solid 3px black">text</th>
                        <th style="border: solid 3px black">Created at</th>
                        <th style="border: solid 3px black">Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notes as $note)

                        <tr>
                            <td style="border: solid 3px black">{{ $note->user_id }}</td>
                            <td style="border: solid 3px black">{{ $note->text }}</td>
                            <td style="border: solid 3px black">{{ $note->created_at }}</td>
                            <td style="border: solid 3px black">{{ $note->updated_at }}</td>
                            <td style="border: solid 3px black"><a href="{{ URL::route('note.edit', $note) }}">Edit</a></td>
                            <td style="border: solid 3px black">
                                <form method="POST" action="{{ route('note.destroy', $note) }}">
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
