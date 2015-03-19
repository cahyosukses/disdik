<legend>Daftar User</legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/user/add/', '_self')">Entri Baru</button>
<br><br>

<?php echo $this->session->flashdata("k");?>
<?php if(isset($msg)){ ?>
<div class='alert alert-error'><?php echo $mgs;?></div>
<?php } ?>

<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>            
      <th width="20%" style="text-align: left">Nama</th>
      <th width="20%" style="text-align: left">User Name</th>
      <th width="20%" style="text-align: left">Email</th>
      <th width="20%" style="text-align: left">Level</th>
      <th width="15%">Control</th>
   </tr>
   <?php 
      if ($data->num_rows() == 0) {
      		echo "<tr><td colspan='6' align='center'> Data not found </td></tr>";
      }else {
	      	   
            $start_number = $this->uri->segment(3);
            $i = $start_number == TRUE ? $start_number : 0; 
  
	      	foreach ($data->result() as $d) {
	      	$i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td>
         <?php echo $d->nama;?>
         <?php if($d->aktif === 'N'){ ?><span class="label label-important">Non Aktif</span> <?php } ?>
      </td>
      <td><?php echo $d->u;?></td>
      <td><?php echo $d->email;?></td>
      <td><?php echo $d->level === '1' ? 'Administrator' : 'Post Berita';?></td>
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/user/edt/<?php echo $d->id ?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/user/del/<?php echo $d->id?>" onclick="return confirm('Anda YAKIN menghapus data ini ?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
      </td>
   </tr>
   <?php } ?> 
   <?php } ?>
      
</table>

<center>
   <div class="pagination pagination-small">
      <ul><?php echo $this->pagination->create_links();?> </ul>
   </div>
</center>