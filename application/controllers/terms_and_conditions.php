<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms_and_conditions extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
  }
  
  public function index(){
        $this->data['title'] = 'Terms and Conditions | Nanny Share Australia';
        $this->data['terms'] = $this->uri->segment(1);
        $this->data['profile'] = 'terms';
        $this->data['menu'] = 'terms';
        //session destroy the profile 
        $this->session->unset_userdata('urlLink');
        $this->data['getAllData'] = $this->um->getAllData();
        $this->data['countUsers'] = $this->um->countAllUsers();
        
        $this->template_lib->set_view('index_view', 'terms_view', $this->data);
  }
 
}


