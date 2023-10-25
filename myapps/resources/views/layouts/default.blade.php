<!doctype HTML>
<html lang="en">
<head>
    @yield('header')
</head>
<body>
    @yield('navbar')
    <div id="pageWrapper" class="en-creative pageWrapper clearfix">
        <div class="contentWrapper">
            @yield('content')
        </div>
    </div>
    @yield('footer')
</body>
</html>