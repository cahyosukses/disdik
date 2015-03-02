<legend>Daftar Posting</legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/blog/add/', '_self')">Entri Baru</button>
<!--<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/kategori_berita/', '_self')">Kategori Berita</button>-->

<br><br>
<?php echo $this->session->flashdata("k");?>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th width="35%" style="text-align: left">Judul</th>
      <th width="10%" style="text-align: left">Kategori</th>
      <th width="15%" style="text-align: left">Tgl. Posting</th>
      <th width="15%" style="text-align: left">Komentar</th>
      <th width="20%">Control</th>
   </tr>
   <?php $i = 0 ?>
   <?php foreach ($blog as $b):
      $j_komen	= $this->db->query("SELECT * FROM berita_komen WHERE id_berita = '".$b->id."'")->num_rows();
      
      $i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td><?php echo $b->judul ?></td>
      <td>
      	<?php $select_kat = explode('-',$b->kategori);?>
      	<?php $kat_list = "";?>
      	<?php foreach ($select_kat as $key){ ?>
      	<?php 	$kat_list .= strlen(trim($key)) > 0 ? $this->basecrud_m->get_where('kat',array('id' => $key))->row()->nama . ',' : ''; ?>
      	<?php } ?>
      	<?php echo substr($kat_list, 0,-1);?>
      </td>
      <td><?php echo tgl_panjang($b->tglPost, "sm")?></td>
      <td style="text-align: left"><a href="<?php echo base_URL(); ?>manage/komentar_by_post/<?php echo $b->id ?>"><span class="icon-comment">&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $j_komen?>)</span></a></td>
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/blog/edit/<?php echo $b->id ?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/blog/del/<?php echo $b->id ?>/<?php echo $b->gambar ?>" onclick="return confirm('Anda YAKIN menghapus data \n <?php echo $b->judul?>..?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
         <?php
            if ($b->publish == "0") {
            ?>					
         <a href="<?php echo base_URL(); ?>manage/blog/pub/<?php echo $b->id ?>">Publish</a>
         <?php } else { ?>
         <a href="<?php echo base_URL(); ?>manage/blog/unpub/<?php echo $b->id ?>">Draft</a>
         <?php } ?>						
      </td>
   </tr>
   <?php endforeach ?>
</table>

