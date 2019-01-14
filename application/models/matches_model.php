<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Matches_model extends CI_Model {
  //count nanny matches and return number of nannies
  public function countNannyMatches($id){
     $this->db->select('
                    tu.user_id,
                         tu.first_name,
                         tu.last_name,
                         tu.email_address,
                         tu.address,
                         tu.account_type,
												 tu.make_profile,
                         tg.lattitude,
                         tg.longitude
                  ')
              ->from('tbl_user tu')
              ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
              ->where('tu.account_type = ', 1)
							->where('tu.make_profile = ', 1)
              ->where('tu.user_id !=', $id);
     return $this->db->count_all_results();
  }
  
  //count family matches and return number of families
  public function countFamilyMatches($id){
     $this->db->select('
                    tu.user_id,
                         tu.first_name,
                         tu.last_name,
                         tu.email_address,
                         tu.address,
                         tu.account_type,
												 tu.make_profile,
                         tg.lattitude,
                         tg.longitude
                  ')
              ->from('tbl_user tu')
              ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
              ->where('tu.account_type = ', 2)
							->where('tu.make_profile = ', 1)
               ->where('tu.user_id !=', $id);
     return $this->db->count_all_results();
  }

  //count all nanny matches
  public function getNumberofNannyMatches($id){
     $distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
     $this->db->select('
                    tu.user_id,
                         tu.first_name,
                         tu.last_name,
                         tu.email_address,
                         tu.address,
                         tu.account_type,
												 tu.make_profile,
                         tg.lattitude,
                         tg.longitude
                  ')
              ->from('tbl_user tu')
              ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
              ->where('tu.account_type = ', 1)
							->where('tu.make_profile = ', 1)
              ->where('tu.user_id !=', $id);
     return $this->db->count_all_results();
  }

  //get nanny matches
  public function getNannyMatches($id, $lattitude, $longitude){
   //$distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
   $distance = '(6371) * acos( cos( radians("{$lattitude}") ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians("{$longitude}") ) + sin( radians("{$lattitude}") ) * sin( radians( lattitude ) ) )';
	 return  $this->db->select('
                         tu.user_id,
                         tu.first_name,
                         tu.last_name,
                         tu.email_address,
                         tu.address,
                         tu.account_type,
												 tu.make_profile,
                         tg.lattitude,
                         tg.longitude
                        ')
              
               ->select("{$distance} AS distance ")
               ->from('tbl_user tu')
               ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
               ->where('account_type = ', 1)
							 ->where('tu.make_profile = ', 1)
               ->where('tu.user_id !=', $id)
               ->get()->result_object();   
		 $this->db->last_query();
  }
  
  //count all family matches 
  public function getNumberOfFamilyMatches($id){
     $distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
     $this->db->select('
                    tu.user_id,
                     tu.first_name,
                     tu.last_name,
                     tu.email_address,
                     tu.address,
                     tu.account_type,
											tu.make_profile,
                     tg.lattitude,
                     tg.longitude
                  ')
              ->from('tbl_user tu')
              ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
              ->where('tu.account_type = ', 2)
							->where('tu.make_profile = ', 1)
              ->where('tu.user_id !=', $id);
     return $this->db->count_all_results();
  }  
 
  //get family matches
  public function getFamilyMatches($id){
   $distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
   return  $this->db->select('
                         tu.user_id,
                         tu.first_name,
                         tu.last_name,
                         tu.email_address,
                         tu.address,
                         tu.account_type,
                         tu.suburb_postcode,
												 tu.make_profile,
                         tg.lattitude,
                         tg.longitude
                        ')
              
               ->select("{$distance} AS distance ")
               ->from('tbl_user tu')
               ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
               ->where('tu.account_type = ', 2)
							 ->where('tu.make_profile = ', 1)
               ->where('tu.user_id !=', $id)
               ->get()->result_object();         
  }
  
  //get the address distance 
   public function getAddress($id){
     $distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
     return  $this->db->select('
                           tu.user_id,
                           tu.first_name,
                           tu.last_name,
                           tu.email_address,
                           tu.address,
                           tu.account_type,
                           tg.lattitude,
                           tg.longitude
                          ')
                
                 ->select("{$distance} AS distance ")
                 ->from('tbl_user tu')
                 ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
                 ->where('tu.user_id =', $id)
                 ->get()->result_object();         
  }
	
	//get all the family matches
	public function getAllNannyMatches($id, $lattitude, $longitude){
		//$distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
		$distance = '(6371) * acos( cos( radians("{$lattitude}") ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians("{$longitude}") ) + sin( radians("{$lattitude}") ) * sin( radians( lattitude ) ) )';
    //$distance = "( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM locations"; 
		return $this->db->select('
                    tu.user_id,
                         tu.first_name,
                         tu.last_name,
                         tu.email_address,
                         tu.address,
                         tu.suburb_postcode,
                         tg.lattitude,
                         tg.longitude,
                         tp.profile_type
                         
                  ')
              ->select("{$distance} AS distance ")
              ->from('tbl_user tu')
              ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
              ->join('tbl_profile tp', 'tu.account_type=tp.id')
							->where('tu.user_id !=', $id)
              ->where('account_type = ', 1)
              ->get()->result_object();
	}

  public function getAllNannyMatchesV1($id, $lattitude, $longitude){
    // cant figure out yet the use of parameters base on original implementation..
    // getting the logged user's data instead..

    $this->load->library('session');
    $logged = $this->session->userdata('loggedIn');

    $res = $this->db->select('tg.lattitude,tg.longitude')
    ->from('tbl_user tu')
    ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
    ->join('tbl_profile tp', 'tu.account_type=tp.id')
    ->where("tu.user_id =", $logged['id']);
    $res = $res->get()->result_object();
    
    $loc = array($res[0]->lattitude,$res[0]->longitude);

    $theObj = null;

    if($loc!=null)
    {
      $res = $this->db->select('tu.user_id,
        tu.first_name,
         tu.last_name,
         tu.email_address,
         tu.address,
         tu.suburb_postcode,
         tu.account_type,
         tg.lattitude,
         tg.longitude,
         tp.profile_type')
      ->select("tg.lattitude AS distance ")
      ->from('tbl_user tu')
      ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
      ->join('tbl_profile tp', 'tu.account_type=tp.id')
      ->where('tu.account_type = ', 1);
      $res = $res->get()->result_object();

      $data = array();
      $theObj = array();
      $theHashed = array();

      foreach($res as $arr)
      {
        $data[] = array($arr->lattitude,$arr->longitude,$arr->user_id);
        $theHashed[$arr->user_id] = $arr;

      }
      
      // if based on center of existing
      //$center = $this->GetCenterFromDegrees($data);

      // if postcode location base on google map..
      

      foreach($data as $arr)
      {
        if($this->haversine_km($loc[0],$loc[1],$arr[0],$arr[1])<=40) // 40 here is fix..
        {
          $theHashed[$arr[2]]->distance = $this->haversine_km($loc[0],$loc[1],$arr[0],$arr[1]); 
          $theObj[] = $theHashed[$arr[2]];
        }
      }
    }
    return $theObj;



    //$distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
    $distance = '(6371) * acos( cos( radians("{$lattitude}") ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians("{$longitude}") ) + sin( radians("{$lattitude}") ) * sin( radians( lattitude ) ) )';
    //$distance = "( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM locations"; 
    return $this->db->select('
                    tu.user_id,
                         tu.first_name,
                         tu.last_name,
                         tu.email_address,
                         tu.address,
                         tu.suburb_postcode,
                         tg.lattitude,
                         tg.longitude,
                         tp.profile_type')
              ->select("{$distance} AS distance ")
              ->from('tbl_user tu')
              ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
              ->join('tbl_profile tp', 'tu.account_type=tp.id')
              ->where('tu.user_id !=', $id)
              ->where('account_type = ', 1)
              ->get()->result_object();
  }


  public function getAllFamilyMatchesV1()
  {
    $this->load->library('session');
    $logged = $this->session->userdata('loggedIn');

    $res = $this->db->select('tg.lattitude,tg.longitude')
    ->from('tbl_user tu')
    ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
    ->join('tbl_profile tp', 'tu.account_type=tp.id')
    ->where("tu.user_id =", $logged['id']);
    $res = $res->get()->result_object();
    
    $loc = array($res[0]->lattitude,$res[0]->longitude);

    $theObj = null;

    if($loc!=null)
    {
      $res = $this->db->select('tu.user_id,
        tu.first_name,
         tu.last_name,
         tu.email_address,
         tu.address,
         tu.suburb_postcode,
         tu.account_type,
         tu.status,
         tg.lattitude,
         tg.longitude,
         tp.profile_type')
      ->select("tg.lattitude AS distance ")
      ->from('tbl_user tu')
      ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
      ->join('tbl_profile tp', 'tu.account_type=tp.id')
      ->where('account_type = ', 2)
      ->where('status =', 1)
      ->or_where('status =', 2)
      ->where('tu.user_id != ', $logged['id']);
      $res = $res->get()->result_object();

      $data = array();
      $theObj = array();
      $theHashed = array();

      foreach($res as $arr)
      {
        $data[] = array($arr->lattitude,$arr->longitude,$arr->user_id);
        $theHashed[$arr->user_id] = $arr;

      }
      
      // if based on center of existing
      //$center = $this->GetCenterFromDegrees($data);

      // if postcode location base on google map..
      

      foreach($data as $arr)
      {
        if($this->haversine_km($loc[0],$loc[1],$arr[0],$arr[1])<=40)
        {
          $theHashed[$arr[2]]->distance = $this->haversine_km($loc[0],$loc[1],$arr[0],$arr[1]); 
          $theObj[] = $theHashed[$arr[2]];
        }
      }
    }
    return $theObj;
  }

    //calculate haversine distance for linear distance
  function haversine_km($lat1, $long1, $lat2, $long2)
  {
      $d2r =  M_PI / 180.0;
      $dlong = ($long2 - $long1) * $d2r;
      $dlat = ($lat2 - $lat1) * $d2r;
      $a = pow(sin($dlat/2.0), 2) + cos($lat1*$d2r) * cos($lat2*$d2r) * pow(sin($dlong/2.0), 2);
      $c = 2 * atan2(sqrt($a), sqrt(1-$a));
      $d = 6367 * $c;

      return $d;
  }
  
}

