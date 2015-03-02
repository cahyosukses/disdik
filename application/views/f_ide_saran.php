 <?php 
 	$mode         = $this->uri->segment(3);

	$nama		= $mode === 'add' ? '' : set_value('nama');
	$email		= $mode === 'add' ? '' : set_value('email');
	$alamat		= $mode === 'add' ? '' : set_value('alamat');
	$website	= $mode === 'add' ? '' : set_value('website');	
	$topik		= $mode === 'add' ? '' : set_value('topik');
 ?>
 
 <div class="span9">
	<ul class="breadcrumb wellwhite">
		<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
		<li><a href="<?php echo base_URL()?>tampil/ide_saran">Ide & Saran</a></li>
	</ul>
	<h3>Ide & Saran Pengunjung</h3>
	<div class="alert alert-success fade in">
		<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
		Pada laman ini pengunjung dapat memberikan Ide atau Gagasannya seputar dunia Pendidikan khususnya di Daerah Provinsi Jambi. Anda juga dapat menanggapi ide yang ditulis pengunjung lainnya..
	</div>
	<p align="left"><a href="<?php echo base_URL() . 'tampil/ide_saran'?>" button="" type="button" class="btn btn-success"><i class="icon-chevron-left icon-white"></i>Index Ide & Gagasan</a></p>
	
	<?php if(isset($msg)){ ?>
	<div class='alert alert-error'><?php echo $msg;?></div>
	<?php }?>
	<form method="post" id="f_bukutamu" action="<?php echo base_URL()?>tampil/ide_saran/add_act">
		<table border="0" width="100%">
			<tr><td width="15%">Nama</td><td><input type="text" value="<?php echo $nama?>" name="nama" class="span12" required></td></tr>
			<tr><td>Email</td><td><input type="email" value="<?php echo $email?>" name="email"  class="span12"></td></tr>
			<tr><td>Alamat</td><td><input type="text" value="<?php echo $alamat?>" name="alamat" class="span12"></td></tr>
			<tr><td>Website</td><td><input type="text" value="<?php echo $website?>" name="website" class="span12"></td></tr>
			<tr><td>Ide/Gagasan</td><td><textarea name="topik" rows="5" style="width:98%" required><?php echo $topik?></textarea></td></tr>
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