<div class="row-fluid">
	<div class="span12">
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>manage/data_sekolah">Daftar Data Sekolah</a> <span class="divider">/</span></li>
			<li>Import Data Sekolah</li>
		</ul>
	</div>
</div>

<legend>Form Import Data Sekolah</legend>
<div class="alert alert-success">Pada form ini anda bisa melakukan import data sekolah sesuai dengan format file excel dibawah ini<br>
	<a href="<?php echo base_URL() . 'upload/data_sekolah.xls'?>">Download Format Excel Data Sekolah</a>
</div>

<?php if(isset($msg)){ ?>
<div class='alert alert-error'><?php echo $msg;?></div>
<?php } ?>

<form action="<?php echo base_URL()?>manage/data_sekolah/import_act" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
	<input type="hidden" name="upload_me" value="">
	<?php echo $this->session->flashdata("k");?>
	<label style="width: 135px; height: 10px; float: left; display: block">File Dokumen</label><input style="float: left; display: block" class="search-query" type="file" name="userfile"><br><br>
	
	<button type="submit" class="btn btn-primary" style="margin-left:150px">Import</button>
</form>