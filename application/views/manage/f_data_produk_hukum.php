<?php
	$mode	= $this->uri->segment(3);

	if ($mode == "edt" || $mode == "edt_act") {
		
		$idp         = $data->id ;
		$judul      	 = $mode === 'edt' ? $data->judul : set_value('judul');
		$act         = 'edt_act/' . $idp;

	} else {	

		$judul       = $mode === 'add' ? '' : set_value('judul');
		$act		= "add_act";
	}
?>
<form action="<?php echo base_URL()?>manage/data_produk_hukum/<?php echo $act?>" method="post">

	<fieldset><legend><?php echo $title;?></legend>
	
	<br>
	<label style="width: 200px; float: left">Judul</label><input class="input-xxlarge" type="text" name="judul" placeholder="Isikan Judul Kategori" value="<?php echo $judul?>" required><br>	
	<label style="width: 200px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>