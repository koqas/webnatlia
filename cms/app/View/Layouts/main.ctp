<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title><?php echo $title_for_layout; ?></title>

  <!--icheck-->
  <link href="<?php echo $this->webroot; ?>js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="<?php echo $this->webroot; ?>js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="<?php echo $this->webroot; ?>js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="<?php echo $this->webroot; ?>js/iCheck/skins/square/blue.css" rel="stylesheet">

  <?php echo $this->webroot; ?>

  <!--dashboard calendar-->
  <link href="<?php echo $this->webroot; ?>css/clndr.css" rel="stylesheet">

  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="<?php echo $this->webroot; ?>js/morris-chart/morris.css">

  <!--pickers css-->
  <link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/css/datepicker-custom.css" />
  <link rel="stylesheet" type="text/css" href="js/bootstrap-timepicker/css/timepicker.css" />
  <link rel="stylesheet" type="text/css" href="js/bootstrap-colorpicker/css/colorpicker.css" />
  <link rel="stylesheet" type="text/css" href="js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
  <link rel="stylesheet" type="text/css" href="js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />

  <!--common-->
  <link href="<?php echo $this->webroot; ?>css/style.css" rel="stylesheet">
  <link href="<?php echo $this->webroot; ?>css/style-responsive.css" rel="stylesheet">

  <!-- Placed js at the end of the document so the pages load faster -->
<script src="<?php echo $this->webroot; ?>js/jquery-1.10.2.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/modernizr.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/jquery.nicescroll.js"></script>

<!--easy pie chart-->
<script src="<?php echo $this->webroot; ?>js/easypiechart/jquery.easypiechart.js"></script>
<script src="<?php echo $this->webroot; ?>js/easypiechart/easypiechart-init.js"></script>

<!--Sparkline Chart-->
<script src="<?php echo $this->webroot; ?>js/sparkline/jquery.sparkline.js"></script>
<script src="<?php echo $this->webroot; ?>js/sparkline/sparkline-init.js"></script>

<!--icheck -->
<script src="<?php echo $this->webroot; ?>js/iCheck/jquery.icheck.js"></script>
<script src="<?php echo $this->webroot; ?>js/icheck-init.js"></script>

<!-- jQuery Flot Chart-->
<script src="<?php echo $this->webroot; ?>js/flot-chart/jquery.flot.js"></script>
<script src="<?php echo $this->webroot; ?>js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="<?php echo $this->webroot; ?>js/flot-chart/jquery.flot.resize.js"></script>


<!--Morris Chart-->
<script src="<?php echo $this->webroot; ?>js/morris-chart/morris.js"></script>
<script src="<?php echo $this->webroot; ?>js/morris-chart/raphael-min.js"></script>

<!--Calendar-->
<script src="<?php echo $this->webroot; ?>js/calendar/clndr.js"></script>
<script src="<?php echo $this->webroot; ?>js/calendar/evnt.calendar.init.js"></script>
<script src="<?php echo $this->webroot; ?>js/calendar/moment-2.2.1.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>

<!--common scripts for all pages-->
<script src="<?php echo $this->webroot; ?>js/scripts.js"></script>

<!--Dashboard Charts-->
<script src="<?php echo $this->webroot; ?>js/dashboard-chart-init.js"></script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="<?php echo $this->webroot; ?>js/html5shiv.js"></script>
  <script src="<?php echo $this->webroot; ?>js/respond.min.js"></script>
  <![endif]-->


</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="index.html"><img src="<?php echo $this->webroot; ?>images/logonatlia.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="index.html"><img src="<?php echo $this->webroot; ?>images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
            </div>

            <?php
              echo $this->element('sidenavigation');
            ?>

        </div>
    </div>
    <!-- left side end-->
    
    <!-- main content start-->
    <div class="main-content" >
        <!-- header section start-->
        <div class="header-section">

          <a><i class="fa fa-bars"></i></a>
                <!--a href="<?php echo $settings["cms_url"]?>Account/Logout" class="toggle-btn"><i class="fa fa-bars"></i></a-->
            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Admin
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="<?php echo $settings["cms_url"]?>Account/Logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->
        </div>
        <!-- header section end-->

        <?php echo $this->fetch('content'); ?>

    </div>
    <!-- main content end-->
</section>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
