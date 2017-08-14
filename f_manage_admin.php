<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	$username	= $datpil->username;
	$password	= $datpil->password;
	$nama		= $datpil->nama;
	$nip		= $datpil->nip;
	$id_bidang	= $datpil->id_bidang;
	$level		= $datpil->level;
	
} else {
	$act		= "act_add";
	$idp		= "";
	$username	= "";
	$password	= "";
	$nama		= "";
	$nip		= "";
	$id_bidang	= "";
	$level		= "";
}
?>
<div class="navbar navbar-inverse">
	<div class="container" style="z-index: 0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Manage Admin</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	
	<form action="<?php echo base_URL(); ?>index.php/admin/manage_admin/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-6">
		<table width="100%" class="table-form">
		<tr><td width="20%">Username</td><td><b><input type="text" name="username" required value="<?php echo $username; ?>" style="width: 300px" class="form-control" tabindex="1" autofocus></b></td></tr>
		<tr><td width="20%">Password</td><td><b><input type="password" name="password" required value="<?php echo $password; ?>" id="dari" style="width: 300px" class="form-control" tabindex="2" ></b></td></tr>		
		<tr><td width="20%">Ulangi Password</td><td><b><input type="password" name="password2" required value="<?php echo $password; ?>" id="dari" style="width: 300px" class="form-control" tabindex="3	" ></b></td></tr>
		<tr><td colspan="2">
		<br><button type="submit" class="btn btn-primary" tabindex="8" ><i class="icon icon-ok icon-white"></i> Simpan</button>
		<a href="<?php echo base_URL(); ?>index.php/admin/manage_admin" class="btn btn-success" tabindex="9" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</td></tr>
		</table>
	</div>
	
	<div class="col-lg-6">	
		<table width="100%" class="table-form">
		<tr><td width="20%">Nama</td><td><b><input type="text" name="nama" required value="<?php echo $nama; ?>" style="width: 300px" class="form-control" tabindex="4" ></b></td></tr>
		<tr><td width="20%">N I P</td><td><b><input type="text" name="nip" required value="<?php echo $nip; ?>" style="width: 300px" class="form-control" tabindex="5" ></b></td></tr>
		<tr><td width="20%">Bagian</td><td><b>
			<select name="id_bidang" class="form-control" tabindex="6" style="width: auto" required><option value=""> - pilih - </option>
			<?php 
			$q_bagian	= $this->db->query("SELECT * FROM t_kode_bagian ORDER BY id ASC")->result();
			if (!empty($q_bagian)) {
				foreach($q_bagian as $qb) {
					if ($id_bidang == $qb->id) {
						echo "<option value='".$qb->id."' selected>(".$qb->id.") ".$qb->kd_bagian." ".$qb->nama."</option>";
					} else {
						echo "<option value='".$qb->id."'>(".$qb->id.") ".$qb->kd_bagian." ".$qb->nama."</option>";
												
					}
				}
			}
			?>
			</select>

		<tr><td width="20%">Level</td><td><b>
			<select name="level" class="form-control" style="width: 200px" required tabindex="7" ><option value=""> - Level - </option>
			<?php 
			$q_level	= $this->db->query("SELECT * FROM t_level ORDER BY id ASC")->result();
			if (!empty($q_level)) {
				foreach($q_level as $qb) {
					if ($level == $qb->id) {
						echo "<option value='".$qb->id."' selected>(".$qb->id.") ".$qb->level."</option>";
					} else {
						echo "<option value='".$qb->id."'>(".$qb->id.") ".$qb->level."</option>";
												
					}
				}
			}
			?>
			</select>
			</b></td></tr>

		</table>
	</div>
	
	</div>
	
	</form>
