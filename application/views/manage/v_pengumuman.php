<legend>Daftar Pengumuman</legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/pengumuman/add/', '_self')">Entri Baru</button>

<br><br>
<?php echo $this->session->flashdata("k");?>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th width="35%" style="text-align: left">Judul</th>      
      <th width="35%" style="text-align: left">Dokumen</th>      
      <th width="15%" style="text-align: left">Tgl. Posting</th>      
      <th width="20%">Control</th>
   </tr>
   <?php 
      $start_number = $this->uri->segment(3);
      $i = $start_number == TRUE ? $start_number : 0; 
   ?>
   <?php foreach ($pengumuman->result() as $b):
      $i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td><?php echo $b->judul ?></td>  
      
      <?php if(!IsNullOrEmptyString($b->file_name)){ ?>
      <td><a href="<?php echo base_URL() . 'upload/post/' . $b->file_name;?>">[Download]</a></td>         
      <?php }else{ ?>
      <td> - </td>
      <?php } ?>

      <td><?php echo tgl_panjang($b->tglPost, "sm")?></td>
      
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/pengumuman/edit/<?php echo $b->id ?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/pengumuman/del/<?php echo $b->id ?>" onclick="return confirm('Anda YAKIN menghapus data \n <?php echo $b->judul?>..?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
         <?php
            if ($b->publish == "N") {
            ?>					
         <a href="<?php echo base_URL(); ?>manage/pengumuman/pub/<?php echo $b->id ?>">Publish</a>
         <?php } else { ?>
         <a href="<?php echo base_URL(); ?>manage/pengumuman/unpub/<?php echo $b->id ?>">Draft</a>
         <?php } ?>						
      </td>
   </tr>
   <?php endforeach ?>
</table>

<center>
   <div class="pagination pagination-small">
      <ul><?php echo $this->pagination->create_links();?> </ul>
   </div>
</center>

