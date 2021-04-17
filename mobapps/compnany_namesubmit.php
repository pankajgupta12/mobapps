<?php
 include "../connect.php";
include "../inc/function.php";
 
 if($_POST['page'] == 'company'){
	$company_name = $_POST['company_name'];	
	$userid = $_POST['userid'];	
  
     $sql = ("update user_details set company_name ='".$company_name."' where user_id ='".$userid."'"); 
     $query = mysql_query($sql);
  
			if(isset($query)){
			echo $company_name;
			}else {
			echo '2';
			}
    }
   
   if($_POST['page'] == 'address'){
	  $data = array();
	  $country = $_POST['countryId'];	
	  $state = $_POST['stateId'];	
	  $city = $_POST['city'];	
	  $zip_code = $_POST['zipcode'];	
	  $userid = $_POST['userid'];	
	
	      $sql_query = mysql_query("update user_details set country ='".$country."',state ='".$state."',city ='".$city."',zip_code ='".$zip_code."' where user_id ='".$userid."'"); 
		  // echo $sql_query; die;
			if(isset($sql_query)){
				$contory_name = getContory("countries",$country);
                $state_name = getContory("states",$state);
			  $result = array('country'=>$contory_name,'state'=>$state_name,'city'=>$city,'zip_code'=>$zip_code);
			  echo json_encode($result);
			 }
    }
	
	if($_POST['page'] == 'emp'){
	$noOFemp = $_POST['noOFemp'];	
	$userid = $_POST['userid'];	
  
     $sql = ("update user_details set no_of_employees ='".$noOFemp."' where user_id ='".$userid."'"); 
     $query = mysql_query($sql);
  
     $empdetails = getempdetails($noOFemp);
  
			if(isset($query)){
			echo $empdetails;
			}else {
			echo '2';
			}
    }
	
	if($_POST['page'] == 'sharedelete'){
	$id = $_POST['id'];	
	$userid = $_POST['userid'];	
  
    $sql = ("Delete  from tbl_shareupdate where  tbl_share_update_id ='".$id."' and  user_id ='".$userid."'"); 
     $query = mysql_query($sql);
  
  
			if(isset($query)){
			echo '1';
			}else {
			echo '2';
			}
    }
	
	 if($_POST['page'] == 'getfile'){
		  $id = $_POST['id'];	
		  if($id != ''){
		    $files = glob('../css/*'); foreach($files as $file){ if(is_file($file))unlink($file); }}
	  }
	
	if($_POST['page'] == 'mypostjobdelete'){
		
	 $postid = $_POST['postid'];	
	 $userid = $_POST['userid'];	
  
     $sql = ("Delete  from  post_job where  id ='".$postid."' and  user_id ='".$userid."'"); 
     $query = mysql_query($sql);
        
		$getallrecord = mysql_query("select * from post_job where user_id = '".$userid."'");
		$count = mysql_num_rows($getallrecord);
  
			if(isset($query)){
			echo $count;
			}else {
			echo '2';
			}
    }
	

	
	if($_POST['page'] == 'showhidepostedjob'){
	 $postid = $_POST['postid'];	
	 $divid = $_POST['divid'];	
	 $userid = $_POST['userid'];	
	 $showhideid = $_POST['showhideid'];	
	 
	 
	 $urlpostid =   base64_encode(base64_encode(base64_encode($postid)));
	 
	 $showhideidvalue = ($showhideid == '1') ? '0' : '1';
	 
	 $showhideidvalue1 = ($showhideid == '1') ? 'Deactive' : 'Active';
  
       $sql = ("update post_job set show_hide ='".$showhideidvalue."' where id ='".$postid."'"); 
      $query = mysql_query($sql);
  
     //$edit = "<a href='#'>Edit</a>";
     /*   if($showhideid == '0') { 
			$edit = "<a href='post-job.php?postedid=".$urlpostid."'>Edit</a>";
			}else {
			$edit = '';
			}  */
		if(isset($query)){
		echo  "<a  onClick='showhidepostedjob(".$postid.",".$divid.",".$showhideidvalue.");'>".$showhideidvalue1."</a>"; 
			
		}else {
		 echo "Wrong is Something";
		}
		
		//$result = array('showhide'=>$showhide,'edit'=>$edit,'wrong'=>$wrong); 
		//echo json_encode($result);
    }
	
	
	 if($_POST['page'] == 'activedeactive'){
	 $postid = $_POST['postid'];	
	 $userid = $_POST['userid'];	
	 $showhideid = $_POST['showhideid'];	
	 
	 
	 $showhideidvalue = ($showhideid == '1') ? '0' : '1';
	 
	 $showhideidvalue1 = ($showhideid == '1') ? 'Deactive' : 'Active';
  
       $sql = ("update post_job set show_hide ='".$showhideidvalue."' where id ='".$postid."'"); 
       $query = mysql_query($sql);
  
     
		if(isset($query)){
		echo  "<span  onClick='activedeactive(".$postid.",".$showhideidvalue.");'>".$showhideidvalue1."</span>"; 
			
		}else {
		 echo "Wrong is Something";
		}
	
    }
	if($_POST['page'] == 'deleteexpjobstep3'){
	 $expid = $_POST['expid'];	
	 $userid = $_POST['userid'];	
	 $divid = $_POST['divid'];	
  	//var dataString = 'expid='+ expid + '&userid='+ userid +'&page='+ page +'&divid='+ divid;
    $getexprow = ("Delete  from  user_work_experience where  exp_id ='".$expid."' and  user_id ='".$userid."'"); 
     $query = mysql_query($getexprow);
  
			if(isset($query)){
			echo "1";
			}else {
			echo '2';
			}
    }
	//var dataString = 'degreeid='+ degreeid + '&userid='+ userid +'&page='+ page +'&divid='+ divid;
	
	if($_POST['page'] == 'deleteeducationstep4'){
	 $degreeid = $_POST['degreeid'];	
	 $userid = $_POST['userid'];	
	
  	//var dataString = 'expid='+ expid + '&userid='+ userid +'&page='+ page +'&divid='+ divid;
    $deletedegreerow = ("Delete  from  user_add_degree where  user_add_degree_id ='".$degreeid."' and  user_id ='".$userid."'"); 
     $query = mysql_query($deletedegreerow);
  
			if(isset($query)){
			echo "1";
			}else {
			echo '2';
			}
    }
	
	if($_POST['page'] == 'deleteresume'){
		 $userid = $_POST['userid'];	
		 $resumename = $_POST['resumename'];	
		 $resume = '';	
	
  	     $deleteresume = ("update user_details set resume ='".$resume."' where user_id ='".$userid."'"); 
	     $query = mysql_query($deleteresume);
	     unlink("../uploads/resume/".$resumename);
  
			if(isset($deleteresume)){
			echo "1";
			}else {
			echo '2';
			}
    }
	
	if($_POST['page'] == 'descriptionupdate'){
		 $userid = $_POST['userid'];	
		 $desc = $_POST['desc'];	
		;	
	//var dataString = 'desc='+ desc + '&userid='+ userid +'&page='+ page;
  	     $updatedata = ("update user_details set description ='".$desc."' where user_id ='".$userid."'"); 
	     $query = mysql_query($updatedata);
	    // unlink("../uploads/resume/".$resumename);
  
			if(isset($query)){
			echo $desc;
			}else {
			echo '2';
			}
    }
	
	if($_POST['page'] == 'updatecurrentSituation'){
		 $userid = $_POST['userid'];	
		 $CurrentSituation = $_POST['CurrentSituation'];	
		 
		 if($CurrentSituation == 'others') {
		    $varothervalueCurrent = $_POST['varothervalueCurrent'];	
		 }else {
			 $varothervalueCurrent = '';
		 }
	
  	     $updatCurrentSituationData = ("update user_details set your_current_situation ='".$CurrentSituation."',your_current_situation_value ='".$varothervalueCurrent."' where user_id ='".$userid."'"); 
	     $query12 = mysql_query($updatCurrentSituationData);
	   
  
			if(isset($query12)){
			echo $varothervalueCurrent;
			}else {
			echo '2';
			}
    }
	
	if($_POST['page'] == 'Culturecurrentoffcpage'){
		
		 $userid = $_POST['userid'];	
		 $Culturecurrentoffc = $_POST['Culturecurrentoffc'];	
	
  	     $updatCulturecurrentoffc = ("update user_details set culture_current_offc ='".$Culturecurrentoffc."' where user_id ='".$userid."'"); 
	     $query12 = mysql_query($updatCulturecurrentoffc);
	   
  
			if(isset($query12)){
			  return true;
			}else {
              return  false;
			}
    }
	
	if($_POST['page'] == 'PrimeryGoalcompanyPage'){
		 $userid = $_POST['userid'];	
		 $PrimeryGoalcompany = $_POST['PrimeryGoalcompany'];	
	
  	     $updatPrimeryGoalcompany = ("update user_details set primary_goal_company ='".$PrimeryGoalcompany."' where user_id ='".$userid."'"); 
	     $query12 = mysql_query($updatPrimeryGoalcompany);
  
			if(isset($query12)){
			  return true;
			}else {
              return  false;
			}
    }
	
	if($_POST['page'] == 'updatecompgreateststrenght'){
		 $userid = $_POST['userid'];	
		 $CompanyGreatstrenght = $_POST['CompanyGreatstrenght'];	
	
  	     $updatCompanyGreatstrenght = ("update user_details set company_greatest_strengths ='".$CompanyGreatstrenght."' where user_id ='".$userid."'"); 
	     $query12 = mysql_query($updatCompanyGreatstrenght);
  
			if(isset($query12)){
			  return true;
			}else {
              return  false;
			}
    }
	
	if($_POST['page'] == 'updateindustry'){
		 $userid = $_POST['userid'];	
		 $industry = $_POST['industry'];	
		 
		 
		if($industry == 'others') {
		    $industryValue = $_POST['industryValue'];	
		}else {
			 $industryValue = '';
		}
	   $updateindustry = ("update user_details set industry ='".$industry."',industry_value ='".$industryValue."' where user_id ='".$userid."'"); 
	     $query12 = mysql_query($updateindustry);
  
			if(isset($query12)){
			echo $industryValue;
			}else {
              return  false;
			}
    }
	
?>