<?php  

class user extends CI_Controller {
 
	var $limit=10;
	var $offset=10;	
	public function user() {
        parent::__construct();
        if ($this->session->userdata('LOGIN') != 'TRUE') {
           redirect('home/loginPage');			
        } 
    }	
	function index($limit='',$offset=''){
		$this->load->model("init"); 
		$this->init->getLasturl();
		
		if($this->session->userdata('LOGIN')=='TRUE'){
			$this->load->model("user_model"); 
		$data['judul']='User';
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->user_model->count();	
		$config['base_url'] = base_url().'user/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
		$data['menu']=$this->user_model->getMenu();
		$data['query']=$this->user_model->getUser($limit,$offset);
		$data['view']='user/user';
		$this->load->view('index',$data);
		}else {
		redirect('home/loginPage');		
		}

	}
	function search($limit='',$offset=''){
	 	$this->load->model("user_model"); 
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->user_model->count();	
		$config['base_url'] = base_url().'user/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
 
		$data['query']=$this->user_model->getUser($limit,$offset);
		$this->load->view('user/user',$data);
	}
	
	function add($id=''){		 
		$this->load->model("user_model"); 
		$data['judul']='Tambah User Pegawai';
		$data['menu']=$this->user_model->getMenu();
		if($id!=''){
			$info=$this->user_model->getDataPegawai($id);	
			$data['infouser']['nik']=$info->nik;
			$data['infouser']['nama']=$info->nama;
			$data['infouser']['nama_cabang']=$info->nama_cabang;
			$data['infouser']['nama_unit_kerja']=$info->nama_unit_kerja;
			$data['infouser']['nama_jabatan']=$info->nama_jabatan;
			$data['infouser']['kd_cabang']=$info->kd_cabang;
			$data['infouser']['kd_unit_kerja']=$info->kd_unit_kerja;
			$data['infouser']['kd_jabatan']=$info->kd_jabatan;
			$data['infouser']['kd_level']=$info->kd_level;
		}
		$data['id']=$id;
		$data['role']=$this->user_model->getRole();
		$data['view']='user/form';
		$this->load->view('index',$data);

	}
	function addForm(){		
		$nik=$this->input->post('nik');
		$this->load->model("user_model"); 
		$data['judul']='Tambah User Pegawai';
		if($nik!=''){
		$info=$this->user_model->getDataPegawaibyNikz($nik);		 
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
			 
		 	 
			} else {
			echo '<script> $( "#infodlg" ).html("Nik Tidak tersedia Harap Periksa Kembali ...");
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false});		</script>';
		  }		
		}	
		$data['role']=$this->user_model->getRole();
		$data['id']=$this->input->post('id');;
		$this->load->view('user/form',$data);
	}
	function detailPegawai($id=''){
			$this->load->model("cuti_model"); 
			$this->cuti_model->detailPegawai($id);
				
	}
	function simpan(){
		$this->load->model("user_model"); 
		if($this->input->post('username')==''){
			echo "Username Tidak Boleh Kosong"; return false;
		} else if($this->input->post('password')==''){
			echo "Password Tidak Boleh Kosong"; return false;
		} else if($this->input->post('tipeuser')==''){
			echo "Status tidak Boleh Kosong"; return false;
		}  
		$this->user_model->simpan();
	}
	 
	function deleteuser($id){
		$this->load->model("user_model"); 
		$this->user_model->deleteuser($id);
	}
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */