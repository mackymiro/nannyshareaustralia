<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Messages extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('users_model', 'um');
    $this->load->model('messages_model', 'mm');
		$this->load->model('blogs_model', 'bm');
		$this->load->helper('text');
		$this->load->library('email');
    
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
    $this->data['getAllData'] = $this->um->getAllData();
		$this->data['countUsers'] = $this->um->countAllUsers();
		$sessionData = $this->session->userdata('loggedIn');
    $this->data['id'] = $sessionData['id'];
    $this->data['username'] = $sessionData['username'];
    $this->data['type'] = $sessionData['profile_type'];
		
    if(!$this->session->userdata('loggedIn')){
      redirect('profile');
    }
  }
  
  //view send messages
  public function view_send_messages(){
    $this->data['title'] = 'View send messages | Nanny Share Australia';
    $this->data['messagesIndex'] = $this->uri->segment(1);
    $this->data['profile'] = 'messages_index';
    
    $uri = $this->uri->segment(3);
    $this->data['getToMessages'] = $this->mm->getToMessages($uri);
    
    
    $this->template_lib->set_view('index_view', 'view_send_messages', $this->data);
  }
  
  //sent messages
  public function sent_messages(){
    $this->data['title'] = 'Sent messages | Nanny Share Australia';
    $this->data['messagesIndex'] = $this->uri->segment(1);
    $this->data['profile'] = 'messages_index';
    
    $this->data['getSendMessages'] = $this->mm->getSendMessages($this->data['id']);

     
    $this->template_lib->set_view('index_view', 'sentmessages_view', $this->data);
  }
  
  public function reply_message(){
    $user_id = $this->input->post('user_id');
    $senders_id = $this->input->post('senders_id');
    $messages = $this->input->post('message');
		
		$senders_email = $this->mm->getSendersEmail($senders_id);
		foreach($senders_email as $email){
			$sender_id = $email->email_address;
		}
		
		//notify to users email when received some messages
		$this->email->from('no-reply@nannyshareaustralia.com.au', 'Nanny Share Australia');
		$this->email->to($sender_id);
		$this->email->subject('You have a message | Nanny Share Australia');
		$this->email->message("
                       <!DOCTYPE html>
                            <html>
                            <head>
                            <title>Nanny Share Australia</title>
                            </head>
                            <body>
                            <div style='width:500px; >
                              <div style='width:500px;'>
                                <a href='http://www.nannyshareaustralia.com.au' target='_blank' rel='nofollow' >
                                  <img alt='nannyshare logo' src='http://www.nannyshareaustralia.com.au/assets/images/canvas.png' width='298' height='88' />
                                </a>                           
                              </div>
                              <div style='margin-left:40px; margin-top:80px;'>
                                <p style='font-size:13px; font-weight:bold'>
                                   Hello! you have a message. Please login to read your message below.<br />
                                  <a href= http://www.nannyshareaustralia.com.au/messages target='_blank' rel='nofollow' >
                                    http://www.nannyshareaustralia.com.au/messages
                                  </a>  
                                </p>
                                <br />
                                <p style='font-size:13px; font-weight:bold'>
                                  Nanny Share Australia Team
                                </p>
                              </div>
                            </div>
                            </body>
                            </html>
                        ");
		$this->email->send();
		
    $array = array(
            'user_id'=>$user_id,
            'senders_id'=>$senders_id,
            'message'=>$messages
            );
    $this->mm->saveMsgs($array);
    
     //save to send messages table
    $saveMessages = array(
                    'user_id'=>$user_id,
                    'senders_id'=>$senders_id,
                    'message'=>$messages
                    );
		$this->mm->saveSendMsgs($saveMessages);
		
	}
  
  public function read(){
    $this->data['title'] = 'Messages | Nanny Share Australia';
    $this->data['messagesIndex'] = $this->uri->segment(1);
    $this->data['profile'] = 'messages_index';
    
     
    $id = $this->uri->segment(4);
   
    $this->data['getMyMessage'] = $this->mm->getMyMessages($id);
		
    $flag = 1;
    $update_flag = array(
                  'flag'=>$flag
                  );
    $this->db->where('msg_id', $id)->update('tbl_msgs', $update_flag);
    
    $this->template_lib->set_view('index_view', 'messagesInbox_view', $this->data);
  }
  
  public function send_message(){
    $user_id = $this->data['id'];
    $msg = $this->input->post('messages');
    $sender_id = $this->input->post('sender_id'); 
		
		$senders_email = $this->mm->getSendersEmail($sender_id);
		foreach($senders_email as $email){
			$senders_id = $email->email_address;
		}
		
		//notify to users email when received some messages
		$this->email->from('info@nannyshareaustralia.com.au', 'Nanny Share Australia');
		$this->email->to($senders_id);
		$this->email->subject('You have a message | Nanny Share Australia');
		$this->email->message("
                       <!DOCTYPE html>
                            <html>
                            <head>
                            <title>Nanny Share Australia</title>
                            </head>
                            <body>
                            <div style='width:500px; >
                              <div style='width:500px;'>
                                <a href='http://www.nannyshareaustralia.com.au' target='_blank' rel='nofollow' >
                                  <img alt='nannyshare logo' src='http://www.nannyshareaustralia.com.au/assets/images/canvas.png' width='298' height='88' />
                                </a>                           
                              </div>
                              <div style='margin-left:40px; margin-top:80px;'>
                                <p style='font-size:13px; font-weight:bold'>
                                   Hello! you have a message. Please login to read your message below.<br />
                                  <a href= http://www.nannyshareaustralia.com.au/messages target='_blank' rel='nofollow' >
                                    http://www.nannyshareaustralia.com.au/messages
                                  </a>  
                                </p>
                                <br />
                                <p style='font-size:13px; font-weight:bold'>
                                  Nanny Share Australia Team
                                </p>
                              </div>
                            </div>
                            </body>
                            </html>
                        ");
		$this->email->send();
		
		$flag = 0;
    $array = array(
          'message'=>$msg,
          'user_id'=>$user_id,
          'senders_id'=>$sender_id,
          'flag'=>$flag
          );
    $this->mm->saveMsgs($array);
    
    //save to send messages table
    $saveMessages = array(
                    'user_id'=>$user_id,
                    'senders_id'=>$sender_id,
                    'message'=>$msg
                    );
		$this->mm->saveSendMsgs($saveMessages);
    
  }
  
  public function id($id){
    $this->data['title'] = 'Send A Message | Nanny Share Australia';
    $this->data['messages'] = $this->uri->segment(3);
    $this->data['profile'] = 'messages_view';
    
    $this->data['query'] = $this->um->getData($this->data['messages']);
    
    $this->template_lib->set_view('index_view', 'messages_view', $this->data);
  }
  
  public function index(){
    $this->data['title'] = 'Messages | Nanny Share Australia';
    $this->data['messagesIndex'] = $this->uri->segment(1);
    $this->data['profile'] = 'messages_index';

    
    $this->data['mesaageInbox'] = $this->mm->getMessages($this->data['id']);
    
    $this->template_lib->set_view('index_view', 'messagesindex_view', $this->data);
  }
}


