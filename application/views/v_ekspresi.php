
	<ul class="breadcrumb wellwhite">
		<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
		<li><a href="<?php echo base_URL()?>tampil/ekspresi">Ekspresi</a></li>
	</ul>
	<h3>Ekspresi Pengunjung</h3>
	<div class="alert alert-success fade in">
		<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
		Disini pengunjung dapat mengekspresikan dan menanggapi ekspresi melalui tulisan dalam bentuk harapan-harapan atau keinginan seputar dunia Pendidikan di Provinsi Jambi.
	</div>
	<p align="left"><a href="<?php echo base_URL() . 'tampil/ekspresi/add'?>" button="" type="button" class="btn btn-success"><i class="icon-plus icon-white"></i>Tambah Ekspresi baru</a></p>
	<?php echo $this->session->flashdata("k");?>
	
	<?php if($data->num_rows() == 0){ ?>
	<div class='alert alert-error'>Belum Ada Data</div>
	<?php }else{ ?>

	<?php foreach ($data->result() as $d) { ?>
		
	
	<div class="row-fluid">
		<div class="span3"><br>
		<i class="icon-user"></i> <b><?php echo ucwords($d->nama);?></b> 
	      <br>
	      <?php echo $d->inserted_at?>
	  
	    </div>
		<div class="span9">
			<div class="alert alert-info">
				<strong><h4><?php echo $d->judul;?></h4></strong><br>
				<a href="<?php echo base_URL() . 'tampil/ekspresi/reply/' . $d->id?>">
					<p><?php echo substr($d->isi_ekspresi, 0,80) . '...'?></p>
				</a>			       
		 		<span class="label label-default">
		 			<span class="icon-comment icon-white"></span>
			 		<?php $reply = $this->db->query("SELECT nama,DATE(inserted_at) as tgl FROM ekspresi_tanggapan WHERE id_ekspresi = $d->id AND tampil = 'Y' ORDER BY inserted_at DESC")?>  
			 		<?php if($reply->num_rows() == 0){ ?>			 		
			 		<a href="<?php echo base_URL() . 'tampil/ekspresi/reply/' . $d->id?>" style="color:#FFF">Tanggapan  (0), Silahkan berikan tanggapan untuk ekspresi ini</a>
			 		<?php }else{ ?>			 		
			 		<a href="<?php echo base_URL() . 'tampil/ekspresi/reply/' . $d->id?>" style="color:#FFF">Tanggapan  (<?php echo $reply->num_rows()?>) , terakhir oleh : <?php echo ucfirst(strlen($reply->row()->nama) > 5 ? substr($reply->row()->nama,0,5) . '...' : $reply->row()->nama);?> | Tanggal :<?php echo $reply->row()->tgl?> </a>
			 		<?php } ?>
		 		 </span>
		 	</div>
		</div>
	</div>
	<hr style="margin:5px">
	
	<?php } ?>

	<?php } ?>
	
	<center>
		<div class="pagination pagination-small">
		 <ul><?php echo $this->pagination->create_links();?> </ul>
		</div>
  	</center>

