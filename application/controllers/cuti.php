<?php  

class cuti extends CI_Controller {
 
	var $limit=10;
	var $offset=10;	
	
	function index($limit='',$offset=''){
		$this->load->model("init"); 
		$this->init->getLasturl();
		if($this->session->userdata('LOGIN')=='TRUE'){
		$this->load->model("cuti_model"); 
		$data['judul']='Histori Cuti Pegawai';
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->cuti_model->count_cuti();	
		$config['base_url'] = base_url().'cuti/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
		$data['query']=$this->cuti_model->getListCuti($limit,$offset);
		$data['view']='cuti/hist_cuti';
		$this->load->view('index',$data);
		}else {
		redirect('home/loginPage');		
		}

	}
	function search($limit='',$offset=''){
	 	$this->load->model("cuti_model"); 
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->cuti_model->count_cuti();	
		$config['base_url'] = base_url().'cuti/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
 
		$data['query']=$this->cuti_model->getListCuti($limit,$offset);
		$this->load->view('cuti/data_cuti',$data);
	}
	
	function add($id=''){		 
		$this->load->model("cuti_model"); 
		$data['judul']='Tambah Cuti Pegawai';
		if($id!=''){
		$info=$this->cuti_model->getDataPegawai($id);		 
			$data['infouser']['nik']=$info->nik;
			$data['infouser']['nama']=$info->nama;
			$data['infouser']['nama_cabang']=$info->nama_cabang;
			$data['infouser']['nama_unit_kerja']=$info->nama_unit_kerja;
			$data['infouser']['nama_jabatan']=$info->nama_jabatan;
			$data['infouser']['kd_cabang']=$info->kd_cabang;
			$data['infouser']['kd_unit_kerja']=$info->kd_unit_kerja;
			$data['infouser']['kd_jabatan']=$info->kd_jabatan;
			$data['infouser']['kd_level']=$info->kd_level;
			$data['sisacuti']=$this->cuti_model->getSisaCuti($info->nik);
		}	
		$data['query']=$this->cuti_model->getDataPegawai($id);
		$data['view']='cuti/form';
		$this->load->view('index',$data);

	}
	function addForm(){
		$nik=$this->input->post('nik');
		$this->load->model("cuti_model"); 
		$data['judul']='Tambah Cuti Pegawai';
		if($nik!=''){
		$info=$this->cuti_model->getDataPegawaibyNik($nik);		 
		if(!empty($info)){
			$data['infouser']['nik']=$info->nik;
			$data['infouser']['nama']=$info->nama;
			$data['infouser']['nama_cabang']=$info->nama_cabang;
			$data['infouser']['nama_unit_kerja']=$info->nama_unit_kerja;
			$data['infouser']['nama_jabatan']=$info->nama_jabatan;
			$data['infouser']['kd_cabang']=$info->kd_cabang;
			$data['infouser']['kd_unit_kerja']=$info->kd_unit_kerja;
			$data['infouser']['kd_jabatan']=$info->kd_jabatan;
			$data['infouser']['kd_level']=$info->kd_level;
			$data['sisacuti']=$this->cuti_model->getSisaCuti($info->nik);
			$data['query']=$this->cuti_model->getDataPegawai($info->id);
			} else {
			echo '<script> $( "#infodlg" ).html("Nik Tidak tersedia Harap Periksa Kembali ...");
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false});		</script>';
		  }		
		}	
		$this->load->view('cuti/form',$data);
	}
	function detailPegawai($id=''){
			$this->load->model("cuti_model"); 
			$this->cuti_model->detailPegawai($id);
				
	}
	function delete($id=''){
			$this->load->model("cuti_model"); 
			$this->cuti_model->delete($id);
	}
	function cekBeforeinsert(){
		$this->load->model("cuti_model"); 
		return $this->cuti_model->cekBeforeinsert();
	}
	function simpan(){
		$this->load->model("cuti_model"); 
		$tgl_selesai=date('Y-m-d', strtotime($this->input->post('tgl_selesai')));
		$tgl_mulai=date('Y-m-d', strtotime($this->input->post('tgl_mulai')));
		$cek=$this->cekBeforeinsert();		
		if($this->input->post('nik')==''){
			echo "Nik Pegawai Tidak Boleh Kosong"; return false;
		} else if($this->input->post('tgl_mulai')==''){
			echo "Tanggal Mulai Cuti Tidak Boleh Kosong"; return false;
		} else if($this->input->post('tgl_selesai')==''){
			echo "Tanggal Selesai Cuti Tidak Boleh Kosong"; return false;
		} else if($this->input->post('ket')==''){
			echo "Keterangan Cuti Tidak Boleh Kosong"; return false;
		}  else if($tgl_mulai < date('Y-m-d')){
			echo "Tanggal Mulai Tidak Boleh Lebih Kecil Dari Tanggal Sekarang"; return false;
		} else if($tgl_mulai > $tgl_selesai){
			echo "Tanggal Mulai Tidak Boleh Lebih Kecil Dari Tanggal Selesai"; return false;
		} else if($cek > 0){
			echo "Pegawai Sudah Melakukan Pengajuan Cuti"; return false;
		} else {
			$this->cuti_model->cekSisacuti();
		}
	}
	function detail($id=''){
		$this->load->model("cuti_model"); 
		$this->cuti_model->detail($id);
	}	
	function approval($id=''){
		$this->load->model("cuti_model"); 
		$this->cuti_model->approval($id);
	}	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */