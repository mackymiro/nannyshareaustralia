<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Nanny_matches extends CI_Controller {
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
	
	//search mummy nanny 
	public function search_mummy_nanny_matches(){
		$this->data['title'] = 'Search for mummy nanny | Nanny Share Australia';
		$this->data['profile'] = 'find_matches';
		
		$this->data['searchMummyNannyMatches'] = $this->input->post('search_mummy');
		$this->data['searchKilometers'] = $this->input->post('mummy_kilometers');
		$km = $this->data['searchKilometers'];
		$distance = '';
    $distance1 = '';
		$this->data['Searches'] = $this->fm->searchMummyNannyWithD($this->data['searchMummyNannyMatches'],$this->data['searchKilometers']);
    if($this->data['Searches']==null)
      $this->data['notFound'] = 'No results found';

		
       
    $this->template_lib->set_view('index_view', 'find_mummynanny_view', $this->data);
	}
	
	//find mummy nanny
	public function find_mummy_nanny(){
		$this->data['title'] = 'Search for mummy nanny | Nanny Share Australia';
		$this->data['profile'] = 'find_matches';
		
		$this->template_lib->set_view('index_view', 'find_mummynanny_view', $this->data);
	}
	
	//search nanny matches 
	public function search_nanny_matches(){
		$this->data['title'] = 'Search for nanny | Nanny Share Australia';
		$this->data['profile'] = 'find_matches';
		
		$this->data['searchNannyMatches'] = $this->input->post('search_nannies');
		$this->data['searchKilometers'] = $this->input->post('nanny_kilometers');
		$km = $this->data['searchKilometers'];
		$distance = '';
    $distance1 = '';

    $this->data['Searches'] = $this->fm->searchSharedNannyWithD($this->data['searchNannyMatches'],$this->data['searchKilometers']);
    if($this->data['Searches']==null)
      $this->data['notFound'] = 'No results found';

   
		$this->template_lib->set_view('index_view', 'find_sharednanny_view', $this->data);
	}
  
  //find a shared nanny match 
  public function find_shared_nanny(){
    $this->data['title'] = 'Find a shared nanny | Nanny Share Australia';
    $this->data['profile'] = 'find_matches';
       
    $this->template_lib->set_view('index_view', 'find_sharednanny_view', $this->data);
    
  }
  
  public function index(){
    $this->data['title'] = 'Nanny Matches | Nanny Share Australia';      
    $this->data['profile'] = 'nanny_matches';
       
    $nans = $this->mu->getAllNannyMatchesV1(1,1,1);
    $this->data['countNannyMatches'] = count($nans);
    $this->data['countNanny'] = $this->data['countNannyMatches'];
    $this->data['getNannyMatches'] = $nans;
    
    if(!$nans){
      $this->data['address'] = "No family matches found";
    }
 
  
    $this->template_lib->set_view('index_view', 'nannymatches_view', $this->data);
  }
}


