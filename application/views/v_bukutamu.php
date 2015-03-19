<?php
/*
if ($this->uri->segment(3) == "edit" || $this->uri->segment(3) == "act_edit") {
	$id		= $det_pesan->id;
	$nama	= $det_pesan->nama;
	$email	= $det_pesan->email;
	$pesan	= $det_pesan->pesan;
	$act	= "act_edit";
} else {
	$id		= "";
	$nama	= "";
	$email	= "";
	$pesan	= "";
	$act	= "act_tambah";
}*/
?>

		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
			<li><a href="<?php echo base_URL()?>tampil/bukutamu">Kontak Kami</a> </li>
			
		</ul>

		<div class="span12 wellwhite" style="margin-left: 0px">
		  <div class="span12">
			<legend>Contact Us</legend>
			<ul>
				<li>Alamat : <b><br>
			    Jl. Jend. A. Yani No.06 Telanaipura Jambi. Telp. (0741) 63197 Fax. (0741) 63197</b></li>
				<li>Email : <b><a href="mailto:akhwan90@gmail.com">helykurniawan@gmail.com</a></b></li>
			</ul>
		  </div>

		  <div class="span1">
		  </div>

		  <div class="span12">
		  <legend style="margin-bottom: 10px">Tinggalkan pesan Anda disini</legend>
			<?php echo $this->session->flashdata("k");?>
            
			
			<form method="post" id="f_bukutamu" action="<?php echo base_URL()?>tampil/bukutamu/simpan">
			<table border="0" width="100%">
				<tr><td width="15%">Nama</td><td><input type="text" name="nama" class="span8" required></td></tr>
				<tr><td>Email</td><td><input type="email" name="email"  class="span8" required></td></tr>
				<tr><td>Pesan</td><td><input type="text" name="pesan" class="span12" required></td></tr>
				<tr><td></td><td><input type="submit" value="Kirim" id="tombol" class="btn btn-primary"></td></tr>
			</table>
			</form>
			
			</div>
		</div>
<!--/span-->
		