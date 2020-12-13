<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
	<link href="<?php echo base_url()?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/stylesheet.css" rel="stylesheet">
 
    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.html">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.html">
                    <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.html">
                                   <link rel="shortcut icon" href="img/favicon.png">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body class="blue-login">

    <div class="login-container">
        <div class="login-header bordered">
            <h4>Login eCuti</h4>
        </div>
        <form id="logform" name="logform" action="<?php echo base_url() ?>home/loginAct" method="post">
            <div class="login-field">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username">
                <i class="icon-user"></i>
            </div>
            <div class="login-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
                <i class="icon-lock"></i>
            </div>
            <div class="login-button clearfix">
                <button type="submit" class="pull-right btn btn-large blue">Login</button>
            </div>
        </form>
    </div>

    <div id="forgot-pw" class="modal hide fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
            <h3>Forgot your password?</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <div class="span12">
                    <div class="form_row">
                        <label class="field_name">Email address</label>
                        <div class="field">
                            <div class="row-fluid">
                                <div class="span8">
                                    <input type="text" class="span12" name="email" placeholder="example@domain.com">
                                </div>
                                <div class="span4">
                                    <a href="#" class="btn btn-block blue">Reset password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<center> Powered by : IT Suzuki SBT Group</center>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui-1.10.3.js"></script>
    <script src="js/bootstrap.js"></script>



    <script>
        jQuery(document).ready(function($) {
            $('.uniform').uniform();
        });
    </script>

  </body>
</html>
