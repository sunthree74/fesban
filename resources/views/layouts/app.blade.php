
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/css/components-rounded.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('assets/layouts/layout2/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/layouts/layout2/css/themes/blue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('assets/layouts/layout2/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{ asset('uploaded/logo-muharram.jpeg') }}" />
        <!--jQuery-->
        <script src="{{ asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{url('/')}}">
                        <img src="{{ asset('uploaded/logo-muharram.jpeg') }}" width="50" height="50" alt="logo" style="margin: 10px 0px 0px 50px;" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- END TODO DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="{{ asset('uploaded/avatar.jpg')}}" />
                                    <span class="username username-hide-on-mobile"> {{Auth::user()->name}} </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    {{-- <li>
                                        <a href="page_user_profile_1.html">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li>
                                        <a href="app_calendar.html">
                                            <i class="icon-calendar"></i> My Calendar </a>
                                    </li>
                                    <li>
                                        <a href="app_inbox.html">
                                            <i class="icon-envelope-open"></i> My Inbox
                                            <span class="badge badge-danger"> 3 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="app_todo_2.html">
                                            <i class="icon-rocket"></i> My Tasks
                                            <span class="badge badge-success"> 7 </span>
                                        </a>
                                    </li>
                                    <li class="divider"> </li> --}}
                                    <li>
                                        <a href="{{url('ganti/password')}}">
                                            <i class="icon-lock"></i> Ganti Password </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="icon-key"></i> Keluar </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- END SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                            <li class="nav-item start {{ (\Request::route()->getName() == 'home') ? 'active' : '' }}">
                                    <a href="{{url('home')}}" class="nav-link ">
                                        <i class="icon-home"></i>
                                        <span class="title">Dasbor</span>
                                        <span class="selected"></span>
                                    </a>
                            </li>
                                @role('admin')
                                <li class="nav-item ">
                                    <a href="{{url('penilaian/list-grup')}}" class="nav-link nav-toggle">
                                        <i class="icon-note"></i>
                                        <span class="title">Penilaian</span>
                                        {{-- <span class="arrow"></span> --}}
                                    </a>
                                    {{-- <ul class="sub-menu">
                                        <li class="nav-item start ">
                                            <a href="{{url('penilaian/list-grup/vokal')}}" class="nav-link ">
                                                <i class="icon-microphone"></i>
                                                <span class="title">Vokal</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="{{url('penilaian/list-grup/adab')}}" class="nav-link ">
                                                <i class="icon-like"></i>
                                                <span class="title">Adab</span>
                                                {{-- <span class="badge badge-success">1</span> --
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="{{url('penilaian/list-grup/banjari')}}" class="nav-link ">
                                                <i class="icon-music-tone"></i>
                                                <span class="title">Banjari</span>
                                                {{-- <span class="badge badge-danger">5</span> --
                                            </a>
                                        </li>
                                    </ul> --}}
                                </li>
                                @endrole
                                <li class="nav-item {{ (\Request::route()->getName() == 'grup.show') ? 'active' : '' }}">
                                        <a href="{{url('grup/show')}}" class="nav-link ">
                                            <i class="icon-users"></i>
                                            <span class="title">Grup Hadroh</span>
                                            <span class="selected"></span>
                                        </a>
                                </li>
                                {{-- <li class="nav-item {{ (\Request::route()->getName() == 'lomba.create') ? 'active' : '' }}">
                                    <a href="{{url('lomba/create')}}" class="nav-link ">
                                        <i class="icon-badge"></i>
                                        <span class="title">Daftar Lomba</span>
                                        <span class="selected"></span>
                                    </a>
                                </li> --}}
                                @role('admin')
                                <li class="nav-item {{ (\Request::route()->getName() == 'pengaturan.create') ? 'active' : '' }}"">
                                    <a href="{{url('pengaturan')}}" class="nav-link ">
                                        <i class="icon-settings"></i>
                                        <span class="title">Pengaturan</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                                @endrole
                                @role('admin')
                                <li class="nav-item ">
                                    <a href="{{url('penilaian/list-grup')}}" class="nav-link nav-toggle">
                                        <i class="icon-screen-smartphone"></i>
                                        <span class="title">Scanner</span>
                                        {{-- <span class="arrow"></span> --}}
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item start ">
                                            <a href="{{url('scanner/registrasi')}}" class="nav-link ">
                                                <i class="icon-note"></i>
                                                <span class="title">Registrasi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="{{url('scanner/snack')}}" class="nav-link ">
                                                <i class="icon-social-dropbox"></i>
                                                <span class="title">Snack</span>
                                                {{-- <span class="badge badge-success">1</span> --}}
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="{{url('scanner/photobooth')}}" class="nav-link ">
                                                <i class="icon-camera"></i>
                                                <span class="title">Photobooth</span>
                                                {{-- <span class="badge badge-danger">5</span> --}}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endrole
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    @if (session('error'))
                        <div class="alert alert-block alert-danger fade in">
                            {{-- <h4 class="alert-heading">Peringatan!</h4> --}}
                            <p> <strong>{{ session('error') }}</strong> </p>
                        </div>
                    @elseif(session('success'))
                        <div class="alert alert-block alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <p> <strong>{{ session('success') }}</strong> </p>
                        </div>
                    @endif
                    <!-- END PAGE HEADER-->
                    @yield('content')
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> {{date('Y')}} &copy; Aplikasi {{ config('app.name', 'Laravel') }} By
                    <a target="_blank" href="https://facebook.com/prismamampang">PRISMA</a>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
            <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
            <!-- BEGIN CORE PLUGINS -->
            <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="{{ asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="{{ asset('assets/layouts/layout2/scripts/layout.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
            <!-- END THEME LAYOUT SCRIPTS -->

            <script>
                    $(document).ready(function () {
                        $('.date-picker').datepicker({
                                autoclose: true,
                                language: 'id',
                                format: 'DD, d MM yyyy',
                                clearBtn: true,
                                // container: '#calend',
                                todayHighlight: true
                        }).on('changeDate', function(e) {
                                var da = $('#tanggal_lahir').datepicker('getUTCDate');
                                $('#formatted').val(moment(da).format('YYYY-MM-D'));
                        });
                        $( ".only-num" ).keypress(function(evt) {
                                var charCode = (evt.which) ? evt.which : event.keyCode
                                if (charCode > 31 && (charCode < 48 || charCode > 57))
                                    return false;
                                return true;
                        });
                    })
            </script>

    </body>

</html>