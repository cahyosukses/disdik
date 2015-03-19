<legend>Daftar Galeri Video</legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/galeri_video/add/', '_self')">Entri Baru</button>
<br><br>

<?php echo $this->session->flashdata("k");?>
<?php if(isset($msg)){ ?>
<div class='alert alert-error'><?php echo $mgs;?></div>
<?php } ?>

<div class="row-fluid">
   <ul class="thumbnails">
      <?php 
         foreach ($data->result() as $d) { ?>
      <li class="span4" style="margin-left: 0px; margin-right: 9px">
         <div class="thumbnail" style="height: 240px">
            <img src="<?php echo base_URL()."timthumb?src=http://img.youtube.com/vi/". $d->video_id ."/0.jpg";?>&w=334&h=190&zc=0" style="width: 334px; height: 190px" alt="<?php echo $d->judul;?>">
            <div class="caption">
               <h6 style="text-align: center; margin-top: 0"><?php echo $d->judul;?><br>
                  <a href="<?php echo base_URL(); ?>manage/galeri_video/del/<?php echo $d->id?>" onclick="return confirm('Anda Yakin ..?'); ">Hapus</a> | 
                  <a href="<?php echo base_URL(); ?>manage/galeri_video/edt/<?php echo $d->id ?>">Manage</a>
               </h6>            
           </div>
         </div>
     </li>
     <?php } ?>
   </ul>
</div>

<!--
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>      
      <th width="20%" style="text-align: left">Judul</th>
      <th width="20%" style="text-align: left">Youtube Video ID</th>
      <th width="15%">Control</th>
   </tr>
   <?php 
      if ($data->num_rows() == 0) {
      		echo "<tr><td colspan='4' align='center'> Data not found </td></tr>";
      }else {
	      	$i = 0;
	      	foreach ($data->result() as $d) {
	      	$i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td>         
         <?php echo $d->judul ?>
      </td>
      <td><a href="https://www.youtube.com/watch?v=<?php echo $d->video_id?>" target="_BLANK"><?php echo $d->video_id ?></a></td>
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/galeri_video/edt/<?php echo $d->id ?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/galeri_video/del/<?php echo $d->id?>" onclick="return confirm('Anda YAKIN menghapus data ini ?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
      </td>
   </tr>
   <?php } ?> 
   <?php } ?>
      
</table>
-->