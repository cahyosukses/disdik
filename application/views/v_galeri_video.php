
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
			<li>Galeri Video</li>
		</ul>
		
		<div class="span12 wellwhite" style="margin-left: 0px">
		<legend style="margin-bottom: 10px">Album Galeri Video</legend>
			<div class="row-fluid">
            <ul class="thumbnails">
              <?php
			  foreach ($data as $d) {
			  ?>
			  <li class="span4" style="margin-left: 0px; margin-right: 8px">
				<div class="thumbnail" style="height: 230px">					
				 	<a class="various fancybox.iframe" href="http://www.youtube.com/embed/<?php echo $d->video_id;?>?autoplay=1" title="<?php echo strtoupper($d->judul)?>">
	                    <img class="image-polaroid" src="<?php echo base_URL()."timthumb?src=http://img.youtube.com/vi/". $d->video_id ."/0.jpg";?>&w=204&h=170&zc=0" class="span12" style="width:204px;height: 170px">
	             	</a>
	             	 <div class="caption">
	             	 	<h6 style="text-align: center; margin-top: 0">Album <?php echo $d->judul?><br>
	             	 </div>				
                </div>				
              </li>
			  
		<?php }  ?>
              
            </ul>
          </div>
		</div>
<!--/span-->