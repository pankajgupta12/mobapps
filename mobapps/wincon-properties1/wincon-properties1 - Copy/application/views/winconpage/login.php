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

						<li class="active">login</li>

					</ul>

				</div> <!-- /.container -->

			</div> <!-- /.page-breadcrum -->


			<!-- Contact Us Page ___________________ -->

			<div class="quick-message1 contact-us-page">

				<div class="container">

					<div class="quick-message-form login_page float-center wow fadeInRight theme-contact-us-form" style="visibility: hidden; animation-name: none;">
							
							<?php if( $this->session->flashdata('message') ){ ?>
								<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Wrong! </strong> <?php echo $this->session->flashdata('message'); ?>
								</div>
							<?php  }?> 
								
						<form action="<?php echo base_url('Wincon/login'); ?>" method="post" class="form-validation" autocomplete="off" novalidate="novalidate">

						<h4 class="quick-registration">Login</h4>	

							<input type="email" name="email"  placeholder="User Name" value="<?php  if(set_value('email')){echo set_value('email');  }?>" >
							<span class="error"><?php  echo   form_error('email'); ?></span>

							<input type="password" name="password" placeholder="Password" value="<?php  if(set_value('password')){ echo set_value('password');  }?>" >
							 <span class="error"><?php  echo   form_error('password'); ?></span>

							<button class="theme-button tran3s p-color-bg">Login</button><a class="forget_pwd" href="<?php echo base_url('wincon/forget_password'); ?>" style="float:right; margin-top: -34px;">Forget Password</a>

						</form>						

					</div> <!-- /.quick-message-form -->

				</div>

			</div> <!-- /.quick-message -->