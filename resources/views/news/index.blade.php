@extends('layouts.app')

@section('content')

    <h1>News Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('news.create') }}">Add new</a>
    <div class="card mb-4">
        <div class="card-header">News</div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th style="border: solid 3px black">Text</th>
                        <th style="border: solid 3px black">User_id</th>
                        <th style="border: solid 3px black">Created at</th>
                        <th style="border: solid 3px black">Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $singlenews)

                        <tr>
                            <td style="border: solid 3px black">{{ $singlenews->text }}</td>
                            <td style="border: solid 3px black">{{ $singlenews->user_id }}</td>
                            <td style="border: solid 3px black">{{ $singlenews->created_at }}</td>
                            <td style="border: solid 3px black">{{ $singlenews->updated_at }}</td>
                            <td style="border: solid 3px black"><a href="{{ URL::route('news.edit', $singlenews) }}">Edit</a></td>
                            <td style="border: solid 3px black">
                                <form method="POST" action="{{ route('news.destroy', $singlenews) }}">
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
