<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $surat_keluar ?></h3>
                  <p>Surat Keluar</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/admin/surat_keluar" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $surat_masuk; ?></h3>
                  <p>Surat Masuk</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/admin/surat_masuk" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $surat_keputusan; ?></h3>
                  <p>Surat Keputusan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/admin/surat_keputusan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $surat_tugas; ?></h3>
                  <p>Surat Tugas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/admin/tugas" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<div class="span12 well well-sm">
	<div class="alert alert-dismiss alert-info">
			Selamat datang <strong><?php echo $this->session->userdata('admin_nama'); ?></strong> 
		</div>
	<div class="container">
	  <div class="row">
	   	<div class="col-md-12 col-md-offset-0">
			<blockquote>
				<p> Terima kasih kepada seluruh pegawai yang telah berpartisipasi dalam mengisi aplikasi ini, kami harapkan tidak adalagi dokumen yang hilang karena semua telah terarsip dengan baik di aplikasi ini.</p>
				<footer>___Admin</footer>
			</blockquote>
		</div>
	 </div>
   </div>
</div>
