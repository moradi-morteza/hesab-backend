<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::user()->id }}">

    <title><?= config('app.name') ?></title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu"/>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('template/assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('template/assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('template/assets/img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('template/assets/img/favicons/favicon.ico')}}">
    <link rel="manifest" href="{{asset('template/assets/img/favicons/manifest.json')}}">

    <meta name="msapplication-TileImage" content="{{asset('template/assets/img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{asset('template/assets/js/config.js')}}"></script>
    <script src="{{asset('template/vendors/overlayscrollbars/OverlayScrollbars.min.js')}}"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{asset('template/vendors/overlayscrollbars/OverlayScrollbars.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/assets/css/theme-rtl.min.css')}}" rel="stylesheet" id="style-rtl">
    <link href="{{asset('template/assets/css/theme.min.css')}}" rel="stylesheet" id="style-default">
    <link href="{{asset('template/assets/css/user-rtl.min.css')}}" rel="stylesheet" id="user-style-rtl">
    <link href="{{asset('template/assets/css/user.min.css')}}" rel="stylesheet" id="user-style-default">
    <link href="{{asset('css/iranyekan.css')}}" rel="stylesheet">
    <link href="{{asset('template/assets/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('template/assets/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('css/persiandatepicker.min.css')}}" rel="stylesheet">
    <script>
        // manage rtl
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');

    </script>

</head>

<body>

<main class="main" id="app">
    <div class="container" data-layout="container">
        {{--Right Menu--}}
        <nav class="navbar navbar-light navbar-vertical navbar-expand-xl  navbar-card">
            <div class="d-flex align-items-center">
                <div class="toggle-icon-wrapper">

                    <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                            data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                                class="toggle-line"></span></span></button>

                </div>
                <router-link class="navbar-brand" to="/home">
                    <div class="d-flex align-items-center py-3">
                        <span class="font-sans-serif">RSA</span>
                    </div>
                </router-link>
            </div>
            {{-- menu container --}}
            <div class="collapse navbar-collapse" style="margin-top: -1.6px!important;" id="navbarVerticalCollapse">
                <div class="navbar-vertical-content scrollbar">
                    <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                        <router-link class="nav-link" to="/app/home" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon">
                                    <span class="fas fa-chart-pie"></span>
                                </span><span class="nav-link-text ps-1">داشبورد</span>
                            </div>
                        </router-link>
                        <li class="nav-item">
                            @can('see users')
                                <router-link class="nav-link" to="/staff" role="button" aria-expanded="false">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                class="fas fa-users"></span></span><span class="nav-link-text ps-1">کارکنان</span>
                                    </div>
                                </router-link>
                            @endcan
                            @can('see roles')
                                <router-link class="nav-link" to="/roles" role="button" aria-expanded="false">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                class="fas fa-user-tag"></span></span><span
                                            class="nav-link-text ps-1">نقش ها</span>
                                    </div>
                                </router-link>
                            @endcan
                            @can('see orders')
                                <router-link class="nav-link" to="/orders" role="button" aria-expanded="false">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                class="fas fa-folder"></span></span><span
                                            class="nav-link-text ps-1">سفارشات</span>
                                    </div>
                                </router-link>
                            @endcan
                            @canany('see system logs')
                                <router-link class="nav-link" to="/logs" role="button" aria-expanded="false">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                class="fas fa-history"></span></span>
                                        <span class="nav-link-text ps-1">لاگ سیستم</span>
                                    </div>
                                </router-link>
                            @endcanany
                            @canany('see requirements')
                                <router-link class="nav-link" to="/requirement" role="button"
                                             aria-expanded="false">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                class="fas fa-comment"></span></span><span
                                            class="nav-link-text ps-1">نیازمندی ها</span>
                                    </div>
                                </router-link>
                            @endcanany
                            @canany('see store')
                                <router-link class="nav-link" to="/store" role="button" aria-expanded="false">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                class="fas fa-boxes"></span></span><span class="nav-link-text ps-1">انبار</span>
                                    </div>
                                </router-link>
                            @endcanany
                            @canany('see repairman task')
                                <router-link class="nav-link" to="/repairman-task" role="button" aria-expanded="false">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                class="fas fa-list"></span></span><span class="nav-link-text ps-1">کارها</span>
                                    </div>
                                </router-link>
                            @endcanany

