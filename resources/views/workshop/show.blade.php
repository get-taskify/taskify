
<h1>{{$workshop->name}}</h1>
<p>Address: {{$workshop->address}}</p>
<p>Created ad: {{$workshop->created_at}}</p>
<p>Last Update: {{$workshop->updated_at}}</p>
<p><a href="{{URL::Route('assignment.index', ['workshop' => $workshop->id])}}">Assignments</a></p>
