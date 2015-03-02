<?php 
   $id_sekolah	= $this->uri->segment(3);
   $nama_sekolah = $this->basecrud_m->get_where('data_sekolah',array('id' => $id_sekolah ))->row()->nama;
?>
<div class="row-fluid">
   <div class="span12">
      <ul class="breadcrumb wellwhite">
         <li><a href="<?php echo base_URL()?>manage/data_sekolah">Daftar Data Sekolah</a> <span class="divider">/</span></li>
         <li><?php echo $nama_sekolah?></li>
      </ul>
   </div>
</div>

<legend>Daftar Data Statistik <?php echo $nama_sekolah;?></legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL() . 'manage/sekolah_stats/' . $id_sekolah . '/add/'; ?>', '_self')">Data Baru</button>
<br><br>
<?php echo $this->session->flashdata("k");?>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th style="text-align: center" width="10%">Tahun</th>
      <th style="text-align: center" width="10%">Rombel</th>
      <th style="text-align: center" width="10%">Murid</th>
      <th style="text-align: center" width="10%">Guru</th>
      <th style="text-align: center" width="10%">Ruang Kelas</th>
      <th style="text-align: center" width="10%">Lulusan</th>
      <th width="10%">Control</th>
   </tr>
   <?php $i = 0 ?>
   <?php if($data->num_rows() == 0){ ?>
   <tr>
      <td colspan='8' align='center'> Data not found </td>
   </tr>
   <?php }else{ ?>
   <?php foreach ($data->result() as $b):
      $i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td style="text-align: center"><?php echo $b->tahun?></td>
      <td style="text-align: center"><?php echo $b->rombel?></td>
      <td style="text-align: center"><?php echo $b->murid?></td>
      <td style="text-align: center"><?php echo $b->guru?></td>
      <td style="text-align: center"><?php echo $b->ruang_kelas?></td>
      <td style="text-align: center"><?php echo $b->lulusan?></td>
      <td style="text-align: center">
        <a href="<?php echo base_URL(); ?>manage/sekolah_stats/<?php echo $id_sekolah?>/edt/<?php echo $b->id?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
	    <a href="<?php echo base_URL(); ?>manage/sekolah_stats/<?php echo $id_sekolah?>/del/<?php echo $b->id ?>" onclick="return confirm('Anda YAKIN menghapus data ini ?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
      </td>
   </tr>
   <?php endforeach; ?>
   <?php } ?>
</table>

<center>
   <div class="pagination pagination-small">
      <ul><?php echo $this->pagination->create_links();?> </ul>
   </div>
</center>