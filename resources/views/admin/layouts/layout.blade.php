<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="theme_ocean">

    <title>JTI Surat - @yield('title')</title>
    @include('admin.layouts.styles')
    @stack('styles')
</head>

<body>
    <nav class="nxl-navigation">
        @include('admin.layouts.sidebar')
    </nav>

    <header class="nxl-header">
        @include('admin.layouts.header')
    </header>

    <main class="nxl-container">
        @yield('content')
        <footer class="footer">
            <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
                <span>Copyright ©</span> 2026
                <!-- <script>
                    document.write(new Date().getFullYear());
                </script> -->
            </p>
            <p><span>By: <a target="_blank" href="https://jti.polije.ac.id/" target="_blank">JTI Polije</a></span> • <span>All Rights Reserved</span></p>
        </footer>
    </main>

    @include('admin.layouts.scripts')
    @stack('scripts')
</body>

</html>