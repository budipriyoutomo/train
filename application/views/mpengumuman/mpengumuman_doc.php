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
        <h2>Mpengumuman List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Pengumuman</th>
		<th>Start</th>
		<th>End</th>
		
            </tr><?php
            foreach ($mpengumuman_data as $mpengumuman)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $mpengumuman->pengumuman ?></td>
		      <td><?php echo $mpengumuman->start ?></td>
		      <td><?php echo $mpengumuman->end ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>