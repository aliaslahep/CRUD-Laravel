<html>
<head>
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header, .footer {
            text-align: center;
        }
        .content {
            margin-top: 20px;
        }
        .details {
            width: 100%;
            border-collapse: collapse;
        }
        .details th, .details td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="flex justify-around">
                <img src="C:\xaa\htdocs\laravel\public\storage\images\at0vvOaq2zFl9CiqgHvaEedoBHd24UGgYwPe9Kz1.jpg" width="100" height="100">
                <h1>Access Log</h1>
            </div>
            <table class="details">
                <tr>
                    <th>IP Address</th>
                    <th>Username</th>
                    <th>URL</th>
                    <th>Access Log</th>
                </tr>

                @foreach($access_logs as $access_log)
                    <tr>
                        <td>{{ $access_log->ip_address }}</td>
                        <td>{{ $access_log->name }}</td>
                        <td>{{ $access_log->url }}</td>
                        <td>{{ date("d/m/Y h:i a",strtotime($access_log->access_log)) }}</td>
                    </tr>
                    @endforeach
            </table>
        </div>

    </div>
</body>
</html>