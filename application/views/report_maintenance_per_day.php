<!-- bootstrap-daterangepicker -->
<link href="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.css"); ?>" rel="stylesheet">

<div class="page-title">
  <div class="title_left">
    <h3>Report | Maintenance per Hari</h3>
  </div>
</div>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Maintenance Bulan <?php echo date("M"); ?></h2>
        <div class="filter">
          <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-12">
            <canvas id="maintenance_chart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Chart.js -->
<script src="<?php echo base_url("vendors/Chart.js/dist/Chart.min.js"); ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url("vendors/moment/min/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.js") ; ?>"></script>