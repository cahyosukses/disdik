
	<legend>Daftar Kontak Masuk</legend>
	
	<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/bukutamu/add/', '_self')">Entri Baru</button>
	
	<br><br>
				
				<?php echo $this->session->flashdata("k");?>
				

				<table width="100%"  class="table table-condensed">
					<tr>
						<th width="5%">No</th>
						<th style="text-align: left" width="25%">Nama</th>
						<th style="text-align: left" width="15%">Email</th>
						<th style="text-align: left" width="35%">Pesan</th>
						<th width="20%">Control</th>
					</tr>
					
					<?php $i = 0 ?>
					<?php foreach ($pesan as $data):
					$i++;
					?>
					<tr>
						<td style="text-align: center"><?php echo $i; ?></td>
						<td style="text-align: left"><?php echo $data->nama ?></td>
						<td style="text-align: left"><?php echo $data->email?></td>
						<td style="text-align: left"><?php echo $data->pesan?></td>
						
						<td style="text-align: center">
						<a href="<?php echo base_URL(); ?>manage/bukutamu/edit/<?php echo $data->id ?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
						<a href="<?php echo base_URL(); ?>manage/bukutamu/del/<?php echo $data->id?>" onclick="return confirm('Anda YAKIN menghapus data \n <?php echo $data->nama?>..?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
						</td>
					</tr>	
					<?php endforeach ?>
				</table>
