<style type="text/css">
	.table tbody tr.warning td{
		background-color: #FFFF99;
	}
</style>
	<h3>Ekspresi Pengunjung</h3>
	<form action="<?php echo base_URL() . 'manage/ekspresi/cari'?>" method="post">		
		<?php $filter = $this->session->userdata('filter');?>
		<select name="filter">
			<option value="">Tampil Semua</option>	
			<option <?php echo $filter === 'Y' ? 'selected':'';?> value="Y">Sudah Tampil</option>	
			<option <?php echo $filter === 'N' ? 'selected':'';?> value="N">Belum Tampil</option>
		</select> &nbsp; 
		<input type="submit" class="btn" value="Filter" style="margin-top: -10px">
	</form>
	<?php echo $this->session->flashdata("k");?>	
		<table width="100%"  class="table table-condensed">
		   <tr>
		      <th style="text-align: left" width="15%"></th>
		      <th style="text-align: left" width="10%">Nama</th>
		      <th style="text-align: left" width="5%">Email</th>		      
		      <th style="text-align: center" width="30%">Tanggapan</th>
		      <th style="text-align: left" width="30%">Judul</th>
		      <th width="10%">Control</th>
		   </tr>
		   <?php $i = 0 ?>
		   <?php if($data->num_rows() == 0){ ?>
		   <tr>
		      <td colspan='6' align='center'> Data not found </td>
		   </tr>
		   <?php }else{ ?>
		   <?php foreach ($data->result() as $b):
		      $i++;
		      ?>
		   <tr <?php echo $b->tampil === 'N' ? 'class="warning"':'class="success"'?>>		      
		      <td><?php echo $b->inserted_at?></td>
		      <td><?php echo ucfirst($b->nama)?></td>
		      <td><?php echo $b->email?></td>
		      <td style="text-align: center">
		      	<?php echo $b->jml . ' Kali';?>
		      </td>
		      <td><?php echo substr($b->judul,0,45) . '...'?></td>
		      <td style="text-align: center" id="row_<?php echo $b->id;?>">
		      	<?php if($b->tampil === 'Y'){ ?>
		      	<a href="" class="change_tampil" id="<?php echo $b->id;?>" tampil="N"><span class="icon-eye-close">&nbsp;&nbsp;</span></a>
		      	<?php }else{ ?>
		      	<a href="" class="change_tampil" id="<?php echo $b->id;?>" tampil="Y"><span class="icon-eye-open">&nbsp;&nbsp;</span></a>
		      	<?php } ?>  
		        <a href="<?php echo base_URL(); ?>manage/ekspresi/reply/<?php echo $b->id?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
			    <a href="<?php echo base_URL(); ?>manage/ekspresi/del/<?php echo $b->id ?>" onclick="return confirm('Anda YAKIN menghapus data ini ?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
		      </td>
		   </tr>
		   <?php endforeach; ?>	
		   <?php } ?>	  
		</table>
	
	
	<center>
		<div class="pagination pagination-small">
		 <ul><?php echo $this->pagination->create_links();?> </ul>
		</div>
  	</center>

  	<script type="text/javascript">
  	$('.change_tampil').click(function() {
  		var id_ekspresi = $(this).attr('id');
  		var val_tampil = $(this).attr('tampil');
  		
  		$.post("<?php echo base_url() . 'manage/ekspresi/set_tampil';?>", 
        			{ id: id_ekspresi ,
        			  tampil : val_tampil } 
        	).done(function(data){
			location.reload(); 

        });
        
  	});
  	</script>

