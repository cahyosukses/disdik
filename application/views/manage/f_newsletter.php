<?php
$mode	= $this->uri->segment(3);

if ($mode == "edit" || $mode == "act_edit") {
	$act		= "act_edit/" . $berita_pilih->id;	
	$judul		= $mode === 'edit' ? $berita_pilih->judul : set_value('judul');
	$keterangan	= $mode === 'edit' ? $berita_pilih->keterangan : set_value('keterangan');
	

} else {
	$act		= "act_add";
	$id_data	= "";
	$judul		= $mode === 'add' ? '' : set_value('judul');
	$keterangan	= $mode === 'add' ? '' : set_value('keterangan');
}
?>

<form action="<?php echo base_URL()?>manage/newsletter/<?php echo $act?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
	<legend>Form Newsletter</legend>
	<?php echo $this->session->flashdata("k");?>
	<label style="width: 150px; float: left">Judul</label><input class="span11" type="text" name="judul" placeholder="Isikan judulnya" value="<?php echo $judul?>" required><br>
	<label style="width: 150px; float: left">Keterangan</label><input class="span11" type="text" name="keterangan" placeholder="Isikan Keterangannya" value="<?php echo $keterangan?>" required><br>
	<label style="width: 135px; height: 10px; float: left; display: block">File Gambar</label><input style="float: left; display: block" class="search-query" type="file" name="file_gambar"><br><br>
	<label style="width: 135px; height: 10px; float: left; display: block">File Dokumen</label><input style="float: left; display: block" class="search-query" type="file" name="file_dokumen"><br><br>
	<br><br><br><br>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>