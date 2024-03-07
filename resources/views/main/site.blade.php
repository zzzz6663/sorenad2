<!DOCTYPE html>
<html lang="fa" class="light-style layout-navbar-fixed layout-menu-fixed" dir="rtl" data-theme="theme-default"
    data-assets-path="/admin/assets/" data-template="vertical-menu-template-no-customizer">

<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <link rel="stylesheet" href="{{ asset('/common/modal-loading.css') }}">
    @vite('resources/css/app.css')
    <script src="{{ asset('/home/js/jq.js') }}"></script>
    {{--  <script src="{{ asset('/home/js/mmenu.js') }}"></script>  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.1.0/jquery.mmenu.all.js"></script>

</head>

<body class="">
    @yield('empty')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    @include('sweetalert::alert')
    @yield('script')
    <script src="{{ asset('/home/js/yadvin.js') }}"></script>
    <script src="{{ asset('/common/modal-loading.js') }}"></script>
    <script src="{{ asset('/common/cookie.js') }}"></script>
    <script src="{{ asset('/common/persian_number.js') }}"></script>

    <script src="{{ asset('/admin/assets/js/persian-date.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/persian-datepicker.js') }}"></script>

    {{--  <script src="{{ asset('/admin/') }}"></script>  --}}
    @vite('resources/js/app.js')






    {{--  <script src="{{ asset('/js/persian-date.js') }}"></script>
    <script src="{{ asset('/js/persian-datepicker.js') }}"></script>




    <script src="{{ asset('/js/persian_number.js') }}"></script>
    <script src="{{ asset('/js/tooltipster.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/modal-loading.js') }}"></script>
    <script src="{{ asset('/js/js.js') }}"></script>  --}}


    @yield('script')
</body>

</html>