{{--                            @role('admin')--}}
                                    <router-link class="nav-link" to="/setting" role="button" aria-expanded="false">
                                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                    class="fas fa-cog"></span></span><span class="nav-link-text ps-1">تنظیمات</span>
                                        </div>
                                    </router-link>
{{--                            @endrole--}}

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{--Main Content--}}
        <div class="content">
            <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
                {{--toggle button in mobile mode --}}
                <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                        aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
                    <span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
                {{-- logo in mobile mode --}}

                {{-- search panel--}}
                {{--user menu--}}
                <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                    {{--                    <li class="nav-item">--}}
                    {{--                        <div class="theme-control-toggle fa-icon-wait px-2">--}}
                    {{--                            <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"--}}
                    {{--                                   type="checkbox" data-theme-control="theme" value="dark"/>--}}
                    {{--                            <label class="mb-0 theme-control-toggle-label theme-control-toggle-light"--}}
                    {{--                                   for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"--}}
                    {{--                                   title="Switch to light theme"><span class="fas fa-sun fs-0"></span></label>--}}
                    {{--                            <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark"--}}
                    {{--                                   for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"--}}
                    {{--                                   title="Switch to dark theme"><span class="fas fa-moon fs-0"></span></label>--}}
                    {{--                        </div>--}}
                    {{--                    </li>--}}
                    <li class="nav-item">
                        <div class="theme-control-toggle d-none d-lg-block fa-icon-wait px-2">
                            {{jdate(' l j F Y ')}}
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link pe-0" id="navbarDropdownUser" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-xl">
                                <img class="rounded-circle" src="{{Auth::user()->getAvatarUrlAttribute()}}" alt=""/>

                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                            <div class="bg-white dark__bg-1000 rounded-2 py-2">

                                <span class="dropdown-item"><span>{{Auth::user()->full_name}}</span></span>
{{--                                <span class="dropdown-item red"><span>{{Auth::user()->roles[0]->fa_name}}</span></span>--}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    خروج
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      class="d-none">@csrf</form>


                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            <div>
                <router-view></router-view>
                <vue-progress-bar></vue-progress-bar>
            </div>
            <footer class="footer">
                <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
                    <div class="col-12 col-sm-auto text-center ltr">
                        <p class="mb-0 text-600">Design SinanCode <span
                                class="d-none d-sm-inline-block">| </span><br class="d-sm-none"/> All Rights Reserved
                        </p>
                    </div>
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-600">R.S.A</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</main>


<script>
    var site_url = '{{config('app.url')}}';
    var site_lang = 'fa_IR';
    var site_direction = 'rtl';
</script>
<script src="{{config('app.url')."/api/js/lang.js?v=".time()}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{ asset('js/vue-pagination-2.js') }}"></script>
<script type="text/javascript">
    window._asset = '{{ asset('') }}';
    window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
{{--        jsPermissions: {!! auth()->check()?auth()->user()->jsPermissions():0 !!}--}}
    }
    // console.log(Laravel.jsPermissions)
</script>
<script src="{{asset('js/persian-date.min.js')}}"></script>
<script src="{{asset('js/persian-datepicker.min.js')}}"></script>
<script src="{{asset('js/vues.js')}}"></script>
<script src="{{asset('template/vendors/popper/popper.min.js')}}"></script>
<script src="{{asset('template/vendors/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('template/vendors/anchorjs/anchor.min.js')}}"></script>
<script src="{{asset('template/vendors/is/is.min.js')}}"></script>
<script src="{{asset('template/vendors/chart/chart.min.js')}}"></script>
<script src="{{asset('template/vendors/countup/countUp.umd.js')}}"></script>
<script src="{{asset('template/vendors/echarts/echarts.min.js')}}"></script>
<script src="{{asset('template/vendors/fontawesome/all.min.js')}}"></script>
<script src="{{asset('template/vendors/lodash/lodash.min.js')}}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="{{asset('template/vendors/list.js/list.min.js')}}"></script>
<script src="{{asset('template/assets/js/theme.js')}}"></script>










</body>

</html>
