<div class="page-title">
  <div class="title_left">
    <h3>Asset | Detail</h3>
  </div>
</div>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?php echo $asset["HOSTNAME"]." (".$asset["IP_ADDRESS"]." : ".$asset["PORT"].")"; ?></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <div class="col-md-9 col-sm-9 col-xs-12">

          <ul class="stats-overview">
            <li>
              <span class="name"> Maintenance </span>
              <span class="value text-success"> <?php echo count($maintenance); ?> </span>
            </li>
            <li>
              <span class="name"> Troubleshoot </span>
              <span class="value text-success"> <?php echo count($troubleshoot); ?> </span>
            </li>
          </ul>
          <br />

          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 project_detail">
              <p class="title green"><i>Status</i></p>
              <p>
                <span class="label <?php echo $asset["ACTIVE"]=="Y"?"label-primary":"label-danger"; ?>">
                  <?php echo $asset["ACTIVE"]=="Y"?"ACTIVE":"NOT ACTIVE" ?>
                </span>
              </p>
              <p class="title green"><i>Brand</i></p>
              <p><?php echo $asset["BRAND"] ?></p>
              <p class="title green">Tipe</p>
              <p><?php echo $asset["TYPE"] ?></p>
              <p class="title green"><i>Group</i></p>
              <p><?php echo $asset["GROUP_NAME"] ?></p>
              <p class="title green">Sistem Operasi</p>
              <p><?php echo $asset["OPERATING_SYSTEM"] ?></p>
              <p class="title green"><i>Serial Number</i></p>
              <p><?php echo $asset["SERIAL_NUMBER"] ?></p>
              <p class="title green">Lokasi</p>
              <p><?php echo $asset["LOCATION"] ?></p>
              <p class="title green">Foto</p>
              <p><a href="<?php echo base_url($asset["PHOTO"]); ?>" target="_blank">Lihat</a></p>
              <p class="title green">Spesifikasi</p>
              <p><?php echo $asset["SPECIFICATION"] ?></p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 project_detail">
              <p class="title green">Harga Beli</p>
              <p><?php echo $asset["BUY_PRICE"] ?></p>
              <p class="title green">Tanggal Beli</p>
              <p><?php echo $asset["BUY_DATE"] ?></p>
              <p class="title green">Tanggal Habis <i>Maintenance</i></p>
              <p><?php echo $asset["EXPIRED_MAINTENANCE_DATE"] ?></p>
              <p class="title green"><i>End of Support</i></p>
              <p><?php echo $asset["END_OF_SUPPORT_DATE"] ?></p>
              <p class="title green"><i>End of Sale</i> (EoS)</p>
              <p><?php echo $asset["END_OF_SALE_DATE"] ?></p>
              <p class="title green"><i>End of Life</i> (EoL)</p>
              <p><?php echo $asset["END_OF_LIFE_DATE"] ?></p>
              <p class="title green">Tipe Kabel</p>
              <p><?php echo $asset["CABLE_TYPE"] ?></p>
              <p class="title green">Koordinat Server</p>
              <p><?php echo $asset["CABLE_X_COORDINATE"].",".$asset["CABLE_Y_COORDINATE"] ?></p>
              <p class="title green"><i>HA Mode</i></p>
              <p><?php echo $asset["HA_MODE"] ?></p>
              <p class="title green">Kegunaan</p>
              <p><?php echo $asset["ASSET_FUNCTION"] ?></p>
            </div>
          </div>


        </div>

        <!-- start project-detail sidebar -->
        <div class="col-md-3 col-sm-3 col-xs-12">

          <section class="panel">

            <div class="x_title">
              <h2><i>Asset Files</i></h2>
              <div class="clearfix"></div>
            </div>
            <div class="panel-body">
              <ul class="list-unstyled project_files">
                <?php
                foreach($document as $row){
                ?>
                  <li>
                    <a href="<?php echo base_url("asset/".$row["PATH"]); ?>">
                      <i class="fa fa-file-word-o"></i> <?php echo $row["NAME"]; ?>
                    </a>
                    <p>description :  <i><?php echo $row["DESCRIPTION"]?></i></p>
                  </li>
                <?php  
                }
                ?>
              </ul>
              <br />

              <div class="text-center mtop20">
                <a href="<?php echo base_url("asset/modify/".$asset["ID"]); ?>" class="btn btn-sm btn-primary">
                  Ubah
                </a>
                <button 
                  type="button" class="btn_drop btn btn-danger btn-sm" data-toggle="modal" 
                  data-target=".modal-confirmation" data-url="<?php echo base_url("asset/drop/".$asset["ID"])?>">
                  Hapus Data
                </button>
                <div class="modal fade modal-confirmation" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Konfirmasi</h4>
                      </div>
                      <div class="modal-body">
                        Apakah anda yakin menghapus data aset?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <a href="" class="btn btn-danger">Ya, Saya Yakin</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </section>

        </div>
        <!-- end project-detail sidebar -->

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="x_panel">
      <div class="x_title">
        <h2><i>Opened Port</i></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>  
      <div class="x_content">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">Port</th>
              <th class="text-center">IP Address</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach($port as $row){
            ?>
              <tr>
                <td class="text-center"><?php echo $row["PORT"]?></td>
                <td class="text-center">
                  <?php
                  $ip_address = explode(";", $row["IP_ADDRESS"]);
                  for($i=0; $i<count($ip_address); $i++){
                  ?>
                    <span class="label <?php echo $i%2==0?"label-success":"label-warning"; ?>"><?php echo $ip_address[$i]; ?></span>
                  <?php  
                  }  
                  ?>
                </td>
              </tr>
            <?php  
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="x_panel">
      <div class="x_title">
        <h2><i>Upcoming Event</i></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>  
      <div class="x_content">
        <?php
        foreach($upcoming as $row){
          $class = "label-default";
          if($row["STATUS"] == "PENDING") {
            $class = "label-danger"; 
          }
          if($row["STATUS"] == "DONE") {
            $class = "label-success"; 
          }
        ?>
          <article class="media event">
            <a class="pull-left date">
              <p class="month"><?php echo date("M", strtotime($row["REMINDER_DATE"])) ?></p>
              <p class="day"><?php echo date("d", strtotime($row["REMINDER_DATE"])) ?></p>
            </a>
            <div class="media-body">
              <a class="title" href="#">
                <label class="label <?php echo $class; ?>"><?php echo $row["STATUS"]; ?></label>
              </a>
              <p><?php echo strlen($row["DESCRIPTION"])>=200 ? substr($row["DESCRIPTION"],0,200)."..." : $row["DESCRIPTION"];?></p>
            </div>
          </article>
        <?php  
        }
        ?>
      </div>
    </div>  
  </div>
  <div class="col-md-4">
    <div class="x_panel">
      <div class="x_title">
        <h2><i>Pengajuan Ijin Prinsip</i></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>  
      <div class="x_content">
        <?php
        foreach($procurement as $row){
          $class = "label-warning";
          if($row["STATUS"] == "DONE") {
            $class = "label-success"; 
          }
        ?>
          <article class="media event">
            <a class="pull-left date">
              <p class="month"><?php echo date("M", strtotime($row["FILLING_DATE"])) ?></p>
              <p class="day"><?php echo date("d", strtotime($row["FILLING_DATE"])) ?></p>
            </a>
            <div class="media-body">
              <a class="title" href="#">
                <label class="label <?php echo $class; ?>">
                  <?php echo $row["STATUS"]." [ "; ?>
                  <?php echo $row["STATUS"] == "DONE" ? $row["DONE_DATE"]."]" :"]"; ?>
                </label>
              </a>
              <p>
                <?php 
                echo strlen($row["DESCRIPTION"])>=200 ? substr($row["DESCRIPTION"],0,200)."..." : $row["DESCRIPTION"];
                ?>
              </p>
            </div>
          </article>
        <?php  
        }
        ?>
      </div>
    </div>  
  </div>
</div>