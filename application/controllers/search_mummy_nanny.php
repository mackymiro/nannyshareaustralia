<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_mummy_nanny extends CI_Controller {
  public function __construct(){
    parent::__construct();
    parent::__construct();
    $this->load->model('users_model', 'um');
    $this->load->model('search_familynanny_model', 'fm');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
  }
  
  public function index(){
    $this->data['title'] = 'Search mummy nanny in your area | Nanny Share Australia';
    $this->data['searchMummyNanny'] = $this->uri->segment(1);
    $this->data['getAllData'] = $this->um->getAllData();
		$this->data['countUsers'] = $this->um->countAllUsers();
    $this->data['profile'] = 'profile';
    $this->data['profile'] = 'edit_profile';
    
    $sessionData = $this->session->userdata('loggedIn');
    $this->data['id'] = $sessionData['id'];
    
    //search postcode/suburb in your area
    $this->data['searchMummyNanny'] = $this->input->post('search_mummy');
    
    //search 5kms, 10kms, 15kms, 20kms
    $this->data['searchKilometers'] = $this->input->post('mummy_kilometers');
    $km = $this->data['searchKilometers'];
    $distance = '';
    $distance1 = '';

    $this->data['Searches'] = $this->fm->searchMummyNannyWithD($this->data['searchMummyNanny'],$km);
    if($this->data['Searches'] == null)
      $this->data['notFound'] = 'No results found';
    
    
    $this->template_lib->set_view('index_view', 'search_mummy_view', $this->data);
  }
}


