<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
      //loggedout in blog
      public function blog(){
        $this->session->unset_userdata('urlLink');
        $this->session->unset_userdata('loggedInBlog');  
        redirect('blog/admin');
      }
      
    public function index(){
        $this->session->unset_userdata('urlLink');
        $this->session->unset_userdata('loggedIn');  
        redirect('login');
    }
}


