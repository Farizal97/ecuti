<?php
class cuti_model extends CI_Model{ 

	function cuti_model()
	{
		parent::__construct();
	}
	function getListCuti($limit='',$offset=''){
			$menus='';
			$nama=$this->input->post('nama_anggota');
			$status=$this->session->userdata('STATUS');
			$addTag="";
			if($status!=0){
			$addTag=" where t_pegawai.nik='".$this->session->userdata('NIK')."'";	
			} else {
			$addTag=" where t_pegawai.nama like'%$nama%'";	
			}
		 
			$query=$this->db->query("select t_cuti.status as status,t_cuti.id as cutiid,t_pegawai.id,t_pegawai.nik,t_pegawai.nama,m_jabatan.nama_jabatan,m_unit_kerja.nama_unit_kerja,m_cabang.nama_cabang from t_cuti
   		    LEFT JOIN t_pegawai ON t_pegawai.nik=t_cuti.nik
			LEFT JOIN m_jabatan ON t_pegawai.kd_jabatan=m_jabatan.kd_jabatan
            LEFT JOIN m_unit_kerja ON t_pegawai.kd_unit_kerja=m_unit_kerja.kd_unit_kerja
            LEFT JOIN m_cabang ON t_pegawai.kd_cabang=m_cabang.kd_cabang
			$addTag
			ORDER BY t_cuti.id DESC LIMIT $limit,$offset");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$menus[]=$data;
				}
				return $menus;
			}

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
		function getDataPegawaibyNik($nik=''){
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
		$nama=$this->input->post('nama_anggota');
		if($status!=0){
		$addTag=" where t_cuti.nik='".$this->session->userdata('NIK')."'";	
		}else {
		$addTag=" where t_pegawai.nama like'%$nama%'";	
		}		
		$query=$this->db->query("select count(1) as jumlah from t_cuti
		 LEFT JOIN t_pegawai ON t_pegawai.nik=t_cuti.nik
		$addTag");
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
		$nik=$this->input->post('nik');
		$kd_level=$this->input->post('level');
		$kd_cabang=$this->input->post('cabang');
		$kd_jabatan=$this->input->post('jabatan');
		$kd_unit_kerja=$this->input->post('unit_kerja');
		$tgl_mulai=date('Y-m-d', strtotime($this->input->post('tgl_mulai')));
		$tgl_selesai=date('Y-m-d', strtotime($this->input->post('tgl_selesai')));
		$tgl_sk=date('Y-m-d', strtotime($this->input->post('tgl_sk')));
		$ket=$this->input->post('ket');
		$data=array(
	 	 'nik'=>$nik,
		 'kd_cabang'=>$kd_cabang,
		 'kd_jabatan'=>$kd_jabatan,
		 'kd_unit_kerja'=>$kd_unit_kerja,
		 'kd_level'=>$kd_level,
		 'status'=>'P',
		 'keterangan'=>$ket,
		 'tgl_mulai'=>$tgl_mulai,
		 'tgl_selesai'=>$tgl_selesai,
		 'tgl_sk'=>$tgl_sk,
		 'tgl_pengajuan'=>date('y-m-d')
		);
		$this->db->trans_start();
		$this->db->insert('t_cuti',$data);
		$this->db->trans_complete(); 
	}	
    function info($id=''){
	    $query=$this->db->query("select * from artikel where id='$id'");
		return $query->row();
    }
	function infobynik($nik=''){
	    $query=$this->db->query("select * from artikel where nik='$nik'");
		return $query->row();
    }
	function detail($id){
	$c="'";
	$table="<div id='div_".$id."' ><table class='table-bordered' style='width:100%'>";	
	$table.="<table class='table-bordered' style='width:100%'>";	
	$q2=$this->db->query("select a.tgl_mulai,a.tgl_selesai,(SELECT DATEDIFF(a.tgl_selesai,a.tgl_mulai)) AS diffDate,t_pegawai.id,t_pegawai.nik,t_pegawai.kd_cabang,t_pegawai.kd_unit_kerja,t_pegawai.kd_jabatan,t_pegawai.nama,a.keterangan,t_pegawai.kd_level,m_jabatan.nama_jabatan,m_unit_kerja.nama_unit_kerja,m_cabang.nama_cabang from t_cuti a
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
				$table.="<td>Alasan Cuti</td><td><span class='label label-important'>".$row->keterangan."</span></td>";
				$table.="</tr>";
				$table.="<tr>";	
				$table.="<td>Tanggal Mulai Cuti</td><td><span class='label label-important'>".date('d-F-Y', strtotime( $row->tgl_mulai))."</span></td>";
				$table.="</tr>";	
				$table.="<tr>";	
				$table.="<td>Tanggal Selesai Cuti</td><td><span class='label label-important'>".date('d-F-Y', strtotime( $row->tgl_selesai))."</span></td>";
				$table.="</tr>";	
				$table.="<tr>";	
				$table.="<td>Lama Cuti</td><td><span style='float:left;font-size:50px;height:40px;min-width:200px;padding-top:20px;'   class='label label-important'>".$row->diffDate."&nbsp Hari</span></td>";
				$table.="</tr>";	
				$table.="<tr>";	
				$table.="<td>Sisa Cuti</td><td><span class='label label-important'>".$this->cuti_model->getSisaCuti($row->nik)."&nbsp Hari</span></td>";
				$table.="</tr>";
				$table.='<td colspan="2"> <a onClick="return print_div('.$c.'div_'.$id.$c.')" class="btn simptip-position-left" style="float:right" data-tooltip="Cetak Berdasarkan Surat"><i class="icon-print"></i>Cetak</a>&nbsp</td>'; 
			}
		}
		$table.="</table></div>";	
		echo $table;	
	}
	function delete($id=''){
		$this->db->delete('t_cuti', array('id' => $id)); 
		echo"Sukses Hapus Data...";
	}
	function cekBeforeinsert(){
		$nik=$this->input->post('nik');
		$query=$this->db->query("select count(1) as jumlah from t_cuti where nik='$nik' and status='P'");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
				$jumlah=$data->jumlah;
				}
				return $jumlah;
			}
	}
	function approval(){
		$id=$this->input->post('idcuti');
		$act=$this->input->post('ra');
		$this->db->query("update t_cuti set status='$act' where id='$id'");
 		echo "Sukses Merubah Data Cuti";
		
	}

}
// END RiskIssue_model Class

/* End of file RiskIssue_model.php */
/* Location: ./application/models/RiskIssue_model.php */
?>