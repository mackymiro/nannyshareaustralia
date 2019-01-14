<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_model extends CI_Model {
  public function getAllJobListing(){
     $this->db->select('
                  tbl_createjoblistings.id
                  ')
              ->from('tbl_createjoblistings'); 
     return $this->db->count_all_results();
  }
  
  public function getCreateJobListings(){
    return $this->db->select(
                    'tu.user_id,
                     tu.first_name,
                     tu.last_name,
                     tc.postcode,
                     tc.suburb,
                     tc.type_of_job,
                     tc.rate_per_hour,
                     tc.number_of_children,
                     tc.age_of_children,
                     tc.days_of_week_required,
                     tc.flexible_with_days,
                     tc.a_little_bit_about_us
                     '
                  )
              ->from('tbl_user tu')
              ->join('tbl_createjoblistings tc', 'tu.user_id=tc.user_id')
              ->order_by('id', 'DESC')
              ->get()->result_object();
              
  }

  //saves to tbl_createjoblistings table
  public function saveJob($data){
    $this->db->insert('tbl_createjoblistings', $data);
  }
  
}
