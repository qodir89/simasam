<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	$no_sk		= $datpil->no_sk;
	$tahun		= $datpil->tahun;
	$perihal	= $datpil->perihal;
	$tgl_catat	= $datpil->tgl_catat;
	$tgl_surat	= $datpil->tgl_surat;
	$keterangan	= $datpil->keterangan;
	
} else {
	$act		= "act_add";
	$idp		= "";
	$no_sk		= "";
	$tahun		= "";
	$perihal	= "";
	$tgl_surat	= "";
	$keterangan	= "";
}
?>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Surat Keputusan</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	
	<form action="<?php echo base_URL()?>index.php/admin/surat_keputusan/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-6">
		<table width="100%" class="table-form">
		<tr><td width="20%">No. SK</td><td><b><input type="text" autofocus tabindex="1" name="no_sk" required value="<?php echo $no_sk; ?>" style="width: 400px" class="form-control"></b></td></tr>
		<tr><td width="20%">Tahun Terbit</td><td><b><input type="text" tabindex="2" name="tahun" required value="<?php echo $tahun; ?>" style="width: 80px" class="form-control"></b></td></tr>		
		<tr><td width="20%">Perihal</td><td><b><textarea tabindex="4" name="perihal" required style="width: 400px; height: 60px" class="form-control"><?php echo $perihal; ?></textarea></b></td></tr>	
		<tr><td colspan="2">
		<br><button type="submit" class="btn btn-primary" tabindex="9" ><i class="icon icon-ok icon-white"></i> Simpan</button>
		<a href="<?php echo base_URL()?>index.php/admin/surat_keputusan" tabindex="10" class="btn btn-success"><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</td></tr>
		</table>
	</div>
	
	<div class="col-lg-6">	
		<table width="100%" class="table-form">
			<tr><td width="20%">Tanggal Surat</td><td><b><input type="text" tabindex="6" name="tgl_surat" required value="<?php echo $tgl_surat; ?>" id="tgl_surat" style="width: 200px" class="form-control"></b></td></tr>	
			<tr><td width="20%">File Surat (Scan)</td><td><b><input type="file" tabindex="7" name="file_surat" class="form-control" style="width: auto"></b></td></tr>
			<tr><td width="20%">Keterangan</td><td><b><input type="text" name="keterangan" tabindex="8" value="<?php echo $keterangan; ?>" style="width: 400px" class="form-control"></b></td></tr>				
		</table>
	</div>
	
	</div>
	
	</form>
