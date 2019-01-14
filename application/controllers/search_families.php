<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Search_families extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
    $this->load->model('matches_model', 'mu');
    $this->load->model('search_familynanny_model', 'fm');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
    $this->load->library("geozip");
    
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
  }
  
  public function index(){
    $this->data['title'] = 'Search families in your area | Nanny Share Australia';
    $this->data['searchFamilies'] = $this->uri->segment(1);
    $this->data['getAllData'] = $this->um->getAllData();
		$this->data['countUsers'] = $this->um->countAllUsers();
    $this->data['profile'] = 'profile';
    $this->data['profile'] = 'edit_profile';
    
    $sessionData = $this->session->userdata('loggedIn');
    $this->data['id'] = $sessionData['id'];
    
    //search postcode/suburb in your area
    $this->data['searchFamilies'] = $this->input->post('search_families');
    
    //search 5kms, 10kms, 15kms, 20kms
    $this->data['searchKilometers'] = $this->input->post('family_kilometers');
    $km = $this->data['searchKilometers'];
    $distance = '';
    $distance1 = '';
    
 
    $this->data['Searches'] = $this->fm->searchFamiliesWithD($this->data['searchFamilies'],$km);
    if($this->data['Searches']==null)
      $this->data['notFound'] = 'No results found';
   
     
    $this->template_lib->set_view('index_view', 'searchfamilies_view', $this->data);
  }
}


