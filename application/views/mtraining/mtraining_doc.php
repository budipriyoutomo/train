<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Mtraining List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama</th>
		<th>Tempat</th>
		<th>Tanggal</th>
		<th>Jam</th>
		<th>Trainer</th>
		<th>Kapasitas</th>
		<th>Tersedia</th>
		<th>Terisi</th>
		
            </tr><?php
            foreach ($mtraining_data as $mtraining)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $mtraining->nama ?></td>
		      <td><?php echo $mtraining->tempat ?></td>
		      <td><?php echo $mtraining->tanggal ?></td>
		      <td><?php echo $mtraining->jam ?></td>
		      <td><?php echo $mtraining->trainer ?></td>
		      <td><?php echo $mtraining->kapasitas ?></td>
		      <td><?php echo $mtraining->tersedia ?></td>
		      <td><?php echo $mtraining->terisi ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>