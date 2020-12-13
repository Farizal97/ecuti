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
 
	 function deletemenu(id){
	 	$( "#infodlg" ).html("Anda Ingin Menghapus Data Ini ?");
		$( "#infodlg" ).dialog({ title:"Info...", draggable: false, modal: true, buttons: {
					 "Ya": function(){
							  $.ajax({
									url:'<?php echo base_url(); ?>menus/deletemenu/'+id,		 
									type:'POST',
									data:"",
									success:function(data){ 
										  window.location="<?php echo base_url() ?>menus";
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
													<h5>List Menu </h5>
                                                     <a  style="float:right; margin:5px;width:100px"  href="<?php echo base_url();?>menus/add" class="dark_green btn">Tambah Menu</a> 
													</div>
										
													<div class="well-content">
													<div class="table_options top_options">
													</div>

 <table class="table multimedia table-striped table-hover">
                                    <thead>
                                        <tr>
                                           <th>Nama Menu  </th>
                                           <th>Url  </th>
										   <th>Urutan  </th>
                                           <th>Edit </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									 	<?php  if(!empty($query)) { foreach($query as $row) { ?> 
                                        <tr>
                                           
                                            <td style="text-align:center;font-weight:bold">
											<span class="label label-warning" style="float:left"><?php echo $row->name ?></span>
											</td>
                                            <td style="text-align:center;font-weight:bold">
											<span class="label label-success" style="float:left"><?php echo base_url().$row->url ?></span>
											</td>
                                             <td style="text-align:center;font-weight:bold">
											<span class="label label-success" style="float:left"><?php echo  $row->urut ?></span>
											</td>
                                            <td>
                                              <a class="btn simptip-position-left"    data-tooltip="Ubah Data"  
                                              href="<?php echo base_url()?>menus/add/<?php echo $row->id ?>">
											  <i class="icon-arrow-right"></i></a>
                                              <a class="btn simptip-position-left"    data-tooltip="Hapus Data"  
                                              onclick="return deletemenu(<?php   echo $row->id; ?>)"><i class="icon-trash"></i></a> 
                                                    
                                                    
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