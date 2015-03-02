<legend>Daftar komentar masuk</legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/komentar/add/', '_self')">Entri Baru</button>
<br><br>
<?php echo $this->session->flashdata("k");?>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th width="10%" style="text-align: left">Post ID</th>
      <th width="20%" style="text-align: left">Nama</th>
      <th width="15%" style="text-align: left">Email</th>
      <th width="35%" style="text-align: left">Pesan</th>
      <th width="15%">Control</th>
   </tr>
   <?php 
      if (empty($komen)) {
      		echo "<tr><td colspan='6' align='center'> Data not found </td></tr>";
      }else {
	      	$i = 0;
	      	foreach ($komen as $data) {
	      	$i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td style="text-align: center"><?php echo $data->id_berita ?></td>
      <td><?php echo $data->nama ?></td>
      <td><?php echo $data->email?></td>
      <td><?php echo $data->komentar?></td>
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/komentar/edit/<?php echo $data->id ?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/komentar/del/<?php echo $data->id?>" onclick="return confirm('Anda YAKIN menghapus data \n <?php echo $data->komentar?>..?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
      </td>
   </tr>
   <?php } ?> 
   <?php } ?>
      
</table>