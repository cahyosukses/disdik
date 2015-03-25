<?php
$mode	= $this->uri->segment(3);

if ($mode == "edt" || $mode == "edt_act") {
	
	$idp                = $data->id ;
	$npsn               = $mode === 'edt' ? $data->npsn : set_value('npsn');
	$nss                = $mode === 'edt' ? $data->nss : set_value('nss');
	$nama               = $mode === 'edt' ? $data->nama : set_value('nama');
	$id_kabupaten       = $mode === 'edt' ? $data->id_kabupaten : set_value('id_kabupaten');
	$kelurahan          = $mode === 'edt' ? $data->kelurahan : set_value('kelurahan');
	$kecamatan          = $mode === 'edt' ? $data->kecamatan : set_value('kecamatan');
	$alamat             = $mode === 'edt' ? $data->alamat : set_value('alamat');
	$kodepos            = $mode === 'edt' ? $data->kodepos : set_value('kodepos');
	$no_telp            = $mode === 'edt' ? $data->no_telp : set_value('no_telp');
	$no_faks            = $mode === 'edt' ? $data->no_faks : set_value('no_faks');
	$email              = $mode === 'edt' ? $data->email : set_value('email');
	$waktu_persekolahan = $mode === 'edt' ? $data->waktu_persekolahan : set_value('waktu_persekolahan');
	$akreditasi         = $mode === 'edt' ? $data->akreditasi : set_value('akreditasi');
	$jenjang            = $mode === 'edt' ? $data->jenjang : set_value('jenjang');
	$jumlah_ruang       = $mode === 'edt' ? $data->jumlah_ruang : set_value('jumlah_ruang');
	$jumlah_lahan       = $mode === 'edt' ? $data->jumlah_lahan : set_value('jumlah_lahan');
	$jumlah_gedung      = $mode === 'edt' ? $data->jumlah_gedung : set_value('jumlah_gedung');
	$jumlah_kelas       = $mode === 'edt' ? $data->jumlah_kelas : set_value('jumlah_kelas');
	$status             = $mode === 'edt' ? $data->status : set_value('status');
	$website            = $mode === 'edt' ? $data->website : set_value('website');

	$rombel      = $mode === 'edt' ? $data->rombel : set_value('rombel');
	$murid       = $mode === 'edt' ? $data->murid : set_value('murid');
	$guru        = $mode === 'edt' ? $data->guru : set_value('guru');
	//$ruang_kelas = $mode === 'edt' ? $data->ruang_kelas : set_value('ruang_kelas');
	$lulusan     = $mode === 'edt' ? $data->lulusan : set_value('lulusan');

	$act                = 'edt_act/' . $idp;

} else {	

	$nama               = $mode === 'add' ? '' : set_value('nama');
	$npsn               = $mode === 'add' ? '' : set_value('npsn');
	$nss                = $mode === 'add' ? '' : set_value('nss');
	$nama               = $mode === 'add' ? '' : set_value('nama');
	$id_kabupaten       = $mode === 'add' ? '' : set_value('id_kabupaten');	
	$kecamatan          = $mode === 'add' ? '' : set_value('kecamatan');
	$kelurahan          = $mode === 'add' ? '' : set_value('kelurahan');	
	$alamat             = $mode === 'add' ? '' : set_value('alamat');
	$kodepos            = $mode === 'add' ? '' : set_value('kodepos');
	$no_telp            = $mode === 'add' ? '' : set_value('no_telp');
	$no_faks            = $mode === 'add' ? '' : set_value('no_faks');
	$email              = $mode === 'add' ? '' : set_value('email');
	$waktu_persekolahan = $mode === 'add' ? '' : set_value('waktu_persekolahan');
	$akreditasi         = $mode === 'add' ? '' : set_value('akreditasi');
	$jenjang            = $mode === 'add' ? '' : set_value('jenjang');
	$jumlah_ruang       = $mode === 'add' ? '' : set_value('jumlah_ruang');
	$jumlah_lahan       = $mode === 'add' ? '' : set_value('jumlah_lahan');
	$jumlah_gedung      = $mode === 'add' ? '' : set_value('jumlah_gedung');
	$jumlah_kelas       = $mode === 'add' ? '' : set_value('jumlah_kelas');
	$status             = $mode === 'add' ? '' : set_value('status');
	$website            = $mode === 'add' ? '' : set_value('website');

	$rombel      = $mode === 'add' ? '' : set_value('rombel');
	$murid       = $mode === 'add' ? '' : set_value('murid');
	$guru        = $mode === 'add' ? '' : set_value('guru');
	//$ruang_kelas = $mode === 'add' ? '' : set_value('ruang_kelas');
	$lulusan     = $mode === 'add' ? '' : set_value('lulusan');
	
	$act                = "add_act";
}
?>

<div class="row-fluid">
	<div class="span12">
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>manage/data_sekolah">Daftar Data Sekolah</a> <span class="divider">/</span></li>
			<li>Tambah Data Sekolah</li>
		</ul>
	</div>
</div>

<?php if(isset($msg)){ ?>
<div class='alert alert-error'><?php echo $msg;?></div>
<?php } ?>

