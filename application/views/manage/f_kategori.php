<?php
$mode	= $this->uri->segment(3);

if ($mode == "edt" || $mode == "edt_act") {
	
	$idp         = $data->id ;
	$nama      	 = $mode === 'edt' ? $data->nama : set_value('nama');
	$act         = 'edt_act/' . $idp;

} else {	

	$nama       = $mode === 'add' ? '' : set_value('nama');
	$act		= "add_act";
}
?>
<form action="<?php echo base_URL()?>manage/kategori_berita/<?php echo $act?>" method="post">

	<fieldset><legend>Kategori Berita</legend>
	
	<br>
	<label style="width: 200px; float: left">Judul</label><input class="input-xxlarge" type="text" name="nama" placeholder="Isikan Nama Kategori" value="<?php echo $nama?>" required><br>	
	<label style="width: 200px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>