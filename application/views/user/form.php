     <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <link rel="stylesheet" href="<?php echo base_url();?>css/themes/jquery.ui.all.css" type="text/css" />
  	<script>
	$(document).ready(function() {
			$( ".datepicker" ).datepicker();
	});

	function cariPegawai(){
		var nik=$("#nik").val();
		$.ajax({
			url:'<?php echo base_url(); ?>user/addForm/',		 
			type:'POST',
			data:$('#frmsave').serialize(),
			success:function(data){ 
			  	if(data==''){
					 $( "#infodlg" ).html('Nik Tidak tersedia Harap Periksa Kembali ...');
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false});					 
				} else {
				   $("#isiContent").html(data);
				}
			 }
		});		
	}
	function save(){
		$.ajax({
			url:'<?php echo base_url(); ?>user/simpan/',		 
			type:'POST',
			data:$('#frmsave').serialize(),
			success:function(data){ 
			  	if(data!=''){
					 $( "#infodlg" ).html(data);
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false});					 
				} else {
					 window.location="<?php echo base_url() ?>user";
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
	  	
				<?php   isset($infouser['status']) ? $st=$infouser['status'] : $st=''; ?>
                <?php   isset($infouser['role']) ? $rl=$infouser['role'] : $rl=''; ?>
                     <div class="span6">
                        <div class="well grey">
                            <div class="well-header">
                                <h5>Tambah / Ubah User   </h5>
                            </div>
								<div class="well-content no-search">
                                <form id="frmsave" name="frmsave">
                                  
									<h3>Detail User </h3>
                                    
                                                                        <div class="form_row">
                                        <label class="field_name">Nik</label>
                                        <div class="field">
                                            <input  onchange="return cariPegawai()"   type="text" value="<?php echo isset($infouser['nik']) ? $infouser['nik'] : '-'; ?>" class="input-small" name="nik" id="nik" placeholder=".input-small">
											 
                                        </div>
                                    </div>
                                    <div class="form_row">
                                        <label class="field_name">Nama</label>
                                        <div class="field">
                                           : <strong><?php echo isset($infouser['nama']) ? $infouser['nama'] : '-'; ?></strong>
                                        </div>
                                    </div>
									<div class="form_row">
                                        <label class="field_name">Level</label>
                                        <div class="field">
                                            <input  readonly="" type="hidden" value="<?php echo isset($infouser['kd_level']) ? $infouser['kd_level'] : '-'; ?>" class="input-large" name="level" placeholder="Standard input">
											: <strong><?php echo isset($infouser['kd_level']) ? $infouser['kd_level'] : '-'; ?></strong>
                                        </div>
                                    </div>
									<div class="form_row">
                                        <label class="field_name">Lokasi Kerja</label>
                                        <div class="field">
                                            <input  readonly="" type="hidden" value="<?php echo isset($infouser['kd_cabang']) ? $infouser['kd_cabang'] : '-'; ?>" class="input-large" name="cabang" placeholder="Standard input">
											: <strong><?php echo isset($infouser['nama_cabang']) ? $infouser['nama_cabang'] : '-'; ?></strong>
                                        </div>
                                    </div>
                                    <div class="form_row">
                                        <label class="field_name">Unit Kerja</label>
                                        <div class="field">
                                            <input  readonly="" type="hidden" value="<?php echo isset($infouser['kd_unit_kerja']) ? $infouser['kd_unit_kerja'] : '-'; ?>" class="input-large" name="unit_kerja" placeholder=".input-large">
											: <strong><?php echo isset($infouser['nama_unit_kerja']) ? $infouser['nama_unit_kerja'] : '-'; ?></strong>
                                        </div>
                                    </div>
                                    <div class="form_row">
                                        <label class="field_name">Jabatan</label>
                                        <div class="field">
                                            <input  readonly="" type="hidden"  value="<?php echo isset($infouser['kd_jabatan']) ? $infouser['kd_jabatan'] : '-'; ?>" class="input-large" name="jabatan">
											: <strong><?php echo isset($infouser['nama_jabatan']) ? $infouser['nama_jabatan'] : '-'; ?></strong>
                                        </div>
                                    </div>
									<hr>
                                    
									 <div class="form_row">
                                      <input type="hidden"  value="<?php echo $id?>" name="id" id="id" class="input-large"> 
                                        <label class="field_name">Username</label>
                                        <div class="field">
                                           <input type="text"  value="<?php echo isset($infouser['username']) ? $infouser['username'] : ''; ?>" name="username" id="username" class="input-large"   placeholder="USERNAME"> 
										</div>
									 </div>
									 <div class="form_row">
                                        <label class="field_name">Password</label>
                                        <div class="field">
                                           <input type="password"  value="" name="password" id="password" class="input-large"   placeholder="PASSWORD"> 
										</div>
									 </div>
									 	
									 <div class="form_row">
                                        <label class="field_name">Jenis User</label>
                                        <div class="field">
                                           <select class="span6" id="tipeuser" name="tipeuser">
                                                <option  <?php if($st==0){ echo 'selected="selected"';} ?> value="0">Administrator</option>
                                                <option  <?php if($st==1){ echo 'selected="selected"';} ?> value="1">User</option>
                                            </select>
 										</div>
                                    </div>
									 <div class="form_row">
                                        <label class="field_name">Role</label>
                                        <div class="field">
                                           <select class="span6" id="role" name="role">
                                              <?php  if(!empty($role)) { foreach($role as $role) { ?> 
                                                <option  <?php if($rl==$role->id){ echo 'selected="selected"';} ?> value="<?php echo $role->id?>"><?php echo $role->role?></option>
                                              <?php }} ?>
                                            </select>
 										</div>
                                    </div>
                                    <div class="form_row">
                                        <div class="field">
                                            <a onclick="return confirmdlg()" class="blue btn">Submit</a>
                                            <a  href="<?php echo base_url() ?>user" class="red btn">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

    <div id="confirm" style="display:none"> Anda Ingin Meyimpan data ini</div>     


  </body>
</html>
