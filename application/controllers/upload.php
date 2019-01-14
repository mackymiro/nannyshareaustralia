<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
   
    
		$config['upload_path'] = 'assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = '1090';
		$config['max_height']  = '1094';

		$this->load->library('upload', $config);

		if ($this->upload->do_upload())
		{
      $this->upload->data();
		}
	
  }
  
}
?>