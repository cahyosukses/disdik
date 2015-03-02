<?php
$mode	= $this->uri->segment(3);

if ($mode == "edit" || $mode == "act_edit") {
	$act		= "act_edit";
	$idp		= $datpil->id;
	$nama		= $datpil->nama;
	$alamat		= $datpil->alamat;
} else {
	$act		= "act_add";
	$idp		= "";
	$nama		= "";
	$alamat		= "";
}
?>
<form action="<?php echo base_URL()?>manage/link/<?php echo $act?>" method="post">
<input type="hidden" name="idp" value="<?php echo $idp?>">
	<fieldset><legend>Form</legend>
	
	<br>
	<label style="width: 200px; float: left">Nama</label><input class="input-large" type="text" name="nama" placeholder="Isikan namanya" value="<?php echo $nama?>" required><br>	<label style="width: 200px; float: left">Alamat</label><input class="input-xxlarge" type="text" name="alamat" placeholder="Isikan Alamatnya" value="<?php echo $alamat?>" required><br>
	
	<label style="width: 200px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>