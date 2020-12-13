<?php
class init extends CI_Model{ 

	function init()
	{
		parent::__construct();
	}
	function getLasturl(){
		$controllername = $this->router->fetch_class(); 
		$ROLE=$this->session->userdata('ROLE');
		$query=$this->db->query("select id from t_menu where url='$controllername' and role='$ROLE'");
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil= $data->id;
            }
			$data=array('id_session_menu'=>$hasil);
            $this->session->set_userdata($data);
			}
		} 
}
// END RiskIssue_model Class

/* End of file RiskIssue_model.php */
/* Location: ./application/models/RiskIssue_model.php */
?>