   <link rel="stylesheet" href="<?php echo base_url();?>css/themes/jquery.ui.all.css" type="text/css" />

	<script type="text/javascript">
	$(document).ready(function() { 
	 
	  $(function() {
		applyPagination();
		function applyPagination() {
		  $(".pages a").click(function() {
		   var url = $(this).attr("href");
		   var nama_anggota=$("#nama_anggota").val();
		   $.ajax({
			  type: "POST",
			  data: "nama_anggota="+nama_anggota,
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
	    getdata();
	});
	function deletedata(id){
			$( "#infodlg" ).html("Anda Ingin Menghapus Data Ini ?");
			$( "#infodlg" ).dialog({ title:"Info...", draggable: false, modal: true, buttons: {
					 "Ya": function(){
							  $.ajax({
									url:'<?php echo base_url(); ?>cuti/delete/'+id,		 
									type:'POST',
									data:"",
									success:function(data){ 
										 getdata();
									}  
								});			
							  $(this).dialog("close");
					  } ,
				  "Tutup": function(){
			   $(this).dialog("close");
				}
		 }});		
	 }
	 function detailData(id){
		 $("#tr"+id).toggle();
		 $.ajax({
			url:'<?php echo base_url(); ?>cuti/detail/'+id,		 
			type:'POST',
			data:$('#frmsave').serialize(),
			success:function(data){ 
				$("#detail"+id).html('');  
				$("#detail"+id).append(data);  
			}  
		});		
	 }
	 function getdata(){
		  var nama_anggota=$("#nama_anggota").val();
	 	  $.ajax({
			  type: "POST",
			  data: "nama_anggota="+nama_anggota,
			  url:'<?php echo base_url(); ?>cuti/search/',	
			  beforeSend: function() {
				$(".well-content").html("<div class='loading_div'><img src='<?php echo base_url() ?>img/loading.gif'></div>");
			  },
			  success: function(msg) {
				$("#tabledata").html(msg);
			  }
			});
	 }
 	 
	 function actCuti(id){
	 $("#idcuti").val(id);
					$("#actCutiPegawai").dialog({
					 resizable: false,
					 modal: true,
					 title:"Approval Cuti",
					 draggable: false,
					 width: 'auto',					 
					 height: 'auto',
					 buttons: {
					 "Ya": function(){
						 simpan(id);   
						  $(this).dialog("close");
					  },
					  "Tutup": function(){
						   $(this).dialog("close");
						}
					 }
				  });

	 }
	</script>
    <script>
	 
 	function print_div(divID){
		  //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

		}
	</script>
    <fieldset> 
<table>
	<tbody><tr>
    	<td>Nama</td>
        <td>:</td>
        <td><input type="text" class="input-xlarge" onchange="return getdata()" id="nama_anggota" name="nama_anggota" placeholder="Nama Pegawai  "></td>
    </tr>
     
</tbody></table>
</fieldset>
<br><div class="table_options bottom_options">
                                  <div class="alert">
                                 		<strong>Warning!</strong><br> Hati Hati Dengan Proses Penghapusan Data ...
                                	   </div>
		 </div>	
<div style="display:none" id="actCutiPegawai">
	<div class="well light_blue" style="width:500px">
                            <div class="well-content_search_form search_form">
							<form id="aksiform" name="aksiform">
	<input type="hidden" id="idcuti" name="idcuti"> 

                                <table class="table table-hover">
                                   <thead>
                                      <tr>
                                         <th>Approve</th>
                                         <th><input type="radio" class="uniform" name="ra" id="ra" value="A"></th>
                                      </tr>
                                      <tr>
                                         <th>Tolak</th>
                                         <th><input type="radio" class="uniform" name="ra" id="ra" value="T"></th>
                                      </tr>
                                      <tr>
                                         <th>Kembalikan</th>
                                         <th><input type="radio" class="uniform" name="ra" id="ra" value="K"></th>
                                      </tr>
                                   </thead>
                                </table>
	</form>					

                            </div>
                        </div>
</div>	
<div id="tabledata">
										</div>
									 