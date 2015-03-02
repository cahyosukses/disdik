
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>LOGIN ADMINISTRATOR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_URL()?>assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #000066;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
	margin-bottom: 10px;
	text-align: center;
	font-family: Georgia, "Times New Roman", Times, serif;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="<?php echo base_URL()?>assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


  </head>

  <body>
  
  
  <div class="container">
      <form class="form-signin" action="<?php echo base_URL()?>tampil/do_login" method="post">            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_URL()?>assets/logo.jpg" style="width: 150px; height: 150px; display: inline; margin: -5px 0 50px 0" align="bottom">
      <h2 class="form-signin-heading">Administrator</h2>
        <h5 class="form-signin-heading">Dinas Pendidikan Provinsi Jambi</h5>
            </br></br>
<input type="text" class="input-block-level" placeholder="Username" name="u" autofocus>
        <input type="password" class="input-block-level" placeholder="Password" name="p">
        <button class="btn btn-large btn-primary" type="submit">Masuk</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>
