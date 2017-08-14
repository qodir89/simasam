<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "" && $this->session->userdata('admin_level') == "") {
			redirect("index.php/admin/login");
		} 
		$a['surat_masuk']	= $this->web_model->view_where('t_surat_masuk',array('pengolah'=>$this->session->userdata('admin_id')))->num_rows();
		$a['surat_keluar']	= $this->web_model->view_where('t_surat_keluar',array('pengolah'=>$this->session->userdata('admin_id')))->num_rows();
		$a['surat_keputusan']	= $this->web_model->view_where('t_sk',array('pengolah'=>$this->session->userdata('admin_id')))->num_rows();
		$a['surat_tugas']	= $this->web_model->view_where('t_st',array('pengolah'=>$this->session->userdata('admin_id')))->num_rows();
		$a['page']	= "d_amain";
		
		$this->load->view('admin/aaa', $a);
		
	}

	public function klas_surat() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "" && $this->session->userdata('admin_level') == "") {
			redirect("index.php/admin/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM ref_klasifikasi")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."index.php/admin/klas_surat/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$kode					= addslashes($this->input->post('kode'));
		$nama					= addslashes($this->input->post('nama'));
		$uraian					= addslashes($this->input->post('uraian'));
	
		$cari					= addslashes($this->input->post('q'));

		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM ref_klasifikasi WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil dihapus</div>");
			redirect('index.php/admin/klas_surat');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM ref_klasifikasi WHERE nama LIKE '%$cari%' OR uraian LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_klas_surat";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_klas_surat";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM ref_klasifikasi WHERE id = '$idu'")->row();	
			$a['page']		= "f_klas_surat";
		} else if ($mau_ke == "act_edt") {
			$this->db->query("UPDATE ref_klasifikasi SET kode = '$kode', nama = '$nama', uraian = '$uraian' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diperbaharui</div>");			
			redirect('index.php/admin/klas_surat');
		} else if ($mau_ke == "act_add") {
			$this->db->query("INSERT INTO ref_klasifikasi VALUES (NULL, '$kode', '$nama', '$uraian')");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diperbaharui</div>");			
			redirect('index.php/admin/klas_surat');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM ref_klasifikasi LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_klas_surat";
		}
		
		$this->load->view('admin/aaa', $a);
	}
	
	public function surat_masuk() {
	if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "" && $this->session->userdata('admin_level') == "") {
			redirect("index.php/admin/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM t_surat_masuk")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."index.php/admin/surat_masuk/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$no_agenda				= addslashes($this->input->post('no_agenda'));
		#$indek_berkas			= addslashes($this->input->post('indek_berkas'));
		#$kode					= addslashes($this->input->post('kode'));
		$dari					= addslashes($this->input->post('dari'));
		$no_surat				= addslashes($this->input->post('no_surat'));
		$tgl_surat				= addslashes($this->input->post('tgl_surat'));
		$tgl_diterima			= addslashes($this->input->post('tgl_diterima'));
		$perihal				= addslashes($this->input->post('perihal'));
		$ket					= addslashes($this->input->post('keterangan'));
		
		$cari					= addslashes($this->input->post('q'));

		//upload config 
		$config['upload_path'] 		= './upload/surat_masuk';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx|xls|xlsx';
		$config['max_size']			= '3000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		
		
		if ($mau_ke == "del") {
				##scrip hapus file dan data
				$query = $this->db->query("SELECT * FROM t_surat_masuk WHERE id = '$idu'");
				foreach ($query->result() as $row) {
					unlink('./upload/surat_masuk/'.$row->file);
				}
				$this->db->query("DELETE FROM t_disposisi WHERE id_surat = '$idu'");
				$this->db->query("DELETE FROM t_surat_masuk WHERE id = '$idu'");
				$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil di hapus </div>");
				redirect('index.php/admin/surat_masuk');
			
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM t_surat_masuk WHERE perihal LIKE '%$cari%' OR dari LIKE '%$cari%' OR no_surat LIKE '%$cari%' OR tgl_diterima LIKE '%$cari%' OR tgl_surat LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_surat_masuk";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_surat_masuk";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM t_surat_masuk WHERE id = '$idu'")->row();	
			$a['page']		= "f_surat_masuk";
		} else if ($mau_ke == "act_add") {	
			if ($this->upload->do_upload('file')) {
				$up_data	 	= $this->upload->data();
				$this->db->query("INSERT INTO t_surat_masuk VALUES (NULL, '$no_agenda', '$perihal', '$dari', '$no_surat', '$tgl_surat', '$tgl_diterima', '$ket', '".$up_data['file_name']."', '".$this->session->userdata('admin_id')."','".$this->session->userdata('admin_level')."')");
			} else {
				$this->db->query("INSERT INTO t_surat_masuk VALUES (NULL, '$no_agenda', '$perihal', '$dari', '$no_surat', '$tgl_surat', '$tgl_diterima', '$ket', '', '".$this->session->userdata('admin_id')."', '".$this->session->userdata('admin_level')."')");
			}	
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Ditambahkan. ".$this->upload->display_errors()."</div>");
			redirect('index.php/admin/surat_masuk');
		} else if ($mau_ke == "act_edt") {
			if ($this->upload->do_upload('file')) {
				$query = $this->db->query("SELECT * FROM t_surat_masuk WHERE id = '$idp'");
				foreach ($query->result() as $row) {
					unlink('./upload/surat_masuk/'.$row->file);
				}
				$up_data = $this->upload->data();
				$this->db->query("UPDATE t_surat_masuk SET no_agenda = '$no_agenda', perihal = '$perihal', dari = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat',tgl_diterima = '$tgl_diterima', keterangan = '$ket', file = '".$up_data['file_name']."' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE t_surat_masuk SET no_agenda = '$no_agenda', perihal = '$perihal', dari = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', tgl_diterima = '$tgl_diterima', keterangan = '$ket' WHERE id = '$idp'");
			}	
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diperbaharui. ".$this->upload->display_errors()."</div>");			
			redirect('index.php/admin/surat_masuk');
		} else if ($this->session->userdata('admin_level')== 1) {
            $a['data'] = $this->db->query("SELECT * FROM t_surat_masuk order by id desc LIMIT $awal, $akhir ")->result();
            $a['page']		= "l_surat_masuk";
        }else{
           $a['data']	= $this->web_model->view_where('t_surat_masuk',array('pengolah'=>$this->session->userdata('admin_id')))->result();
			$a['page']		= "l_surat_masuk";
		}
		
		$this->load->view('admin/aaa', $a);
	}

	public function surat_keluar() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "" && $this->session->userdata('admin_level') == "") {
			redirect("index.php/admin/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM t_surat_keluar")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."index.php/admin/surat_keluar/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$no_agenda				= addslashes($this->input->post('no_agenda'));
		$kode					= addslashes($this->input->post('kode'));
		$dari					= addslashes($this->input->post('dari'));
		$no_surat				= addslashes($this->input->post('no_surat'));
		$tgl_surat				= addslashes($this->input->post('tgl_surat'));
		$isi_surat				= addslashes($this->input->post('isi_surat'));
		$tujuan					= addslashes($this->input->post('tujuan'));
		$ket					= addslashes($this->input->post('ket'));
		
		$cari					= addslashes($this->input->post('q'));

		//upload config 
		$config['upload_path'] 		= './upload/surat_keluar';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']			= '2000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		
		
		if ($mau_ke == "del") {
			##scrip hapus file dan data
				$query = $this->db->query("SELECT * FROM t_surat_keluar WHERE id = '$idu'");
				foreach ($query->result() as $row) {
					unlink('./upload/surat_keluar/'.$row->file);
				}
			$this->db->query("DELETE FROM t_surat_keluar WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil di hapus </div>");
			redirect('index.php/admin/surat_keluar');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM t_surat_keluar WHERE isi_surat LIKE '%$cari%' OR indek_berkas LIKE '%$cari%' OR dari LIKE '%$cari%' OR no_surat LIKE '%$cari%' OR tgl_surat LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_surat_keluar";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_surat_keluar";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM t_surat_keluar WHERE id = '$idu'")->row();	
			$a['page']		= "f_surat_keluar";
		} else if ($mau_ke == "act_add") {	
			if ($this->upload->do_upload('file_surat')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("INSERT INTO t_surat_keluar VALUES (NULL, '$kode', '$no_agenda', '$isi_surat', '$dari', '$tujuan', '$no_surat', '$tgl_surat', NOW(), '$ket', '".$up_data['file_name']."', '".$this->session->userdata('admin_id')."')");
			} else {
				$this->db->query("INSERT INTO t_surat_keluar VALUES (NULL, '$kode', '$no_agenda', '$isi_surat', '$dari', '$tujuan', '$no_surat', '$tgl_surat', NOW(), '$ket', '', '".$this->session->userdata('admin_id')."')");
			}		
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Ditambahkan</div>");
			redirect('index.php/admin/surat_keluar');
		} else if ($mau_ke == "act_edt") {
			if ($this->upload->do_upload('file_surat')) {
				$query = $this->db->query("SELECT * FROM t_surat_keluar WHERE id = '$idp'");
				foreach ($query->result() as $row) {
					unlink('./upload/surat_keluar/'.$row->file);
				}
				$up_data	 	= $this->upload->data();
				$this->db->query("UPDATE t_surat_keluar SET no_agenda = '$no_agenda', kode = '$kode', isi_surat = '$isi_surat', dari = '$dari', tujuan = '$tujuan',no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket', file = '".$up_data['file_name']."' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE t_surat_keluar SET no_agenda = '$no_agenda', kode = '$kode', isi_surat = '$isi_surat', dari = '$dari', tujuan = '$tujuan',no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket' WHERE id = '$idp'");
			}	
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diperbaharui ".$this->upload->display_errors()."</div>");			
			redirect('index.php/admin/surat_keluar');
		} else if ($this->session->userdata('admin_level')== 1) {
            $a['data'] = $this->db->query("SELECT * FROM t_surat_keluar order by id desc LIMIT $awal, $akhir ")->result();
            $a['page']		= "l_surat_keluar";
        }else{
           $a['data']	= $this->web_model->view_where('t_surat_keluar',array('pengolah'=>$this->session->userdata('admin_id')))->result();
			$a['page']		= "l_surat_keluar";
		}
		
		$this->load->view('admin/aaa', $a);
	}

	public function surat_disposisi() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "" && $this->session->userdata('admin_level') == "") {
			redirect("index.php/admin/login");
		}
		
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(4);
		$idu1					= $this->uri->segment(3);
		$idu2					= $this->uri->segment(5);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$id_surat				= addslashes($this->input->post('id_surat'));
		$kpd_yth				= addslashes($this->input->post('kpd_yth'));
		$isi_disposisi			= addslashes($this->input->post('isi_disposisi'));
		$sifat					= addslashes($this->input->post('sifat'));
		$batas_waktu			= addslashes($this->input->post('batas_waktu'));
		$catatan				= addslashes($this->input->post('catatan'));
		
		$cari					= addslashes($this->input->post('q'));
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM t_disposisi WHERE id_surat = '$idu1'")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/surat_disposisi/".$idu1."/p");
		
		$a['judul_surat']	= gval("t_surat_masuk", "id", "perihal", $idu1);
		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM t_disposisi WHERE id = '$idu2'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">data berhasil di hapus </div>");
			redirect('index.php/admin/surat_disposisi/'.$idu2);
		} else if ($mau_ke == "add") {
			$a['page']		= "f_surat_disposisi";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM t_disposisi WHERE id = '$idu2'")->row();	
			$a['page']		= "f_surat_disposisi";
		} else if ($mau_ke == "act_add") {	
			$this->db->query("INSERT INTO t_disposisi VALUES (NULL, '$id_surat', '$kpd_yth', '-', '-','$isi_disposisi', '$sifat', '$batas_waktu', '$catatan', '-', '1')");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Ditambahkan</div>");
			redirect('index.php/admin/surat_disposisi/'.$id_surat);
		} else if ($mau_ke == "act_edt") {
			$this->db->query("UPDATE t_disposisi SET kpd_yth = '$kpd_yth', isi_disposisi = '$isi_disposisi', sifat = '$sifat', batas_waktu = '$batas_waktu', catatan = '$catatan' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diperbaharui</div>");			
			redirect('index.php/admin/surat_disposisi/'.$id_surat);
		} else {
			$a['data']		= $this->db->query("SELECT * FROM t_disposisi WHERE id_surat = '$idu1' LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_surat_disposisi";
		}
		
		$this->load->view('admin/aaa', $a);	
	}
	
	public function surat_keputusan() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "" && $this->session->userdata('admin_level') == "") {
			redirect("index.php/admin/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM t_sk")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."index.php/admin/surat_keputusan/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$no_sk					= addslashes($this->input->post('no_sk'));
		$tahun					= addslashes($this->input->post('tahun'));
		$tgl_update				= addslashes($this->input->post('tgl_update'));
		$tgl_catat				= addslashes($this->input->post('tgl_catat'));
		$tgl_surat				= addslashes($this->input->post('tgl_surat'));
		$perihal				= addslashes($this->input->post('perihal'));
		$keterangan				= addslashes($this->input->post('keterangan'));
		
		$cari					= addslashes($this->input->post('q'));

		//upload config 
		$config['upload_path'] 		= './upload/sk';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx|xls|xlsx';
		$config['max_size']			= '30000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		
		if ($mau_ke == "del") {
			##scrip hapus file dan data
				$query = $this->db->query("SELECT * FROM t_sk WHERE id = '$idu'");
				foreach ($query->result() as $row) {
					unlink('./upload/sk/'.$row->file);
				}
			$this->db->query("DELETE FROM t_sk WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
			redirect('index.php/admin/surat_keputusan');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM t_sk WHERE perihal LIKE '%$cari%' OR no_sk LIKE '%$cari%' OR tahun LIKE '%$cari%' OR kode LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_surat_keputusan";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_surat_keputusan";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM t_sk WHERE id = '$idu'")->row();	
			$a['page']		= "f_surat_keputusan";
		} else if ($mau_ke == "act_add") {	
			if ($this->upload->do_upload('file_surat')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("INSERT INTO t_sk VALUES (NULL, '$no_sk', '	$tahun', '$perihal', '$tgl_surat', NOW(), '', '".$up_data['file_name']."','$keterangan','".$this->session->userdata('admin_id')."')");
			} else {
				$this->db->query("INSERT INTO t_sk VALUES (NULL, '$no_sk', '	$tahun', '$perihal', '$tgl_surat', NOW(), NOW(), '','$keterangan','".$this->session->userdata('admin_id')."')");
			}	
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Ditambahkan. ".$this->upload->display_errors()."</div>");
			redirect('index.php/admin/surat_keputusan');
		} else if ($mau_ke == "act_edt") {
			if ($this->upload->do_upload('file_surat')) {
				$query = $this->db->query("SELECT * FROM t_sk WHERE id = '$idp'");
				foreach ($query->result() as $row) {
					unlink('./upload/sk/'.$row->file);
				}
				$up_data	 	= $this->upload->data();
				$this->db->query("UPDATE t_sk SET no_sk = '$no_sk', tahun = '$tahun', perihal = '$perihal', tgl_surat = '$tgl_surat', tgl_catat = '$tgl_catat', tgl_update = NOW(), keterangan = '$keterangan', file = '".$up_data['file_name']."' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE t_sk SET no_sk = '$no_sk', tahun = '$tahun', perihal = '$perihal', tgl_surat = '$tgl_surat', tgl_catat = '$tgl_catat', tgl_update = NOW(), keterangan = '$keterangan' WHERE id = '$idp'");
			}	
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diperbaharui. ".$this->upload->display_errors()."</div>");			
			redirect('index.php/admin/surat_keputusan');
		} else if ($this->session->userdata('admin_level')== 1) {
            $a['data'] = $this->db->query("SELECT * FROM t_sk order by id desc LIMIT $awal, $akhir ")->result();
            $a['page']		= "l_surat_keputusan";
        }else{
           $a['data']	= $this->web_model->view_where('t_sk',array('pengolah'=>$this->session->userdata('admin_id')))->result();
			$a['page']		= "l_surat_keputusan";
		}
		
		$this->load->view('admin/aaa', $a);
	}
	public function tugas() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "" && $this->session->userdata('admin_level') == "") {
			redirect("index.php/admin/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM t_sk")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."index.php/admin/tugas/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$no_agenda				= addslashes($this->input->post('no_agenda'));
		$kode					= addslashes($this->input->post('kode'));
		$isi_ringkas			= addslashes($this->input->post('isi_ringkas'));
		$atas_nama				= addslashes($this->input->post('atas_nama'));
		$tgl_surat				= addslashes($this->input->post('tgl_surat'));
		$tgl_catat				= addslashes($this->input->post('tgl_catat'));
		$cari					= addslashes($this->input->post('q'));

		//upload config 
		$config['upload_path'] 		= './upload/st';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx|xls|xlsx';
		$config['max_size']			= '2000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		
		if ($mau_ke == "del") {
			##scrip hapus file dan data
				$query = $this->db->query("SELECT * FROM t_st WHERE id = '$idu'");
				foreach ($query->result() as $row) {
					unlink('./upload/st/'.$row->file);
				}
			$this->db->query("DELETE FROM t_st WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
			redirect('index.php/admin/tugas');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM t_st WHERE no_agenda LIKE '%$cari%' OR isi_ringkas LIKE '%$cari%' OR atas_nama LIKE '%$cari%' OR tgl_surat LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_surat_tugas";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_surat_tugas";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM t_st WHERE id = '$idu'")->row();	
			$a['page']		= "f_surat_tugas";
		} else if ($mau_ke == "act_add") {	
			if ($this->upload->do_upload('file_surat')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("INSERT INTO t_st VALUES (NULL, '$no_agenda', '$kode', '$isi_ringkas', '$atas_nama', '$tgl_surat', NOW(), '".$up_data['file_name']."','".$this->session->userdata('admin_id')."')");
			} else {
				$this->db->query("INSERT INTO t_st VALUES (NULL, '$no_agenda', '$kode', '$isi_ringkas', '$atas_nama', '$tgl_surat', NOW(), '','".$this->session->userdata('admin_id')."')");
			}	
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Ditambahkan. ".$this->upload->display_errors()."</div>");
			redirect('index.php/admin/tugas');
		} else if ($mau_ke == "act_edt") {
			if ($this->upload->do_upload('file_surat')) {
				$query = $this->db->query("SELECT * FROM t_st WHERE id = '$idp'");
				foreach ($query->result() as $row) {
					unlink('./upload/st/'.$row->file);
				}
				$up_data	 	= $this->upload->data();
				$this->db->query("UPDATE t_st SET no_agenda = '$no_agenda', kode = '$kode', isi_ringkas = '$isi_ringkas', atas_nama = '$atas_nama', tgl_surat = '$tgl_surat', file = '".$up_data['file_name']."' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE t_st SET no_agenda = '$no_agenda', kode = '$kode', isi_ringkas = '$isi_ringkas', atas_nama = '$atas_nama', tgl_surat = '$tgl_surat' WHERE id = '$idp'");
			}	
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diperbaharui. ".$this->upload->display_errors()."</div>");			
			redirect('index.php/admin/tugas');
		} else if ($this->session->userdata('admin_level')== 1) {
            $a['data'] = $this->db->query("SELECT * FROM t_st order by id desc LIMIT $awal, $akhir ")->result();
            $a['page']		= "l_surat_tugas";
        }else{
           $a['data']	= $this->web_model->view_where('t_st',array('pengolah'=>$this->session->userdata('admin_id')))->result();
			$a['page']		= "l_surat_tugas";
		}
		
		$this->load->view('admin/aaa', $a);
	}
	public function pengguna() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "" && $this->session->userdata('admin_level') == "") {
			redirect("index.php/admin/login");
		}		
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		
		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$nama					= addslashes($this->input->post('nama'));
		$alamat					= addslashes($this->input->post('alamat'));
		$kadis					= addslashes($this->input->post('kadis'));
		$nip_kadis				= addslashes($this->input->post('nip_kadis'));
		
		$cari					= addslashes($this->input->post('q'));

		//upload config 
		$config['upload_path'] 		= './upload';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']			= '2000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		
		if ($mau_ke == "act_edt") {
			if ($this->upload->do_upload('logo')) {
				$query = $this->db->query("SELECT * FROM tr_instansi WHERE id = '$idp'");
				foreach ($query->result() as $row) {
					unlink('./upload/'.$row->logo);
				}
				$up_data	 	= $this->upload->data();
				$this->db->query("UPDATE tr_instansi SET nama = '$nama', alamat = '$alamat', kadis = '$kadis', nip_kadis = '$nip_kadis', logo = '".$up_data['file_name']."' WHERE id = '$idp'");

			} else {
				$this->db->query("UPDATE tr_instansi SET nama = '$nama', alamat = '$alamat', kadis = '$kadis', nip_kadis = '$nip_kadis' WHERE id = '$idp'");
			}		

			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diperbaharui</div>");			
			redirect('index.php/admin/pengguna');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM tr_instansi WHERE id = '1' LIMIT 1")->row();
			$a['page']		= "f_pengguna";
		}
		
		$this->load->view('admin/aaa', $a);	
	}
	
	public function agenda_surat_masuk() {
		$a['page']	= "f_config_cetak_agenda";
		$this->load->view('admin/aaa', $a);
	} 
	public function agenda_surat_keluar() {
		$a['page']	= "f_config_cetak_agenda";
		$this->load->view('admin/aaa', $a);
	} 
	public function agenda_surat_keputusan() {
		$a['page']	= "f_config_cetak_agenda";
		$this->load->view('admin/aaa', $a);
	} 
	public function agenda_surat_tugas() {
		$a['page']	= "f_config_cetak_agenda";
		$this->load->view('admin/aaa', $a);
	} 
	
	public function cetak_agenda() {
		$jenis_surat	= $this->input->post('tipe');
		$tgl_start		= $this->input->post('tgl_start');
		$tgl_end		= $this->input->post('tgl_end');
		
		$a['tgl_start']	= $tgl_start;
		$a['tgl_end']	= $tgl_end;		

		if ($jenis_surat == "agenda_surat_masuk") {	
			$a['data']	= $this->db->query("SELECT * FROM t_surat_masuk WHERE tgl_diterima >= '$tgl_start' AND tgl_diterima <= '$tgl_end' ORDER BY id")->result(); 
			$this->load->view('admin/agenda_surat_masuk', $a);
		} else if ($jenis_surat == "agenda_surat_keluar") {
			$a['data']	= $this->db->query("SELECT * FROM t_surat_keluar WHERE tgl_surat >= '$tgl_start' AND tgl_surat <= '$tgl_end' ORDER BY id")->result();
			$this->load->view('admin/agenda_surat_keluar', $a);
		} else if ($jenis_surat == "agenda_surat_keputusan") {
			$a['data']	= $this->db->query("SELECT * FROM t_sk WHERE tgl_surat >= '$tgl_start' AND tgl_surat <= '$tgl_end' ORDER BY id")->result();
			$this->load->view('admin/agenda_surat_keputusan', $a);
		} else {
			$a['data']	= $this->db->query("SELECT * FROM t_st WHERE tgl_surat >= '$tgl_start' AND tgl_surat <= '$tgl_end' ORDER BY id")->result();
			$this->load->view('admin/agenda_surat_tugas', $a);
		}
	}	
	
	public function manage_admin() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "" && $this->session->userdata('admin_level') == "") {
			redirect("index.php/admin/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM t_admin")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/manage_admin/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$username				= addslashes($this->input->post('username'));
		$password				= md5(addslashes($this->input->post('password')));
		$nama					= addslashes($this->input->post('nama'));
		$nip					= addslashes($this->input->post('nip'));
		$id_bidang				= addslashes($this->input->post('id_bidang'));
		$level					= addslashes($this->input->post('level'));
		
		$cari					= addslashes($this->input->post('q'));

		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM t_admin WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus</div>");
			redirect('index.php/admin/manage_admin');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM t_admin WHERE nama LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_manage_admin";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_manage_admin";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM t_admin WHERE id = '$idu'")->row();	
			$a['page']		= "f_manage_admin";
		} else if ($mau_ke == "act_add") {	
			$cek_user_exist = $this->db->query("SELECT username FROM t_admin WHERE username = '$username'")->num_rows();
			if (strlen($username) < 6) {
				$this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Username minimal 6 huruf</div>");
			} else if ($cek_user_exist > 0) {
				$this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Username telah dipakai. Ganti yang lain..!</div>");	
			} else {
				$this->db->query("INSERT INTO t_admin VALUES (NULL, '$username', '$password', '$nama', '$nip', '$id_bidang', '$level')");
				$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Ditambahkan</div>");
			}
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Ditambahkan</div>");
			redirect('index.php/admin/manage_admin');
		} else if ($mau_ke == "act_edt") {
			if ($password = md5("-")) {
				$this->db->query("UPDATE t_admin SET username = '$username', nama = '$nama', nip = '$nip', id_bidang = '$id_bidang', level = '$level' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE t_admin SET username = '$username', password = '$password', nama = '$nama', nip = '$nip', id_bidang = '$id_bidang', level = '$level' WHERE id = '$idp'");
			}
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diperbaharui </div>");			
			redirect('index.php/admin/manage_admin');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM t_admin LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_manage_admin";
		}
		
		$this->load->view('admin/aaa', $a);
	}

	public function get_klasifikasi() {
		$kode 				= $this->input->post('kode',TRUE);
		
		$data 				=  $this->db->query("SELECT id, kode, nama FROM ref_klasifikasi WHERE kode LIKE '%$kode%' ORDER BY id ASC")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->kode;
			$json_array['label']	= $d->kode." - ".$d->nama;
			$klasifikasi[] 			= $json_array;
		}
		
		echo json_encode($klasifikasi);
	}
	
	public function get_instansi_lain() {
		$kode 				= $this->input->post('dari',TRUE);
		
		$data 				=  $this->db->query("SELECT dari FROM t_surat_masuk WHERE dari LIKE '%$kode%' GROUP BY dari")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$klasifikasi[] 	= $d->dari;
		}
		
		echo json_encode($klasifikasi);
	}
	
	public function disposisi_cetak() {
		$idu = $this->uri->segment(3);
		$a['datpil1']	= $this->db->query("SELECT * FROM t_surat_masuk WHERE id = '$idu'")->row();	
		$a['datpil2']	= $this->db->query("SELECT kpd_yth FROM t_disposisi WHERE id_surat = '$idu'")->result();	
		$a['datpil3']	= $this->db->query("SELECT isi_disposisi, sifat, batas_waktu FROM t_disposisi WHERE id_surat = '$idu'")->result();
		$this->load->view('admin/f_disposisi', $a);
	}
	
	public function passwod() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "" && $this->session->userdata('admin_level') == "") {
			redirect("index.php/admin/login");
		}
		
		$ke				= $this->uri->segment(3);
		$id_user		= $this->session->userdata('admin_id');
		
		//var post
		$p1				= md5($this->input->post('p1'));
		$p2				= md5($this->input->post('p2'));
		$p3				= md5($this->input->post('p3'));
		
		if ($ke == "simpan") {
			$cek_password_lama	= $this->db->query("SELECT password FROM t_admin WHERE id = $id_user")->row();
			//echo 
			
			if ($cek_password_lama->password != $p1) {
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-error">Password Lama tidak sama</div>');
				redirect('index.php/admin/passwod');
			} else if ($p2 != $p3) {
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-error">Password Baru 1 dan 2 tidak cocok</div>');
				redirect('index.php/admin/passwod');
			} else {
				$this->db->query("UPDATE t_admin SET password = '$p3' WHERE id = ".$id_user."");
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-success">Password berhasil diperbaharui</div>');
				redirect('index.php/admin/passwod');
			}
		} else {
			$a['page']	= "f_passwod";
		}
		
		$this->load->view('admin/aaa', $a);
	}
	
	//login
	public function login() {
		$this->load->view('admin/login');
	}
	
	public function do_login() {
		$u 		= $this->security->xss_clean($this->input->post('u'));
		$ta 	= $this->security->xss_clean($this->input->post('ta'));
        $p 		= md5($this->security->xss_clean($this->input->post('p')));
         
		$q_cek	= $this->db->query("SELECT * FROM t_admin WHERE username = '".$u."' AND password = '".$p."'");
		$j_cek	= $q_cek->num_rows();
		$d_cek	= $q_cek->row();
		//echo $this->db->last_query();
		
        if($j_cek == 1) {
            $data = array(
                    'admin_id' => $d_cek->id,
                    'admin_user' => $d_cek->username,
                    'admin_nama' => $d_cek->nama,
                    'admin_ta' => $ta,
                    'admin_level' => $d_cek->level,
					'admin_valid' => true
                    );
            $this->session->set_userdata($data);
            redirect('index.php/admin');
        } else {	
			$this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">username atau password anda salah</div>");
			redirect('index.php/admin/login');
		}
	}
	
	public function logout(){
        $this->session->sess_destroy();
		redirect('index.php/admin/login');
    }

	public function manage_bagian() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "" && $this->session->userdata('admin_level') == "") {
			redirect("index.php/admin/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM t_kode_bagian")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."index.php/admin/manage_bagian/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$kd_bagian				= addslashes($this->input->post('kd_bagian'));
		$nama					= addslashes($this->input->post('nama'));
		$ket					= addslashes($this->input->post('ket'));
		
		$cari					= addslashes($this->input->post('q'));

		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM t_kode_bagian WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus</div>");
			redirect('index.php/admin/manage_bagian');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM t_kode_bagian WHERE nama LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_manage_bagian";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_manage_bagian";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM t_kode_bagian WHERE id = '$idu'")->row();	
			$a['page']		= "f_manage_bagian";
		} else if ($mau_ke == "act_edt") {
			$this->db->query("UPDATE t_kode_bagian SET kd_bagian = '$kd_bagian', nama = '$nama', ket = '$ket' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diperbaharui</div>");			
			redirect('index.php/admin/manage_bagian');
		} else if ($mau_ke == "act_add") {
			$this->db->query("INSERT INTO t_kode_bagian VALUES (NULL, '$kd_bagian', '$nama', '$ket')");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diperbaharui</div>");			
			redirect('index.php/admin/manage_bagian');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM t_kode_bagian LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_manage_bagian";
		}
		
		$this->load->view('admin/aaa', $a);
				
	}
}