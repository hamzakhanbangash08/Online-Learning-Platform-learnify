<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>All Certificates Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #f4f4f4; }
    </style>
</head>
<body>
    <h2>📊 Certificates Report (All Users)</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Quiz</th>
                <th>Course</th>
                <th>Issued At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($certificates as $cert)
                <tr>
                    <td>{{ $cert->user->name }}</td>
                    <td>{{ $cert->quiz->title }}</td>
                    <td>{{ $cert->quiz->course->title ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($cert->issued_at)->format('d M, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
