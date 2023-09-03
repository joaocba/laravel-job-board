<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="canonical" href="#" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Portal</title>

    <meta name="X-DarkMode-Default" value="false" />

    <!-- Meta SEO -->
    <meta name="title" content="Job Seeker Portal">
    <meta name="description" content="This is an awesome job board page made with Laravel 10.">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="joaocba">

    <!-- Social media share -->
    <meta property="og:title" content="Job Seeker Portal">
    <meta property="og:site_name" content="Job Seeker Portal">
    <meta property="og:url" content="#">
    <meta property="og:description" content="This is an awesome job board page made with Laravel 10.">
    <meta property="og:type" content="">
    <meta property="og:image" content="#">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@joaocba" />
    <meta name="twitter:creator" content="@joaocba" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link href="{{ asset('assets/css/output.css') }}" rel="stylesheet">

    <!-- Import CSS including Tailwind CSS resources and AlpineJS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    <!-- Navigation Bar -->
    <x-header />

    <!-- Display Content -->
    {{ $slot }}
    <!-- End display Content -->

    <!-- Footer -->
    <x-footer />
    <!-- End footer -->

    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
</body>

</html>
