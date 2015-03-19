
   <?php echo $this->session->flashdata("k"); ?>
   <!--
   <div class="span12 wellwhite" style="margin-left: 0px">
      <legend>Selamat datang di website Dinas Pendidikan Provinsi Jambi</legend>
      <?php echo $haldep->isi?>
   </div>
   -->
   <div class="span12 wellwhite" style="margin-left: 0px">
      <legend>Index Berita</legend>
      <?php
         foreach ($berita as $b) {
         ?>
      <i><b><a href="<?php echo base_URL()?>tampil/blog/baca/<?php echo $b->id?>/<?php echo getURLFriendly($b->judul)?>"><?php echo $b->judul?></a></b></i>
      <p style="margin-top: 0px; font-size: 11px">Posted by : <b><?php echo $b->oleh?></b>,  pada : <b><?php echo tgl_panjang($b->tglPost, "lm")?></b>,  Dibaca <b><?php echo $b->hits?></b> kali</p>
      <p align="justify"><?php echo substr(strip_tags($b->isi), 0, 300)." ... "?> <a href="<?php echo base_URL()?>tampil/blog/baca/<?php echo $b->id?>/<?php echo getURLFriendly($b->judul)?>">[ Read more ]</a>
      </p>
      <?php 
         }
         ?>
   </div>

<!--/span-->

