

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Report Training
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Evaluasi </li>
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

                    <label for="varchar">Training <?php echo form_error('idtraining') ?></label>
        			<select class='form-control select2' style='width: 100%;' name='idtraining' id='idtraining' onchange="getdetail('this')">
                  <option selected ="selected" value="<?php echo 0; ?>" ><?php echo "" ?></option>
        				<?php
                            foreach ($idtraining as $train) {
        						?>

                      <option value="<?php echo $train->idtraining; ?>" ><?php echo $train->nama ?></option>

                                <?php
                            }
        					?>
        			</select>

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
                      <label for="char">terisi <?php echo form_error('tersisi') ?></label>
                      <input type="text" class="form-control" name="terisi" id="terisi" disabled/>
              </div>
              </div>
              </div>


        <div id="mytable">

        </div>
		<div class="row" style="margin-bottom: 10px">

            <div class="col-md-6">


		<?php echo anchor(site_url('ttraining/excel'), '<i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('ttraining/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-info btn-sm"'); ?>
	    </div>
</div>


			</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

		</section>
		</div>

        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

        <script>
        window.onload = function(){
          if($("#idtraining").val() == 0) //I'm supposing the "Other" option value is 0.
             $("#detailtraining").hide();
        }


        function getdetail(){
           var idtraining = $('#idtraining').val();

             $.ajax({
                 type: "post",
                 datatype : "JSON",
                 url: "rtraining/generate/" + idtraining,
             success: function(data){

                $("#detailtraining").show();
                $('#tempat').val(data[0].tempat);
          			$('#tanggal').val(data[0].tanggal);
          			$('#jam').val(data[0].jam);
          			$('#trainer').val(data[0].trainer);
          			$('#terisi').val(data[0].terisi);

                    // create table
                    if($('table#detailtab').length){
                        var $table = document.getElementById('detailtab')

                        for(var i = document.getElementById('detailtab').rows.length;i > 0;i--)
                        {
                          $table.deleteRow(i -1);
                        }
                          $('table').remove();

                    }

                      var $table = $('<table class=table table-bordered table-striped id="detailtab">');
                      $table.append('<caption>Detail Peserta Training</caption>')
                      // thead
                      .append('<thead>').children('thead')
                      .append('<tr />').children('tr').append('<th>Peserta</th><th>Departement</th><th>Jabatan</th><th>Nilai</th><th>Evaluasi</th>');

                      //tbody
                      var $tbody = $table.append('<tbody />').children('tbody');

                    // caption
                $.each(data,function(i){
                    // add row
                    $tbody.append('<tr />').children('tr:last')
                    .append("<td>"+ data[i].peserta + "</td>")
                    .append("<td>"+ data[i].dept + "</td>")
                    .append("<td>"+ data[i].jabatan + "</td>")
                    .append("<td>"+ data[i].nilai + "</td>")
                    .append("<td>"+ data[i].evaluasi + "</td>");


                  });
                    // add table to dom
                    $table.appendTo('#mytable');
               },
             });
         }


        </script>
