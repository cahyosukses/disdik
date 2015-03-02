<div class="span9">
   <ul class="breadcrumb wellwhite">
      <li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
      <li><a href="<?php echo base_URL()?>tampil/blog">Berita</a> </li>
   </ul>
   <div class="span12 wellwhite" style="margin-left: 0px">
      <legend style="margin-bottom: 10px">Index Berita</legend>
      <?php
         foreach ($blog as $b) { 
         	if (empty($b->gambar)) {
         ?>
      <b><i><?php echo $b->judul?></i></b>
      <p style="margin-top: 0px; font-size: 12px">Posted by : <b><?php echo $b->oleh?></b>,  pada : <b><?php echo tgl_panjang($b->tglPost, "lm")?></b>,  Dibaca <b><?php echo $b->hits?></b> kali</p>
      <p><?php echo substr(strip_tags($b->isi), 0, 300)." ... "?> <a href="<?php echo base_URL()?>tampil/blog/baca/<?php echo $b->id?>/<?php echo getURLFriendly($b->judul)?>">[Read more]</a></p>
      <?php $pch_kat	= explode("-", $b->kategori); ?>
      <p id="ket_bawah" style="padding-bottom: 15px; border-bottom: dotted 1px #3d3d3d">Kategori :
         <?php
            foreach ($pch_kat as $pc) {
            	if ($pc != "") {
            		$nama_kat	= $this->db->query("SELECT * FROM kat WHERE id = '".$pc."'")->row();
            		echo "<span style='padding: 3px 7px 3px 7px; background:#efefef; margin-right: 5px'><b><a href='".base_URL()."tampil/kategori/".$nama_kat->id."'>".$nama_kat->nama."</a></b></span>";
            	}
            }
            ?>
      </p>
      <?php 
         } else {
         ?>
      <b><i><?php echo $b->judul?></i></b>
      <p style="margin-top: 0px; font-size: 12px">Posted by : <b><?php echo $b->oleh?></b>,  pada : <b><?php echo tgl_panjang($b->tglPost, "lm")?></b>,  Dibaca <b><?php echo $b->hits?></b> kali</p>
      <p style="display: block;">
      <div class="span3 thumbnail" style="margin-left: 0px">		  	                       
         <img src="<?php echo base_URL()?>timthumb?src=/upload/post/<?php echo $b->gambar . '&h=100&w=146&zc=1'?>" alt="" width="146" height="100">
      </div>
      <div class="span9" style=" text-align: justify">
         <?php echo substr(strip_tags($b->isi), 0, 300)." ... "?> <a href="<?php echo base_URL()?>tampil/blog/baca/<?php echo $b->id?>/<?php echo getURLFriendly($b->judul)?>">[Read more]</a>
      </div>
      </p>
      <br><br><br><br><br><br>
      <?php $pch_kat	= explode("-", $b->kategori); ?>
      <p id="ket_bawah" style="display: block; padding-bottom: 15px; border-bottom: dotted 1px #3d3d3d">Kategori :
         <?php
            foreach ($pch_kat as $pc) {
            	if ($pc != "") {
            		$nama_kat	= $this->db->query("SELECT * FROM kat WHERE id = '".$pc."'")->row();
            		echo "<span style='padding: 3px 7px 3px 7px; background:#efefef; margin-right: 5px'><b><a href='".base_URL()."tampil/kategori/".$nama_kat->id."'>".$nama_kat->nama."</a></b></span>";
            	}
            }
            ?>
      </p>
      <?php
         }
         } 
         ?>
      <center>
         <div class="pagination pagination-small">
            <ul><?php echo $page?></ul>
         </div>
      </center>
   </div>
</div>
<!--/span-->

