<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	$no_agenda	= $datpil->no_agenda;
	$kode		= $datpil->kode;
	$isi_ringkas= $datpil->isi_ringkas;
	$atas_nama	= $datpil->atas_nama;
	$tgl_surat	= $datpil->tgl_surat;
		
} else {
	$act		= "act_add";
	$idp		= "";
	$no_agenda	= "";
	$kode		= "800";
	$isi_ringkas= "";
	$atas_nama	= "";
	$tgl_surat	= "";
}
?>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Surat Tugas</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	
	<form action="<?php echo base_URL()?>index.php/admin/tugas/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-6">
		<table width="100%" class="table-form">
		<tr><td width="20%">No. Agenda</td><td><b><input type="text" autofocus tabindex="1" name="no_agenda" required value="<?php echo $no_agenda; ?>" style="width: 100px" class="form-control"></b></td></tr>
		<tr><td width="20%">Kode Surat</td><td><b><input type="text" tabindex="2" name="kode" required readonly value="<?php echo $kode; ?>" style="width: 80px" class="form-control"></b></td></tr>		
		<tr><td width="20%">Isi Ringkasan</td><td><b><textarea tabindex="4" name="isi_ringkas" required style="width: 400px; height: 60px" class="form-control"><?php echo $isi_ringkas; ?></textarea></b></td></tr>	
		<tr><td colspan="2">
		<br><button type="submit" class="btn btn-primary" tabindex="9" ><i class="icon icon-ok icon-white"></i> Simpan</button>
		<a href="<?php echo base_URL()?>index.php/admin/tugas" tabindex="10" class="btn btn-success"><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</td></tr>
		</table>
	</div>
	
	<div class="col-lg-6">	
		<table width="100%" class="table-form">
			<tr><td width="10%">Tanggal Surat</td><td><b><input type="text" tabindex="6" name="tgl_surat" required value="<?php echo $tgl_surat; ?>" id="tgl_surat" style="width: 200px" class="form-control"></b></td></tr>
			<tr><td width="20%">Atas Nama</td><td><b><textarea tabindex="4" name="atas_nama" required style="width: 400px; height: 60px" class="form-control"><?php echo $atas_nama; ?></textarea></b></td></tr>
			<tr><td width="20%">File Surat (Scan)</td><td><b><input type="file" tabindex="7" name="file_surat" class="form-control" style="width: auto"></b></td></tr>
			</table>
	</div>
	
	</div>
	
	</form>
