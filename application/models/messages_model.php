<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages_model extends CI_Model{
   //delete from sent messages 
  public function deleteSentMessages($id){
      $this->db->where('id', $id)->delete('tbl_sendmessages');
  }
  
  
  
  //getMySendMessages
  public function getMySendMessages($id){
    return $this->db->select(
                  'ts.id,
                   ts.user_id,
                   ts.senders_id,
                   ts.message,
                   tu.user_id,
                   tu.first_name,
                   tu.last_name'
                  )
              ->from('tbl_sendmessages ts')
              ->join('tbl_user tu', 'ts.senders_id=tu.user_id')  
              ->where('ts.id', $id)
              ->get()->result_object();
    $this->db->get('tbl_sendmessages');
  }

  //getToMessages
  public function getToMessages($id){
     return $this->db->select(
                  'ts.id,
                   ts.user_id,
                   ts.senders_id,
                   ts.message,
                   tu.user_id,
                   tu.first_name,
                   tu.last_name'
                  )
              ->from('tbl_sendmessages ts')
              ->join('tbl_user tu', 'ts.senders_id=tu.user_id')  
              ->where('ts.id', $id)
              ->get()->row_object();
    $this->db->get('tbl_sendmessages');
  }

   //get savemessages
  public function getSendMessages($id){
    return $this->db->select(
                  'ts.id,
                   ts.user_id,
                   ts.senders_id,
                   ts.message,
                   tu.user_id,
                   tu.first_name,
                   tu.last_name'
                  )
              ->from('tbl_sendmessages ts')
              ->join('tbl_user tu', 'ts.senders_id=tu.user_id')  
              ->where('ts.user_id', $id)
              ->order_by('ts.id', "DESC")
              ->get()->result_object();
    $this->db->get('tbl_sendmessages');
  }

  //save sendmessages
  public function saveSendMsgs($data){
    $this->db->insert('tbl_sendmessages', $data);
  }
  
  //delete from messages 
  public function delete($id){
      $this->db->where('msg_id', $id)->delete('tbl_msgs');
  }
  
	//get senders email
	public function getSendersEmail($id){
		 return $this->db->get_where('tbl_user', array('user_id'=> $id))->result_object();
	}
  
  public function getMyMessages($id){
			return $this->db->select(
                'tm.message,
                 tm.senders_id,
                 tm.msg_id,
                 tm.user_id,
								 tu.email_address,
                '
                )
            ->from('tbl_msgs tm')
						->join('tbl_user tu', 'tm.user_id=tu.user_id')
            ->where('tm.msg_id', $id)
            ->order_by('tm.msg_id', 'DESC')
            ->get()->result_object();
     $this->db->get('tbl_msgs tm');
  }
  
  public function getNumberOfUserMessages(){
    $this->db->select('
                  tbl_msgs.msg_id
                  ')
              ->from('tbl_msgs'); 
     return $this->db->count_all_results();
  }
  
  public function getNumberOfMessages($id){
      $this->db->select('
                  tbl_msgs.msg_id,
                  tbl_msgs.user_id,
                  tbl_msgs.senders_id,
                  tbl_msgs.flag
                  '
                  )
              ->from('tbl_msgs')
              ->where('senders_id', $id)
              ->where('flag', 0); 
     return $this->db->count_all_results();
  }
  
  public function saveMsgs($data){
    $this->db->insert('tbl_msgs', $data);
  }
  
  //get messages from the senders messages
  public function getMessages($id){
    return $this->db->select(
                    'tm.user_id,
                     tm.senders_id,
                     tm.msg_id,
                     tm.message,
                     tm.flag,
                   
                     tu.first_name,
                     tu.last_name
                    '
                    )
                  ->from('tbl_msgs tm')
                  ->join('tbl_user tu', 'tm.user_id=tu.user_id')
                  ->where('tm.senders_id', $id) 
                  ->order_by('msg_id', 'DESC')
                  ->get()->result_object();
    $this->db->get('tbl_msgs');
  }
}
