<?php

	$id_sekolah   = $this->uri->segment(3);
	$mode         = $this->uri->segment(4);
	$nama_sekolah = $this->basecrud_m->get_where('data_sekolah',array('id' => $id_sekolah ))->row()->nama;
	

	if ($mode == "edt" || $mode == "edt_act") {	
		
		$idp		= $data->id;	
		$nip		= $mode === 'edt' ? $data->nip : set_value('nip');
		$nuptk		= $mode === 'edt' ? $data->nuptk : set_value('nuptk');
		$nama		= $mode === 'edt' ? $data->nama : set_value('nama');
		$status		= $mode === 'edt' ? $data->status : set_value('status');
		$mapel		= $mode === 'edt' ? $data->mapel : set_value('mapel');
		$jk			= $mode === 'edt' ? $data->jk : set_value('jk');
		$alamat		= $mode === 'edt' ? $data->alamat : set_value('alamat');
		$foto		= $mode === 'edt' ? $data->foto : set_value('foto');
		
		$act        = $id_sekolah . '/edt_act/' . $idp;

	} else {

		$nip		= $mode === 'add' ? '' : set_value('nip');
		$nuptk		= $mode === 'add' ? '' : set_value('nuptk');
		$nama		= $mode === 'add' ? '' : set_value('nama');
		$status		= $mode === 'add' ? '' : set_value('status');
		$mapel		= $mode === 'add' ? '' : set_value('mapel');
		$jk			= $mode === 'add' ? '' : set_value('jk');
		$alamat		= $mode === 'add' ? '' : set_value('alamat');
		$foto		= $mode === 'add' ? '' : set_value('foto');

		$act		= $id_sekolah . '/add_act';
	}
?>

<div class="row-fluid">
	<div class="span12">
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>manage/data_sekolah">Daftar Data Sekolah</a> <span class="divider">/</span></li>
			<li><a href="<?php echo base_URL()?>manage/data_guru/<?php echo $id_sekolah ?>">Guru <?php echo $nama_sekolah?></a> <span class="divider">/</span></li>
			<li><?php echo ($mode === 'edt' || $mode === 'edt_act') ? 'Edit' : 'Tambah';?> Data Guru</li>
		</ul>
	</div>
</div>

<?php if(isset($msg)){ ?>
<div class='alert alert-error'><?php echo $msg;?></div>
<?php } ?>


<form action="<?php echo base_URL()?>manage/data_guru/<?php echo $act?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
	<fieldset>
	<legend><?php echo $title;?></legend>
	<br>
	<label style="width: 200px; float: left">NIP</label><input class="input-large" type="text" name="nip" placeholder="" value="<?php echo $nip?>" required><br>
	<label style="width: 200px; float: left">NUPTK</label><input class="input-large" type="text" name="nuptk" placeholder="" value="<?php echo $nuptk?>" required><br>
	<label style="width: 200px; float: left">Nama</label><input class="input-large" type="text" name="nama" placeholder="" value="<?php echo $nama?>" required><br>
	<label style="width: 200px; float: left">Status</label>
	<select name="status">
		<!--<option <?php echo $status === 'gty/pty' ? 'selected' : '';?> value="gty/pty">GTY/PTY</option>-->
		<option <?php echo $status === 'cpns' ? 'selected' : '';?> value="cpns">CPNS</option>
		<option <?php echo $status === 'pns' ? 'selected' : '';?> value="pns">PNS</option>
	</select><br>
	<label style="width: 200px; float: left">Mapel</label><input class="input-large" type="text" name="mapel" value="<?php echo $mapel?>" placeholder=""><br>
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
