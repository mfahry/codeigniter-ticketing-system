<div class="page-title">
  <div class="title_left">
    <h3>User | View Data</h3>
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
				<table class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
				  <thead>
				    <tr>
				      <th><i>#</i></th>
				      <th>Username</th>
				      <th>Tipe User</th>
				      <th>Aktif</th>
				      <th>Login Terakhir</th>
				      <th>Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  	$i = 1;
				  	foreach($user as $row){
						?>
							<tr> 
								<td><?php echo $i++; ?></td>
								<td><?php echo $row["USERNAME"]; ?></td>
								<td><?php echo $row["USER_TYPE"]; ?></td>
								<td><?php echo $row["ACTIVE"] == "Y" ? "AKTIF" : "TIDAK AKTIF"; ?></td>
								<td><?php echo $row["LAST_LOGIN"]; ?></td>
								<td>
									<a href="<?php echo base_url("user/modify/".$row["ID"])?>" class="btn btn-primary btn-sm">Ubah</a>
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
</div>