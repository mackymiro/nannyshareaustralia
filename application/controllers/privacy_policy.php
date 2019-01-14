<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privacy_policy extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
  }
  
  public function index(){
    $this->data['title'] = 'Privacy Policy | Nanny Share Australia';
    $this->data['privacy'] = $this->uri->segment(1);
    $this->data['profile'] = 'privacy';
    //session destroy the profile 
    $this->session->unset_userdata('urlLink');
        
    $this->data['getAllData'] = $this->um->getAllData();
    $this->data['countUsers'] = $this->um->countAllUsers();
		
    $this->template_lib->set_view('index_view', 'privacy_view', $this->data);
  }
 
}


