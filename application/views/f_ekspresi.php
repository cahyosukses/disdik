 <?php 
 	$mode         = $this->uri->segment(3);

	$nama         = $mode === 'add' ? '' : set_value('nama');
	$email        = $mode === 'add' ? '' : set_value('email');
	$alamat       = $mode === 'add' ? '' : set_value('alamat');
	$website      = $mode === 'add' ? '' : set_value('website');	
	$judul        = $mode === 'add' ? '' : set_value('judul');
	$isi_ekspresi = $mode === 'add' ? '' : set_value('isi_ekspresi');
 ?>
 
 <div class="span9">
	<ul class="breadcrumb wellwhite">
		<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
		<li><a href="<?php echo base_URL()?>tampil/ekspresi">Ekspresi</a></li>
	</ul>
	<h3>Ekspresi Pengunjung</h3>
	<div class="alert alert-success fade in">
		<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
		Disini pengunjung dapat mengekspresikan dan menanggapi ekspresi melalui tulisan dalam bentuk harapan-harapan atau keinginan seputar dunia Pendidikan di Provinsi Jambi.
	</div>
	<p align="left"><a href="<?php echo base_URL() . 'tampil/ekspresi'?>" button="" type="button" class="btn btn-success"><i class="icon-chevron-left icon-white"></i>Index Ekspresi</a></p>
	
	<?php if(isset($msg)){ ?>
	<div class='alert alert-error'><?php echo $msg;?></div>
	<?php }?>
	<form method="post" id="f_bukutamu" action="<?php echo base_URL()?>tampil/ekspresi/add_act">
		<table border="0" width="100%">
			<tr><td width="15%">Nama</td><td><input type="text" value="<?php echo $nama?>" name="nama" class="span12" required></td></tr>
			<tr><td>Email</td><td><input type="email" value="<?php echo $email?>" name="email"  class="span12"></td></tr>
			<tr><td>Alamat</td><td><input type="text" value="<?php echo $alamat?>" name="alamat" class="span12"></td></tr>
			<tr><td>Website</td><td><input type="text" value="<?php echo $website?>" name="website" class="span12"></td></tr>
			<tr><td>Judul</td><td><input type="text" value="<?php echo $judul?>" name="judul" class="span12" required></td></tr>
			<tr><td>Ekspresi</td><td><textarea name="isi_ekspresi" rows="5" style="width:98%" required><?php echo $isi_ekspresi?></textarea></td></tr>
			<tr>
				<td>Security Code</td>
				<td><?php echo $captcha_image;?></td>				
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="text" name="captcha_word" class="span12" required>
				</td>
			</tr>
			<tr><td></td><td><input type="submit" value="Kirim" id="tombol" class="btn btn-primary"></td></tr>
		</table>
	</form>
</div>