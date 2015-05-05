<?php 
	$mode    = $this->uri->segment(3);
	//$idu     = $this->uri->segment(4);
	//$id_foto = $this->uri->segment(5);

	if($mode === 'edit_foto'){
		$judul       = $data->judul;
		$ket   		 = $data->ket;
		$slideshow   = $data->slideshow;		
		$act         = 'edit_foto/' . $data->id_album . '/' .$data->id;
	}else{
		$judul       = "";
		$ket   		 = "";
		$slideshow   = "N";		
		$act         = "upload_foto";
	}
	//echo $mode;
?>
<legend style="margin-bottom: 10px">Album Galeri Foto &raquo; <?php echo $detalb->nama?></legend>
	<?php echo $this->session->flashdata("k")?>
	<form action="<?php echo base_URL()?>manage/galeri/rename_album" method="post">
		<input type="hidden" name="id_alb1" value="<?php echo $detalb->id?>">
		Ubah Nama Album <input type="text" name="nama_album" required> &nbsp; <input type="submit" class="btn" value="Simpan" style="margin-top: -10px">
	</form>

	<legend style="margin-bottom: 10px">Upload foto pada album "<?php echo $detalb->nama?>"</legend>
	<form action="<?php echo base_URL()?>manage/galeri/<?php echo $act?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<input type="hidden" name="id_alb2" value="<?php echo $detalb->id?>">
		<table style="width:100%">
			<tr>
				<td  style="width: 120px;"><label>Cari File</label> </td>
				<td><input type="file"  <?php $mode !== 'edit_foto' ? 'required':'' ?> name="foto"> &nbsp;</td>
			</tr>
			<tr>
				<td><label>Judul</label></td>
				<td><input class="span6" required type="text" name="judul" value="<?php echo $judul;?>" required></td>
			</tr>
			
			<tr>
				<td><label>SlideShow</label></td>
				<td>
					<select name="slideshow" id="select-slideshow">
						<option <?php echo $slideshow === 'N' ? 'selected':'';?> value="N">Tidak</option>	
						<option <?php echo $slideshow === 'Y' ? 'selected':'';?> value="Y">Ya</option>
					</select>
				</td>
			</tr>
			
			<tr style="display:none;" id="keterangan">
				<td><label>Keterangan</label></td>
				<td><input class="span6" type="text" name="ket" value="<?php echo $ket;?>"></td>
			</tr>
			
			<tr>
				<td></td>
				<td><input type="submit" class="btn" value="Simpan" style="margin-top: -10px"></td>
			</tr>
		</table>
	</form>
	
	<legend>Daftar Foto</legend>
	<div class="row-fluid">
	<ul class="thumbnails">
	  <?php
	  if  (empty($datdet)) {
		echo "<div class=\"alert alert-error\">Maaf, belum ada satupun foto</div>";
	  } else {
		  foreach ($datdet as $d) {
		  ?>
			<li class="span4" style="margin-left: 0px; margin-right: 9px">
				<div class="thumbnail" style="height: 280px">
					<img src="<?php echo base_URL()?>timthumb?src=/upload/galeri/<?php echo $d->file . '&w=334&h=190&zc=0'?>" style="width: 334px; height: 190px" alt="<?php echo $d->ket?>">
					<div class="caption">
						<h6 style="text-align: center; margin-top: 0">					
							<strong><?php echo strtoupper($d->judul)?></strong> <br>
							
							<?php if(!IsNullOrEmptyString($d->ket)){ ?>  					
							<?php echo '(' . ucwords($d->ket) . ')'?> <br>  	
							<?php } ?>
							
							<input <?php echo $d->slideshow === 'Y' ? 'checked' : ''?> class="slideshow-cb" id="<?php echo $d->id;?>" type="checkbox"> Slideshow<br>
							<a href="<?php echo base_URL()?>manage/galeri/del_foto/<?php echo $detalb->id?>/<?php echo $d->id?>" onclick="return confirm('Anda Yakin ..?'); ">Hapus Foto</a> | 
							<a href="<?php echo base_URL()?>manage/galeri/edit_foto/<?php echo $detalb->id?>/<?php echo $d->id?>" >Edit Foto</a>
						</h6>

					</div>
				</div>
			</li>
		  
		  <?php
		  }
	  }
	  ?>
	  
	</ul>
  </div>

  <script type="text/javascript">

  	<?php if($slideshow === 'Y'){ ?>
  		$('#keterangan').show(); 		
  	<?php }else{ ?>	
  		$('#keterangan').hide(); 		
  	<?php } ?>	

  	$('#select-slideshow').change(function(){
	  var slideshow = $('#select-slideshow').val();

	  if (slideshow === 'Y') {
		$('#keterangan').show(); 		
	  }else{
		$('#keterangan').hide();
	  }
	  
	})

  	$('.slideshow-cb').click(function() {
        var id_galeri = $(this).attr('id');
        
        if($(this).is(':checked')){
        	$.post("<?php echo base_url() . 'manage/galeri/set_slideshow';?>", 
        			{ id: id_galeri ,
        			  act : 'add_slide' } 
        	).done(function(data){

        	});
        }else{
			$.post("<?php echo base_url() . 'manage/galeri/set_slideshow';?>", 
        			{ id: id_galeri ,
        			  act : 'del_slide' } 
        	).done(function(data){

        	});
        }   

        //return false; 
    });
  </script>
