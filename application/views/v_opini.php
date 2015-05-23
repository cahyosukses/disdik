	<ul class="breadcrumb wellwhite">
		<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
		<li><a href="<?php echo base_URL()?>tampil/opini">Pojok Opini</a></li>		
	</ul>

	<div class="span12 wellwhite" style="margin-left: 0px">
		<legend>Daftar Pojok Opini</legend>
		<table class="table table-hover">
          <thead>
            <tr>
              <th style="text-align:left"><a href="<?php echo base_URL() . 'tampil/opini/set_sort/judul'?>">Judul</a></th>
              <th><a href="<?php echo base_URL() . 'tampil/opini/set_sort/oleh'?>">Penulis</a></th>
              <th><a href="<?php echo base_URL() . 'tampil/opini/set_sort/hits'?>">Hits</a></th>              
            </tr>
          </thead>
          <tbody>
          <?php if($data->num_rows() == 0 ){ ?>
          <tr><td colspan='3' align='center'>Data Belum Ada</td></tr>
          <?php }else{ ?>
          <?php foreach ($data->result() as $d){ ?>
            <tr>              
              <td style="text-align:left"><a href="<?php echo base_URL() . 'tampil/opini/detail/' . $d->id;?>"><?php echo substr($d->judul,0,40)?><?php echo strlen($d->judul) > 40 ? '...':''?></a></td>  
              <td style="text-align:center"><?php echo $d->oleh?></td>  
              <td style="text-align:center"><?php echo $d->hits?></td>                
            </tr>            
            <?php }?>
            <?php } ?>
          </tbody>
        </table>
	</div>

	<center>
     <div class="pagination pagination-small">
         <ul><?php echo $this->pagination->create_links();?> </ul>
     </div>
  	</center>