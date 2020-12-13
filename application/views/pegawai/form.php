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
			url:'<?php echo base_url(); ?>pegawai/cekNik/',		 
			type:'POST',
			data:"nik="+nik,
			success:function(data){ 
			  	if(data!=''){
					 $( "#infodlg" ).html('Nik Sudah tersedia Harap Periksa Kembali ...');
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false,modal:true});		
					 $("#nik").val('');
				}  
			 }
		});		
		return false;
	}
	function save(){
		$.ajax({
			url:'<?php echo base_url(); ?>pegawai/simpan/',		 
			type:'POST',
			data:$('#frmsave').serialize(),
			success:function(data){ 
			  	if(data!=''){
					 $( "#infodlg" ).html(data);
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false});					 
				} else {
					  window.location="<?php echo base_url() ?>pegawai";
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
                                <h5>Tambah Data Pegawai </h5>
                            </div>
								<div class="well-content no-search">
                                <form id="frmsave" name="frmsave">
                                <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : ''; ?>">
                                  <h3>Detail Pegawai</h3>   
                                    <div class="form_row">
                                        <label class="field_name">Nik</label>
                                        <div class="field">
                                            <input   onchange="return cariPegawai()"    type="text" value="<?php echo isset($infouser['nik']) ? $infouser['nik'] : ''; ?>" class="input-small" name="nik" id="nik" placeholder="NIK">
											 /* Status On Change */
                                        </div>
                                    </div>
                                    <div class="form_row">
                                        <label class="field_name">Nama</label>
                                        <div class="field">
                                          <input id="nama" name="nama" type="text" value="<?php echo isset($infouser['nama']) ? $infouser['nama'] : ''; ?>" class="input-large"  placeholder="NAMA" />
                                        </div>
                                    </div>
									<div class="form_row">
                                        <label class="field_name">Level</label>
                                        <div class="field">
                                          	<?php echo isset($comboLevel) ? $comboLevel : '-'; ?>				 
                                        </div>
                                    </div>
									<div class="form_row">
                                        <label class="field_name">Lokasi Kerja</label>
                                        <div class="field">
                                           	<?php echo isset($comboCabang) ? $comboCabang : '-'; ?>	 	
                                        </div>
                                    </div>
                                    <div class="form_row">
                                        <label class="field_name">Unit Kerja</label>
                                        <div class="field">
                                           	<?php echo isset($comboUnit) ? $comboUnit : '-'; ?>	
                                        </div>
                                    </div>
                                    <div class="form_row">
                                        <label class="field_name">Jabatan</label>
                                        <div class="field">
                                           		<?php echo isset($comboJabatan) ? $comboJabatan : '-'; ?>	
                                        </div>
                                    </div>
									<hr>
									 
		<a href="#" onclick="return save()" class="blue btn">Simpan</a>
        <a href="<?php echo base_url()?>pegawai" class="grey btn">Batal</a>
    <div id="confirm" style="display:none"> Anda Ingin Meyimpan data ini</div>     


  </body>
</html>
