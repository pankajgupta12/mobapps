<?php 
			error_reporting(0);; include 'header.php'; 
			include('inc/function.php');
			date_default_timezone_set('America/Los_Angeles');
			ini_set('date.timezone', 'America/Los_Angeles');	
			
			$user_id=$_SESSION['user_id'];
			$email=$_SESSION['email'];
 
       $getusertype = userdetails($user_id,'user_type');
		if($getusertype == '2'){
			echo "<script type=\"text/javascript\">
			window.location = \"emp-Dashboard.php\"; 
			</script>";
			ob_end_flush();
			exit;
		}
     // fetch emp records
			$sql_qery=mysql_query("SELECT * FROM `user_register` WHERE `user_id`='$user_id'"); $result=mysql_fetch_assoc($sql_qery);
			$sql_qery1=mysql_query("SELECT * FROM `user_details` WHERE `user_id`='$user_id' and company_signup_status = '1'"); $result1=mysql_fetch_assoc($sql_qery1);
			$industry=$result1['industry'];

			$sql_register=mysql_query("select * from user_details where user_id = '$user_id' and user_type = '3' and company_signup_status = '1'");
			$result= mysql_fetch_assoc($sql_register); 
			if($result['company_signup_status']!=1){
				echo "<script type=\"text/javascript\">
				window.location = \"business-signup.php\"; 
				</script>";
				ob_end_flush();
				exit;
			}


		if(isset($_POST['upload_logo']))
		{
			$image_info = getimagesize($_FILES["logo_img"]["tmp_name"]);
			$image_width = $image_info[0];
			$image_height = $image_info[1];
			
			if($image_width < 1100)
			{
				
			$t=time();
			$prod=rand(1000,9999999);
			 $logo=$_FILES['logo_img']['name'];
			 $extension=end(explode(".", $logo));
			$logo_img=$prod."".$t .".".$extension;
			//$filename = "../businessportal/uploads/logo/". $cover;	
			move_uploaded_file($_FILES["logo_img"]["tmp_name"],
			"uploads/logo/".$logo_img);
			
			  $sql="UPDATE `user_details` SET `emp_logo_or_company_logo`='$logo_img' WHERE `user_id`='$user_id'";
			  $result=mysql_query($sql);
			  if($result){
				   echo "<script type=\"text/javascript\">
			window.location = \"business-edit.php\"; 
			</script>";	
			  }else{
				  echo "<script type=\"text/javascript\">
			window.location = \"business-edit.php\"; 
			</script>";	
			  }
			}else{
				
			$change="";
			$abc="";
			define ("MAX_SIZE","400");
			function getExtension($str) {
				 $i = strrpos($str,".");
				 if (!$i) { return ""; }
				 $l = strlen($str) - $i;
				 $ext = substr($str,$i+1,$l);
				 return $ext;
			}

			 $errors=0;
			 if($_SERVER["REQUEST_METHOD"] == "POST")
			 {
				$image =$_FILES["logo_img"]["name"];
				$uploadedfile = $_FILES['logo_img']['tmp_name'];
			 
			if ($image) 
			{
				$filename = stripslashes($_FILES['logo_img']['name']);
				$extension = getExtension($filename);
				$extension = strtolower($extension);
			 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
				{
					$change='<div class="msgdiv">Unknown Image extension </div> ';
					$errors=1;
				}
				else
				{
				$size=filesize($_FILES['logo_img']['tmp_name']);
				if ($size > MAX_SIZE*1024)
			  {
			  $change='<div class="msgdiv">You have exceeded the size limit!</div> ';
			  $errors=1;
			 }
			 
			if($extension=="jpg" || $extension=="jpeg" )
		   {
		   $uploadedfile = $_FILES['logo_img']['tmp_name'];
		   $src = imagecreatefromjpeg($uploadedfile);
		  }
			else if($extension=="png")
			{
			$uploadedfile = $_FILES['logo_img']['tmp_name'];
			$src = imagecreatefrompng($uploadedfile);
			}
			else 
			{
			$src = imagecreatefromgif($uploadedfile);
			}

			echo $scr;
			list($width,$height)=getimagesize($uploadedfile);

			$newwidth=200;
		   $newheight=($height/$width)*$newwidth;
			$tmp=imagecreatetruecolor($newwidth,$newheight);

			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			$t=time();
			$prod=rand(1000,9999999);
			 $logo=$_FILES['logo_img']['name'];
			 $extension=end(explode(".", $logo));
			$logo_img=$prod."".$t .".".$extension;
			$filename = "uploads/logo/". $logo_img;

			 $sql="UPDATE `user_details` SET `emp_logo_or_company_logo`='$logo_img' WHERE `user_id`='$user_id'";
			  $result=mysql_query($sql);
			  if($result){
				   echo "<script type=\"text/javascript\">
			window.location = \"\business-edit.php\"; 
			</script>";	
			  }else{
				  echo "<script type=\"text/javascript\">
			window.location = \"business-edit.php\"; 
			</script>";	
			  }
			imagejpeg($tmp,$filename,100);
			imagejpeg($tmp1,$filename1,100);
			imagedestroy($src);
			imagedestroy($tmp);
			imagedestroy($tmp1);
			}
		   }
		  }
		 } 
		}	

		/* Back Ground Image Upload COde */
		
		$path = "uploads/logo/";
	 //print_r($_FILES); die;

	   $id = $_GET['id'];
	   
	 $valid_formats = array("jpg", "png", "gif","bmp","jpeg");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
	{
		$name = $_FILES['background_image']['name'];
		$size = $_FILES['background_image']['size'];
	if(strlen($name))
	{
	   list($txt, $ext) = explode(".", $name);
	if(in_array($ext,$valid_formats))
	{
	if($size<(1024*1024)) // Image size max 1 MB
	{
		$actual_image_name = time().$user_id.".".$ext;
		$tmp = $_FILES['background_image']['tmp_name'];
	if(move_uploaded_file($tmp, $path.$actual_image_name))
	{
	       mysql_query("UPDATE user_details SET background_image='$actual_image_name' WHERE user_id='$user_id'");
		  
		  echo "<script type=\"text/javascript\">
			window.location = \"business-edit.php\"; 
			</script>";
	     //echo "<img src='uploads/".$actual_image_name."' class='preview'>";
	}
	else
	        $errot_value =  "failed";
	}
	else
	          $errot_value =  "Image file size max 1 MB"; 
	}
	else
	      $errot_value=  "Invalid file format.."; 
	}
	else
	    $errot_value =  "Please select image..!";
	  
	} 
		
		
		
		 $getquerybussienssdetails = mysql_query("select * from user_details where user_id = '$user_id' and user_type = '3' and company_signup_status = '1'");
