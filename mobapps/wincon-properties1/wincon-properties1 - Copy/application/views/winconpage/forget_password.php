      <!-- Page Banner ______________________ -->

			<div class="page-banner">

				<div class="opacity">

					<div class="conatiner">

						<h3>Forget Password</h3>

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

						<li class="active">Forget Password</li>

					</ul>

				</div> <!-- /.container -->

			</div> <!-- /.page-breadcrum -->







			<!-- Contact Us Page ___________________ -->

			<div class="quick-message1 contact-us-page">

				<div class="container">

					<div class="quick-message-form login_page float-center wow fadeInRight theme-contact-us-form" style="visibility: hidden; animation-name: none;">
							
							<?php if( $this->session->flashdata('error_message') ){ ?>
								<div class="alert alert-danger">
								  <a  class="close" data-dismiss="alert" aria-label="close">&times;</a>
								  <strong>Wrong! </strong> <?php echo $this->session->flashdata('error_message'); ?>
								</div>
							<?php  }?> 
							
							<?php if( $this->session->flashdata('success_message') ){ ?>
								<div class="alert alert-success">
								 <a  class="close" data-dismiss="alert" aria-label="close">&times;</a>
								 <strong>Success! </strong> <?php echo $this->session->flashdata('success_message'); ?>
								</div>
							<?php  }?> 
								
						<form action="<?php echo base_url('Wincon/forget_password'); ?>" method="post" class="form-validation" autocomplete="off" novalidate="novalidate">

						<h4 class="quick-registration">Forget Password</h4>	

							<input type="email" name="email"  placeholder="Enter Email id" value="<?php  if(set_value('email')){echo set_value('email');  }?>" >
							<span class="error"><?php  echo   form_error('email'); ?></span>

							<button class="theme-button tran3s p-color-bg">Submit</button>

						</form>
				

					</div> <!-- /.quick-message-form -->

				</div>

			</div> <!-- /.quick-message -->