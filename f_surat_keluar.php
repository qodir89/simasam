<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	$no_agenda	= $datpil->no_agenda;
	$kode		= $datpil->kode;
	$dari		= $datpil->dari;
	$tujuan 	= $datpil->tujuan;
	$no_surat	= $datpil->no_surat;
	$tgl_surat	= $datpil->tgl_surat;
	$isi_surat	= $datpil->isi_surat;
	$ket		= $datpil->keterangan;
	
} else {
	$act		= "act_add";
	$idp		= "";
	$no_agenda	= gli("t_surat_keluar", "no_agenda", 4);
	$kode		= "";
	$dari		= "";
	$tujuan 	= "";
	$no_surat	= "";
	$tgl_surat	= "";
	$isi_surat		= "";
	$ket		= "";
}
?>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Surat Keluar</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	
	<form action="<?php echo base_URL()?>index.php/admin/surat_keluar/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-6">
		<table width="100%" class="table-form">
		<tr><td width="20%">No. Agenda</td><td><b><input type="text" autofocus tabindex="1" name="no_agenda" required value="<?php echo $no_agenda; ?>" style="width: 100px" class="form-control"></b></td></tr>
		<tr><td width="20%">Nomor Surat</td><td><b><input type="text" tabindex="2" name="no_surat" required value="<?php echo $no_surat; ?>" style="width: 300px" class="form-control"></td></tr>
		<tr><td width="20%">Asal Surat</td><td><b>
			<select name="dari" class="form-control" tabindex="3" style="width: auto" required><option value=""> - Asal Surat - </option>
			<?php 
			$q_bagian	= $this->db->query("SELECT * FROM t_kode_bagian ORDER BY id ASC")->result();
			if (!empty($q_bagian)) {
				foreach($q_bagian as $qb) {
					if ($dari == $qb->id) {
						echo "<option value='".$qb->id."' selected>(".$qb->id.") ".$qb->kd_bagian." ".$qb->nama."</option>";
					} else {
						echo "<option value='".$qb->id."'>(".$qb->id.") ".$qb->kd_bagian." ".$qb->nama."</option>";
												
					}
				}
			}
			?>
			</select>
		<tr><td width="20%">Tujuan Surat</td><td><b><input type="text" tabindex="4" name="tujuan" required value="<?php echo $tujuan; ?>" id="tujuan" style="width: 400px" class="form-control"></b></td></tr>	
		<tr><td width="20%">Perihal</td><td><b><textarea tabindex="5" name="isi_surat" required style="width: 400px; height: 60px" class="form-control"><?php echo $isi_surat; ?></textarea></b></td></tr>	
		<tr><td colspan="2">
		<br><button type="submit" class="btn btn-primary" tabindex="10" ><i class="icon icon-ok icon-white"></i> Simpan</button>
		<a href="<?php echo base_URL()?>index.php/admin/surat_keluar" tabindex="11" class="btn btn-success"><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</td></tr>
		</table>
	</div>
	
	<div class="col-lg-6">	
		<table width="100%" class="table-form">
			<tr><td width="20%">Kode Klasifikasi</td><td><b><input type="text" tabindex="6" name="kode" required value="<?php echo $kode; ?>" id="kode_surat" style="width: 100px" class="form-control"></b><i><small style="color: red" class="text">*lihat tab referensi</small></i></td></tr>
			<tr><td width="20%">Tanggal Surat</td><td><b><input type="text" tabindex="7" name="tgl_surat" required value="<?php echo $tgl_surat; ?>" id="tgl_surat" style="width: 100px" class="form-control"></b></td></tr>	
			<tr><td width="20%">File Surat (Scan)</td><td><b><input type="file" tabindex="8" name="file_surat" class="form-control" style="width: 200px"></b><i><small style="color: red" class="text">*Ukuran maksimal file yang diizinkan sebesar 2 MB.</small></i></td></tr>
			<tr><td width="20%">Keterangan</td><td><b><input type="text" name="ket" tabindex="9" value="<?php echo $ket; ?>" style="width: 400px;height: 60px" class="form-control"></b></td></tr>				
		</table>
	</div>
	
	</div>
	
	</form>
