<style type="text/css">
	.table tbody tr.warning td{
		background-color: #FFFF99;
	}
</style>
	<h3>Pojok Aduan</h3>
	<form action="<?php echo base_URL() . 'manage/aduan/cari'?>" method="post">		
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
	      <th style="text-align: left" width="10%"></th>
	      <th style="text-align: left" width="30%">Topik</th>
	      <th style="text-align: left" width="10%">Nama</th>
	      <th style="text-align: left" width="5%">Email</th>		      
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
	      <td><?php echo substr($b->topik,0,45) . '...'?></td>
	      <td><?php echo ucfirst($b->nama_pengadu)?></td>
	      <td><?php echo $b->email_pengadu?></td>		     
	      
	      <td style="text-align: center" id="row_<?php echo $b->id;?>">
	      	<?php if($b->tampil === 'Y'){ ?>
	      	<a href="#" class="change_tampil" id="<?php echo $b->id;?>" tampil="N"><span class="icon-eye-close">&nbsp;&nbsp;</span></a>
	      	<?php }else{ ?>
	      	<a href="#" class="change_tampil" id="<?php echo $b->id;?>" tampil="Y"><span class="icon-eye-open">&nbsp;&nbsp;</span></a>
	      	<?php } ?>  
	        <a href="#info-aduan" data-toggle="modal" onclick="get_aduan(<?php echo $b->id;?>)"><span class="icon-zoom-in">&nbsp;&nbsp;</span></a>  
		    <a href="<?php echo base_URL(); ?>manage/aduan/del/<?php echo $b->id ?>" onclick="return confirm('Anda YAKIN menghapus data ini ?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
	      </td>
	   </tr>
	   <?php endforeach; ?>	
	   <?php } ?>	  
	</table>

	<div class="modal hide fade" id="info-aduan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="static"  aria-hidden="true" style="display: none">
	  <div class="modal-header" style="padding: 0px 10px 0px 5px;">
	     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	     <h4 id="myModalLabel">Detail Pengaduan</h4>
	  </div>
	  <div class="modal-body">
	    <table class="table table-hover table-condensed" style="font-size: 80%">           
	        <tbody id="tabel-aduan">
	          <tr>
	            <td style="width:100px">Topik Aduan</td> 
	            <td>{TOPIK}</td>   
	          </tr>            
	          <tr>
	            <td>Nama Pengirim</td> 
	            <td>{NAMA_PENGADU}</td>   
	          </tr>            
	          <tr>
	             <td>Judul Program</td>     
	             <td>{JUDUL_PROGRAM}</td>   
	          </tr>
	          <tr>
	             <td>Stasiun Program</td>   
	             <td>{STASIUN_PROGRAM}</td>   
	          </tr>
	          <tr>
	             <td>Pesan Aduan</td>
	             <td>{INI ADALAH PESAN YANG saaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaangaaaat panjang sekali}</td>   
	          </tr>
	        </tbody>
	      </table>
	  </div>    
	</div>
	
	
	<center>
		<div class="pagination pagination-small">
		 <ul><?php echo $this->pagination->create_links();?> </ul>
		</div>
  	</center>

  	<script type="text/javascript">
	  	$('.change_tampil').click(function() {
	  		var id_ide = $(this).attr('id');
	  		var val_tampil = $(this).attr('tampil');
	  		
	  		$.post("<?php echo base_url() . 'manage/aduan/set_tampil';?>", 
	        			{ id: id_ide ,
	        			  tampil : val_tampil } 
	        	).done(function(data){
				 
			location.reload(); 
	        });
	        
	  	});

	  	function get_aduan(v_id){
            $.get( "<?php echo base_URL() . 'manage'?>/aduan/detail",
                    { id : v_id }
               ).done(function( data ) {
                $('#tabel-aduan').html(data);
            })
        }
  	</script>

