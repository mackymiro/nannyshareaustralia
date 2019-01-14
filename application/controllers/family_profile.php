<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Family_profile extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
    $this->load->model('geocode_model', 'gm');
    $this->load->model('blogs_model', 'bm');
    $this->load->helper('text');
    $this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
    
     $config['upload_path'] = 'assets/uploads/';
    // set the filter image types
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = '9000';
    $config['encrypt_name']  = TRUE;

    $this->load->library('upload', $config);
    
    $this->upload->initialize($config);
    $this->upload->set_allowed_types($config['allowed_types']);
    $data['upload_data'] = '';
		
    if($this->session->userdata('loggedIn')){
      redirect('profile');
    }
		

  }
  
  public function check_email($email){
    $email = $this->input->post('email');
    $result = $this->um->email($email);
    if($result){
      $this->form_validation->set_message('check_email', 'Email Already Exists.');
      return false; 
    }else{
      return true;
    } 
  }  
  
  public function check_username($username){
    $username = $this->input->post('username');
    $result = $this->um->username($username);
    if($result){
      $this->form_validation->set_message('check_username', 'Username Already Exists.');
      return false; 
    }else{
      return true;
    }
  }
	
	public function check_state(){
		if($this->input->post('state') === '0'){
			$this->form_validation->set_message('check_state', 'Please select state.');
			return false;
		}else{
			return true;
		}
	}
  
  public function check_prefercareat(){
    if($this->input->post('prefer_care') === '0'){
      $this->form_validation->set_message('check_prefercareat', 'Please select prefer care.');
      return false;
    }else{
      return true;
    }
  }
  
  public function check_alreadyhavenanny(){
    if($this->input->post('already_have_nanny') === '0'){
      $this->form_validation->set_message('check_alreadyhavenanny', 'Please select a nanny.');
      return false;
    }else{
      return true;
    }
  }
    
  public function check_havepets(){
    if($this->input->post('have_pets') === '0'){
      $this->form_validation->set_message('check_havepets', 'Please select pets.');
      return false;
    }else{
      return true;
    }
  }
  
  public function check_flexible_days(){
    if($this->input->post('flexible_days') === '0'){
      $this->form_validation->set_message('check_flexible_days', 'Please select flexible days.');
      return false;
    }else{
      return true;
    }
  }
  

  public function check_numberofchildren(){
    if($this->input->post('number_of_children') === '0'){
      $this->form_validation->set_message('check_numberofchildren', 'Please select number of children.');
      return false;
    }else{
      return true;
    }
  }
    
 
  public function add(){
    $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[12]|callback_check_username');
    $this->form_validation->set_rules('firstname', 'FirstName', 'required');
    $this->form_validation->set_rules('lastname', 'LastName', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('suburb', 'Suburb', 'xss_clean|required');
    $this->form_validation->set_rules('state', '...', 'required|callback_check_state');
    $this->form_validation->set_rules('postcode', 'Postcode', 'required');
    $this->form_validation->set_rules('number_of_children', '...', 'required|callback_check_numberofchildren');
    $this->form_validation->set_rules('date', 'Start Date', 'required');
    $this->form_validation->set_rules('days_per_week[]', 'Days of week', 'required');
    $this->form_validation->set_rules('flexible_days', '...', 'required|callback_check_flexible_days');
    $this->form_validation->set_rules('hours_required', 'Hours required', 'required');
    $this->form_validation->set_rules('have_pets', '...', 'required|callback_check_havepets');
    $this->form_validation->set_rules('pets_hide', '...', 'required|callback_check_petshide');
    $this->form_validation->set_rules('child_activities', 'Child Activities', 'required');
    $this->form_validation->set_rules('already_have_nanny', '...', 'required|callback_check_alreadyhavenanny');
    $this->form_validation->set_rules('rate_of_pay', 'Rate of pay', 'required');
    $this->form_validation->set_rules('prefer_care', '...', 'required|callback_check_prefercareat');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
    $this->form_validation->set_rules('password', 'Password', 'required|matches[conf_password]');
    $this->form_validation->set_rules('conf_password', 'Password Confirmation', 'required');
    $this->form_validation->set_rules('terms[]', 'Terms and Conditions ', 'required');
    if($this->form_validation->run() == FALSE){
      $this->index();
    }else{
      $this->data['familyCount'] = $this->um->getAllFamilyProfile();
      $fCount = $this->data['familyCount'];
      //echo $fCount; exit;
      $accountType = 2;
      if($accountType){
         // executes when the family profile users exceed to 100 members
         if($fCount >= 100){
             
            //if photo is empty return error
            if($_FILES['photo']['name'] == ""){
                $this->data['empty'] = "Please upload a photo of you.";
                $this->index();
            }else{
                if(!$this->upload->do_upload('photo')){
                     if($_FILES['photo']['name']){
                        //set error if filetype is not an image
                         $this->data['error'] = "The filetype you are attempting to upload is not allowed."; 
                          $this->index();
                     }
                }else{
                    $data['upload_data'] = $this->upload->data();

                    $uploadSuccess = $data['upload_data'];
            
                    $raw_name = $uploadSuccess['file_name'];
                                
                    $this->load->library('image_lib');
            
                    $file_name = $raw_name;
                    
                    $image_path = 'assets/uploads/' .$file_name;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] =  $image_path;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 150;
                    $config['height'] = 110;
                    $config['new_image'] = 'thumb_'.$file_name;
                    
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                          
                    $image_path = 'assets/uploads/' .$file_name;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] =  $image_path;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $config['new_image'] = 'medium_size_'.$file_name;
                    
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    
                    $availableDaysPerweeks = $this->input->post('days_per_week');
                    $saveDaysPerweeks = implode("-", $availableDaysPerweeks);
                    
                    $password = $this->input->post('password');
                    $password_sha1 = sha1($password);
                    $conf_password = $this->input->post('conf_password');
                    $conf_pass_sha1 = sha1($conf_password);
                    
                    $ageOfBoys = $this->input->post('age_of_boys');
          
                    $ageOfGirls = $this->input->post('age_of_girls');
                  
                                
                    if($ageOfBoys == NULL ){
                        $saveAgeOfBoys = $this->input->post('age_of_boys');
                    }else{
                         $saveAgeOfBoys = implode("-", $ageOfBoys);
                    }
                            
                    if($ageOfGirls == NULL ){
                         $saveAgeOfGirls = $this->input->post('age_of_girls');
                    }else{
                         $saveAgeOfGirls = implode("-", $ageOfGirls);
                    }
                    
                    $make_profile = 1;
                    
                    $address = $this->input->post('address');
                    $suburb = $this->input->post('suburb');
                    
                                $state = $this->input->post('state');
                                $postcode = $this->input->post('postcode');
                                $addressState = $address."," .$state."," .$postcode;
                                $realAddress = urlencode($addressState);
                                
                    $urlx = "http://maps.google.com/maps/api/geocode/json?address={$realAddress}&sensor=false";
                    $ch = curl_init($urlx);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    $data = curl_exec($ch);
                    curl_close($ch);
                    $obj = json_decode($data);
                    $lattitude = $obj->results[0]->geometry->location->lat;
                    $longitde = $obj->results[0]->geometry->location->lng;
                    
                    $address1 = $this->input->post('address');
                                $state = $this->input->post('state');
                                $postcode = $this->input->post('postcode');
                                
                                $addressState = $address1.",".$suburb.",".$state."," .$postcode;
                    $postCodeSuburb = $postcode." ".$suburb;
                    
                    $status = 3;
                    $array = array(
                            'username'=>$this->input->post('username'),
                            'first_name'=>$this->input->post('firstname'),
                            'last_name'=>$this->input->post('lastname'),
                            'address'=>$addressState,
                            'suburb_postcode'=>$postCodeSuburb,
                            'number_of_children'=>$this->input->post('number_of_children'),
                            'boys'=>$this->input->post('boys'),
                            'girls'=>$this->input->post('girls'),
                            'age_of_boys'=>$saveAgeOfBoys,
                            'age_of_girls'=>$saveAgeOfGirls,
                            'start_date'=>$this->input->post('date'),
                            'available_days_per_week'=>$saveDaysPerweeks,
                            'flexible_days'=>$this->input->post('flexible_days'),
                            'hours_required'=>$this->input->post('hours_required'),
                            'have_pets'=>$this->input->post('have_pets'),
                            'dog_cat'=>$this->input->post('pets_hide'),
                            'childs_activities'=>$this->input->post('child_activities'),
                            'already_have_nanny'=>$this->input->post('already_have_nanny'),
                            'rate_of_pay'=>$this->input->post('rate_of_pay'),
                            'prefer_care'=>$this->input->post('prefer_care'),
                            'email_address'=>$this->input->post('email'),
                            'password'=>$password_sha1,
                            'v_password'=>$conf_pass_sha1,
                            'account_type'=>$accountType,
                            'status'=>$status,
                            'make_profile'=>$make_profile,
                            'profile_image'=>$uploadSuccess['file_name']
                            );
                        $this->um->saveData($array);    
                        //get the customer id when save
                        $ids = $this->db->insert_id();
                        
                          //saves the lattitude and longitude of the users input address
                          $this->data['user'] = $this->gm->getLatestUser();
                          $id = $this->data['user'];
                          $user_id = $id->user_id; 
                          
                          $saveLat = array(
                                  'user_id'=>$user_id,
                                  'lattitude'=>$lattitude,
                                  'longitude'=>$longitde              
                                );
                          $this->gm->saveLocation($saveLat); 
                      
                        
                        redirect('payment/id/'.$ids);
                    
                }
               
            }
         
            
         }else{
            $availableDaysPerweeks = $this->input->post('days_per_week');
            $saveDaysPerweeks = implode("-", $availableDaysPerweeks);
            
            $ageOfBoys = $this->input->post('age_of_boys');
  
            $ageOfGirls = $this->input->post('age_of_girls');
          
						
            if($ageOfBoys == NULL ){
                $saveAgeOfBoys = $this->input->post('age_of_boys');
            }else{
                 $saveAgeOfBoys = implode("-", $ageOfBoys);
            }
                    
            if($ageOfGirls == NULL ){
                 $saveAgeOfGirls = $this->input->post('age_of_girls');
            }else{
                 $saveAgeOfGirls = implode("-", $ageOfGirls);
            }
            
            $make_profile = 1;
						
            $password = $this->input->post('password');
            $password_sha1 = sha1($password);
            $conf_password = $this->input->post('conf_password');
            $conf_pass_sha1 = sha1($conf_password);
            
            //get the lattitude and longitude from the input address textbox
            
            $address = $this->input->post('address');
            $state = $this->input->post('state');
            $postcode = $this->input->post('postcode');
            $addressState = $address."," .$state."," .$postcode;
            $realAddress = urlencode($addressState);
						
            $urlx = "http://maps.google.com/maps/api/geocode/json?address={$realAddress}&sensor=false";
            $ch = curl_init($urlx);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            $obj = json_decode($data);
            $lattitude = $obj->results[0]->geometry->location->lat;
            $longitde = $obj->results[0]->geometry->location->lng;
						
						$address1 = $this->input->post('address');
						$state = $this->input->post('state');
						$postcode = $this->input->post('postcode');
						
						$addressState = $address1."," .$state.",".$postcode;
      
             $array = array(
                'username'=>$this->input->post('username'),
                'first_name'=>$this->input->post('firstname'),
                'last_name'=>$this->input->post('lastname'),
                'address'=>$addressState,
								'suburb_postcode'=>$postcode,
                'number_of_children'=>$this->input->post('number_of_children'),
                'boys'=>$this->input->post('boys'),
                'girls'=>$this->input->post('girls'),
                'age_of_boys'=>$saveAgeOfBoys,
                'age_of_girls'=>$saveAgeOfGirls,
                'start_date'=>$this->input->post('date'),
                'available_days_per_week'=>$saveDaysPerweeks,
                'flexible_days'=>$this->input->post('flexible_days'),
                'hours_required'=>$this->input->post('hours_required'),
                'have_pets'=>$this->input->post('have_pets'),
                'dog_cat'=>$this->input->post('pets_hide'),
                'childs_activities'=>$this->input->post('child_activities'),
                'already_have_nanny'=>$this->input->post('already_have_nanny'),
                'rate_of_pay'=>$this->input->post('rate_of_pay'),
                'prefer_care'=>$this->input->post('prefer_care'),
                'email_address'=>$this->input->post('email'),
                'password'=>$password_sha1,
                'v_password'=>$conf_pass_sha1,
                'account_type'=>$accountType,
								'make_profile'=>$make_profile
                );
            $this->um->saveData($array);
            
            //saves the lattitude and longitude of the users input address
            $this->data['user'] = $this->gm->getLatestUser();
            $id = $this->data['user'];
            $user_id = $id->user_id; 
            
            $saveLat = array(
                    'user_id'=>$user_id,
                    'lattitude'=>$lattitude,
                    'longitude'=>$longitde              
                  );
            $this->gm->saveLocation($saveLat); 
      
            $this->session->set_flashdata('success', 1);
            redirect('family-profile');
         }
      }
     
    }
  }
  
	public function index(){
    $this->data['title'] = 'Family Profile | Nanny Share Australia';
    $this->data['familyProfile'] = $this->uri->segment(1);
    $this->data['getAllData'] = $this->um->getAllData();
		$this->data['countUsers'] = $this->um->countAllUsers();
	 
    $this->template_lib->set_view('index_view', 'familyprofile_view', $this->data);
	}
}

