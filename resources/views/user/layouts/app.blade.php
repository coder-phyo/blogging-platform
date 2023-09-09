<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>@yield('postTitle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <link rel="shortcut icon" href="{{ asset('user/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('user/images/favicon.png') }}" type="image/x-icon">

    <!-- theme meta -->
    <meta name="theme-name" content="reporter" />

    <!-- # Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="{{ asset('user/plugins/bootstrap/bootstrap.min.css') }}">
    @stack('stylesheet')

    <!-- # Main Style Sheet -->
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">

</head>

<body>

    @include('user.layouts.inc.header')

    <main>
        <section class="section">
            <div class="container">
                @yield('content')
            </div>
        </section>
    </main>

    @include('user.layouts.inc.footer')


    <!-- # JS Plugins -->
    <script src="{{ asset('user/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('user/plugins/bootstrap/bootstrap.min.js') }}"></script>
    @stack('scripts')

    <!-- Main Script -->
    <script src="{{ asset('user/js/script.js') }}"></script>

</body>

</html>
