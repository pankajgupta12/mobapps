<?php  
  if(isset($_GET['rdcd']) != '' && isset($_GET['id']) != ''){
	 $action = base_url('wincon/new_password?rdcd='.$randcode.'&id='.$emaiidget);
 }else {
	 redirect(base_url('wincon/forget_password'));
	  //$action = base_url('wincon/forget_password');
 }
   
?>    

	<!-- Page Banner ______________________ -->

			<div class="page-banner">

				<div class="opacity">

					<div class="conatiner">

						<h3>Login</h3>

						<span></span>

					</div>

				</div> <!-- /.opacity -->

			</div> <!-- /.page-banner -->

<!-- Page Breadcrumb __________________ -->

			<div class="page-breadcrum">

				<div class="container">

					<ul>

						<li><a href="index.html">Home</a></li>

						<li>/</li>

						<li class="active">Generate New Password</li>

					</ul>

				</div> <!-- /.container -->

			</div> <!-- /.page-breadcrum -->







			<!-- Contact Us Page ___________________ -->

			<div class="quick-message1 contact-us-page">

				<div class="container">

					<div class="quick-message-form login_page float-center wow fadeInRight theme-contact-us-form" style="visibility: hidden; animation-name: none;">
							
							<?php if( $this->session->flashdata('error_message') ){ ?>
								<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Wrong! </strong> <?php echo $this->session->flashdata('error_message'); ?>
								</div>
							<?php  }?> 
							
							<?php if( $this->session->flashdata('success_message') ){ ?>
								<div style='height:300px;'><h3><?php echo $this->session->flashdata('success_message'); ?><h3></div>
							<?php  }else { ?> 
								
								<form action="<?php echo $action; ?>" method="post" class="form-validation" autocomplete="off" novalidate="novalidate">

								<h4 class="quick-registration">Generate New Password</h4>	

									<input type="password" name="new_password"  placeholder="Enter new password" value="" >
									<span class="error"><?php  echo   form_error('new_password'); ?></span>

									<input type="password" name="confirm_password" placeholder="confirm Password" value="" >
									 <span class="error"><?php  echo   form_error('confirm_password'); ?></span>

									<button class="theme-button tran3s p-color-bg">Save</button>

								</form>
							<?php  } ?>



					</div> <!-- /.quick-message-form -->

				</div>

			</div> <!-- /.quick-message -->