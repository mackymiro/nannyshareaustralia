<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Admin extends CI_Controller {
   public function __construct(){
    parent::__construct();
     $config['upload_path'] = 'assets/uploads/blogs/';
    // set the filter image types
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = '9000';
    $config['encrypt_name']  = TRUE;

    $this->load->library('upload', $config);
    
    $this->upload->initialize($config);
    $this->upload->set_allowed_types($config['allowed_types']);
    $data['upload_data'] = '';
    
    $this->load->model('users_model', 'um');
    $this->load->model('login_model', 'lm');
    $this->load->model('blogs_model', 'bm');
		$this->load->model('data_model', 'dm');
		$this->load->helper('text');
		
		$this->load->helper('ckeditor');
		
			//Ckeditor's configuration
		$this->data['ckeditor'] = array(
		
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'js/ckeditor',
		
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"550px",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
					
			),
		
			//Replacing styles from the "Styles tool"
			'styles' => array(
			
				//Creating a new style named "style 1"
				'style 1' => array (
					'name' 		=> 	'Blue Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Blue',
						'font-weight' 		=> 	'bold'
					)
				),
				
				//Creating a new style named "style 2"
				'style 2' => array (
					'name' 		=> 	'Red Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Red',
						'font-weight' 		=> 	'bold',
						'text-decoration'	=> 	'underline'
					)
				)				
			)
		);
		
		$this->data['ckeditor_2'] = array(
		
			//ID of the textarea that will be replaced
			'id' 	=> 	'content_2',
			'path'	=>	'js/ckeditor',
		
			//Optionnal values
			'config' => array(
				'width' 	=> 	"550px",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
				'toolbar' 	=> 	array(		//Setting a custom toolbar
					array('Bold', 'Italic'),
					array('Underline', 'Strike', 'FontSize'),
					array('Smiley'),
					'/'
				)
			),
		
			//Replacing styles from the "Styles tool"
			'styles' => array(
			
				//Creating a new style named "style 1"
				'style 3' => array (
					'name' 		=> 	'Green Title',
					'element' 	=> 	'h3',
					'styles' => array(
						'color' 			=> 	'Green',
						'font-weight' 		=> 	'bold'
					)
				)
								
			)
		);
		
    if($this->session->userdata('loggedIn')){
      redirect('profile');
    }
		
		if(!$this->session->userdata('loggedInBlog')){
      redirect('blog/admin');
    }

  }
	
	//reactivate users account
	public function reactivate(){
		$id = $this->uri->segment(4);
		$reactivate = 0;
		$update = array(
						'reactivate_deactivate'=>$reactivate
						);
		$this->db->where('user_id', $id)->update('tbl_user', $update);
		redirect('admin/view-all-registered-users/');
	}
	
	// deactivate users account
	public function deactivate(){
		$id = $this->uri->segment(4);
		$deactivate = 1;
    $update = array(
						'reactivate_deactivate'=>$deactivate
						);		
		$this->db->where('user_id', $id)->update('tbl_user', $update);
		redirect('admin/view-all-registered-users/');
	}
	
	//view all registered users profile
	public function view_users(){
		$this->data['title'] = 'View users | Nanny Share Australia';
		$id = $this->uri->segment(4);
		$this->data['blogpost'] = 'view_all_registered_users';
		$this->data['query'] = $this->um->getUsersProfile($id);

		
		$this->data['daysPerWeekCheckboxes'] = $this->dm->getDaysPerWeekCheckbox();
		$this->data['agesOfBoysAndGirls'] = $this->dm->getAge();
		$this->data['agesOfChildrenCheckboxes'] = $this->dm->getAgesOfChildrenCaredOfCheckboxes();
		
		$this->load->view('header_blogs/header', $this->data);
		$this->load->view('view_users', $this->data);
		$this->load->view('footer_blogs/footer');
	}
	
	
	//view all registered users
	public function view_all_registered_users(){
		$this->data['title'] = 'View all registered users | Nanny Share Australia';
		$this->data['blogpost'] = 'view_all_registered_users';
		$this->data['queries'] = $this->um->getAllRegisteredUsers();
		
		$this->load->view('header_blogs/header', $this->data);
		$this->load->view('view_all_registered_users_view', $this->data);
		$this->load->view('footer_blogs/footer');
	}
	
	//delete blog 
	public function delete_blog(){
		$id = $this->input->post('blogId');
		$this->bm->deleteId($id);
	}
	
	//prompt delete blog
	public function delete($id){
		$id = $this->uri->segment(4);
		$this->data['getBlogs'] = $this->bm->getBlogsToBeDeleted($id);

		$this->load->view('delete_blog_view', $this->data);
	}
	
	//update blog
	public function update(){
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		if($this->form_validation->run() == FALSE){
			$this->data['title'] = 'Edit Blog | Nanny Share Australia';
			$this->data['blogpost'] = 'view_posts_blogs';
			$id = $this->input->post('editData');
			
			$this->data['query'] = $this->bm->getBlogId($id);
			
			$this->load->view('header_blogs/header', $this->data);
			$this->load->view('edit_posts_blogs', $this->data);
			$this->load->view('footer_blogs/footer');
		}else{
			$id = $this->input->post('editData');
			if(!$this->upload->do_upload('photo')){
				if($_FILES['photo']['name'] == ""){
						$id = $this->input->post('editData');
						$slug = url_title($this->input->post('title'), 'dash', TRUE);
						$update = array(
										'title'=>$this->input->post('title'),
										'content'=>$this->input->post('content'),
										'slug'=>$slug,
										'date'=>$this->input->post('date'),
										);
						$this->db->where('id', $id)->update('tbl_blogs', $update);
						$this->session->set_flashdata('successUpdate', 1);   
						redirect('admin/edit/id/'.$id);
				}
				 $this->session->set_flashdata('error', 1); 
				 redirect('admin');
				
			}else{
						$data['upload_data'] = $this->upload->data();
            $uploadSuccess = $data['upload_data'];
            $raw_name = $uploadSuccess['file_name'];
            
            $this->load->library('image_lib');
            $file_name = $raw_name;
            
            $image_path = 'assets/uploads/blogs/' .$file_name;
            $config['image_library'] = 'gd2';
            $config['source_image'] =  $image_path;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] = 150;
            $config['new_image'] = 'thumb_'.$file_name;
            
             $this->image_lib->initialize($config);
             $this->image_lib->resize();
             $this->image_lib->clear();
             
            $image_path = 'assets/uploads/blogs/' .$file_name;
            $config['image_library'] = 'gd2';
            $config['source_image'] =  $image_path;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 500;
            $config['height'] = 500;
            $config['new_image'] = 'medium_size_'.$file_name;
            
						$this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            $slug = url_title($this->input->post('title'), 'dash', TRUE);
						
						$update = array(
               'title'=>$this->input->post('title'),
               'image'=>$uploadSuccess['file_name'],
               'content'=>$this->input->post('content'),
							 'slug'=>$slug,
               'date'=>$this->input->post('date')
              );
						$this->db->where('id', $id)->update('tbl_blogs', $update);
						$this->session->set_flashdata('successUpdate', 1);   
						redirect('admin/edit/id/'.$id);						
			}
		
		}
		
	
	}
	
	public function view(){
		$this->data['title'] = 'VIew Blog | Nanny Share Australia';
		$this->data['blogpost'] = 'view_posts_blogs';
		$id = $this->uri->segment(4);
		
		$this->data['getBlogViews'] = $this->bm->getBlogView($id);

		
		$this->load->view('header_blogs/header', $this->data);
    $this->load->view('view_blogs', $this->data);
		$this->load->view('footer_blogs/footer');
	}
	
	//edit blog
	public function edit(){
		$this->data['title'] = 'Edit Blog | Nanny Share Australia';
		$this->data['blogpost'] = 'view_posts_blogs';
		$id = $this->uri->segment(4);
		
		$this->data['query'] = $this->bm->getBlogId($id);
		
		$this->load->view('header_blogs/header', $this->data);
    $this->load->view('edit_posts_blogs', $this->data);
		$this->load->view('footer_blogs/footer');
	}

	//view posts blogs
	public function view_posts_blogs(){
		$this->data['title'] = 'View Posts Blogs | Nanny Share Australia';
		$this->data['blogpost'] = 'view_posts_blogs';
		$this->data['getBlogPosts'] = $this->bm->getAllBlogPosts();
		
		$this->load->view('header_blogs/header', $this->data);
    $this->load->view('view_posts_blogs', $this->data);
		$this->load->view('footer_blogs/footer');
	}
	
	
  public function add(){
    $this->form_validation->set_rules('date', 'Date', 'required');
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('content', 'Content', 'required');
    if($this->form_validation->run() == FALSE){
      $this->index();
    }else{
        if(!$this->upload->do_upload('photo')){
          if($_FILES['photo']['name'] == ""){
							$slug = url_title($this->input->post('title'), 'dash', TRUE);
              $array = array(
               'title'=>$this->input->post('title'),
               'content'=>$this->input->post('content'),
							 'slug'=>$slug,
               'date'=>$this->input->post('date')
              );
            $this->bm->saveBlogs($array);
            $this->session->set_flashdata('success', 1);
            redirect('admin');
          }
           $this->session->set_flashdata('error', 1); 
           redirect('admin');
        }else{
            $data['upload_data'] = $this->upload->data();
            $uploadSuccess = $data['upload_data'];
            $raw_name = $uploadSuccess['file_name'];
            
            $this->load->library('image_lib');
            $file_name = $raw_name;
            
            $image_path = 'assets/uploads/blogs/' .$file_name;
            $config['image_library'] = 'gd2';
            $config['source_image'] =  $image_path;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] = 150;
            $config['new_image'] = 'thumb_'.$file_name;
            
             $this->image_lib->initialize($config);
             $this->image_lib->resize();
             $this->image_lib->clear();
             
            $image_path = 'assets/uploads/blogs/' .$file_name;
            $config['image_library'] = 'gd2';
            $config['source_image'] =  $image_path;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 500;
            $config['height'] = 500;
            $config['new_image'] = 'medium_size_'.$file_name;
            
						$this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            $slug = url_title($this->input->post('title'), 'dash', TRUE);
						
             $array = array(
               'title'=>$this->input->post('title'),
               'image'=>$uploadSuccess['file_name'],
               'content'=>$this->input->post('content'),
							 'slug'=>$slug,
               'date'=>$this->input->post('date')
              );
            $this->bm->saveBlogs($array);
            $this->session->set_flashdata('success', 1);
            redirect('admin');   
        }
            
    }
  }
    
  
	public function index(){	
    $this->data['title'] = 'Admin | Nanny Share Australia';
		$this->data['blogpost'] = 'blogpost';
		
		$this->load->view('header_blogs/header', $this->data);
    $this->load->view('admin_posts_view', $this->data);
		$this->load->view('footer_blogs/footer');

	}
	

}

