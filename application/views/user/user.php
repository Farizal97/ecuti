   <link rel="stylesheet" href="<?php echo base_url();?>css/themes/jquery.ui.all.css" type="text/css" />

	<script type="text/javascript">
	$(document).ready(function() { 
	  $(function() {
		applyPagination();
		function applyPagination() {
		  $(".pages a").click(function() {
		   var url = $(this).attr("href");
		   $.ajax({
			  type: "POST",
			  data: "",
			  url: url,
			  beforeSend: function() {
				$(".well-content").html("<div class='loading_div'><img src='<?php echo base_url() ?>img/loading.gif'></div>");
			  },
			  success: function(msg) {
				$("#tabledata").html(msg);
				<!-- applyPagination(); -->
			  }
			});
			 return false;
			});
		}
	  }); 
	});
	 function detailData(id){
		 $("#tr"+id).toggle();
		 $.ajax({
			url:'<?php echo base_url(); ?>user/detail/'+id,		 
			type:'POST',
			data:$('#frmsave').serialize(),
			success:function(data){ 
				$("#detail"+id).html('');  
				$("#detail"+id).append(data);  
			}  
		});		
	 }
	 function getdata(){
	 	  $.ajax({
			  type: "POST",
			  data: "",
			  url:'<?php echo base_url(); ?>user/search/',	
			  beforeSend: function() {
				$(".well-content").html("<div class='loading_div'><img src='<?php echo base_url() ?>img/loading.gif'></div>");
			  },
			  success: function(msg) {
				$("#tabledata").html(msg);
			  }
			});
	 }
	 function deleteuser(id){
	 	$( "#infodlg" ).html("Anda Ingin Menghapus Data Ini ?");
		$( "#infodlg" ).dialog({ title:"Info...", draggable: false, modal: true, buttons: {
					 "Ya": function(){
							  $.ajax({
									url:'<?php echo base_url(); ?>user/deleteuser/'+id,		 
									type:'POST',
									data:"",
									success:function(data){ 
										  window.location="<?php echo base_url() ?>user";
									}  
								});			
							  $(this).dialog("close");
					  } ,
				  "Tutup": function(){
			  			 $(this).dialog("close");
						}
		 }});	
	}
 </script><div class="table_options bottom_options">
                                  <div class="alert">
                                 		<strong>Warning!</strong><br> Hati Hati Dengan Proses Penghapusan Data ...
                                	   </div> 
													</div>	
<div id="tabledata">
<div class="span12">
 										<div class="well Blue">
												<div class="well-header">
													<h5>List User </h5>
                                                     <a style="margin-top:5px;float:right;margin-right:5px;" href="<?php echo base_url();?>user/add" class="dark_green btn">Tambah User</a><br>
													</div>
										
													<div class="well-content">
													<div class="table_options top_options">
													</div>

 <table class="table multimedia table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Username</th>
                                            <th>Status </th>
                                            <th>Role </th>
                                            <th>Nama </th>
                                           <th>Edit </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									 	<?php  if(!empty($query)) { foreach($query as $row) { ?> 
                                        <tr>
                                            <td>
											<img onclick="return detailData(<?php echo $row->id ?>)" style="height:15px;margin-left:10px;;width:15px" src="<?php echo base_url()?>img/plus.png" 
											alt="Avatar"></td>
                                            
                                            <td> <span class="label  label-success"><?php echo $row->username ?></span></td>
                                            <td> <span class="label  label-warning"><?php if($row->status==0){echo"Administrator";} else {echo"User";} ?></span></td>
                                            <td> <span class="label  label-success"><?php echo $row->namarole ?></span>
											</td>
                                            <td><?php echo $row->nama ?></td>
                                            <td> 
                                              <a class="btn simptip-position-left"    data-tooltip="Ubah Data"  
                                              href="<?php echo base_url()?>user/add/<?php echo $row->iduser  ?>">
											  <i class="icon-arrow-right"></i></a>
                                              <a class="btn simptip-position-left"    data-tooltip="Hapus Data"  
                                              onclick="return deleteuser(<?php   echo $row->iduser; ?>)"><i class="icon-trash"></i></a>  
                                            </td>
                                        </tr>
										 
										<?php }} ?>
                                    </tbody>
                                </table><br>
								 <p class="pages"> <?php echo $this->pagination->create_links(); ?></p>		
								 </div>
								 
								 <div class="table_options bottom_options">
													</div>
											  </div>
											</div>
										</div>