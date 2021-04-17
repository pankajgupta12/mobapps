<!-- Page Banner ______________________ -->

			<div class="page-banner">

				<div class="opacity">

					<div class="conatiner">

						<h3>Edit Profile</h3>

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

						<li class="active">Edit Profile</li>

					</ul>

				</div> <!-- /.container -->

			</div> <!-- /.page-breadcrum -->

     <?php  //$this->lang->load('date', 'calendar'); ?>

			<!-- Contact Us Page ___________________ -->

			<div class="quick-message1 contact-us-page">

				<div class="container">

					<div class="quick-message-form register_page float-center wow fadeInRight theme-contact-us-form" style="visibility: hidden; animation-name: none;">
					
					<?php if( $this->session->flashdata('success_message') ){ ?>
							<div class="alert alert-success">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Success! </strong> <?php echo $this->session->flashdata('success_message'); ?>
							</div>
					  <?php  } ?> 
					
					 <form action="<?php echo base_url('wincon/edit_profile'); ?>" method="post" class="form-validation" autocomplete="off" novalidate="novalidate">
						<h4 class="quick-registration">Edit Profile</h4>	
						
						<input  type="text"  name="first_name" placeholder="First Name" value="<?php  if(set_value('first_name')){echo set_value('first_name');  }  elseif(isset($getuserdata->first_name)) { echo trim($getuserdata->first_name); }?>">
						 <span class="error"><?php  echo   form_error('first_name'); ?></span>

						<input type="text" name="last_name"  placeholder="Last Name" value="<?php  if(set_value('last_name')){echo set_value('last_name');  }  elseif(isset($getuserdata->last_name)) { echo trim($getuserdata->last_name); }?>">
						 <span class="error"><?php  echo   form_error('last_name'); ?></span>

						<input type="text" name="email"  placeholder="Email" value="<?php  if(set_value('email')){echo set_value('email');  }  elseif(isset($getuserdata->email)) { echo trim($getuserdata->email); }?>">
						 <span class="error"><?php  echo   form_error('email'); ?></span>
						 
						 <input  type="text"  name="mobile_number" placeholder="Mobile Number" value="<?php  if(set_value('mobile_number')){echo set_value('mobile_number');  }  elseif(isset($getuserdata->mobile_number)) { echo trim($getuserdata->mobile_number); }?>">
						 <span class="error"><?php  echo   form_error('mobile_number'); ?></span>

						<input type="text" name="company_name" placeholder="Company" value="<?php  if(set_value('company_name')){echo set_value('company_name');  }  elseif(isset($getuserdata->company_name)) { echo trim($getuserdata->company_name); }?>" >
						 <span class="error"><?php  echo   form_error('company_name'); ?></span>
                  
				        <input type="hidden" name="user_id" id="user_id" value="<?php echo $getuserdata->user_id; ?>">
						 
						<input type="text" name="address_one" placeholder="Address1"  value="<?php  if(set_value('address_one')){echo set_value('address_one');  }  elseif(isset($getuserdata->address_one)) { echo trim($getuserdata->address_one); }?>">
						 <span class="error"><?php  echo   form_error('address_one'); ?></span>

						<input type="text" name="address_two" placeholder="Address2"  value="<?php  if(set_value('address_two')){echo set_value('address_two');  }  elseif(isset($getuserdata->address_two)) { echo trim($getuserdata->address_two); }?>">
						 <span class="error"><?php  echo   form_error('address_two'); ?></span>						

						<button class="theme-button tran3s p-color-bg">Update</button>
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

