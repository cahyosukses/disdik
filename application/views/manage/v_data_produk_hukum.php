<legend>Kategori Produk Hukum</legend>
<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/data_produk_hukum/add/', '_self')">Data Baru</button>
<br><br>
<?php echo $this->session->flashdata("k");?>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th width="30%" style="text-align: left">Kategori</th>
      <th width="40%" style="text-align: center">Jumlah Data</th>
      <th width="25%" style="text-align: center">Control</th>
   </tr>
   <?php $i = 0 ?>
   <?php foreach ($data->result() as $b):
      $i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td><?php echo $b->judul?></td>
      <td style="text-align: center">
      	<?php $d = $this->basecrud_m->get_where('produk_hukum_list',array('id_produk_hukum' => $b->id,
      	                                                                  'terhapus' => 'N')
      	                                        );
      	?>
      	<a href="<?php echo base_URL() . 'manage/prod_hukum_list/' . $b->id?>"><?php echo $d->num_rows() . ' Data';?></a>
      </td>
      <td style="text-align: center">
         <a href="<?php echo base_URL(); ?>manage/data_produk_hukum/edt/<?php echo $b->id?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
         <a href="<?php echo base_URL(); ?>manage/data_produk_hukum/del/<?php echo $b->id?>" onclick="return confirm('Anda YAKIN menghapus data \n <?php echo $b->judul?>..?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
      </td>
   </tr>
   <?php endforeach ?>
</table>

