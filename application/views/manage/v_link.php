<legend>Daftar </legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/link/add/', '_self')">Data Baru</button>
<br><br>
<?php echo $this->session->flashdata("k");?>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th width="35%" style="text-align: left">Nama</th>
      <th width="35%" style="text-align: left">Alamat</th>
      <th width="25%" style="text-align: center">Control</th>
   </tr>
   <?php $i = 0 ?>
   <?php foreach ($data as $b):
      $i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td><?php echo $b->nama?></td>
      <td style="text-align: left">
         <a href="<?php echo $b->alamat?>" target="_blank"><?php echo $b->alamat?></a>
      </td>
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/link/edit/<?php echo $b->id?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/link/del/<?php echo $b->id ?>" onclick="return confirm('Anda YAKIN menghapus data \n <?php echo $b->nama?>..?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
      </td>
   </tr>
   <?php endforeach ?>
</table>