?>
	
     <section id="profile-summary">
       <div class="cover-image"> 
	   <?php  if($result1['background_image'] != '') { ?>
	    <img src="<?php echo $path.$result1['background_image']; ?>">
	   <?php  } else { ?>
	   <img src="img/business-edit.jpg">
	   <?php  } ?>
	   
	   </div>
         <div class="overlay" id="business-edit-overlay">
            <div class="container">
                <div class="detail">
				    <!--<div class="edit-cover" id="showbgimg" >
						<div class="edit-icon" id="bgimg" ><a  class="edit-link"  id="cover-img"><i class="fa fa-pencil"></i></a>
						  <div class=" popover popover-top" id="cover-img-action"> <a href="">Save </a> <a href="">Change Image </a> <a href="">Remove Image </a> </div>
						</div>
				     </div>-->
					 <div id="preview"><?php if($errot_value != '') { echo $errot_value; } ?></div>
					<div id="bgimage_update">	
						 <form id="imageform11" method="post" enctype="multipart/form-data" action=''>
							<label class="profile-bg-img">
							   <input name="background_image" type="file" style="display:none;" class="inputFile" id="userImage"   accept="image/*" onChange="validate(this.value);"   />
							   <input type="hidden" name="user_id" value="<?php echo $user_id;  ?>">
							</label>
						 </form>
					</div>
						
						
					<div class="edit-profile">
						  
						<form class="business-form" action="" method="post" id="form" enctype="multipart/form-data">
							<div class="profile-image"><div id="image-holder" style="width:100% !important; margin-top:16%;">
							  
							  <img <?php if(empty($result1['emp_logo_or_company_logo'])){ ?> src="img/profile-img.png" <?php }else{ ?> src="uploads/logo/<?php echo $result1['emp_logo_or_company_logo'];?>" <?php } ?> ></div>
							  
								<div class="change">
								   <input type="file" id="fileUpload" name="logo_img" class="inputfile inputfile-1" required>
								  <label for="fileUpload" class="pit-img"> <i class="fa fa-camera"></i> <span>&nbsp;&nbsp;Change Logo</span></label>
								</div>
							 </div>
						      <input class="lhidden" type="submit" id="logosubmit" name="upload_logo"  value='' > 
						</form>
						
						<div class="clearfix"></div>
						
						<div class="info">
						  <div class="edit-icon"> 
						     <a  class="edit-link" id="companynameedit" style="cursor: pointer;">
							  <i class="fa fa-pencil"></i></a>
						        <div class="popover popover-left" id="change-title">
						          <h2>Company Name</h 2>
							       <input type="text" id="company_name" name="company_name" value="<?php if(empty($result1['company_name'])){ echo "Company Name";}else{ echo $result1['company_name']; } ?>" placeholder="<?php if(empty($result1['company_name'])){ echo "Company Name";}else{ echo $result1['company_name']; } ?>">

									<input id="profile-title"  type="button" class="btn-g"  value="Submit" onclick="companaySubmit();" style="cursor: pointer;"><button class="btn-b" id="hidecompnayname" style="cursor: pointer;">Cancel</button>
						        </div>
			              </div>
						
						  <h1 id="compnany_name"><?php if(empty($result1['company_name'])){ echo "Company Name";}else{ echo $result1['company_name']; } ?>
						  </h1>
						
					 
					    <ul>
                            <li>
							<?php 
   							 $contory_name = getContory("countries",$result1['country']);
				             $state_name = getContory("states",$result1['state']);
						    ?>
                                <p class="address"><i class="fa fa-map-marker"></i> 
								  <span id='getaddress'><?php if(empty($result1['country'])){ echo "Country, City & Zip Code";}else{ echo  ucfirst($result1['city']).", ".$state_name.", ".$contory_name.", ".$result1['zip_code']; } ?></span> 
				  		            <div class="edit-icon_11"> 
								        <a  class="edit-link" id="addresseditid" style="cursor: pointer;"><i class="fa fa-pencil"></i></a>

									        <div class="popover popover-left1" id="addressshowid" >
												<div class="etier_box">
													<h2>Address</h2>
													<select name="country" style="margin-bottom: 14px;width: 190px;" onchange="getCity();"  id="countryId">
													 <option>Select</option>
														<?php $sql_countries = mysql_query("select * from countries");
														while($data_countries = mysql_fetch_array($sql_countries)) {?>
														<option value="<?php echo $data_countries['id']; ?>"<?php if($result1['country']== $data_countries['id']) echo 'selected="selected"'; ?>><?php echo $data_countries['name']; ?>
														<?php } ?>
													</select>
													
													<select name="state" title="Select State"  style="margin-bottom:14px; width:190px;" id="stateId">
													  <option value="">Select State</option> 
													</select>
													
													<input type="text" id='city' placeholder="City" value="<?php echo $result1['city']; ?>">
													
													<input type="text" id='zipcode' placeholder="Zip-code" value="<?php echo $result1['zip_code']; ?>">
													 <!--<input id="profile-title"  type="button" class="btn-g"  value="Submit" onclick="addressSubmit();"><a href="" id="profile-title" class="btn-b">Cancel</a>-->

													<button onclick="addressSubmit();" style="cursor: pointer;">Update</button>
													<button class="canc_1" id="addresscancel" style="cursor: pointer;">Cancel</button>
												</div>
									        </div>
						            </div>
				                </p>
			                </li>
                          <script>
							$(document).ready(function(){

								$("#addresseditid").click(function(){
								  $("#addressshowid").show();		
								  $("#shownumofempid").hide();
								  $("#change-title-2").hide();	
								  $("#change-title").hide();
								});
								$("#addresscancel").click(function(){
								  $("#addressshowid").hide();		
								});
								
								$("#numofempeditID").click(function(){
								 $("#shownumofempid").show();
								 $("#addressshowid").hide();
								 $("#change-title-2").hide();
								 $("#change-title").hide();
								});
								$("#hidenumofemp").click(function(){
								  $("#shownumofempid").hide();
								});
								
								$("#profile-title-2").click(function(){
								  $("#change-title-2").show();
									$("#addressshowid").hide();
									$("#shownumofempid").hide();
									$("#change-title").hide();
								});
								$("#hideindustry").click(function(){
								  $("#change-title-2").hide();		
								});
								
								$("#companynameedit").click(function(){
								  $("#change-title").show();	
									$("#addressshowid").hide();
									$("#shownumofempid").hide();
									$("#change-title-2").hide();
								});
								
								$("#hidecompnayname").click(function(){
								  $("#change-title").hide();		
								});
							});
						</script>
					 <style>
					   .etier_box button {
						       margin-right: 7px;
					    }
					 </style>
						    <li>
							    <p class="employees"><i class="fa fa-users"></i> <span id="no_of_emp"><?php if(empty($result1['no_of_employees'])){ echo "Number of Employees";}else{ echo getempdetails($result1['no_of_employees'])." ". "employees"; } ?></span> 
									<div class="edit-icon_1"> 
										 <a  class="edit-link" id="numofempeditID" style="cursor: pointer;"><i class="fa fa-pencil"></i></a>
										
										<div class=" popover popover-left2" id="shownumofempid" >
											<h2 style="color:black;">Number of employees</h2></br>
											<div class="etier_pop">
											<select name="no_of_employees" title="Please Select Number Of Employees" id="no_of_employees" required>
												<option value="" disabled selected >Select No Of employees</option>
												<?php   $getData = GetNofEmp();
												foreach($getData as $key=>$Getnoofemp){?>
												<option value="<?php echo $key; ?>" <?php if($result1['no_of_employees']== $key) { echo 'selected="selected"'; } ?>><?php echo $Getnoofemp; ?></option>
												<?php  } ?>
											</select>
													<input type="submit" onclick="empsubmit();" class="sub_btn" value="Update" style="cursor: pointer;">
													<button class="canc_2" id="hidenumofemp" style="cursor: pointer;">Cancel</button>
											</div>
											 
										</div>
									</div>
							    </p>
                            </li>							
							<li>
							   <p class="employees industry"><i class="fa fa-industry"></i> <?php  if($result1['industry'] == 'others'){ echo $result1['industry_value'];}else{ echo get_ExpvalueByID($result1['industry']); } ?></p>
							    <div class="edit-icon_2">
							     	<a class="edit-link-2" id="profile-title-2" style="cursor: pointer;"><i class="fa fa-pencil"></i></a>			
										<div class="popover popover-left3" id="change-title-2">
											  <h2>Industries</h2>
												<select name="industry"  onclick='javascript:yesnoCheck1(this.value);' title="Please Select Industry Name" style="width: 151px;" id="industry" required>
													<option value="" disabled selected >Select Industry</option>
													<?php  
													if($result1['industry'] != '') {
													$industry=$result1['industry'];
													}
													echo get_dropdown_ForSingup(17,$industry); 
													?>

													<option value="others" <?php if($industry == 'others'){  echo 'selected="selected"'; } ?> >Others</option> 
												</select>
												</br>
												<div id="industry_value" style="display:none; margin-top: 7px;">
												  <input type="text" name="industry_value" id="industry_value1" value="<?php  
												  if($result1['industry_value'] != '') {echo $result1['industry_value']; } ?>"   placeholder="Enter industry name" >
												</div>

												 <input id="profile-title"  type="button" class="sub_btn"  value="Submit" onclick="updateindustry();" style="cursor: pointer;">
												 <button class="btn-cancel canc_2" id="hideindustry" style="cursor: pointer;">Cancel</button>
										</div>											
								</div>
							   
							   
							</li>
                        </ul>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				
  </section>
  <section id="main">
    <div class="container">
      <div id="content">
        <div class="box">
          <h3>Latest Posts</h3>
        </div>
         <?php  
		 $latestjobpostquery = mysql_query("SELECT *  FROM `post_job` WHERE `user_id` = '$user_id' order by created_date desc limit 2"); 
		  
		  while($getdata = mysql_fetch_array($latestjobpostquery)) {
		 $postid = base64_encode(base64_encode(base64_encode($getdata['id'])));
		 ?>
		 
        <div class="boxes">
          <div class="boxes-left">
            <div class="c-logo"> <img src="uploads/logo/<?php echo userdetails($getdata['user_id'],'emp_logo_or_company_logo'); ?>"> </div>
            <p class="c-name"><?php  echo ucfirst(userdetails($getdata['user_id'],'company_name')); ?></p>
            <p class="b-name"><?php  echo ucfirst(get_ExpvalueByID($getdata['Industry'])); ?></p>
            <p class="p-time"><?php   $date = strtotime($getdata['created_date']);  echo get_timeago($date); ?></p>
          </div>
          <div class="boxes-right">
            <p class="c-location"><?php   
							$con = getContory('countries',$getdata['country']);
							$states = getContory('states',$getdata['state']);
						  echo $con." ,".$states." ,".$getdata['city']." ,".$getdata['zip_code'];  ?></p>
            <p><a href="post_job_details.php?postid=<?php echo $postid; ?>" class="view-more">View More Details</a></p>
          </div>
          <div class="clearfix"></div>
          <h2>Job Description</h2>
          <p><?php echo $getdata['description'];?>.</p>
        </div>
		  <?php  } ?>
		
          <?php  $getbussinessResult  = mysql_fetch_array($getquerybussienssdetails);  ?>		
        <div class="box">
          <p class="question">Description - <span id="summary-edit" class="edit-btn" onclick="showdesc(0);"><i class="fa fa-pencil"></i></span></p>
		    <div class="summary-update" style="display:none;">
				   <div class="modal-form">
					 
						 	<fieldset>
								<div class="form-block">
									<textarea placeholder="Enter your work profile description" name="description" id="description"><?php if($getbussinessResult['description'] !='') { echo $getbussinessResult['description']; }  ?></textarea>
								</div>
								<!--<div class="onoffswitch">
								   <input type="checkbox" name="exp_show_hide" class="onoffswitch-checkbox" id="exp" checked >
									<label class="onoffswitch-label" for="exp"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
								</div>-->

								<input type="submit" value="Update" onClick="return descriptionupdate();" class="btn pull-lefts"/>
								<input type="submit" value="Cancel" id="canceldesc" onClick="hidetextarea();" class="canc_1"/>
							</fieldset>
				   </div>	
		    </div>
			<div id="getbussinessdesc" ></div>
		   <div id="para-details" >
			  <p><?php echo $getbussinessResult['description']; ?></p>
		  </div>
        </div>
		  
        <div class="box">
          <h6 class="h6class"> What is your current Situation ? - <span id="situation-edit" class="edit-btn" Onclick="showcurrentSituation();" ><i class="fa fa-pencil"></i></span></h6>
			
			<ul class="list" id="current-situation">
				  <?php if($getbussinessResult['your_current_situation'] == 'others') { ?>
					<li><a><?php echo $getbussinessResult['your_current_situation_value']; ?></a></li>
				  <?php } ?>
				   <?php if($getbussinessResult['your_current_situation_value'] == '') { ?>
					<li><a><?php echo get_ExpvalueByID($getbussinessResult['your_current_situation']); ?></a></li>
				  <?php } ?>
			  
			</ul>
			  
		    <div class="situation-update" style="display:none;">				
				<div class="modal-form">
				    <input type="hidden" name="details_id" id="details_id" value="23">
					<fieldset>
					    <div class="form-block">
						  <label>SITUATION<span style="color:red;">*</span></label>
							<!--<input type="text" name="your_current_situation" title="Please enter optional job title" id="your_current_situation" placeholder="Enter current situation" required/>-->
							
							<?php 
							   $sqlcheck = mysql_query("select * from tbl_experience where experience_type = '18' and status = '1'"); 
								$i =0;
								echo "<ul>";
								while($datah = mysql_fetch_array($sqlcheck)) {
									$checked = (in_array($getbussinessResult['your_current_situation'], $datah)) ? 'checked' : '';
								
										echo "<li><input type='radio' onClick='javascript:yesnoCheck();'  name='your_current_situation'  value=".$datah['id']."  ".$checked.">".$datah['experience_skill']."</li>"; 
										  $i++;
										}
								echo "</ul>";
			                ?>
							<label id="ans-2"> 
							   <?php $checked12 = ($getbussinessResult['your_current_situation'] ==  'others') ? 'checked' : ''; ?>
							   <input type="radio" onClick="javascript:yesnoCheck();" name="your_current_situation" value="others" id="your_current_situation" <?php  echo $checked12; ?>> <span>Another Answer</span>
							</label>
							
							<div id="ifYes" style="display:none">
							   <input type="text" name="your_current_situation_value" id="your_current_situation_value" title="Please enter other field of your current situation" value="<?php echo $getbussinessResult['your_current_situation_value'] ?>"  placeholder="Enter other field of your current situation." required><br>
							</div>
							
						</div>  
					
						<div class="clearfix"></div>
						<input type="submit"  style="margin-top: 20px;" class="btn pull-lefts"  value="Update" Onclick="hidecurrentSituation();"  name="exp_details"/>
						<input type="submit" class="canc_1" onclick="return updatecurrentSituation();" name="submit" value="Cancel"  />
					</fieldset>
		        </div>			
		    </div>
        </div>
		
			<div class="box">   
			<h6 class="h6class">How is the culture at your current office ? - <span id="current-edit" class="edit-btn" Onclick="showCulturecurrentoffc();"><i class="fa fa-pencil"></i></span></h6>
				<ul class="list" id="current-office">
				<li><a><?php echo $getbussinessResult['culture_current_offc'];  ?></a></li>
				</ul>
				    <div class="current-update" style="display:none;">				
				     <div class="modal-form">
				     	<fieldset>
							<div class="form-block">
							     <input type="text" name="culture_current_offc"  title = "Please enter how Is the culture at your current office" id="culture_current_offc" placeholder="Enter how Is the culture at your current office." value="<?php  echo $getbussinessResult['culture_current_offc'];  ?>"  >  
							</div>     
						
							<div class="clearfix"></div>
							<input type="submit"  style="margin-top: 20px;" class="btn pull-lefts" value="Update" onClick="return UpdateCulturecurrentoffc();" name="exp_details" />
							<input type="submit" class="canc_1" name="submit" value="Cancel" Onclick="hideCulturecurrentoffc();" />
						</fieldset>
		             </div>			
		            </div>
			</div>

			<div class="box">
			<h6 class="h6class">What is the primary goal of your company ? - <span id="primary-edit" class="edit-btn" Onclick="showPrimeryGoalcompany();"><i class="fa fa-pencil"></i></span></h6>
				<ul class="list" id="your-company">
				   <li><a><?php echo $getbussinessResult['primary_goal_company'];  ?></a></li>
				</ul>
				   
				  <div class="primary-update" style="display:none;">				
				    <div class="modal-form">
						<fieldset>
							<div class="form-block">
							    <input type="text" title = "Please enter what is the primary goal of your company" name="primary_goal_company"  id="primary_goal_company"  placeholder="Enter what is the primary goal of your company." value="<?php if($getbussinessResult['primary_goal_company'] != '') { echo  $getbussinessResult['primary_goal_company']; }  ?>" >  
							</div>     
						
							
							<div class="clearfix"></div>
							<input type="submit"  style="margin-top: 20px;" class="btn pull-lefts" value="Update" onClick="return updatePrimeryGoalcompany();" name="exp_details" />
							<input type="submit" class="canc_1" name="submit" Onclick="hidePrimeryGoalcompany();"  value="Cancel" />
						</fieldset>
		            </div>			
		          </div>
			</div>

			<div class="box">
			<h6 class="h6class">What is the companies greatest strengths ? - <span id="greatest-edit" class="edit-btn"  Onclick="showcompanyGreteststrengths();"><i class="fa fa-pencil"></i></span></h6>
				<ul class="list" id="greatest-strengths">
				    <li><a><?php echo $getbussinessResult['company_greatest_strengths'];  ?></a></li>
				</ul>
				
				<div class="greatest-update" style="display:none;">				
				    <div class="modal-form">
						<fieldset>
							<div class="form-block">
							     <input type="text" name="company_greatest_strengths" pattern="[a-zA-Z0-9.&\s]*" title = "Please enter what is the companies greatest strengths"  id="company_greatest_strengths" value="<?php  echo $getbussinessResult['company_greatest_strengths'];  ?>"  placeholder="Enter what is the companies greatest strengths."  > 
							</div>     
						
							<div class="clearfix"></div>
							 <input type="submit"  style="margin-top: 20px;" class="btn pull-lefts" onClick="return updatecompgreateststrenght();" value="Update"  name="exp_details"/>
							 <input type="submit" class="canc_1" name="submit" onClick="return hidecompanyGreteststrengths();" value="Cancel" />
						</fieldset>
		            </div>			
		        </div>
			</div>
		
		   <?php $fetechVideo = $getbussinessResult['emp_video_or_company_video']; 
              if($fetechVideo != ""){ 
             ?> 
              <div class="box">
              <h3>Video - </h3>  <div class="clearfix"></div>
             <iframe width="70%" height="400px;" src="<?php echo $getbussinessResult['emp_video_or_company_video']; ?>"></iframe>
              </div> 
             <?php } ?>  

			 <?php 
				/* 	$emp_video_or_company_video = $getbussinessResult['emp_video_or_company_video'];
					//$emp_video_or_company_video = "49941861465563690.mp4";
					$emp_video_privacy = $getbussinessResult['emp_video_privacy'];
					//$emp_video_privacy = '0';
					$file_ext= explode('.',$emp_video_or_company_video);
					$expensions= array("mp4","mpg","mp2","mpeg","mp2","mpeg","mpe","mpv","mpg","m2v","m4v","3gp","flv","f4v","webm","mkv","vob","ogv","ogg","avi","wmv","amv","asf","rmvb");
					if(in_array($file_ext[1],$expensions) && $emp_video_privacy == "0" ){     
	         ?>    
					<div class="box">
					 <h3>Video -<span id="video-edit" class="edit-btn" Onclick="showVideo();"><i class="fa fa-pencil"></i></span> </h3> 
						<div class="video-update" style="display:none;">
							<label>Upload Video : </label>
							<form id="uploadvideo" action="ajax/updatevideo.php" method="post">
							<input type="hidden" name="user_id" value="<?php  echo $user_id; ?>">
								<label class="grey-text upload-resume">
									<input type="file" name="emp_video_or_company_video" id="emp_video_or_company_video" class="resume-icon" />	
									
									<input type="submit" id="submit" name="submit_resume" class="submit-btns" value="Update" style="margin-left: 539px;"/>
									
									<input type="submit"  Onclick="hideVideo();" name="submit_resume" class="submit-btns" value="Cancel" style="float:right;"/>
								</label> 
							</form>
						 </div>
					        <div class="clearfix"></div>
						<div id="showvideoclip">	
						  <video width="400" controls>
						     <source src="<?php echo "uploads/company-video/".$emp_video_or_company_video; ?>" type="video/<?php echo $file_ext[1]; ?>">
						  </video>
						</div>
					</div> 
                 <?php }  */ ?>	  
				 <script>
						$(document).ready(function (e){
							$("#uploadvideo").on('submit',(function(e){
							   e.preventDefault();
							
							$.ajax({
								url: "ajax/updatevideo.php",
								type: "POST",
								data:  new FormData(this),
								contentType: false,
								cache: false,
								processData:false,

								success: function(result){
							    	location.reload();  
								},
								error: function(){} 	        
							});

							}
							));
						});
				 </script>
				 
				 
        <div class="box">
          <h3>Company Pages Admins <span class="add_user" id="add_more_user"><i class="fa fa-plus-circle" aria-hidden="true">&nbsp;</i>Add User</span></h3>
			  <div class="over_popup" style="display:none;">&nbsp;</div>
			  <div class="popup-details" id="user_popup" style="display:none;">
				<span id="add_remove" class="remove-btn"><i class="fa fa-times-circle" aria-hidden="true">&nbsp;</i></span>
				<div class="modal-form">
				   <form method="POST" enctype="multipart/form-data" action="" >
					  <input type="hidden" name="details_id" id="details_id" value="23">
						<fieldset>
							<div class="form-block">
							 <label>ADD USER</label>
							    <input type="text" name="exp_title_name_inserted" title="Please enter optional job title" id="color1" placeholder="Enter name" required/>
							</div> 
							<div class="form-block">	
								<img src="img/p-pic-1.png" alt="Images" class="add_images" />							   
							</div>
							<div class="form-block">							
							    <span>Umesh Kumar</span>
							</div>	
							<div class="clearfix"></div>
							<input type="submit" class="btn pull-lefts submit_popup" value="Add User" onClick="return checkdate();" name="exp_details" />	
						</fieldset>
					</form>
		       </div>
			  </div>
			  
			  <ul class="list">
				<li><a href="">Designated Admins</a></li>
			  </ul>
          
		   <p class="small-font">You must be connected to a member to include themas an admin..</p>
          <input type="text" placeholder="Start Typing a Name..">
        </div>
		
        <div class="boxes">
          <ul class="profile-listing" id="content_6">
            <li>
              <div class="left-img"> <img src="img/p-pic-1.png"> </div>
              <div class="detail">
                <p class="name">Company Name</p>
                <p>Location</p>
              </div>
              <a class="btn-secondary" href="">Delete</a> </li>
            <li>
              <div class="left-img"> <img src="img/p-pic-2.png"> </div>
              <div class="detail">
                <p class="name">Company Name</p>
                <p>Location</p>
              </div>
              <a class="btn-secondary" href="">Delete</a> </li>
            <li>
              <div class="left-img"> <img src="img/p-pic-3.png"> </div>
              <div class="detail">
                <p class="name">Company Name</p>
                <p>Location</p>
              </div>
              <a class="btn-secondary" href="">Delete</a> </li>
            <li>
              <div class="left-img"> <img src="img/p-pic-1.png"> </div>
              <div class="detail">
                <p class="name">Company Name</p>
                <p>Location</p>
              </div>
              <a class="btn-secondary" href="">Delete</a> </li>
            <li>
              <div class="left-img"> <img src="img/p-pic-2.png"> </div>
              <div class="detail">
                <p class="name">Company Name</p>
                <p>Location</p>
              </div>
              <a class="btn-secondary" href="">Delete</a> </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
			<style>
				.profile-image > img {
				margin-top: 50px;
				}
				.btn-g {
				border-style: none;
				cursor: pointer;
				}
			</style>
  
        <script>
		/* For Video Code */
				  
                  function showVideo(){
			 			$('.video-update').show(); 
						$('#showvideoclip').hide(); 
					}
					
					function hideVideo(){
			 			$('.video-update').hide(); 
						$('#showvideoclip').show(); 
					}
				   
				
	/* End OF code */
   
                    function showcompanyGreteststrengths(){
			 			$('.greatest-update').show(); 
						$('#greatest-strengths').hide(); 
					}

					function hidecompanyGreteststrengths(){
						$('.greatest-update').hide(); 
						$('#greatest-strengths').show(); 
					}   
        /* ==================For Primery Goal Company =================== */
		
                   function showPrimeryGoalcompany(){
			 			$('.primary-update').show(); 
						$('#your-company').hide(); 
					}

					function hidePrimeryGoalcompany(){
						$('.primary-update').hide(); 
						$('#your-company').show(); 
					}
					
          /* ==================For Primery Goal Company =================== */		
		  
		 /* =================  How is the culture at your current office =====================*/
		 
					function showCulturecurrentoffc(){
						$('.current-update').show(); 
						$('#current-office').hide(); 
					}

					function hideCulturecurrentoffc(){
						$('.current-update').hide(); 
						$('#current-office').show(); 
					}
					
		 /* ================= End This Code How is the culture at your current office  ====================*/
		 
		 /*=====================Description Update ================================== */
		    function showdesc(){
				  $('.summary-update').show(); 
				  $('#para-details').hide(); 
		    }
		  
		    function hidetextarea(){
			    $('.summary-update').hide(); 
			    $('#para-details').show(); 
				//$('#description').val('');
		    }
    /*====================End Description Update ================================== */
	/* ====================== This Code For Current Situation  =================*/
		    function showcurrentSituation(){
				  $('.situation-update').show(); 
				  $('#current-situation').hide(); 
		    }
		    
			function hidecurrentSituation(){
			    $('.situation-update').hide(); 
			    $('#current-situation').show(); 
				$('#your_current_situation_value').val('');
				// $('input[name=your_current_situation]: ').val('');
		    }
	
			function yesnoCheck() {
				if (document.getElementById('your_current_situation').checked) {
					document.getElementById('ifYes').style.display = 'block';
				}
				else document.getElementById('ifYes').style.display = 'none';
		    }
		
		 $( document ).ready(function() {
			 
		      yesnoCheck('<?php echo $getbussinessResult['your_current_situation'];  ?>');
			  getfile('<?php echo $id; ?>');
			  yesnoCheck1('<?php echo $getbussinessResult['industry'];  ?>');
			 });
    /* =======================End Tag This Code For Current Situation================= */
			
		    function descriptionupdate(){
				
				var userID = '<?php  echo $user_id ?>';
				var desc =  $('#description').val();
				var page = 'descriptionupdate';
				
				var dataString = 'desc='+ desc + '&userid='+ userID +'&page='+ page;
				//alert(dataString);
		
				 if(desc == '')
				{
				  alert("This field is required");
				}
				else
				{
					$.ajax({
						type: "POST",
						url: "ajax/compnany_namesubmit.php",
						data: dataString,
						cache: false,
						success: function(result){
						//  $('#description').val('');
						 // $('#getbussinessdesc').html(result);
						  location.reload();
						}
				   });
	            } 
		    }
			
			
		function updatecurrentSituation(){
			 var CurrentSituation = $('input[name=your_current_situation]:checked').val(); 
			 var  varothervalueCurrent = $('#your_current_situation_value').val();
			 var userID = '<?php  echo $user_id ?>';
			 var page = 'updatecurrentSituation';
			//alert(CurrentSituation);
			var dataString = 'CurrentSituation='+ CurrentSituation + '&varothervalueCurrent='+ varothervalueCurrent + '&userid='+ userID + '&page='+ page;
			if(CurrentSituation == 'others' && varothervalueCurrent == '')
				{
				  alert("This field is required");
				}else {
					
					$.ajax({
						type: "POST",
						url: "ajax/compnany_namesubmit.php",
						data: dataString,
						cache: false,
						success: function(result){
						  //$('input[name=your_current_situation]: ').val('');
						 // $('#getbussinessdesc').html(result);
						 // $('#your_current_situation_value').val(result);
						  location.reload(); 
						}
				   });
				}
			
		}	
		
		 function UpdateCulturecurrentoffc(){
				
				var userID = '<?php  echo $user_id ?>';
				var Culturecurrentoffc =  $('#culture_current_offc').val();
				var page = 'Culturecurrentoffcpage';
				
				var dataString = 'Culturecurrentoffc='+ Culturecurrentoffc + '&userid='+ userID +'&page='+ page;
				//alert(dataString);
		
				 if(Culturecurrentoffc == '')
				{
				  alert("This field is required");
				}
				else
				{
					$.ajax({
						type: "POST",
						url: "ajax/compnany_namesubmit.php",
						data: dataString,
						cache: false,
						success: function(result){
						  //$('#culture_current_offc').html(result);
						  location.reload(); 
						}
				   });
	            } 
		    }
			function updatePrimeryGoalcompany(){
				
				var userID = '<?php  echo $user_id ?>';
				var PrimeryGoalcompany =  $('#primary_goal_company').val();
				var page = 'PrimeryGoalcompanyPage';
				
				var dataString = 'PrimeryGoalcompany='+ PrimeryGoalcompany + '&userid='+ userID +'&page='+ page;
				//alert(dataString);
		
				 if(PrimeryGoalcompany == '')
				{
				  alert("This field is required");
				}
				else
				{
					$.ajax({
						type: "POST",
						url: "ajax/compnany_namesubmit.php",
						data: dataString,
						cache: false,
						success: function(result){
						 /*  $('#culture_current_offc').html(result); */
						  location.reload(); 
						}
				   });
	            } 
		    }
			
			function updatecompgreateststrenght(){
				
				var userID = '<?php  echo $user_id ?>';
				var CompanyGreatstrenght =  $('#company_greatest_strengths').val();
				var page = 'updatecompgreateststrenght';
				
				var dataString = 'CompanyGreatstrenght='+ CompanyGreatstrenght + '&userid='+ userID +'&page='+ page;
				//alert(dataString);
		
				 if(CompanyGreatstrenght == '')
				{
				  alert("This field is required");
				}
				else
				{
					$.ajax({
						type: "POST",
						url: "ajax/compnany_namesubmit.php",
						data: dataString,
						cache: false,
						success: function(result){
						 /*  $('#culture_current_offc').html(result); */
						  location.reload(); 
						}
				   });
	            } 
		    }
			
		function updateindustry()
			{
				
				var userID = '<?php  echo $user_id ?>';
				var industry =  $('#industry').val();
				var industryValue =  $('#industry_value1').val();
				var page = 'updateindustry';
				
				var dataString = 'industry='+ industry +'&industryValue='+ industryValue + '&userid='+ userID +'&page='+ page;
				//alert(dataString);
		
				 if(industry == 'others' && industryValue == '')
				{
				  alert("This field is required");
				}
				else
				{
					$.ajax({
						type: "POST",
						url: "ajax/compnany_namesubmit.php",
						data: dataString,
						cache: false,
						success: function(result){
						   $('#industry_value1').html(result); 
						// alert(result);
						  location.reload(); 
						}
				   });
	            } 
		    }
			   
		</script>
		 
  <script>
