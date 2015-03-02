<?php
$mode	= $this->uri->segment(3);

if ($mode == "edit" || $mode == "act_edit") {
	$act         = "act_edit";
	$idp         = $datpil->id ;
	$judul       = $mode === 'edit' ? $datpil->title : set_value('title');
	$tgl_mulai   = $mode === 'edit' ? $datpil->tgl_mulai : set_value('tgl_mulai');
	$tgl_selesai = $mode === 'edit' ? $datpil->tgl_selesai : set_value('tgl_selesai');
	$lokasi      = $mode === 'edit' ? $datpil->lokasi : set_value('lokasi');
	$jam         = $mode === 'edit' ? $datpil->jam : set_value('jam');
	$content	 = $mode === 'edit' ? $datpil->content : set_value('content');
} else {
	$act		= "act_add";
	$idp		= '';
	$judul       = $mode === 'add' ? '' : set_value('title');
	$tgl_mulai   = $mode === 'add' ? '' : set_value('tgl_mulai');
	$tgl_selesai = $mode === 'add' ? '' : set_value('tgl_selesai');
	$lokasi      = $mode === 'add' ? '' : set_value('lokasi');
	$jam         = $mode === 'add' ? '' : set_value('jam');
	$content	 = $mode === 'add' ? '' : set_value('content');
}
?>
<form action="<?php echo base_URL()?>manage/agenda/<?php echo $act?>" method="post">
<input type="hidden" name="idp" value="<?php echo $idp?>">
	<fieldset>
	<legend><?php echo $title;?></legend>
	
	<br>
	<label style="width: 200px; float: left">Judul</label><input class="input-xxlarge" type="text" name="title" placeholder="Isikan Keterangan" value="<?php echo $judul?>" required><br>
	<label style="width: 200px; float: left">Tgl Mulai</label><input class="input-large" type="text" name="tgl_mulai" placeholder="Format 'YYYY-MM-DD'" value="<?php echo $tgl_mulai?>" required><br>	
	<label style="width: 200px; float: left">Tgl Selesai</label><input class="input-large" type="text" name="tgl_selesai" placeholder="Format 'YYYY-MM-DD'" value="<?php echo $tgl_selesai?>" required><br>		
	<label style="width: 200px; float: left">Tempat</label><input class="input-xxlarge" type="text" name="lokasi" placeholder="Isikan Tempat Agenda" value="<?php echo $lokasi?>" required><br>
	<label style="width: 200px; float: left">Jam Mulai</label><input class="input-large" type="text" name="jam" placeholder="Isikan Jam Mulai Acara" value="<?php echo $jam?>" required><br>
	<label style="width: 200px; float: left">Keterangan</label><textarea name="content"><?php echo $content?></textarea><br>
	<label style="width: 200px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>