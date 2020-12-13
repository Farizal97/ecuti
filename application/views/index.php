<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>eCuti PT.Sejahtera Buana Trada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<link rel="shortcut icon" href="<?php echo base_url()?>images/logo.gif" type="image/x-icon" />
    <!-- Le styles -->
    <link href="<?php echo base_url()?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/stylesheet.css" rel="stylesheet">
     <script src="<?php echo base_url()?>js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.10.3.js"></script>
 
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>
<div id="infodlg" style="display:none"></div> 
    <header class="dark_grey"> <!-- Header start -->
        <a href="#" class="logo_image" style="width:200px"><span class="hidden-480">-Suzuki SBT | eCuti-</span></a>
        <ul class="header_actions pull-left hidden-480 hidden-768">
            <li rel="tooltip" data-placement="bottom" title="Hide/Show main navigation" ><a href="#" class="hide_navigation"><i class="icon-chevron-left"></i></a></li>
            <li rel="tooltip" data-placement="right" title="Change navigation color scheme" class="color_pick navigation_color_pick"><a class="iconic" href="#"><i class="icon-th"></i></a>
                <ul>
                    <li><a class="blue" href="#"></a></li>
                    <li><a class="light_blue" href="#"></a></li>
                    <li><a class="grey" href="#"></a></li>
                    <li><a class="dark_grey" href="#"></a></li>
                    <li><a class="pink" href="#"></a></li>
                    <li><a class="red" href="#"></a></li>
                    <li><a class="orange" href="#"></a></li>
                    <li><a class="yellow" href="#"></a></li>
                    <li><a class="green" href="#"></a></li>
                    <li><a class="dark_green" href="#"></a></li>
                    <li><a class="turq" href="#"></a></li>
                    <li><a class="dark_turq" href="#"></a></li>
                    <li><a class="purple" href="#"></a></li>
                    <li><a class="violet" href="#"></a></li>
                    <li><a class="dark_blue" href="#"></a></li>
                    <li><a class="dark_red" href="#"></a></li>
                    <li><a class="brown" href="#"></a></li>
                    <li><a class="black" href="#"></a></li>
                    <a class="dark_navigation" href="#">Dark navigation</a>
                </ul>
            </li>
        </ul>
        <ul class="header_actions">
            <li rel="tooltip" data-placement="left" title="Header color scheme" class="color_pick header_color_pick hidden-480"><a class="iconic" href="#"><i class="icon-th"></i></a>
                <ul>
                    <li><a class="blue set_color" href="#"></a></li>
                    <li><a class="light_blue set_color" href="#"></a></li>
                    <li><a class="grey set_color" href="#"></a></li>
                    <li><a class="dark_grey set_color" href="#"></a></li>
                    <li><a class="pink set_color" href="#"></a></li>
                    <li><a class="red set_color" href="#"></a></li>
                    <li><a class="orange set_color" href="#"></a></li>
                    <li><a class="yellow set_color" href="#"></a></li>
                    <li><a class="green set_color" href="#"></a></li>
                    <li><a class="dark_green set_color" href="#"></a></li>
                    <li><a class="turq set_color" href="#"></a></li>
                    <li><a class="dark_turq set_color" href="#"></a></li>
                    <li><a class="purple set_color" href="#"></a></li>
                    <li><a class="violet set_color" href="#"></a></li>
                    <li><a class="dark_blue set_color" href="#"></a></li>
                    <li><a class="dark_red set_color" href="#"></a></li>
                    <li><a class="brown set_color" href="#"></a></li>
                    <li><a class="black set_color" href="#"></a></li>
                </ul>
            </li>
            <li rel="tooltip" data-placement="bottom" title="2 new messages" class="messages"><a class="iconic" href="#"><i class="icon-envelope-alt"></i> 2</a>
                <ul class="dropdown-menu pull-right messages_dropdown">
                    <li>
                        <a href="#">
                            <img src="demo/avatar_06.png" alt="">
                            <div class="details">
                                <div class="name">Jane Doe</div>
                                <div class="message">
                                    Lorem ipsum Commodo quis nisi...
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="demo/avatar_05.png" alt="">
                            <div class="details">
                                <div class="name">Jane Doe</div>
                                <div class="message">
                                    Lorem ipsum Commodo quis nisi...
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="demo/avatar_04.png" alt="">
                            <div class="details">
                                <div class="name">Jane Doe</div>
                                <div class="message">
                                    Lorem ipsum Commodo quis nisi...
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="demo/avatar_05.png" alt="">
                            <div class="details">
                                <div class="name">Jane Doe</div>
                                <div class="message">
                                    Lorem ipsum Commodo quis nisi...
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="demo/avatar_06.png" alt="">
                            <div class="details">
                                <div class="name">Jane Doe</div>
                                <div class="message">
                                    Lorem ipsum Commodo quis nisi...
                                </div>
                            </div>
                        </a>
                    </li>
                    <a href="#" class="btn btn-block blue align_left"><span>Messages center</span></a>
                </ul>
            </li>
            <li class="dropdown"><a href="#">Hai, Selamat Datang <?php echo $this->session->userdata('NAMA'); ?> <i class="icon-angle-down"></i></a>
            </li>
            <li><a href="<?php echo base_url() ?>home/logout"><i class="icon-signout"></i> <span class="hidden-768 hidden-480">Keluar</span></a></li>
            <li class="responsive_menu"><a class="iconic" href="#"><i class="icon-reorder"></i></a></li>
        </ul>
    </header>

    <div id="main_navigation" class="dark_grey"> <!-- Main navigation start -->
        <div class="inner_navigation">
            <ul class="main">
 				 <?php  $this->load->view('menu'); ?>
			</ul>
        </div>
    </div>

    <div id="content"> <!-- Content start -->
      <div class="inner_content">
        <div class="widgets_area">
				<br><br>
				<h1><?php echo $judul; ?></h1>
                <hr>
                <div class="row-fluid" id="isiContent">					 
					 <?php $this->load->view($view); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

     <!--<script src="<?php echo base_url()?>js/bootstrap.js"></script>

    <script src=<?php echo base_url()?>"js/library/jquery.collapsible.min.js"></script>
    <script src="<?php echo base_url()?>js/library/jquery.mCustomScrollbar.min.js"></script>
    <script src="<?php echo base_url()?>js/library/jquery.mousewheel.min.js"></script>
    <script src="<?php echo base_url()?>js/library/jquery.uniform.min.js"></script>

    <script src="<?php echo base_url()?>js/library/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url()?>js/library/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url()?>js/library/jquery.easytabs.js"></script>
    <script src="<?php echo base_url()?>js/library/flot/excanvas.min.js"></script>
    <script src="<?php echo base_url()?>js/library/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url()?>js/library/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url()?>js/library/flot/jquery.flot.selection.js"></script>
    <script src="<?php echo base_url()?>js/library/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url()?>js/library/flot/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url()?>js/library/maps/jquery.vmap.js"></script>
    <script src="<?php echo base_url()?>js/library/maps/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url()?>js/library/maps/data/jquery.vmap.sampledata.js"></script>
    <script src="<?php echo base_url()?>js/library/jquery.autosize-min.js"></script>
    <script src="<?php echo base_url()?>js/library/charCount.js"></script>
    <script src="<?php echo base_url()?>js/library/jquery.minicolors.js"></script>
    <script src="<?php echo base_url()?>js/library/jquery.tagsinput.js"></script>
    <script src="<?php echo base_url()?>js/library/fullcalendar.min.js"></script>
    <script src="<?php echo base_url()?>js/library/footable/footable.js"></script>
    <script src="<?php echo base_url()?>js/library/footable/data-generator.js"></script>

    <script src="<?php echo base_url()?>js/library/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo base_url()?>js/library/bootstrap-timepicker.js"></script>
    <script src="<?php echo base_url()?>js/library/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url()?>js/library/bootstrap-fileupload.js"></script>
    <script src="<?php echo base_url()?>js/library/jquery.inputmask.bundle.js"></script>
    <script src="<?php echo base_url()?>js/flatpoint_core.js"></script>
    <script src="<?php echo base_url()?>js/forms.js"></script> -->

  </body>
</html>
