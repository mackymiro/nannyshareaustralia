<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/

class Data_model extends CI_Model {	
  //return mummy and shared nanny
  public static function getMummySharedNanny(){
    return array(
      0=>'--Select--',
      1=>'Mummy Nanny',
      2=>'Shared Nanny'
      );
  }
  
  //return age
  public static function getAge(){
    return array(
      1 =>'3 months',
      2 =>'6 months',
      3 =>'7 months',
      4 =>'8 months',
      5 =>'9 months',
      6 =>'1 yr',
      7 =>'2 yrs',
      8 =>'3 yrs',
      9 =>'4 yrs',
      10 =>'5 yrs'
    );
  }
  
  //return nanny experience
  public static function getNannyExp(){
    return array(
      0=>'--Select--',
      1 =>'1yr',
      2 =>'2yrs',
      3 =>'3yrs',
      4 =>'4yrs',
      5 =>'5yrs',
      6 =>'6yrs',
      7 =>'7yrs',
      8 =>'8yrs',
      9 =>'9yrs',
      10 =>'10yrs',
      11 =>'11yrs',
      12 =>'12yrs',
      13 =>'13yrs',
      14 =>'14yrs',
      15 =>'15yrs',
      16 =>'16yrs',
      17 =>'17yrs',
      18 =>'18yrs',
      19 =>'19yrs',
      20 =>'20yrs'
    );
  }
  
  //return ages of children cared for checkboxes
  public static function getAgesOfChildrenCaredOfCheckboxes(){
    return array(
      1 =>'0-3months',
      2 =>'3-6moths',
      3 =>'6-12months',
      4 =>'1-2years',
      5 =>'2-3years',
      6 =>'3-4years',
      7 =>'4-5years'
    );
  
  }
  
  //return ages of children cared for
  public static function getAgesOfChildrenCaredOf(){
    return array(
      0=>'--Select--',
      1 =>'0-3months',
      2 =>'3-6moths',
      3 =>'6-12months',
      4 =>'1-2years',
      5 =>'2-3years',
      6 =>'3-4years',
      7 =>'4-5years'
    );
  
  }
  
  //return day
  public static function getDay(){
    return array(
      0 =>'Day',
      1 =>'1',
      2 =>'2',
      3 =>'3',
      4 =>'4',
      5 =>'5',
      6 =>'6',
      7 =>'7',
      8 =>'8',
      9 =>'9',
      10 =>'10',
      11 =>'11',
      12 =>'12',
      13 =>'13',
      14 =>'14',
      15 =>'15',
      16 =>'16',
      17 =>'17',
      18 =>'18',
      19 =>'19',
      20 =>'20',
      21 =>'21',
      22 =>'22',
      23 =>'23',
      24 =>'24',
      25 =>'25',
      26 =>'26',
      27 =>'27',
      28 =>'28',
      29 =>'29',
      30 =>'30',
      31 =>'31'
      
    );
  }
  
  //return month
  public static function getMonth(){
    return array(
      0 =>'Month',
      1 =>'January',
      2 =>'February',
      3 =>'March',
      4 =>'April',
      5 =>'May',
      6 =>'June',
      7 =>'July',
      8 =>'August',
      9 =>'September',
      10 =>'October',
      11 =>'November',
      12 =>'December'
    );
  }
  
  //return year
  public static function getYear(){
    return array(
      0000 => 'Year',
      2014 =>'2014',
      2013 =>'2013',
      2012 =>'2012',
      2011 =>'2011',
      2010 =>'2010',
      2009 =>'2009',
      2008 =>'2008',
      2007 =>'2007',
      2006 =>'2006',
      2005 =>'2005',
      2004 =>'2004',
      2003 =>'2003',
      2002 =>'2002',
      2001 =>'2001',
      2000 =>'2000',
      1999 =>'1999',
      1998 =>'1998',
      1997 =>'1997',
      1996 =>'1996',
      1995 =>'1995',
      1994 =>'1994',
      1993 =>'1993',
      1992 =>'1992',
      1991 =>'1991',
      1990 =>'1990',
      1989 =>'1989',
      1988 =>'1988',
      1987 =>'1987',
      1986 =>'1986',
      1985 =>'1985',
      1984 =>'1984',
      1983 =>'1983',
      1982 =>'1982',
      1981 =>'1981',
      1980 =>'1980',
      1979 =>'1979',
      1978 =>'1978',
      1977 =>'1977',
      1976 =>'1976',
      1975 =>'1975',
      1974 =>'1974',
      1973 =>'1973',
      1972 =>'1972',
      1971 =>'1971',
      1970 =>'1970',
      1969 =>'1969',
      1968 =>'1968',
      1967 =>'1967',
      1966 =>'1966',
      1965 =>'1965',
      1964 =>'1964',
      1963 =>'1963',
      1962 =>'1962',
      1961 =>'1961',
      1960 =>'1960'   
    );
  }
  
  //return visibile/invisible profile
  public static function getVisibleProfile(){
    return array(
      1 => 'Visible',
      2 => 'Invisible'
    );
  }
  
  //return prefer care
  public static function getPreferCare(){
    return array(
      0 =>'--Select--',
      1 =>'My house',
      2 =>'Your house',
      3 =>'Alternate'
    );
  }
  
  //return dog/cat
  public static function getDogCat(){
    return array(
      0 => '-----SELECT ONE-----',
      1 => 'Dog',
      2 => 'Cat'
    );
  }
  
  //return yes/no
  public static function getYesNo(){
    return array(
      0 =>'--Select--',
      1 =>'Yes',
      2 =>'No'
    );
  }
    
  //return days per week checkbox
  public static function getDaysPerWeekCheckbox(){
    return array(
      1 =>'Sunday',
      2 =>'Monday',
      3 =>'Tuesday',
      4 =>'Wendesday',
      5 =>'Thursday',
      6 =>'Friday',
      7 =>'Saturday'
    );
  
  }
  
  //return days per week
  public static function getDaysPerWeek(){
    return array(
      0=>'--Select--',
      1 =>'Sunday',
      2 =>'Monday',
      3 =>'Tuesday',
      4 =>'Wendesday',
      5 =>'Thursday',
      6 =>'Friday',
      7 =>'Saturday'
    );
  
  }
  
  
  //return all number
  public static function getAllNumber(){
    return array(
      0=>'--Select--',
			0=>'0',
      1 =>'1',
      2 =>'2',
      3 =>'3',
      4 =>'4',
      5 =>'5',
      6 =>'6',
      7 =>'7',
      8 =>'8',
      9 =>'9',
      10 =>'10'
    );
  
  }
  
}
