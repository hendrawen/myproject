<form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Lokasi <?php echo form_error('lokasi') ?></label>
            <!-- <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?php echo $lokasi; ?>" /> -->
            <select name="lokasi" id="lokasi" class="form-control">
                <option disabled selected>--Pilih Rak--</option>
                <?php
                    $number = 1;
                    while($number <= 10){
                        $rak = 'Rak '.$number++;
                ?>
                <option value="<?php echo $rak;?>" <?php if($rak==$lokasi){ echo ' selected="selected"'; }?>><?php echo $rak;?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Bagian <?php echo form_error('bagian') ?></label>
            <!-- <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?php echo $lokasi; ?>" /> -->
            <select name="bagian" id="bagian" class="form-control">
                <option disabled selected>--Pilih Bagian--</option>
                <option value="Ilmu Pengetahuan Alam" <?php if ($bagian=="Ilmu Pengetahuan Alam") {echo "selected";}?>>Ilmu Pengetahuan Alam</option>
                <option value="Ilmu Pengetahuan Sosial" <?php if ($bagian=="Ilmu Pengetahuan Sosial") {echo "selected";}?>>Ilmu Pengetahuan Sosial</option>
                <option value="BAHASA" <?php if ($bagian=="BAHASA") {echo "selected";}?>>BAHASA</option>
                <option value="SEJARAH" <?php if ($bagian=="SEJARAH") {echo "selected";}?>>SEJARAH</option>
                <option value="UMUM" <?php if ($bagian=="UMUM") {echo "selected";}?>>UMUM</option>
            </select>
        </div>
	    <input type="hidden" name="kode_rak" value="<?php echo $kode_rak; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('panelib/rak_buku') ?>" class="btn btn-default">Cancel</a>
	</form>