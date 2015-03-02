 <?php 
 	$mode         = $this->uri->segment(3);
 	$id_ekspresi  = $this->uri->segment(4);

	$nama		= $mode === 'reply' ? '' : set_value('nama');
	$email		= $mode === 'reply' ? '' : set_value('email');
	$alamat		= $mode === 'reply' ? '' : set_value('alamat');
	$website	= $mode === 'reply' ? '' : set_value('website');	
	$komentar	= $mode === 'reply' ? '' : set_value('komentar');

	$act = base_URL() . 'tampil/ekspresi/reply_add/' . $id_ekspresi;
 ?>
 
 <div class="span9">
	<ul class="breadcrumb wellwhite">
		<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
		<li><a href="<?php echo base_URL()?>tampil/ekspresi">Ekspresi</a></li>
	</ul>
	<h3>Ide & Saran Pengunjung</h3>
	<div class="alert alert-success fade in">
		<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
		Pada laman ini pengunjung dapat memberikan Ide atau Gagasannya seputar dunia Pendidikan khususnya di Daerah Provinsi Jambi. Anda juga dapat menanggapi ide yang ditulis pengunjung lainnya..
	</div>
	<p align="left"><a href="<?php echo base_URL() . 'tampil/ide_saran'?>" button="" type="button" class="btn btn-success"><i class="icon-chevron-left icon-white"></i>Index Ide & Gagasan</a></p>
	<?php echo $this->session->flashdata("k");?>
	
	<div class="alert alert-info">
		<div class="row-fluid">
			<div class="span2"><b><span class="icon-user"></span> <?php echo $post->nama;?></b><br><small> Ditulis: <?php echo $post->tgl?> </small></div>
			<div class="span10"><p><?php echo $post->isi_ekspresi;?></p></div>
		</div>
	</div>
	
	<?php foreach ($tanggapan->result() as $t) { ?>
	<div class="row-fluid">
		<div class="span1"></div>
		<div class="span11">
			<div class="alert alert-warning">
				<span class="icon-user"></span> <b><?php echo $t->nama;?></b> <small>
				- ditulis: <?php echo $t->tgl;?> </small> <br>
				<p><?php echo $t->komentar;?></p>						
			</div>
		</div>		
	</div>
	<?php }?>
	
	<div class="row-fluid">
		<h4><i class="icon-plus"></i>Tambahkan tanggapan anda: </h4>
		<?php if(isset($msg)){ ?>
		<div class='alert alert-error'><?php echo $msg;?></div>
		<?php }?>
		<form method="post" id="f_bukutamu" action="<?php echo $act?>">
			<table border="0" width="100%">
				<tr><td width="15%">Nama</td><td><input type="text" value="<?php echo $nama?>" name="nama" class="span12" required></td></tr>
				<tr><td>Email</td><td><input type="email" value="<?php echo $email?>" name="email"  class="span12"></td></tr>
				<tr><td>Alamat</td><td><input type="text" value="<?php echo $alamat?>" name="alamat" class="span12"></td></tr>
				<tr><td>Website</td><td><input type="text" value="<?php echo $website?>" name="website" class="span12"></td></tr>
				<tr><td>Komentar</td><td><textarea name="komentar" rows="5" style="width:98%" required><?php echo $komentar?></textarea></td></tr>
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
</div>