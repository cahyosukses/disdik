	<h3>Tanggapan Pojok Opini</h3>
	
	<div class="row-fluid">
		<div class="span12">
		    <h3><?php echo $data->judul;?></h3>
		    <small> Ditulis oleh <b><span class="icon-user"></span> <?php echo ucfirst($data->oleh) . ' pada tanggal ' . tgl_panjang($data->tgl,'lm');?></b></small>
			<p><?php echo $data->isi;?></p>
		</div>
	</div>
	
	<?php foreach ($tanggapan->result() as $t) { ?>
	<div class="row-fluid">
		<div class="span1"></div>
		<div class="span11">
			
			<?php if($t->tampil === 'Y'){ ?>
			<div class="alert alert-success">
				<span class="icon-user"></span> 
				<b><?php echo $t->nama;?></b> 
				<small>	- ditulis: <?php echo $t->tgl;?> </small> 
				<a href="#" class="change_tampil" id="<?php echo $t->id;?>" tampil="N"><span class="icon-eye-close pull-right">&nbsp;&nbsp;</span></a><br>
				<p><?php echo $t->komentar;?></p>	
			</div>			
			<?php }else{ ?>
			<div class="alert alert-warning">
				<span class="icon-user"></span> 
				<b><?php echo $t->nama;?></b> 
				<small>	- ditulis: <?php echo $t->tgl;?> </small> 
				<a href="#" class="change_tampil" id="<?php echo $t->id;?>" tampil="Y"><span class="icon-eye-open pull-right">&nbsp;&nbsp;</span></a><br>
				<p><?php echo $t->komentar;?></p>	
			</div>
			<?php } ?>

		</div>		
	</div>
	<?php }?>
	
	<div class="row-fluid">
		<h4></i>Tambahkan tanggapan anda: </h4>
		<?php if(isset($msg)){ ?>
		<div class='alert alert-error'><?php echo $msg;?></div>
		<?php }?>
		<form method="post" id="f_bukutamu" action="">
			<table border="0" width="50%">								
				<tr><td>Komentar</td><td><textarea id="tinyMCE" name="komentar" rows="5" style="width:98%"></textarea></td></tr>
				<tr><td></td><td><input type="submit" value="Kirim" id="tombol" class="btn btn-primary"></td></tr>
			</table>
		</form>
	</div>

  	<script type="text/javascript">
	  	$('.change_tampil').click(function() {
	  		var id_tanggapan = $(this).attr('id');
	  		var val_tampil = $(this).attr('tampil');
	  		
	  		$.post("<?php echo base_url() . 'manage/opini/reply_set_tampil';?>", 
	        			{ id: id_tanggapan ,
	        			  tampil : val_tampil } 
	        	).done(function(data){
				location.reload(); 

	        });
	        
	  	});
  	</script>
