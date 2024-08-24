

@section('content')
    <h1>Tables</h1>
    <ul>
        @foreach($tables as $table)
            <li><a href="{{ url('baserow/' . $table['id']) }}">{{ $table['name'] }}</a></li>
        @endforeach
    </ul>
@endsection
