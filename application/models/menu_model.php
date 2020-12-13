<?php
class menu_model extends CI_Model{ 

	function menu_model()
	{
		parent::__construct();
	}
	 
 
	function getMenus(){
			$query=$this->db->query("select * from t_menu group by url order by urut ASC");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$menus[]=$data;
				}
				return $menus;
			}
	}	
	function getmenubyid($id=''){
			$query=$this->db->query("select * from t_menu
			where t_menu.id='$id'");
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
			$query=$this->db->query("select *  from t_user");
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
			$query=$this->db->query("select * from t_menu group by name order by urut ASC");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$check="";
					if($data->role==$id){
					$check='checked="checked"';
					}
					$menus .="<input $check name='nama[]'   type='checkbox' value='".$data->url."' /><a href='".base_url().$data->url."'> ".$data->name."</a><br> ";
				}
				return $menus;
			}
		}
		function simpan(){
		$name=$this->input->post('name');
		$url=$this->input->post('url');
		$id=$this->input->post('id');
		$urut=$this->input->post('urut');
		
		$query=$this->db->query("select * from t_role");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $datax) {
				$data=array(
				 'name'=>$name,
				 'url'=>$url,
				 'urut'=>$urut,
				 'role'=>$datax->id,
				 'aktif'=>'0'
				);		 
				if($id==''){
				$this->db->trans_start();
				$this->db->insert('t_menu',$data);
				$this->db->trans_complete(); 
				} else {			 
			 	$this->db->query("update t_menu set name='$name' , url='$url', urut='$urut' where url='$id'");	
				}
			}
		  }
		}
		function getUrl($id=''){
			$query=$this->db->query("select url from t_menu where id='$id' ");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
				$url=$data->url;
				}
				return $url;
			}
		}
		function deletemenu($id=''){
			$url=$this->getUrl($id);
			echo"delete from t_menu where url='$url'";
			$this->db->query("delete from t_menu where url='$url'");	
		}
		 
}
// END RiskIssue_model Class

/* End of file RiskIssue_model.php */
/* Location: ./application/models/RiskIssue_model.php */
?>