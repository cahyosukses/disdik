
		<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
			<li>Data Siswa </li>
			
		</ul>
		
		 <div class="span12 wellwhite" style="margin-left: 0px">
		  <legend>Data Siswa</legend>
			
			Lihat Per Kelas :
			<?php 
			for($a = 1; $a < 7; $a++) {
				echo "<a href='".base_URL()."tampil/data_siswa/per_kelas/$a'>$a</a> &nbsp;";
			}
			?>
			<a href="<?php echo base_URL()?>tampil/data_siswa/per_kelas/L">Lulus</a>
			<br>
			<br>
			
			<table width="100%"  class="table table-condensed">
					<tr>
						<th width="5%">No</th>
						<th width="25%">Nama</th>
						<th width="10%">NIS</th>
						<th width="10%">Kelas</th>
						<th width="10%">JK</th>
						<th width="30%">Alamat</th>
					</tr>
					
					<?php 
					$i = 0;
					if (empty($data)) {
						echo "<tr><td colspan='6' align='center'>Data tidak ditemukan</td></tr>";
					} else {
					foreach ($data as $b) {
					$i++;
					?>
					<tr>
						<td style="text-align: center"><?php echo $i; ?></td>
						<td><?php echo $b->nama?></td>
						<td style="text-align: center"><?php echo $b->nis?></td>
						<td style="text-align: center"><?php echo $b->kelas?></td>
						<td style="text-align: center"><?php echo $b->jk?></td>
						<td><?php echo $b->alamat?></td>
					</tr>	
					<?php 
						} 
					}
					?>
				</table>
		 
		</div>
<!--/span-->