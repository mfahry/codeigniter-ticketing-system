<!-- Switchery -->
<link href="<?php echo base_url("vendors/switchery/dist/switchery.min.css"); ?>" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.css"); ?>" rel="stylesheet">

<div class="page-title">
  <div class="title_left">
    <h3>Asset | Add New</h3>
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
	      	id="form" action="<?php echo base_url("asset/add"); ?>" novalidate>
	        
	        <!-- Smart Wizard -->
	        <p>Mohon masukkan data-data sesuai dengan yang seharusnya. Terima Kasih</p>
	        <?php
	        if(isset($info)){ 
        	?>
        		<div class="alert <?php echo $info["class"]; ?>"><?php echo $info["text"]; ?></div>
	        <?php
	        }
	        ?>
	        <div id="wizard" class="form_wizard wizard_horizontal">
	          
	          <!-- Wizard Steps Header -->
	          <ul class="wizard_steps">
	            <li>
	              <a href="#step-1">
	                <span class="step_no">1</span>
	                <span class="step_descr">
	                	Step 1<br />
	                  <small>Informasi Utama</small>
	                </span>
	              </a>
	            </li>
	            <li>
	              <a href="#step-2">
	                <span class="step_no">2</span>
	                <span class="step_descr">
	                  Step 2<br />
	                  <small>Informasi Pendukung</small>
		              </span>
	              </a>
	            </li>
	            <li>
	              <a href="#step-3">
	                <span class="step_no">3</span>
	                <span class="step_descr">
	                  Step 3<br />
	                  <small>Daftar Port yang dibuka</small>
	                </span>
	              </a>
	            </li>
	            <li>
	              <a href="#step-4">
	                <span class="step_no">4</span>
	                <span class="step_descr">
	                  Step 4<br />
	                  <small>Dokumen</small>
	                </span>
	              </a>
	            </li>
	          </ul>
	          <!-- Wizard Steps Header -->
	          
	          <!-- SmartWizard Content -->
	          <div id="step-1">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
                	<i>Hostname</i> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="hostname" name="hostname" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand">
                	<i>Brand</i> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="brand" name="brand" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand">
                	Tipe <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="type" name="type" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ip_address">
                	<i>IP Address Management</i> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input 
                  	type="text" id="ip_address" name="ip_address" required="required" class="form-control col-md-7 col-xs-12" data-inputmask="'mask' : '999.999.999.999'"
                	/>
                	<span class="fa fa-wifi form-control-feedback right" aria-hidden="true"></span>
                  <button style="margin-top: 5px; " type="button" class="btn btn-default btn-sm" id="btn_snmp">Check SNMP !!</button>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ip_address">
                  <i>Port Management</i> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input 
                    type="text" id="port_asset" name="port_asset" required="required" class="form-control col-md-7 col-xs-12"
                  />
                  <span class="fa fa-plug form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">
                	Lokasi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="location" name="location" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="operating_system">
                	Sistem Operasi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="operating_system" name="operating_system" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="serial_number">
                	<i>Serial Number</i> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input 
                  	type="text" id="serial_number" name="serial_number" required="required" class="form-control col-md-7 col-xs-12" data-inputmask="'mask' : '****-****-****-****-****-***'"
                	/>
                	<span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="group_id">
                	<i>Group</i> <span class="required">*</span>
              	</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="group_id" id="group_id" class="form-control col-md-3 col-xs-12" required="required">
                  	<option></option>
                  	<?php
                  	foreach($asset_group as $row) {
                  	?>
                  		<option value="<?php echo $row["ID"]; ?>"><?php echo $row["NAME"]; ?></option>	
                  	<?php
                  	}
                  	?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="active">
                	Aktif <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label>
                    <input type="checkbox" name="active" id="active" class="js-switch" checked/>
                  </label>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">
                	Foto <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" name="photo">
                </div>
              </div>
              <hr/>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="buy_price">
                	Harga Beli <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="buy_price" name="buy_price" class="form-control col-md-7 col-xs-12" required="required"/>
                	<span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="buy_date">
                	Tanggal Beli
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input 
                  	type="text" class="form-control col-md-4 col-xs-8" 
                  	id="buy_date" name="buy_date" placeholder="Buy Date"/>
                  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expired_maintenance_date">
                	Tanggal <i>Maintenance</i> Berakhir
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input 
                  	type="text" class="form-control col-md-4 col-xs-8" 
                  	id="expired_maintenance_date" name="expired_maintenance_date" placeholder="Expired Maintenance Date" />
                  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expired_maintenance_date">
                  <i>End of Support Date</i>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input 
                    type="text" class="form-control col-md-4 col-xs-8" 
                    id="end_of_support_date" name="end_of_support_date" placeholder="End Of Support Date" />
                  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_of_sale_date">
                	<i>End of Sale Date</i>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input 
                  	type="text" class="form-control col-md-4 col-xs-8" 
                  	id="end_of_sale_date" name="end_of_sale_date" placeholder="EoS Date"/>
                  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_of_life_date">
                	<i>End of Life Date</i>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input 
                  	type="text" class="form-control col-md-4 col-xs-8" 
                  	id="end_of_life_date" name="end_of_life_date" placeholder="EoL Date"/>
                  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
            </div>
	          <div id="step-2">
	            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cable_type">
                	Tipe Kabel
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="cable_type" name="cable_type" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                	Koordinat Server
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                	<div class="row">
	                	<div class="col-md-3 col-sm-5 col-xs-5">
	                		<input 
	                			type="text" id="cable_x_coordinate" 
	                			name="cable_x_coordinate" class="form-control col-xs-12" placeholder="X Value" />
                		</div>
                		<div class="col-md-1 col-sm-2 col-xs-2 text-center"><h5>,</h5></div>
	                	<div class="col-md-3 col-sm-5 col-xs-5">
	                		<input 
	                			type="text" id="cable_y_coordinate" 
	                			name="cable_y_coordinate" class="form-control col-xs-12" placeholder="Y Value" 
                			/>
                		</div>	
                	</div>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ha_mode">
                	<i>HA Mode</i>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="ha_mode" id="ha_mode" class="form-control col-md-7 col-xs-12">
                  	<option></option>
                  	<option value="AA">AA</option>
                  	<option value="AP">AP</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="asset_function">
                	Fungsi Aset
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                	<textarea 
                		class="resizable_textarea form-control" placeholder="Function Description" 
                		name="asset_function" id="asset_function"></textarea>  
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="spesification">
                	Spesifikasi
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                	<textarea 
                		class="resizable_textarea form-control" placeholder="spesification Description"
                		name="specification" id="specification"></textarea>  
                </div>
              </div>
	          </div>
	          <div id="step-3">
	          	<div class="row">
	          		<div class="
	          			col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 
	          			col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">

          				<table id="table_port" class="table table-bordered">
			          		<thead>
			          			<tr>
			          				<th><i>Port</i></th>
			          				<th><i>IP Address</i></th>
			          				<th class="text-center">Aksi</th>
			          			</tr>
			          		</thead>
			          		<tbody></tbody>
			          	</table>
          			</div>
	          	</div>
	          	<div class="row">
	          		<div class="col-xs-12 text-center">
	          			<input type="button" value="Add Port" id="add_port" class="btn btn-default btn-xs"/>
	          		</div>
	          	</div>
	          </div>
	          <div id="step-4">
	          	<div class="row">
	          		<div class="
	          			col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 
	          			col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">

          				<table id="table_document" class="table table-bordered">
			          		<thead>
			          			<tr>
			          				<th>Nama Dokumen</th>
			          				<th>Dokumen</th>
			          				<th>Deskripsi</th>
			          				<th class="text-center">Aksi</th>
			          			</tr>
			          		</thead>
			          		<tbody></tbody>
			          	</table>
          			</div>
	          	</div>
	          	<div class="row">
	          		<div class="col-xs-12 text-center">
	          			<input type="button" value="Add Document" id="add_document" class="btn btn-default btn-xs"/>
	          		</div>
	          	</div>
	          </div>
	        </div>
	        <!-- End SmartWizard Content -->

	      <!-- End Smart Wizard -->
	      </form>
      </div>
    </div>
  </div>
</div>
<div id="modal_snmp" class="modal fade modal-confirmation" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Pemberitahuan</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery Smart Wizard -->
<script src="<?php echo base_url("vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"); ?>"></script>
<!-- validator -->
<script src="<?php echo base_url("vendors/validator/validator.js"); ?>"></script>
<!-- Switchery -->
<script src="<?php echo base_url("vendors/switchery/dist/switchery.min.js"); ?>"></script>
<!-- Autosize -->
<script src="<?php echo base_url("vendors/autosize/dist/autosize.min.js"); ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url("vendors/moment/min/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.js"); ?>"></script>
<!-- jquery.inputmask -->
<script src="<?php echo base_url("vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"); ?>"></script>

