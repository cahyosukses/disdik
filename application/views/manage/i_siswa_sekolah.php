<?php	
	$id_sekolah   = $this->uri->segment(3);	
	$nama_sekolah = $this->basecrud_m->get_where('data_sekolah',array('id' => $id_sekolah ))->row()->nama;
?>

<div class="row-fluid">
	<div class="span12">
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL() . 'manage/data_sekolah'?>">Daftar Data Sekolah</a> <span class="divider">/</span></li>
			<li><a href="<?php echo base_URL() . 'manage/data_siswa/' . $id_sekolah;?>">Siswa <?php echo $nama_sekolah;?></a><span class="divider">/</li>
			<li>Import Data Siswa</li>
		</ul>
	</div>
</div>

<legend>Import Data Guru <?php echo $nama_sekolah?></legend>
<div class="alert alert-success">Pada form ini anda bisa melakukan import data siswa sekolah sesuai dengan format file excel dibawah ini<br>
	<a href="<?php echo base_URL() . 'upload/data_siswa.xls'?>">Download Format Excel Data Siswa Sekolah</a>
</div>

<?php if(isset($msg)){ ?>
<div class='alert alert-error'><?php echo $msg;?></div>
<?php } ?>

<form action="<?php echo base_URL()?>manage/data_siswa/<?php echo $id_sekolah;?>/import_act" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
	<input type="hidden" name="upload_me" value="">
	<?php echo $this->session->flashdata("k");?>
	<label style="width: 135px; height: 10px; float: left; display: block">File Dokumen</label><input style="float: left; display: block" class="search-query" type="file" name="userfile"><br><br>
	
	<button type="submit" class="btn btn-primary" style="margin-left:150px">Import</button>
</form>