

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper"> 
<!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Master Jabatan 
        <small>Update/Create Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master Jabatan </li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
	      <div class="row">
        <div class="col-xs-12">
        

          <div class="box">
            <div class="box-header">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
	
		
        
        <form action="<?php echo $action; ?>" method="post">
	    
		
		<?php 
		
			echo "<div class='form-group'>";
			echo "<label for='int'>Departement "; 
			echo form_error('iddept');
			echo "</label>";
			echo "<select class='form-control select2' style='width: 100%;' name='iddept' id='iddept' onchange='getdept(this);'>";
			echo "<option selected='selected' value=";
			echo $iddept.">";
			if($iddept!=null){ echo $namadept;}else{ echo "";};
			echo "</option>";
		
			
				
					foreach($query as $row){
						
						echo "<option value=";
						echo $row->iddept; 
						echo ">";
						echo $row->nama; 
						echo "</option>";
					
					}
				
				
                   echo "</select >";
        echo "</div>";
		?>
	    <div class="form-group">
            <label for="varchar">Namajabatan <?php echo form_error('namajabatan') ?></label>
            <input type="text" class="form-control" name="namajabatan" id="namajabatan" placeholder="Namajabatan" value="<?php echo $namajabatan; ?>" />
        </div>
	    <input type="hidden" name="idjabatan" value="<?php echo $idjabatan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('mjabatan') ?>" class="btn btn-default">Cancel</a>
	</form>
    
	
			</div>
            <!-- /.box-body -->    
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	  </div>