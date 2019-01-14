<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Search_familynanny_model extends CI_Model{
  //search mummy nanny
  public function searchMummyNanny($q){
    $distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
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
              //->like('tu.suburb_postcode', $q)
              ->where('account_type = ', 1)
              ->where('mummy_shared_nanny = ', 1)
              ->get()->result_object();
  }
  //search mummy nanny with d..
  public function searchMummyNannyWithD($q,$km){
    $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=Australia'.$q);
    $obj = json_decode($json);
    $loc = null;
    $theObj = null;
    if(isset($obj->results[0]->geometry->location))
      $loc = $obj->results[0]->geometry->location;
    if($loc!=null)
    {
      $res = $this->db->select('
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
              ->select("tg.longitude AS distance ")
              ->from('tbl_user tu')
              ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
              ->join('tbl_profile tp', 'tu.account_type=tp.id')
              //->like('tu.suburb_postcode', $q)
              ->where('account_type = ', 1)
              ->where('mummy_shared_nanny = ', 1);
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
      $center = array($loc->lat, $loc->lng);

      foreach($data as $arr)
      {
        if($this->haversine_km($center[0],$center[1],$arr[0],$arr[1])<=$km)
        {
          $theHashed[$arr[2]]->distance = $this->haversine_km($center[0],$center[1],$arr[0],$arr[1]); 
          $theObj[] = $theHashed[$arr[2]];
        }
      }
    }
    
    return $theObj;
  }
  
  //search shared nanny
  public function searchSharedNanny($q){
    $distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
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
              ->like('tu.suburb_postcode', $q)
              ->where('account_type = ', 1)
              ->where('mummy_shared_nanny = ', 2)
              ->get()->result_object();
  }

  public function getDistanceFromLogged($id)
  {
    $this->load->library('session');
    $logged = $this->session->userdata('loggedIn');

    $res = $this->db->select('tg.lattitude,tg.longitude')
    ->from('tbl_user tu')
    ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
    ->join('tbl_profile tp', 'tu.account_type=tp.id')
    ->where("tu.user_id =", $logged['id']);
    $res = $res->get()->result_object();

    $res2 = $this->db->select('tg.lattitude,tg.longitude')
    ->from('tbl_user tu')
    ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
    ->join('tbl_profile tp', 'tu.account_type=tp.id')
    ->where("tu.user_id =", $id);
    $res2 = $res2->get()->result_object();
    
    return $this->haversine_km($res[0]->lattitude,$res[0]->longitude,$res2[0]->lattitude,$res2[0]->longitude);
  }

  //search shared nanny with d
  public function searchSharedNannyWithD($q, $km){
    $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=Australia'.$q);
    $obj = json_decode($json);
    $loc = null;
    $theObj = null;
    if(isset($obj->results[0]->geometry->location))
      $loc = $obj->results[0]->geometry->location;
    if($loc!=null)
    {
      $res = $this->db->select('
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
              ->select("tg.longitude AS distance ")
              ->from('tbl_user tu')
              ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
              ->join('tbl_profile tp', 'tu.account_type=tp.id')
              //->like('tu.suburb_postcode', $q)
              ->where('account_type = ', 1)
              ->where('mummy_shared_nanny = ', 2);
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
      $center = array($loc->lat, $loc->lng);

      foreach($data as $arr)
      {
        if($this->haversine_km($center[0],$center[1],$arr[0],$arr[1])<=$km)
        {
          $theHashed[$arr[2]]->distance = $this->haversine_km($center[0],$center[1],$arr[0],$arr[1]); 
          $theObj[] = $theHashed[$arr[2]];
        }
      }
    }
    
    return $theObj;
  }
  
  //search families 
  public function searchFamilies($q){

    //$coors = $.get(

    $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=Australia'.$q);
    $obj = json_decode($json);
    $loc = null;
    if(isset($obj->results[0]->geometry->location))
      $loc = $obj->results[0]->geometry->location;
    if($loc!=null)
    {
      $res = $this->db->select('tu.user_id,
        tu.first_name,
         tu.last_name,
         tu.email_address,
         tu.address,
         tu.suburb_postcode,
         tg.lattitude,
         tg.longitude,
         tp.profile_type')
      ->from('tbl_user tu')
      ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
      ->join('tbl_profile tp', 'tu.account_type=tp.id')
      ->like('tu.address', $q)
      ->where('account_type = ', 2);
      $res = $res->get()->result_array();

      $data = array();
      foreach($res as $arr)
      {
        $data[] = array($arr['lattitude'],$arr['longitude']);
        var_dump($arr);
        echo "<br>";
      }
      // if center of existing
      //$center = $this->GetCenterFromDegrees($data);

      // if postcode location base on google map..
      $center = array($loc->lat, $loc->lng);
      var_dump($center);

      foreach($data as $arr)
      {
        echo "<br>>>" . $this->haversine_km($center[0],$center[1],$arr[0],$arr[1]);
      }
      exit();
    }
    exit();
    $distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
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
              ->like('tu.address', $q)
              ->where('account_type = ', 2)
              ->get()->result_object();
    
  }

  public function searchFamiliesWithD($q, $km){
    $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=Australia'.$q);
    $obj = json_decode($json);
    $loc = null;
    $theObj = null;
    if(isset($obj->results[0]->geometry->location))
      $loc = $obj->results[0]->geometry->location;
    if($loc!=null)
    {
      $this->load->library('session');
      $logged = $this->session->userdata('loggedIn');
      if($logged)
      {
      $res = $this->db->select('tu.user_id,
        tu.first_name,
         tu.last_name,
         tu.email_address,
         tu.address,
         tu.suburb_postcode,
         tg.lattitude,
         tg.longitude,
         tp.profile_type')
      ->select("tg.lattitude AS distance ")
      ->from('tbl_user tu')
      ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
      ->join('tbl_profile tp', 'tu.account_type=tp.id')
      //->like('tu.address', $q)
      ->where('account_type = ', 2)
      ->where('tu.user_id != ', $logged['id']);
     }
     else
     {
      $res = $this->db->select('tu.user_id,
        tu.first_name,
         tu.last_name,
         tu.email_address,
         tu.address,
         tu.suburb_postcode,
         tg.lattitude,
         tg.longitude,
         tp.profile_type')
      ->select("tg.lattitude AS distance ")
      ->from('tbl_user tu')
      ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
      ->join('tbl_profile tp', 'tu.account_type=tp.id')
      //->like('tu.address', $q)
      ->where('account_type = ', 2);
     }
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
      $center = array($loc->lat, $loc->lng);

      foreach($data as $arr)
      {
        if($this->haversine_km($center[0],$center[1],$arr[0],$arr[1])<=$km)
        {
          $theHashed[$arr[2]]->distance = $this->haversine_km($center[0],$center[1],$arr[0],$arr[1]); 
          $theObj[] = $theHashed[$arr[2]];
        }
      }
    }

    return $theObj;
    /*
    $distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
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
              ->like('tu.address', $q)
              ->where('account_type = ', 2)
              ->get()->result_object();
              */
    
  }
	
	//get my current distance
	public function getMyDistance($id){
		$distance = '(6371) * acos( cos( radians(10) ) * cos( radians( lattitude ) ) *  cos( radians( longitude ) - radians(123) ) + sin( radians(10) ) * sin( radians( lattitude ) ) )';
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
						  ->get_where('tbl_user', array('tu.user_id'=>$id))->row_object();
	
	}
	
	//get Near Distance
	public function getNearDistance($id){
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
              ->from('tbl_user tu')
              ->join('tbl_geocoding tg', 'tu.user_id=tg.user_id')
              ->join('tbl_profile tp', 'tu.account_type=tp.id')
							->where('tu.user_id = ', $id)
							->get()->result_object();
	}	

  // helper function to get the center of all coords...
  public function GetCenterFromDegrees($data)
  {
    if (!is_array($data)) return FALSE;

    $num_coords = count($data);

    $X = 0.0;
    $Y = 0.0;
    $Z = 0.0;

    foreach ($data as $coord)
    {
        $lat = $coord[0] * pi() / 180;
        $lon = $coord[1] * pi() / 180;

        $a = cos($lat) * cos($lon);
        $b = cos($lat) * sin($lon);
        $c = sin($lat);

        $X += $a;
        $Y += $b;
        $Z += $c;
    }

    $X /= $num_coords;
    $Y /= $num_coords;
    $Z /= $num_coords;

    $lon = atan2($Y, $X);
    $hyp = sqrt($X * $X + $Y * $Y);
    $lat = atan2($Z, $hyp);

    return array($lat * 180 / pi(), $lon * 180 / pi());
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
