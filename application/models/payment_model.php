<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends CI_Model {
  
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
  
  public function savePaymentData($data){
    $this->db->insert('tbl_userpayment', $data);
  }
  
}
