<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'R-Integra')</title>
    <meta name="description" content="@yield('description', '')">

    <!-- SEO Meta Tags -->
    <meta property="og:title" content="@yield('title', 'R-Integra')">
    <meta property="og:description" content="@yield('description', '')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">

    <!-- Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Lato', 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
            padding-top: 70px; /* Space for fixed header */
        }
        .page-container {
            width: 100%;
            margin: 0 auto;
        }
        .page-content {
            width: 100%;
        }
        .content-block {
            width: 100%;
        }
        .main-content {
            min-height: calc(100vh - 70px);
        }
    </style>

    @stack('styles')
</head>
<body>
    @include('components.header')

    <main class="main-content">
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
</body>
</html>
