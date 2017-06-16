<!-- iCheck -->
<link href="<?php echo base_url("vendors/iCheck/skins/flat/green.css") ?>" rel="stylesheet">

<div class="page-title">
  <div class="title_left">
    <h3>User | Modify</h3>
  </div>
</div>
<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
	      <form 
	      	class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" 
	      	id="form" action="<?php echo base_url("user/modify/".$user["ID"]); ?>" novalidate>
	        <input type="hidden" name="password" value="<?php echo $user["PASSWORD"]; ?>" />
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
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">
              Username <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input 
                type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $user["USERNAME"]; ?>"
                placeholder="Username" required="required" name="username" id="username"/>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_type">
              Tipe User <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="user_type" class="form-control col-md-7 col-xs-12">
                <option></option>
                <option value="SYS" <?php echo $user["USER_TYPE"] == "SYS" ? "selected":""; ?>>SYS</option>
                <option value="ORGANIC" <?php echo $user["USER_TYPE"] == "ORGANIC" ? "selected":""; ?>>ORGANIC</option>
                <option value="VENDOR" <?php echo $user["USER_TYPE"] == "VENDOR" ? "selected":""; ?>>VENDOR</option>
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="new_password">
              New Password <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input 
                type="password" class="form-control col-md-7 col-xs-12" 
                placeholder="New Password" name="new_password" id="new_password"/>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
              Aktif ? <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="radio">
                <label>
                  <input 
                    type="radio" class="flat" name="active" value="Y" 
                    <?php echo $user["ACTIVE"] == "Y" ? "checked":""; ?>> Ya 
                </label>
                <label>
                  <input 
                    type="radio" class="flat" name="active" value="N"
                    <?php echo $user["ACTIVE"] == "N" ? "checked":""; ?>> Tidak 
                </label>
              </div>
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
<!-- iCheck -->
<script src="<?php echo base_url("vendors/iCheck/icheck.min.js"); ?>"></script>
