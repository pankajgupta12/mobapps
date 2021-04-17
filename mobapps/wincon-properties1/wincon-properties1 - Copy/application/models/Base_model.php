<?php 
class Base_model extends CI_Model {
	
	
		public function __construct() {
			parent::__construct();
		
		}
		
	    public function get_record_by_id($table, $data) {  //  retrun only one row.
	 		$query = $this->db->get_where($table, $data);
			return $query->row();
		}
		
		public function get_allrecord_by_id_($table, $data) {  //  retrun only one row.
	 		$query = $this->db->get_where($table, $data);
			return $query->result();
		}
		
		public function insert($table, $data) {   //insert  row in one time...
            return $this->db->insert($table, $data);
        }
	    public function get_all_record_by_condition($table, $data,$order_by=null) {  //  retrun only one row.
	
		   $this->db->order_by($order_by,'desc');
			$query = $this->db->get_where($table, $data);
			//echo $this->db->last_query();
			return $query->result();
        }
		
		public function get_last_insert_id() {   // Get Last insert ID
                return $this->db->insert_id();
        }
		
		public function update_record_by_id($table, $data, $where) {  // update one row
           return $this->db->update($table, $data, $where);
        }
		
		public function countrow($table) {
            return $this->db->count_all($table);
        }
		
		public function get_all_records($table,$order_by) {  //  retrun all rows.
			 $this->db->order_by($order_by,'desc');
			$query = $this->db->get($table);
			return $query->result();
        }
		
		public function delete_record_by_id($table, $where) {
			$this->db->delete($table, $where);
			return $this->db->affected_rows();
        }
	    
		public function checkOldPass($table,$old_password){
			$userid = $this->session->userdata('user_id');
			$oldpsw  =md5($old_password);
			$this->db->where('user_id',$userid);
			$query = $this->db->get($table);
			//$row    = $query->row();
			  /* echo "Old Password : ".$oldpsw."<br>";
			echo "From DB : ".$row->password."<br>";
			die;   */
              
			if($query->num_rows() > 0)
			{
			  $row = $query->row();
			  // print_r($row); die;
			  if($oldpsw == $row->password){
				return true;
			  }else{
				return false;
			  }
			}
		}
       
		public function saveNewPass($table,$new_pass){
			$userid = $this->session->userdata('user_id');
			$newpass  =md5($new_pass);
			$array = array('password'=>$newpass);
			$this->db->where('user_id', $userid);
			
			if( $this->db->update($table,$array))
			{
			return true;
			}
			else
			{
			return false;
			}
			
			/* $userid = $this->session->userdata('user_id');
			$array = array(
					'password'=>$new_pass
					);
			$this->db->where('user_id', $userid);
			$query = $this->db->update($table);
			if($query){
			  return true;
			}else{
			  return false;
			} */
		}   

		

	  
 }
?>