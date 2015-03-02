<?php 
	$id_produk_hukum = $this->uri->segment(3);
	$mode            = $this->uri->segment(4);
	$judul_produk    = $this->basecrud_m->get_where('data_produk_hukum',array('id' => $id_produk_hukum ))->row()->judul;


	if ($mode === "edt" || $mode === "edt_act") {	
		
		$idp		= $data->id;	
		$nomor		= $mode === 'edt' ? $data->nomor : set_value('nomor');		
		$tahun		= $mode === 'edt' ? $data->tahun : set_value('tahun');
		$tentang	= $mode === 'edt' ? $data->tentang : set_value('tentang');
		$terbit		= $mode === 'edt' ? $data->terbit : set_value('terbit');
		
		$act        = $id_produk_hukum . '/edt_act/' . $idp;

	} else {

		$nomor		= $mode === 'add' ? '' : set_value('nomor');		
		$tahun		= $mode === 'add' ? '' : set_value('tahun');
		$tentang	= $mode === 'add' ? '' : set_value('tentang');
		$terbit		= $mode === 'add' ? '' : set_value('terbit');
		
		$act		= $id_produk_hukum . '/add_act';
	}
?>

<div class="row-fluid">
	<div class="span12">
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>manage/data_produk_hukum">Kategori Produk Hukum</a> <span class="divider">/</span></li>
			<li><a href="<?php echo base_URL()?>manage/prod_hukum_list/<?php echo $id_produk_hukum?>"><?php echo $judul_produk?></a><span class="divider">/</span></li>
			<li><?php echo $mode === 'add' ? 'Tambah' : 'Edit'?></li>
		</ul>
	</div>
</div>

<?php if(isset($msg)){ ?>
<div class='alert alert-error'><?php echo $msg;?></div>
<?php } ?>

<form action="<?php echo base_URL()?>manage/prod_hukum_list/<?php echo $act?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
	<fieldset>
	<legend><?php echo $title;?></legend>
	<br>
	<label style="width: 200px; float: left">Nomor</label><input class="input-large" type="text" name="nomor" placeholder="" value="<?php echo $nomor?>" required><br>	
	<label style="width: 200px; float: left">Tahun</label><input class="input-large" type="text" name="tahun" placeholder="" value="<?php echo $tahun?>" required><br>	
	<label style="width: 200px; float: left">Tentang</label><input class="input-xxlarge" type="text" name="tentang" value="<?php echo $tentang?>" placeholder="" required><br>
	<label style="width: 200px; float: left">Terbit</label><input class="input-large" type="text" name="terbit" value="<?php echo $terbit?>" placeholder="Format 'YYYY-MM-DD'"><br>
	
	<label style="width: 200px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>