<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activity Logs</title>
</head>
<body>
    <h4>Activity Logs (Last 24 Hours)</h4>
    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead style="background-color: #f0f0f0;">
            <tr>
                <th>User</th>
                <th>Role</th>
                <th>Action</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->username }}</td>
                <td>{{ $log->role }}</td>
                <td>{{ ucfirst($log->action) }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
