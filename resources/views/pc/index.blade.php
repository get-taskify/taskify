@extends('layouts.app')

@section('content')

    <h1>Pc Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('pc.create') }}">Add new</a>
    <div class="card mb-4">
        <div class="card-header">Pcs</div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th style="border: solid 3px black">brand</th>
                        <th style="border: solid 3px black">cpu</th>
                        <th style="border: solid 3px black">ram</th>
                        <th style="border: solid 3px black">storage</th>
                        <th style="border: solid 3px black">architecture</th>
                        <th style="border: solid 3px black">bios_key</th>
                        <th style="border: solid 3px black">pc_type</th>
                        <th style="border: solid 3px black">system_language</th>
                        <th style="border: solid 3px black">Created at</th>
                        <th style="border: solid 3px black">Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pcs as $pc)

                        <tr>
                            <td style="border: solid 3px black">{{ $pc->brand }}</td>
                            <td style="border: solid 3px black">{{ $pc->cpu }}</td>
                            <td style="border: solid 3px black">{{ $pc->ram }}</td>
                            <td style="border: solid 3px black">{{ $pc->storage }}</td>
                            <td style="border: solid 3px black">{{ $pc->architecture }}</td>
                            <td style="border: solid 3px black">{{ $pc->bios_key }}</td>
                            <td style="border: solid 3px black">{{ $pc->pc_type }}</td>
                            <td style="border: solid 3px black">{{ $pc->system_language }}</td>
                            <td style="border: solid 3px black">{{ $pc->created_at }}</td>
                            <td style="border: solid 3px black">{{ $pc->updated_at }}</td>
                            <td style="border: solid 3px black"><a href="{{ URL::route('pc.edit', $pc) }}">Edit</a></td>
                            <td style="border: solid 3px black">
                                <form method="POST" action="{{ route('pc.destroy', $pc) }}">
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
