<?php 
	$id_produk_hukum	= $this->uri->segment(3);
	$judul_produk = $this->basecrud_m->get_where('data_produk_hukum',array('id' => $id_produk_hukum ))->row()->judul;
?>

<div class="row-fluid">
	<div class="span12">
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>manage/data_produk_hukum">Kategori Produk Hukum</a> <span class="divider">/</span></li>
			<li><?php echo $judul_produk?></li>
		</ul>
	</div>
</div>

<legend>Kategori <?php echo $judul_produk?></legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL() . 'manage/prod_hukum_list/' . $id_produk_hukum . '/add/'; ?>', '_self')">Data Baru</button>
<br><br>
<?php echo $this->session->flashdata("k");?>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th style="text-align: center" width="5%">Nomor</th>
      <th style="text-align: center" width="5%">Tahun</th>      
      <th style="text-align: left" width="50%">Tentang</th>
      <th style="text-align: center" width="15%">Dokumen</th>
      <th style="text-align: left" width="5%">Terbit</th>
      <th width="10%">Control</th>
   </tr>
   <?php $i = 0 ?>
   <?php if($data->num_rows() == 0){ ?>
   <tr>
      <td colspan='6' align='center'> Data not found </td>
   </tr>
   <?php }else{ ?>
   <?php foreach ($data->result() as $b):
      $i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td style="text-align: center"><?php echo $b->nomor?></td>
      <td style="text-align: center"><?php echo $b->tahun?></td>
      <td><?php echo $b->tentang?></td>  
      <td style="text-align: center">
         <?php $files = $this->db->query("SELECT * FROM produk_hukum_files WHERE id_prod_hukum_list = $b->id");?>
         <a href="<?php echo base_URL(); ?>manage/prod_hukum_list/<?php echo $id_produk_hukum?>/file/<?php echo $b->id?>"><?php echo $files->num_rows() . ' File';?></a>
      </td>          
      <td><?php echo $b->terbit?></td>      
      
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/prod_hukum_list/<?php echo $id_produk_hukum?>/edt/<?php echo $b->id?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/prod_hukum_list/<?php echo $id_produk_hukum?>/del/<?php echo $b->id ?>" onclick="return confirm('Anda YAKIN menghapus data ini');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
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


