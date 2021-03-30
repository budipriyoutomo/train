

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Training
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


        <div id="mytable">

        </div>


        <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Edit Nilai</h4>
               </div>
               <div class="modal-body">
               <div class="fetched-data"></div>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
           </div>
       </div>
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
        function getdetail(){
           var idtraining = $('#idtraining').val();

             $.ajax({
                 type: "post",
                 datatype : "JSON",
                 url: "evaluasi/evcontrol/" + idtraining,
             success: function(data){

                    // create table
                    if($('table#detailtab').length){
                        var $table = document.getElementById('detailtab')

                        for(var i = document.getElementById('detailtab').rows.length;i > 0;i--)
                        {
                          $table.deleteRow(i -1);
                        }
                          $('table').remove();
                      //    var $table = $('<table class=table table-bordered table-striped id="detailtab">');
                    }//else {

                      var $table = $('<table class=table table-bordered table-striped id="detailtab">');
                      $table.append('<caption>Evaluasi Training Table</caption>')
                      // thead
                      .append('<thead>').children('thead')
                      .append('<tr />').children('tr').append('<th>Training</th><th>User</th><th>Kehadiran</th><th>Nilai</th><th>Evaluasi</th><th>Action</th>');

                      //tbody
                      var $tbody = $table.append('<tbody />').children('tbody');
                //    }


                    // caption
                $.each(data,function(i){
                    // add row
                    $tbody.append('<tr />').children('tr:last')

                    //.append("<td>"+ data[i].id + "</td>")
                    .append("<td>"+ data[i].training + "</td>")
                    .append("<td>"+ data[i].user + "</td>")
                    .append("<td>"+ data[i].kehadiran + "</td>")
                    .append("<td>"+ data[i].nilai + "</td>")
                    .append("<td>"+ data[i].evaluasi + "</td>")
                    .append("<td><a href=#myModal class='btn btn-primary edit-nilai' id=trainid name=trainid data-toggle=modal data-value="+ data[i].id +">Edit</a></td>");


                  });

                    // add table to dom
                    $table.appendTo('#mytable');

               },
             });
         }


        </script>

<script type="text/javascript">
/*$('#myModal').on('show.bs.modal', function (e) {
  window.alert("modal");
    var rowid = $(e.relatedTarget).data('id');
    window.alert(rowid);
    //menggunakan fungsi ajax untuk pengambilan data
    $.ajax({
        type : 'post',
        url : 'evaluasi/editnilai/' + rowid,
        success : function(data){
        window.alert("test edit nilai");
        $('.fetched-data').html(data);//menampilkan data ke dalam modal
        }
    });
 });
*/
//$(document).on("click", "a", function(){
  $("#mytable").on("click", ".edit-nilai",function(e){
    e.preventDefault();
    var idtraining = $(this).data('value');

     $.ajax({
         type: "post",
         datatype : "JSON",
         url: "evaluasi/editnilai/" + idtraining,
     success: function(data){
       $('.fetched-data').html(data);
     },
   });
});
</script>
