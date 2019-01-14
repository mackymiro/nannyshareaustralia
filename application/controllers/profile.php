<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Profile extends CI_Controller{
    public function __construct(){
        parent::__construct();  
        $config['upload_path'] = 'assets/uploads/';
        // set the filter image types
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '9000';
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);
        
        $this->upload->initialize($config);
        $this->upload->set_allowed_types($config['allowed_types']);
        $data['upload_data'] = '';
        
        $this->load->model('search_familynanny_model', 'fm');  
        $this->load->model('users_model', 'um');
        $this->load->model('data_model', 'dm');
        $this->load->model('messages_model', 'mm');
        $this->load->model('geocode_model', 'gm');
        $this->load->model('matches_model', 'mu');
        $this->load->model('blogs_model', 'bm');
        $this->load->helper('text');
        $this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
        $this->data['getAllData'] = $this->um->getAllData();
        $this->data['countUsers'] = $this->um->countAllUsers();
            
        $sessionData = $this->session->userdata('loggedIn');
        $this->data['id'] = $sessionData['id'];
        $this->data['username'] = $sessionData['username'];
        $this->data['type'] = $sessionData['profile_type'];
        
        if($this->input->post( 'remember_me' ) ){// set sess_expire_on_close to 0 or FALSE when remember me is checked.
            $this->config->set_item('sess_expire_on_close', '0'); // do change session config    
            //echo $this->input->post( 'remember_me' ); exit;
        }
        if(!$this->session->userdata('loggedIn')){
            //store session profile user
            $id = $this->uri->segment(3);
            $current = 'profile/id/'.$id;
            $this->session->set_userdata(array(
                                        'urlLink'=>$current
                        ));
            $uLink  = $this->session->userdata('urlLink');
            
            redirect('login');
        }
    }
  
  public function update(){    
    $profileType = $this->input->post('profileType');
    //profile type 1 is nanny profile
    if($profileType == 1){
      //if not successful, set the error message
      if (!$this->upload->do_upload('photo')){
        $ids = $this->input->post('editData');
        
        //edit the profile page without uploading a photo
        if($_FILES['photo']['name'] == ""){      
            $ids = $this->input->post('editData');
            $year = $this->input->post('year');
            $month = $this->input->post('month');
            $day = $this->input->post('days');
            $dob = $year."-".$month."-" .$day;
            
            $availableDaysPerweeks = $this->input->post('available_days_week');
            $saveDaysPerweeks = implode("-", $availableDaysPerweeks);
            
            $agesOfChildrens = $this->input->post('ages_of_children');
            $saveAgesOfChildren = implode("-", $agesOfChildrens);
            
           
										    
            $update = array(
                'first_name'=>$this->input->post('firstname'),
                'last_name'=>$this->input->post('lastname'),
                'date_of_birth'=>$dob,
                'mummy_shared_nanny'=>$this->input->post('mummy_shared_nanny'),
								'mummy_nanny_child_age'=>$this->input->post('mummynanny_childage'),
                'number_of_children_prepared_to_care_for'=>$this->input->post('number_of_children_prepared'),
                'ages_of_children_cared_of'=>$saveAgesOfChildren,
                'start_date'=>$this->input->post('start_date'),
                'available_days_per_week'=>$saveDaysPerweeks,
                'expected_hourly_rate'=>$this->input->post('hourly_rate'),
                'have_abn'=>$this->input->post('have_abn'),
                'have_drivers_licence'=>$this->input->post('have_driverslicence'),
                'have_first_aid_certificate'=>$this->input->post('have_firstaid'),
                'registered_carrer'=>$this->input->post('registered_carrer'),
                'yr_exp_as_nanny'=>$this->input->post('nanny_exp'),
                'multiple_children_exp'=>$this->input->post('multiple_exp'),
                'other_skills'=>$this->input->post('other_skills'),
                'a_little_about_myself'=>$this->input->post('about_myself'),
                'make_profile'=>$this->input->post('visible')
              );
              $this->db->where('user_id', $this->input->post('editData'))->update('tbl_user', $update);
              
             
              $this->session->set_flashdata('success', 1);     
              redirect('profile/edit/id/'.$ids);
        }
        
        $this->session->set_flashdata('error', 1); 
        redirect('profile/edit/id/'.$ids);
        
      }else{ //else, set the success message        
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
        
      
      }
      
      $ids = $this->input->post('editData');
      $year = $this->input->post('year');
      $month = $this->input->post('month');
      $day = $this->input->post('days');
      $dob = $year."-".$month."-" .$day;
      
      $availableDaysPerweeks = $this->input->post('available_days_week');
      $saveDaysPerweeks = implode("-", $availableDaysPerweeks);
      
      $agesOfChildrens = $this->input->post('ages_of_children');
      $saveAgesOfChildren = implode("-", $agesOfChildrens);
       
      
      $update = array(
          'first_name'=>$this->input->post('firstname'),
          'last_name'=>$this->input->post('lastname'),
          'date_of_birth'=>$dob,
          'mummy_shared_nanny'=>$this->input->post('mummy_shared_nanny'),
					'mummy_nanny_child_age'=>$this->input->post('mummynanny_childage'),
          'number_of_children_prepared_to_care_for'=>$this->input->post('number_of_children_prepared'),
          'ages_of_children_cared_of'=>$saveAgesOfChildren,
          'start_date'=>$this->input->post('start_date'),
          'available_days_per_week'=>$saveDaysPerweeks,
          'expected_hourly_rate'=>$this->input->post('hourly_rate'),
          'have_abn'=>$this->input->post('have_abn'),
          'have_drivers_licence'=>$this->input->post('have_driverslicence'),
          'have_first_aid_certificate'=>$this->input->post('have_firstaid'),
          'registered_carrer'=>$this->input->post('registered_carrer'),
          'yr_exp_as_nanny'=>$this->input->post('nanny_exp'),
          'multiple_children_exp'=>$this->input->post('multiple_exp'),
          'other_skills'=>$this->input->post('other_skills'),
          'a_little_about_myself'=>$this->input->post('about_myself'),
          'make_profile'=>$this->input->post('visible'),
          'profile_image'=>$uploadSuccess['file_name']
        );
        $this->db->where('user_id', $this->input->post('editData'))->update('tbl_user', $update);
        
      
        $this->session->set_flashdata('success', 1);     
        redirect('profile/edit/id/'.$ids);

      
    }else{
      if (!$this->upload->do_upload('photo')) {
        $ids = $this->input->post('editData');
        //edit a profile page without uploading a photo
        if($_FILES['photo']['name'] == ""){      
            $ids = $this->input->post('editData');          
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
                        
                    
                $update = array(
                    'first_name'=>$this->input->post('firstname'),
                    'last_name'=>$this->input->post('lastname'),
                    'number_of_children'=>$this->input->post('number_of_children'),
                    'boys'=>$this->input->post('boys'),
                    'girls'=>$this->input->post('girls'),
                    'age_of_boys'=>$saveAgeOfBoys,
                    'age_of_girls'=>$saveAgeOfGirls,
                    'start_date'=>$this->input->post('start_date'),
                    'available_days_per_week'=>$saveDaysPerweeks,
                    'hours_required'=>$this->input->post('hours_required'),
                    'have_pets'=>$this->input->post('have_pets'),
                    'dog_cat'=>$this->input->post('pets_hide'),
                    'childs_activities'=>$this->input->post('child_act'),
                    'already_have_nanny'=>$this->input->post('already_have_nanny'),
                    'rate_of_pay'=>$this->input->post('rate_of_pay'),
                    'prefer_care'=>$this->input->post('prefer_care'),
                    'additional_comments'=>$this->input->post('add_comments'),
                    'make_profile'=>$this->input->post('visible')
                  );
                  $this->db->where('user_id', $this->input->post('editData'))->update('tbl_user', $update);
                  
             
              
              $this->session->set_flashdata('success', 1);     
              redirect('profile/edit/id/'.$ids);
             
        }
        $data =  $this->upload->display_errors();
        $error = $this->session->set_flashdata('error', 1); 
        redirect('profile/edit/id/'.$ids, $error);
   
      }else{ //else, set the success message        
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
      }
      $ids = $this->input->post('editData');
      
      $availableDaysPerweeks = $this->input->post('days_per_week');
      $saveDaysPerweeks = implode("-", $availableDaysPerweeks);
      
      $ageOfBoys = $this->input->post('age_of_boys');
      $saveAgeOfBoys = implode("-", $ageOfBoys);
      
      $ageOfGirls = $this->input->post('age_of_girls');
      $saveAgeOfGirls = implode("-", $ageOfGirls);
          
            
      $update = array(
                'first_name'=>$this->input->post('firstname'),
                'last_name'=>$this->input->post('lastname'),
                'number_of_children'=>$this->input->post('number_of_children'),
                'boys'=>$this->input->post('boys'),
                'girls'=>$this->input->post('girls'),
                'age_of_boys'=>$saveAgeOfBoys,
                'age_of_girls'=>$saveAgeOfGirls,
                'start_date'=>$this->input->post('start_date'),
                'available_days_per_week'=>$saveDaysPerweeks,
                'hours_required'=>$this->input->post('hours_required'),
                'have_pets'=>$this->input->post('have_pets'),
                'dog_cat'=>$this->input->post('pets_hide'),
                'childs_activities'=>$this->input->post('child_act'),
                'already_have_nanny'=>$this->input->post('already_have_nanny'),
                'rate_of_pay'=>$this->input->post('rate_of_pay'),
                'prefer_care'=>$this->input->post('prefer_care'),
                'additional_comments'=>$this->input->post('add_comments'),
                'make_profile'=>$this->input->post('visible'),
                'profile_image'=>$uploadSuccess['file_name']
              );
      $this->db->where('user_id', $this->input->post('editData'))->update('tbl_user', $update);
      
      
      $this->session->set_flashdata('success', 1);
      redirect('profile/edit/id/'.$ids);
    }
  }


  
  public function id($id){
    $id = $this->uri->segment(3);
       
    $this->data['profile'] = 'view_profile';    
    $this->data['daysPerWeekCheckboxes'] = $this->dm->getDaysPerWeekCheckbox();
    $this->data['agesOfChildrenCheckboxes'] = $this->dm->getAgesOfChildrenCaredOfCheckboxes();
    $this->data['agesOfBoysAndGirls'] = $this->dm->getAge();
		
 
    $this->data['query'] = $this->um->getUsersProfile($id);
    //redirect if no ID has been found
    if($this->data['query'] ==  NULL){
        redirect('profile/id/'.$this->data['id']);
    }else{
        $this->data['title'] = ' '.ucwords($this->data['query']->first_name).ucwords($this->data['query']->last_name).' | Nanny Share Australia';

        $this->data['apart'] = $this->fm->getDistanceFromLogged($id);
        
        if($this->data['id'] ==  $id){
          redirect('profile');
        }
        $this->template_lib->set_view('index_view', 'profile_user', $this->data);
    }
   
  

  }
  
  public function edit($id){
    $id = $this->uri->segment(4);
    $this->data['title'] = 'Edit Profile | Nanny Share Australia';
    $this->data['profile'] = 'edit_profile';

    $this->data['query'] = $this->um->getData($this->data['id']);
  
    $this->data['getMummySharedNannies'] = $this->dm->getMummySharedNanny();
    $this->data['numberOfChildrens'] = $this->dm->getAllNumber();
    $this->data['numberOfboys'] = $this->dm->getAllNumber();
    $this->data['agesOfBoysAndGirls'] = $this->dm->getAge();
    $this->data['numberOfgirls'] = $this->dm->getAllNumber();
    $this->data['daysPerWeek'] = $this->dm->getDaysPerWeek();
    $this->data['daysPerWeekCheckboxes'] = $this->dm->getDaysPerWeekCheckbox();
    $this->data['flexibleDays'] = $this->dm->getYesNo();
    $this->data['havePets'] = $this->dm->getYesNo();
    $this->data['dogCat'] = $this->dm->getDogCat();
    $this->data['alreadyHaveNannies'] = $this->dm->getYesNo();
    $this->data['preferCares'] = $this->dm->getPreferCare();
    $this->data['visibles'] = $this->dm->getVisibleProfile();
    $this->data['years'] = $this->dm->getYear();
    $this->data['months'] = $this->dm->getMonth();
    $this->data['days'] = $this->dm->getDay();
    $this->data['numberOfChildrenPrepares'] = $this->dm->getAllNumber();
    $this->data['agesOfChildren'] = $this->dm->getAgesOfChildrenCaredOf();
    $this->data['agesOfChildrenCheckboxes'] = $this->dm->getAgesOfChildrenCaredOfCheckboxes();
    $this->data['haveAbns'] = $this->dm->getYesNo();
    $this->data['haveDriversLicences'] = $this->dm->getYesNo();
    $this->data['haveFirstAids'] = $this->dm->getYesNo();
    $this->data['registeredCarrers'] = $this->dm->getYesNo();
    $this->data['nannyExps'] = $this->dm->getNannyExp();
    $this->data['multipleExps'] = $this->dm->getYesNo();
    
    $this->template_lib->set_view('index_view', 'profile_edit', $this->data);
    
  }

  
	public function index(){
        $this->data['profile'] = 'profile';
       
        $this->data['query'] = $this->um->getData($this->data['id']);
        
        $this->data['title'] = ' '.ucwords($this->data['query']->first_name).ucwords($this->data['query']->last_name).' | Nanny Share Australia';
        $this->data['daysPerWeekCheckboxes'] = $this->dm->getDaysPerWeekCheckbox();
        $this->data['agesOfChildrenCheckboxes'] = $this->dm->getAgesOfChildrenCaredOfCheckboxes();
        $this->data['agesOfBoysAndGirls'] = $this->dm->getAge();
                
        //count all family profile type
        $this->data['familyCount'] = $this->um->getAllFamilyProfile();
        
        //count all the number of messages in the database
        $this->data['getNumberOfMessages'] = $this->mm->getNumberOfMessages($this->data['id']);
        $this->data['countNumber'] = $this->data['getNumberOfMessages'];
        
        
        //get the distance 
         $this->data['getAddress'] = $this->mu->getAddress($this->data['id']);
         $distance = "";
         foreach($this->data['getAddress'] as $family){
           $distance = $family->distance; 
         }
         
         $dist_arr = explode(".",$distance);
         $address = $dist_arr[0];
         
         if($address >= 4000 && $address <= 6000){
            //count all the number of family matches
            $this->data['getFamilyMatches'] = count($this->mu->getAllFamilyMatchesV1());
            $this->data['countFamilyMatches'] = $this->data['getFamilyMatches'];
            
             //count all the number of nanny matches
            $this->data['getNannyMatches'] = count($this->mu->getAllFamilyMatchesV1(1,1,1));
            $this->data['countNannyMatches'] = $this->data['getNannyMatches'];
            
            $response_family = array(
                    'status'=>'ok',
                    'StatusFamily'=>$this->data['countFamilyMatches']
                    );
            if($this->input->get('family') == "family_success"){
              echo json_encode($response_family);
              exit;
            }
            
            $response_nanny = array(
                    'status'=>'ok',
                    'StatusNanny'=>$this->data['countNannyMatches']
                    );
            if($this->input->get('nanny') == "nanny_success"){
              echo json_encode($response_nanny);
              exit;
            }
            
         }else{
            $this->data['countFamilyMatches'] = '0';
            $countFamilyMatches = $this->data['countFamilyMatches'];
            
            $this->data['countNannyMatches'] = '0';
            $countNannyMatches = $this->data['countNannyMatches'];
         }
           
        $response = array(
                  'status'=>'ok',
                  'StatusMessages'=>$this->data['countNumber']
                  );
       
        if ($this->input->get('ajax') == "success"){
          echo json_encode($response);
          exit;
          //If you don't exit right here. It will return all your page back to browser
          //This section is just for ajax request
        }
        $this->template_lib->set_view('index_view', 'profile_view', $this->data);
	}
}


