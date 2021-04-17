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
			$data =array();
			$user_id = $this->session->userdata('user_id');
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
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
			 if ($this->form_validation->run() == TRUE)
				{
					
						 if($this->input->post() !='')
					    {
						
						  $first_name =  $this->input->post('first_name');
						  $last_name =  $this->input->post('last_name');
						  $email =  $this->input->post('email');
						  $company_name =  $this->input->post('company_name');
						  $mobile_number =  $this->input->post('mobile_number');
						  $address_one =  $this->input->post('address_one');
						  $address_two =  $this->input->post('address_two');
						  $password =  md5($this->input->post('password'));
						  $created_date = date("Y-m-d h:i:sa");
						  
						  $insertData = array(
								 'first_name'=>$first_name,
								 'last_name'=>$last_name,
								 'email'=>$email,
								 'company_name'=>$company_name,
								 'mobile_number'=>$mobile_number,
								 'address_one'=>$address_one,
								 'address_two'=>$address_two,
								 'password'=>$password,
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
	    public function product_page(){
			
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/product_page');
			$this->load->view('winconpage/footer');
		}	
		
		function add_properties(){
			
			//print_r($_POST); die;
			
			/* print_r($_FILES); 
			print_r($_POST);  */
			
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
			
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/change_password');
			$this->load->view('winconpage/footer');
		}
	  
	    public  function edit_profile(){
			
			$this->load->view('winconpage/header');
			$this->load->view('winconpage/edit_profile');
			$this->load->view('winconpage/footer');
		}
		
		/*   public function login_check1()
			{
				 if($this->session->userdata('user_id') != "" && $this->session->userdata('email') != "") { 
					  redirect(base_url('Wincon/property_listing'));
				 }
				
			} */
	
}
