<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wincon extends CI_Controller {

	
		function __construct() {
			parent::__construct();
			$this->load->database();
			$this->load->model('base_model');
			// $this->lang->load('date', 'calendar');
		}

		 
		public function index()
		{
			//echo base_url(); die;
			// $this->login_check1();
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/index');
			$this->load->view('winconpage/footer');
		}
		
		public function login()
		{
			
			// $this->login_check1();
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
			 if ($this->form_validation->run() == TRUE)
				{
					
					 	 if($this->input->post() !='')
					    {
					          $email =  $this->input->post('email');
						      $password =  md5($this->input->post('password'));
							  
							$this->db->select('*');
							$this->db->from('tbl_registration');
							$this->db->where('email',$email);
							$this->db->where('password',$password);  
							$query = $this->db->get();
							
							if($query->num_rows() == 1)
							{
								$data = array();
								$row=$query->row();
								
										$data=array(
										'user_id'=>$row->user_id,
										'email'=>$row->email,
										'first_name'=>$row->first_name,
										'last_name'=>$row->last_name
										);
										
								$this->session->set_userdata($data);           
							    redirect(base_url('Wincon/property_listing'));
							}
							else
							{
							  $this->session->set_flashdata('message', 'Your email and password is wrong.');
							} 
					   } 
				}	   
			
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/login');
			$this->load->view('winconpage/footer');
		}
		
		
		public function property_listing()
		{
			$this->login_check();
			$data =array();
			
			$data['property'] = array('1'=>'Apartments','2'=>'Land/Plot','3'=>'Residential','4'=>'Villa');
			$user_id = $this->session->userdata('user_id');

				$this->db->select('property_type');
                $this->db->distinct();
				$this->db->where('user_id', $user_id); 
				$this->db->order_by("property_type","asc");
				$query = $this->db->get('tbl_properties');
				$data['property_type'] = 	$query->result();
			
				$where=array('user_id'=>$user_id);
				$table = 'tbl_properties';
				$data['property_data'] = $this->base_model->get_allrecord_by_id_($table,$where);
			 
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/property_listing',$data);
			$this->load->view('winconpage/footer');
		}
		
		public function register()
		{
			//$this->login_check1();
			$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_registration.email]');
			$this->form_validation->set_rules('mobile_number', 'Mobile', 'trim|required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('company_name', 'Company', 'trim|required');
			$this->form_validation->set_rules('address_one', 'Address1', 'trim|required');
			//$this->form_validation->set_rules('address_two', 'Address2', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[10]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
			 if ($this->form_validation->run() == TRUE)
				{
					
					 if($this->input->post() !='')
					{

						$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
						$pass = array(); //remember to declare $pass as an array
						$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
						for ($i = 0; $i < 8; $i++) {
							$n = rand(0, $alphaLength);
							$pass[] = $alphabet[$n];
						}
						
						//print_r($pass); die;
						
						  $first_name =  $this->input->post('first_name');
						  $last_name =  $this->input->post('last_name');
						  $email =  $this->input->post('email');
						  $company_name =  $this->input->post('company_name');
						  $mobile_number =  $this->input->post('mobile_number');
						  $address_one =  $this->input->post('address_one');
						  $address_two =  $this->input->post('address_two');
						  $password =  md5($this->input->post('password'));
						  $created_date = date("Y-m-d h:i:sa");
						  $rand_number = implode($pass);
						  
						  $insertData = array(
								 'first_name'=>$first_name,
								 'last_name'=>$last_name,
								 'email'=>$email,
								 'company_name'=>$company_name,
								 'mobile_number'=>$mobile_number,
								 'address_one'=>$address_one,
								 'address_two'=>$address_two,
								 'password'=>$password,
								 'rand_number'=>$rand_number,
								 'created_date'=>$created_date,
							    );
						// $this->db->insert('tbl_registration', $insertData);
						 $result = $this->base_model->insert('tbl_registration', $insertData);
						 if(isset($result)){
							 $this->session->set_flashdata('message', 'Your registeration is successfully');
							 redirect(base_url('Wincon/register'));
						}
					}
				}
			
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/register');
			$this->load->view('winconpage/footer');
		}
		
		public function logout()
		{
				$this->session->sess_destroy();
				redirect(base_url('Wincon/login'));
				
		}
		
		public function login_check()
		{
				 if($this->session->userdata('user_id') == "" && $this->session->userdata('email') =="") { 
					  redirect(base_url('wincon/login'));
				 }
		}
	    public function product_page()
		{
			 $this->login_check();
			 $user_id = $this->session->userdata('user_id');
		     $properties_id = 	$this->uri->segment(3); // controller
			  
			$where=array('user_id'=>$user_id);
			$table = 'tbl_properties';
			$property_data = $this->base_model->get_allrecord_by_id_($table,$where);
			//print_r($property_data);
			$properties_id1 = base64_decode(base64_decode(base64_decode($properties_id)));
			foreach($property_data as $list){
				$listdata[]  = $list->properties_id;
			}
			
			   if(in_array($properties_id1,$listdata)){
				  // echo "true";
					$data =array();
					$properties_id = base64_decode(base64_decode(base64_decode($properties_id)));
					$where=array('properties_id'=>$properties_id);
					$table = 'tbl_properties';
					$data['propertiedetails'] = $this->base_model->get_record_by_id($table,$where);
				}
			else
				{
					 // echo "false";
				   redirect(base_url('wincon/property_listing'));
				}	
			
			$this->login_check();
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/product_page',$data);
			$this->load->view('winconpage/footer');
		}	
		
		function add_properties()
		{
			//die;
		    if($_POST) { 
		      $data = array();
		      $errors = array();
		    
			 //print_r($_FILES['properties_image']['name'][0]); die;
			
				  if($_FILES['properties_image']['name'][0] == ""){
							$errors['uploadimage'] = 'Upload file';				
						}
					 if(empty($_POST['property_type'])){
							$errors['property_type'] = 'Enter type';				
						}	
						
					if(empty($_POST['property_name'])){
							$errors['property_name'] = 'Enter name';				
						}
					if(empty($_POST['property_price'])){
							$errors['property_price'] = 'Enter price';				
						}
					if(empty($_POST['property_size'])){
							$errors['property_size'] = 'Enter size';				
						}
					if(empty($_POST['property_bathroom'])){
							$errors['property_bathroom'] = 'Enter bathroom';				
						}
						
					if(empty($_POST['property_sqft'])){
							$errors['property_sqft'] = 'Enter sqft';				
						}	
					
					if(empty($_POST['property_address'])){
							$errors['property_address'] = 'Enter address';				
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
					       $postedArr=$this->security->xss_clean($_POST);
						   $totalfile  = $_FILES['properties_image']['name'];
						   $file_namedata =array();
					for($k=0; $k < count($totalfile); $k++){
						if($_FILES['properties_image']['name'][$k]!='' && $_FILES['properties_image']['error'][$k] == '0')
							{
								 $filename = $_FILES['properties_image']['name'][$k];
								 
								 $tmpFilePath = $_FILES['properties_image']['tmp_name'][$k];
								
								 $ext = pathinfo($filename, PATHINFO_EXTENSION);
								 $file_name = md5(time()).'_'.$k.'.'.$ext;
								
								 $directory = getcwd() . '/files/propertiesfile';
								 move_uploaded_file($_FILES['properties_image']['tmp_name'][$k], $directory . '/' . $file_name);
						
								 $file_namedata[] = $file_name;
							}
					}	
							
				       	  $pro_image = implode(",",$file_namedata);
					      $property_type =  $this->input->post('property_type');
						  $property_name =  $this->input->post('property_name');
						  $property_price =  $this->input->post('property_price');
						  $property_size =  $this->input->post('property_size');
						  $property_bathroom =  $this->input->post('property_bathroom');
						  $user_id =  $this->input->post('user_id');
						  $property_sqft =  $this->input->post('property_sqft');
						  $property_address =  $this->input->post('property_address');
					 	  $property_description =  $this->input->post('property_description');
						  $created_at     = date("Y-m-d h:i:s");
					 $insertData = array(
								 'property_type'=>$property_type,
								 'user_id'=>$user_id,
								 'property_name'=>$property_name,
								 'property_price'=>$property_price,
								 'property_size'=>$property_size,
								 'property_bathroom'=>$property_bathroom,
								 'property_sqft'=>$property_sqft,
								 'properties_img'=>$pro_image,
								 'property_address'=>$property_address,
								 'description'=>$property_description,
								 'created_at'=>$created_at
							    );
						//print_r($insertData); die;		
						// $this->db->insert('tbl_registration', $insertData);
				    $result = $this->base_model->insert('tbl_properties', $insertData);
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
		
		public  function change_password(){
			$this->login_check();
			$this->form_validation->set_rules('old_password', 'Password', 'trim|required');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|max_length[10]');
			$this->form_validation->set_rules('re_password', 'Retype Password', 'required|matches[new_password]');
			 if ($this->form_validation->run() == TRUE)
				{
					////95deb5011a8fe1ccf6552bb5bcda2ff0
					
						 if($this->input->post() !='')
					    {
							$old_password =  $this->input->post('old_password');
							$new_password =  $this->input->post('new_password');
							$re_password =  $this->input->post('re_password');
							$table = "tbl_registration";
							//$this->db->model->checkOldPass()
							$result = $this->base_model->checkOldPass($table, $old_password);
							//echo $result; die;
							if($result){
								$query = $this->base_model->saveNewPass($table, $new_password);
								if($query){
								//redirect('change_password');
								 $this->session->set_flashdata('success_message', 'Your password is change successfully');
							     redirect(base_url('wincon/change_password'));
								}else{
								 $this->session->set_flashdata('error_message', 'Your password is not updateed');
							     redirect(base_url('wincon/change_password'));
								}
							}else{
								 $this->session->set_flashdata('waring_message', 'Your old password is wrong Please enter right password');
							     redirect(base_url('wincon/change_password'));
							}
							
						}
				}
			
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/change_password');
			$this->load->view('winconpage/footer');
		}
	  
	    public  function edit_profile(){
			
			$this->login_check();
			$data = array();
			$user_id = $this->session->userdata('user_id');
			$where=array('user_id'=>$user_id);
            $table = 'tbl_registration';
			$data['getuserdata'] = $this->base_model->get_record_by_id($table,$where);
			$user_id =  $this->input->post('user_id');
			
			
			$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email['.$user_id.']');
			$this->form_validation->set_rules('mobile_number', 'Mobile', 'trim|required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('company_name', 'Company', 'trim|required');
			$this->form_validation->set_rules('address_one', 'Address1', 'trim|required');
			//$this->form_validation->set_rules('address_two', 'Address2', 'trim|required');
			
			 if ($this->form_validation->run() == TRUE)
				{
					
						 if($this->input->post() !='')
					    {
						
						  $user_id =  $this->input->post('user_id');
						  $first_name =  $this->input->post('first_name');
						  $last_name =  $this->input->post('last_name');
						  $email =  $this->input->post('email');
						  $company_name =  $this->input->post('company_name');
						  $mobile_number =  $this->input->post('mobile_number');
						  $address_one =  $this->input->post('address_one');
						  $address_two =  $this->input->post('address_two');
						  
						  $updateData = array(
								 'first_name'=>$first_name,
								 'last_name'=>$last_name,
								 'email'=>$email,
								 'company_name'=>$company_name,
								 'mobile_number'=>$mobile_number,
								 'address_one'=>$address_one,
								 'address_two'=>$address_two,
							   );
			                   //  $table, $data, $where
						$where = array('user_id'=>$user_id);		 
						$updatequery  = $this->base_model->update_record_by_id($table,$updateData,$where);
						/*  $i= $this->db->affected_rows();
						 echo "<script>alert($i)</script>"; */
						if($updatequery){
								 $this->session->set_flashdata('success_message', 'Your profile is updated successfully');
							     redirect(base_url('wincon/edit_profile'));
							}
						}
				}
			
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/edit_profile',$data);
			$this->load->view('winconpage/footer');
		}
		
			public function check_email($email,$user_id)
		{
			$userdata = $this->db->get_where('tbl_registration',array('email'=>$email,'user_id !='=>$user_id))->row();
			
			if ($userdata)
            {
				$this->form_validation->set_message('check_email', 'The  %s email id already exist.');
				return FALSE;
			}
			else
			{
				return TRUE;
			} 
		}
		
			public function forget_password()
		{
			
			$data  = array();
			$this->form_validation->set_rules('email', 'Email id', 'trim|required|valid_email');
			if ($this->form_validation->run() == TRUE)
			{
					
						 if($this->input->post() !='')
					    {
						
						  $email =  $this->input->post('email');
						//  $userdata = $this->db->get_where('tbl_registration',array('email'=>$email))->row();
						 // $emailid = base64_decode(base64_decode(base64_decode($userdata->email)));
							
							$this->db->where('email',$email);
							$query1 = $this->db->get('tbl_registration');
							
						 // $count = count($userdata);
					
					if($query1->num_rows() > 0)
					{
						$userdata = $query1->row();
						$from_email = "pankajmobapps@gmail.com"; 
						$rand_number = $userdata->rand_number; 
						$getemail = $userdata->email; 
						$getemailid = base64_encode($userdata->email); 
					
						    $to_email = $email; 
							$link = "http://mobileandwebsitedevelopment.com/wincon-properties/wincon/wincon/new_password?rdcd=".$rand_number.'&id='.$getemailid;
						 //Load email library 
							 $clicklink  ="<a href='$link'>Click Here</a>";
							$name  = $userdata->first_name;
							
							/* $mesg  = "Hello " . $name;
							$mesg .= "<BR>";
							$mesg .= "Click on this link to reset your password .";
							$mesg .= "Reset Password ".$clicklink; */
							
							
							$mesg  = "Hello " . $name."\n";							
							$mesg .= "Click on this link to reset your password.\n";
							$mesg .= "Reset Password click "; 
							$mesg .= $link; 
							
						 
						 $this->load->library('email'); 
				   
						 $this->email->from($from_email); 
						 $this->email->to($to_email);
						 $this->email->subject('Reset your password to Login'); 
						 $this->email->message($mesg); 
				   
						 //Send mail 
						 if($this->email->send()){ 
						 // $this->session->set_flashdata("email_sent","Email sent successfully."); 
					       $this->session->set_flashdata('success_message', 'An E-Mail containing your new password has been sent to your email ID. Please check  mail');
						    redirect(base_url('wincon/forget_password'));
						 }else{ 
						  $this->session->set_flashdata('error_message', 'Email not sent');
						 redirect(base_url('wincon/forget_password'));
						 }
					}else{
						 $this->session->set_flashdata('error_message', 'Your email id is wrong ');
						 redirect(base_url('wincon/forget_password'));
					}
				}
			}
			
			$data['title'] = "Forget Password";
			
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/forget_password',$data);
			$this->load->view('winconpage/footer');
		}
		
		public function new_password(){
			$data = array();
			
			if(isset($_GET['rdcd'])){
				$randcode = $_GET['rdcd'];
				$id = base64_decode($_GET['id']);
				$emaiidget = $_GET['id'];
				 $userdata = $this->db->get_where('tbl_registration',array('rand_number'=>$randcode,'email'=>$id))->row();
				 
				 $rand_number = $userdata->rand_number;
				 $email1 = $userdata->email;
				 $data['randcode'] = $randcode;
				 $data['emaiidget'] = $emaiidget;
			}	
				//new_password   confirm_password
								$this->form_validation->set_rules('new_password', 'Password', 'trim|required|min_length[6]|max_length[10]');
								$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
							 if ($this->form_validation->run() == TRUE)
							{
								
									 if($this->input->post() !='')
									{
										$new_password =  $this->input->post('new_password');
										$newpass  =md5($new_password);
										$array = array('password'=>$newpass);
										//$this->db->where('rand_number', $rand_number);
										$this->db->where(array('rand_number'=>$rand_number,'email'=>$email1));
										   
												$result = $this->db->update('tbl_registration',$array);
											if($result){
											 $this->session->set_flashdata('success_message', 'Your password is updated successfully');
											 redirect(base_url('wincon/new_password?rdcd='.$data['randcode'].'&id='.$data['emaiidget']));
											}else{
										  $this->session->set_flashdata('error_message', 'Your password is not updated successfully'); 
										  redirect(base_url('wincon/new_password?rdcd='.$data['randcode'].'&id='.$data['emaiidget']));
											}
								    }
									
							}
						 $data['title'] = "New Password";
						 
						 
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/new_password',$data);
			$this->load->view('winconpage/footer'); 
		}
		
		/* public function send_mail() { 
			 $from_email = "pankajmobapps@gmail.com"; 
			 $to_email = 'pankajmobapps@gmail.com'; 
	   delete_record_by_id
			 //Load email library 
			 $this->load->library('email'); 
	   
			 $this->email->from($from_email, 'pankaj gupta'); 
			 $this->email->to($to_email);
			 $this->email->subject('Email Test'); 
			 $this->email->message('Testing the email class.'); 
	   
			 //Send mail 
			 if($this->email->send()) 
			 $this->session->set_flashdata("email_sent","Email sent successfully."); 
			 else 
			 $this->session->set_flashdata("email_sent","Error in sending Email."); 
			 redirect(base_url('wincon/property_listing'));
        } */ 
		
		/*   public function login_check1()
			{
				 if($this->session->userdata('user_id') != "" && $this->session->userdata('email') != "") { 
					  redirect(base_url('Wincon/property_listing'));
				 }
				
			} */
	
	 //$updatequery  = $this->base_model->update_record_by_id($table,$updateData,$where);
	 
	  public function delete_property(){
		   
			$this->login_check();
			$properties_id = 	$this->uri->segment(3); // controller
			$proID = base64_decode(base64_decode($properties_id));
			$user_id = $this->session->userdata('user_id');
			$where=array('user_id'=>$user_id,'properties_id'=>$proID);
			$table = 'tbl_properties';
			$deleterecord  = $this->base_model->delete_record_by_id($table,$where);
			//echo $this->db->last_query(); die;
		   if($deleterecord){
			     $this->session->set_flashdata('error_message', 'Your One properties is delete successfully'); 
				  redirect(base_url('wincon/property_listing'));
		    }
		  
	  } 
    }
