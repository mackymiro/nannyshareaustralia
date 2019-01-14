<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Q_a extends CI_Controller {
   public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
    $this->load->library('email');
		$this->load->helper('download');
    if($this->session->userdata('loggedIn')){
      redirect('profile');
    }
  }
	
	public function download_pdf(){
		$data = file_get_contents("assets/nanny share contract.pdf"); // Read the file's contents
		$name = 'nanny share contract.pdf';

		force_download($name, $data); 
	}
  
  public function send_questions(){
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('questions', 'Questions', 'required');
    if($this->form_validation->run() == FALSE){
      $this->index();
    }else{
      $name = $this->input->post('name');
      $email = $this->input->post('email');
      $questions = $this->input->post('questions');
      
      $this->email->from('info@nannyshareaustralia.com.au', 'Nanny Share Australia');
      $this->email->to($email);
      $this->email->subject('Q and A questions | Nanny Share Australia');
      $this->email->message("
                <!DOCTYPE html>
                <html>
                <head>
                <title>Nanny Share Australia</title>
                </head>
                <body>
                <div style='width:500px; >
                  <div style='width:500px;'>
                    <a href='http://www.magentocebu.com/client.nannyshareaustralia' target='_blank' rel='nofollow' >
                      <img alt='nannyshare logo' src='http://www.magentocebu.com/client.nannyshareaustralia/assets/images/canvas.png' width='298' height='88' />
                    </a>
                  
                  </div>
                  <div style='margin-left:40px; margin-top:80px;'>
                    <p style='font-size:18px; font-weight:bold'>
                        Thank you for your questions!<br />
                        We will feedback you within 48 hours.
                    </p>
                    <br />
                    <br />
                    <br />
                    <p style='font-size:18px; font-weight:bold'>
                      Nanny Share Australia Team
                    </p>
                  </div>
                </div>
                </body>
                </html>
                ");
      $this->email->send();
      
      $this->email->from('info@nannyshareaustralia.com.au', $email);
      $list = array('info@nannyshareaustralia.com.au');
      $this->email->to($list);
      $this->email->subject('Q and A questions | Nanny Share Australia');
      $this->email->message("
                <!DOCTYPE html>
                <html>
                <head>
                <title>Nanny Share Australia</title>
                </head>
                <body>
                <div style='width:500px; >
                  <div style='width:500px;'>
                    <a href='http://www.magentocebu.com/client.nannyshareaustralia' target='_blank' rel='nofollow' >
                      <img alt='nannyshare logo' src='http://www.magentocebu.com/client.nannyshareaustralia/assets/images/canvas.png' width='298' height='88' />
                    </a>
                  
                  </div>
                  <div style='margin-left:40px; margin-top:80px;'>
                  <p style='font-family:arial; font-size:13px;'><strong>Name :</strong>".$name." </p> 
                  <p style='font-family:arial; font-size:13px;'><strong>Email :</strong>".$email." </p> 
                  <p style='font-family:arial; font-size:13px;'><strong>Questions :</strong>".$questions." </p> 
                  </div>
                </div>
                </body>
                </html>
                ");
      $this->email->send();
      $this->session->set_flashdata('send', 1);
      redirect('q-a');
      
    }
  }
  
	public function index(){
        $this->data['title'] = 'Q&A | Nanny Share Australia';
        $this->data['menu'] = 'q_a';
        //session destroy the profile 
        $this->session->unset_userdata('urlLink');
        
        $this->data['getAllData'] = $this->um->getAllData();
        $this->data['countUsers'] = $this->um->countAllUsers();
        $this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
        
        $this->template_lib->set_view('index_view', 'qa_view', $this->data);
	}
}

