<!-- bootstrap-daterangepicker -->
<link href="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.css"); ?>" rel="stylesheet">

<div class="page-title">
  <div class="title_left">
    <h3>Aktifitas Pegawai Organic Bulan <?php echo date("M"); ?></h3>
  </div>
</div>

<div class="clearfix"></div>

<div class="row">
  <?php
  foreach($user as $row) {
  ?>
    <div class="col-md-4">
      <div class="x_panel">
        <div class="x_title">
          <h2><?php echo "username :".$row["USERNAME"]; ?></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content" id="activity_chart">
          <canvas id="activity-<?php echo $row["ID"]?>"></canvas>
          <p class="text-center" id="activity-<?php echo $row["ID"]?>-notfound">Not Found Data</p>
        </div>
      </div>
    </div>
  <?php 
  }
  ?>
</div>
<!-- Chart.js -->
<script src="<?php echo base_url("vendors/Chart.js/dist/Chart.min.js"); ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url("vendors/moment/min/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.js") ; ?>"></script>