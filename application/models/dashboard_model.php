<?php
class dashboard_model extends CI_Model{ 

	function dashboard_model()
	{
		parent::__construct();
	}
	function chart1($bulan='',$tahun=''){
		$series='';
		$datenow=$tahun.'-'.$bulan;
			
					 /*GET SUMMARY*/
						$query2=$this->db->query("select count(1) as total  from t_cuti 
						where status='A' and tgl_mulai like'%$datenow%'");
						 if ($query2->num_rows() > 0) {
							foreach ($query2->result() as $row) {
								$series.="{ name: 'DI TERIMA', data: [".$row->total."] },"; 
							}
						}
					 /*----------*/
					/*GET SUMMARY*/
						$query2=$this->db->query("select count(1) as total  from t_cuti 
						where status='P'  and tgl_mulai like'%$datenow%'");
						 if ($query2->num_rows() > 0) {
							foreach ($query2->result() as $row) {
								$series.="{ name: 'PENGAJUAN', data: [".$row->total."] },"; 
							}
						}
					 /*----------*/
					 /*GET SUMMARY*/
						$query2=$this->db->query("select count(1) as total  from t_cuti 
						where status='K'  and tgl_mulai like'%$datenow%'");
						 if ($query2->num_rows() > 0) {
							foreach ($query2->result() as $row) {
								$series.="{ name: 'DIKEMBALIKAN', data: [".$row->total."] },"; 
							}
						}
					 /*----------*/
				return $series;
			 
	}
	function bulan(){
		$select="";
		$selected="";
		$select.="<select onchange ='return loadchart1()' style='margin-top:5px;margin-right:5px;float:right' name='bulan' id='bulan'>";
				$select.="<option ";if(date("m")==01){$select.="selected='selected'";}  $select.="value='01'>Januari</option>";
				$select.="<option ";if(date("m")==02){$select.="selected='selected'";}  $select.="value='02'>Februari</option>";
				$select.="<option ";if(date("m")==03){$select.="selected='selected'";}  $select.="value='03'>Maret</option>";
				$select.="<option ";if(date("m")==04){$select.="selected='selected'";}  $select.="value='04'>April</option>";
				$select.="<option ";if(date("m")==05){$select.="selected='selected'";}  $select.="value='05'>Mei</option>";
				$select.="<option ";if(date("m")==06){$select.="selected='selected'";}  $select.="value='06'>Juni</option>";
				$select.="<option ";if(date("m")==07){$select.="selected='selected'";}  $select.="value='07'>Juli</option>";
				$select.="<option ";if(date("m")==08){$select.="selected='selected'";}  $select.="value='08'>Agustus</option>";
				$select.="<option ";if(date("m")==09){$select.="selected='selected'";}  $select.="value='09'>September</option>";
				$select.="<option ";if(date("m")==10){$select.="selected='selected'";}  $select.="value='10'>Oktober</option>";
				$select.="<option ";if(date("m")==11){$select.="selected='selected'";}  $select.="value='11'>November</option>";
				$select.="<option ";if(date("m")==12){$select.="selected='selected'";}  $select.="value='12'>Desember</option>";
		 
		$select.="</select>";
		return $select;
	}
	function tahun(){
		$select="";
		$selected="";
		$select.="<select onchange ='return loadchart1()'  style='margin-top:5px;margin-right:5px;float:right' name='tahun' id='tahun'>";
		for($i=date("Y")-10;$i<=date("Y")+10;$i++){
			$selected='';
			if(date("Y")==$i){	$selected="selected='selected'";}
			$select.="<option $selected  value='".$i."'>$i</option>";
		}
		$select.="</select>";
		return $select;
	}	
	
}
// END RiskIssue_model Class

/* End of file RiskIssue_model.php */
/* Location: ./application/models/RiskIssue_model.php */
?>