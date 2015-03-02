<div class="span9">
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
			<li>Data Guru </li>
			
		</ul>
		
		 <div class="span12 wellwhite" style="margin-left: 0px">
		  <legend>Data Guru</legend>
						
			<table width="100%"  class="table table-condensed">
					<tr>
						<th width="5%">No</th>
						<th width="25%">Nama</th>
						<th width="10%">Mapel/Kls</th>
						<th width="10%">JK</th>
						<th width="40%">Alamat</th>
					</tr>
					
					<?php 
					$i = 0;
					if (empty($data)) {
						echo "<tr><td colspan='5' align='center'>Data tidak ditemukan</td></tr>";
					} else {
					foreach ($data as $b) {
					$i++;
					?>
					<tr>
						<td style="text-align: center"><?php echo $i; ?></td>
						<td><?php echo $b->nama?></td>
						<td style="text-align: center"><?php echo $b->mapel?></td>
						<td style="text-align: center"><?php echo $b->jk?></td>
						<td><?php echo $b->alamat?></td>
					</tr>	
					<?php 
						} 
					}
					?>
				</table>
		 
		</div>
</div><!--/span-->