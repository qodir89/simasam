<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	$kd_bagian		= $datpil->kd_bagian;
	$nama		= $datpil->nama;	
	$ket	= $datpil->ket;	
} else {
	$act		= "act_add";
	$idp		= "";
	$kd_bagian		= "";
	$nama		= "";
	$ket	= "";
}
?>
<div class="navbar navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Manage Bagian
</a>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->

<?php echo $this->session->flashdata("k_passwod");?>

<div class="well">

<form action="<?php echo base_URL(); ?>index.php/admin/manage_bagian/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	<table width="100%" class="table-form">
	<tr><td width="10%">kode</td><td><b><input type="text" name="kd_bagian" required value="<?php echo $kd_bagian; ?>" style="width: 100px" class="form-control" autofocus></b></td></tr>
	<tr><td width="20%">Nama</td><td><b><input type="text" name="nama" required value="<?php echo $nama; ?>" style="width: 700px" class="form-control" autofocus></b></td></tr>		
	<tr><td width="20%">Keterangan Kode</td><td><b><textarea name="ket" required style="width: 700px; height: 100px" class="form-control"><?php echo $ket; ?></textarea></b></td></tr>		
	<tr><td colspan="2">
	<br><button type="submit" class="btn btn-primary"><i class="icon icon-ok icon-white"></i> Simpan</button>
	<a href="<?php echo base_URL(); ?>index.php/admin/manage_bagian" class="btn btn-success"><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
	</td></tr>
	</table>
</form>
</div>
