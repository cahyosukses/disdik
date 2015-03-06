<div class="span9">	
	<span class="btn btn-success btn-small disabled">DETAIL PENGUMUMAN</span>
	<span class="label label-default"> 
		<span class="glyphicon glyphicon-time"></span> Update: <?php echo tgl_panjang($data->tglPost,'sm',true);?>, Diposting : <?php echo $data->oleh;?>, dilihat : <?php echo $data->hits;?> kali
	</span>
	
	 <h3><?php echo $data->judul;?></h3>
	 <hr>
	 <?php echo $data->isi;?><br>
	 <?php if(!IsNullOrEmptyString($data->file_name)){ ?>
	 Dokumen : <a href="<?php echo base_URL() . 'upload/post/' . $data->file_name;?>">[Download]</a> 
	 <?php } ?>

	  <br>
	 

</div>