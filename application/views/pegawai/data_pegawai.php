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
	 function getdata(){
		  var nama_anggota=$("#nama_anggota").val();
	 	  $.ajax({
			  type: "POST",
			  data: "nama_anggota="+nama_anggota,
			  url:'<?php echo base_url(); ?>pegawai/search/',	
			  beforeSend: function() {
				$(".well-content").html("<div class='loading_div'><img src='<?php echo base_url() ?>img/loading.gif'></div>");
			  },
			  success: function(msg) {
				$("#tabledata").html(msg);
			  }
			});
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
 <div id="tabledata"> </div>
									
										