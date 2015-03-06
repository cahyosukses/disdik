<?php
	$id_sekolah   = $this->uri->segment(3);
	$mode         = $this->uri->segment(4);
	$nama_sekolah = $this->basecrud_m->get_where('data_sekolah',array('id' => $id_sekolah ))->row()->nama;
	

	//var_dump($data);
	if ($mode === "edt" || $mode === "edt_act") {	
		
		$idp		= $data->id;	
		$nisn		= $mode === 'edt' ? $data->nisn : set_value('nisn');		
		$nama		= $mode === 'edt' ? $data->nama : set_value('nama');
		$jurusan	= $mode === 'edt' ? $data->jurusan : set_value('jurusan');
		$kelas		= $mode === 'edt' ? $data->kelas : set_value('kelas');
		$jk			= $mode === 'edt' ? $data->jk : set_value('jk');
		$alamat		= $mode === 'edt' ? $data->alamat : set_value('alamat');
		$foto		= $data->foto;
		
		$act        = $id_sekolah . '/edt_act/' . $idp;

	} else {

		$nisn		= $mode === 'add' ? '' : set_value('nisn');		
		$nama		= $mode === 'add' ? '' : set_value('nama');
		$jurusan	= $mode === 'add' ? '' : set_value('jurusan');
		$kelas		= $mode === 'add' ? '' : set_value('kelas');
		$jk			= $mode === 'add' ? '' : set_value('jk');
		$alamat		= $mode === 'add' ? '' : set_value('alamat');
		$foto		= 'no_image.jpg';

		$act		= $id_sekolah . '/add_act';
	}
?>

<div class="row-fluid">
	<div class="span12">
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>manage/data_sekolah">Daftar Data Sekolah</a> <span class="divider">/</span></li>
			<li><a href="<?php echo base_URL()?>manage/data_siswa/<?php echo $id_sekolah ?>">Siswa <?php echo $nama_sekolah?></a> <span class="divider">/</span></li>
			<li><?php echo ($mode === 'edt' || $mode === 'edt_act') ? 'Edit' : 'Tambah';?> Data Siswa</li>
		</ul>
	</div>
</div>

<?php if(isset($msg)){ ?>
<div class='alert alert-error'><?php echo $msg;?></div>
<?php } ?>

<form action="<?php echo base_URL()?>manage/data_siswa/<?php echo $act?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
	<fieldset>
	<legend><?php echo $title;?></legend>
	<br>
	<label style="width: 200px; float: left">NISN</label><input class="input-large" type="text" name="nisn" placeholder="" value="<?php echo $nisn?>" required><br>	
	<label style="width: 200px; float: left">Nama</label><input class="input-large" type="text" name="nama" placeholder="" value="<?php echo $nama?>" required><br>	
	<label style="width: 200px; float: left">Jurusan</label><input class="input-large" type="text" name="jurusan" value="<?php echo $jurusan?>" placeholder=""><br>
	<label style="width: 200px; float: left">Kelas</label><input class="input-large" type="text" name="kelas" value="<?php echo $kelas?>" placeholder=""><br>
	<label style="width: 200px; float: left">Jns Kelamin</label>
	<select name="jk">
		<option <?php echo $jk === 'l' ? 'selected' : '';?> value="l">Laki-laki</option>
		<option <?php echo $jk === 'p' ? 'selected' : '';?> value="p">Perempuan</option>
	</select>
	<br>
	<label style="width: 200px; float: left">Alamat</label><input class="input-xxlarge" type="text" name="alamat" value="<?php echo $alamat?>" placeholder=""><br>
	<label style="width: 185px; height: 10px; float: left; display: block">Foto</label><input style="float: left; display: block" class="search-query" type="file" name="foto" placeholder=""><br><br>
	
	<label style="width: 200px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>
