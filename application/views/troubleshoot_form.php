<!-- bootstrap-daterangepicker -->
<link href="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.css"); ?>" rel="stylesheet">

<div class="page-title">
  <div class="title_left">
    <h3>Troubleshoot | Add New</h3>
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
	      	id="form" action="<?php echo base_url("troubleshoot/add"); ?>" novalidate>
	        
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
                  <option 
                    value="<?php echo $row["ID"] ?>"
                    <?php 
                    if(isset($asset_id)) {
                      echo $asset_id == $row["ID"] ? "selected" : "";
                    }
                    ?>>
                    <?php echo $row["HOSTNAME"]." (".$row["IP_ADDRESS"].")"?>
                  </option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_date">
              Tanggal Kejadian <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input 
                type="text" class="form-control col-md-7 col-xs-12" 
                id="event_date" name="event_date" placeholder="Event Date" required="required" />
              <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-sm-3 col-md-3 col-xs-12" for="description">Deskripsi Permasalahan</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea 
                class="form-control resizable_textarea" name="description" 
                id="description" placeholder="type a text description" required="required"></textarea>
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_date">
              Tanggal Diselesaikan
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input 
                type="text" class="form-control col-md-7 col-xs-12" 
                id="solved_date" name="solved_date" placeholder="Solved Date"/>
              <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-sm-3 col-md-3 col-xs-12" for="description">Solusi Permasalahan</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea 
                class="form-control resizable_textarea" name="troubleshoot" 
                id="troubleshoot" placeholder="type a text troubleshoot"></textarea>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id_solved">
              Diselesaikan Oleh
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="user_id_solved" class="form-control col-md-7 col-xs-12">
                <option></option>
                <?php
                foreach($user as $row){
                ?>
                  <option value="<?php echo $row["ID"] ?>"><?php echo $row["USERNAME"]; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_date">
              Dokumen Pendukung <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" name="document" id="document"/>
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
              <button type="submit" class="btn btn-success">Submit</button>
              <button type="reset" class="btn btn-warning">Clear</button>
            </div>
          </div>
          <!-- elements in form tag -->
	      </form>
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