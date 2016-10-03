<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: top;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Website Quality Monitor - Monitors</h1>
    <p>This system checks websites on a daily basis and reports back his findings to you. Your websites will get better and better baby.</p>

    <hr>

    {{--<form action="" method="post">--}}
        {{--{{ csrf_field() }}--}}
        {{--<input type="text" name="url_to_monitor" placeholder="http://www.domain.com"> <input type="submit" value="Monitor this domain">--}}
    {{--</form>--}}

    <br>

    <table border="1" align="center" cellpadding="10">
        <tr>
            <th>URL</th>
            <th>Created at</th>
            <th>Checked at</th>
            <th>Failures</th>
        </tr>
        <tr>
            <td>{{ $monitor->url }}</td>
            <td>{{ $monitor->created_at }}</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <br>

    <hr>

    <br>

    <h2>Pages</h2>

    <table border="1" align="center" cellpadding="10">
        <tr>
            <th>URL</th>
            <th>Created at</th>
            <th>Checked at</th>
            <th>Failures</th>
        </tr>
        @foreach( $monitor->urls()->get() as $url )
        <tr>
            <td>{{ $url->url }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </table>

    <br>

    <hr>

    <br>

    <h2>Quality Checks</h2>

    <table border="1" align="center" cellpadding="10">
        <thead>
        <tr>
            <th>Name</th>
            <th>Result</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($quality_checks as $qc)
        <tr>
            <td>{{ $qc->name }}</td>
            <td>{{ $qc->result }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
