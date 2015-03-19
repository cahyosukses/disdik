 <?php 
	$mode               = $this->uri->segment(3);
	
	$topik              = $mode === 'add' ? '' : set_value('topik');
	$nama_pengadu       = $mode === 'add' ? '' : set_value('nama_pengadu');
	$email_pengadu      = $mode === 'add' ? '' : set_value('email_pengadu');
	$judul_program      = $mode === 'add' ? '' : set_value('judul_program');
	$tgl_tayang_program = $mode === 'add' ? '' : set_value('tgl_tayang_program');	
	$jam_tayang_program = $mode === 'add' ? '' : set_value('jam_tayang_program');
	$stasiun_program    = $mode === 'add' ? '' : set_value('stasiun_program');
	$pesan              = $mode === 'add' ? '' : set_value('pesan');
	
 ?>
 

	<ul class="breadcrumb wellwhite">
		<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
		<li><a href="<?php echo base_URL()?>tampil/aduan">Pojok Aduan</a></li>
	</ul>
	<h3>Pojok Aduan</h3>
	<div class="alert alert-success fade in">
		<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
		Pada laman ini pengunjung dapat memberikan Pengaduan seputar tayangan program televisi ..
	</div>
	<p align="left"><a href="<?php echo base_URL() . 'tampil/aduan'?>" button="" type="button" class="btn btn-success"><i class="icon-chevron-left icon-white"></i>Index Pojok Aduan</a></p>
	
	<?php if(isset($msg)){ ?>
	<div class='alert alert-error'><?php echo $msg;?></div>
	<?php }?>
	<form method="post" action="<?php echo base_URL()?>tampil/aduan/add_act">
		<table border="0" width="100%">
			<tr><td width="25%">Topik</td><td><input type="text" value="<?php echo $topik?>" name="topik" class="span12" required></td></tr>
			<tr><td width="25%">Nama Pengadu</td><td><input type="text" value="<?php echo $nama_pengadu?>" name="nama_pengadu" class="span12" required></td></tr>
			<tr><td>Email</td><td><input type="email" value="<?php echo $email_pengadu?>" name="email_pengadu"  class="span12"></td></tr>
			<tr><td>Judul Program</td><td><input type="text" value="<?php echo $judul_program?>" name="judul_program" class="span12" required></td></tr>
			<tr><td>Tanggal Tayang</td><td><input type="text" value="<?php echo $tgl_tayang_program?>" name="tgl_tayang_program" class="span12"></td></tr>
			<tr><td>Jam Tayang</td><td><input type="text" value="<?php echo $jam_tayang_program?>" name="jam_tayang_program" class="span12"></td></tr>
			<tr><td>Stasiun Program</td><td><input type="text" value="<?php echo $stasiun_program?>" name="stasiun_program" class="span12" required></td></tr>

			
			<tr><td>Pesan Pengaduan</td><td><textarea name="pesan" rows="5" style="width:98%" required><?php echo $pesan?></textarea></td></tr>
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

			<tr>
				<td></td>
				<td>
					<input type="submit" value="Kirim" id="tombol" class="btn btn-primary">
					<input type="reset" class="btn btn-warning" value="Reset"></td>
				</td>					
				<td>
					
				</td>
			</tr>
		</table>
	</form>
