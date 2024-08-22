
    <h1>Table Data</h1>
    <table>
        <thead>
            <tr>
                @foreach($tableData['fields'] as $field)
                    <th>{{ $field['name'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($tableData['results'] as $row)
                <tr>
                    @foreach($tableData['fields'] as $field)
                        <td>{{ $row[$field['name']] }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
