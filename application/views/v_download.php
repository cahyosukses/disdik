 <div class="span9">
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
			<li><a href="<?php echo base_URL()?>tampil/download">Download</a> </li>
		</ul>
			<div class="row-fluid">
            <ul class="thumbnails">
              <?php
			  foreach ($download as $data) {
			  ?>
			  <li class="span4" style="margin-left: 0px; margin-right: 9px">
                <div class="thumbnail" style="height: 450px">
                  <img src="<?php echo base_URL()?>upload/download/icon/<?php echo $data->tipe?>.png" alt="<?php echo $data->nama?>">
                  <div class="caption">
                    <h3><?php echo $data->nama?></h3>
                    <p><?php echo $data->ket."   <b>(".$data->ukuran." KB)</b>"?></p>
                    <p><a href="<?php echo base_URL()?>upload/download/<?php echo $data->file?>" class="btn btn-primary" target="_blank">Download</a></p>
                  </div>
                </div>
              </li>
			  <?php
			  }
			  ?>
              
            </ul>
          </div>
 </div><!--/span-->
