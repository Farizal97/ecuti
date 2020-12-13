<?php
class user_model extends CI_Model{ 

	function user_model()
	{
		parent::__construct();
	}
	function cek(){
		$username=$this->input->post('username');
		$password=md5($this->input->post('password'));
		$query=$this->db->query("select t_pegawai.nama as nama_user,t_user.nik,t_user.username,t_user.password,t_user.status,t_user.role from t_user
		left join t_pegawai on t_pegawai.nik=t_user.nik
		where username='$username' and password='$password'");
		 
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$data=array('LOGIN'=>TRUE,'NAMA'=>$data->nama_user,'STATUS'=>$data->status,'NIK'=>$data->nik,'ROLE'=>$data->role);
					$this->session->set_userdata($data);	
					 redirect('home/index');		
				}
			} else {
				redirect('home/loginPage');
			}			
	}
	/* GET DAT APEGAWAI */
		function getDataPegawaiup($id=''){
			$query=$this->db->query("select t_pegawai.id,t_pegawai.nik,t_pegawai.kd_cabang,t_pegawai.kd_unit_kerja,t_pegawai.kd_jabatan,t_pegawai.nama,t_pegawai.kd_level,m_jabatan.nama_jabatan,m_unit_kerja.nama_unit_kerja,m_cabang.nama_cabang from t_pegawai
		    LEFT JOIN m_jabatan ON t_pegawai.kd_jabatan=m_jabatan.kd_jabatan
            LEFT JOIN m_unit_kerja ON t_pegawai.kd_unit_kerja=m_unit_kerja.kd_unit_kerja
            LEFT JOIN m_cabang ON t_pegawai.kd_cabang=m_cabang.kd_cabang 
			where t_pegawai.id='$id'");
			return $query->row();
		}
		function getDataPegawaibyNikz($nik=''){
			$query=$this->db->query("select t_pegawai.id,t_pegawai.nik,t_pegawai.kd_cabang,t_pegawai.kd_unit_kerja,t_pegawai.kd_jabatan,t_pegawai.nama,t_pegawai.kd_level,m_jabatan.nama_jabatan,m_unit_kerja.nama_unit_kerja,m_cabang.nama_cabang from t_pegawai
		    LEFT JOIN m_jabatan ON t_pegawai.kd_jabatan=m_jabatan.kd_jabatan
            LEFT JOIN m_unit_kerja ON t_pegawai.kd_unit_kerja=m_unit_kerja.kd_unit_kerja
            LEFT JOIN m_cabang ON t_pegawai.kd_cabang=m_cabang.kd_cabang 
			where t_pegawai.nik='$nik'");
			return $query->row();
		}

	/* --- */
	function getMenu(){
			$menus='';
			$role=$this->session->userdata('ROLE');
			$query=$this->db->query("select * from t_menu where role='$role' and aktif='1' order by urut ASC");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$menus .="<li><a href='".base_url().$data->url."'><i class='icon-tasks'></i>".$data->name."</a></li> ";
				}
				return $menus;
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
	function getDataPegawai($id=''){
			$query=$this->db->query("select t_pegawai.id,t_pegawai.nik,t_pegawai.kd_cabang,t_pegawai.kd_unit_kerja,t_pegawai.kd_jabatan,t_pegawai.nama,t_pegawai.kd_level,m_jabatan.nama_jabatan,m_unit_kerja.nama_unit_kerja,m_cabang.nama_cabang from t_user
		    LEFT JOIN t_pegawai ON t_pegawai.nik=t_user.nik 
		    LEFT JOIN m_jabatan ON t_pegawai.kd_jabatan=m_jabatan.kd_jabatan
            LEFT JOIN m_unit_kerja ON t_pegawai.kd_unit_kerja=m_unit_kerja.kd_unit_kerja
            LEFT JOIN m_cabang ON t_pegawai.kd_cabang=m_cabang.kd_cabang 			
			where t_user.id='$id'");
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
			$query=$this->db->query("select *,t_role.role as namarole, t_user.id as iduser,t_user.status,t_user.id as userid,t_user.nik,t_pegawai.nama,m_jabatan.nama_jabatan,m_unit_kerja.nama_unit_kerja,m_cabang.nama_cabang from t_user
			LEFT JOIN t_pegawai ON t_pegawai.nik=t_user.nik
            LEFT JOIN m_jabatan ON t_pegawai.kd_jabatan=m_jabatan.kd_jabatan
            LEFT JOIN m_unit_kerja ON t_pegawai.kd_unit_kerja=m_unit_kerja.kd_unit_kerja
            LEFT JOIN m_cabang ON t_pegawai.kd_cabang=m_cabang.kd_cabang 
			LEFT JOIN t_role ON t_role.id=t_user.role 
			
			ORDER BY t_user.id DESC LIMIT $limit,$offset");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$menus[]=$data;
				}
				return $menus;
			}
		}
		function cekUser(){
			$username=$this->input->post('username');
			$query=$this->db->query("select count(1) as jumlah from t_user where username='$username' ");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
				$jumlah=$data->jumlah;
				}
				return $jumlah;
			}
		}
		function simpan(){
		$id=$this->input->post('id');
		$username=$this->input->post('username');		 
		$password=md5($this->input->post('password'));
		$tipeuser=$this->input->post('tipeuser');
		$role=$this->input->post('role');
		$nama=$this->input->post('nama');
		$nik=$this->input->post('nik');
		$data=array(
		 'nik'=>$nik,
	 	 'username'=>$username,
		 'nama'=>$nama,
		 'password'=>$password,
		 'status'=>$tipeuser,
		 'role'=>$role
		);
		if($id==''){ 
		$this->db->trans_start();
		$this->db->insert('t_user',$data);
		$this->db->trans_complete(); 
	    } else {
		$this->db->query("update t_user set nik='$nik', role='$role',username='$username', password='$password', nama='$nama', status='$tipeuser' where id='$id'");	
		} 
		}
		function deleteuser($id){
			$this->db->query("delete from t_user where id='$id'");	
		}
}
// END RiskIssue_model Class

/* End of file RiskIssue_model.php */
/* Location: ./application/models/RiskIssue_model.php */
?>