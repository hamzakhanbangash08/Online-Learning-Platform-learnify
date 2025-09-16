

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
# Congratulations, {{ $certificate->user->name }} 🎉

You have successfully passed the quiz **{{ $certificate->quiz->title }}**.

Please find your certificate attached.

Thanks,<br>
{{ config('app.name') }}
</body>
</html>
