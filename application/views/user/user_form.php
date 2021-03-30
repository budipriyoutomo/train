

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        User
        <small>Update/Create Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User </li>
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
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Role <?php echo form_error('role') ?></label>
			<select class="form-control select2" style="width: 100%;" name="role" id="role" >
                  <option>Admin</option>
                  <option>User</option>
                </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">NIK <?php echo form_error('NIK') ?></label>
            <input type="text" class="form-control" name="NIK" id="NIK" placeholder="NIK" value="<?php echo $NIK; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Dept <?php echo form_error('dept') ?></label>
			<select class='form-control select2' style='width: 100%;' name='dept' id='dept' >
           <?php
                foreach ($dept as $depart) {
								?>
                <option <?php echo $dept_selected == $depart->iddept ? 'selected="selected"' : '' ?>
                value="<?php echo $depart->iddept;?>"><?php echo $depart->nama ?></option>
                <?php
              }
              ?>
		</select>
		</div>
	    <div class="form-group">
            <label for="varchar">Jabatan <?php echo form_error('jabatan') ?></label>
            <select class='form-control select2' style='width: 100%;' name='jabatan' id='jabatan' >	<?php
              foreach ($jabatan as $jab) {
                  ?>
                  <option <?php echo $jabatan_selected == $jab->idjabatan ? 'selected="selected"' : '' ?>
                  class="<?php echo $jab->iddept ?>"  value="<?php echo $jab->idjabatan ?>"><?php echo $jab->namajabatan ?></option>
                <?php
                }
                ?>
              	</select>
			</div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a>
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
