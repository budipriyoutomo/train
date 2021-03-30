

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Training
        <small>Update/Create Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Training </li>
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
            <label for="varchar">Training <?php echo form_error('idtraining') ?></label>
			<select class='form-control select2' style='width: 100%;' name='idtraining' id='idtraining' onchange="gettraining('this')">
          <option selected ="selected" value="<?php echo 0; ?>" ><?php echo "" ?></option>
				<?php
                    foreach ($idtraining as $train) {
						?>

              <option value="<?php echo $train->idtraining; ?>" ><?php echo $train->nama  ." | ". $train->tanggal ." | ". $train->jam ?></option>

                        <?php
                    }
					?>
			</select>
		</div>



    <div class="box-body" id="detailtraining" name="detailtraining">
    <div class="row">
    <div class="col-xs-3">
            <label for="char">Tempat </label>
            <input type="text" class="form-control" name="tempat" id="tempat" placeholder="tempat"  disabled/>
    </div>
		<div class="col-xs-2">
            <label for="char">Tanggal <?php echo form_error('tanggal') ?></label>
            <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="tanggal"  disabled/>
        </div>
		<div class="col-xs-1">
            <label for="char">jam <?php echo form_error('jam') ?></label>
            <input type="text" class="form-control" name="jam" id="jam" placeholder="jam"  disabled/>
        </div>
		<div class="col-xs-2">
            <label for="char">trainer <?php echo form_error('trainer') ?></label>
            <input type="text" class="form-control" name="trainer" id="trainer" placeholder="trainer" disabled/>
        </div>
		<div class="form-group col-xs-1">
            <label for="char">kapasitas <?php echo form_error('kapasitas') ?></label>
            <input type="text" class="form-control" name="kapasitas" id="kapasitas" placeholder="kapasitas" disabled/>
        </div>
		<div class="form-group col-xs-1">
            <label for="char">tersedia <?php echo form_error('tersedia') ?></label>
            <input type="text" class="form-control" name="tersedia" id="tersedia" placeholder="tersedia" disabled/>
        </div>
		<div class="form-group col-xs-1">
            <label for="char">terisi <?php echo form_error('tersisi') ?></label>
            <input type="text" class="form-control" name="terisi" id="terisi" disabled/>
    </div>
    </div>
    </div>

	    <div class="form-group">
            <input type="hidden" class="form-control" name="iduser" id="iduser" placeholder="Iduser" value="<?php echo $this->session->userdata('id'); ?>" />
        </div>
	    <div class='form-group'>
			<div class='checkbox'>
			<label>
				<input type='checkbox' class='minimal' name='kehadiran' id='kehadiran' value=1 <?php if($kehadiran==1){ echo "checked";}?> /> Kehadiran
			</label>
			</div>
		</div>


	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('ttraining') ?>" class="btn btn-default">Cancel</a>
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
    <!-- /.row -->
<script >
  window.onload = function(){
    if($("#idtraining").val() == 0) //I'm supposing the "Other" option value is 0.
       $("#detailtraining").hide();
  }

	 function gettraining(){
      var idtraining = $('#idtraining').val();

        $.ajax({
			      type: "post",
            datatype : "JSON",
            url: "traincontrol/" + idtraining,
			  success: function(data){
            $("#detailtraining").show();
            $('#tempat').val(data[0].tempat);
      			$('#tanggal').val(data[0].tanggal);
      			$('#jam').val(data[0].jam);
      			$('#trainer').val(data[0].trainer);
      			$('#kapasitas').val(data[0].kapasitas);
      			$('#tersedia').val(data[0].tersedia);
      			$('#terisi').val(data[0].terisi);
          },
        })
    }
</script>
