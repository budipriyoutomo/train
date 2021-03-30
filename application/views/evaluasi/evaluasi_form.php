       <!-- MEMBUAT FORM -->
       <form action="<?php echo $action; ?>" method="post">
       <div class="form-group">
           <label for="varchar">Nilai <?php echo form_error('nilai') ?></label>
           <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Nilai" value="<?php echo $nilai; ?>" />
       </div>
       <div class="form-group">
           <label for="varchar">Evaluasi <?php echo form_error('evaluasi') ?></label>
           <input type="text" class="form-control" name="evaluasi" id="evaluasi" placeholder="evaluasi" value="<?php echo $evaluasi; ?>" />
       </div>
       <input type="hidden" name="id" value="<?php echo $id; ?>" />
       <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
       </form>
