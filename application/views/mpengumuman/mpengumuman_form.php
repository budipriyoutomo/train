

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper"> 
<!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Master Pengumuman 
        <small>Update/Create Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master Pegumuman </li>
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
            <label for="pengumuman">Pengumuman <?php echo form_error('pengumuman') ?></label>
            <textarea class="form-control" rows="3" name="pengumuman" id="pengumuman" placeholder="Pengumuman"><?php echo $pengumuman; ?></textarea>
        </div>
	    
		<div class="form-group">
                <label for="date">Start <?php echo form_error('start') ?></label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="datepicker" name="start" placeholder="start" value="<?php if($start!=null){ echo date("m/d/Y",strtotime($start));}else{ echo $start; }  ?>" />
				 
                </div>
                <!-- /.input group -->
        </div>
	    
		<div class="form-group">
                <label for="date">End <?php echo form_error('end') ?></label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="datepicker" name="end" placeholder="end" value="<?php if($end!=null){ echo date("m/d/Y",strtotime($end));}else{ echo $end; }  ?>" />
				 
                </div>
                <!-- /.input group -->
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('mpengumuman') ?>" class="btn btn-default">Cancel</a>
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