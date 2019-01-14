<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
  //getProfileInfo
  public function getProfileInfo($id){
    return $this->db->get_where('tbl_user', array('user_id'=>$id))->result_object();
  }
  
  //getProfileInfos
  public function getProfileInfos($id){
    return $this->db->get_where('tbl_user', array('user_id'=>$id))->row_object();
  }
  
  //getFamilyInformation
  public function getFamilyInformation($id){
    return $this->db->get_where('tbl_user', array('user_id'=> $id))->row_object();
  }
  
	//save email newsletter
	public function saveNewsLetter($data){
		$this->db->insert('tbl_newsletter', $data);
	}

  public function getRandomCode($randomCode){
    $this->db->select('
                       tbl_user.random_code
                      ')
             ->from('tbl_user')
             ->where('random_code', $randomCode);
    $q = $this->db->get();
    if($q->num_rows() == 1){
      return $q->result();
    }else{
      return false;
    }
   
  }
	
	//count all latest users
	public function countAllUsers(){
		 $this->db->select(
                    'tu.user_id,
                     tu.first_name,
                     tu.last_name,
                     tu.profile_image,
                     tp.profile_type
                    '
                    )
              ->from('tbl_user tu')
              ->join('tbl_profile tp', 'tu.account_type=tp.id');
     return $this->db->count_all_results();
	}
	
	//get all registered users 
  public function getAllRegisteredUsers(){
    return $this->db->select(
                     'tu.user_id,
                     tu.first_name,
                     tu.last_name,
					 tu.reactivate_deactivate,
                     tu.profile_image,
                     tp.profile_type
                    '
                    )
              ->from('tbl_user tu')
              ->join('tbl_profile tp', 'tu.account_type=tp.id')
              ->order_by('tu.user_id', 'desc') 
              ->get()->result_object();
    $this->db->get('tbl_user');
  }
  
	//get all users data
  public function getAllData(){
    return $this->db->select(
                     'tu.user_id,
                     tu.first_name,
                     tu.last_name,
                     tu.profile_image,
										 tu.make_profile,
                     tu.status,
                     tp.profile_type
                    '
                    )
              ->from('tbl_user tu')
              ->join('tbl_profile tp', 'tu.account_type=tp.id')
              ->order_by('tu.user_id', 'desc') 
              ->limit(4)
							->where('tu.make_profile =', 1)
              ->where('tu.status = ', 1)
              ->or_where('tu.status =', 2)
              ->or_where('tu.status =', 0)
              ->get()->result_object();
    $this->db->get('tbl_user');
  }
  
   public function getAllFamilyProfileAndPaidMember($id){
    return $this->db->get_where('tbl_user', array('user_id'=> $id))->result_object();
   
  }
  
  public function getAllFamilyProfile(){
    $this->db->select('
               tbl_user.user_id,
               tbl_user.first_name,
               tbl_user.last_name,
               tbl_user.account_type
                    ')
          ->from('tbl_user')
          ->where('account_type = ', 2);
    return $this->db->count_all_results();
  }
  
  public function searchNanny($q){
     return $this->db->select('
                       tu.user_id,
                       tu.first_name,
                       tu.last_name,
                       tu.email_address,
											 tu.account_type,
											 tu.suburb_postcode,
                       tu.address,
                       tp.profile_type
                      ')
             ->from('tbl_user tu')
              ->join('tbl_profile tp', 'tu.account_type=tp.id')
             ->like('tu.suburb_postcode', $q)
             ->get()->result_object();

      
  }

  //get the profile data
  public function getProfileNanny(){
    return $this->db->get('tbl_profile')->result_object();
  }
  
  
  public function getUsersProfile($id){
     return $this->db->select('
                       tu.user_id,
                       tu.username,
                       tu.first_name,
                       tu.date_of_birth,
                       tu.last_name,
                       tu.address,
                       tu.email_address,
                       tu.profile_image,
                       tu.suburb_postcode,
                       tu.number_of_children,
                       tu.mummy_shared_nanny,
											 tu.mummy_nanny_child_age,
                       tu.boys,
                       tu.age_of_boys,
                       tu.girls,
                       tu.age_of_girls,
                       tu.start_date,
                       tu.available_days_per_week,
                       tu.flexible_days,
                       tu.hours_required,
                       tu.have_pets,
                       tu.dog_cat,
                       tu.childs_activities,
                       tu.already_have_nanny,
                       tu.rate_of_pay,
                       tu.prefer_care,
                       tu.additional_comments,
                       tu.make_profile,
                       tu.number_of_children_prepared_to_care_for,
                       tu.ages_of_children_cared_of,
                       tu.available_days_per_week,
                       tu.expected_hourly_rate,
                       tu.have_abn,
                       tu.have_drivers_licence,
                       tu.have_first_aid_certificate,
                       tu.registered_carrer,
                       tu.yr_exp_as_nanny,
                       tu.multiple_children_exp,
                       tu.other_skills,
                       tu.a_little_about_myself,
                       
                       tp.profile_type
                      ')
             ->from('tbl_user tu')
             ->join('tbl_profile tp', 'tu.account_type=tp.id')
             ->get_where('tbl_user', array('tu.user_id'=>$id))->row_object();
  }
 
  public function getData($id){
    return $this->db->get_where('tbl_user', array('user_id'=> $id))->row_object();
  }

  //check if email already exists
  public function email($email){
    $this->db->select('
                       tbl_user.email_address
                      ')
             ->from('tbl_user')
             ->where('email_address', $email);
    $q = $this->db->get();
    if($q->num_rows() == 1){
      return $q->result();
    }else{
      return false;
    }
  }

  //check if username already exists
  public function username($username){
    $this->db->select('
                       tbl_user.username
                      ')
             ->from('tbl_user')
             ->where('username', $username);
    $q = $this->db->get();
    if($q->num_rows() == 1){
      return $q->result();
    }else{
      return false;
    }
  }

  // save the data from the registration form
  public function saveData($data){
    $this->db->insert('tbl_user', $data);
    return $this->db->insert_id();
  }
  
  
}
