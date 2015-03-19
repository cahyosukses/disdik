
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
			<li>Disini Halaman Siswa Yang Telah Login <b><?php echo $this->session->userdata('siswa_nis'); ?> (<?php echo $this->session->userdata('siswa_nama'); ?>)</b></li>
			
		</ul>
		
		<div class='alert alert-success'>Anda telah berhasil login. Disinilah halaman aksi setelah siswa login. Monggo terserah mau diapakan, terserah kreatifitas Anda... Anda Login dengan <b>NIS : <?php echo $this->session->userdata('siswa_nis'); ?> (<?php echo $this->session->userdata('siswa_nama'); ?>)</b><br><br>
		
		<a href="<?php echo base_URL(); ?>tampil/logout_siswa" class="btn btn-info">Klik DISINI untuk logout</a>
		</div>
		 
