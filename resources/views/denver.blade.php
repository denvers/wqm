<table>
    <thead>
    <tr>
        <th>URL</th>
        <th>HTTP</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($links as $url => $link)
    <tr>
        <td>{{ $url }}</td>
        <td>{{ @ $link['status_code'] }}</td>
    </tr>
    @endforeach
    </tbody>
</table>