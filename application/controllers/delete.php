<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delete extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('messages_model', 'mm');
    if(!$this->session->userdata('loggedIn')){
      redirect('profile');
    }
  }
  
  //delete my sent messages
  public function my_messages(){
    $id = $this->input->post('msgId');
    $this->mm->deleteSentMessages($id);
  }
  
  //send messages
  public function send_messages($id){
    $sessionData = $this->session->userdata('loggedIn');
    $this->data['id'] = $sessionData['id'];
    
    $this->data['getMySendMessages'] = $this->mm->getMySendMessages($id);
   
    $this->load->view('delete_sendmessages_view', $this->data);
  }
  
  public function msg(){
    $id =  $this->input->post('msgId');
    $this->mm->delete($id);
    
  }
  
  public function id($id){
    $sessionData = $this->session->userdata('loggedIn');
    $this->data['id'] = $sessionData['id'];
 
    $this->data['getMyMessage'] = $this->mm->getMyMessages($id);
    
    $this->load->view('delete_view', $this->data);
  }
 
}


