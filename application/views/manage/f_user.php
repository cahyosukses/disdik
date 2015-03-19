<?php
	$mode	= $this->uri->segment(3);

	if ($mode == "edt" || $mode == "edt_act") {
		
		$idp   = $data->id ;
		$u     = $mode === 'edt' ? $data->u : set_value('u');
		$nama  = $mode === 'edt' ? $data->nama : set_value('nama');
		$email = $mode === 'edt' ? $data->email : set_value('email');
		$level = $mode === 'edt' ? $data->level : set_value('level');
		$aktif = $mode === 'edt' ? $data->aktif : set_value('aktif');
		
		$act   = 'edt_act/' . $idp;

	} else {	
		$u    = $mode === 'add' ? '' : set_value('u');
		$nama = $mode === 'add' ? '' : set_value('nama');
		$email = $mode === 'add' ? '' : set_value('email');
		$level = $mode === 'add' ? '' : set_value('level');
		$aktif = $mode === 'add' ? '' : set_value('aktif');

		$act		= "add_act";
	}
?>

<form action="<?php echo base_URL()?>manage/user/<?php echo $act?>" method="post">

	<fieldset><legend>Managemen User</legend>	
	<br>
	
	<?php if ($mode == "edt" || $mode == "edt_act") { ?>	
	<label style="width: 200px; float: left">User Name</label><input class="input-large" type="text" name="u" placeholder="" value="<?php echo $u?>" required readonly><br>	
	<?php }else{ ?>
	<label style="width: 200px; float: left">User Name</label>
	<input class="input-large" type="text" name="u" placeholder="" value="<?php echo $u?>" required><br>	
	<label style="width: 200px; float: left"></label><label style="width: 200px; float: left">* Pass default = User Name</label><p></p><br>
	<?php } ?>
	
	<label style="width: 200px; float: left">Nama Lengkap</label><input class="input-large" type="text" name="nama" placeholder="" value="<?php echo $nama?>" required><br>	
	<label style="width: 200px; float: left">Email</label><input class="input-large" type="text" name="email" placeholder="" value="<?php echo $email?>"><br>	
	<label style="width: 200px; float: left">Level</label>
	<select name="level" required>
		<option <?php echo $level === '2' ? 'selected':'';?> value="2">Post Berita</option>
		<option <?php echo $level === '1' ? 'selected':'';?> value="1">Administrator</option>
	</select><br>

	<label style="width: 200px; float: left">Status</label>
	<select name="aktif" required>
		<option <?php echo $aktif === 'Y' ? 'selected':'';?> value="Y">Aktif</option>
		<option <?php echo $aktif === 'N' ? 'selected':'';?> value="N">Non Aktif</option>
	</select><br>
	
	<label style="width: 200px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>