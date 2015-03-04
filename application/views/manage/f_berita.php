<?php
$mode	= $this->uri->segment(3);

if ($mode == "edit" || $mode == "act_edit") {
	$act		= "act_edit";
	$id_data	= $berita_pilih->id;
	$judul		= $mode === 'edit' ? $berita_pilih->judul : set_value('judul');
	$gambar		= $berita_pilih->gambar;
	$isi		= $mode === 'edit' ? $berita_pilih->isi : set_value('isi');
	$sticky		= $mode === 'edit' ? $berita_pilih->sticky : set_value('sticky');
	$kategori	= $berita_pilih->kategori;

} else {
	$act		= "act_add";
	$id_data	= "";
	$judul		= $mode === 'add' ? '' : set_value('judul');
	$gambar		= "";
	$isi		= $mode === 'add' ? '' : set_value('isi');
	$sticky	    = $mode === 'add' ? '' : set_value('sticky');
	$kategori	= "";
}
?>

<form action="<?php echo base_URL()?>manage/blog/<?php echo $act?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
<input type="hidden" name="id_data" value="<?php echo $id_data?>">
<input type="hidden" name="gambar" value="<?php echo $gambar?>">

	<legend>Form Berita</legend>
	<?php echo $this->session->flashdata("k");?>

	<label style="width: 150px; float: left">Judul Postingan</label><input class="span11" type="text" name="judul" placeholder="Isikan judulnya" value="<?php echo $judul?>" required><br>
	<label style="width: 150px; float: left">Sticky Post</label>
	<select name="sticky">
		<option <?php echo $sticky === 'N' ? 'selected':'';?> value="N">Tidak</option>
		<option <?php echo $sticky === 'Y' ? 'selected':'';?> value="Y">Ya</option>
	</select><br>
	
	<label style="width: 135px; height: 10px; float: left; display: block">File Gambar</label><input style="float: left; display: block" class="search-query" type="file" name="file_gambar"><br><br>
	<label style="width: 135px; height: 10px; float: left; display: block">File Dokumen</label><input style="float: left; display: block" class="search-query" type="file" name="file_dokumen"><br><br>

	<label style="width: 150px; height: 10px; float: left; display: block">Isi Postingan</label><br><textarea id='tinyMCE'  rows="10" class="span11" name="isi" id="textarea" style="font-family: courier"><?php echo $isi?></textarea><br>
	<label style="width: 150px; float: left; ">Kategori</label>
	<div style="width: 550px; float: left; display: block">
		<?php $q_kategori	= $this->db->query("SELECT * FROM kat ORDER BY id");?>
		<select name="kategori[]" data-placeholder="Kategori" multiple class="chosen-select select_produk" tabindex="2">
	       <option value=""></option>	   
	       <?php $select_kat = explode('-',$kategori);?>
	       <?php foreach($q_kategori->result() as $kat){ ?>
	       <option <?php echo in_array($kat->id,$select_kat) ? 'selected':'';?> value="<?php echo $kat->id;?>"><?php echo $kat->nama;?></option>
	       <?php } ?>

	     </select>	
	</div>
	<br><br><br><br>
	 
	      
	<button type="submit" class="btn btn-primary">Submit</button>
</form>