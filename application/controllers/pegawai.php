<?php  

class pegawai extends CI_Controller {
 
		var $limit=10;
	var $offset=10;	
	function index($limit='',$offset=''){	
		$this->load->model("init"); 
		$this->init->getLasturl();
		if($this->session->userdata('LOGIN')=='TRUE'){
		$this->load->model("listpegawai_model"); 
		$data['judul']='Table Pegawai';
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->listpegawai_model->count_pegawai();	
		$config['base_url'] = base_url().'pegawai/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
		$data['query']=$this->listpegawai_model->getListPegawai($limit,$offset);
		$data['view']='pegawai/data_pegawai';
		$this->load->view('index',$data); } else {
		redirect('home/loginPage');		
		}
	}
	function search($limit='',$offset=''){
	 	$this->load->model("listpegawai_model"); 
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->listpegawai_model->count_pegawai();	
		$config['base_url'] = base_url().'pegawai/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
 
		$data['query']=$this->listpegawai_model->getListPegawai($limit,$offset);
		$this->load->view('pegawai/data',$data);
	}
	function addForm($id=''){
		$nik=$this->input->post('nik');
		$this->load->model("pegawai_model"); 
		$this->load->model("listpegawai_model"); 
		$data['judul']='Tambah  / Ubah Pegawai';
		if($id!=''){
		$info=$this->pegawai_model->getDataPegawaibyNik($id);		 
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
			 
			$data['query']=$this->pegawai_model->getDataPegawai($info->id);
			 $data['comboLevel']=$this->listpegawai_model->getLevel($info->kd_level);
			 $data['comboCabang']=$this->listpegawai_model->getLokasiKerja($info->kd_cabang);
		 	 $data['comboJabatan']=$this->listpegawai_model->getJabatan($info->kd_jabatan);
			 $data['comboUnit']=$this->listpegawai_model->getUnit($info->kd_unit_kerja);
			} else {
			echo '<script> $( "#infodlg" ).html("Nik Tidak tersedia Harap Periksa Kembali ...");
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false});		</script>';
					
		  }		
		} else {
			 $data['comboLevel']=$this->listpegawai_model->getLevel();
			 $data['comboCabang']=$this->listpegawai_model->getLokasiKerja();
		 	 $data['comboJabatan']=$this->listpegawai_model->getJabatan();
			 $data['comboUnit']=$this->listpegawai_model->getUnit();
		}
		
		$data['id']=$id;
		$data['view']='pegawai/form';
		$this->load->view('index',$data);
	}
	 
	function detailPegawai($id=''){
			$this->load->model("pegawai_model"); 
			$this->pegawai_model->detailPegawai($id);
				
	}
	function simpan(){
		$this->load->model("pegawai_model"); 
		if($this->input->post('nik')==''){
			echo "Nik Pegawai Tidak Boleh Kosong"; return false;
		} else if($this->input->post('nama')==''){
			echo "Nama Pegawai Tidak Boleh Kosong"; return false;
		} else if($this->input->post('loker')==''){
			echo "Lokasi Kerja Tidak Boleh Kosong"; return false;
		} else if($this->input->post('jabatan')==''){
			echo "Jabatan Tidak Boleh Kosong"; return false;
		} else if($this->input->post('kd_level')==''){
			echo "Level/Pangkat Tidak Boleh Kosong"; return false;
		} else if($this->input->post('unit')==''){
			echo "Unit Kerja / Divisi  Tidak Boleh Kosong"; return false;
		}   
	$this->pegawai_model->simpan();
	}
	 
	function cekNik(){
		$this->load->model("pegawai_model"); 
		$this->pegawai_model->cekNik();
	}
	function detail($id=''){
		$this->load->model("pegawai_model"); 
		$this->pegawai_model->detail($id);
	}	
	function approval($id=''){
		$this->load->model("pegawai_model"); 
		$this->pegawai_model->approval($id);
	}	
	function deletePerjalanan($id=''){
		$this->db->query("delete from t_pegawai where id='$id'");
	} 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */