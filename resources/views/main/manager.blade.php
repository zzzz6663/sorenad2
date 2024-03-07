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
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/libs/fontawesome-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/libs/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/libs/bootstrap-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/dashlite.rtl.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('/common/persian-datepicker.css') }}" />
    {{--  <link rel="stylesheet" href="{{ asset('/common/persiandate.css') }}" />  --}}
    {{--  <link rel="stylesheet" href="{{ asset('/admin/assets/css/theme.css') }}" />  --}}
    <link rel="stylesheet" href="{{ asset('/common/modal-loading.css') }}">
    {{--  <link id="skin-default" rel="stylesheet" href="./assets/css/theme.css" />  --}}
    {{--  @vite( 'resources/css/app.css')  --}}
    <script src="{{ asset('/site/js/jquery.js') }}"></script>
    @vite('resources/css/app.css')

    <style>
        .form-label {
            margin-top:5px;
            margin-bottom: 0;
        }

    </style>

</head>

@auth
<body class=" {{ auth()->user()->dark?"dark1-mode":"" }} has-rtl nk-body bg-lighter npc-default has-sidebar no-touch nk-nio-theme">
@endauth
@guest
<body class=" has-rtl nk-body bg-lighter npc-default has-sidebar no-touch nk-nio-theme">
@endguest
    <div class="nk-app-root">
        result_pay
        <div class="nk-main">
            @if (Request::is('admin/*') || Request::is('advertiser/*')|| Request::is('adviser/*')|| Request::is('customer/*'))
                @includeWhen(empty($sidebar), 'admin.section.sidebar')
                <div class="nk-wrap">
                    @includeWhen(empty($sidebar), 'admin.section.navbar')
                    <div class="nk-content">
                        <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                @yield('content')
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="nk-wrap nk-wrap-nosidebar">
                    <div class="nk-content">
                        @yield('empty')

                    </div>
                </div>
            @endif

        </div>

    </div>

    {{--  @if (Request::is('admin/*'))
        <div class="app align-content-stretch d-flex flex-wrap">

            <div class="app-container">
                <div class="app-content">
                    <div class="content-wrapper">
                        <div class="container-fluid">
                            @includeWhen(empty($header), 'admin.parts.header')
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
  --}}



  {{--  <script src="/admin/libs/persian-date.js"></script>
  <script src="/admin/libs/persian-datepicker.js"></script>  --}}
  {{--  <script src="{{ asset('/admin/libs/modal-loading.js') }}"></script>  --}}
  <script src="{{ asset('/common/select2.js') }}"></script>
  <script src="{{ asset('/common/persian_number.js') }}"></script>
  {{--  <script src="{{ asset('/common/persian-date.min.js') }}"></script>
  <script src="{{ asset('/common/persian-datepicker.min.js') }}"></script>  --}}
  {{--  <script src="{{ asset('/admin/libs/persian_number.js') }}"></script>  --}}
  {{--  <script src="{{ asset('/admin/libs/select2/select2.js') }}"></script>  --}}
  <script src="{{ asset('/site/libs/tooltipster.bundle.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/common/modal-loading.js') }}"></script>

  {{--  <script src="{{ asset('') }}"></script>  --}}

  {{--  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>  --}}
  {{--  <script src="{{ asset('/js/tooltipster.bundle.min.js') }}"></script>  --}}
    <script src="{{ asset('/admin/assets/js/bundle.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/scripts.js') }}"></script>
    {{--  <script src="{{ asset('/admin/js/charts/gd-campaign.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/persian-date.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/persian-datepicker.js') }}"></script>  --}}
    {{--  <script src="{{ asset('/home/js/jquery.mmenu.min.all.js') }}"></script>  --}}
    {{--  <script type="text/javascript" src="{{ asset('/common/tinymce/tinymce.min.js') }}"></script>  --}}
    {{--  <script src="{{ asset('/sadmins/') }}"></script>  --}}
    @vite( 'resources/js/app.js')






    {{--  <script src="{{ asset('/js/persian-date.js') }}"></script>
    <script src="{{ asset('/js/persian-datepicker.js') }}"></script>




    <script src="{{ asset('/js/persian_number.js') }}"></script>
    <script src="{{ asset('/js/tooltipster.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/modal-loading.js') }}"></script>
    <script src="{{ asset('/js/js.js') }}"></script>  --}}


    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

    @include('sweetalert::alert')
    @yield('script')
</body>

</html>
