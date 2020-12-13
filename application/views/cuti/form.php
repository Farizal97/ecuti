     <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <link rel="stylesheet" href="<?php echo base_url();?>css/themes/jquery.ui.all.css" type="text/css" />
  	<script>
	$(document).ready(function() {
			var nik=$("#nik").val();
			if(nik!=''){
			<?php if($this->session->userdata('STATUS')=='1') {  if (empty($infouser['nik'])) { ?>
				var nik=$("#nik").val();
						$.ajax({
							url:'<?php echo base_url(); ?>cuti/addForm/',		 
							type:'POST',
							data:"nik="+nik,
							success:function(data){ 
								if(data==''){
									 $( "#infodlg" ).html('Nik Tidak tersedia Harap Periksa Kembali ...');
									 $( "#infodlg" ).dialog({ title:"Info...", draggable: false,modal: true});					 
								} else {
								   $("#isiContent").html(data);
								}
							 }
						});
				<?php } } ?>
			}
			$( ".datepicker" ).datepicker();
	});

	function cariPegawai(){
		var nik=$("#nik").val();
		$.ajax({
			url:'<?php echo base_url(); ?>cuti/addForm/',		 
			type:'POST',
			data:"nik="+nik,
			 
			success:function(data){ 
			
			  	if(data==''){
					 $( "#infodlg" ).html('Nik Tidak tersedia Harap Periksa Kembali ...');
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false,modal: true});					 
				} else {
				   $("#isiContent").html(data);
				}
			 }
		});		
	}
	function save(){
		$.ajax({
			url:'<?php echo base_url(); ?>cuti/simpan/',		 
			type:'POST',
			data:$('#frmsave').serialize(),
			success:function(data){ 
			  	if(data!=''){
					 $( "#infodlg" ).html(data);
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false,modal: true});					 
				} else {
					 window.location="<?php echo base_url() ?>cuti";
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
                                <h5>Tambah Cuti Pegawai </h5>
                            </div>
								<div class="well-content no-search">
                                <form id="frmsave" name="frmsave">
                                  <h3>Detail Pegawai</h3>   
                                    <div class="form_row">
                                        <label class="field_name">Nik</label>
                                        <div class="field">
                                        <?php if($this->session->userdata('STATUS')!='1') { ?>
                                            <input  onchange="return cariPegawai()"   type="text" value="<?php echo isset($infouser['nik']) ? $infouser['nik'] : '-'; ?>" class="input-small" name="nik" id="nik" placeholder=".input-small">
										<?php } else { ?>
                                            <input  readonly="readonly" onchange="return cariPegawai()"   type="text" value="<?php echo $this->session->userdata('NIK'); ?>" class="input-small" name="nik" id="nik" placeholder=".input-small">
                                        <?php } ?>	 
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
									<h3>Detail Cuti</h3>
									
									<div class="form_row">
                                        <label class="field_name">Sisa Cuti</label>
                                        <div class="field">
                                          <label style="font-family:Tahoma;font-size:30px"> 
										  <?php echo isset($sisacuti) ? $sisacuti : '-'; ?> <strong>Hari </strong></label>&nbsp;
										  <input type="hidden"  value="
										  <?php echo isset($sisacuti) ? $sisacuti : '-'; ?>" name="sisa" id="sisa"> 
                                        </div>
                                    </div>
									<div class="form_row">
                                        <label class="field_name">Tanggal Pengambilan Cuti</label>
                                        <div class="field">
                                          	 <input  placeholder="TANGGAL MULAI CUTI" class="datepicker" size="16" type="text" name="tgl_mulai" id="tgl_mulai" >
											 <input placeholder="TANGGAL SELESAI CUTI"  class="datepicker" size="16" type="text" name="tgl_selesai" id="tgl_selesai" >
										</div>
                                    </div>
									 <div class="form_row">
                                        <label class="field_name">SK Cuti</label>
                                        <div class="field">
                                            <input type="text"  value="" name="sk" id="sk" class="input-large"   placeholder="SK CUTI"> 
											<input placeholder="TANGGAL SK CUTI"  class="datepicker" size="16" type="text" name="tgl_sk" id="tgl_sk" >
										</div>
                                    </div>
									<div class="form_row">
										<label class="field_name">Alamat Selama Cuti</label>
										<div class="field">
											<textarea placeholder="Alamat Lengkap selama cuti" id="alamat" name="alamat" class="span12" cols="20" rows="5"></textarea>
										</div>
									</div>
									<div class="form_row">
                                        <label class="field_name">Alasan Cuti</label>
                                        <div class="field">
                                            <textarea  placeholder="Masukan Alasan Cuti (Max 200 Karakter)" id="ket" name="ket" class="span12" cols="40" rows="5"></textarea>
                                        </div>
                                    </div>
									
                                    <div class="form_row">
                                        <div class="field">
                                            <a onclick="return confirmdlg()" class="blue btn">Submit</a>
                                            <a  href="<?php echo base_url() ?>" class="red btn">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

    <div id="confirm" style="display:none"> Anda Ingin Meyimpan data ini</div>     


  </body>
</html>
