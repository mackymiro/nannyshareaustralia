<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * User library for the Model..all commonly used functions should be placed here
 * @author: magento cebu
 * @created: 09/08/14
 */
class Login_model extends CI_Model{
  //login to blogs
  public function loginBlog($username, $password){
    $this->db->select('
                tbl_blog_admin.id,
                tbl_blog_admin.username,
                tbl_blog_admin.password,
              ')
            ->from('tbl_blog_admin')
            ->where('tbl_blog_admin.username', $username)
            ->where('tbl_blog_admin.password', $password);
    $query = $this->db->get();
    if($query->num_rows() == 1){
      return $query->result();
    }else{
      return false;
    }
  }
  
  //check if email exists on the database 
  public function email($email){
    $this->db->select('
                tbl_user.email_address
                ')
            ->from('tbl_user')
            ->where('email_address', $email);
    $q = $this->db->get();
    if($q->num_rows() ==1){
      return $q->result();
    }else{
      return false;
    }
  }
  
  public function login($username, $password){
    $sha_password = sha1($password);
    $this->db->select('
                      tu.user_id,
                      tu.username,
                      tu.email_address,
                      tu.password,
                      tu.account_type,
                      tu.paid_member,
                      tu.status,
											tu.reactivate_deactivate,
                      tp.id,
                      tp.profile_type
                      ')
            ->from('tbl_user tu')
            ->join('tbl_profile tp', 'tu.account_type=tp.id')
            ->where("(tu.email_address = '$username' OR tu.username = '$username')")
            ->where('tu.password', $sha_password)
						->where('tu.reactivate_deactivate = ', 0);
    $query = $this->db->get();

    if($query->num_rows() == 1){
      return $query->result();
    }else{
      return false;
    }
  }
 
	/*function login($email,$password){
			$sql="SELECT tablefield FROM tablename WHERE tablefield ='".$variale."' AND tablefield ='".md5($variable)."'";
			$query = $this->db->query($sql);			 
			return ($query->num_rows() > 0)	?	$query->row()	:	FALSE;
	}//endfct
	*/
	function admin_login($username,$password){
	 
			$sql="SELECT tablefield FROM tablename WHERE tablefield ='".$variale."' AND tablefield ='".md5($variable)."'";
			$query = $this->db->query($sql);			 
			return ($query->result())	?	TRUE	:	FALSE;
	}//endfct
	
}//endclass

