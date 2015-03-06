<div class="span9">	
	<span class="btn btn-success btn-small disabled">INDEX PENGUMUMAN</span>
	<h3>Index Pengumuman</h3>
 	<hr>

	<?php foreach ($data->result() as $pm){ ?>
	<span class="label label-default">
		<span class="icon-time"></span> 
		Update : <?php echo tgl_panjang($pm->tglPost,'sm',true);?>, oleh : <?php echo $pm->oleh;?> </span>
		<h5>
			<a href="<?php echo base_URL() . 'tampil/pengumuman/detail/' . $pm->id;?>" title="<?php echo $pm->judul;?>"><?php echo $pm->judul;?></a>
		</h5>
	<br>  
	<?php } ?>
	

	<center>
	    <div class="pagination pagination-small">
	        <ul><?php echo $this->pagination->create_links();?> </ul>
	    </div>
  	</center>
</div>