<legend style="margin-bottom: 10px">Selamat Datang</legend>
<p><a href="<?php echo base_URL()?>manage/haldep/edit"><b>Edit</b></a></p>
<?php echo $this->session->flashdata("k");?>

<?php

if ($this->uri->segment(3) == "edit") {
	echo "<form action='".base_URL()."manage/haldep/act_edit' method='post'>
		<textarea id='tinyMCE'  id='tinyMCE' name='isi' class='span11'>".$haldep->isi."</textarea><br><input type='submit' value='Simpan' class='btn'></form>";
} else {
	echo "<p>".$haldep->isi."</p>";
}

?>

