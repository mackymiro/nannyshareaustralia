<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
error_reporting(0);
class Login extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('login_model', 'lm');
    $this->load->model('users_model', 'um');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
    if($this->input->post('remember_me')){
      $this->config->set_item('sess_expire_on_close', '0');
      //echo $this->input->post( 'remember_me' ); exit;
    }
    
    if($this->session->userdata('loggedIn')){
      redirect('profile');
    }
  }
  
  public function check_database($password){
    $username = $this->input->post('username');
    $result = $this->lm->login($username, $password);
    
    $acctType = "";
    $paidMem = "";
    $status = "";
    foreach($result as $res){
       $acctType = $res->account_type; 
       $paidMem =  $res->paid_member; 
       $status = $res->status;
       
       
    }
     
    if($acctType == 2 && $status == 2 && $paidMem == 1){
        if($result){
          $sess_array = array();
          foreach($result as $row){
            $sess_array = array(
                          'id'=>$row->user_id,
                          'username'=>$row->username,
                          'profile_type'=>$row->profile_type,
                          'account_type'=>$row->account_type
                          
                          );
            $this->session->set_userdata('loggedIn', $sess_array);
          }
          return true;
        }else{
          $this->form_validation->set_message('check_database', 'Invalid Username/Email or Password.');
          return false;
        }
    }elseif($acctType == 2 && $status == 1 && $paidMem == 0){
       if($result){
          $sess_array = array();
          foreach($result as $row){
            $sess_array = array(
                          'id'=>$row->user_id,
                          'username'=>$row->username,
                          'profile_type'=>$row->profile_type,
                          'account_type'=>$row->account_type
                          
                          );
            $this->session->set_userdata('loggedIn', $sess_array);
          }
          return true;
        }else{
          $this->form_validation->set_message('check_database', 'Invalid Username/Email or Password.');
          return false;
        }
      
    }elseif($acctType == 2 && $status == 3 && $paidMem ==0){
       //redirect to payment
       if($result){
         $sess_array = array();
          foreach($result as $row){
            $sess_array = array(
                          'id'=>$row->user_id,  
                          );    
          }
          redirect('payment/id/'.$sess_array['id']);
       }else{
          $this->form_validation->set_message('check_database', 'Invalid Username/Email or Password.');
          return false;
       }
       
       
    }elseif($acctType == 1){
       if($result){
          $sess_array = array();
          foreach($result as $row){
            $sess_array = array(
                          'id'=>$row->user_id,
                          'username'=>$row->username,
                          'profile_type'=>$row->profile_type,
                          'account_type'=>$row->account_type
                          
                          );
            $this->session->set_userdata('loggedIn', $sess_array);
          }
          return true;
        }else{
          $this->form_validation->set_message('check_database', 'Invalid Username/Email or Password.');
          return false;
        }
      
    }
    
   
    
  }
  
  public function auth(){
    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
    if($this->form_validation->run() == FALSE){
      $this->index();
    }else{
        $uLink = $this->session->userdata('urlLink');
        if($uLink){
            redirect($uLink);
        }else{
            redirect('profile');
        }
        
    }
  }
  
	public function index(){
		$this->data['title'] = 'Login | Nanny Share Australia';    
    $this->data['login'] = $this->uri->segment(1);
    $this->data['getAllData'] = $this->um->getAllData();
		$this->data['countUsers'] = $this->um->countAllUsers();
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
    
    $this->template_lib->set_view('index_view', 'login_view', $this->data);
	}
}


