<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 3.9.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>{{$pageTitle}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <!--link href="{{url('assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css"-->
    <link href="{{url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet')}}" type="text/css"/>
    <link href="{{url('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="{{url('assets/admin/pages/css/tasks.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}"/>


    @yield('custom-style-cb')
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{url('assets/global/css/components.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/css/plugins-md.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/admin/layout3/css/layout.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/admin/layout3/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color">
    <link href="{{url('assets/admin/layout3/css/custom.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}"/>
    <!-- END THEME STYLES -->
    <!--link rel="shortcut icon" href="favicon.ico"/-->
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png')}}" type="image/x-icon">
    <script src="{{url('assets/global/plugins/respond.min.js')}}"></script>
    <script src="{{url('assets/global/plugins/excanvas.min.js')}}"></script>
    <![endif]-->
    <script src="{{url('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="{{url('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
    <!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
    <!--script src="{{url('assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script-->
    <script src="{{url('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/layout3/scripts/layout.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/layout3/scripts/demo.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/pages/scripts/index3.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/pages/scripts/tasks.js')}}" type="text/javascript"></script>



    <script>
        jQuery(document).ready(function() {
            Metronic.init(); // init metronic core componets
            Layout.init(); // init layout
            Demo.init(); // init demo(theme settings page)
            //Index.init(); // init index page
            //Tasks.initDashboardWidget(); // init tash dashboard widget
        });
    </script>
    <!-- END JAVASCRIPTS -->

    <script type="text/javascript">
        function time() {
            var today = new Date();
            var weekday=new Array(7);
            weekday[0]="Chủ nhật";
            weekday[1]="Thứ hai";
            weekday[2]="Thứ ba";
            weekday[3]="Thứ tư";
            weekday[4]="Thứ năm";
            weekday[5]="Thứ sáu";
            weekday[6]="Thứ bảy";
            var day = weekday[today.getDay()];
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            m=checkTime(m);
            s=checkTime(s);
            nowTime = h+":"+m+":"+s;
            if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = day+', '+ dd+'/'+mm+'/'+yyyy;

            tmp='<span class="date"> '+today+' | '+nowTime+'</span>';

            document.getElementById("clock").innerHTML=tmp;

            clocktime=setTimeout("time()","1000","JavaScript");
            function checkTime(i)
            {
                if(i<10){
                    i="0" + i;
                }
                return i;
            }
        }
    </script>
    @yield('custom-script-cb')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid" onload="time()">
<!-- BEGIN HEADER -->
<div class="page-header">
    <!-- BEGIN HEADER TOP -->
    <div class="page-header-top">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <h3 style="text-transform: uppercase;"><b style="color: #25aae2">CƠ SỞ DỮ LIỆU GIÁ</b>&nbsp;<b style="color: #454545">{{isset(getGeneralConfigs()['diadanh']) ? getGeneralConfigs()['diadanh'] : ''}}</b></h3>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <b style="color: #25aae2"><div id="clock"></div></b>
                @if(Illuminate\Support\Facades\Session::has('admin'))
                    <a class="text-bold text-white no-underline" href="{{url('')}}" data-ga-click="(Logged out) Header, clicked Sign in, text:sign-in">Vào chương trình</a>
                @else
                    <a class="text-bold text-white no-underline" href="{{url('login')}}" data-ga-click="(Logged out) Header, clicked Sign in, text:sign-in">Đăng nhập</a>
                    or <a class="text-bold text-white no-underline" href="{{url('searchtkdangky')}}" data-ga-click="(Logged out) Header, clicked Sign in, text:sign-in">Kiểm tra tài khoản đăng ký</a>
                @endif
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>

    </div>

    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->
    <div class="page-header-menu">
        <div class="container">
            <!-- BEGIN MEGA MENU -->
            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
            <div class="hor-menu ">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{url('giahanghoadichvu')}}">Trang chủ</a>
                    </li>
                    <li class="menu-dropdown classic-menu-dropdown ">
                        <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
                            Cơ sở dữ liệu giá<i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-left">
                            @if(canGeneral('hhtt','hhtt')||canGeneral('hhxnk','hhxnk')||canGeneral('hhdvtn','hhdvtn')
                            ||canGeneral('kkgtw','kkgtw')||canGeneral('kkgdp','kkgdp')||canGeneral('tsnnnhadat','tsnnnhadat')
                            ||canGeneral('tsnnotokhac','tsnnotokhac')||canGeneral('gttruocba','gttruocba')||canGeneral('gthuetn','gthuetn')
                            ||canGeneral('tdgia','tdgia')||canGeneral('congbogia','congbogia')||canGeneral('loaidat','loaidat')||canGeneral('vitri','vitri')
                            ||canGeneral('ttqd','ttqd')
                            )
                                @if(canGeneral('hhtt','hhtt'))
                                    <li class=" dropdown">
                                        <a href="{{url('hanghoathitruong')}}">
                                            <i class="fa fa-building"></i>
                                            Hàng hóa thị trường</a>
                                    </li>
                                @endif

                                @if(canGeneral('hhxnk','hhxnk'))
                                    <!-- Chưa làm -->
                                    <li class=" dropdown">
                                        <a href="{{url('')}}">
                                            <i class="fa fa-building"></i>
                                            Hàng hóa xuất, nhập khẩu</a>
                                    </li>
                                @endif

                                @if(canGeneral('hhdvtn','hhdvtn'))
                                    <!-- Chưa làm -->
                                    <li class=" dropdown">
                                        <a href="{{url('')}}">
                                            <i class="fa fa-building"></i>
                                            Hàng hóa, dịch vụ trong nước</a>
                                    </li>
                                @endif

                                @if(canGeneral('kkgtw','kkgtw'))
                                    <li class=" dropdown">
                                        <a href="{{url('hanghoatw')}}">
                                            <i class="fa fa-building"></i>
                                            Hàng hóa TW quy định</a>
                                    </li>
                                @endif

                                @if(canGeneral('kkgdp','kkgdp'))
                                    <li class=" dropdown">
                                        <a href="{{url('hanghoadp')}}">
                                            <i class="fa fa-building"></i>
                                            Hàng hóa ĐP quy định</a>
                                    </li>
                                @endif

                                @if(canGeneral('tsnnnhadat','tsnnnhadat'))
                                    <!-- Chưa làm -->
                                    <li class=" dropdown">
                                        <a href="{{url('')}}">
                                            <i class="fa fa-building"></i>
                                            Tài sản nhà nước</a>
                                    </li>
                                @endif

                                @if(canGeneral('tsnnotokhac','tsnnotokhac'))
                                    <!-- Chưa làm -->
                                    <li class=" dropdown">
                                        <a href="{{url('')}}">
                                            <i class="fa fa-building"></i>
                                            Tài sản ôtô- tài sản khác</a>
                                    </li>
                                @endif

                                @if(canGeneral('gttruocba','gttruocba'))
                                    <li class=" dropdown">
                                        <a href="{{url('thuetb?nam='.date('Y').'&pb=all')}}">
                                            <i class="fa fa-building"></i>
                                            Giá thuế trước bạ</a>
                                    </li>
                                @endif

                                @if(canGeneral('gthuetn','gthuetn'))
                                    <li class=" dropdown">
                                        <a href="{{url('thuetn?nam='.date('Y').'&pb=all')}}">
                                            <i class="fa fa-building"></i>
                                            Giá thuế tài nguyên</a>
                                    </li>
                                @endif

                                @if(canGeneral('tdgia','tdgia'))
                                    <li class=" dropdown">
                                        <a href="{{url('thamdg?nam='.date('Y').'&pb=all')}}">
                                            <i class="fa fa-building"></i>
                                            Thẩm định giá</a>
                                    </li>
                                @endif
                                @if(canGeneral('congbogia','congbogia'))
                                    <li class=" dropdown">
                                        <a href="{{url('congbg?nam='.date('Y').'&pb=all')}}">
                                            <i class="fa fa-building"></i>
                                            Công bố giá </a>
                                    </li>
                                @endif
                                @if(canGeneral('loaidat','loaidat'))
                                    <li class=" dropdown">
                                        <a href="{{url('pldat')}}">
                                            <i class="fa fa-building"></i>
                                            Giá đất theo phân loại</a>
                                    </li>
                                @endif
                                @if(canGeneral('vitri','vitri'))
                                    <li class=" dropdown">
                                        <a href="{{url('vtdat?maso=ALL')}}">
                                            <i class="fa fa-building"></i>
                                            Giá theo vị trí đất</a>
                                    </li>
                                @endif
                                @if(canGeneral('ttqd','ttqd'))
                                    <li class=" dropdown">
                                        <a href="{{url('vbpl')}}">
                                            <i class="fa fa-building"></i>
                                            Văn bản QLNN về giá</a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>

                    <li class="menu-dropdown classic-menu-dropdown ">
                        <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
                            Giá dịch vụ <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-left">
                            @if(canGeneral('dvlt','dvlt')
                                ||canGeneral('dvvt','vtxk') || canGeneral('dvvt','vtxb') || canGeneral('dvvt','vtxtx') || canGeneral('dvvt','vtch')
                                || canGeneral('dvgs','dvgs')
                                ||canGeneral('dvtacn','dvtacn')
                            )
                                @if(canGeneral('dvlt','dvlt'))
                                    <li class=" dropdown">
                                        <a href="{{url('giadichvuluutru')}}">
                                            <i class="fa fa-building"></i>
                                            Giá dịch vụ lưu trú </a>
                                    </li>
                                @endif
                                @if((canGeneral('dvvt','vtxk') || canGeneral('dvvt','vtxb') || canGeneral('dvvt','vtxtx') || canGeneral('dvvt','vtch')))
                                    <li class=" dropdown-submenu">
                                <a href="">
                                    <i class="fa fa-automobile"></i>
                                    Giá dịch vụ vận tải </a>
                                <ul class="dropdown-menu">
                                    @if(canGeneral('dvvt','vtxk'))
                                        <li class=" ">
                                            <a href="{{url('giavantaixekhach')}}">
                                                Giá vận tải xe khách </a>
                                        </li>
                                    @endif

                                    @if(canGeneral('dvvt','vtxb'))
                                        <li class="">
                                            <a href="{{url('giavantaixebus')}}">
                                                Giá vận tải xe buýt </a>
                                        </li>
                                    @endif

                                    @if(canGeneral('dvvt','vtxtx'))
                                        <li class=" ">
                                            <a href="{{url('giavantaixetaxi')}}">
                                                Giá vận tải xe taxi </a>
                                        </li>
                                    @endif

                                    @if(canGeneral('dvvt','vtch'))
                                        <li class=" ">
                                            <a href="{{url('giavantaikhac')}}">
                                                Giá vận tải khác </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                                @endif
                                @if(canGeneral('dvgs','dvgs'))
                                    <li class=" dropdown">
                                        <a href="{{url('giamathangsua')}}">
                                            <i class="fa fa-spoon"></i>
                                            Giá mặt hàng sữa </a>
                                    </li>
                                @endif
                                @if(canGeneral('dvtacn','dvtacn'))
                                    <li class=" dropdown">
                                        <a href="{{url('giathucanchannuoi')}}">
                                            <i class="fa fa-paw"></i>
                                            Giá thức ăn chăn nuôi </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>


                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
    <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
    <!-- BEGIN PAGE HEAD -->
    <!-- END PAGE HEAD -->
    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        @yield('content-cb')
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<!-- BEGIN PRE-FOOTER -->
<!-- END PRE-FOOTER -->
<!-- BEGIN FOOTER -->
<div class="page-prefooter">
    <div class="container">
        <div class="row">
            <div class="col-md-12 footer-block" style="text-align: center">
                <h2><strong>Giá hàng hóa dịch vụ&nbsp;<b style="color: #25aae2">{{isset(getGeneralConfigs()['diadanh']) ? getGeneralConfigs()['diadanh'] : ''}}</b></strong></h2>
                <p>Bản quyền thuộc về &nbsp;<b style="color: #25aae2">{{isset(getGeneralConfigs()['tendonvi']) ? getGeneralConfigs()['tendonvi'] : ''}}</b></p>
                <p>Địa chỉ: &nbsp;<b style="color: #25aae2">{{isset(getGeneralConfigs()['diachi']) ? getGeneralConfigs()['diachi'] : ''}}</b></p>
                <p>Thông tin liên hệ: &nbsp;<b style="color: #25aae2">{{isset(getGeneralConfigs()['tel']) ? getGeneralConfigs()['tel'] : ''}}</b></p>
            </div>
        </div>
    </div>
</div>

<div class="page-footer">
    <div class="container">

        <div class="col-md-12">
        2016 &copy; LifeSoft <a href="" >Tiện ích hơn - Hiệu quả hơn</a>
        </div>
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>

</body>
<!-- END BODY -->
</html>