<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class About_us extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
    if($this->session->userdata('loggedIn')){
      redirect('profile');
    }
		
		if($this->session->userdata('loggedInBlog')){
      redirect('admin');
    }
		
  }
  
	public function index(){
        $this->data['title'] = 'About Us | Nanny Share Australia';
        $this->data['menu'] = 'about_us';
        //session destroy the profile 
        $this->session->unset_userdata('urlLink');
        
        $this->data['getAllData'] = $this->um->getAllData();
        $this->data['countUsers'] = $this->um->countAllUsers();
        $this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
            
        $this->template_lib->set_view('index_view','about_view', $this->data);
	}
}

