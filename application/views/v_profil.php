
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
			<li>Profil <span class="divider">/</span></li>
			<li><?php echo $profil->judul?></li>
			
		</ul>
		
		 <div class="span12 wellwhite" style="margin-left: 0px">
		  <legend><?php echo $profil->judul?></legend>
		  
		  <p>
		  	<?php echo $profil->isi?>

		  </p>
		  <div id="directions-panel"></div>	
		  
		  <?php if(isset($show_map)){ ?>
		  <div id="googleMap" style="width:496px;height:400px;"></div>	
		  <?php } ?>
		</div>
