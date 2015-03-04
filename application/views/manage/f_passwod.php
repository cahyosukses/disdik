<form action="<?php echo base_URL()?>manage/passwod/simpan" method="post" name="f_passwod">
	
	<!--<input type="hidden" value="<?php echo $user->u?>" name="u1" id="u1">
	<input type="hidden" value="<?php echo $user->p?>" name="p1" id="p1">
	-->
	
	<legend>Form Edit User</legend>
	
	<?php echo $this->session->flashdata("k");?>

	<label style="width: 150px; float: left">Username</label><input class="span4" type="text" value="<?php echo $user->u;?>" required readonly><br>
	<!--<label style="width: 150px; float: left">Username baru</label><input class="span4" type="text" name="u3" placeholder="Isikan username baru" value="" required><br>-->
	<label style="width: 150px; float: left">Nama Lengkap</label><input class="span4" type="text" name="nama" placeholder="" value="<?php echo $user->nama;?>" required><br>
	<label style="width: 150px; float: left">Nama Lengkap</label><input class="span4" type="text" name="email" placeholder="" value="<?php echo $user->email;?>"><br>

	<label style="width: 150px; float: left">Password lama</label><input class="span4" type="text" name="p_lama" placeholder="Kosongkan jika tidak ingin merubah" value=""><br>
	<label style="width: 150px; float: left">Password baru</label><input class="span4" type="text" name="p_baru" placeholder="" value=""><br>
	<label style="width: 150px; float: left">Ulangi Password</label><input class="span4" type="text" name="p_ulangi" placeholder="" value=""><br>

	
	<label style="width: 150px; float: left"></label><button type="submit" class="btn btn-primary">Submit</button>

</form>

<script type="text/javascript">
/*
function cek_kesamaan() {
	var f = document.f_passwod;
	var u_lama1 = document.getElementById('u1').value;
	var p_lama1 = document.getElementById('p1').value;
	
	if (f.u2.value != u_lama1) {
		alert("Username lama tidak sesuai/ tidak sama");
		f.u2.focus();
		return false;
	} else if (f.p2.value != p_lama1) {
		alert("Passwod lama tidak sesuai/ tidak sama");
		f.p2.focus();
		return false;
	} else {
		return true;
	}	
}
*/
</script>
