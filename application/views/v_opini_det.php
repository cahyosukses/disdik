 <?php 
 	$mode         = $this->uri->segment(3);
 	$id_opini     = $this->uri->segment(4);

	$nama		= $mode === 'detail' ? '' : set_value('nama');
	$email		= $mode === 'detail' ? '' : set_value('email');
	$alamat		= $mode === 'detail' ? '' : set_value('alamat');
	$website	= $mode === 'detail' ? '' : set_value('website');	
	$komentar	= $mode === 'detail' ? '' : set_value('komentar');

	$act = base_URL() . 'tampil/opini/reply_add/' . $id_opini;
 ?>
 

	<ul class="breadcrumb wellwhite">
		<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
		<li><a href="<?php echo base_URL()?>tampil/opini">Pojok Opini</a></li>
	</ul>
	<h3>Pojok Opini</h3>
	
	<p align="left"><a href="<?php echo base_URL() . 'tampil/opini'?>" button="" type="button" class="btn btn-success"><i class="icon-chevron-left icon-white"></i>Index Pojok Opini</a></p>
	<?php echo $this->session->flashdata("k");?>
	
	
	<div class="row-fluid">
		<div class="span12">
		    <h3><?php echo $data->judul;?></h3>
		    <small> Ditulis oleh <b><span class="icon-user"></span> <?php echo ucfirst($data->oleh) . ' pada tanggal ' . tgl_panjang($data->tglPost,'lm');?></b></small>
			<p><?php echo $data->isi;?></p>
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
