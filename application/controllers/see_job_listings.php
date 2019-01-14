<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class See_job_listings extends CI_Controller {
   public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
    $this->load->model('job_model', 'jm');
		$sessionData = $this->session->userdata('loggedIn');
    $this->data['id'] = $sessionData['id'];
    $this->data['username'] = $sessionData['username'];
    $this->data['type'] = $sessionData['profile_type'];
		
		if($this->session->userdata('loggedInBlog')){
      redirect('admin');
    }
    
  }
  
	public function index(){
        $this->data['title'] = 'See Job Listings| Nanny Share Australia';
        $this->data['menu'] = 'see_job_listings';
        $this->data['profile'] = 'see_job_listings';
        //session destroy the profile 
        $this->session->unset_userdata('urlLink');
        $this->data['getAllData'] = $this->um->getAllData();
        $this->data['countUsers'] = $this->um->countAllUsers();
        $this->data['getJobListing'] = $this->jm->getCreateJobListings();
        $this->data['getAllJobs'] = $this->jm->getAllJobListing();
           
        $this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
        
        $sessionData = $this->session->userdata('loggedIn');
        $this->data['id'] = $sessionData['id'];
        $this->data['username'] = $sessionData['username'];
            
        $this->template_lib->set_view('index_view','see_job_listings_view', $this->data);
	}
}

