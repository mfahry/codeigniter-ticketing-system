<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Asset Management</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url("vendors/bootstrap/dist/css/bootstrap.min.css"); ?>" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="<?php echo base_url("vendors/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("build/font/arima-madurai.css"); ?>" rel="stylesheet">

    <!-- NProgress -->
    <link href="<?php echo base_url("vendors/nprogress/nprogress.css"); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url("build/css/custom.css"); ?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url("vendors/jquery/dist/jquery.min.js"); ?>"></script>
    
    <!-- Bootstrap -->
    <script src="<?php echo base_url("vendors/bootstrap/dist/js/bootstrap.min.js"); ?>"></script>
    
    <!-- FastClick -->
    <script src="<?php echo base_url("vendors/fastclick/lib/fastclick.js"); ?>"></script>
    
    <!-- NProgress -->
    <script src="<?php echo base_url("vendors/nprogress/nprogress.js"); ?>"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
            	<a href="<?php echo base_url("dashboard"); ?>" class="site_title"><i class="fa fa-asterisk"></i>&nbsp; &nbsp;<span>O M S</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic text-center">
                <img src="<?php echo base_url("build/images/user-log.png"); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $session_user["username"]; ?> / <span class="green"> <?php echo strtolower($session_user["user_type"]); ?></span></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <?php 
              if($session_user["user_type"] != "VENDOR") {
              ?>
                <div class="menu_section">
                  <h3>General</h3>
                  <ul class="nav side-menu">
                    <li>
                    	<a href="<?php echo base_url("dashboard")?>"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                    	<a><i class="fa fa-bar-chart"></i> Report <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url("report/troubleshoot_per_day")?>">Troubleshoot Per Hari</a></li>
                        <li><a href="<?php echo base_url("report/maintenance_per_day")?>">Maintenance Per Hari</a></li>
                        <li><a href="<?php echo base_url("report/activity_per_organic")?>">Aktifitas Staff</a></li>
                        <li><a href="<?php echo base_url("report/upcoming_per_organic")?>">Rencana Actifitas Staff</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              <?php
              }
              ?>
              <div class="menu_section">
                <h3>Manage</h3>
                <ul class="nav side-menu">
                  <?php 
                  if($session_user["user_type"] != "VENDOR") {
                  ?> 
                    <li>
                    	<a><i class="fa fa-archive"></i> Asset <span class="fa fa-chevron-down"></span></a>
                    	<ul class="nav child_menu">
                        <li><a href="<?php echo base_url("asset")?>">View Data</a></li>
                        <li><a href="<?php echo base_url("asset/add")?>">Add New</a></li>
                      </ul>
                    </li>
                    <li>
                    	<a><i class="fa fa-binoculars"></i> Troubleshoot <span class="fa fa-chevron-down"></span></a>
                    	<ul class="nav child_menu">
                        <li><a href="<?php echo base_url("troubleshoot")?>">View Data</a></li>
                        <li><a href="<?php echo base_url("troubleshoot/add")?>">Add New</a></li>
                      </ul>
                    </li>
                  <?php
                  }
                  ?>

                  <li>
                  	<a><i class="fa fa-cogs"></i> Maintenance <span class="fa fa-chevron-down"></span></a>
                  	<ul class="nav child_menu">
                      <li><a href="<?php echo base_url("maintenance")?>">View Data</a></li>
                      <li><a href="<?php echo base_url("maintenance/add")?>">Add New</a></li>
                    </ul>
                  </li>

                  <?php 
                  if($session_user["user_type"] != "VENDOR") {
                  ?>
                    <li>
                      <a><i class="fa fa-history"></i> Procurement <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url("procurement")?>">View Data</a></li>
                        <li><a href="<?php echo base_url("procurement/add")?>">Add New</a></li>
                      </ul>
                    </li>
                    <li>
                    	<a><i class="fa fa-calendar"></i> Upcoming Event<span class="fa fa-chevron-down"></span></a>
                    	<ul class="nav child_menu">
                        <li><a href="<?php echo base_url("upcoming")?>">View Data</a></li>
                        <li><a href="<?php echo base_url("upcoming/add")?>">Add New</a></li>
                      </ul>
                    </li>
                    <li>
                    	<a><i class="fa fa-book"></i> Document <span class="fa fa-chevron-down"></span></a>
                    	<ul class="nav child_menu">
                        <li><a href="<?php echo base_url("document")?>">View Data</a></li>
                        <li><a href="<?php echo base_url("document/add")?>">Add New</a></li>
                      </ul>
                    </li>
                  <?php 
                  }
                   
                  if($session_user["user_type"] == "SYS") {
                  ?>
                    <li>
                      <a><i class="fa fa-sun-o"></i> Parameter <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url("parameter")?>">View Data</a></li>
                        <li><a href="<?php echo base_url("parameter/add")?>">Add New</a></li>
                      </ul>
                    </li>
                    <li>
                      <a><i class="fa fa-user"></i> User <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url("user")?>">View Data</a></li>
                        <li><a href="<?php echo base_url("user/add")?>">Add New</a></li>
                      </ul>
                    </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url("build/images/user-log.png"); ?>" alt=""><?php echo $session_user["username"]?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url("user/logout")?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php echo $content; ?>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered By Muhammad Fahry PPS IT Angkatan 53
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url("build/js/custom.js"); ?>"></script>
  </body>
</html>