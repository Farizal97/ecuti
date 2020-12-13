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
			url:'<?php echo base_url(); ?>cuti/detailPegawai/'+id,		 
			type:'POST',
			data:$('#frmsave').serialize(),
			success:function(data){ 
				$("#detail"+id).html('');  
				$("#detail"+id).append(data);  
			}  
		});		
	</script>
 <div id="tabledata">
<div class="span12">
											<div class="well grey">
												<div class="well-header">
													<h5>List Pegawai </h5>
													</div>
													<div class="well-content">
													<div class="table_options top_options">
													</div>

 <table class="table multimedia table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Detail</th>
                                            <th>Nik Pegawai </th>
                                            <th>Nama Pegawai </th>
                                            <th>Lokasi Kerja </th>
                                            <th>Unit Kerja </th>
                                            <th>Jabatan</th>
                                            <th>Status Pegawai </th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									 	<?php  if(!empty($query)) { foreach($query as $row) { ?> 
                                        <tr>
                                            <td>
											<img onclick="return detailData(<?php echo $row->id ?>)" style="height:15px;margin-left:10px;;width:15px" src="<?php echo base_url()?>img/plus.png" 
											alt="Avatar"></td>
                                            <td style="text-align:center;font-weight:bold">
											<span class="label label-warning"><?php echo $row->nik ?></span>
											</td>
                                            <td><?php echo $row->nama ?></td>
                                            <td><?php echo $row->nama_cabang ?></td>
                                            <td><?php echo $row->nama ?></td>
                                            <td><?php echo $row->nama_jabatan ?></td>
                                            <td>
											<?php if($row->status_aktif='Aktif'){ ?>
											<span class="label  label-success">Aktif</span>
											<?php } else if ($row->status_aktif=='Pensiun') { ?>
											<span class="label  label-success">Pensiun</span>
											<?php }?>											</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn" href="<?php echo base_url().'cuti/add/'.$row->id ?>">
													<i class="icon-arrow-right"></i></a>
                                                    <a class="btn" href="#"><i class="icon-trash"></i></a>                                                </div>                                            </td>
                                        </tr>
										<tr style="display:none" id="tr<?php echo $row->id ?>">
											<td colspan="8" id="detail<?php echo $row->id ?>">
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