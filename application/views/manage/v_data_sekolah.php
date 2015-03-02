<legend>Daftar Data Sekolah</legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/data_sekolah/add/', '_self')">Data Baru</button>
<br><br>
<?php echo $this->session->flashdata("k");?>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th width="10%" style="text-align: left">NPSN</th>
      <th width="30%" style="text-align: left">Nama</th>
      <th width="10%" style="text-align: left">Jenjang</th>
      <th width="10%" style="text-align: left">Status</th>
      <th width="5%" style="text-align: left">Guru</th>
      <th width="5%" style="text-align: left">Siswa</th>
      <th width="10%" style="text-align: left">Statistik</th>
      <th width="15%">Control</th>
   </tr>
   <?php $i = 0 ?>
   <?php if($data->num_rows() == 0){ ?>
   <tr><td colspan='8' align='center'> Data not found </td></tr>
   <?php }else{ ?>
   <?php foreach ($data->result() as $b):
      $i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td><?php echo $b->npsn?></td>
      <td><?php echo $b->nama?></td>
      <td><?php echo strtoupper($b->jenjang)?></td>
      <td><?php echo ucfirst($b->status)?></td>
      <td><a href="<?php echo base_URL() . 'manage/data_guru/' . $b->id;?>">Guru</a></td>
      <td><a href="<?php echo base_URL() . 'manage/data_siswa/' . $b->id;?>">Siswa</a></td>
      <td><a href="<?php echo base_URL() . 'manage/sekolah_stats/' . $b->id;?>">Statistik</a></td>
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/data_sekolah/edt/<?php echo $b->id?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/data_sekolah/del/<?php echo $b->id ?>" onclick="return confirm('Anda YAKIN menghapus data ini ?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
      </td>
   </tr>
   <?php endforeach ?>
   <?php } ?>
</table>
<center>
   <div class="pagination pagination-small">
      <ul><?php echo $this->pagination->create_links();?> </ul>
   </div>
</center>
