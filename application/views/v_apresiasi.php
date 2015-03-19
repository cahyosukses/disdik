
	<ul class="breadcrumb wellwhite">
		<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
		<li><a href="<?php echo base_URL()?>tampil/apresiasi">Ruang Apresiasi</a></li>
	</ul>
	<h3>Pojok Apresiasi</h3>
	<div class="alert alert-success fade in">
		<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
		Pada laman ini pengunjung dapat memberikan Apresiasi seputar tayangan program televisi
	</div>
	<p align="left"><a href="<?php echo base_URL() . 'tampil/apresiasi/add'?>" button="" type="button" class="btn btn-success"><i class="icon-plus icon-white"></i>Tambah Topik</a></p>
	
	<?php echo $this->session->flashdata("k");?>
	
	<?php if($data->num_rows() == 0){ ?>
	<div class='alert alert-error'>Belum Ada Data</div>
	<?php }else{ ?>

	<?php foreach ($data->result() as $d) { ?>		
	
	<div class="row-fluid">
		<div class="span3"><br>
		<i class="icon-user"></i> <b><?php echo ucwords($d->nama_pengirim);?></b> 
	      <br>
	      <?php echo $d->inserted_at?>	  
	    </div>
		<div class="span9">
			<div class="alert alert-info">
				<strong><?php echo substr($d->topik, 0,50)?></strong><br>
				<a href="#info-apresiasi" data-toggle="modal" onclick="get_aduan_apresiasi(0,'apresiasi',<?php echo $d->id;?>)">
					<p><?php echo substr($d->pesan, 0,80) . '...[Details]'?></p>
				</a>	
				<a href="">
					<p><a href="<?php echo base_URL() . 'tampil/aduan_apresiasi_pdf/apresiasi/' . $d->id?>">[ Download PDF ]</a></p>
				</a>			       
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



