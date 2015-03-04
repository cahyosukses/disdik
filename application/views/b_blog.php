<div class="span9">
	<ul class="breadcrumb wellwhite">
	   <li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
	   <li><a href="<?php echo base_URL()?>tampil/blog">Blogpost</a> <span class="divider">/</span></li>
	   <li><?php echo $baca->judul?></li>
	</ul>
	<div class="span12 wellwhite" style="margin-left: 0px">
	   <legend style="margin-bottom: 10px"><?php echo $baca->judul?></legend>
	   <?php
	      if (empty($baca->gambar)) {
	      ?>
	   <p style="margin-top: 0px; font-size: 12px">Posted by : <b>
	    	<?php echo $baca->oleh?></b>,  pada : <b><?php echo tgl_panjang($baca->tglPost, "lm")?></b>,  Dibaca <b><?php echo $baca->hits?></b> kali 
	    	<a href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php echo base_URL().uri_string()?>&p[images][0]=<?php echo base_URL()?>logo.jpg&p[title]=<?php echo $baca->judul?>&p[summary]=<?php echo substr(strip_tags($baca->isi), 0, 500)?>" title="Share tulisan ini ke Facebook" target="blank"><img src="<?php echo base_URL()?>facebook_button.png" style="height: 20px; width: 100px; margin-top: -5px; margin-left: 10px"></a></p>
	   <p><?php echo $baca->isi?></p>
	   <?php $pch_kat	= explode("-", $baca->kategori); ?>
	   <p id="ket_bawah" style="padding-bottom: 15px">Kategori :
	      <?php
	         foreach ($pch_kat as $pc) {
	         	if ($pc != "") {
	         		$nama_kat	= $this->db->query("SELECT * FROM kat WHERE id = '".$pc."'")->row();
	         		echo "<span style='padding: 3px 7px 3px 7px; background:#efefef; margin-right: 5px'><b><a href='".base_URL()."tampil/kategori/".$nama_kat->id."/".$nama_kat->nama."'>".$nama_kat->nama."</a></b></span>";
	         	}
	         }
	         
	         ?>
	   </p>

	   <?php if(!IsNullOrEmptyString($baca->file_name)){ ?>
       <p class="span11" style="margin-left: 0px"><b>Dokumen: </b><a href="<?php echo base_URL() . 'upload/post/' . $baca->file_name;?>"><i class="icon-download"></i>Download File</a></p>
       <?php } ?>

	   <?php
	      } else {
	      ?>
	   <p style="margin-top: 0px; font-size: 12px">Posted by : <b><?php echo $baca->oleh?></b>,  pada : <b><?php echo tgl_panjang($baca->tglPost, "lm")?></b>,  Dibaca <b><?php echo $baca->hits?></b> kali <a href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php echo base_URL().uri_string()?>&p[images][0]=<?php echo base_URL()?>upload/post/small/S_<?php echo $baca->gambar?>&p[title]=<?php echo $baca->judul?>&p[summary]=<?php echo substr(strip_tags($baca->isi), 0, 500)?>" title="Share tulisan ini ke Facebook" target="blank"><img src="<?php echo base_URL()?>facebook_button.png" style="height: 20px; width: 100px; margin-top: -5px; margin-left: 10px"></a></p>
	   <p>
	   <div class="span3 thumbnail" style="margin: 0px 20px 20px 0;float: left; display: inline">
	   	<img src="<?php echo base_URL()?>timthumb?src=/upload/post/<?php echo $baca->gambar . '&h=100&w=146&zc=1'?>" alt="" width="146" height="100">	   		
	   	</div>
	   <div style=" text-align: justify; ">
	      <?php echo $baca->isi?>
	   </div>
	   </p>
	   <br><br>
	   <?php $pch_kat	= explode("-", $baca->kategori); ?>
	   <p class="span11" style="margin-left: 0px"> Kategori :
	      <?php
	         foreach ($pch_kat as $pc) {
	         	if ($pc != "") {
	         		$nama_kat	= $this->db->query("SELECT * FROM kat WHERE id = '".$pc."'")->row();
	         		echo "<span style='padding: 3px 7px 3px 7px; background:#efefef; margin-right: 5px'><b><a href='".base_URL()."tampil/kategori/".$nama_kat->id."/".$nama_kat->nama."'>".$nama_kat->nama."</a></b></span>";
	         	}
	         }
	         ?>
	   </p><br>

	   <?php if(!IsNullOrEmptyString($baca->file_name)){ ?>
       <p class="span11" style="margin-left: 0px"><b>Dokumen: </b><a href="<?php echo base_URL() . 'upload/post/' . $baca->file_name;?>"><i class="icon-download"></i>Download File</a></p>
       <?php } ?>


	   <?php
	      }
	      $kode 		= random_string('alnum', 5);
	      ?>
	   <div class="span4" id="komentar">
	      <legend>Postkan komentar</legend>
	      <?php echo $this->session->flashdata("k");?>
	      <form action="<?php echo base_URL()?>tampil/post_komen" method="post" onsubmit="return cek_kode_sama()" name="f_komen">
	         <input type="hidden" name="id" value="<?php echo $baca->id?>">
	         <input type="hidden" name="kode1" value="<?php echo $kode?>" id="kode1">
	         <table width="100%">
	            <tr>
	               <td><input type="text" class="span12" name="nama" placeholder="Nama Anda..." required></td>
	            </tr>
	            <tr>
	               <td><input type="email" class="span12" name="email"  placeholder="Email Anda..." required></td>
	            </tr>
	            <tr>
	               <td><textarea rows="3" class="span12" name="pesan"  placeholder="Pesan Anda (max 250 huruf)" required maxlength="250"></textarea></td>
	            </tr>
	            <tr>
	               <td>
	                  <input type="text" class="span7" name="kode"  placeholder="Kode disamping.." required>
	                  <span style="display: inline; margin-left: 20px; background: #e8e8e8; padding: 12px 10px 3px 10px; font-family: courier; font-weight: bold; "><?php echo $kode?></span>
	               </td>
	            </tr>
	            <tr>
	               <td><input type="submit" class="btn btn-primary" name="Simpan"></td>
	            </tr>
	         </table>
	      </form>
	   </div>
	   <div class="span1"></div>
	   <div class="span6">
	      <legend>Daftar komentar</legend>
	      <div style="overflow: auto; height: 350px">
	         <?php 
	            $q_komen	= $this->db->query("SELECT * FROM berita_komen WHERE id_berita = '".$baca->id."'")->result();
	            
	            foreach ($q_komen as $data) {
	            ?>
	         <div class="well"><b><?php echo $data->nama?></b> : "<?php echo $data->komentar?>"</div>
	         <?php } ?>
	      </div>
	   </div>
	</div>
</div>
<script type="text/javascript">
   function cek_kode_sama() {
   	var f = document.f_komen;
   	var kode1 = document.getElementById('kode1').value;
   	var kode2 = f.kode.value;
   	
   	if (kode1 != kode2) {
   		alert("Maaf, kode tidak Sama. \nMungkin huruf kecil dan huruf besarnya\nKode ini penting untuk menghindari SPAM..");
   		f.kode.focus();
   		return false;
   	} else {
   		return true;
   	}	
   }
</script>