$(document).ready(function() {
        $("#fileUpload").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
      });
	  
	  
	  
	$(document).ready( function() {
    $('#fileUpload').change(function() {
        $( "#logosubmit" ).click();
    });
	});	
	
	
	function empsubmit(){
		
	var noOFemp = $('#no_of_employees').val();
		var userid = '<?php echo $user_id; ?>';
		var page = 'emp';
		var dataString = 'noOFemp='+ noOFemp + '&userid='+ userid +'&page='+ page;
		
			if(noOFemp == '')
			{
			 alert("This field is required");
			}
			else
			{
				$.ajax({
				type: "POST",
				url: "ajax/compnany_namesubmit.php",
				data: dataString,
				cache: false,
				success: function(result){
				 // $('#no_of_emp').html("<div class='newbox'> "+result+" employees </div>");
				    location.reload(); 
				}
				});
	        }
	}
	
	 function getfile(id){
				 var page = 'getfile';
				 var dataString = 'id='+ id +'&page='+ page;
				 $.ajax({
						type: "POST",
						url: "ajax/compnany_namesubmit.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
					}
				    });
				}
	
	function companaySubmit(){
		
		var companyName = $('#company_name').val();
		var userid = '<?php echo $user_id; ?>';
		var page = 'company';
		var dataString = 'company_name='+ companyName + '&userid='+ userid +'&page='+ page;
		
			if(companyName == '')
			{
			 alert("This field is required");
			}
			else
			{
				$.ajax({
				type: "POST",
				url: "ajax/compnany_namesubmit.php",
				data: dataString,
				cache: false,
				success: function(result){
				 /*  $('#compnany_name').html("<div class='newbox'> "+result+" </div>"); */
				  location.reload(); 
				
				}
				});
	        }
	}
	
	function addressSubmit(){
		     
		var countryId = $('#countryId').val();
		var stateId = $('#stateId').val();
		var city = $('#city').val();
		var zipcode = $('#zipcode').val();
	    var userid = '<?php echo $user_id; ?>';
	    var page = 'address';
		
		
		
		var dataString = 'countryId='+ countryId + '&stateId='+ stateId + '&city='+ city + '&zipcode='+ zipcode + '&userid='+ userid +'&page='+ page;
		
	  //alert(dataString);
			if((city == "" || city == null) &&  (zipcode  == "" || zipcode  == null))
			{
			 alert("This field is required");
			}
			else
			{
				$.ajax({
				type: "POST",
				url: "ajax/compnany_namesubmit.php",
				data: dataString,
				dataType:'json',
				cache: false,
				success: function(result){
				  /*  $('#getaddress').html(result.city + "," + result.state + "," + result.country + "," + result.zip_code);
				   $('#city').val(result.city);
		           $('#zipcode').val(result.zip_code); */
				    location.reload(); 
				   
				 }
				});
	        } 
	}
	
	function getCity(countryId) 
	    {
	
			var stateId = '<?php echo $result1['state'];?>';
			var countryId = $("#countryId").val();
			var dataString = '&countryId=' + countryId + '&stateID=' + stateId; // pagination with ajax
	// alert(dataString);
				$.ajax({
					type: "GET",
					url: "ajax/_getCity.php",
					data: dataString,
						success:function(data){
						   $("#stateId").html(data)
						}
				  }); 
        }
   
    function yesnoCheck1(val){
             
		 var element=document.getElementById('industry_value');
		 if(val=='others')
		 element.style.display='block';
		 else  
		 element.style.display='none';
		}
		
   $( document ).ready(function() {
		 // alert('<?php echo $result1['state'];?>');
	       getCity('<?php echo $result1['country'];  ?>');
     });
	 
</script>
<script type="text/javascript">
	$(document).ready(function() 
	{ 
	//alert('sdsjd');
			$('#userImage').change(function() {
			  $('#imageform11').submit();
			});
	}); 
	
	 function validate(file) {
				var ext = file.split(".");
				ext = ext[ext.length-1].toLowerCase();      
				var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];

				if (arrayExtensions.lastIndexOf(ext) == -1) {
					alert("Wrong extension type.");
					$("#userImage").val("");
				}
    }
	
	</script>

<script>
$(document).ready(function(){
	$("#add_more_user").click(function(){
        $("#user_popup").show();
        $(".over_popup").show();
    });
	$("#add_remove").click(function(){
        $("#user_popup").hide();
        $(".over_popup").hide();
    });
});
</script>

  <?php require_once('footer.php');?>