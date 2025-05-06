<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Griya Astuti</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <!-- jQuery (dibutuhkan oleh DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body class="bg-base-200 min-h-screen font-sans">
    <x-theme-toggle></x-theme-toggle>
    {{ $slot }}
    <!-- DataTables JS + CSS -->
</body>

</html>
