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
			url:'<?php echo base_url(); ?>menus/simpan/',		 
			type:'POST',
			data:$('#frmsave').serialize(),
			success:function(data){ 
			  	if(data!=''){
					 $( "#infodlg" ).html(data);
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false});					 
				} else {
				   window.location="<?php echo base_url() ?>menus";
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
                                <h5>Tambah Menu </h5>
                            </div>
								<div class="well-content no-search">
                                <form id="frmsave" name="frmsave">
                                  <h3>Detail Menu</h3>   
                                    <div class="form_row">
                                        <label class="field_name">Nama Menu</label>
                                        <div class="field">
                                            <input   type="text" value="<?php echo isset($inforole['name']) ? $inforole['name'] : '-'; ?>" class="input-xtralarge" name="name" id="name" placeholder=".input-small">
											  <input type="hidden" value="<?php echo isset($inforole['url']) ? $inforole['url'] : ''; ?>" class="input-small" name="id" id="id" placeholder=".input-small">
                                        </div>
                                    </div>
                                    <div class="form_row">
                                        <label class="field_name">Url</label>
                                        <div class="field">
                                            <input  style="width:300px"  type="text" value="<?php echo isset($inforole['url']) ? $inforole['url'] : '-'; ?>" class="input-small" name="url" id="url" placeholder=".input-small">
											 
                                        </div>
                                    </div>
                                      <div class="form_row">
                                        <label class="field_name">Urutan</label>
                                        <div class="field">
                                            <input   type="text" value="<?php echo isset($inforole['urut']) ? $inforole['urut'] : '-'; ?>" class="input-small" name="urut" id="urut" placeholder=".input-small">
											 
                                        </div>
                                    </div>
                                    
									<h3>&nbsp;</h3>
							    <div class="form_row"> </div>
                                    <div class="form_row">
                                        <div class="field">
                                            <a onclick="return confirmdlg()" class="blue btn">Submit</a>
                                            <a  href="<?php echo base_url() ?>menus" class="red btn">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

    <div id="confirm" style="display:none"> Anda Ingin Meyimpan data ini</div>     


  </body>
</html>
