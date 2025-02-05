

<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	$no_agenda	= $datpil->no_agenda;
	#$indek_berkas= $datpil->indek_berkas;
	#$kode		= $datpil->kode;
	$dari		= $datpil->dari;
	$no_surat	= $datpil->no_surat;
	$tgl_surat	= $datpil->tgl_surat;
	$tgl_diterima = $datpil->tgl_diterima;
	$perihal	= $datpil->perihal;
	$ket		= $datpil->keterangan;
	$file		= $datpil->file;
} else {
	$act		= "act_add";
	$idp		= "";
	$no_agenda	= gli("t_surat_masuk", "no_agenda", 4);
	#$indek_berkas	="";
	#$kode		= "";
	$dari		= "";
	$no_surat	= "";
	$tgl_surat	= "";
	$tgl_diterima = "";
	$perihal	= "";
	$ket		= "";
}
?>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Surat Masuk</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
<?php echo $this->session->flashdata("k");?>
	
	<form action="<?php echo base_URL(); ?>index.php/admin/surat_masuk/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	
	<div class="row-fluid well" style="overflow: hidden">
		
	<div class="col-lg-6">
		<table  class="table-form">
		<tr><td width="20%">No. Agenda</td><td><b><input type="text" name="no_agenda" autofocus tabindex="1" required value="<?php echo $no_agenda; ?>" style="width: 100px" class="form-control"></b><i>"cth. 0001 (4 digit)"</i></td></tr>
		<tr><td width="20%">Asal Surat</td><td><b><input type="text" name="dari" tabindex="2" required value="<?php echo $dari; ?>" id="dari" style="width: 400px" class="form-control"></b></td></tr>	
			
		<tr><td width="20%">Nomor Surat</td><td><b><input type="text" name="no_surat" tabindex="3" required value="<?php echo $no_surat; ?>" style="width: 300px" class="form-control"></td></tr>	
		<tr><td width="20%">Perihal</td><td><b><textarea name="perihal" tabindex="4" required style="width: 400px; height: 90px" class="form-control"><?php echo $perihal; ?></textarea></b></td></tr>	
		<tr><td colspan="2">
		<br><button type="submit" class="btn btn-primary" tabindex="9" ><i class="icon icon-ok icon-white"></i> Simpan</button>
		<a href="<?php echo base_URL(); ?>index.php/admin/surat_masuk" class="btn btn-success" tabindex="10" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</td></tr>
		</table>
	</div>
	
	<div class="col-lg-6">	
		<table  class="table-form">
		<tr><td width="20%">Tanggal Terima</td><td><b><input type="text" name="tgl_diterima" tabindex="5" required value="<?php echo $tgl_diterima; ?>" id="tgl_diterima" style="width: 150px" class="form-control"></b></td></tr>
		<tr><td width="20%">Tanggal Surat</td><td><b><input type="text" name="tgl_surat" tabindex="6" required value="<?php echo $tgl_surat; ?>" id="tgl_surat" style="width: 150px" class="form-control"></b></td></tr>	
		<tr><td width="20%">File Surat (Scan)</td><td><b><input type="file" name="file" tabindex="7" class="form-control" style="width: 400px"></b><i><small style="color: red" class="text">*Ukuran maksimal file Upload sebesar 2 Mb</small></i></td></tr>
		<tr><td width="20%">Keterangan</td><td><b><textarea name="keterangan" tabindex="8" style="width: 400px; height: 90px" class="form-control"><?php echo $ket; ?></textarea></b></td></tr>
		</table>	
	</div>

	</div>
	
	</form>
