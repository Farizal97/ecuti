<?php  

class menus extends CI_Controller {
 
	var $limit=10;
	var $offset=10;	
	public function menus() {
        parent::__construct();
        if ($this->session->userdata('LOGIN') != 'TRUE') {
           redirect('home/loginPage');			
        } 
    }	
	function index($limit='',$offset=''){
		$this->load->model("init"); 
		$this->init->getLasturl();
		
		if($this->session->userdata('LOGIN')=='TRUE'){
		$this->load->model("menu_model"); 
		$this->load->model("user_model"); 
		
		$data['judul']='Menu';
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->menu_model->count();	
		$config['base_url'] = base_url().'menus/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
		$data['menu']=$this->user_model->getMenu();
		$data['query']=$this->menu_model->getMenus($limit,$offset);
		$data['view']='menus/menu';
		$this->load->view('index',$data);
		}else {
		redirect('home/loginPage');		
		}

	}
	function search($limit='',$offset=''){
	 	$this->load->model("menu_model"); 
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->menu_model->count();	
		$config['base_url'] = base_url().'menus/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
 
		$data['query']=$this->menu_model->getrole($limit,$offset);
		$this->load->view('menus/menu',$data);
	}
	
	function add($id=''){		 
		$this->load->model("menu_model"); 
		$this->load->model("user_model"); 
		$data['judul']='Tambah role Pegawai';
		$data['menu']=$this->user_model->getMenu();
		if($id!=''){
		$info=$this->menu_model->getmenubyid($id);		 
			$data['inforole']['name']=$info->name;
			$data['inforole']['url']=$info->url;
			$data['inforole']['id']=$info->id;
			$data['inforole']['urut']=$info->urut;
		}	
		$data['menuUp']=$this->menu_model->getMenuUp($id);
		$data['view']='menus/form';
		$this->load->view('index',$data);

	}
	 
	 
	function simpan(){
		$this->load->model("menu_model"); 
		if($this->input->post('name')==''){
			echo "Nama Menu Tidak Boleh Kosong"; return false;
		}  
		else if($this->input->post('url')==''){
			echo "Url Tidak Boleh Kosong"; return false;
		}  
		$this->menu_model->simpan();
	}
	
	 function deletemenu($id){
		$this->load->model("menu_model"); 
		$this->menu_model->deletemenu($id);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */