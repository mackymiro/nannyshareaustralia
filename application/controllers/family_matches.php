<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
error_reporting(0);
class Family_matches extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
    $this->load->model('matches_model', 'mu');
		$this->load->model('blogs_model', 'bm');
		$this->load->model('search_familynanny_model', 'fm');
		$this->load->helper('text');
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
		
    $sessionData = $this->session->userdata('loggedIn');
    $this->data['id'] = $sessionData['id'];
    $this->data['type'] = $sessionData['profile_type'];
    $this->data['getAllData'] = $this->um->getAllData();
		$this->data['countUsers'] = $this->um->countAllUsers();
    
    if(!$this->session->userdata('loggedIn')){
      redirect('profile');
    }
		
	
		
  }
	
	//search families 
	public function search_families(){
		$this->data['title'] = 'Search a family | Nanny Share Australia';
		$this->data['profile'] = 'find_matches';
		
		$this->data['searchFamilyMatches'] = $this->input->post('search_families');
		

		$this->data['searchKilometers'] = $this->input->post('family_kilometers');
		$km = $this->data['searchKilometers'];
		
		$this->data['getMyDistance'] = $this->fm->getMyDistance($this->data['id']);
		$myDistance = $this->data['getMyDistance'];
		$myDDistance = $myDistance->distance;
		

		$this->data['Searches'] = $this->fm->searchFamiliesWithD($this->data['searchFamilyMatches'],$km);

	    if($this->data['Searches']==null)
	      $this->data['notFound'] = 'No results found';
		
	
		$this->template_lib->set_view('index_view', 'find_family_view', $this->data);
	
	}
  
  //find a family match view
  public function find_family(){
    $this->data['title'] = 'Find a family match | Nanny Share Australia';
    $this->data['profile'] = 'find_matches';
					
    $this->template_lib->set_view('index_view', 'find_family_view', $this->data);
  }
  
  public function index(){
    $this->data['title'] = 'Family Matches | Nanny Share Australia';      
    $this->data['profile'] = 'family_matches';

    
    $fams = $this->mu->getAllFamilyMatchesV1();
    $this->data['countFamilyMatches'] = count($fams);
    $this->data['countFamily'] = $this->data['countFamilyMatches'];
    $this->data['getFamilyMatches'] = $fams;
    
    if(!$fams){
    	$this->data['address'] = "No family matches found";
    }
    
 
    $this->template_lib->set_view('index_view', 'familymatches_view', $this->data);
  }
}


