<html>
	<head>
		<title></title>
	</head>
	<body>
	<h2>Topik : <?php echo strtoupper($isi->topik)?></h2>
	<h3>Nama Pengadu : <?php echo $isi->nama_pengadu?></h3>
	<h3>Judul Program : <?php echo $isi->judul_program . ' - ' . $isi->stasiun_program?></h3>
	<p>
		<h4>
			<?php echo $isi->pesan?>
		</h4>
	</p>
	<!--
		<table class="table table-hover table-condensed" height="185" style="font-size: 80%;" width="711">
			<tbody id="tabel-aduan">
				<tr>
					<td style="width:20%">Topik Aduan</td>
					<td><?php echo $isi->topik?></td>
				</tr>
				<tr>
					<td>Nama Pengadu</td>
					<td><?php echo $isi->nama_pengadu?></td>
				</tr>
				<tr>
					<td>Judul Program</td>
					<td><?php echo $isi->judul_program?></td>
				</tr>
				<tr>
					<td>Stasiun Program</td>
					<td><?php echo $isi->stasiun_program?></td>
				</tr>
				<tr>
					<td>Pesan Aduan</td>
					<td><?php echo $isi->pesan?></td>
				</tr>
			</tbody>
		</table>	
		-->	
	</body>
</html>
