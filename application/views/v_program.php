		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
			<li>Program <span class="divider">/</span></li>
			<li><?php echo $program->judul?></li>
			
		</ul>
		
		 <div class="span12 wellwhite" style="margin-left: 0px">
		  <legend><?php echo $program->judul?></legend>  
		  
		  	<?php echo $program->isi?>

		 
		  <div id="directions-panel"></div>
		</div>