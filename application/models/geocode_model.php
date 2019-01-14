<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Geocode_model extends CI_Model {
  public function getLatestUser(){
    return $this->db->select(
                     'tu.user_id
                    '
                    )
              ->from('tbl_user tu')
              ->order_by('tu.user_id', 'desc') 
              ->limit(1)
              ->get()->row_object();
    $this->db->get('tbl_user');
  }

  //saves the lattitude and longitude of the users input address
  public function saveLocation($data){
    $this->db->insert('tbl_geocoding', $data);
  } 
  
}
