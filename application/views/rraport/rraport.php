  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Raport Peserta Training
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Raport Peserta Training</li>
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

                    <label for="varchar">Peserta Training <?php echo form_error('iduser') ?></label>
        			<select class='form-control select2' style='width: 100%;' name='iduser' id='iduser' onchange="getdetail('this')">
                  <option selected ="selected" value="<?php echo 0; ?>" ><?php echo "" ?></option>
        				<?php
                            foreach ($iduser as $row) {
        						?>
                      <option value="<?php echo $row->id; ?>" ><?php echo $row->nama ?></option>
                                <?php
                            }
        					?>
        			</select>

              <div class="box-body" id="detailraport" name="detailraport">
              <div class="row">
              <div class="col-xs-3">
                      <label for="char">Tempat </label>
                      <input type="text" class="form-control" name="peserta" id="peserta" placeholder="peserta"  disabled/>
              </div>
          		<div class="col-xs-3">
                      <label for="char">Tanggal</label>
                      <input type="text" class="form-control" name="NIK" id="NIK" placeholder="NIK"  disabled/>
                  </div>
          		<div class="col-xs-3">
                      <label for="char">jam <?php echo form_error('jam') ?></label>
                      <input type="text" class="form-control" name="dept" id="dept" placeholder="dept"  disabled/>
                  </div>
          		<div class="col-xs-3">
                      <label for="char">trainer <?php echo form_error('trainer') ?></label>
                      <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="jabatan" disabled/>
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
          if($("#iduser").val() == 0) //I'm supposing the "Other" option value is 0.
             $("#detailraport").hide();
        }


        function getdetail(){
           var iduser = $('#iduser').val();

             $.ajax({
                 type: "post",
                 datatype : "JSON",
                 url: "rtraining/generate/" + iduser,
             success: function(data){

                $("#detailraport").show();
                $('#peserta').val(data[0].peserta);
          			$('#NIK').val(data[0].NIK);
          			$('#dept').val(data[0].dept);
          			$('#jabatan').val(data[0].jabatan);


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
                      $table.append('<caption>Buku Raport Training</caption>')
                      // thead
                      .append('<thead>').children('thead')
                      .append('<tr />').children('tr').append('<th>Training</th><th>Nilai</th><th>Evaluasi</th>');

                      //tbody
                      var $tbody = $table.append('<tbody />').children('tbody');

                    // caption
                $.each(data,function(i){
                    // add row
                    $tbody.append('<tr />').children('tr:last')
                    .append("<td>"+ data[i].training + "</td>")
                    .append("<td>"+ data[i].nilai + "</td>")
                    .append("<td>"+ data[i].evaluasi + "</td>");


                  });
                    // add table to dom
                    $table.appendTo('#mytable');
               },
             });
         }


        </script>
