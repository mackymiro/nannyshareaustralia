<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_job_listing extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
    $this->load->model('job_model', 'jm');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
		
    if(!$this->session->userdata('loggedIn')){
      redirect('login');
    }
		
		if($this->session->userdata('loggedInBlog')){
      redirect('admin');
    }
  }
  
  public function check_flexiblewithdays(){
    if($this->input->post('flexible_with_days') === '0'){
      $this->form_validation->set_message('check_flexiblewithdays', 'Please select flexible with days');
      return false;
    }else{
      return true;
    }
  }
  
  public function check_daysofweek(){
    if($this->input->post('days_of_week') === '0'){
      $this->form_validation->set_message('check_daysofweek', 'Please select days of week');
      return false;
    }else{
      return true;
    }
  }
  
  public function check_ageofchildren(){
    if($this->input->post('age_of_children') === '0'){
      $this->form_validation->set_message('check_ageofchildren', 'Please select age of children');
      return false;
    }else{
      return true;
    }
  }
  
  public function check_numberofchildren(){
    if($this->input->post('number_of_children') === '0'){
      $this->form_validation->set_message('check_numberofchildren', 'Please select number of children');
      return false;
    }else{
      return true;
    }
  }
  
  public function check_typeofjob(){
    if($this->input->post('type_of_job') === '0'){
      $this->form_validation->set_message('check_typeofjob', 'Please select type of job');
      return false;
    }else{
      return true;
    }
  }
  
  public function add(){
    $this->form_validation->set_rules('postcode', 'Postcode', 'required');
    $this->form_validation->set_rules('suburb', 'Suburb', 'required');
    $this->form_validation->set_rules('type_of_job', '...', 'required|callback_check_typeofjob');
    $this->form_validation->set_rules('rate_per_hour', 'Rate per hour', 'required');
    $this->form_validation->set_rules('number_of_children', '...', 'required|callback_check_numberofchildren');
    $this->form_validation->set_rules('age_of_children', '...', 'required|callback_check_ageofchildren');
    $this->form_validation->set_rules('days_of_week', '...', 'required|callback_check_daysofweek');
    $this->form_validation->set_rules('flexible_with_days', '...', 'required|callback_check_flexiblewithdays');
    $this->form_validation->set_rules('about_us', 'A little bit about us', 'required');
    $this->form_validation->set_rules('terms', 'Terms and Conditions ', 'required');
    if($this->form_validation->run() == FALSE){
      $this->index();
    }else{
      $sessionData = $this->session->userdata('loggedIn');
      $this->data['id'] = $sessionData['id'];
      $user_id = $this->data['id'];
      $array = array(
              'user_id'=>$user_id,
              'postcode'=>$this->input->post('postcode'),
              'suburb'=>$this->input->post('suburb'),
              'type_of_job'=>$this->input->post('type_of_job'),
              'rate_per_hour'=>$this->input->post('rate_per_hour'),
              'number_of_children'=>$this->input->post('number_of_children'),
              'age_of_children'=>$this->input->post('age_of_children'),
              'days_of_week_required'=>$this->input->post('days_of_week'),
              'flexible_with_days'=>$this->input->post('flexible_with_days'),
              'a_little_bit_about_us'=>$this->input->post('about_us')
            );
      $this->jm->saveJob($array);
      $this->session->set_flashdata('success', 1);
      redirect('create-job-listing');
    }
    
  }
  
  public function index(){
    $this->data['title'] = 'Create Job Listing | Nanny Share Australia';
    $this->data['create_job_listing'] = $this->uri->segment(1);
    $this->data['profile'] = 'profile';
    $this->data['getAllData'] = $this->um->getAllData();
		$this->data['countUsers'] = $this->um->countAllUsers();
    $sessionData = $this->session->userdata('loggedIn');
    $this->data['id'] = $sessionData['id'];
    
    //count all the family member if users registered for free redirect to payment form
    $this->data['paidMember'] = $this->um->getAllFamilyProfileAndPaidMember($this->data['id']);
    $paidMember = $this->data['paidMember'];
    
    foreach($paidMember as $member){
      $userMember = $member->paid_member;
    }
    
    if($userMember == 0){ 
      redirect(base_url().'payment/create-job-listing');
    }
    
    $this->template_lib->set_view('index_view', 'createjoblisting_view', $this->data);
  }
}


