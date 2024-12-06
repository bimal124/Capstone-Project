<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php echo $template['title']; ?></title>

	<!-- Tell the browser to be responsive to screen width -->

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- favicon -->

	<link rel="shortcut icon" href="favicon.png">

	<!-- Bootstrap 3.3.6 -->

	<link rel="stylesheet" href="<?php echo site_url(ADMIN_CSS_DIR_FULL_PATH); ?>bootstrap.min.css">

	<!-- Font Awesome -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

	<!-- Ionicons -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	<!-- Theme style -->

	<link rel="stylesheet" href="<?php echo site_url(ADMIN_CSS_DIR_FULL_PATH); ?>AdminLTE.min.css">

	<!-- iCheck -->

	<link rel="stylesheet" href="<?php echo site_url(ADMIN_CSS_DIR_FULL_PATH); ?>blue.css">

	<link rel="stylesheet" href="<?php echo site_url(ADMIN_CSS_DIR_FULL_PATH); ?>emts.css">



	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->

	<style type="text/css">



	#box h1 {

		background: url(../assets/admin_images/logo.png) no-repeat center;

		font-family: "Trebuchet MS", sans-serif;

		font-size: 18px;

		font-style: normal;

		font-weight: normal;

		text-transform: normal;

		letter-spacing: normal;

		line-height: 1.4em;

		padding: 20px 0 0px 0;

		min-height: 85px;

		color: white;

		margin: 0;

	}

	</style>

</head>

<body class="hold-transition login-page">

	<div class="login-box">

		<div id="box" class="login-logo">

			<h1></h1>

		</div>

		<!-- /.login-logo -->

		<?php echo $template['body']; ?>

		<!-- /.login-box-body -->

	</div>

	<!-- /.login-box -->



	<!-- jQuery 2.2.3 -->

	<script src="<?php echo site_url(ADMIN_JS_DIR_FULL_PATH); ?>jquery-2.2.3.min.js"></script>

	<!-- Bootstrap 3.3.6 -->

	<script src="<?php echo site_url(ADMIN_JS_DIR_FULL_PATH); ?>bootstrap.min.js"></script>

	<script src="<?php echo site_url(ADMIN_JS_DIR_FULL_PATH); ?>jquery.validate-1.11.1.min.js" ></script>

	<script src="<?php echo site_url(ADMIN_JS_DIR_FULL_PATH); ?>admin-login.js" ></script>

</body>

</html>



<script src="<?php echo site_url(ADMIN_JS_DIR_FULL_PATH); ?>icheck.min.js"></script>

<script>

  $(function () {

    $('input').iCheck({

      checkboxClass: 'icheckbox_square-blue',

      radioClass: 'iradio_square-blue',

      increaseArea: '20%' // optional

    });

  });



 </script>