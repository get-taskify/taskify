@extends('layouts.app')

@section('content')

    <h1>user_role Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('user_role.create') }}">Add new</a>
    <div class="card mb-4">
        <div class="card-header">user_roles</div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th style="border: solid 3px black">role</th>
                        <th style="border: solid 3px black">user_id</th>
                        <th style="border: solid 3px black">Created at</th>
                        <th style="border: solid 3px black">Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user_roles as $user_role)

                        <tr>
                            <td style="border: solid 3px black">{{ $user_role->role }}</td>
                            <td style="border: solid 3px black">{{ $user_role->user_id }}</td>
                            <td style="border: solid 3px black">{{ $user_role->created_at }}</td>
                            <td style="border: solid 3px black">{{ $user_role->updated_at }}</td>
                            <td style="border: solid 3px black"><a href="{{ URL::route('user_role.edit', $user_role) }}">Edit</a></td>
                            <td style="border: solid 3px black">
                                <form method="POST" action="{{ route('user_role.destroy', $user_role) }}">
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
