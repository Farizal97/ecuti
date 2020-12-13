<?php  

class home extends CI_Controller {
 
	var $limit=10;
	var $offset=10;	
	function index($limit='',$offset=''){	
		$this->load->model("init"); 
		$this->init->getLasturl();
		$this->load->model("dashboard_model");
		if($this->session->userdata('LOGIN')=='TRUE'){
		$data['judul']='Selamat Datang di eCuti';
		$data['bulan']=$this->dashboard_model->bulan();
		$data['tahun']=$this->dashboard_model->tahun();
		/*----------------*/
		 
		$data['view']='dashboard';
		$this->load->view('index',$data); } else {
		redirect('home/loginPage');		
		}
	}
	function dashboard1($bulan='',$tahun=''){
		$this->load->model("dashboard_model");
		$data['series5']=$this->dashboard_model->chart1($bulan,$tahun);
		$this->load->view('dashboard/chart1',$data);
	}
	function loginPage(){
		$this->load->view('login');
	}
	function loginAct(){
		$this->load->model("user_model");
		$this->user_model->cek();
	}
	 
	function logout(){
		$this->session->sess_destroy();
		redirect('home/loginPage');		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */