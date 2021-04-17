<?php 
	
		error_reporting(0);; include 'header.php'; 
		include('inc/function.php');
		date_default_timezone_set('America/Los_Angeles');
		ini_set('date.timezone', 'America/Los_Angeles');

		$getUserData =   selectFtechRow(array(), "user_details", "where user_id = '".$user_id."'"); 
		$getUserRegistrationdata =   selectFtechRow(array(), "user_register", "where user_id = '".$user_id."'"); 
         
		 $monthNames = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November","December"); 
		 
		$path = "uploads/logo/";
 
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
			window.location = \"user-profile.php\"; 
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
		
		
?>
   
    <!--<link href="css/jquery.tagit.css" rel="stylesheet" type="text/css" />
    <link href="css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/tag-it.js" type="text/javascript" charset="utf-8"></script>

    <script>
       $(function(){
		
            var sampleTags123 = ['c++', 'java', 'php', 'coldfusion', 'javascript', 'asp', 'ruby', 'python', 'c', 'scala', 'groovy', 'haskell', 'perl', 'erlang', 'apl', 'cobol', 'go', 'lua'];
			//alert(sampleTags);

            $('.singleFieldTags').tagit({
                availableTags: sampleTags123
               
            });
        });
    </script>--->
	<script type="text/javascript">
		$(document).ready(function() 
		{ 
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
      
    <section id="profile-summary">
		<div class="cover-image"> 
		   <?php  if($getUserData['background_image'] != '') { ?>
			<img src="<?php echo $path.$getUserData['background_image']; ?>">
		   <?php  } else { ?>
		   <img src="img/business-edit.jpg">
		   <?php  } ?>
		   
		</div>
    <div class="overlay" id="business-edit-overlay">
      <div class="container">
        <div class="detail">
		    <div id="bgimage_update">	
				<form id="imageform11" method="post" enctype="multipart/form-data" action=''>
						<label class="profile-bg-img">
						   <input name="background_image" type="file" style="display:none;" class="inputFile" id="userImage"   accept="image/*" onChange="validate(this.value);"   />
						   <input type="hidden" name="user_id" value="<?php echo $user_id;  ?>">
						</label>
				</form>
			</div>
		  
		  
            <div class="edit-profile">
				       <?php $url = parse_url($getUserData['emp_logo_or_company_logo']);
						  if($url['scheme'] == 'https'){
						 $fbimg = $getUserData['emp_logo_or_company_logo'];
						 ?>
					    <div class="profile-image"> <img src="<?php echo $fbimg; ?>"> </div>
					
					 <?php 
					} else {
					$img = explode('.',$getUserData['emp_logo_or_company_logo']);
					$checkImage = $img[1];
					if(!empty($checkImage)){ ?> 
					<img src="./uploads/profile_photo/<?php echo $getUserData['emp_logo_or_company_logo'];?>" class="profile-image"/>
					<?php }else{
					?> 
						 <img src="img/anonymous-man.png" class="profile-image"> 
					<?php } } ?>
					
				<style>
				   .etier_box button {
						   margin-right: 7px;
					}
				</style>
					
            <div class="clearfix"></div>
            <div class="info">
                <div class="edit-icon"> 
					 <a  class="edit-link" id="usernameedit" style="cursor: pointer;"><i class="fa fa-pencil"></i></a>
					 
					<div class="popover popover-left" id="change-title-2" style="width: 212px;">
					  <h2>Name</h2>
					   <input type="text" id="first_name" placeholder="First name" name="first_name" value="<?php echo $getUserRegistrationdata['first_name']; ?>">
					   
					   <input type="text" id="last_name" placeholder="Last name" name="last_name" value="<?php echo $getUserRegistrationdata['last_name']; ?>">

						<input id="profile-title"  type="button" class="btn-g"  value="Submit" onclick="usernameupdate();" style="cursor: pointer;"><button class="btn-b" id="hideusernameedit" style="cursor: pointer;">Cancel</button>
					</div>
			    </div>
				
                   <h1 id="user_name"><?php echo $getUserRegistrationdata['first_name']."  ".$getUserRegistrationdata['last_name']; ?></h1>
            <ul>
				<li>
				  <?php  $contory_name = getContory("countries",$getUserData['country']);
					 $state_name = getContory("states",$getUserData['state']); ?>
					 
					<p class="address"><i class="fa fa-map-marker"></i> 
					  <span id='getaddress'><?php if(empty($getUserData['country'])){ echo "Country, City & Zip Code";}else{ echo  ucfirst($getUserData['city']).", ".$state_name.", ".$contory_name.", ".$getUserData['zip_code']; } ?></span> 
					  
						<div class="edit-icon_11"> 
							<a  class="edit-link" id="addresseditid" style="cursor: pointer;"><i class="fa fa-pencil"></i></a>

							<div class="popover popover-left" id="addressshowid" >
								<div class="etier_box">
									<h2>Address</h2>
									<select name="country" style="margin-bottom: 14px;width: 155px;" onchange="getCity();"  id="countryId">
									 <option>Select</option>
										<?php $sql_countries = mysql_query("select * from countries");
										while($data_countries = mysql_fetch_array($sql_countries)) {?>
										<option value="<?php echo $data_countries['id']; ?>"<?php if($getUserData['country']== $data_countries['id']) echo 'selected="selected"'; ?>><?php echo $data_countries['name']; ?>
										<?php } ?>
									</select>
									
									<select name="state" title="Select State"  style="margin-bottom: 14px;width: 155px;"   id="stateId">
									  <option value="">Select State</option> 
									</select>
									
									<input type="text" id='city' placeholder="City" value="<?php echo $getUserData['city']; ?>">
									
									<input type="text" id='zipcode' placeholder="Zip-code" value="<?php echo $getUserData['zip_code']; ?>">
									

									<button onclick="addressSubmit();" style="cursor: pointer;">Update</button>
									<!--<button  style="cursor: pointer;">Update</button>-->
									<button class="canc_1" id="addresscancel" style="cursor: pointer;">Cancel</button>
								</div>
							</div>
							
						</div>
					</p>
				</li> 
				
                <li>
                    <p class="employees"><i class="fa fa-users"></i> <span id="no_of_emp"><?php if(empty($getUserData['personal_tagline'])){ echo "Personal tagline";}else{ echo $getUserData['personal_tagline']; } ?></span> 
						<div class="edit-icon_1"> 
							 <a  class="edit-link" id="personaltaglineedit" style="cursor: pointer;"><i class="fa fa-pencil"></i></a>
							
							<div class="popover popover-left" id="showpersonaltagline" style="width: 193px;" >
								<h2 style="color:black;">Personal tagline</h2></br>
								<div class="etier_pop">
									   <input type="text" name="personal_tagline" Placeholder="personal tagline" id="personal_tagline" value="<?php echo $getUserData['personal_tagline']; ?>">
								
										<input type="submit" onclick="updatepersonaltagline();" class="sub_btn" value="Update" style="cursor: pointer;">
										
										<button class="canc_2" id="hidepersonaltaglineedit" style="cursor: pointer;">Cancel</button>
								</div>
								 
							</div>
						</div>
					</p>
                </li>
				
                <li>
                  <p class="employees industry"><i class="fa fa-industry"></i> <?php  if($getUserData['industry'] == 'others'){ echo $getUserData['industry_value'];}else{ echo get_ExpvalueByID($getUserData['industry']); } ?>  </p>
					<div class="edit-icon_2">
						<a class="edit-link-2" id="profile-title-2" style="cursor: pointer;"><i class="fa fa-pencil"></i></a>			
						<div class="popover popover-left" id="change-title-21">
								  <h2>Industries</h2>
								<select name="industry"  onclick='javascript:yesnoCheck1(this.value);' title="Please Select Industry Name" style="width: 151px;" id="industry" required>
									<option value="" disabled selected >Select Industry</option>
									<?php  
										if($getUserData['industry'] != '') {
										   $industry = $getUserData['industry'];
										}
									  echo get_dropdown_ForSingup(1,$industry); 
									?>

								<option value="others" <?php if($industry == 'others'){  echo 'selected="selected"'; } ?> >Others</option> 
								</select>
									</br>
								<div id="industry_value" style="display:none; margin-top: 7px;">
								  <input type="text" name="industry_value" id="industry_value1" value="<?php  
								  if($getUserData['industry_value'] != '') {echo $getUserData['industry_value']; } ?>"   placeholder="Enter industry name" >
								</div>

							 <input id="profile-title"  type="button" class="sub_btn"  value="Submit" onclick="updateindustry();" style="cursor: pointer;" />
							 
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
  <script>
    function educationupdateshow(div_id){
		$('#edit_'+div_id).show();		
		$('#educationupdate_'+div_id).hide();		
	}

	function educationupdatehide(div_id){
		$('#edit_'+div_id).hide();		
		$('#educationupdate_'+div_id).show();		
	}
	function addnewdesgree(){
		$('#add_new_degree').toggle();
	}
	function addnewdegreehide(){
		$('#add_new_degree').hide();
	}
	
	function experienceupdateshow(divid){
      $('#educationeditpart_'+divid).show();
      $('#experianceupdate_'+divid).hide();
	}
	
	function experienceupdatehide(divid){
      $('#educationeditpart_'+divid).hide();
      $('#experianceupdate_'+divid).show();
	}
	
	function addnewexpriance(){
		$('#add_new_expriance').toggle();
	}
	
	function addnewexperience(){
		$('#add_new_expriance').hide();
	}
	
	/* function showskils(){
		$('#skills-update-show').show();
	} */
	
	
  </script>
  
  <section id="main">
    <div class="container">
    <div class="left-panel" id="business-view">
       <?php // print_r($getUserData);   ?>
	   <span id="deletemesg" style="display:none;"><p style="color:red">One education record delete successfully</p></span>
      <div class="box" id="education1">
	    <form method="post" action="ajax/update_education.php" id="update_education">	
        <h3>Education </h3>
        <?php  $educationSql = mysql_query("SELECT * FROM `user_add_degree` where user_id = '".$getUserData['user_id']."'");?>
		  
		   <?php $i =0; $count= 1; while($getEducationData = mysql_fetch_array($educationSql)){	 //print_r($getEducationData);?>
			
			<div class="pull-left left-lists education-details" id="educationupdate_<?php echo $i; ?>">
					
						<p class="sub-heading" id="liId"><i class="green fa fa-caret-right"></i> 
						<?php   if($getEducationData['university'] == "others"){
									  $getEducationuniversity = $getEducationData['universityothervalue'];	
							   }else { 
								 $getEducationuniversity = get_ExpvalueByID($getEducationData['university']);	
							   }
								 echo $count.".  ".$getEducationuniversity; ?>
								&nbsp;&nbsp; <span id="education-edit" class="edit-btn" onclick="educationupdateshow('<?php  echo $i; ?>')" ><i class="fa fa-pencil"></i></span>&nbsp; 
								<a onclick="removeEducation('<?php echo $getEducationData['user_add_degree_id']; ?>','<?php echo $i; ?>');" class="remove_btn">Remove</a>
						</p> 
						
                   		<ul id="ulId">	
				
						<li>
							<?php 
							$educationdegree12  = $getEducationData['educationdegree'];
							if ($educationdegree12 == "others"){
							   $educationdegree = $getEducationData['educationdegreeotherValue'];	
							}else {
							  $educationdegree = get_ExpvalueByID($getEducationData['educationdegree']);	
							}
							echo $educationdegree;
							?>
						</li>
						
						<li>
							<?php  
							 if ($getEducationData['educationfield'] == "others"){
							   $educationfield = $getEducationData['educationfieldothervalue'];	
							}else { 
							   $educationfield = get_ExpvalueByID($getEducationData['educationfield']);
							}
							echo $educationfield;
							?>
						</li>
						
						<li><?php echo  $getEducationData['educationYear'];	 ?></li>
					</ul> </br> 	
			</div> 
            
                 			
				
			<div class="education-update" id="edit_<?php echo $i; ?>" style="display:none;">	
				 
			    <div class="modal-form">
					<fieldset>
							<div class="form-block">
							 <input type="hidden" name="div_id" value="<?php echo $i; ?>" id="div_id">    
							    
			
							 <label>University<span style="color:red;">*</span></label>
								<select name="education_school[]" title="Please select university" id="education_school_<?php echo $i ?>" class="select2"  onchange="CheckCompany(this.value,'<?php echo $i ?>','0');"  required>

									<option value="" selected disabled>Select university </option>
									<?php 
                                         if($getEducationData['university'] != ''){
											$educationschool = $getEducationData['university'];
										}
									    echo get_dropdown_ForSingup(8,$educationschool);
									?> 
									<option value="others" <?php if($getEducationData['university']  == 'others') { echo "selected"; } ?>>Other</option>
								</select>
								
								 <input type="text" name="education_school_inserted[]" id="education_school_inserted_<?php echo $i ?>_0" placeholder="Please Enter another field of university" title="Please enter another field of university" value="<?php if($getEducationData['universityothervalue'] != '') { echo $getEducationData['universityothervalue'];  } ?>" style='display:none;'  /> 
								 
							</div> 
						
						  <div class="clearfix"></div>   
						
							<div class="form-block">
							 <label>Degree<span style="color:red;">*</span></label>
								<select name="education_degree[]" title="Please select degree" id="education_degree_<?php echo $i ?>" onchange="CheckTitle(this.value,'<?php echo $i ?>','1');" required>
									<option value="" selected disabled>Select degree</option>
									<?php 
									  if($getEducationData['educationdegree'] != ''){
										 $educationdegree = $getEducationData['educationdegree'];
									 }
									 echo get_dropdown_ForSingup(9,$educationdegree);
									?> 
									<option value="others" <?php if($getEducationData['educationdegree']  == 'others') { echo "selected"; } ?>>Other</option>
								</select> 
								
								 <input type="text" name="education_degree_inserted[]" id="education_degree_inserted_<?php echo $i ?>_1" placeholder="Enter another field of degree"  value="<?php if($getEducationData['educationdegreeotherValue'] != '') { echo $getEducationData['educationdegreeotherValue'];  } ?>" style='display:none;' title="Please enter  another field of degree" />   
								 
							</div>	
							
				
							  <div class="clearfix"></div>   
							
							<div class="form-block">
							 <label>Field of study<span style="color:red;">*</span></label>
								<select name="education_field_of_study[]" class="select2"  placeholder="Please Select Field of Study"  id="education_field_of_study_<?php echo $i ?>" value="<?php if($getEducationData['educationdegreeotherValue'] != '') { echo $getEducationData['educationdegreeotherValue'];  } ?>" title="Please Select Field of Study" onchange="educationfieldofstudy(this.value,'<?php echo $i ?>','2');"  required>
									<option value="" selected disabled >Field of Study</option>
									<?php 
									  if($getEducationData['educationfield'] != '') {
										 $fieldofstudy = $getEducationData['educationfield'];
									 } 
									echo get_dropdown_ForSingup(10,$fieldofstudy);
									?> 
									<option value="others" <?php if($getEducationData['educationfield']  == 'others') { echo "selected"; } ?>>Other</option>
								</select>
								
								
								 <input type="text" name="education_field_of_study_inserted[]" title="Please Enter Optional Education Field of Study" value="<?php if($getEducationData['educationfieldothervalue'] != '') { echo $getEducationData['educationfieldothervalue'];} ?>" id="education_field_of_study_inserted_<?php echo $i ?>_2" placeholder="Please Enter Optional Education Field of Study" style='display:none;'  />   
							</div>	
						
							<div class="clearfix"></div>   
							<div class="form-block">
							 <label>Year of Graduation<span style="color:red;">*</span></label>
								<select name="education_year_of_graduation[]" id="education_year_of_graduation_<?php echo $i ?>" title ="Please Select Year Of Graduation"  required>
									<option value="" selected disabled >Year of Graduation</option>
									<?php  for($k= date('Y'); $k>='1950'; $k--) { ?>
									<option value="<?php  echo $k; ?>"<?php if($getEducationData['educationYear'] == $k) echo 'selected="selected"'; ?>><?php  echo $k; ?></option>
									<?php  } ?>
									
								</select>
							</div>
                           <div class="clearfix"></div>   
						
							<div class="onoffswitch">
							   <input type="checkbox" name="exp_show_hide[]" class="onoffswitch-checkbox" id="<?php echo $i; ?>" <?php if($getEducationData['show_hide'] == '0'){ echo  "checked";} ?>  >
								<label class="onoffswitch-label" for="<?php echo $i; ?>"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
							</div>
							
							<div class="clearfix"></div>
							 <div id="submitid"></div>
							
							
							
							 <input type="hidden" name="user_add_degree_id[]" value="<?php echo $getEducationData['user_add_degree_id']; ?>" id="user_add_degree_id">
							 
							 <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" id="user_id">
							 <input type="submit"  style="margin-top: 20px;" class="btn pull-lefts" value="Save"  />
							<a class="cancel_btn" onclick="educationupdatehide('<?php echo $i; ?>');" >Cancel</a>
					</fieldset>
		        </div>	
		    </div>	
					<script>
					$(document).ready(function(){ 
					//window.onload = function() {
				//	alert('dkdjfd');
						<?php  if($getEducationData['university']  == 'others') { ?>
								CheckCompany('<?php echo $getEducationData['university']; ?>','<?php echo $i ?>','0');
						<?php  } ?>
						
						<?php if($getEducationData['educationdegree']  == 'others') { ?>
								CheckTitle('<?php echo $getEducationData['educationdegree']; ?>','<?php echo $i ?>','1');
						<?php  } ?>
						
						<?php if($getEducationData['educationfield']  == 'others') { ?>
								educationfieldofstudy('<?php echo $getEducationData['educationfield']; ?>','<?php echo $i ?>','2');
						<?php }  ?>
					 });
					</script>	
				
        <?php  $i++; $count++; } ?>	
	    </form>	
	    <div class="form-block" >
		    <div class="add-new-degree">
	           <span><a onclick="addnewdesgree();">Add new education</a></span>
		    </div>
		</div>
		
		
		  
			<div class="education-update" id="add_new_degree" style="display:none;">	
			    <form method="post" action="ajax/add_new_degree.php" id="add_new_degree1">	
					<div class="modal-form">
						<fieldset>
								<div class="form-block">
								 <label>University<span style="color:red;">*</span></label>
									<select name="education_school" title="Please select university" id="education_school" class="select2"  onchange="CheckCompany1(this.value);"  required>

										<option value="" selected disabled>Select university </option>
										<?php 
											
											echo get_dropdown_ForSingup(8);
										?> 
										<option value="others" <?php if($_POST['education_school']  == 'others') { echo "selected"; } ?>>Other</option>
									</select>
								
									 <input type="text" name="education_school_inserted" id="education_school_inserted" placeholder="Please Enter another field of university" title="Please enter another field of university" value="<?php if($_POST['education_school_inserted'] != '') { echo $_POST['education_school_inserted'];  } ?>" style='display:none;'  /> 
									 
								</div> 
							
							  <div class="clearfix"></div>   
							
								<div class="form-block">
								 <label>Degree<span style="color:red;">*</span></label>
									<select name="education_degree" title="Please select degree" id="education_degree" onchange="CheckTitle1(this.value);" required>
										<option value="" selected disabled>Select degree</option>
										<?php 
										  
										 echo get_dropdown_ForSingup(9);
										?> 
										<option value="others" <?php if($_POST['education_degree']  == 'others') { echo "selected"; } ?>>Other</option>
									</select> 
									
									 <input type="text" name="education_degree_inserted" id="education_degree_inserted" placeholder="Enter another field of degree"  value="<?php if($_POST['education_degree_inserted'] != '') { echo $_POST['education_degree_inserted'];  } ?>" style='display:none;' title="Please enter  another field of degree" />   
									 
								</div>	
									
					
								  <div class="clearfix"></div>   
								
								<div class="form-block">
								 <label>Field of study<span style="color:red;">*</span></label>
									<select name="education_field_of_study" class="select2"  placeholder="Please Select Field of Study"  id="education_field_of_study" value="<?php if($_POST['educationdegreeotherValue'] != '') { echo $_POST['educationdegreeotherValue'];  } ?>" title="Please Select Field of Study" onchange="educationfieldofstudy1(this.value);"  required>
										<option value="" selected disabled >Field of Study</option>
										<?php 
										  
										echo get_dropdown_ForSingup(10);
										?> 
										<option value="others" <?php if($_POST['education_field_of_study']  == 'others') { echo "selected"; } ?>>Other</option>
									</select>
									
									 <input type="text" name="education_field_of_study_inserted" title="Please Enter Optional Education Field of Study" value="<?php if($_POST['education_field_of_study_inserted'] != '') { echo $_POST['education_field_of_study_inserted'];} ?>" id="education_field_of_study_inserted" placeholder="Please Enter Optional Education Field of Study" style='display:none;'  />   
								</div>	
							
								  <div class="clearfix"></div>   
								<div class="form-block">
								 <label>Year of Graduation<span style="color:red;">*</span></label>
									<select name="education_year_of_graduation" id="education_year_of_graduation" title ="Please Select Year Of Graduation"  required>
										<option value="" selected disabled >Year of Graduation</option>
										<?php  for($k= date('Y'); $k>='1950'; $k--) { ?>
										<option value="<?php  echo $k; ?>"<?php if($_POST['education_year_of_graduation'] == $k) echo 'selected="selected"'; ?>><?php  echo $k; ?></option>
										<?php  } ?>
										
									</select>
								</div>
								
							   <div class="clearfix"></div>  
								<div class="onoffswitch">
								   <input type="checkbox" name="exp_show_hide" class="onoffswitch-checkbox" id="new"  checked>
									<label class="onoffswitch-label" for="new"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
								</div>
								
								<div class="clearfix"></div>
								 <div id="submitid"></div>
								
								 <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" id="user_id">
								 <input type="hidden" name="details_id" value="<?php echo $getUserData['details_id']; ?>" id="user_id">
								 
								<button type="submit" class="btn-type-submit" />Save</button>
								<a class="cancel_btn" onclick="addnewdegreehide();" >Cancel</a>
								
						</fieldset>
					</div>
			    </form>
			</div>					
         </div>     
      <div class="clearfix"></div>  
   
	  <hr>
	    
	   <span id="deletemesgexperience" style="display:none;"><p style="color:red">One experience record delete successfully</p></span>
    <div class="box" id="experience1">
	      <h3>Experience-</h3>
	   <form method="post" action="ajax/update_experience.php" id="update_experience1">	
			<?php  
			  $workexp = mysql_query("SELECT * FROM `user_work_experience` where user_id = '".$getUserData['user_id']."'");  
			$k =0; $countexp = 1;  while($getworkexperianceData = mysql_fetch_array($workexp)){
				
			//print_r($getworkexperianceData);
			 ?>
				<div class="pull-left left-lists experience-details"   id="experianceupdate_<?php echo $k; ?>">
						<ul id="ulexperiance">
							<li id="liexperiance">
								<p class="sub-heading"><i class="green fa fa-caret-right"></i>
									<?php  $exp_company_name_get = $getworkexperianceData['exp_company_name'];				
										if ($exp_company_name_get == "others"){
										$exp_company_name = $getworkexperianceData['exp_company_name_inserted'];	
										}else {
										 $exp_company_name = get_ExpvalueByID($getworkexperianceData['exp_company_name']);	 
										}
									  echo $countexp.". ".$exp_company_name;		
									?>
								
								 &nbsp;&nbsp; <span id="education-edit" class="edit-btn" onclick="experienceupdateshow('<?php  echo $k; ?>')" ><i class="fa fa-pencil"></i></span>&nbsp; 
											<a onclick="deleteexperiance('<?php echo $getworkexperianceData['exp_id']; ?>','<?php echo $k; ?>');" class="remove_btn">Remove</a>
								</p>   
							</li>	
								<li id="liexperiance">
										<?php 
										$exp_title_get  = $getworkexperianceData['exp_title'];				
										if ($exp_title_get == "others"){
										  $exp_title = $getworkexperianceData['exp_title_name_inserted'];	
										}else {
										 $exp_title = get_ExpvalueByID($getworkexperianceData['exp_title']); 
										}
										echo $exp_title;
										?>
								</li>
								<li id="liexperiance">
									<?php
										$exp_time_period_start_month = $getworkexperianceData['exp_time_period_start_month'];
										$exp_time_period_start_year = $getworkexperianceData['exp_time_period_start_year'];
										$currently_work_here = $getworkexperianceData['currently_work_here']; 
										$exp_time_period_end_month = $getworkexperianceData['exp_time_period_end_month'];		
										$exp_time_period_end_year = $getworkexperianceData['exp_time_period_end_year']; 
											if ($currently_work_here == "1"){
											$endmonthYear = "Currently working here";
											}else {
											$endmonthYear = "to " . $exp_time_period_end_month .' '. $exp_time_period_end_year;
											}
										echo $exp_time_period_start_month." ".$exp_time_period_start_year." ".$endmonthYear; 
									?>
								</li>
							<li id="liexperiance"><?php echo  $getworkexperianceData['exp_description'];  ?></li>
						</ul>  
                     </br>					
				</div> 
				
				
		<div class="experience-update" style="display:none;" id="educationeditpart_<?php echo $k; ?>">
		   <div class="modal-form">
			  
				    <fieldset>
					    <div class="form-block">
			             <label>COMPANY NAME<span style="color:red;">*</span></label>
						    <select name="exp_company_name[]"  title="Select company name" id="exp_company_name" class="select2"  data-placeholder="eg. Microsoft Corporation" onchange="Companynamefield(this.value,'<?php echo $k; ?>','0');" required />
							   <option value="" selected disabled >Select Company Name</option>
							   <?php 
							    if($getworkexperianceData['exp_company_name'] != ''){
									$com_name = $getworkexperianceData['exp_company_name'];
								}
							    echo get_dropdown_ForSingup(6,$com_name);	
							    ?> 
							    <option value="others" <?php  if($com_name == 'others') { echo "selected"; } ?>>others</option>
							</select>
			            </div>     
						  <input type="text" name="exp_company_name_inserted[]" title="Please enter optional field company name"  id="exp_company_name_inserted_<?php echo $k; ?>_0" value="<?php  echo $getworkexperianceData['exp_company_name_inserted']; ?>" placeholder="Enter Company Name" style='display:none;'  required/>
					
						<div class="form-block">
						 <label>TITLE<span style="color:red;">*</span></label>
						    <select name="exp_title[]" id="exp_title" class="select2"  title="Select job title" data-placeholder="eg. Software Developer" onchange="companyTitle(this.value,'<?php echo $k; ?>','1');"  required>
						     <option value="" selected disabled >Experience Title
							 </option>
								<?php
								if($getworkexperianceData['exp_title'] != ''){
									$exptitle = $getworkexperianceData['exp_title'];
								}
								echo get_dropdown_ForSingup(7,$exptitle);	
								?> 
						     <option value="others" <?php  if($exptitle == 'others') { echo "selected"; } ?>>others</option>
						    </select>
						</div>	
						 <input type="text" name="exp_title_name_inserted[]" title="Please enter optional job title" id="exp_title_name_inserted_<?php echo $k; ?>_1" value="<?php  echo $getworkexperianceData['exp_title_name_inserted']; ?>" placeholder="Enter optional job title" style='display:none;' required/>
			
			         <div class="form-block">
			              <label>TIME PERIOD<span style="color:red;">*</span></label>
					<ul class="inline-form">
					    <li>
					    <select name="exp_time_period_start_month[]" id="exp_time_period_start_month_<?php echo $k; ?>" onBlur="this.size=0;" onChange="this.size=0;" onmousedown="if(this.options.length>8){this.size=8;}" title="Select start month" required>
							 <optgroup style="max-height: 200px; height:200px; -webkit-appearance: none; -moz-appearance: none; appearance: none;" label="">
							   <option value="" selected  disabled style="margin-top:-18px;">Start Month </option>

								<?php  foreach($monthNames as $month) { ?>
								<option value="<?php  echo $month; ?>"<?php if($getworkexperianceData['exp_time_period_start_month'] == $month) echo 'selected="selected"'; ?>><?php  echo $month; ?></option>
								  <?php  } ?>
							 </optgroup>
					     </select>
					    </li>
						
						<li>          
						    <select name="exp_time_period_start_year[]" id="exp_time_period_start_year_<?php echo $k; ?>" onBlur="this.size=0;" onChange="this.size=0;" onmousedown="if(this.options.length>8){this.size=8;}" title="Select start year" required>
							 <optgroup style="max-height: 200px; height:200px; -webkit-appearance: none; -moz-appearance: none; appearance: none;" label="">
							   <option value="" selected disabled style="margin-top:-18px;">Start year</option>
								<?php  for($s_y= date('Y'); $s_y>='1950'; $s_y--) { ?>
								<option value="<?php  echo $s_y; ?>"<?php if($getworkexperianceData['exp_time_period_start_year'] == $s_y) echo 'selected="selected"'; ?>><?php  echo $s_y; ?></option>
							  <?php  } ?>
							  </optgroup>
						    </select>
						</li>
                      <?php //if ($getworkexperianceData['currently_work_here'] == "0"){ ?>
						<div id="autoUpdate_<?php echo $k;  ?>" class="autoUpdate">
						   <li>
						     <span class="hiphen">-</span>
						   </li>
						
						    <li>
								<select name="exp_time_period_end_month[]" id="exp_time_period_end_month_<?php echo $k; ?>" onBlur="this.size=0;" onChange="this.size=0;" onmousedown="if(this.options.length>8){this.size=8;}">
									<optgroup style="max-height: 200px; height:200px; -webkit-appearance: none; -moz-appearance: none; appearance: none;" label="">
									   <option value="" selected disabled style="margin-top:-18px;">End Month</option>
									   <?php  foreach($monthNames as $end_month) { ?>
									  <option value="<?php  echo $end_month; ?>"<?php if($getworkexperianceData['exp_time_period_end_month'] == $end_month) echo 'selected="selected"'; ?>><?php  echo $end_month; ?></option>
									  <?php  } ?>
									 </optgroup>
								 </select>
							</li>
				
							<li>
							    <select name="exp_time_period_end_year[]" id="exp_time_period_end_year_<?php echo $k; ?>" onBlur="this.size=0;" onChange="this.size=0;" onmousedown="if(this.options.length>8){this.size=8;}">
								   <optgroup style="max-height: 200px; height:200px; -webkit-appearance: none; -moz-appearance: none; appearance: none;" label="">
									<option value="" selected disabled style="margin-top:-18px;">End year</option>
									<?php  for($e_y= date('Y'); $e_y>='1950'; $e_y--) { ?>
								   <option value="<?php  echo $e_y; ?>" <?php if($getworkexperianceData['exp_time_period_end_year'] == $e_y) echo 'selected="selected"'; ?>><?php  echo $e_y; ?></option>
									<?php  } ?>
									</optgroup>
							    </select>
							</li> 
						</div> 
				    <?php // } ?>
							<li> 
							   <input type="checkbox" name="checkboxinput[]" class="css-checkbox" value=""  id="checkbox_<?php echo $k;  ?>" <?php if($getworkexperianceData['currently_work_here'] == '1') { echo "checked"; }  ?>   ><label for="checkbox_<?php echo $k;  ?>" class="css-label">I currently work here</label>
							</li>
			        </ul>
					<input type="hidden" name="user_id[]" value="<?php echo $user_id; ?>">
					<input type="hidden" name="exp_id[]" value="<?php echo $getworkexperianceData['exp_id']; ?>">
                        
			        </div>
						<div class="form-block">
							<label>DESCRIPTION</label>
							<textarea id="exp_description_<?php echo $k; ?>" placeholder="Enter your work profile description" name="exp_description[]"  ><?php  if($getworkexperianceData['exp_description'] != '') { echo $getworkexperianceData['exp_description']; } ?></textarea>
						</div>

						<div class="onoffswitch">
						   <input type="checkbox" name="exp_show_hide[]" class="onoffswitch-checkbox" id="exp_<?php echo $k; ?>" <?php if($getworkexperianceData['exp_show_hide'] == '0'){ echo  "checked";} ?>  >
						    <label class="onoffswitch-label" for="exp_<?php echo $k;  ?>"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
						</div>
						<div class="clearfix"></div>
			            
						    <button type="submit" id="update_experience123" class="btn-type-submit" />Update</button>
							<a class="cancel_btn" onclick="experienceupdatehide('<?php echo $k; ?>');" >Cancel</a>
						
			        </fieldset>
		    </div>
			<script  language="javascript" type="text/javascript">
				$(document).ready(function () {
					
					<?php   if($getworkexperianceData['exp_company_name']  == 'others') { ?>
									Companynamefield('<?php echo $getworkexperianceData['exp_company_name']; ?>','<?php echo $k ?>','0');
					<?php  } ?>
							
					<?php if($getworkexperianceData['exp_title']  == 'others') { ?>
									companyTitle('<?php echo $getworkexperianceData['exp_title']; ?>','<?php echo $k ?>','1');
					<?php  } ?>
				
					 var divID = '<?php echo $k;  ?>';
						$('#checkbox_'+divID).change(function () {
						//$('#checkbox_'+divID).on('change', 'input[type=checkbox]', function() {  
						if (!this.checked) 
						//  ^
						$('#autoUpdate_'+divID).fadeIn('fast');
						else 
						$('#autoUpdate_'+divID).fadeOut('fast');
						});  
				});	
			</script>
		</div>
		  <?php $k++;  $countexp++; } ?>
	</form> 
	
	    <div class="form-block" >
		    <div class="add-new-degree">
	        <span><a onclick="addnewexpriance();">Add new experiance</a></span>
		 </div>
		 </div>
		  
		  
		<div class="experience-update" style="display:none;" id="add_new_expriance">
		 <form method="post" action="ajax/add_new_exp.php" id="add_new_exp">	
		   <div class="modal-form">
			  
				    <fieldset>
					    <div class="form-block">
			             <label>COMPANY NAME<span style="color:red;">*</span></label>
						    <select name="exp_company_name"  title="Select company name" id="exp_company_name" class="select2"  data-placeholder="eg. Microsoft Corporation" onchange="addCompanynamefield(this.value);" required />
							   <option value="" selected disabled >Insert Company Name</option>
							   <?php 
							    echo get_dropdown_ForSingup(6);	
							    ?> 
							    <option value="others">others</option>
							</select>
			            </div>     
						  <input type="text" name="exp_company_name_inserted" title="Please enter optional field company name"  id="exp_company_name_inserted" value="" placeholder="Enter Company Name" style='display:none;'  required/>
					
						<div class="form-block">
						 <label>TITLE<span style="color:red;">*</span></label>
						    <select name="exp_title" id="exp_title" class="select2"  title="Select job title" data-placeholder="eg. Software Developer" onchange="addcompanyTitle(this.value);"  required>
						     <option value="" selected disabled >Experience Title
							 </option>
								<?php
								echo get_dropdown_ForSingup(7);	
								?> 
						     <option value="others">others</option>
						    </select>
						</div>	
						 <input type="text" name="exp_title_name_inserted" title="Please enter optional job title" id="exp_title_name_inserted" value="" placeholder="Enter optional job title" style='display:none;' required/>
			
			         <div class="form-block">
			              <label>TIME PERIOD<span style="color:red;">*</span></label>
					<ul class="inline-form">
					    <li>
					    <select name="exp_time_period_start_month" id="exp_time_period_start_month" onBlur="this.size=0;" onChange="this.size=0;" onmousedown="if(this.options.length>8){this.size=8;}" title="Select start month" required>
							 <optgroup style="max-height: 200px; height:200px; -webkit-appearance: none; -moz-appearance: none; appearance: none;" label="">
							   <option value="" selected  disabled style="margin-top:-18px;">Start Month </option>

								<?php  foreach($monthNames as $month) { ?>
								<option value="<?php  echo $month; ?>"<?php //if($getworkexperianceData['exp_time_period_start_month'] == $month) echo 'selected="selected"'; ?>><?php  echo $month; ?></option>
								  <?php  } ?>
							 </optgroup>
					     </select>
					    </li>
						
						<li>          
						    <select name="exp_time_period_start_year" id="exp_time_period_start_year" onBlur="this.size=0;" onChange="this.size=0;" onmousedown="if(this.options.length>8){this.size=8;}" title="Select start year" required>
							 <optgroup style="max-height: 200px; height:200px; -webkit-appearance: none; -moz-appearance: none; appearance: none;" label="">
							   <option value="" selected disabled style="margin-top:-18px;">Start year</option>
								<?php  for($s_y= date('Y'); $s_y>='1950'; $s_y--) { ?>
								<option value="<?php  echo $s_y; ?>"<?php //if($getworkexperianceData['exp_time_period_start_year'] == $s_y) echo 'selected="selected"'; ?>><?php  echo $s_y; ?></option>
							  <?php  } ?>
							  </optgroup>
						    </select>
						</li>
                   <?php //if ($getworkexperianceData['currently_work_here'] == "0"){ ?>
						<div id="autoUpdate" class="autoUpdate">
						   <li>
						     <span class="hiphen">-</span>
						   </li>
						
						    <li>
								<select name="exp_time_period_end_month" id="exp_time_period_end_month" onBlur="this.size=0;" onChange="this.size=0;" onmousedown="if(this.options.length>8){this.size=8;}">
									<optgroup style="max-height: 200px; height:200px; -webkit-appearance: none; -moz-appearance: none; appearance: none;" label="">
									   <option value="" selected disabled style="margin-top:-18px;">End Month</option>
									   <?php  foreach($monthNames as $end_month) { ?>
									  <option value="<?php  echo $end_month; ?>"<?php // if($getworkexperianceData['exp_time_period_end_month'] == $end_month) echo 'selected="selected"'; ?>><?php  echo $end_month; ?></option>
									  <?php  } ?>
									 </optgroup>
								 </select>
							</li>
				
							<li>
							    <select name="exp_time_period_end_year" id="exp_time_period_end_year" onBlur="this.size=0;" onChange="this.size=0;" onmousedown="if(this.options.length>8){this.size=8;}">
								   <optgroup style="max-height: 200px; height:200px; -webkit-appearance: none; -moz-appearance: none; appearance: none;" label="">
									<option value="" selected disabled style="margin-top:-18px;">End year</option>
									<?php  for($e_y= date('Y'); $e_y>='1950'; $e_y--) { ?>
								   <option value="<?php  echo $e_y; ?>" <?php //if($getworkexperianceData['exp_time_period_end_year'] == $e_y) echo 'selected="selected"'; ?>><?php  echo $e_y; ?></option>
									<?php  } ?>
									</optgroup>
							    </select>
							</li> 
						</div> 
				        <?php // } ?>
							<li> 
							   <input type="checkbox" name="addcheckbox" class="css-checkbox" value= "1"  id="addcheckbox" ><label for="addcheckbox" class="css-label">I currently work here</label>
							</li>
			        </ul>
					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
					<input type="hidden" name="details_id" value="<?php echo $getUserData['details_id']; ?>">
					     
			        </div>
						<div class="form-block">
							<label>DESCRIPTION</label>
							<textarea id="exp_description" placeholder="Enter your work profile description" name="exp_description"  ></textarea>
						</div>

						<div class="onoffswitch">
						   <input type="checkbox" name="exp_show_hide" class="onoffswitch-checkbox" id="exp" checked >
						    <label class="onoffswitch-label" for="exp"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
						</div>
						<div class="clearfix"></div>
			            
						    <button type="submit" id="add_new_exp" class="btn-type-submit" />Save</button>
							<a class="cancel_btn" onclick="addnewexperience();" >Cancel</a>
						
			        </fieldset>
		    </div>
		 </form>
		</div>
       <div class="clearfix"></div>
     	 <hr>	
      </div>  
    
      <div class="clearfix"></div>
      <div class="box" id="skills1">
      <h3>Skills - <span id="skills-edit" class="edit-btn" onclick="showskils();"><i class="fa fa-pencil"></i></span></h3>      
      <ul class="list">
		<?php $setskill = array(); $getSkilla  = explode(',',$getUserData['emp_skills']); ?>
		<?php $i=0; foreach($getSkilla as $key=>$getskillvalue) { ?>
		<li><?php  echo $getskillvalue; $setskill[] = $getskillvalue;  ?></li>
		<?php $i++; } ?>
      </ul>
			<div class="skills-update" id="skills-update-show" style="display:none;">				
				<div class="modal-form">
					<form method="POST" enctype="multipart/form-data" action="" >
						<fieldset>
						 <div class="form-block">
							<input type="text" placeholder="Enter interests" value="<?php if($setskill !='') {  echo implode(',',$setskill); } ?>"  class="singleFieldTags" id="interests" name="interests">
						 </div>  
							<div class="onoffswitch">
							   <input type="checkbox" name="exp_show_hide" class="onoffswitch-checkbox" id="exp" checked >
								<label class="onoffswitch-label" for="exp"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
							</div>
							<div class="clearfix"></div>
							<input type="submit"  style="margin-top: 20px;" class="btn pull-lefts" value="Save" onClick="return checkdate();" name="exp_details"  >
							<a class="cancel_btn" onclick="addnewexperience();" >Cancel</a>
						</fieldset>
					</form>
				</div>			
			</div>
      </div>   
    <hr>		  
		<div class="box" id="languages1">
		    <h3>Languages - <span id="languages-edit" class="edit-btn" href="#"><i class="fa fa-pencil"></i></span></h3>      
				<ul class="list">
				  <?php $getlanguagedata = array(); $getlanguage  = explode(',',$getUserData['languages']); ?>
					<?php $l=0; foreach($getlanguage as $key1=>$getlanguagevalue) { ?>
					<li><?php  echo $getlanguagevalue; $getlanguagedata[] = $getlanguagevalue;  ?></li>
					<?php $l++; } ?>
				</ul>
			<div class="languages-update" style="display:none;">				
					<div class="modal-form">
						<form method="POST" enctype="multipart/form-data" action="" >
						  <input type="hidden" name="details_id" id="details_id" value="23">
							<fieldset>
								<div class="form-block">
								   <input type="text" name="exp_title_name_inserted"  value="<?php if($getlanguagedata !='') {  echo implode(',',$getlanguagedata); } ?>"  title="Please enter optional job title" id="color1" placeholder="Enter job title" required/>
								</div>     
											
								<div class="onoffswitch">
									<input type="checkbox" name="exp_show_hide" class="onoffswitch-checkbox" id="exp" checked >
									<label class="onoffswitch-label" for="exp"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
								</div>
								
								<div class="clearfix"></div>
								  <input type="submit"  style="margin-top: 20px;" class="btn pull-lefts" value="Save" onClick="return checkdate();" name="exp_details"  >
								<input type="submit" class="canc_1" name="submit" value="Cancel" />
							</fieldset>
						</form>
					</div>			
			</div>
        </div>  
     <hr>		  
    <div class="box" id="interests1">
            <h3>Interests - <span id="interests-edit" class="edit-btn" href="#"><i class="fa fa-pencil"></i></span></h3>      
			<ul class="list">
			    <?php $getinterests = array(); $getinterestsdata  = explode(',',$getUserData['interests']); ?>
			    	<?php $l=0; foreach($getinterestsdata as $key1=>$getgetinterestsdata) { ?>
				      <li><?php  echo $getgetinterestsdata; $getinterests[] = $getgetinterestsdata;  ?></li>
				<?php $l++; } ?>
			</ul>
	    <div class="interests-update" style="display:none;">				
				<div class="modal-form">
				   <form method="POST" enctype="multipart/form-data" action="" >
					 	<fieldset>
							<div class="form-block">
							   <input type="text" name="exp_title_name_inserted" title="Please enter optional job title" id="color1" value="<?php if($getinterests != '') { echo implode(',',$getinterests);  }  ?>" placeholder="Enter job title" required/>
							</div>     
																
							<div class="onoffswitch">
							   <input type="checkbox" name="exp_show_hide" class="onoffswitch-checkbox" id="exp" checked >
								<label class="onoffswitch-label" for="exp"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
							</div>
							<div class="clearfix"></div>
							<input type="submit"  style="margin-top: 20px;" class="btn pull-lefts" value="Save" onClick="return checkdate();" name="exp_details"  >
							<input type="submit" class="canc_1" name="submit" value="Cancel" />
						</fieldset>
					</form>
		        </div>			
		</div>
    </div>      
	 <hr>	
	 
	  
      <div class="box" id="current-situation1">
	   <?php // if($getUserData  == '') { ?>
		<h3>Current Situation -</h3> 
        
       <?php
	    
      if($getUserData['your_current_situation'] !='') { ?>      
		  <div class="box" id="career_change_showDAta">
             <h6 class="h6class">&bull; How open are you to making a career change? - <span id="how_open_are" class="edit-btn" onclick="updatecareerchange();"><i class="fa fa-pencil"></i></span></h6>
			  <ul class="list">
			   <?php if($getUserData['your_current_situation'] == 'others') { ?>
			  <li><a><?php  echo $getUserData['your_current_situation_value']; ?></a></li>
			  <?php  } else { ?>
			    <li><a><?php  echo get_ExpvalueByID($getUserData['your_current_situation']); ?></a></li>
			  <?php  } ?>
			  </ul>
		  </div>  
		   
			<div class="career_change_update" id="career_change_update" style="display:none;">				
				<div class="modal-form">
					<fieldset>
						<div class="form-block">
						   <label> How open are you to making a career change?	<span style="color:red;">*</span></label>
							 <select name="your_current_situation" title="Choose your select field" onclick="checkOtherValue(this.value);" id="your_current_situation" required>
									<option value="">Select how open are you to making a career change?</option>
									<?php 
									echo get_dropdown_ForSingup(16,$getUserData['your_current_situation']);					
									?> 
									<option value="others"<?php if($getUserData['your_current_situation'] == 'others') { echo "selected"; } ?> >Other</option>
							</select>
							  <div id ="your_current_situation_erro"></div>
							   <input type="text" name="your_current_situation_value" id="your_current_situation_value" placeholder="Enter how open are you to making a career change?" value="<?php  if($getUserData['your_current_situation_value'] != '') { echo $getUserData['your_current_situation_value'];} ?>" style='display:none;'/>
						</div>  
						
							<div class="clearfix"></div>
							<button onclick="careerchangeupdate();" class="cancel_btn" style="background: #58A456 none repeat scroll 0 0;">Update</button>	
							<a class="cancel_btn" onclick="updatecareerchangehide();" >Cancel</a>
					</fieldset>
				</div>  
            </div>  
			<hr>	
        <?php } ?>  
      
       <?php  if($getUserData['make_you_move'] !='') { ?>      
			    <div class="box" id="make_you_move_update">  
				 <h6 class="h6class">&bull; What would make you move? - <span id="interests-edit" class="edit-btn" onclick="updatemakeyoumove();"><i class="fa fa-pencil"></i></span></h6>
					  <ul class="list">
					  <?php if($getUserData['make_you_move'] == 'others') { ?>
						 <li><a><?php  echo $getUserData['make_you_move_yes']; ?></a></li>
					  <?php  }else { ?>
					     <li><a><?php echo get_ExpvalueByID($getUserData['make_you_move']); ?></a></li>
					  <?php  } ?>
					  </ul>
			    </div>
       	
            <div class="make_you_move" id="make_you_move" style="display:none;">				
			  <div class="modal-form">
				<fieldset>
					<div class="form-block">
                      <label> What would make you move?	<span style="color:red;">*</span></label>
						   <?php  $sqlcheck = mysql_query("select * from tbl_experience where experience_type = '12' and status = '1'"); 
							 echo  "<ul  class = 'form_gap_list'>";
							while($datah = mysql_fetch_array($sqlcheck)) {
							$checked = (in_array($getUserData['make_you_move'], $datah)) ? 'checked' : '';
							// echo $make_you_move."==".$checked;
							echo "<li>"."<input type='radio' name='make_you_move' id='make_you_move'  onclick='javascript:yesnoCheck3();' value=".$datah['id']." ".$checked."/>".$datah['experience_skill']."</li>"; 
							} 
							echo "</ul>";
							?>
						
						<div class="option_feild">
							 <?php $checked12 = ($getUserData['make_you_move'] ==  'others') ? 'checked' : ''; ?>
							<label id="ans-3"><input type="radio" onClick="javascript:yesnoCheck3();" name="make_you_move" value="others" id="yesCheck3" <?php echo $checked12; ?>><span>Another Answer</span>
							</label>
							<div id="ifYes3" style="display:none">
								 If yes, explain: <input type='text' id='make_you_move_yes' value="<?php if($getUserData['make_you_move_yes'] !='') { echo $getUserData['make_you_move_yes']; }  ?>" placeholder="Enter what would make you move?"  name='make_you_move_yes'   required>
							</div>
						</div>
					</div>  
					    <div class="clearfix"></div>
							<button onclick="makeyoumoveupdate();" class="cancel_btn" style="background: #58A456 none repeat scroll 0 0;">Update</button>	
							<a class="cancel_btn" onclick="updatemakemovehide();" >Cancel</a>
		        
			    </fieldset>
             </div> 
                	 
            </div>  		 
      <?php } ?>  
       <hr>	
       <?php //your current situtation check 
      if($getUserData['your_current_work'] !='') {?>      
		  <div class="box" id="show_culture_your_current_work_update"> 
              <h6 class="h6class">&bull; How is the culture at your current work? - <span id="interests-edit" class="edit-btn" onclick="showcurrentwork();"><i class="fa fa-pencil"></i></span></h6>  
			  <ul class="list">
			  <?php if($getUserData['your_current_work'] == 'others') { ?>
			    <li><a><?php  echo $getUserData['your_current_work_yes']; ?></a></li
			  <?php  }else { ?>
			  <li><a><?php echo get_ExpvalueByID($getUserData['your_current_work']); ?></a></li>
			  <?php  } ?>
			  </ul>
		  </div> 
          
            <div class="culture_your_current_work" id="culture_your_current_work_update" style="display:none;">				
			  <div class="modal-form">
				<fieldset>
					<div class="form-block">
                      <label> How is the culture at your current work?	<span style="color:red;">*</span></label>
					  <?php  $sqlcheck = mysql_query("select * from tbl_experience where  experience_type = '13' and status = '1'"); 
					    echo  "<ul  class = 'form_gap_list'>";
						while($datah = mysql_fetch_array($sqlcheck)) {
							
							   $checked = (in_array($getUserData['your_current_work'], $datah)) ? 'checked' : '';
							
							// echo $make_you_move."==".$checked;
							echo "<li>"."<input type='radio' name='your_current_work' id='your_current_work'  onclick='javascript:currentwork();' value=".$datah['id']." ".$checked."  />".$datah['experience_skill']."</li>"; 
						   }
						   echo  "</ul>";
						?>
						
						<div class="option_feild">
							<?php $checked12 = ($getUserData['your_current_work'] ==  'others') ? 'checked' : ''; ?>
							<label id="ans-3">
							     <input type="radio" onClick="javascript:currentwork();" name="your_current_work" value="others" id="yesCheck1" <?php  if($checked12 !='') { echo $checked12;} ?>><span>Another Answer</span>
							</label>
							<div id="ifYes1" style="display:none">
							   If yes, explain: <input type='text'  placeholder="Enter how is the culture at your current work?" id='your_current_work_yes' value="<?php if($getUserData['your_current_work_yes'] !='') { echo $getUserData['your_current_work_yes']; }  ?>" name='your_current_work_yes' >
							</div>
						</div>
					</div>  
					    <div class="clearfix"></div>
							<button onclick="currentworkupdate();" class="cancel_btn" style="background: #58A456 none repeat scroll 0 0;">Update</button>	
							<a class="cancel_btn" onclick="hidecurrentwork();" >Cancel</a>
		        
			    </fieldset>
             </div> 
                	 
            </div> 		  
		   <hr>
      <?php } ?>  
      
       <?php //your current situtation check
 	   
      if($getUserData['paid_fairly'] !='') { ?>      
		  <div class="box" id="show_paid_fairly"> 
              <h6 class="h6class">&bull; Are you paid fairly? -  <span id="interests-edit" class="edit-btn"  onclick="updatepaidfairly();"><i class="fa fa-pencil"></i></span></h6>  
			  <ul class="list">
			   <?php if($getUserData['paid_fairly'] == 'others') { ?>
			    <li><a><?php  echo $getUserData['paid_fairly_yes']; ?></a></li
			  <?php  }else { ?>
			  <li><a><?php echo get_ExpvalueByID($getUserData['paid_fairly']); ?></a></li>
			  <?php  } ?>
			  </ul>
		  </div>
		
		<div class="paid_fairly" id="paid_fairly" style="display:none;">				
			  <div class="modal-form">
				<fieldset>
					<div class="form-block">
                      <label> Are you paid fairly?	<span style="color:red;">*</span></label>
					  <?php  $sqlcheck = mysql_query("select * from tbl_experience where experience_type = '14' and status = '1'"); 
						 echo  "<ul  class = 'form_gap_list'>";
						while($datah = mysql_fetch_array($sqlcheck)) {
						$checked = (in_array($getUserData['paid_fairly'], $datah)) ? 'checked' : '';
						// echo $make_you_move."==".$checked;
						echo "<li>"."<input type='radio' name='paid_fairly' id='paid_fairly'  onclick='javascript:addpaidfairly();' title='Please Choose Are You Paid Fairly' value=".$datah['id']." ".$checked." />".$datah['experience_skill']."</li>"; 
						}
						 echo "</ul>";
						?>
						
						<div class="option_feild">
							<?php $checked12 = ($getUserData['paid_fairly'] ==  'others') ? 'checked' : ''; ?>
							 <div class="option_feild">
								  <label id="ans-4"><input type="radio" onClick="javascript:addpaidfairly();" name="paid_fairly"  value="others" id="yesCheck2" <?php if($checked12 != '') { echo $checked12;} ?>><span>Another Answer</span></label>
								  <div id="ifYes2" style="display:none">If yes, explain: <input type='text'  placeholder="Enter are you paid fairly?" id="paid_fairly_yes" value="<?php  if($getUserData['paid_fairly_yes'] != '') { echo  $getUserData['paid_fairly_yes']; } ?>" name='paid_fairly_yes' required>
								  </div>
							 </div>
						</div>
					</div>  
					    <div class="clearfix"></div>
							<button onclick="paidfairlyupdate();" class="cancel_btn" style="background: #58A456 none repeat scroll 0 0;">Update</button>	
							<a class="cancel_btn" onclick="hidepaidfairly();" >Cancel</a>
		        
			    </fieldset>
             </div> 
                	 
        </div> 	
		  
           <hr>			  
      <?php } ?>  
      
       <?php //your current situtation check 
      if($getUserData['mentoring_people'] !='') { ?>      
		  <div class="box" id="mentoring_people"> 
              <h6 class="h6class">&bull; Do you like to mentoring people? - <span id="interests-edit" class="edit-btn" onclick="updatementoringpeople();"><i class="fa fa-pencil"></i></span></h6>  
			  <ul class="list">
			  <?php if($getUserData['mentoring_people'] == 'others') { ?>
			    <li><a><?php  echo $getUserData['mentoring_people_yes']; ?></a></li
			  <?php  }else { ?>
			  <li><a><?php echo get_ExpvalueByID($getUserData['mentoring_people']); ?></a></li>
			  <?php  } ?>
			  </ul>
		  </div>  
		   
		<div class="mentoring_people_update" id="mentoring_people_update" style="display:none;">				
			  <div class="modal-form">
				<fieldset>
					<div class="form-block">
                      <label> Do you like to mentoring people?	<span style="color:red;">*</span></label>
					<div class="inputs" id="content_5">  
						<?php  $sqlcheck = mysql_query("select * from tbl_experience where experience_type = '15' and status = '1'"); 
							  echo  "<ul  class = 'form_gap_list'>";
								while($datah = mysql_fetch_array($sqlcheck)) {
								$checked = (in_array($getUserData['mentoring_people'], $datah)) ? 'checked' : '';
								// echo $make_you_move."==".$checked;
								echo "<li>"."<input type='radio' id='mentoring_people' name='mentoring_people'  onclick='javascript:addmentoringpeople();' title='Please Choose Do you like to mentoring people' value=".$datah['id']." ".$checked." />".$datah['experience_skill']."</li>"; 
								}
								echo "</ul>";
						?>
					</div>	
					<div class="option_feild">
						<?php $checked12 = ($getUserData['mentoring_people'] ==  'others') ? 'checked' : ''; ?>
						<label id="ans-3"><input type="radio" onClick="javascript:addmentoringpeople();" name="mentoring_people" value="others" id="yesCheck11"  <?php if($checked12 != '')  { echo $checked12; } ?>><span>Another Answer</span>
						</label>
						<div id="ifYes11" style="display:none">
						If yes, explain: <input type='text'  placeholder="Please enter optional do you like to mentoring people" id='mentoring_people_yes'  value="<?php if($getUserData['mentoring_people_yes'] != '') { echo  $getUserData['mentoring_people_yes']; } ?>" name='mentoring_people_yes'  required>
						</div>
					</div>
					</div>  
					    <div class="clearfix"></div>
							<button onclick="updatementoringpeopledata();" class="cancel_btn" style="background: #58A456 none repeat scroll 0 0;">Update</button>	
							<a class="cancel_btn" onclick="mentoringpeoplehide();" >Cancel</a>
		        
			    </fieldset>
             </div> 
                	 
        </div> 
          <hr>				  
      <?php } ?>  
      
       <?php //your current situtation check 
      if($getUserData['good_and_what_you_do'] !='') { ?>      
		  <div class="box" id="good_and_what_you_do_update_data"> 
              <h6 class="h6class">&bull; How good are you at what you do? - <span id="interests-edit" class="edit-btn" onclick="updatewhatyoudo();"><i class="fa fa-pencil"></i></span></h6>  
			  <ul class="list">
			    <li><a><?php echo get_ExpvalueByID($getUserData['good_and_what_you_do']); ?></a></li>
			  </ul>
		  </div>  
          
		<div class="good_and_what_you_do_update" id="good_and_what_you_do_update" style="display:none;">				
		    <div class="modal-form">
				<fieldset>
					<div class="form-block">
                      <label>How good are you at what you do?	<span style="color:red;">*</span></label>
					<div class="inputs" id="content_5">  
						<?php  $sqlcheck = mysql_query("select * from tbl_experience where experience_type = '19' and status = '1'"); 
							echo  "<ul  class = 'form_gap_list'>";
							while($datah = mysql_fetch_array($sqlcheck)) {
							$checked = (in_array($getUserData['good_and_what_you_do'], $datah)) ? 'checked' : '';
							// echo $make_you_move."==".$checked;
							echo "<li>"."<input type='radio' name='good_and_what_you_do'  onclick='javascript:yesnoCheck11();' title='Please Choose How good are you at what you do?' value=".$datah['id']." ".$checked." />".$datah['experience_skill']."</li>"; 
							}
							echo "</ul>";
						 ?> 
					</div>	
					</div>  
					    <div class="clearfix"></div>
						 <button onclick="updatewhatyoudodata();" class="cancel_btn" style="background: #58A456 none repeat scroll 0 0;">Update</button>	
						<a class="cancel_btn" onclick="updatewhatyoudohide();" >Cancel</a>
			    </fieldset>
            </div> 
                	 
        </div> 
		  
		<?php }  ?>
		
	 
      </div> 
     <hr>			
		 <div class="box" id="video1">
			<h3>Video - <span id="interests-edit" class="edit-btn" onclick="updatevideo();"><i class="fa fa-pencil"></i></span></h3> 
			
			    <div class="clearfix"></div>
			<?php if($getUserData['emp_video_or_company_video'] != ""){ ?> 
			    <!-- <a href=""><img src="img/video.png"></a>-->      
			  <iframe width="88%" height="350px" src="<?php echo $getUserData['emp_video_or_company_video']; ?>"></iframe>
			<?php } else { ?>
			     <h6 class="h6class" style="font-weight: 300 !important;"> Video not uploaded</h6>  
			<?php } ?>  
			<hr/>
			
		</div> 
		
		
		  <div class="uploadevideo" id="uploadevideo" style="display:none;">				
			  <div class="modal-form">
				<fieldset>
					<div class="form-block">
                      <label>Embed youtube video link	<span style="color:red;">*</span></label>
					<div class="inputs" id="content_5">  
						 <input type="text"  placeholder="https://www.youtube.com/embed/XGSy3_Czz8k" name="emp_video_or_company_video" id="emp_video_or_company_video" value="<?php echo $getUserData['emp_video_or_company_video']; ?>" style="width: 100%;">
					</div>	
					</div>  
					    <div class="clearfix"></div>
							<button onclick="add_video_link();" class="cancel_btn" style="background: #58A456 none repeat scroll 0 0;">Update</button>	
							<a class="cancel_btn" onclick="cancelvideouploade();" >Cancel</a>
		        
			    </fieldset>
             </div> 
                	 
        </div> 
		   
        </div>
		<div class="right-panel">
			<div class="boxes">
			  <h2>your profile</h2>
				<div class="box">
				   <?php $url = parse_url($getUserData['emp_logo_or_company_logo']);
							  if($url['scheme'] == 'https'){
							 $fbimg = $getUserData['emp_logo_or_company_logo'];
							 ?>
						   <div class="left-img"> <img src="<?php echo $fbimg; ?>"> </div>
						 
						 <?php 
						 $percentage = "100%";
						} else {
						$img = explode('.',$getUserData['emp_logo_or_company_logo']);
						$checkImage = $img[1];
						if(!empty($checkImage)){ 
						   $percentage = "100%";
						?> 
						  <div class="left-img"> <img src="./uploads/profile_photo/<?php echo $getUserData['emp_logo_or_company_logo'];?>" class="profile-image"/></div>
						<?php }else{
							 $percentage = "95%";
						?> 
							 <div class="left-img"> <img src="img/anonymous-man.png" class="profile-image"> </div>
						<?php } } ?>
							 
					<div class="detail">
						  <p class="name"><?php echo $getUserRegistrationdata['first_name']."  ".$getUserRegistrationdata['last_name']; ?></p>
						  <div id="myProgress">
							<div id="myBar" style="width: <?php echo $percentage; ?>;"></div>
						  </div>
						  <p><?php echo $percentage; ?> Completed</p>
						  <p><a href="" class="border-link">Edit Profile</a></p>
					</div>
				</div>
			</div>
			<div class="clearfix"></div> 
		</div>
    </section>
		
<script>

 

 /* ================== Education Open Text Field =============== */
	 function CheckCompany(val,divid,id){
		// alert(val+"=="+divid+"=="+id);
	 var element=document.getElementById('education_school_inserted_'+divid+'_'+id);
	 if(val=='others')
	   element.style.display='block';
	 else  
	   element.style.display='none';
	}

	function CheckTitle(val,divid,id){
	 var element=document.getElementById('education_degree_inserted_'+divid+'_'+id);
	 if(val=='others')
	   element.style.display='block';
	 else  
	   element.style.display='none';
	}

	function educationfieldofstudy(val,divid,id){
	 var element=document.getElementById('education_field_of_study_inserted_'+divid+'_'+id);
	 if(val=='others')
	   element.style.display='block';
	 else  
	   element.style.display='none';
	} 

	
	 function CheckCompany1(val){
		 //alert(val+"=="+divid+"=="+id);
	 var element=document.getElementById('education_school_inserted');
	 if(val=='others')
	   element.style.display='block';
	 else  
	   element.style.display='none';
	}

	function CheckTitle1(val){
	 var element=document.getElementById('education_degree_inserted');
	 if(val=='others')
	   element.style.display='block';
	 else  
	   element.style.display='none';
	}

	function educationfieldofstudy1(val){
	 var element=document.getElementById('education_field_of_study_inserted');
	 if(val=='others')
	   element.style.display='block';
	 else  
	   element.style.display='none';
	} 

 /* ==================End of experience Open Text Field =============== */
 
 /* ==================	Experience Open Text Field =============== */
	function Companynamefield(val,divid,id){
		//alert(val+"=="+divid+"==first"+id);
		var element=document.getElementById('exp_company_name_inserted_'+divid+'_'+id);
		if(val=='others')
		element.style.display='block';
		else  
		element.style.display='none';
	}
	function companyTitle(val,divid,id){
		//alert(val+"Last"+divid+"=="+id);
		var element=document.getElementById('exp_title_name_inserted_'+divid+'_'+id);
		if(val=='others')
		element.style.display='block';
		else  
		element.style.display='none';
	}
	
	
	function addCompanynamefield(val){
		//alert(val+"=="+divid+"==first"+id);
		var element=document.getElementById('exp_company_name_inserted');
		if(val=='others')
		element.style.display='block';
		else  
		element.style.display='none';
	}
	function addcompanyTitle(val){
		//alert(val+"Last"+divid+"=="+id);
		var element=document.getElementById('exp_title_name_inserted');
		if(val=='others')
		element.style.display='block';
		else  
		element.style.display='none';
	}
	
	
	$(document).ready(function () {
    $('#addcheckbox').change(function () {
        if (!this.checked) 
        //  ^
           $('#autoUpdate').fadeIn('fast');
        else 
            $('#autoUpdate').fadeOut('fast');
        });
    });
	
  
 $(document).ready(function(){
	
	
	$('#skills-edit').click(function(){
		$('.skills-update').slideToggle("slow");		
	});
	$('#languages-edit').click(function(){
		$('.languages-update').slideToggle("slow");		
	});	
	$('#interests-edit').click(function(){
		$('.interests-update').slideToggle("slow");		
	});	
	
}); 

	function getCity(countryId) 
			{
		
				var stateId = '<?php echo $getUserData['state'];?>';
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
		</script>
		<script>
			$(document).ready(function(){
				
				
				$("#usernameedit").click(function(){
						$("#change-title-2").show();
						$("#change-title-21").hide();
						$("#addressshowid").hide();	 
						$("#showpersonaltagline").hide();									
				});
				$("#hideusernameedit").click(function(){
					  $("#change-title-2").hide();							
				});
				   
				$("#addresseditid").click(function(){
					$("#addressshowid").show();	
					$("#change-title-2").hide();
					$("#change-title-21").hide();
					$("#showpersonaltagline").hide();	
				});
				$("#addresscancel").click(function(){
				$("#addressshowid").hide();		
				});
				
				$("#personaltaglineedit").click(function(){
					$("#showpersonaltagline").show();
					$("#addressshowid").hide();	
					$("#change-title-2").hide();
					$("#change-title-21").hide();
					
				});
				$("#hidepersonaltaglineedit").click(function(){
				$("#showpersonaltagline").hide();
				});
				
				$("#profile-title-2").click(function(){
					$("#change-title-21").show();
					$("#showpersonaltagline").hide();
					$("#addressshowid").hide();	
					$("#change-title-2").hide();
				 
				});
				$("#hideindustry").click(function(){
				  $("#change-title-21").hide();		
				});
				
				
				 getfile('<?php echo $id; ?>');
				 getCity('<?php echo $getUserData['country'];  ?>');
				 yesnoCheck1('<?php echo $getUserData['industry'];  ?>');
				 checkOtherValue('<?php echo $getUserData['your_current_situation'];  ?>');
				 yesnoCheck3();
				 currentwork();
				 addpaidfairly();
				 addmentoringpeople();
			});
						
						
						
			function usernameupdate(){
				
				var userID = '<?php  echo $user_id ?>';
				var firstname =  $('#first_name').val();
				var lastname =  $('#last_name').val();
				var page = 'usernameupdate';
				resetErrors();
				//alert(firstname +"==" +lastname);
				var dataString = 'firstname='+ firstname + '&lastname='+ lastname + '&userid='+ userID +'&page='+ page;
				
					$.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
						 //location.reload();
						 if(resp.done==='success'){
				              location.reload();
                        } else {
						 // alert(resp);
						  $.each(resp, function(i, v) {
						  console.log(i + " => " + v); // view in console for error messages
							   var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
							   $('input[id="' + i + '"],input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
						     });
						  var keys = Object.keys(resp);
						  $('input[name="'+keys[0]+'"]').focus();
					    }
						return false;
					},
				error: function() {
				    console.log('there was a problem checking the fields');
					}
				});
			}

            function getfile(id){
				 var page = 'getfile';
				 var dataString = 'id='+ id +'&page='+ page;
				 $.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
					}
				    });
				}
				
            function addressSubmit(){
	//      			
				var userID = '<?php  echo $user_id ?>';
				var countryId =  $('#countryId').val();
				var stateId =  $('#stateId').val();
				var city =  $('#city').val();
				var zipcode =  $('#zipcode').val();
				var page = 'addressSubmit';
				resetErrors();
				//alert(firstname +"==" +lastname);
                var dataString = 'countryId='+ countryId +'&stateId='+ stateId + '&city='+ city + '&zipcode='+ zipcode +'&userid='+ userID +'&page='+ page;
				
				$.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
						 //location.reload();
						 if(resp.done==='success'){
				              location.reload();
                        } else {
						 // alert(resp);
						  $.each(resp, function(i, v) {
						  console.log(i + " => " + v); // view in console for error messages
							   var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
							   $('input[id="' + i + '"],input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
						     });
						  var keys = Object.keys(resp);
						  $('input[name="'+keys[0]+'"]').focus();
					    }
						return false;
					},
						error: function() {
							console.log('there was a problem checking the fields');
							}
				});
			}	

       /*======================== User  Personal Tagline=====================*/
				
	     function updatepersonaltagline(){
	
				var userID = '<?php  echo $user_id ?>';
				var personal_tagline =  $('#personal_tagline').val();
				var page = 'updatepersonaltagline';
				resetErrors();
				//alert(firstname +"==" +lastname);
       var dataString = 'personal_tagline='+ personal_tagline +'&userid='+ userID +'&page='+ page;
				
					$.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
						 //location.reload();
						 if(resp.done==='success'){
				              location.reload();
                        } else {
						 // alert(resp);
						  $.each(resp, function(i, v) {
						  console.log(i + " => " + v); // view in console for error messages
							   var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
							   $('input[id="' + i + '"],input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
						     });
						  var keys = Object.keys(resp);
						  $('input[name="'+keys[0]+'"]').focus();
					    }
						return false;
					},
				error: function() {
				    console.log('there was a problem checking the fields');
					}
				});
			}
			
					
			  function updateindustry(){
	
				var userID = '<?php  echo $user_id ?>';
				var industry =  $('#industry').val();
				var industry_value1 =  $('#industry_value1').val();
				var page = 'updateindustry';
				resetErrors();
				//alert(firstname +"==" +lastname);
               var dataString = 'industry='+ industry + '&industry_value1='+ industry_value1 + '&userid='+ userID +'&page='+ page;
				
					$.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
						 //location.reload();
						 if(resp.done==='success'){
				              location.reload();
                        } else {
						 // alert(resp);
						  $.each(resp, function(i, v) {
						  console.log(i + " => " + v); // view in console for error messages
							   var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
							   $('input[id="' + i + '"],input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
						     });
						  var keys = Object.keys(resp);
						  $('input[name="'+keys[0]+'"]').focus();
					    }
						return false;
					},
				error: function() {
				    console.log('there was a problem checking the fields');
					}
				});
			}
				
    /*======================== End Code of user  Personal Tagline=====================*/
					
		function resetErrors() {
			$('form input, form select').removeClass('inputTxtError');
			$('label.error').remove();
		}
				//}
			
				
	function  removeEducation(degreeid,divid){
	 
	 //alert(degreeid +"=="+ divid);
	var warning = 'Are you sure you want to delete this education ?';
		if (confirm(warning)) {
			 var userid = '<?php echo $user_id; ?>';
				var page = 'deleteeducationstep4';
				
				var dataString = 'degreeid='+ degreeid + '&userid='+ userid +'&page='+ page +'&divid='+ divid;
				$.ajax({
						type: "POST",
						url: "ajax/compnany_namesubmit.php",
						data: dataString,
						//dataType : "json",
						cache: false,
						success: function(result){
								$('#educationupdate_'+divid).remove();
								$('#deletemesg').show();
								$('#deletemesg').fadeOut(1500);
								/*  if($('#ulId').find('#liId').length <= 0) {
								$('#educationdiv').hide();
								}  */
						   }
						});
		}else {
				return false;
			} 
		
	}

	
	/* Delete Education  */
				function  deleteexperiance(expid,divid){

					var warning = 'Are you sure you want to delete this experience ?';
					if (confirm(warning)) {
					var userid = '<?php echo $user_id; ?>';
					var page = 'deleteexpjobstep3';

					var dataString = 'expid='+ expid + '&userid='+ userid +'&page='+ page +'&divid='+ divid;
					$.ajax({
						type: "POST",
						url: "ajax/compnany_namesubmit.php",
						data: dataString,
						//dataType : "json",
						cache: false,
						success: function(result){
							$('#experianceupdate_'+divid).remove()
							$('#deletemesgexperience').show();
							$('#deletemesgexperience').fadeOut(1500);
							if($('#ulexperiance').find('#liexperiance').length <= 0) {
							$('#experiancediv').hide();
							} 
						   }
						});
					}else {
					   return false;
					}

				}
	/* End Delete Education  */

    	 	 var data = {};
		$(document).ready(function() {
		$('input[type="submit"]').on('click', function() {
		//$('.btn pull-lefts').click(function(){
		//$('button[type="submit"]').addClass('disabled');
		resetErrors();
		var url = 'ajax/update_education.php';
            //divid = '<?php echo $getEducationData['user_add_degree_id']; ?>';
		  // alert(divid);
		var formData=$('#update_education').serialize();
		//alert(formData);
		$.ajax({
		dataType: 'json',
		type: 'POST',
		url: url,
		data: formData,
		success: function(resp) {
		  if(resp.done==='success'){
			 location.reload();
		  } else {
			 // alert(resp);
			  $.each(resp, function(i, v) {
			  console.log(i + " => " + v); // view in console for error messages
				  var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
				  $('input[id="' + i + '"], select[name="' + i + '"],select[id="' + i + '"]').addClass('inputTxtError').after(msg);
			  });
			  var keys = Object.keys(resp);
			  $('input[name="'+keys[0]+'"]').focus();
		  }
		  return false;
		},
		error: function() {
		  console.log('there was a problem checking the fields');
		}
		});
		return false;
		});
		});
		function resetErrors() {
			$('form input, form select').removeClass('inputTxtError');
			$('label.error').remove();
		} 
		
		
		
		
		
		 var data = {};
		$(document).ready(function() {
		$('button[type="submit"]').on('click', function() {
		//$('.btn pull-lefts').click(function(){
		//$('button[type="submit"]').addClass('disabled');
		resetErrors();
		var url = 'ajax/add_new_degree.php';
            //divid = '<?php echo $getEducationData['user_add_degree_id']; ?>';
		 //  alert(divid);
		var formData=$('#add_new_degree1').serialize();
	//	alert(formData);
		$.ajax({
		dataType: 'json',
		type: 'POST',
		url: url,
		data: formData,
		success: function(resp) {
		  if(resp.done==='success'){
			 $('#education_school').val(); $('#education_school_inserted').val(); $('#education_degree').val();$('#education_degree_inserted').val(); $('#education_field_of_study').val(); $('#education_field_of_study_inserted').val(); $('#education_year_of_graduation').val();
			 
			  
			 location.reload();
		  } else {
			 // alert(resp);
			  $.each(resp, function(i, v) {
			  console.log(i + " => " + v); // view in console for error messages
				  var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
				  $('input[id="' + i + '"], select[name="' + i + '"],select[id="' + i + '"]').addClass('inputTxtError').after(msg);
			  });
			  var keys = Object.keys(resp);
			  $('input[name="'+keys[0]+'"]').focus();
		  }
		  return false;
		},
		error: function() {
		  console.log('there was a problem checking the fields');
		}
		});
		return false;
		});
		});

		/*===================== Education Update Code ================ */
	
	</script>
	<script>
					
	  var data = {};
		$(document).ready(function() {
		$('button[id="update_experience123"]').on('click', function() {
		//$('.btn pull-lefts').click(function(){
		//$('button[type="submit"]').addClass('disabled');
		resetErrors();
		var url = 'ajax/update_experience.php';
            //divid = '<?php echo $getEducationData['user_add_degree_id']; ?>';
		 //  alert(divid);
		var formData=$('#update_experience1').serialize();
	//	alert(formData);
		$.ajax({
		dataType: 'json',
		type: 'POST',
		url: url,
		data: formData,
		success: function(resp) {
		  if(resp.done==='success'){
			/*  $('#education_school').val(''); $('#education_school_inserted').val(''); $('#education_degree').val('');$('#education_degree_inserted').val(''); $('#education_field_of_study').val(''); $('#education_field_of_study_inserted').val(); $('#education_year_of_graduation').val('');  */
			 
			  
			 location.reload();
		  } else {
			 // alert(resp);
			  $.each(resp, function(i, v) {
			  console.log(i + " => " + v); // view in console for error messages
				  var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
				  $('input[id="' + i + '"], select[name="' + i + '"],select[id="' + i + '"]').addClass('inputTxtError').after(msg);
			  });
			  var keys = Object.keys(resp);
			  $('input[name="'+keys[0]+'"]').focus();
		  }
		  return false;
		},
		error: function() {
		  console.log('there was a problem checking the fields');
		}
		});
		return false;
		});
		});
		
		
		  var data = {};
		$(document).ready(function() {
		$('button[id="add_new_exp"]').on('click', function() {
		//$('.btn pull-lefts').click(function(){
		//$('button[type="submit"]').addClass('disabled');
		resetErrors();
		var url = 'ajax/add_new_exp.php';
            //divid = '<?php echo $getEducationData['user_add_degree_id']; ?>';
		 //  alert(divid);
		var formData=$('#add_new_exp').serialize();
		//alert(formData);
		$.ajax({
		dataType: 'json',
		type: 'POST',
		url: url,
		data: formData,
		success: function(resp) {
		  if(resp.done==='success'){
			  
			  $('#exp_company_name').val(''); $('#exp_company_name_inserted').val(''); $('#exp_title').val('');$('#exp_title_name_inserted').val(''); $('#exp_time_period_start_month').val(''); $('#exp_time_period_start_year').val(); $('#exp_time_period_end_month').val('');  $('#exp_time_period_end_year').val('');  $('#exp_show_hide').val('');
			  $('#addcheckbox').val('');  $('#exp_description').val(''); 
			  
			 location.reload();
		  } else {
			 // alert(resp);
			  $.each(resp, function(i, v) {
			  console.log(i + " => " + v); // view in console for error messages
				  var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
				  $('input[id="' + i + '"], select[name="' + i + '"],select[id="' + i + '"]').addClass('inputTxtError').after(msg);
			  });
			  var keys = Object.keys(resp);
			  $('input[name="'+keys[0]+'"]').focus();
		  }
		  return false;
		},
		error: function() {
		  console.log('there was a problem checking the fields');
		}
		});
		return false;
		});
		}); 
		
		</script>
		
		<script>
	  
			function checkOtherValue(val){

				var element=document.getElementById('your_current_situation_value');
				if(val=='others')
				element.style.display='block';
				else  
				element.style.display='none';
			}
			
			function yesnoCheck3() {
				if (document.getElementById('yesCheck3').checked) {
				document.getElementById('ifYes3').style.display = 'block';
				}
				else document.getElementById('ifYes3').style.display = 'none';

			}
			
			function currentwork() {
				if (document.getElementById('yesCheck1').checked) {
				document.getElementById('ifYes1').style.display = 'block';
				}
				else document.getElementById('ifYes1').style.display = 'none';

			}
			
			function addpaidfairly() {
				if (document.getElementById('yesCheck2').checked) {
				document.getElementById('ifYes2').style.display = 'block';
				}
				else document.getElementById('ifYes2').style.display = 'none';

			}
			
			function addmentoringpeople() {
				if (document.getElementById('yesCheck11').checked) {
				document.getElementById('ifYes11').style.display = 'block';
				}
				else document.getElementById('ifYes11').style.display = 'none';

			}
	  
			function updatecareerchange(){
				  $('#career_change_update').show();
				  $('#career_change_showDAta').hide();
			}
			   
			function updatecareerchangehide(){
				  $('#career_change_update').hide();
				  $('#career_change_showDAta').show();
			}    
			  
			function updatemakeyoumove(){
				   $('#make_you_move_update').hide();
				  $('#make_you_move').show();
			}
			function updatemakemovehide(){
			  $('#make_you_move').hide();
			  $('#make_you_move_update').show();
			}
		 
			function showcurrentwork(){
					$('#show_culture_your_current_work_update').hide();
					$('#culture_your_current_work_update').show();
			}
		      
			function hidecurrentwork(){
				$('#show_culture_your_current_work_update').show();
				$('#culture_your_current_work_update').hide();
			}
			
			/* function hidepaidfairly(){
				$('#paid_fairly').hide();
				$('#show_paid_fairly').show();
			}
			function updatepaidfairly(){
				$('#paid_fairly').show();
				$('#show_paid_fairly').hide();
			}
			
			function updatementoringpeople(){
				$('#mentoring_people_update').show();
				$('#mentoring_people').hide();
			}
			
			function mentoringpeoplehide(){
				$('#mentoring_people').show();
				$('#mentoring_people_update').hide();
			}
			   
			 
            function updatewhatyoudo(){
				$('#good_and_what_you_do_update').show();
				$('#good_and_what_you_do_update_data').hide();
			}
			
            function updatewhatyoudohide(){
				$('#good_and_what_you_do_update_data').show();
				$('#good_and_what_you_do_update').hide();
			}
           function updatevideo(){
				$('#uploadevideo').show();
				$('#video1').hide();
			}

            function cancelvideouploade(){
				$('#video1').show();
				$('#uploadevideo').hide();
			} */
			   
		  function careerchangeupdate(){
	
				var userID = '<?php  echo $user_id ?>';
				var yourcurrentsituation =  $('#your_current_situation').val();
				var yourcurrentsituationvalue =  $('#your_current_situation_value').val();
				var page = 'careerchangeupdate';
				resetErrors();
				//alert(firstname +"==" +lastname);
               var dataString = 'yourcurrentsituation='+ yourcurrentsituation + '&yourcurrentsituationvalue='+ yourcurrentsituationvalue + '&userid='+ userID +'&page='+ page;
				
					$.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
						 //location.reload();
						 if(resp.done==='success'){
							  location.reload();
                        } else {
						 // alert(resp);
						  $.each(resp, function(i, v) {
						  console.log(i + " => " + v); // view in console for error messages
							   var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
							   $('input[id="' + i + '"],input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
						     });
						  var keys = Object.keys(resp);
						  $('input[name="'+keys[0]+'"]').focus();
					    }
						return false;
					},
				error: function() {
				    console.log('there was a problem checking the fields');
					}
				});
			}
			
			
			 function makeyoumoveupdate(){
	 
				var userID = '<?php  echo $user_id ?>';
				//var makeyoumove =  $('#make_you_move').val();
				var makeyoumove =  $('input[name=make_you_move]:checked').val(); 
				var makeyoumoveyes =  $('#make_you_move_yes').val();
				var page = 'makeyoumoveupdate';
				resetErrors();
				//alert(firstname +"==" +lastname);
               var dataString = 'makeyoumove='+ makeyoumove + '&makeyoumoveyes='+ makeyoumoveyes + '&userid='+ userID +'&page='+ page;
				
					$.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
						 //location.reload();
						 if(resp.done==='success'){
				              location.reload();
                        } else {
						 // alert(resp);
						  $.each(resp, function(i, v) {
						  console.log(i + " => " + v); // view in console for error messages
							   var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
							   $('input[id="' + i + '"],input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
						     });
						  var keys = Object.keys(resp);
						  $('input[name="'+keys[0]+'"]').focus();
					    }
						return false;
					},
				error: function() {
				    console.log('there was a problem checking the fields');
					}
				});
			}
			
			
			function currentworkupdate(){
	    
				var userID = '<?php  echo $user_id ?>';
				//var makeyoumove =  $('#make_you_move').val();
				var yourcurrentwork =  $('input[name=your_current_work]:checked').val(); 
				var yourcurrentworkyes =  $('#your_current_work_yes').val();
				var page = 'currentworkupdate';
				resetErrors();
				//alert(firstname +"==" +lastname);
               var dataString = 'yourcurrentwork='+ yourcurrentwork + '&yourcurrentworkyes='+ yourcurrentworkyes + '&userid='+ userID +'&page='+ page;
				
					$.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
						 //location.reload();
						 if(resp.done==='success'){
				              location.reload();
                        } else {
						 // alert(resp);
						  $.each(resp, function(i, v) {
						  console.log(i + " => " + v); // view in console for error messages
							   var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
							   $('input[id="' + i + '"],input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
						     });
						  var keys = Object.keys(resp);
						  $('input[name="'+keys[0]+'"]').focus();
					    }
						return false;
					},
				error: function() {
				    console.log('there was a problem checking the fields');
					}
				});
			}
			
			
			function paidfairlyupdate(){
	    
				var userID = '<?php  echo $user_id ?>';
				//var makeyoumove =  $('#make_you_move').val();
				var paidfairly =  $('input[name=paid_fairly]:checked').val(); 
				var paidfairlyyes =  $('#paid_fairly_yes').val();
				var page = 'paidfairlyupdate';
				resetErrors();
				//alert(firstname +"==" +lastname);
               var dataString = 'paidfairly='+ paidfairly + '&paidfairlyyes='+ paidfairlyyes + '&userid='+ userID +'&page='+ page;
				
					$.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
						 //location.reload();
						 if(resp.done==='success'){
				              location.reload();
                        } else {
						 // alert(resp);
						  $.each(resp, function(i, v) {
						  console.log(i + " => " + v); // view in console for error messages
							   var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
							   $('input[id="' + i + '"],input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
						     });
						  var keys = Object.keys(resp);
						  $('input[name="'+keys[0]+'"]').focus();
					    }
						return false;
					},
				error: function() {
				    console.log('there was a problem checking the fields');
					}
				});
			}  
			
			function updatementoringpeopledata(){
	    
				var userID = '<?php  echo $user_id ?>';
				//var makeyoumove =  $('#make_you_move').val();
				var mentoringpeople =  $('input[name=mentoring_people]:checked').val(); 
				var mentoringpeopleyes =  $('#mentoring_people_yes').val();
				var page = 'updatementoringpeopledata';
				resetErrors();
				//alert(firstname +"==" +lastname);
               var dataString = 'mentoringpeople='+ mentoringpeople + '&mentoringpeopleyes='+ mentoringpeopleyes + '&userid='+ userID +'&page='+ page;
				
					$.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
						 //location.reload();
						 if(resp.done==='success'){
				              location.reload();
                        } else {
						 // alert(resp);
						  $.each(resp, function(i, v) {
						  console.log(i + " => " + v); // view in console for error messages
							   var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
							   $('input[id="' + i + '"],input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
						     });
						  var keys = Object.keys(resp);
						  $('input[name="'+keys[0]+'"]').focus();
					    }
						return false;
					},
				error: function() {
				    console.log('there was a problem checking the fields');
					}
				});
			}  
			
			function updatewhatyoudodata(){
	    
				var userID = '<?php  echo $user_id ?>';
				//var makeyoumove =  $('#make_you_move').val();
				var goodandwhatyoudo =  $('input[name=good_and_what_you_do]:checked').val(); 
				var page = 'updatewhatyoudodata';
				resetErrors();
				//alert(firstname +"==" +lastname);
               var dataString = 'goodandwhatyoudo='+ goodandwhatyoudo + '&userid='+ userID +'&page='+ page;
				
					$.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
						 //location.reload();
						 if(resp.done==='success'){
				              location.reload();
                        } else {
						 // alert(resp);
						  $.each(resp, function(i, v) {
						  console.log(i + " => " + v); // view in console for error messages
							   var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
							   $('input[id="' + i + '"],input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
						     });
						  var keys = Object.keys(resp);
						  $('input[name="'+keys[0]+'"]').focus();
					    }
						return false;
					},
				error: function() {
				    console.log('there was a problem checking the fields');
					}
				});
			}
			
			function add_video_link(){
				
				var userID = '<?php  echo $user_id ?>';
				var video =  $('#emp_video_or_company_video').val();
				var page = 'add_video_link';
				resetErrors();
				//alert(firstname +"==" +lastname);
				var dataString = 'video='+ video +  '&userid='+ userID +'&page='+ page;
				
					$.ajax({
						type: "POST",
						url: "ajax/user_profile_update.php",
						data: dataString,
						dataType: 'json',
						cache: false,
					success: function(resp){
						 //location.reload();
						if(resp.done==='success'){
				              location.reload();
                        } else {
						 // alert(resp);
						  $.each(resp, function(i, v) {
						  console.log(i + " => " + v); // view in console for error messages
							   var msg = '<label class="error" style="color:red" for="'+i+'">'+v+'</label>';
							   $('input[id="' + i + '"],input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
						     });
						  var keys = Object.keys(resp);
						  $('input[name="'+keys[0]+'"]').focus();
					    }
						return false;
					},
				error: function() {
				    console.log('there was a problem checking the fields');
					}
				});
			}
			    
		      
	  </script>
					
 <?php require_once('footer.php');?>