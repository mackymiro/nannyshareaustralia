<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Password_recovery extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
    $this->load->model('login_model', 'lm');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
    $this->load->library('email');
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
		$this->data['getAllData'] = $this->um->getAllData();
		$this->data['countUsers'] = $this->um->countAllUsers();
    //if($this->input->post('remember_me')){
    //  $this->config->set_item('sess_expire_on_close', '0');
      //echo $this->input->post( 'remember_me' ); exit;
    //}
    if($this->session->userdata('loggedIn')){
      redirect('profile');
    }
		
		if($this->session->userdata('loggedInBlog')){
      redirect('admin');
    }
  }
  

  public function change(){      
    $this->form_validation->set_rules('new_password', 'Password', 'required|matches[conf_password]');
    $this->form_validation->set_rules('conf_password', 'Password Confirmation', 'required');
    $uri = $this->uri->segment(3);
    $randomCode = $this->input->post('get_random_code');
		

     if($this->form_validation->run() == FALSE){
       $this->data['title'] = 'Change password | Nanny Share Australia';
       $this->data['recoverPassword'] = $this->uri->segment(2);
       $this->data['getAllData'] = $this->um->getAllData();
       if($uri){
         $this->data['getRandomCode'] = $uri;
       }else{
          $this->data['getRandomCode'] = $randomCode;
       }
    
       $this->template_lib->set_view('index_view', 'changepass_view', $this->data);
    }else{
      $password = $this->input->post('new_password');
      $password_sha1 = sha1($password);
      $new_password = $this->input->post('conf_password');
      $new_pass_sha1 = sha1($new_password);
      $random_code = $this->input->post('get_random_code');
      
      $array = array(
               'password'=>$password_sha1,
               'v_password'=>$new_pass_sha1
              );
      $this->db->where('random_code', $random_code)->update('tbl_user', $array);
      //update random code and set to NULL 
      $randomCodeNull = NULL;
      $updateRandomCode = array(
                            'random_code'=>$randomCodeNull
                           );
      $this->db->where('password', $password_sha1)->update('tbl_user', $updateRandomCode);
      $this->session->set_flashdata('success_edit', 1);
      redirect(base_url().'password-recovery/change'); 
    }
  }

  
  
  public function recover_password(){
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    
    if($this->form_validation->run() == FALSE){
      $this->index();
    }else{
      $email = $this->input->post('email');
      $result = $this->lm->email($email);
      if($result){
        //$setExpiry = 7200;
        $random_code = substr(hash('sha512',rand()),0,12);
         
        //save the random code in the database
       $array = array(
            'random_code'=>$random_code
            );
        $this->db->where('email_address', $email)->update('tbl_user', $array);
        
        $this->email->from('no-reply@nannyshareaustralia.com.au', 'Nanny Share Australia');
        $this->email->to($email);
        $this->email->subject('Change password | Nanny Share Australia');
        $this->email->message("
                       <!DOCTYPE html>
                            <html>
                            <head>
                            <title>Nanny Share Australia</title>
                            </head>
                            <body>
                            <div style='width:500px; >
                              <div style='width:500px;'>
                                <a href='http://www.nannyshareaustralia.com.au' target='_blank' rel='nofollow' >
                                  <img alt='nannyshare logo' src='http://www.nannyshareaustralia.com.au/assets/images/canvas.png' width='298' height='88' />
                                </a>                           
                              </div>
                              <div style='margin-left:40px; margin-top:80px;'>
                                <p style='font-size:13px; font-weight:bold'>
                                   Hello! youv'e requested to change your password. Open this link below<br />
                                  <a href=http://www.nannyshareaustralia.com.au/password-recovery/change/$random_code/ target='_blank' rel='nofollow' >
                                    http://www.nannyshareaustralia.com.au/password-recovery/change/$random_code/
                                  </a>  
                                </p>
                                <br />
                                <p style='font-size:13px; font-weight:bold'>
                                  Nanny Share Australia Team
                                </p>
                              </div>
                            </div>
                            </body>
                            </html>
                        ");
          $this->email->send();
          $this->session->set_flashdata('succ_send', 1);
          redirect('password-recovery/recover-password');       
      }else{
        $this->session->set_flashdata('succ_failed', 1);
        redirect('password-recovery/recover-password');
      }
          
    }
  }
   
  
	public function index(){
		$this->data['title'] = 'Password recovery | Nanny Share Australia';    
    $this->data['recoverPassword'] = $this->uri->segment(1);
		
    $this->template_lib->set_view('index_view', 'passwordrecovery_view', $this->data);
	}
}


