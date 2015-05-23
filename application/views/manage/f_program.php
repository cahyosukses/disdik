<?php
$mode	= $this->uri->segment(3);

if ($mode == "edit" || $mode == "act_edit") {
	$act		= "act_edit";
	$idp		= $datpil->id;
	$nama		= $datpil->judul;
	$isi		= $datpil->isi;
} else {
	$act		= "act_add";
	$idp		= "";
	$nama		= "";
	$isi		= "";
}
?>
<form action="<?php echo base_URL()?>manage/program/<?php echo $act?>" method="post">
<input type="hidden" name="idp" value="<?php echo $idp?>">
	<fieldset><legend>Program</legend>
	
	<br>
	<label style="width: 200px; float: left">Judul</label><input class="input-xxlarge" type="text" name="judul" placeholder="Isikan judulnya" value="<?php echo $nama?>" required><br>
	<label style="width: 150px; height: 10px; float: left; display: block">Isi Postingan</label><br><textarea id='tinyMCE'  rows="10" class="span11" name="isi" id="textarea" style="font-family: courier"><?php echo $isi?></textarea><br>
	
	<button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>