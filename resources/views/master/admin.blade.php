<!DOCTYPE html>

    <html class="light-style layout-wide customizer-hide" data-assets-path="/admin/assets/" data-template="vertical-menu-template" data-theme="theme-default" dir="rtl" lang="fa">


<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
        name="viewport" />
<title>
    نرم افزار  حسابداری گاما
</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="description" />

    <link href="/logo/Component 1.svg" rel="icon" sizes="128x128" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset("admin/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/css/font-awesome.css") }}">
    <link rel="stylesheet" href="css/font-awesome.css">
    <script src="{{ asset('/js/jquery.js') }}"></script>



    @vite('resources/css/app.css')
</head>

<body>

    @yield('login')

    @if (Request::url() != route('admin.login'))
    <div id="" class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @includeWhen(empty($sidebar), 'admin.section.sidebar')
            <div class="layout-page">
                @includeWhen(empty($navbar), 'admin.section.navbar')
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endif



    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/admin/libs/persian-date.js"></script>
    <script src="/admin/libs/persian-datepicker.js"></script>
    <script src="/admin/libs/modal-loading.js"></script>
    <script src="/admin/libs/persian_number.js"></script>
    <script src="/admin/libs/select2/select2.js"></script>
    <script src="/admin/js/tooltipster.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite('resources/js/app.js')

    @yield('script')
</body>
@include('sweetalert::alert')

</html>
