<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
    	   <a class="brand" href="index.html">
    		PORTAL OMS
    		<h3>Operasional Monitoring Security</h3>
    	   </a> 
        </div>
        <!-- /container --> 
    </div>
    <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
    	<li class="active">
    		<?php echo anchor('dashboard','<i class="icon-dashboard"></i> <span>Dashboard</span>') ?>
    	</li>
        <li>
        	<?php echo anchor('report','<i class="icon-bar-chart"></i> <span>Report</span>') ?>
        </li>
        <li>
        	<?php echo anchor('asset','<i class="icon-cogs"></i> <span>Asset</span>') ?>
        </li>
        <li>
        	<?php echo anchor('troubleshoot','<i class="icon-exclamation"></i> <span>Troubleshoot</span>') ?>
        </li>
        <li>
        	<?php echo anchor('maintenance','<i class="icon-wrench"></i> <span>Maintenance</span>') ?>
        </li>
        <li>
        	<?php echo anchor('maintenance','<i class="icon-calendar"></i> <span>Upcoming</span>') ?>
        </li>
        <li>
        	<?php echo anchor('document','<i class="icon-book"></i> <span>Document</span>') ?>
        </li>
        <li class="dropdown">
        	<?php echo anchor('javascript(0)','<i class="icon-user"></i> <span>Profile</span> <b class="caret"></b>', 'class="dropdown-toggle" data-toggle="dropdown"') ?>
        	<ul class="dropdown-menu">
        		<li><?php echo anchor('user/edit_profile', 'Edit Profile') ?></li>
        		<li><?php echo anchor('user/logout', '<b>Logout') ?></li>
        	</ul>
        </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>