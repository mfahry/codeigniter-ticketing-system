<!-- FullCalendar -->
<link href="<?php echo base_url("vendors/fullcalendar/dist/fullcalendar.min.css") ?>" rel="stylesheet">
<link href="<?php echo base_url("vendors/fullcalendar/dist/fullcalendar.print.css") ?>" rel="stylesheet" media="print">

<div class="row top_tiles">
  <div class="animated flipInY col-lg-2 col-md-2 col-sm-4 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><span class="badge bg-green">SOLVED</span></div>
      <div class="count green">
        <?php echo $troubleshoot_on; ?>
      </div>
      <h3>Troubleshoot</h3>
      <p>Periode <?php echo date("M")?></p>
    </div>
  </div>
  <div class="animated flipInY col-lg-2 col-md-2 col-sm-4 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><span class="badge bg-red">WAITING</span></div>
      <div class="count red">
        <?php echo $troubleshoot_off; ?>
      </div>
      <h3>Troubleshoot</h3>
      <p>Periode <?php echo date("M")?></p>
    </div>
  </div>
  <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-wrench"></i></div>
      <div class="count"><?php echo $maintenance["TOTAL"]; ?></div>
      <h3>Maintenance</h3>
      <p>Rekapitulasi data pada bulan <?php echo date("M"); ?></p>
    </div>
  </div>
  <div class="animated flipInY col-lg-2 col-md-2 col-sm-4 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><span class="badge bg-green">DONE</span></div>
      <div class="count green">
        <?php echo $procurement_done; ?>
      </div>
      <h3>Procurement</h3>
      <p>Periode <?php echo date("M")?></p>
    </div>
  </div>
  <div class="animated flipInY col-lg-2 col-md-2 col-sm-4 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><span class="badge bg-red">PENDING</span></div>
      <div class="count red">
        <?php echo $procurement_pending; ?>
      </div>
      <h3>Procurement</h3>
      <p>Periode <?php echo date("M")?></p>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Availability Aset <small>Periode <?php echo date("M")?></small></h2>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="col-md-9 col-sm-12 col-xs-12">
          <div class="demo-container" style="height:280px">
            <!--<div id="chart_plot_02" class="demo-placeholder"></div>-->
            <canvas id="asset_available_chart"></canvas>
          </div>
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">
          <div>
            <div class="x_title">
              <h2>Five Last Login User</h2>
              <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled top_profiles scroll-view">
              <?php 
              $i = 0;
              foreach($user as $row) {
                $color = "aero";
                if( $i%3 == 0 ) {
                  $color = "green";
                }
                if( $i%3 == 1 ) {
                  $color = "blue";
                } 
              ?>
                <li class="media event">
                  <a class="pull-left border-aero profile_thumb">
                    <i class="fa fa-user <?php echo $color; ?>"></i>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#"><?php echo ($i+1).". ".$row["USERNAME"]; ?></a>
                    <p>Last Login : <?php echo $row["LAST_LOGIN"]; ?></p>
                    <p><small>tipe user : <?php echo $row["USER_TYPE"]?></small></p>
                  </div>
                </li>
              <?php
                $i++;
              }
              ?>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>



<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Critical Events <small>Periode <?php echo date('M'); ?></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div id='critical_event_calendar'></div>
      </div>
    </div>
  </div>
</div>
<div id= "modal_detail_event" class="modal fade modal-confirmation" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Detail Event</h4>
      </div>
      <div class="modal-body">
        <div class="row project_detail">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <p class="title green">Brand</p>
            <p id="brand"></p>
            <p class="title green">Tipe</p>
            <p id="type"></p>
            <p class="title green">Tipe Aset</p>
            <p id="group_name"></p>
            <p class="title green">Hostname</p>
            <p id="hostname"></p>
            <p class="title green">IP Address</p>
            <p id="ip_address"></p>    
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <p class="title green">Location</p>
            <p id="location"></p>
            <p class="title green">Tanggal Habis Maintenance</p>
            <p id="expired_maintenance_date"></p>
            <p class="title green">Tanggal EoS</p>
            <p id="end_of_sale_date"></p>
            <p class="title green">Tanggal EoL</p>
            <p id="end_of_life_date"></p>
            <p class="title green">Perihal</p>
            <p id="perihal"></p>    
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div 
  id= "modal_detail_upcoming_event" class="modal fade modal-confirmation" 
  tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Detail Event</h4>
      </div>
      <div class="modal-body">
        <div class="row project_detail">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <p class="title green">Aset</p>
            <p id="merk"></p>
            <p class="title green">Tipe Aset</p>
            <p id="group_name"></p>
            <p class="title green">Hostname / IP Address / Lokasi</p>
            <p id="asset"></p>
            <div class="ln_solid"></div>
            <p class="title green">Username</p>
            <p id="username"></p>
            <p class="title green">Diingatkan Tanggal</p>
            <p id="reminder_date"></p>
            <p class="title green">Perihal</p>
            <p id="description"></p>    
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js -->
<script src="<?php echo base_url("vendors/Chart.js/dist/Chart.min.js"); ?>"></script>
<!-- FullCalendar -->
<script src="<?php echo base_url("vendors/moment/min/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/fullcalendar/dist/fullcalendar.min.js"); ?>"></script>