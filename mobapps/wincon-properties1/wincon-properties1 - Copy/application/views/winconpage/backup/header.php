<!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="UTF-8">

		<!-- For IE -->

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- For Resposive Device -->

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Property Listing</title>



		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



		<!-- Main style sheet -->

		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/css/style.css"></link>

		<!-- responsive style sheet -->

		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>files/css/responsive.css"></link>

		<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700"></link>

		<style type="text/css">

		.gm-style .gm-style-mtc label,.gm-style .gm-style-mtc div{font-weight:400}

		</style>

		<style type="text/css">

		.gm-style-pbc{transition:opacity ease-in-out;background-color:rgba(0,0,0,0.45);text-align:center}.gm-style-pbt{font-size:22px;color:white;font-family:Roboto,Arial,sans-serif;position:relative;margin:0;top:50%;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}

		</style>

		<style type="text/css">

		.gm-style .gm-style-cc span,.gm-style .gm-style-cc a,.gm-style .gm-style-mtc div{font-size:10px}

		</style>

		<style type="text/css">

		@media print {  .gm-style .gmnoprint, .gmnoprint {    display:none  }}@media screen {  .gm-style .gmnoscreen, .gmnoscreen {    display:none  }}

		</style>

		<style type="text/css">

		.gm-style{font-family:Roboto,Arial,sans-serif;font-size:11px;font-weight:400;text-decoration:none}.gm-style img{max-width:none}

		</style>

		<!-- Fix Internet Explorer ______________________________________-->



		<!--[if lt IE 9]>

			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

			<script src="vendor/html5shiv.js"></script>

		<![endif]-->

		  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

		  <script type="text/javascript" src="<?php echo base_url(); ?>files/js/jquery.flexslider.js"></script>

		  <script type="text/javascript">

		   $(window).load(function() {

			 $('.flexslider').flexslider({

			animation: "slide"

			 });

		   });

		  </script>	
	</head>
	<body>

		<div class="main-page-wrapper">
		<div id="black_layer" style="display:none;">&nbsp;</div>



			<!-- Header _____________________________ -->

			<header class="p-color-bg">

				<div class="container">

					<div class="float-left">

						<p><i class="fa fa-map-marker" aria-hidden="true"></i> 2799 Mainroad Ave., NY Diego, Bd 1704</p>

					</div> <!-- /.float-left -->

					<div class="float-right">

						<ul>

							<li><a href="#" class="tran3s">(+88) 01712570051</a></li>

							<li><a href="#" class="tran3s">info@demo.com</a></li>

							<li><a href="#" class="tran3s"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

							<li><a href="#" class="tran3s"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>

							<li><a href="#" class="tran3s"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

							<li><a href="#" class="tran3s"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>

						</ul>

					</div> <!-- /.float-right -->

				</div> <!-- /.container -->

			</header>
			
				<!-- Menu ________________________ -->

			<div class="main-menu">

				<div class="container">

					<a href="<?php echo base_url('Wincon'); ?>" class="float-left logo"><img src="<?php echo base_url(); ?>files/images/logo.png" /></a>



					<!-- Menu -->

					<nav class="navbar float-right">

					   <!-- Brand and toggle get grouped for better mobile display -->

					    <div class="navbar-header">

					      <button type="button" class="navbar-toggle collapsed p-color-bg" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">

					       <span class="sr-only">Toggle navigation</span>

					       Menu

					       <i class="fa fa-angle-down" aria-hidden="true"></i>
					      </button>

					    </div>

					   <!-- Collect the nav links, forms, and other content for toggling -->

					    <div class="collapse navbar-collapse" id="navbar-collapse-1">
					        <ul class="nav navbar-nav">
								<li><a href="<?php echo base_url('wincon'); ?>">Home</a></li>
						
								<?php if($this->session->userdata('user_id') != "" && $this->session->userdata('email') !="") { ?>
									<li><a href="#">Property Account</a>
										<ul class="drop_down">
											<li><a href="#">Edit Profile</a></li>
											<li><a href="#">Change Password</a></li>
										</ul>
									</li>
									<li><a href="<?php echo base_url('wincon/property_listing'); ?>">My Property Listing</a></li>
								    <li><a href="<?php echo base_url('wincon/logout'); ?>">Logout</a></li>
								<?php  } else { ?>
								 
									<li><a href="<?php echo base_url('wincon/login'); ?>">Login</a></li>
									<li><a href="<?php echo base_url('wincon/register'); ?>">Register</a></li>
								<?php  } ?>
					        </ul>
					    </div><!-- /.navbar-collapse -->	

					</nav>

					<button class="search-button p-color-bg" id="searchDropdown"><i class="fa fa-search-minus" aria-hidden="true"></i></button>

				</div> <!-- /.container -->

				<form action="#" class="p-color-bg search-form tran3s">

					<div class="container">

						<input type="text" placeholder="To Search Start Typing...">

						<div class="close-search"><i class="fa fa-times" aria-hidden="true"></i></div>

					</div>

				</form>

			</div> <!-- /.main-menu -->
		
<script>	
	$(document).ready(function(){		
		$("#add_property_btn").click(function(){	
		$("#add_property").show();		
		$("#black_layer").show();	
		});		
		$("#remove_pop").click(function(){	
		$("#add_property").hide();			
		$("#black_layer").hide();	
		});		
	});		
</script>	

<script type="javascript">	
	function process(v){		
		var value = parseInt(document.getElementById('v').value);	
		value+=v;		
		document.getElementById('v').value = value;		
	}		
</script>	

<script type="text/javascript">
	$(document).ready(function(){
		$(".myImg").click(function(){
			$("#myModal").show();
		});
		$(".close").click(function(){
			$("#myModal").hide();	
		});
	});

</script>
