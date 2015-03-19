<?php
$mode	= $this->uri->segment(3);

if ($mode == "edt" || $mode == "edt_act") {
	
	$idp         = $data->id ;
	$judul      	 = $mode === 'edt' ? $data->judul : set_value('judul');
	$video_id      	 = $mode === 'edt' ? $data->video_id : set_value('video_id');
	$act         = 'edt_act/' . $idp;

} else {	

	$judul       = $mode === 'add' ? '' : set_value('judul');
	$video_id       = $mode === 'add' ? '' : set_value('video_id');
	$act		= "add_act";
}
?>
<form action="<?php echo base_URL()?>manage/galeri_video/<?php echo $act?>" method="post">

	<fieldset><legend>Data Video</legend>
	
	<br>
	<label style="width: 200px; float: left">Judul</label><input class="input-xxlarge" type="text" name="judul" placeholder="Isikan Judul" value="<?php echo $judul?>" required><br>	
	<label style="width: 200px; float: left">Video ID (Youtube)</label><input class="input-xxlarge" type="text" name="video_id" placeholder="Isikan Video ID" value="<?php echo $video_id?>" required><br>	
	<label style="width: 200px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>