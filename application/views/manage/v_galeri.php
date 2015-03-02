<legend style="margin-bottom: 10px">Album Galeri Foto</legend>
	<?php echo $this->session->flashdata("k")?>
	<form action="<?php echo base_URL()?>manage/galeri/add_album" method="post">
		Tambah Album <input type="text" name="nama_album" required> &nbsp; <input type="submit" class="btn" value="Simpan" style="margin-top: -10px">
	</form>
	
	
<legend>Daftar Album</legend>	
	<div class="row-fluid">
	<ul class="thumbnails">
	  <?php
	  if  (empty($data)) {
		echo "<div class=\"alert alert-error\">Maaf, belum ada album</div>";
	  } else {
		foreach ($data as $d) {
	  ?>
	  <li class="span4" style="margin-left: 0px; margin-right: 9px">
		<div class="thumbnail" style="height: 240px">
			<?php 
			$sampul	= get_value("galeri", "id_album", $d->id);
			if (empty($sampul)) {
				$gambar = "galeri/____no_foto.jpg";
			} else {
				$gambar = "galeri/".$sampul->file;
			}
			?>
		  <img src="<?php echo base_URL()?>timthumb?src=/upload/<?php echo $gambar . '&w=334&h=190&zc=0'?>" style="width: 334px; height: 190px" alt="<?php echo $d->nama?>">
		  <div class="caption">
			<h6 style="text-align: center; margin-top: 0"><?php echo $d->nama?><br>
			<a href="<?php echo base_URL()?>manage/galeri/del_album/<?php echo $d->id?>" onclick="return confirm('Anda Yakin ..?'); ">Hapus Album</a> | 
			<a href="<?php echo base_URL()?>manage/galeri/atur/<?php echo $d->id?>">Manage</a></h6>
			
		  </div>
		</div>
	  </li>
	  
	  <?php
	  }
	  }
	  ?>
	  
	</ul>
  </div>