<form action="<?php echo base_URL()?>manage/data_sekolah/<?php echo $act?>" method="post">
	<fieldset>
	<legend><?php echo $title;?></legend>
	<br>
	<label style="width: 200px; float: left">NPSN</label><input class="input-xxlarge" type="text" name="npsn" placeholder="" value="<?php echo $npsn?>" required><br>	
	<!--<label style="width: 200px; float: left">NSS</label><input class="input-xxlarge" type="text" name="nss" placeholder="" value="<?php echo $nss?>" required><br>-->
	<label style="width: 200px; float: left">Nama</label><input class="input-xxlarge" type="text" name="nama" placeholder="" value="<?php echo $nama?>" required><br>
	<label style="width: 200px; float: left">Kabupaten</label>
	<select name="id_kabupaten">
	<?php foreach ($kabupaten->result() as $kab) { ?>
		<option <?php echo $id_kabupaten === $kab->id ? 'selected': ''?> value="<?php echo $kab->id?>"><?php echo $kab->nama;?></option>
	<?php }?>
	</select><br>	
	
	<label style="width: 200px; float: left">Kecamatan</label><input class="input-xxlarge" type="text" name="kecamatan" placeholder="" value="<?php echo $kecamatan?>" ><br>
	<label style="width: 200px; float: left">Kelurahan</label><input class="input-xxlarge" type="text" name="kelurahan" placeholder="" value="<?php echo $kelurahan?>" ><br>

	<label style="width: 200px; float: left">Alamat</label><input class="input-xxlarge" type="text" name="alamat" placeholder="" value="<?php echo $alamat?>" ><br>
	<label style="width: 200px; float: left">KodePOS</label><input class="input-xxlarge" type="text" name="kodepos" placeholder="" value="<?php echo $kodepos?>" ><br>
	<label style="width: 200px; float: left">Nomor Telp</label><input class="input-xxlarge" type="text" name="no_telp" placeholder="" value="<?php echo $no_telp?>" ><br>
	<label style="width: 200px; float: left">Nomor Faks</label><input class="input-xxlarge" type="text" name="no_faks" placeholder="" value="<?php echo $no_faks?>" ><br>
	<label style="width: 200px; float: left">Email</label><input class="input-xxlarge" type="text" name="email" placeholder="" value="<?php echo $email?>" ><br>
	<label style="width: 200px; float: left">Waktu Persekolahan</label><input class="input-xxlarge" type="text" name="waktu_persekolahan" placeholder="" value="<?php echo $waktu_persekolahan?>" ><br>
	<label style="width: 200px; float: left">Akreditasi</label><input class="input-xxlarge" type="text" name="akreditasi" placeholder="" value="<?php echo $akreditasi?>" ><br>
	<label style="width: 200px; float: left">Jenjang</label>
	<select name="jenjang">
		<option <?php echo $jenjang === 'paud' ? 'selected': ''?> value="paud">PAUD</option>		
		<option <?php echo $jenjang === 'tk' ? 'selected': ''?> value="tk">TK</option>	
		<option <?php echo $jenjang === 'sd' ? 'selected': ''?> value="sd">SD</option>	
		<option <?php echo $jenjang === 'mi' ? 'selected': ''?> value="mi">MI</option>	
		<option <?php echo $jenjang === 'smp' ? 'selected': ''?> value="smp">SMP</option>	
		<option <?php echo $jenjang === 'mts' ? 'selected': ''?> value="mts">MTs</option>	
		<option <?php echo $jenjang === 'sma' ? 'selected': ''?> value="sma">SMA</option>	
		<option <?php echo $jenjang === 'smk' ? 'selected': ''?> value="smk">SMK</option>	
		<option <?php echo $jenjang === 'ma' ? 'selected': ''?> value="ma">MA</option>	
		<option <?php echo $jenjang === 'slb' ? 'selected': ''?> value="slb">SLB</option>	
	</select><br>
	<label style="width: 200px; float: left">Jumlah Ruang</label><input class="input-xxlarge" type="text" name="jumlah_ruang" placeholder="" value="<?php echo $jumlah_ruang?>" ><br>
	<label style="width: 200px; float: left">Jumlah Lahan</label><input class="input-xxlarge" type="text" name="jumlah_lahan" placeholder="" value="<?php echo $jumlah_lahan?>" ><br>
	<label style="width: 200px; float: left">Jumlah Gedung</label><input class="input-xxlarge" type="text" name="jumlah_gedung" placeholder="" value="<?php echo $jumlah_gedung?>" ><br>
	<label style="width: 200px; float: left">Jumlah Kelas</label><input class="input-xxlarge" type="text" name="jumlah_kelas" placeholder="" value="<?php echo $jumlah_kelas?>" ><br>
	<label style="width: 200px; float: left">Status</label>
	<select name="status">
		<option value="negeri">Negeri</option>
		<option value="swasta">Swasta</option>
	</select><br>
	<label style="width: 200px; float: left">Website</label><input class="input-xxlarge" type="text" name="website" placeholder="" value="<?php echo $website?>" ><br>

	<label style="width: 200px; float: left">Jumlah Rombel</label><input class="input-large" type="text" name="rombel" placeholder="" value="<?php echo $rombel?>"><br>	
	<label style="width: 200px; float: left">Jumlah Murid</label><input class="input-large" type="text" name="murid" value="<?php echo $murid?>"><br>
	<label style="width: 200px; float: left">Jumlah Guru</label><input class="input-large" type="text" name="guru" value="<?php echo $guru?>"><br>			
	<label style="width: 200px; float: left">Jumlah Lulusan</label><input class="input-large" type="text" name="lulusan" value="<?php echo $lulusan?>"><br>
	
	<label style="width: 200px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>