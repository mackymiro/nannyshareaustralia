<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Change_password extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
    $this->load->model('geocode_model', 'gm');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
    
     $sessionData = $this->session->userdata('loggedIn');
     $this->data['id'] = $sessionData['id'];
		 $this->data['type'] = $sessionData['profile_type'];
     $this->data['getAllData'] = $this->um->getAllData();
     $this->data['countUsers'] = $this->um->countAllUsers();
     
    if(!$this->session->userdata('loggedIn')){
      redirect('profile');
    }
  
  }

   //change password
   public function change(){
     $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|xss_clean');
     $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|matches[repeat_new_password]');
     $this->form_validation->set_rules('repeat_new_password', 'Repeat New Password', 'trim|required|xss_clean');
     if($this->form_validation->run() == FALSE){
        $this->index();
     }else{
        $this->data['title'] = 'Change Password | Nanny Share Australia';
        
        $currentPassword = $this->input->post('current_password');
        $pwdSha1 = sha1($currentPassword);
        
          //query the current password in the database
         $this->data['getProfileInfo'] = $this->um->getProfileInfo($this->data['id']);
         foreach($this->data['getProfileInfo'] as $infos){
            $getCurrentPassword = $infos->password;
         }
         
          //match if the current password is not the same in the database
           if($pwdSha1 != $getCurrentPassword){
            $this->data['errorCurrentPassword'] = 'Your password does not match the current password';
            
            //getProfileInfos
            $this->data['getProfileInfos'] = $this->um->getProfileInfos($this->data['id']);

            $this->template_lib->set_view('index_view', 'change_password', $this->data,'',$this->data);
          }else{
              $newPassword = $this->input->post('new_password');
              $pwdSha1 = sha1($newPassword);
              
               $update = array(
									'password'=>$pwdSha1
									);
               $this->db->where('user_id', $this->data['id'])->update('tbl_user', $update);
               $this->session->set_flashdata('successPassword', 1);
              
                redirect('change-password');
          
          }
        
     }
     
   }
 
  
	public function index(){
    $this->data['title'] = 'Change Password | Nanny Share Australia';
  
    
    $this->data['profile'] = 'change_password';
	 
    $this->template_lib->set_view('index_view', 'change_password', $this->data);
	}
}

