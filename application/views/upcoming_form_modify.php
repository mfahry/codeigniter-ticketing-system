<!-- bootstrap-daterangepicker -->
<link href="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.css"); ?>" rel="stylesheet">

<div class="page-title">
  <div class="title_left">
    <h3>Upcoming Event | Modify</h3>
  </div>
</div>
<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
	      <form 
	      	class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" 
	      	id="form" action="<?php echo base_url("upcoming/modify/".$upcoming["ID"]); ?>" novalidate>
	        
          <!-- elements in form tag -->
	        <p>Mohon masukkan data-data sesuai dengan yang seharusnya. Terima Kasih</p>
	        <?php
	        if(isset($info)){ 
        	?>
        		<div class="alert <?php echo $info["class"]; ?>"><?php echo $info["text"]; ?></div>
	        <?php
	        }
	        ?>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="asset_id">
              Aset <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="asset_id" class="form-control col-md-7 col-xs-12" required="required">
                <option></option>
                <?php
                foreach($asset as $row){
                ?>
                  <option value="<?php echo $row["ID"] ?>" <?php echo $row["ID"] == $upcoming["ASSET_ID"] ? "selected":""; ?>>
                    <?php echo $row["HOSTNAME"]." (".$row["IP_ADDRESS"].")"?>
                  </option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reminder_date">
              Tanggal Pengingat <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input 
                type="text" class="form-control col-md-7 col-xs-12" 
                id="reminder_date" name="reminder_date" placeholder="Reminder Date" required="required" 
                value="<?php echo $upcoming["REMINDER_DATE"]; ?>"/>
              <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-sm-3 col-md-3 col-xs-12" for="description">Deskripsi</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea 
                class="form-control resizable_textarea" name="description" 
                id="description" placeholder="type a text description" required="required"><?php echo $upcoming["DESCRIPTION"]?></textarea>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
              Status <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="status" id="status" class="form-control col-md-7 col-xs-12">
                <option value="WAITING REMINDER" <?php echo $upcoming["STATUS"] == "WAITING REMINDER" ? "selected":""; ?>>MENUJU TANGGAL PENGINGAT</option>
                <option value="PENDING" <?php echo $upcoming["STATUS"] == "PENDING" ? "selected":""; ?>>TERTUNDA</option>
                <option value="DONE" <?php echo $upcoming["STATUS"] == "DONE" ? "selected":""; ?>>SELESAI</option>
              </select>
            </div>
          </div>
          <div class="item form-group" style="display: none;" id="activity_field">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activity">
              Tipe Kegiatan <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="activity" id="activity" class="form-control col-md-7 col-xs-12">
                <option value=""></option>
                <option value="MAINTENANCE">MAINTENANCE</option>
                <option value="TROUBLESHOOT">TROUBLESHOOT</option>
              </select>
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
              <button type="submit" class="btn btn-success">Submit</button>
              <button type="reset" class="btn btn-warning">Clear</button>
              <button 
                type="button" class="btn_drop btn btn-danger" data-toggle="modal" 
                data-target=".modal-confirmation" data-url="<?php echo base_url("upcoming/drop/".$upcoming["ID"])?>">
                Hapus Data
              </button>
            </div>
          </div>
          <!-- elements in form tag -->
	      </form>
      </div>
    </div>
  </div>
</div>
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

<!-- validator -->
<script src="<?php echo base_url("vendors/validator/validator.js"); ?>"></script>
<!-- Autosize -->
<script src="<?php echo base_url("vendors/autosize/dist/autosize.min.js"); ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url("vendors/moment/min/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.js"); ?>"></script>