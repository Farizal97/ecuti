<?php
class role_model extends CI_Model{ 

	function role_model()
	{
		parent::__construct();
	}
	function cek(){
		$username=$this->input->post('username');
		$password=md5($this->input->post('password'));
		$query=$this->db->query("select t_pegawai.nama,t_user.nik,t_user.username,t_user.password,t_user.status,t_user.role from t_user 
		left join t_pegawai on t_pegawai.nik=t_user.nik
		where username='$username' and password='$password'");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$data=array('LOGIN'=>TRUE,'NAMA'=>$data->nama,'STATUS'=>$data->status,'NIK'=>$data->nik,'ROLE'=>$data->role);
					$this->session->set_userdata($data);	
					redirect('home/index');		
				}
			} else {
				redirect('home/loginPage');
			}			
	}
	 
	function getRole(){
		 
			$query=$this->db->query("select * from t_role");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$menus[]=$data;
				}
				return $menus;
			}
	}	
	function getRoleByid($id=''){
			$query=$this->db->query("select * from t_role
			where t_role.id='$id'");
			return $query->row();
	}
	function getDataPegawaibyNik($nik=''){
			$query=$this->db->query("select t_pegawai.id,t_pegawai.nik,t_pegawai.nama from t_user
			left join t_pegawai on t_pegawai.nik=t_user.nik
			where t_user.id='$nik'");
			
			return $query->row();
	}

	function count($id=''){
		$jumlah='';
		$judul=$this->input->post('judul');
		$status=$this->session->userdata('STATUS');
		
		$query=$this->db->query("select count(1) as jumlah from t_user ");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
				$jumlah=$data->jumlah;
				}
				return $jumlah;
			}
	}
	function getUser($limit='',$offset=''){
			$menus='';
			$judul=$this->input->post('judul');
			$query=$this->db->query("select *  from t_user ");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$menus[]=$data;
				}
				return $menus;
			}
		}
		function cekUser(){
			$nik=$this->input->post('nik');
			$query=$this->db->query("select count(1) as jumlah from t_user where nik='$nik' ");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
				$jumlah=$data->jumlah;
				}
				return $jumlah;
			}
		}
		function getMenuUp($id=''){
		$filter="";
		if($id!='')
		{	$filter=" where role='$id'";	}
			$menus='';
			$role=$this->session->userdata('ROLE');
			$query=$this->db->query("select * from t_menu where role='$id'");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$check="";
					if($data->aktif==1){
					$check='checked="checked"';
					}
					$menus .="<input $check name='nama[]'   type='checkbox' value='".$data->url."' /><a href='".base_url().$data->url."'> ".$data->name."</a><br> ";
				}
				return $menus;
			}
		}
		function simpan(){
		$role=$this->input->post('role');
		$id=$this->input->post('id');
	 
			$data=array(
			 'role'=>$role,
			);
		 
			if($id==''){
			$this->db->trans_start();
			$this->db->insert('t_role',$data);
			$this->db->trans_complete(); 
			$this->createMenu();
			} else {
			$this->db->query("update t_role set role='$role'  where id='$id'");	
			}
			$this->insert_role();
		}
		function getnewroleid(){
			$query=$this->db->query("select id from t_role order by id desc LIMIT 1");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					return $data->id;
				}
			}	
		}
		function createMenu(){
			$query=$this->db->query("select * from t_menu group by url");
			 if ($query->num_rows() > 0) {
					foreach ($query->result() as $datax) {
					$data=array(
					 'name'=>$datax->name,
					 'url'=>$datax->url,
					 'role'=>$this->getnewroleid(),
					 'aktif'=>'0'
					);
					$this->db->trans_start();
					$this->db->insert('t_menu',$data);
					$this->db->trans_complete(); 
				}
			}	
			 
		}
		function insert_role(){
			$role=$this->input->post('id');
			$nama=$this->input->post('nama');
			$this->db->query("update t_menu set aktif='0' where role='$role'");	
			 if (count($nama) > 0) {
				foreach($nama as $row){
					$this->db->query("update t_menu set aktif='1'  where url='$row'");	
				}
			}
		}
		function deleterole($id){
			$this->db->query("delete from t_role where id='$id'");	
			$this->db->query("delete from t_menu where role='$id'");	
		}
}
// END RiskIssue_model Class

/* End of file RiskIssue_model.php */
/* Location: ./application/models/RiskIssue_model.php */
?>