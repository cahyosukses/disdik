<?php
	$mode	= $this->uri->segment(3);

	if ($mode == "edit" || $mode == "act_edit") {
		
		$id_data	= $opini_pilih->id;
		$judul		= $mode === 'edit' ? $opini_pilih->judul : set_value('judul');
		$isi		= $mode === 'edit' ? $opini_pilih->isi : set_value('isi');
		
		$act		= "act_edit/" . $id_data;

	} else {
		$act		= "act_add";
		$id_data	= "";
		$judul		= $mode === 'add' ? '' : set_value('judul');
		$isi		= $mode === 'add' ? '' : set_value('isi');
	}
?>

<form action="<?php echo base_URL()?>manage/opini/<?php echo $act?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
	<input type="hidden" name="id_data" value="<?php echo $id_data?>">

	<legend>Form Opini</legend>
	<?php echo $this->session->flashdata("k");?>

	<label style="width: 150px; float: left">Judul Opini</label><input class="span11" type="text" name="judul" placeholder="Isikan judulnya" value="<?php echo $judul?>" required><br>		
	<label style="width: 150px; height: 10px; float: left; display: block">Isi</label><br><textarea id='tinyMCE'  rows="10" class="span11" name="isi" id="textarea" style="font-family: courier"><?php echo $isi?></textarea><br>
	<br>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>