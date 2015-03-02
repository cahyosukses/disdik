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

<legend>Daftar Data Guru <?php echo $nama_sekolah;?></legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL() . 'manage/data_guru/' . $id_sekolah . '/add/'; ?>', '_self')">Data Baru</button>
<br><br>
<?php echo $this->session->flashdata("k");?>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th style="text-align: left" width="15%">No. Pegawai</th>
      <th style="text-align: left" width="20%">Nama</th>      
      <th style="text-align: left" width="15%">NUPTK</th>
      <th style="text-align: left" width="5%">JK</th>
      <th style="text-align: left" width="10%">Status</th>
      <th style="text-align: left" width="5%">Status Aktif</th>
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
      <td><?php echo $b->nip?></td>
      <td><?php echo strtoupper($b->nama)?></td>
      <td><?php echo $b->nuptk?></td>      
      <td><?php echo strtoupper($b->jk)?></td>
      <td><?php echo strtoupper($b->status)?></td>      
      <td><?php echo $b->aktif === 'Y' ? 'Aktif':'Non Aktif';?></td>
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/data_guru/<?php echo $id_sekolah?>/edt/<?php echo $b->id?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/data_guru/<?php echo $id_sekolah?>/del/<?php echo $b->id ?>" onclick="return confirm('Anda YAKIN menghapus data \n <?php echo $b->nama?>..?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
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


