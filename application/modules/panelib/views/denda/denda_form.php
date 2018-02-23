<form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Denda <?php echo form_error('denda') ?></label>
            <input type="number" class="form-control" min="1" name="denda" id="denda" placeholder="Denda" value="<?php echo $denda; ?>" />
        </div>
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
	    <input type="hidden" name="id_denda" value="<?php echo $id_denda; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('panelib/denda') ?>" class="btn btn-default">Cancel</a>
	</form>