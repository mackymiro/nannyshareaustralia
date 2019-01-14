<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Testimonials extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
    if($this->session->userdata('loggedIn')){
      redirect('profile');
    }
  }
  
	public function index(){
        $this->data['title'] = 'Testimonials | Nanny Share Australia';
        $this->data['menu'] = 'testimonials';
        //session destroy the profile 
        $this->session->unset_userdata('urlLink');
        
        $this->data['getAllData'] = $this->um->getAllData();
        $this->data['countUsers'] = $this->um->countAllUsers();
        $this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
        
        $this->template_lib->set_view('index_view', 'testimonials_view', $this->data);
	}
}

