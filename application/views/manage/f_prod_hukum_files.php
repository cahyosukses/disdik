<?php

	$id_produk_hukum    = $this->uri->segment(3);
	$mode               = $this->uri->segment(4);
	$id_prod_hukum_list = $this->uri->segment(5);
	$judul_produk       = $this->basecrud_m->get_where('data_produk_hukum',array('id' => $id_produk_hukum ))->row()->judul;
	$list               = $this->basecrud_m->get_where('produk_hukum_list',array('id' => $id_prod_hukum_list ))->row();

   if($mode === 'file_edt'){
      $judul       = $data->judul;      
      $act         = "";
   }else{
      $judul       = "";        
      $act         = $id_produk_hukum . '/file_add/' . $id_prod_hukum_list;;
   }
?>

<div class="row-fluid">
	<div class="span12">
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>manage/data_produk_hukum">Kategori Produk Hukum</a> <span class="divider">/</span></li>
			<li><a href="<?php echo base_URL()?>manage/prod_hukum_list/<?php echo $id_produk_hukum?>"><?php echo $judul_produk?></a><span class="divider">/</span></li>
			<li>Dokument</li>
		</ul>
	</div>
</div>

<h3><?php echo 'Nomor: ' . $list->nomor . ' Tahun: ' . $list->tahun;?></h3>

   <form action="<?php echo base_URL()?>manage/prod_hukum_list/<?php echo $act?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
      
      <table style="width:100%">
         <tr>
            <td  style="width: 120px;"><label>Cari File</label> </td>
            <td><input type="file"  <?php $mode !== 'file_edt' ? 'required':'' ?> name="f_dok"> &nbsp;</td>
         </tr>
         <tr>
            <td><label>Judul</label></td>
            <td><input class="span6" required type="text" name="judul" value="" required></td>
         </tr>
         <tr>
            <td></td>
            <td><input type="submit" class="btn" value="Simpan" style="margin-top: -10px"></td>
         </tr>
      </table>
   </form>
<table width="100%"  class="table table-condensed">
   <tr>
      <th width="5%">No</th>
      <th style="text-align: left" width="50%">Judul</th>
      <th style="text-align: center" width="20%">File</th>      
      <th style="text-align: center" width="5%">Dilihat</th>      
      <th width="10%">Control</th>
   </tr>
   <?php $i = 0 ?>
   <?php if($data->num_rows() == 0){ ?>
   <tr>
      <td colspan='5' align='center'> Data not found </td>
   </tr>
   <?php }else{ ?>
   <?php foreach ($data->result() as $b):
      $i++;
      ?>
   <tr>
      <td style="text-align: center"><?php echo $i; ?></td>
      <td style="text-align: left"><?php echo $b->judul?></td>
      <td style="text-align: center"><a href="<?php echo base_URL() . 'upload/download/' . $b->nama_file?>">[Download]</a></td>
      <td style="text-align: center"><?php echo $b->view_count?></td>  
      <td style="text-align: center">
         <!--<a href="<?php echo base_URL(); ?>manage/prod_hukum_list/<?php echo $id_produk_hukum?>/file_edt/<?php echo $id_prod_hukum_list . '/' . $b->id?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  -->
         <a href="<?php echo base_URL(); ?>manage/prod_hukum_list/<?php echo $id_produk_hukum?>/file_del/<?php echo $id_prod_hukum_list . '/' . $b->id ?>" onclick="return confirm('Anda YAKIN menghapus data ini');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
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