<!-- Datatables -->
<link href="<?php echo base_url("vendors/datatables.net-bs/css/dataTables.bootstrap.min.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"); ?>" rel="stylesheet">

<div class="page-title">
  <div class="title_left">
    <h3>Asset | View Data</h3>
  </div>
</div>
<div class="clearfix"></div>
<div class="row">
	<div class="col-sm-12">
		<div class="x_panel">
		  <div class="x_title">
		    <h2>Data List</h2>
		    <ul class="nav navbar-right panel_toolbox">
		      <li>
		      	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		      </li>
		      <li>
		      	<a class="close-link"><i class="fa fa-close"></i></a>
		      </li>
		    </ul>
		    <div class="clearfix"></div>
		  </div>
		  <div class="x_content">
		  	<?php
        if(isset($info)){ 
      	?>
      		<div class="alert <?php echo $info["class"]; ?>"><?php echo $info["text"]; ?></div>
        <?php
        }
        ?>
				<table id="datatable-buttons" class="table table-hover table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
				  <thead>
				    <tr>
				      <th><i>Brand</i></th>
				      <th><i>Tipe</i></th>
				      <th><i>Group</i></th>
				      <th><i>Hostname</i></th>
				      <th><i>Ip Address</i></th>
				      <th>Lokasi</th>
				      <th>Status</th>
				      <th>Sistem Operasi</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  	foreach($asset as $row){
						?>
							<tr 
								class="<?php echo $row["ACTIVE"]=="N" ? "red":""; ?>" style="cursor:pointer;" 
								data-url="<?php echo base_url("asset/detail/".$row["ID"])?>">
								<td><?php echo $row["BRAND"] ?></td>
								<td><?php echo $row["TYPE"] ?></td>
								<td><?php echo $row["GROUP"] ?></td>
								<td><?php echo $row["HOSTNAME"] ?></td>
								<td><?php echo $row["IP_ADDRESS"] ?></td>
								<td><?php echo $row["LOCATION"] ?></td>
								<td><?php echo $row["ACTIVE"] ?></td>
								<td><?php echo $row["OPERATING_SYSTEM"] ?></td>
							</tr>
						<?php  		
				  	}
				  	?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>	
</div>

<!-- iCheck -->
<script src="<?php echo base_url("vendors/iCheck/icheck.min.js"); ?>"></script>
<!-- Datatables -->
<script src="<?php echo base_url("vendors/datatables.net/js/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/datatables.net-buttons/js/dataTables.buttons.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/datatables.net-buttons/js/buttons.flash.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/datatables.net-buttons/js/buttons.html5.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/datatables.net-buttons/js/buttons.print.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/datatables.net-responsive/js/dataTables.responsive.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"); ?>"></script>
<script src="<?php echo base_url("vendors/datatables.net-scroller/js/dataTables.scroller.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/jszip/dist/jszip.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/pdfmake/build/pdfmake.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/pdfmake/build/vfs_fonts.js"); ?>"></script>