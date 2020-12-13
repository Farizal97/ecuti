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
<div class="span12" style="margin-left:0px">
 
											<div class="well grey">
												<div class="well-header">
													<h5>List Pegawai </h5> <a style="float:right;margin:5px" href="<?php echo base_url();?>cuti/add" class="dark_green btn">Tambah Data Cuti</a>
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
											<th>Status Pengajuan Cuti </th>
											 
                                        </tr>
                                    </thead>
                                    <tbody>
									 	<?php  if(!empty($query)) { foreach($query as $row) { ?> 
                                        <tr>
                                            <td>
											<img onclick="return detailData(<?php echo $row->cutiid ?>)" style="height:15px;margin-left:10px;;width:15px" src="<?php echo base_url()?>img/plus.png" 
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
											<?php }?>
											</td>
                                            <td>
											<?php if($row->status=='P'){ ?>
											<span class="label label-important">Pengajuan</span>
											<?php } else if ($row->status=='A') { ?>
											<span class="label  label-success">Disetujui</span>
											<?php } else if ($row->status=='T') { ?>
											<span class="label  label-warning">Ditolak</span>											
											<?php } else if ($row->status=='K') { ?>
											<span class="label  label-warning">Dikembalikan</span>
											<?php } ?>
											</td>
                                            
											 
                                        </tr>
										<tr style="display:none" id="tr<?php echo $row->cutiid ?>">
											<td colspan="10" id="detail<?php echo $row->cutiid ?>">
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