
@extends('layouts.app')

@section('content')
<tr>
    <td style="border: solid 3px black">{{ $repair_object->name }}</td>
    <td style="border: solid 3px black">{{ $repair_object->created_at }}</td>
    <td style="border: solid 3px black">{{ $repair_object->updated_at }}</td>
    <td style="border: solid 3px black"><a href="#">Edit</a></td>
    <td style="border: solid 3px black">
    </td>
</tr>
@endsection
