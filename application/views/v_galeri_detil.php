
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
			<li><a href="<?php echo base_URL()?>tampil/galeri">Galeri</a> <span class="divider">/</span> </li>
			<li><?php echo $datalb->nama?>  </li>
		</ul>
		
		<div class="span12 wellwhite" style="margin-left: 0px">
		<legend style="margin-bottom: 10px">Album <?php echo $datalb->nama?></legend>
			<div class="row-fluid">
            <ul class="thumbnails">
              <?php
			  foreach ($datdet as $d) {
			  ?>
			  <li class="span4" style="margin-left: 0px; margin-right: 9px">
				<div class="thumbnail" style="height: 250px">
				<a class="fancybox" href="<?php echo base_URL()?>upload/galeri/<?php echo $d->file?>" data-fancybox-group="gallery" title="<?php echo strtoupper($d->judul)?>">
                  <img src="<?php echo base_URL()?>timthumb?src=/upload/galeri/<?php echo $d->file .'&w=204&h=190&zc=0'?>" style="width:204px;height: 190px" class="span12" alt="<?php echo $d->ket?>">
                 </a>
				 <div style="text-align: center; margin-top: 10px" class="caption">
                    <h6>
                    	<?php echo strtoupper($d->judul)?><br>
                    	<!--<?php echo '(' . ucwords($d->ket) . ')'; ?>-->
                    </h6>
                  </div>
                </div>
				
              </li>
			  
			  <?php
			  }
			  ?>
              
            </ul>
          </div>
		</div>
<!--/span-->