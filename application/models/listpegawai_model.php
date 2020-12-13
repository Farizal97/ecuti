<?php
class listpegawai_model extends CI_Model{ 

	function listpegawai_model()
	{
		parent::__construct();
	}
	/* GET ARTIKEL */
		function getListPegawai($limit='',$offset=''){
			$menus='';
			$status=$this->session->userdata('STATUS');
			$nama=$this->input->post('nama_anggota');
			$addTag="";
			if($status!=0){
			$addTag=" and t_pegawai.nik='".$this->session->userdata('NIK')."'";	
			}  else {
			$addTag=" and t_pegawai.nama like'%$nama%'";	
			}
			$judul=$this->input->post('judul');
			$query=$this->db->query("select t_pegawai.id,t_pegawai.nik,t_pegawai.kd_level,t_pegawai.nama,m_jabatan.nama_jabatan,m_unit_kerja.nama_unit_kerja,m_cabang.nama_cabang from t_pegawai
			LEFT JOIN m_jabatan ON t_pegawai.kd_jabatan=m_jabatan.kd_jabatan
            LEFT JOIN m_unit_kerja ON t_pegawai.kd_unit_kerja=m_unit_kerja.kd_unit_kerja
            LEFT JOIN m_cabang ON t_pegawai.kd_cabang=m_cabang.kd_cabang 
			where status_kerja='A' 
			$addTag
			ORDER BY id DESC LIMIT $limit,$offset");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$menus[]=$data;
				}
				return $menus;
			}
		}
	 
	function count_pegawai($type=''){
		$jumlah='';
		$judul=$this->input->post('judul');
		$status=$this->session->userdata('STATUS');
		$addTag="";
		$nama=$this->input->post('nama_anggota');
		if($status!=0){
		$addTag="and t_pegawai.nik='".$this->session->userdata('NIK')."'";	
		}  else {
			$addTag=" and t_pegawai.nama like'%$nama%'";	
			}
		$query=$this->db->query("select count(1) as jumlah from t_pegawai where 1=1 $addTag");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
				$jumlah=$data->jumlah;
				}
				return $jumlah;
			}
	}
	 
	function getLevel($kd_level=''){
		$select="";
		$select.="<select id='kd_level' name='kd_level'>";
		$select.="<option value=''>-Pilih Level-</option>";
		$q2 = $this->db->query("select kd_level,urut from m_level order by urut asc");
		if ($q2->num_rows() > 0) {
			foreach ($q2->result() as $row) {
				 $selected="";
				 if($kd_level==$row->kd_level){
				 $selected="selected='selected'";
				 }
				 $select.="<option $selected value='$row->kd_level'>$row->kd_level</option>";
			}
		}
		$select.="</select>";
		return $select;
	}
	function getLokasiKerja($loker=''){
		$select="";
		$select.="<select id='loker' name='loker'>";
		$select.="<option value=''>-Pilih Lokasi Kerja-</option>";
		$q2 = $this->db->query("select kd_cabang,nama_cabang from m_cabang order by nama_cabang asc");
		if ($q2->num_rows() > 0) {
			foreach ($q2->result() as $row) {
				 $selected="";
				 if($loker==$row->kd_cabang){
				 $selected="selected='selected'";
				 }
				 $select.="<option $selected value='$row->kd_cabang'>$row->nama_cabang</option>";
			}
		}
		$select.="</select>";
		return $select;
	}
	function getJabatan($kd_jab=''){
		$select="";
		$select.="<select id='jabatan' name='jabatan'>";
		$select.="<option value=''>-Pilih Jabatan-</option>";
		$q2 = $this->db->query("select kd_jabatan,nama_jabatan from m_jabatan order by nama_jabatan asc");
		if ($q2->num_rows() > 0) {
			foreach ($q2->result() as $row) {
				 $selected="";
				 if($kd_jab==$row->kd_jabatan){
				 $selected="selected='selected'";
				 }
				 $select.="<option $selected value='$row->kd_jabatan'>$row->nama_jabatan</option>";
			}
		}
		$select.="</select>";
		return $select;
	}
	function getUnit($unit=''){
		$select="";
		$select.="<select id='unit' name='unit'>";
		$select.="<option value=''>-Pilih Unit Kerja-</option>";
		$q2 = $this->db->query("select kd_unit_kerja,nama_unit_kerja from m_unit_kerja order by nama_unit_kerja asc");
		if ($q2->num_rows() > 0) {
			foreach ($q2->result() as $row) {
				 $selected="";
				 if($unit==$row->kd_unit_kerja){
				 $selected="selected='selected'";
				 }
				 $select.="<option $selected value='$row->kd_unit_kerja'>$row->nama_unit_kerja</option>";
			}
		}
		$select.="</select>";
		return $select;
	}

}
// END RiskIssue_model Class

/* End of file RiskIssue_model.php */
/* Location: ./application/models/RiskIssue_model.php */
?>