<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
  
  }

	public function index(){
    $this->data['title'] = 'Search | Nanny Search Australia';
    $this->data['search'] = $this->uri->segment(1);
    $this->data['profile'] = 'profile';
    $this->data['profile'] = 'edit_profile';
    $this->data['q'] = $this->input->post('q');
    $sessionData = $this->session->userdata('loggedIn');
    $this->data['id'] = $sessionData['id'];
    
    $this->data['search'] = $this->um->searchNanny($this->data['q']);
    if(!$this->data['search']){
      $this->data['notFound'] = 'No results found';
    }
    
    $this->data['getAllData'] = $this->um->getAllData();
		$this->data['countUsers'] = $this->um->countAllUsers();
		
    $this->template_lib->set_view('index_view', 'search_view',$this->data);
	}
}

