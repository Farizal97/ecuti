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
	});
	  
	</script>
 <div class="span12" style="margin-left:0px">
 
											<div class="well grey">
												<div class="well-header">
													<h5>List Pegawai </h5>
                                                   <?php if($this->session->userdata('STATUS') =='0') { ?>
                                                    <a   style="float:right;margin:5px" href="<?php echo base_url().'pegawai/addForm/'; ?>" class="dark_green btn">Tambah Data Pegawai</a> <?php } ?>
													</div>
													<div class="well-content">
													<div class="table_options top_options">
													</div>

 <table class="table multimedia table-striped table-hover">
                                    <thead>
                                        <tr>
                                           	<th>Nik Pegawai </th>
                                            <th>Nama Pegawai </th>
                                            <th>Lokasi Kerja </th>
                                            <th>Level / Pangkat </th>
                                            <th>Unit Kerja </th>
                                            <th>Jabatan</th>
                                            <th>Status Pegawai </th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									 	<?php  if(!empty($query)) { foreach($query as $row) { ?> 
                                        <tr>
                                          
                                            <td style="text-align:center;font-weight:bold">
											<span class="label label-warning"><?php echo $row->nik ?></span>
											</td>
                                            <td><?php echo $row->nama ?></td>
                                            <td><?php echo $row->nama_cabang ?></td>
                                            <td><?php echo $row->kd_level ?></td>
                                            <td><?php echo $row->nama_unit_kerja ?></td>
                                            <td><?php echo $row->nama_jabatan ?></td>
                                            <td>
											<?php if($row->status_aktif='Aktif'){ ?>
											<span class="label  label-success">Aktif</span>
											<?php } else if ($row->status_aktif=='Pensiun') { ?>
											<span class="label  label-success">Pensiun</span>
											<?php }?>											</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn" href="<?php echo base_url().'pegawai/addForm/'.$row->id ?>">
													<i class="icon-arrow-right"></i></a>
                                                    <a onclick="return deletePegawai(<?php echo $row->id ?>)"class="btn" href="#"><i class="icon-trash"></i></a>                                                </div>                                            </td>
                                        </tr>
										
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
