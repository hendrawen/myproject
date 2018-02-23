<form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="enum">Kelas <?php echo form_error('kelas') ?></label>
            <!-- <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Kelas" value="<?php echo $kelas; ?>" /> -->
            <select name="kelas" id="kelas" class="form-control">
                <option disabled selected>--Pilih Kelas--</option>
                <option value="X" <?php if ($kelas=="X") {echo "selected";}?>>X</option>
                <option value="XI" <?php if ($kelas=="XI") {echo "selected";}?>>XI</option>
                <option value="XII" <?php if ($kelas=="XII") {echo "selected";}?>>XII</option>
            </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Jurusan <?php echo form_error('jurusan[]') ?></label>
            <!-- <input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="Jurusan" value="<?php echo $jurusan; ?>" /> -->
            <select name="jurusan[]" id="jurusan[]" class="form-control">
                <option disabled selected>--Pilih Jurusan--</option>
                <option value="IPA">Ilmu Pengetahuan Alam</option>
                <option value="IPS">Ilmu Pengetahuan Sosial</option>
                <option value="BAHASA">BAHASA</option>
                <option value="Lainnya">Lainnya</option>
            </select><br>
            <label for="varchar">Keberapa </label>
            <select name="jurusan[]" id="jurusan[]" class="form-control" required>
                <option disabled selected>--Pilih Keberapa--</option>
                <?php
                    $number = 0;
                    while($number <= 10){
                        $number++;
                ?>
                <option value="<?php echo $number;?>"><?php echo $number; ?></option>
                <?php
                    }
                ?>
            </select>
        </div>
	    <!-- <div class="form-group">
            <label for="int">Keberapa </label>
            <input type="number" min="1" class="form-control" name="jurusan[]" id="jurusan" placeholder="Keberapa" value="<?php echo $jurusan; ?>" required />
        </div> -->
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
	    <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('panelib/kelas') ?>" class="btn btn-default">Cancel</a>
	</form>
