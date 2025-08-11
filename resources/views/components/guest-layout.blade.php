<!-- resources/views/components/guest-layout.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
    {{ $slot }}
</body>

</html>
