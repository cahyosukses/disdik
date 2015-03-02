<?php
	$id_sekolah   = $this->uri->segment(3);
	$mode         = $this->uri->segment(4);
	$nama_sekolah = $this->basecrud_m->get_where('data_sekolah',array('id' => $id_sekolah ))->row()->nama;
	

	//var_dump($data);
	if ($mode === "edt" || $mode === "edt_act") {	
		
		$idp         = $data->id;	
		$tahun       = $mode === 'edt' ? $data->tahun : set_value('tahun');		
		$rombel      = $mode === 'edt' ? $data->rombel : set_value('rombel');
		$murid       = $mode === 'edt' ? $data->murid : set_value('murid');
		$guru        = $mode === 'edt' ? $data->guru : set_value('guru');
		$ruang_kelas = $mode === 'edt' ? $data->ruang_kelas : set_value('ruang_kelas');
		$lulusan     = $mode === 'edt' ? $data->lulusan : set_value('lulusan');
		
		
		$act        = $id_sekolah . '/edt_act/' . $idp;

	} else {

		$tahun       = $mode === 'add' ? '' : set_value('tahun');		
		$rombel      = $mode === 'add' ? '' : set_value('rombel');
		$murid       = $mode === 'add' ? '' : set_value('murid');
		$guru        = $mode === 'add' ? '' : set_value('guru');
		$ruang_kelas = $mode === 'add' ? '' : set_value('ruang_kelas');
		$lulusan     = $mode === 'add' ? '' : set_value('lulusan');

		$act		= $id_sekolah . '/add_act';
	}
?>

<div class="row-fluid">
	<div class="span12">
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>manage/data_sekolah">Daftar Data Sekolah</a> <span class="divider">/</span></li>
			<li><a href="<?php echo base_URL()?>manage/sekolah_stats/<?php echo $id_sekolah ?>"><?php echo $nama_sekolah?></a> <span class="divider">/</span></li>
			<li><?php echo ($mode === 'edt' || $mode === 'edt_act') ? 'Edit' : 'Tambah';?> Data Siswa</li>
		</ul>
	</div>
</div>

<?php if(isset($msg)){ ?>
<div class='alert alert-error'><?php echo $msg;?></div>
<?php } ?>

<form action="<?php echo base_URL()?>manage/sekolah_stats/<?php echo $act?>" method="post">	
	<fieldset>
	<legend><?php echo $title;?></legend>
	<br>

	<label style="width: 200px; float: left">Tahun</label><input class="input-large" type="text" name="tahun" placeholder="" value="<?php echo $tahun?>" required><br>	
	<label style="width: 200px; float: left">Jumlah Rombel</label><input class="input-large" type="text" name="rombel" placeholder="" value="<?php echo $rombel?>"><br>	
	<label style="width: 200px; float: left">Jumlah Murid</label><input class="input-large" type="text" name="murid" value="<?php echo $murid?>"><br>
	<label style="width: 200px; float: left">Jumlah Guru</label><input class="input-large" type="text" name="guru" value="<?php echo $guru?>"><br>		
	<label style="width: 200px; float: left">Jumlah Ruang Kelas</label><input class="input-large" type="text" name="ruang_kelas" value="<?php echo $ruang_kelas?>"><br>
	<label style="width: 200px; float: left">Jumlah Lulusan</label><input class="input-large" type="text" name="lulusan" value="<?php echo $lulusan?>"><br>
	
	<label style="width: 200px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>
