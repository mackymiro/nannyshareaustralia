<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Blog extends CI_Controller {
   public function __construct(){
    parent::__construct();
		$this->load->model('users_model', 'um');
    $this->load->model('login_model', 'lm');
    $this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
    $this->data['getAllData'] = $this->um->getAllData();
		$this->data['countUsers'] = $this->um->countAllUsers();
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
				
    if($this->session->userdata('loggedIn')){
      redirect('profile');
    }
		
    if($this->session->userdata('loggedInBlog')){
      redirect('admin');
    }
    
  }
	
			
	//view details of a blogs
	public function view_details(){
		$this->data['title'] = 'Blog View | Nanny Share Australia';
		$this->data['menu'] = 'blog';
		$id = $this->uri->segment(3);
		
		$this->data['getBlogDetails'] = $this->bm->getBlogDetails($id);
		$this->template_lib->set_view('index_view', 'blog_detail_view', $this->data);
	}
	  

  public function check_database($password){
    $username = $this->input->post('username');
    $results = $this->lm->loginBlog($username, $password);
    if($results){
      $sess_array = array();
      foreach($results as $row){
        $sess_array = array(
                    'id'=>$row->id,
                    'username'=>$row->username
                  );
        $this->session->set_userdata('loggedInBlog', $sess_array);
      }
      return true;
    }else{
      $this->form_validation->set_message('check_database', 'Invalid Username/Email or Password.');
      return false;
    }
  }
  
  public function auth(){
     $this->form_validation->set_rules('username', 'Username', 'required');
     $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|callback_check_database');
     if($this->form_validation->run() == FALSE){
        $this->admin();
     }else{
       redirect('admin');
     }
  }
  
  public function admin(){
    $this->data['title'] = 'Admin | Nanny Share Australia';
    $this->data['blogs'] = $this->uri->segment(2);
    
    $this->template_lib->set_view('index_view', 'blog_admin_view', $this->data);
  }
  
  
	public function index(){
        $this->data['title'] = 'Blog | Nanny Share Australia';
        $this->data['menu'] = 'blog';
        //session destroy the profile 
        $this->session->unset_userdata('urlLink');
        
        $this->data['getBlogPosts1'] = $this->bm->getAllBlogPosts();
            
            
        $this->template_lib->set_view('index_view', 'blog_view', $this->data);
	}
	

}

