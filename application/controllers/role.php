<?php  

class role extends CI_Controller {
 
	var $limit=10;
	var $offset=10;	
	public function role() {
        parent::__construct();
        if ($this->session->userdata('LOGIN') != 'TRUE') {
           redirect('home/loginPage');			
        } 
    }	
	function index($limit='',$offset=''){
		$this->load->model("init"); 
		$this->init->getLasturl();
		
		if($this->session->userdata('LOGIN')=='TRUE'){
		$this->load->model("role_model"); 
		$this->load->model("user_model"); 
		$data['judul']='Role';
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->role_model->count();	
		$config['base_url'] = base_url().'role/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
		$data['menu']=$this->user_model->getMenu();
		$data['query']=$this->role_model->getrole($limit,$offset);
		$data['view']='role/role';
		$this->load->view('index',$data);
		}else {
		redirect('home/loginPage');		
		}

	}
	function search($limit='',$offset=''){
	 	$this->load->model("role_model"); 
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->role_model->count();	
		$config['base_url'] = base_url().'role/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
 
		$data['query']=$this->role_model->getrole($limit,$offset);
		$this->load->view('role/role',$data);
	}
	
	function add($id=''){		 
		$this->load->model("role_model"); 
	   $this->load->model("user_model"); 
		$data['judul']='Tambah role Pegawai';
		$data['menu']=$this->user_model->getMenu();
		if($id!=''){
		$info=$this->role_model->getRoleByid($id);		 
			$data['inforole']['role']=$info->role;
			$data['inforole']['id']=$info->id;
		}	
		$data['menuUp']=$this->role_model->getMenuUp($id);
		$data['role']=$this->role_model->getRole();
		$data['view']='role/form';
		$this->load->view('index',$data);

	}
	 
	 
	function simpan(){
		$this->load->model("role_model"); 
		if($this->input->post('role')==''){
			echo "Nik Pegawai Tidak Boleh Kosong"; return false;
		}  
		$this->role_model->simpan();
	}
	 
	function deleterole($id){
		$this->load->model("role_model"); 
		$this->role_model->deleterole($id);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */