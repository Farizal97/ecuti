<?php
class pegawai_model extends CI_Model{ 

	function pegawai_model()
	{
		parent::__construct();
	}
 
	/* GET DAT APEGAWAI */
		function getDataPegawai($id=''){
			$query=$this->db->query("select t_pegawai.id,t_pegawai.nik,t_pegawai.kd_cabang,t_pegawai.kd_unit_kerja,t_pegawai.kd_jabatan,t_pegawai.nama,t_pegawai.kd_level,m_jabatan.nama_jabatan,m_unit_kerja.nama_unit_kerja,m_cabang.nama_cabang from t_pegawai
		    LEFT JOIN m_jabatan ON t_pegawai.kd_jabatan=m_jabatan.kd_jabatan
            LEFT JOIN m_unit_kerja ON t_pegawai.kd_unit_kerja=m_unit_kerja.kd_unit_kerja
            LEFT JOIN m_cabang ON t_pegawai.kd_cabang=m_cabang.kd_cabang 
			where t_pegawai.id='$id'");
			return $query->row();
		}
		function getDataPegawaibyNik($id=''){
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
	function count_cuti($id=''){
		$jumlah='';
		$status=$this->session->userdata('STATUS');
		$addTag="";
		if($status!=0){
		$addTag="where t_cuti.nik='".$this->session->userdata('NIK')."'";	
		}		
		$query=$this->db->query("select count(1) as jumlah from t_cuti $addTag");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
				$jumlah=$data->jumlah;
				}
				return $jumlah;
			}
	}
	function getSisaCuti($nik){
		$hasil='';
		$maxcuti='';
        $q = $this->db->query("select  (SELECT DATEDIFF(tgl_selesai,tgl_mulai) from t_cuti where id=a.id) as dateDiff  from t_cuti a  where nik='$nik' and status='A'
		and tgl_mulai like'%".date('y')."%' and tgl_selesai like'%".date('y')."%'
		");
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
				$hasil =$hasil+ $data->dateDiff;
			}
		}
		$q2 = $this->db->query("select maxcuti from t_opsi");
		if ($q2->num_rows() > 0) {
			foreach ($q2->result() as $row) {
				$maxcuti =$row->maxcuti;
			}
		}
		if($maxcuti-$hasil > 0){
		return $maxcuti-$hasil; } else if($maxcuti-$hasil < 0){
		return 0;
		}
	}	
	function detailPegawai($id=''){
		$table="<table class='table-bordered' style='width:100%'>";	
			$judul=$this->input->post('judul');
			$query=$this->db->query("select a.id,a.nik,a.nama,m_jabatan.nama_jabatan,m_unit_kerja.nama_unit_kerja,m_cabang.nama_cabang from t_pegawai a
		    LEFT JOIN m_jabatan ON a.kd_jabatan=m_jabatan.kd_jabatan
            LEFT JOIN m_unit_kerja ON a.kd_unit_kerja=m_unit_kerja.kd_unit_kerja
            LEFT JOIN m_cabang ON a.kd_cabang=m_cabang.kd_cabang 
			where a.id='$id'");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$table.="<tr>";	
					$table.="<td colspan='3'><h3>Detail Pengambilan Cuti</h3></td>";	
					$table.="</tr>";
					$table.="<tr>";	
					$table.="<td style='width:150px'>Nik Pegawai</td><td><span class='label label-important'>".$row->nik."</span></td>";
					$table.="</tr>";
					$table.="<tr>";	
					$table.="<td>Nama Pegawai</td><td><span class='label label-important'>".$row->nama."</span></td>";
					$table.="</tr>";	
					$table.="<tr>";	
					$table.="<td>Sisa Cuti</td><td><span class='label label-important'>".$this->cuti_model->getSisaCuti($row->nik)."&nbsp Hari</span></td>";
					$table.="</tr>";	
				}
			}
			$table.="</table>";	
			echo $table;
	}
	function cekSisacuti(){
		$STTS_SESSION=$this->session->userdata('STATUS');
		$NIK_SESSION=$this->session->userdata('NIK');
		$nik=$this->input->post('nik');
		if(($STTS_SESSION==1) and ($NIK_SESSION!=$nik)){
			echo "Anda Tidak Punya Akses Untuk Melakukan Cuti";
			return false;
		}

		$sisa=$this->input->post('sisa');
		$tgl_mulai=date('Y-m-d', strtotime($this->input->post('tgl_mulai')));
		$tgl_selesai=date('Y-m-d', strtotime($this->input->post('tgl_selesai')));
		$q2 = $this->db->query("SELECT DATEDIFF('$tgl_selesai','$tgl_mulai') AS diffDate");
		if ($q2->num_rows() > 0) {
			foreach ($q2->result() as $row) {
				$diffDate =$row->diffDate;
			}
		}
		if($sisa-$diffDate<0){
			echo "Anda Mengambil Cuti Melebihi Sisa Cuti Anda , Harap Diperiksa Kembali";return false;
		} else {
			$this->simpan();
		}
	}
	function simpan(){
		$id=$this->input->post("id");
		$nik=$this->input->post("nik");
		$nama=$this->input->post("nama");
		$loker=$this->input->post("loker");
		$jabatan=$this->input->post("jabatan");
		$level=$this->input->post("kd_level");
		$unit=$this->input->post("unit");
		$data=array(
	 	 'nik'=>$nik,
		 'nama'=>$nama,
		 'kd_jabatan'=>$jabatan,
		 'kd_unit_kerja'=>$unit,
		 'status_kerja'=>'A',
		 'kd_level'=>$level,
		 'kd_cabang'=>$loker		
		);
		if($id==""){
		$this->db->trans_start();
		$this->db->insert('t_pegawai',$data);
		$this->db->trans_complete();} 
		else {
		$this->db->trans_start();
		$this->db->where('id',$id);
		$this->db->update('t_pegawai', $data); 
		$this->db->trans_complete();  
		}
	}	
	function simpanPhk(){
	$nik=$this->input->post("nik");
	$this->db->query("update t_pegawai set status_kerja='P' where t_pegawai.nik='$nik'");
	}
    function info($id=''){
	    $query=$this->db->query("select * from artikel where id='$id'");
		return $query->row();
    }
	function infobynik($nik=''){
	    $query=$this->db->query("select * from artikel where nik='$nik'");
		return $query->row();
    }
	function cekNik($nik=''){
	    $nik=$this->input->post('nik');
		$query=$this->db->query("select * from t_pegawai where nik='$nik'");
		$countNik=$query->num_rows();
		if($countNik!=0){
			echo "NIK ADA";
		}
	}
	function detail($id){
	$table="<table class='table-bordered' style='width:100%'>";	
	$q2=$this->db->query("select a.tgl_mulai,a.tgl_selesai,(SELECT DATEDIFF(a.tgl_selesai,a.tgl_mulai)) AS diffDate,t_pegawai.id,t_pegawai.nik,t_pegawai.kd_cabang,t_pegawai.kd_unit_kerja,t_pegawai.kd_jabatan,t_pegawai.nama,t_pegawai.kd_level,m_jabatan.nama_jabatan,m_unit_kerja.nama_unit_kerja,m_cabang.nama_cabang from t_cuti a
    		LEFT JOIN t_pegawai ON t_pegawai.nik=a.nik
			LEFT JOIN m_jabatan ON t_pegawai.kd_jabatan=m_jabatan.kd_jabatan
            LEFT JOIN m_unit_kerja ON t_pegawai.kd_unit_kerja=m_unit_kerja.kd_unit_kerja
            LEFT JOIN m_cabang ON t_pegawai.kd_cabang=m_cabang.kd_cabang 
			where a.id='$id'");
			if ($q2->num_rows() > 0) {
			foreach ($q2->result() as $row) {
				$table.="<tr>";	
				$table.="<td colspan='3'><h3>Detail Pengambilan Cuti</h3></td>";	
				$table.="</tr>";
				$table.="<tr>";	
				$table.="<td style='width:150px'>Nik Pegawai</td><td><span class='label label-important'>".$row->nik."</span></td>";
				$table.="</tr>";
				$table.="<tr>";	
				$table.="<td>Nama Pegawai</td><td><span class='label label-important'>".$row->nama."</span></td>";
				$table.="</tr>";	
				$table.="<tr>";	
				$table.="<td>Tanggal Mulai Cuti</td><td><span class='label label-important'>".date('d-F-Y', strtotime( $row->tgl_mulai))."</span></td>";
				$table.="</tr>";	
				$table.="<tr>";	
				$table.="<td>Tanggal Selesai Cuti</td><td><span class='label label-important'>".date('d-F-Y', strtotime( $row->tgl_selesai))."</span></td>";
				$table.="</tr>";	
				$table.="<tr>";	
				$table.="<td>Lama Cuti</td><td><span class='label label-important'>".$row->diffDate."&nbsp Hari</span></td>";
				$table.="</tr>";	
			}
		}
		$table.="</table>";	
		echo $table;	
	}
	function delete($id=''){
		$this->db->delete('artikel', array('id' => $id)); 
		echo"Sukses Hapus Data...";
	}
	function approval(){
		$id=$this->input->post('idcuti');
		$act=$this->input->post('ra');
		$this->db->query("update t_cuti set status='$act' where id='$id'");
 		echo "Sukses Mrubah Data Cuti";
		
	}

}
// END RiskIssue_model Class

/* End of file RiskIssue_model.php */
/* Location: ./application/models/RiskIssue_model.php */
?>