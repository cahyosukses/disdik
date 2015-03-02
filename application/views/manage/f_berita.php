<?php
$mode	= $this->uri->segment(3);

if ($mode == "edit" || $mode == "act_edit") {
	$act		= "act_edit";
	$id_data	= $berita_pilih->id;
	$judul		= $berita_pilih->judul;
	$gambar		= $berita_pilih->gambar;
	$isi		= $berita_pilih->isi;
	$kategori	= $berita_pilih->kategori;

} else {
	$act		= "act_add";
	$id_data	= "";
	$judul		= "";
	$gambar		= "";
	$isi		= "";
	$kategori	= "";
}
?>
<form action="<?php echo base_URL()?>manage/blog/<?php echo $act?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
<input type="hidden" name="id_data" value="<?php echo $id_data?>">
<input type="hidden" name="gambar" value="<?php echo $gambar?>">

	<legend>Form Berita</legend>
	<?php echo $this->session->flashdata("k");?>

	<label style="width: 150px; float: left">Judul Postingan</label><input class="span11" type="text" name="judul" placeholder="Isikan judulnya" value="<?php echo $judul?>" required><br>
	<label style="width: 150px; height: 10px; float: left; display: block">File Gambar</label><br><input style="float: left; display: block" class="search-query" type="file" name="file_gambar" placeholder="Isikan judulnya"><br><br>
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
	<!--
	<?php
	$q_kategori	= $this->db->query("SELECT * FROM kat ORDER BY id");
	foreach ($q_kategori->result() as $kat) {
	?>
	<label class="checkbox inline"><input type="checkbox" id="kat_<?php echo $kat->id?>" value="<?php echo $kat->id?>-" name="kat_<?php echo $kat->id?>"> <?php echo $kat->nama?></label>
	<?php
	}
	?>	
	-->
	</div>
	<br><br><br><br>
	 
	      
	<button type="submit" class="btn btn-primary">Submit</button>
</form>