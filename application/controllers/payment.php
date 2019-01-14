<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
error_reporting(0);
class Payment extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('users_model', 'um');
        $this->load->model('payment_model', 'pm');
        $this->load->model('geocode_model', 'gm');
        $this->load->model('blogs_model', 'bm');
        $this->load->model('data_model', 'dm');
        $this->load->helper('text');
        $this->data['getBlogPosts'] = $this->bm->getAllBlogPostsLimit();
        $this->data['countUsers'] = $this->um->countAllUsers();
            
        $this->load->library('merchant');
        $this->merchant->load('paypal_express');
    }
  
  //return_details page for the family profile page 
  public function return_details_success(){
    $this->data['title'] = 'Success Payment | Nanny Share Australia';
    $this->data['paymentSuccess'] = $this->uri->segment(2);
    $this->data['profile'] = 'profile';
    $this->data['getAllData'] = $this->um->getAllData();
    
    $received_data = print_r($this->input->post(),TRUE);
    
    $uriData = $this->uri->segment(4);
    
    $this->data['getFamilyInformation'] = $this->um->getFamilyInformation($uriData);
    
    $paidMember = 1;
    $status = 2;
    $update = array(
            'paid_member'=>$paidMember,
            'status'=>$status
            );
    $this->db->where('user_id', $this->data['getFamilyInformation']->user_id)->update('tbl_user', $update);
    
    $amount = $this->input->post('mc_gross');
    $firstname = $this->input->post('first_name');
    $lastname = $this->input->post('last_name');
    $payer_email = $this->input->post('payer_email');
    $receiver_email = $this->input->post('receiver_email');
     
    //saves the information in the datbase from the paypal data
    $array = array(
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'amount'=>$amount,
            'payer_email'=>$payer_email,
            'receiver_email'=>$receiver_email
          );
    $this->pm->savePaymentData($array);
    
 
     //update the paid_member field to 1 if users already paid to paypal
    $this->data['user'] = $this->pm->getLatestUser();
    $id = $this->data['user'];
    $user_id = $id->user_id;

    
    $paid_member = 1;
    $status = 2;
    $update = array(
            'paid_member'=>$paid_member,
            'status'=>$status
            );
    $this->db->where('user_id' ,$user_id)->update('tbl_user', $update);
    
    
    $this->template_lib->set_view('index_view', 'payment_family_success_view', $this->data);
  }
  
  //return_details page for the create job listing page 
  public function return_details(){
    $this->data['title'] = 'Success Payment | Nanny Share Australia';
    
    $received_data = print_r($this->input->post(),TRUE); 
    
    $amount = $this->input->post('mc_gross');
    $firstname = $this->input->post('first_name');
    $lastname = $this->input->post('last_name');
    $payer_email = $this->input->post('payer_email');
    $receiver_email = $this->input->post('receiver_email');
    
    $this->data['paymentSuccess'] = $this->uri->segment(2);
    $this->data['profile'] = 'profile';
    $this->data['getAllData'] = $this->um->getAllData();
 
    $sessionData = $this->session->userdata('loggedIn');
    $this->data['id'] = $sessionData['id'];
    $user_id = $this->data['id'];
    
    //saves the information in the datbase from the paypal data
    $array = array(
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'amount'=>$amount,
            'payer_email'=>$payer_email,
            'receiver_email'=>$receiver_email
          );
    $this->pm->savePaymentData($array);
    
    //update the paid_member field to 1 if users already paid to paypal
    $paid_member = 1;
    $status = 2;
    $update = array(
            'paid_member'=>$paid_member,
            'status'=>$status
            );
    $this->db->where('user_id', $user_id )->update('tbl_user', $update);
    
    $this->template_lib->set_view('index_view', 'payment_success_view', $this->data);

  }
  
  public function proceed_payment_data(){
    $accountType = 2;
    $password = $this->input->post('password');
    $password_sha1 = sha1($password);
    $conf_password = $this->input->post('conf_password');
    $conf_pass_sha1 = sha1($conf_password);
    
    //get the lattitude and longitude from the input address textbox
    $address = urlencode($this->input->post('address'));
    $urlx = "http://maps.google.com/maps/api/geocode/json?address={$address}&sensor=false";
    $ch = curl_init($urlx);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    $obj = json_decode($data);
    $lattitude = $obj->results[0]->geometry->location->lat;
    $longitde = $obj->results[0]->geometry->location->lng;
     
  
    $array = array(
            'username'=>$this->input->post('username'),
            'first_name'=>$this->input->post('firstname'),
            'last_name'=>$this->input->post('lastname'),
            'address'=>$this->input->post('address'),
            'email_address'=>$this->input->post('email'),
            'password'=>$password_sha1,
            'v_password'=>$conf_pass_sha1,
            'account_type'=>$accountType
            );
    $this->um->saveData($array);
   
     //saves the lattitude and longitude of the users input address
    $this->data['user'] = $this->gm->getLatestUser();
    $id = $this->data['user'];
    $user_id = $id->user_id;   

    $saveLat = array(
              'user_id'=>$user_id,
              'lattitude'=>$lattitude,
              'longitude'=>$longitde              
            );
    $this->gm->saveLocation($saveLat);
   
    $totPrice = 29.00;
    
    $config['business'] = 'sales@nannyshareaustralia.com.au';
    //$config['business'] = 'macky_nyxz86-facilitator@yahoo.com';
    $config['return'] = 'http://www.nannyshareaustralia.com.au/payment/return_details_success/';
    $config['cancel_return'] = 'http://www.nannyshareaustralia.com.au/register/';
    $config['production'] = TRUE; //Its false by default and will use sandbox
           
    $this->load->library('paypal',$config);
    
    //amount to be paid here is $49.00AUD to join after 100 members.
    $this->paypal->add('Amount', $totPrice); 
    $this->paypal->pay();
    
  }
  
  //proceed payment from the create family profile 
  public function proceed_data(){
    $accountType = 2;
    $uid = $this->input->post('uId');
    
    $this->data['getFamilyInformation'] = $this->um->getFamilyInformation($uid);
    
    $familyData = $this->data['getFamilyInformation']->user_id; 
    
    $totPrice = 29.00;
    
    $config['business'] = 'sales@nannyshareaustralia.com.au';
    //$config['business'] = 'macky_nyxz86-facilitator@yahoo.com';
    $config['return'] = 'http://www.nannyshareaustralia.com.au/payment/return_details_success/id/'.$familyData;
    $config['cancel_return'] = 'http://www.nannyshareaustralia.com.au/payment/id/'.$familyData;
    $config['production'] = TRUE; //Its false by default and will use sandbox
           
    $this->load->library('paypal',$config);
    
    //amount to be paid here is $49.00 to join after 100 members.
    $this->paypal->add('Amount', $totPrice); 
    $this->paypal->pay();
    
  }
  
  //proceed payment from the create job listing 
  public function proceed(){ 
      $totPrice = 29.00;

      //$config['business'] = 'macky_nyxz86-facilitator@yahoo.com';
      $config['business'] = 'sales@nannyshareaustralia.com.au';
      $config['return'] = 'http://www.nannyshareaustralia.com.au/payment/return_details/';
      $config['cancel_return'] = 'http://www.nannyshareaustralia.com.au/payment/create-job-listing/';
      $config['production'] = TRUE; //Its false by default and will use sandbox
             
      $this->load->library('paypal',$config);

      $this->paypal->add('Amount', $totPrice); 
      $this->paypal->pay();
  }
  
  public function create_job_listing(){
    $this->data['title'] = 'Payment for create job listings | Nanny Share Australia';
    $this->data['profile'] = 'profile';
      
    $this->data['payment_job_listing'] = $this->uri->segment(1);
    $this->data['getAllData'] = $this->um->getAllData();
    
    $sessionData = $this->session->userdata('loggedIn');
    $this->data['id'] = $sessionData['id'];
    $id = $this->data['id'];
    $this->data['query'] = $this->um->getUsersProfile($id);

    $this->template_lib->set_view('index_view', 'payment_view', $this->data);
  }
  
  public function family_profile(){
    $this->data['title'] = 'Payment | Nanny Share Australia';
    $this->data['payment'] = $this->uri->segment(1);
    $this->data['getAllData'] = $this->um->getAllData();
    
    
    $this->template_lib->set_view('index_view', 'payment_family_registration_view', $this->data);
    
  }
  
    public function id(){
        if($this->session->userdata('loggedIn')){
          redirect('profile');
        }
        
        $this->data['title'] = 'Payment | Nanny Share Australia';
        $this->data['payment'] = $this->uri->segment(1);
        $this->data['getAllData'] = $this->um->getAllData();
            $this->data['countUsers'] = $this->um->countAllUsers();
        
        $uri = $this->uri->segment(3);
        //get family information
        $this->data['getFamilyInformation'] = $this->um->getFamilyInformation($uri);
        
        //getAge of girls
        $this->data['getAgeOfGirls'] = $this->dm->getAge();   
        
        //getAge of boys
        $this->data['getAgeOfBoys'] = $this->dm->getAge();
        
        //getDaysPerWeekCheckbox
        $this->data['getDaysPerWeeks'] = $this->dm->getDaysPerWeekCheckbox();
        
        $this->template_lib->set_view('index_view', 'payment_family_view', $this->data);
	}
}

