

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper"> 
<!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Master Training 
        <small>Update/Create Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master Training </li>
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
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tempat <?php echo form_error('tempat') ?></label>
            <input type="text" class="form-control" name="tempat" id="tempat" placeholder="Tempat" value="<?php echo $tempat; ?>" />
        </div>
		 <div class="form-group">
                <label for="date">Tanggal <?php echo form_error('Tanggal') ?></label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="datepicker" name="tanggal" placeholder="tanggal" value="<?php if($tanggal!=null){ echo date("m/d/Y",strtotime($tanggal));}else{ echo $tanggal; }  ?>" />
				 
                </div>
                <!-- /.input group -->
        </div>
              <!-- /.form group -->
	    <div class="form-group">
				<div class="bootstrap-timepicker">
                  <label for="time">Jam <?php echo form_error('Jam') ?></label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="jam" id="jam" placeholder="jam" value="<?php echo date("h:i A",strtotime($jam)); ?>" >
					
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>	
	    <div class="form-group">
            <label for="varchar">Trainer <?php echo form_error('trainer') ?></label>
            <input type="text" class="form-control" name="trainer" id="trainer" placeholder="Trainer" value="<?php echo $trainer; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Kapasitas <?php echo form_error('kapasitas') ?></label>
            <input type="text" class="form-control" name="kapasitas" id="kapasitas" placeholder="Kapasitas" value="<?php echo $kapasitas; ?>" />
        </div>
	    
	    <input type="hidden" name="idtraining" value="<?php echo $idtraining; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('mtraining') ?>" class="btn btn-default">Cancel</a>
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