<?php 
		 
			$menus='';
			$role=$this->session->userdata('ROLE');
			$menu_id=$this->session->userdata('id_session_menu');
			$query=$this->db->query("select * from t_menu where role='$role' and aktif='1'  order by urut ASC");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$style='';
					$style2='';
					if(($data->url=='') || ($data->url=='#')) { $style='style="font-weight:bold"';}
					if(($data->id==$menu_id)) { $style2='class="dark_green btn"';}
					$menus .="<li><a $style2 $style href='".base_url().$data->url."'><i class='icon-tasks'></i>".$data->name."</a></li> ";
				}
				echo $menus;
			}
	?>