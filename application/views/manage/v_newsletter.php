<legend>Daftar Newsletter (Maks. 3 Entri)</legend>
<?php $r = $this->basecrud_m->get('newsletter')->num_rows();?>
<?php if($r < 3){ ?>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/newsletter/add/', '_self')">Entri Baru</button>
<?php } ?>

<br><br>
<?php echo $this->session->flashdata("k");?>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th width="35%" style="text-align: left">Judul</th>
      <th width="10%" style="text-align: left">Keterangan</th>      
      <th width="20%">Control</th>
   </tr>
   <?php 
      $start_number = $this->uri->segment(3);
      $i = $start_number == TRUE ? $start_number : 0; 
   ?>
   <?php foreach ($blog->result() as $b):
      $i++;
   ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td><?php echo $b->judul ?></td>
      <td><?php echo $b->keterangan ?></td>
      
      
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/newsletter/edit/<?php echo $b->id ?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/newsletter/del/<?php echo $b->id ?>" onclick="return confirm('Anda YAKIN menghapus data \n <?php echo $b->judul?>..?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>         					
      </td>
   </tr>
   <?php endforeach ?>
</table>

<center>
   <div class="pagination pagination-small">
      <ul><?php echo $this->pagination->create_links();?> </ul>
   </div>
</center>

