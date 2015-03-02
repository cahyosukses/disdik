<legend>Data dan Informasi Pendidikan</legend>
	
	<button class="btn btn-primary" type="button" onclick="window.open('<?php echo base_URL(); ?>manage/data_informasi/add/', '_self')">Data Baru</button>
	
	<br><br>
			
				<?php echo $this->session->flashdata("k");?>
				

				<table width="100%"  class="table table-condensed">
					<tr>
						<th width="5%">No</th>
						<th width="30%">Judul</th>
						<th width="40%">Isi</th>
						<th width="25%">Control</th>
					</tr>
					
					<?php $i = 0 ?>
					<?php foreach ($data as $b):
					$i++;
					?>
					<tr>
						<td style="text-align: center"><?php echo $i; ?></td>
						<td><?php echo $b->judul?></td>
						<td><?php echo strip_tags($b->isi)?></td>
						<td style="text-align: center">
						<a href="<?php echo base_URL(); ?>manage/data_informasi/edit/<?php echo $b->id?>"><span class="icon-pencil">&nbsp;&nbsp;</span></a>  
						<a href="<?php echo base_URL(); ?>manage/data_informasi/del/<?php echo $b->id?>" onclick="return confirm('Anda YAKIN menghapus data \n <?php echo $b->judul?>..?');"><span class="icon-remove">&nbsp;&nbsp;</span></a>
						</td>
					</tr>	
					<?php endforeach ?>
				</table>
