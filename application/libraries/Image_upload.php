<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_upload {  
  public function __construct() {
      $config['upload_path'] = 'assets/uploads/';
      // set the filter image types
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '9000';
      $config['encrypt_name']  = true;
      $this->CI =& get_instance();
      $this->CI->load->library('upload', $config);
      $this->CI->load->library('image_lib');
      
      $this->CI->upload->initialize($config);
      $this->CI->upload->set_allowed_types($config['allowed_types']);
      $data['upload_data'] = '';
   
  }
  
  public function do_upload(){  
    if(!$this->CI->upload->do_upload('photo')){
        $ids = $this->input->post('editData');
        if($_FILES['photo']['name'] == ""){      
            $ids = $this->input->post('editData');
            $year = $this->input->post('year');
            $month = $this->input->post('month');
            $day = $this->input->post('days');
            $dob = $year."-".$month."-" .$day;
            $update = array(
                'username'=>$this->input->post('username'),
                'first_name'=>$this->input->post('firstname'),
                'address'=>$this->input->post('address'),
                'date_of_birth'=>$dob,
                'suburb_postcode'=>$this->input->post('postcode'),
                'number_of_children_prepared_to_care_for'=>$this->input->post('number_of_children_prepared'),
                'ages_of_children_cared_of'=>$this->input->post('ages_of_children'),
                'start_date'=>$this->input->post('start_date'),
                'available_days_per_week'=>$this->input->post('days_per_week'),
                'expected_hourly_rate'=>$this->input->post('hourly_rate'),
                'have_abn'=>$this->input->post('have_abn'),
                'have_drivers_licence'=>$this->input->post('have_driverslicence'),
                'have_first_aid_certificate'=>$this->input->post('have_firstaid'),
                'registered_carrer'=>$this->input->post('registered_carrer'),
                'yr_exp_as_nanny'=>$this->input->post('nanny_exp'),
                'multiple_children_exp'=>$this->input->post('multiple_exp'),
                'other_skills'=>$this->input->post('other_skills'),
                'a_little_about_myself'=>$this->input->post('about_myself'),
                'make_profile'=>$this->input->post('visible')
              );
              $this->db->where('user_id', $this->input->post('editData'))->update('tbl_user', $update);
              $this->session->set_flashdata('success', 1);     
              redirect('profile/edit/id/'.$ids);
        }
        $data =  $this->CI->upload->display_errors();
        
        $error = $this->session->set_flashdata('error', 1); 
        redirect('profile/edit/id/'.$ids, $error);
        
      }else{ //else, set the success message        
        $data['upload_data'] = $this->CI->upload->data();

        $uploadSuccess = $data['upload_data'];
        
        $raw_name = $uploadSuccess['file_name'];
        
        
        
        $file_name = $raw_name;
        

        $image_path = 'assets/uploads/' .$file_name;
        $config['image_library'] = 'gd2';
        $config['source_image'] =  $image_path;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 150;
        $config['height'] = 110;
        $config['new_image'] = 'thumb_'.$file_name;
        
        $this->CI->image_lib->initialize($config);
        $this->CI->image_lib->resize();
        $this->CI->image_lib->clear();
              
        $image_path = 'assets/uploads/' .$file_name;
        $config['image_library'] = 'gd2';
        $config['source_image'] =  $image_path;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 450;
        $config['height'] = 450;
        $config['new_image'] = 'medium_size_'.$file_name;
        
        $this->CI->image_lib->initialize($config);
        $this->CI->image_lib->resize();
        $this->CI->image_lib->clear();
        
      
      }
            
  }

}

