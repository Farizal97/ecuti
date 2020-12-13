     <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <link rel="stylesheet" href="<?php echo base_url();?>css/themes/jquery.ui.all.css" type="text/css" />
  	<script>
	$(document).ready(function() {
			$( ".datepicker" ).datepicker();
	});


	function save(){
		$.ajax({
			url:'<?php echo base_url(); ?>role/simpan/',		 
			type:'POST',
			data:$('#frmsave').serialize(),
			success:function(data){ 
			  	if(data!=''){
					 $( "#infodlg" ).html(data);
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false});					 
				} else {
					  window.location="<?php echo base_url() ?>role";
				}
			 }
		});		
	}
	function confirmdlg(){
					$("#confirm").dialog({
					 resizable: false,
					 modal: true,
					 title:"Info...",
					 draggable: false,
					 width: 'auto',
					 
					 height: 'auto',
					 buttons: {
					 "Ya": function(){
						 save();   
						  $(this).dialog("close");
					  },
					  "Tutup": function(){
						   $(this).dialog("close");
						}
					 }
				  });
 
			}
			
	</script>
	  	

                     <div class="span6">
                        <div class="well grey">
                            <div class="well-header">
                                <h5>Tambah User Pegawai </h5>
                            </div>
								<div class="well-content no-search">
                                <form id="frmsave" name="frmsave">
                                  <h3>Detail Role</h3>   
                                    <div class="form_row">
                                        <label class="field_name">Nama Role</label>
                                        <div class="field">
                                            <input style="width:300px"  type="text" value="<?php echo isset($inforole['role']) ? $inforole['role'] : '-'; ?>" class="input-small" name="role" id="role" placeholder=".input-small">
											  <input type="hidden" value="<?php echo isset($inforole['id']) ? $inforole['id'] : ''; ?>" class="input-small" name="id" id="id" placeholder=".input-small">
                                        </div>
                                    </div>
                                     <div class="form_row"> </div>
                                    <div class="form_row">
                                        <div class="field">
                                            <?php echo $menuUp ?>
                                        </div>
                                    </div>
									<h3>&nbsp;</h3>
							    <div class="form_row"> </div>
                                    <div class="form_row">
                                        <div class="field">
                                            <a onclick="return confirmdlg()" class="blue btn">Submit</a>
                                            <a  href="<?php echo base_url() ?>role" class="red btn">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

    <div id="confirm" style="display:none"> Anda Ingin Meyimpan data ini</div>     


  </body>
</html>
