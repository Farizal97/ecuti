 		 <script>
 	$(document).ready(function() {
		 loadchart1();
 	});
	function loadchart1(){
		  var bulan=$("#bulan").val();
		  var tahun=$("#tahun").val();
		 $('#container').html('<center><img style="margin-top:50px" src="<?php echo base_url();?>img/loading.gif"></center>');
		 $('#container').load('<?php echo base_url();?>home/dashboard1/'+bulan+'/'+tahun);
	 }
	 
	</script>


        						    <div class="well Blue">
												<div class="well-header">
												<?php  echo $tahun; ?><?php  echo $bulan; ?>
											 	</div>
										
													<div class="well-content" style="min-height:1500px">
													 
								 
  									<div id="container">
                                      
									</div>
                                	 
								 </div>
								 
								 
											  </div>
											</div>
										</div>
                                     			    