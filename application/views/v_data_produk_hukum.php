<?php
	$id_prod_hukum	= $this->uri->segment(3);	
?>

<div class="span9">
	<ul class="breadcrumb wellwhite">
	   <li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
	   <li>Produk Hukum <span class="divider">/</span></li>
	   <li><?php echo $data_produk_hukum->judul?></li>
	</ul>

	<?php $r = $this->db->query("SELECT * FROM produk_hukum_list WHERE id_produk_hukum = $id_prod_hukum");
		  if($r->num_rows() == 0){	
	?>
	<div class="alert alert-error">
    	Belum ada data
    </div>
	<?php }else{ ?>

	<div class="span12 wellwhite" style="margin-left: 0px;">
	   <legend><?php echo $data_produk_hukum->judul?></legend>
	   
	   <form class="form-search" method="POST" action="">
          <?php $cari = $this->session->userdata('cari');?>
	      <input type="text" name="cari" value="<?php echo $cari?>" placeholder="Masukkan Kata yang dicari">
	      <label class="control-label" for="inputEmail" style="margin-left:10px">Tahun</label>
	      <?php $tahun = $this->db->query("SELECT DISTINCT tahun 
			                               FROM produk_hukum_list 
			                               WHERE id_produk_hukum = $id_prod_hukum
			                               ORDER BY tahun DESC");?>
	      <select name="tahun">
            <?php $tahun_cari = $this->session->userdata('tahun');?>
	        <option value="">Semua</option>
	        <?php foreach ($tahun->result() as $th){ ?>
	        <option <?php echo $tahun_cari === $th->tahun ? 'selected' : '';?> value="<?php echo $th->tahun;?>"><?php echo $th->tahun;?></option>
	        <?php } ?>
	      </select>

	      
	      <button type="submit" class="btn">Cari</button>
	      <a href="<?php echo base_url() . 'tampil/reset_search/prod_hukum/' . $id_prod_hukum;?>"><button type="button" class="btn btn-success"> Reset</button></a>
	   </form>
	   <hr>
        
        <?php foreach ($data->result() as $d){ ?>
        <div class="well well-small" style="margin-bottom:5px">
            <table>
                <thead>
                    <tr>
                        <th align="left" colspan="3">No <?php echo $d->nomor;?> Tahun <?php echo $d->tahun;?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="100" valign="top">Tanggal terbit</td>
                        <td valign="top">:&nbsp;&nbsp;</td>
                        <td valign="top"><?php echo tgl_panjang($d->terbit,'lm');?></td>
                    </tr>
                    <tr>
                        <td width="100" valign="top">Nomor</td>
                        <td valign="top">:&nbsp;&nbsp;</td>
                        <td valign="top"><?php echo $d->nomor;?></td>
                    </tr>
                    <tr>
                        <td width="100" valign="top">Tentang</td>
                        <td valign="top">:&nbsp;&nbsp;</td>
                        <td valign="top"><?php echo $d->tentang;?></td>
                    </tr>
                    <tr>
                        <td width="100" valign="top">Dokumen</td>
                        <td valign="top">:&nbsp;&nbsp;</td>
                        <td valign="top">
                            <ol>
                            <?php $files = $this->basecrud_m->get_where('produk_hukum_files',array('id_prod_hukum_list' => $d->id,'terhapus' => 'N'));?>
                                <?php foreach ($files->result() as $file){ ?>
                                <li><a href="<?php echo base_URL() . 'tampil/download_file/dok_hukum/' . $file->id;?>"><?php echo $file->judul . ' - ' . pathinfo($file->nama_file, PATHINFO_EXTENSION);?></a>&nbsp;&nbsp;(<?php echo $file->view_count;?> view)</li>    
                                <?php }?>                                
                            </ol>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>    
        <?php }?>
		
        <center>
         <div class="pagination pagination-small">
             <ul><?php echo $this->pagination->create_links();?> </ul>
         </div>
      </center>
	   
	</div>
	<?php } ?>

 </div><!--/span-->