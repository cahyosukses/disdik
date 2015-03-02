<?php
$mode	= $this->uri->segment(3);

if ($mode == "edit" || $mode == "act_edit") {
	$act		= "act_edit";
	$id_data	= $komen_pilih->id;
	$id_post	= $komen_pilih->id_berita;
	$nama		= $komen_pilih->nama;
	$email		= $komen_pilih->email;
	$pesan		= $komen_pilih->komentar;

} else {
	$act		= "act_add";
	$id_data	= "";
	$id_post	= "";
	$nama		= "";
	$email		= "";
	$pesan		= "";
}
?>
<form action="<?php echo base_URL()?>manage/komentar/<?php echo $act?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">	

<input type="hidden" name="id_data" value="<?php echo $id_data?>">
<input type="hidden" name="id_post" value="<?php echo $id_post?>">

	<legend>Form komentar</legend>
	<?php echo $this->session->flashdata("k");?>

	<label style="width: 150px; float: left">Nama</label><input class="span4" type="text" name="nama" placeholder="Isikan namanya" value="<?php echo $nama?>" required><br>
	<label style="width: 150px; float: left">Email</label><input class="span4" type="email" name="email" placeholder="Isikan emailnya" value="<?php echo $email?>" required><br>
	<label style="width: 150px; float: left">Pesan</label><input class="span8" type="text" name="pesan" placeholder="Isikan pesannya" value="<?php echo $pesan?>" required><br>

	<label style="width: 150px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>
</form>