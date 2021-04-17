      <!-- Page Banner ______________________ -->

			<div class="page-banner">

				<div class="opacity">

					<div class="conatiner">

						<h3>Change Password</h3>

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

						<li class="active">Change Password</li>

					</ul>

				</div> <!-- /.container -->

			</div> <!-- /.page-breadcrum -->


			<!-- Contact Us Page ___________________ -->

			<div class="quick-message1 contact-us-page">
  
				<div class="container">

					<div class="quick-message-form login_page float-center wow fadeInRight theme-contact-us-form" style="visibility: hidden; animation-name: none;">
							
							<?php if( $this->session->flashdata('waring_message') ){ ?>
								<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Notice! </strong> <?php echo $this->session->flashdata('waring_message'); ?>
								</div>
							<?php  }?> 
							
							<?php if( $this->session->flashdata('success_message') ){ ?>
								<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Success! </strong> <?php echo $this->session->flashdata('success_message'); ?>
								</div>
							<?php  }?> 
							
							<?php if( $this->session->flashdata('error_message') ){ ?>
								<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Wrong! </strong> <?php echo $this->session->flashdata('error_message'); ?>
								</div>
							<?php  }?> 
								
						<form action="<?php echo base_url('wincon/change_password'); ?>" method="post" class="form-validation" autocomplete="off" novalidate="novalidate">

						<h4 class="quick-registration">Change Password</h4>	

							<input type="password" name="old_password" placeholder="Old Password" value="<?php  if(set_value('old_password')){ echo set_value('old_password');  }?>" >
							<span class="error"><?php  echo   form_error('old_password'); ?></span>
							
							<input type="password" name="new_password" placeholder="New Password" value="" >
							<span class="error"><?php  echo   form_error('new_password'); ?></span>
							
							<input type="password" name="re_password" placeholder="Confirm Password" value="" >
							<span class="error"><?php  echo   form_error('re_password'); ?></span>

							<button class="theme-button tran3s p-color-bg">Change password</button>

						</form>



						<!-- Contact alert -->

						<div class="alert_wrapper" id="alert_success">

							<div id="success">

								<button class="closeAlert"><i class="fa fa-times" aria-hidden="true"></i></button>

								<div class="wrapper">

					               	<p>Your message was sent successfully.</p>

					               </div>

					           </div>

					       </div> <!-- End of .alert_wrapper -->

					       <div class="alert_wrapper" id="alert_error">

					           <div id="error">

					           	<button class="closeAlert"><i class="fa fa-times" aria-hidden="true"></i></button>

					           	<div class="wrapper">

					               	<p>Sorry!Something Went Wrong.</p>

					               </div>

					           </div>

					       </div> <!-- End of .alert_wrapper -->

					</div> <!-- /.quick-message-form -->

				</div>

			</div> <!-- /.quick-message -->