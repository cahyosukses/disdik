<legend><?php echo $title;?></legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/agenda/add/', '_self')">Data Baru</button>
<br><br>
<?php echo $this->session->flashdata("k");?>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th width="40%" style="text-align: left">Judul</th>
      <th width="20%" style="text-align: left">Tgl Mulai</th>
      <th width="20%" style="text-align: left">Tgl Selesai</th>
      <th width="20%" style="text-align: left">Lokasi</th>
      <th width="15%">Control</th>
   </tr>
   <?php $i = 0 ?>
   <?php foreach ($data as $b):
      $i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td><?php echo $b->title?></td>
      <td><?php echo $b->tgl_mulai?></td>
      <td><?php echo $b->tgl_selesai?></td>
      <td><?php echo $b->lokasi?></td>
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/agenda/edit/<?php echo $b->id?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/agenda/del/<?php echo $b->id ?>" onclick="return confirm('Anda YAKIN menghapus data \n <?php echo $b->title?>..?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
      </td>
   </tr>
   <?php endforeach ?>
</table>

