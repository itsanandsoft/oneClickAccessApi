<!DOCTYPE html>
<head>
    @include('admin.layouts.partial.head')
    @stack('cs')
</head>
<body class="body-bg">
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- main wrapper start -->
    <div class="horizontal-main-wrapper">
        @include('admin.layouts.partial.header')
        @include('admin.layouts.partial.sidebartop')
        @yield('content')
    @include('admin.layouts.partial.footer')

<script>

</script>

@include('admin.layouts.partial.script')
<script>

</script>

@stack('js')
<script>
    // $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>

</div>
</body>

</html>
