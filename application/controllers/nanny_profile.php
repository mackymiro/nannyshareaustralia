<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Nanny_profile extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
    $this->load->model('geocode_model', 'gm');
    $this->load->model('blogs_model', 'bm');
    $this->load->helper('text');
    
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
  
  public function check_multiple_children_exp(){
    if($this->input->post('multiple_children_exp') === '0'){
      $this->form_validation->set_message('check_multiple_children_exp', 'Please select multiple children exp.');
      return false;
    }else{
      return true;
    }
    
  }
  
  public function check_yr_exp_nanny(){
    if($this->input->post('yr_exp_nanny') === '0'){
      $this->form_validation->set_message('check_yr_exp_nanny', 'Please select yr experience as a nanny.');
      return false;
    }else{
      return true;
    }
    
  }
  
  public function check_registered_carrer(){
    if($this->input->post('registered_carrer') === '0'){
      $this->form_validation->set_message('check_registered_carrer', 'Please select registered carrer.');
      return false;
    }else{
      return true;
    }
    
  }
  
  public function check_firstaidcertificate(){
    if($this->input->post('have_firstaid') === '0'){
      $this->form_validation->set_message('check_firstaidcertificate', 'Please select first aid certificate.');
      return false;
    }else{
      return true;
    }
    
  }
  
  public function check_driverslicence(){
    if($this->input->post('have_driversl') === '0'){
      $this->form_validation->set_message('check_driverslicence', 'Please select ABN.');
      return false;
    }else{
      return true;
    }
    
  }
  
  public function check_haveabn(){
    if($this->input->post('have_abn') === '0'){
      $this->form_validation->set_message('check_haveabn', 'Please select drivers licence.');
      return false;
    }else{
      return true;
    }
    
  }
     
  public function check_numberofchildren(){
    if($this->input->post('number_of_children') === '0'){
      $this->form_validation->set_message('check_numberofchildren', 'Please select number of children prepared to care for.');
      return false;
    }else{
      return true;
    }
    
  }
  
  public function check_mummyandsharednanny(){
     if($this->input->post('mummy_shared_nanny') === '0'){
      $this->form_validation->set_message('check_mummyandsharednanny', 'Please select mummy nanny or shared nanny.');
      return false;
    }else{
      return true;
    }
  }
  
  public function add(){
    $this->form_validation->set_rules('username', 'Username' , 'xss_clean|required|min_length[4]|max_length[12]|callback_check_username');
    $this->form_validation->set_rules('firstname', 'FirstName', 'xss_clean|required');
    $this->form_validation->set_rules('lastname', 'LastName', 'xss_clean|required');
    $this->form_validation->set_rules('address', 'Address', 'xss_clean|required');
    $this->form_validation->set_rules('suburb', 'Suburb', 'xss_clean|required');
    $this->form_validation->set_rules('postcode', 'Postcode', 'xss_clean|required');
    $this->form_validation->set_rules('state', '...', 'xss_clean|required|callback_check_state');
    $this->form_validation->set_rules('mummy_shared_nanny', '...', 'xss_clean|required|callback_check_mummyandsharednanny');
    $this->form_validation->set_rules('mummynanny_childage', 'Mummy nanny with child age', 'xss_clean|required');
    $this->form_validation->set_rules('number_of_children', '...', 'xss_clean|required|callback_check_numberofchildren');
    $this->form_validation->set_rules('ages_of_children[]', 'Ages of children', 'xss_clean|required');
    $this->form_validation->set_rules('date', 'Start date', 'xss_clean|required');
    $this->form_validation->set_rules('available_days_week[]', 'Available days per week', 'xss_clean|required');
    $this->form_validation->set_rules('hourly_rate', 'Expected hourly rate', 'xss_clean|required');
    $this->form_validation->set_rules('have_abn', '...', 'xss_clean|required|callback_check_haveabn');
    $this->form_validation->set_rules('have_driversl', '...', 'xss_clean|required|callback_check_driverslicence');
    $this->form_validation->set_rules('have_firstaid', '...', 'xss_clean|required|callback_check_firstaidcertificate');
    $this->form_validation->set_rules('registered_carrer', 'Registered carrer', 'xss_clean|required|callback_check_registered_carrer');
    $this->form_validation->set_rules('yr_exp_nanny', '...', 'xss_clean|required|callback_check_yr_exp_nanny');
    $this->form_validation->set_rules('multiple_children_exp', '...', 'xss_clean|required|callback_check_multiple_children_exp');
    $this->form_validation->set_rules('email', 'Email', 'xss_clean|required|valid_email|callback_check_email');
    $this->form_validation->set_rules('password', 'Password', 'xss_clean|required|matches[conf_password]');
    $this->form_validation->set_rules('conf_password', 'Password Confirmation', 'xss_clean|required');
    $this->form_validation->set_rules('terms[]', 'Terms and Conditions ', 'required');
    if($this->form_validation->run() == FALSE){
        $this->index();
               
    }else{
       //print_r($_FILES['photo']['name']);  exit; 
       if($_FILES['photo']['name'] == ""){
         $this->data['empty'] = "Please upload a photo of you.";
         $this->index();
       }else{
            if (!$this->upload->do_upload('photo')){
              if($_FILES['photo']['name']){ 
                  //set error if filetype is not an image
                 $this->data['error'] = "The filetype you are attempting to upload is not allowed."; 
                 $this->index(); 
              }
                
             
           }else{//else, set the success message 
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
              
                  $accountType = 1;
                  $availableDaysPerweeks = $this->input->post('available_days_week');
                  $saveDaysPerweeks = implode("-", $availableDaysPerweeks);
                  
                  $agesOfChildrens = $this->input->post('ages_of_children');
                  $saveAgesOfChildren = implode("-", $agesOfChildrens);
                  
                   $make_profile = 1;
                        
                  $password = $this->input->post('password');
                  $password_sha1 = sha1($password);
                  $conf_password = $this->input->post('conf_password');
                  $conf_pass_sha1 = sha1($conf_password);
                  
                  //get the lattitude and longitude from the input address textbox
                  $address = $this->input->post('address');
                  $suburb = $this->input->post('suburb');
              
                    $state = $this->input->post('state');
                    $postcode = $this->input->post('postcode');
                    $addressState = $address."," .$state."," .$postcode;
                    $realAddress = urlencode($addressState);
                    
                  $urlx = "https://maps.google.com/maps/api/geocode/json?address={$realAddress}&sensor=false";
                  //$urlx = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDqxEf2T0N4tSccYTphal8imT9153VbwC8&address={$address}&sensor=false";
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
                        
                        $array = array(
                           'username'=>$this->input->post('username'),
                           'first_name'=>$this->input->post('firstname'),
                           'last_name'=>$this->input->post('lastname'),
                           'address'=>$addressState,
                            'suburb_postcode'=>$postCodeSuburb,
                           'mummy_shared_nanny'=>$this->input->post('mummy_shared_nanny'),
                            'mummy_nanny_child_age'=>$this->input->post('mummynanny_childage'),
                           'number_of_children_prepared_to_care_for'=>$this->input->post('number_of_children'),
                           'ages_of_children_cared_of'=>$saveAgesOfChildren,
                           'start_date'=>$this->input->post('date'),
                           'available_days_per_week'=>$saveDaysPerweeks,
                           'expected_hourly_rate'=>$this->input->post('hourly_rate'),
                           'have_abn'=>$this->input->post('have_abn'),
                           'have_drivers_licence'=>$this->input->post('have_driversl'),
                           'have_first_aid_certificate'=>$this->input->post('have_firstaid'),
                           'registered_carrer'=>$this->input->post('registered_carrer'),
                           'yr_exp_as_nanny'=>$this->input->post('yr_exp_nanny'),
                           'multiple_children_exp'=>$this->input->post('multiple_children_exp'),
                           'email_address'=>$this->input->post('email'),
                            'password'=>$password_sha1,
                           'v_password'=>$conf_pass_sha1,
                           'account_type'=>$accountType,
                             'make_profile'=>$make_profile,
                              'profile_image'=>$uploadSuccess['file_name']
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
                  redirect('nanny-profile');
           }
           
       }
                
           
       }
         
    
  }
  
	public function index(){
    $this->data['title'] = 'Nanny Profile | Nanny Share Australia';      
    $this->data['nannyProfile'] = $this->uri->segment(1);
		$this->data['getAllData'] = $this->um->getAllData();
		$this->data['countUsers'] = $this->um->countAllUsers();
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
		
    $this->template_lib->set_view('index_view', 'nannyprofile_view', $this->data);
	}
}

