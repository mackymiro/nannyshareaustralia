<?php

/*
 * Main Library class for the templates
 * @author: Magento Cebu
 */

class Template_lib{
    //Same with $data in passing parameter in load->view
    var $template_data = array();

    /*
     * Fct that will set the values  for the template layout
     *
     * @params:
     *      $value - value to be assigned
     *      $name - name on the html
     */
    public function set_value($name, $value){
          $this->template_data[$name] = $value;
    }//endfct

    /*
     * Fct that will set the view to load
     */
    public function set_view($template='', $contentview='', $data=array(),$return=FALSE){
        $this->CI = & get_instance();
        $this->set_value('main_content', $this->CI->load->view($contentview, $data, TRUE));
        return $this->CI->load->view($template, $this->template_data, $return);
    }//endfct

    public function set_3col_view($template='', $searchview='', $leftview='', $contentview='', $rightview='', $data=array(), $return=FALSE){
        $this->CI = & get_instance();
        if($searchview != '') $this->set_value('search_view', $this->CI->load->view($searchview, $data, TRUE));
        if($leftview != '') $this->set_value('left_column_view', $this->CI->load->view($leftview, $data, TRUE));
        if($rightview != '') $this->set_value('right_col_view', $this->CI->load->view($rightview, $data, TRUE));
        $this->set_value('main_content', $this->CI->load->view($contentview, $data, TRUE));
        return $this->CI->load->view($template, $this->template_data, $return);
    }//endfct
    
	 /*
     * Fct that will set the view to load
     */
    public function set_view_reg($template='', $contentview='', $data=array(), $return=FALSE){
        $this->CI = & get_instance();
        $this->set_value('main_content', $this->CI->load->view($contentview, $data, TRUE));
        return $this->CI->load->view($template, $this->template_data, $return);
    }//endfct
	
	 /*
     * Fct to include file in the html header
     * @params:
     *      $path - path of the file where to get the html header file
     *      $type - type of content to inject in the header e.g css or js
     * @return: void
     */
    function set_header($path, $type){
        if(!empty($type)){
           $this->CI = & get_instance();
           $styles = $this->CI->load->view($path,null, TRUE);
           $this->set_value($type, $styles);
        }//endif
    }//endfct
	
    /*
     * Fct that will set the html header to used in the template
     *
     * @params:
     *      $filenames - filenames of the files want to put on the html head
     *      $base_path - base path of the file
     *      $type - type of the file can be css or javascript
     *      $ext - file extension type, css or js
     */
    public function set_head($filenames =array(),$base_path='',$type='',$ext=''){
        $return = '';
        foreach($filenames as $name){
            //$return .= $this->_get_head($base_path.$name.".$ext",$type);
            $return .= $this->_get_head('./'.$name.".$ext",$type);
        }//endforeach

        return $return;
    }//endfct

    function _get_head($src='',$type=''){
        $head_names = array('link'=>'<link rel="stylesheet" type="text/css" href="'.$src.'" />',
                        'script'=>'<script type="text/javascript" src="'.$src.'"></script>'
                        );

         return $head_names;
    }//endfct

    

    /*
     * Fct to inject inline css or js
     * @params:
     *  $type_string - html string
     */
    function set_inline_header($type_string){
        $this->set_value('inline', $type_string);
    }//endfct

}//endfct
/*End of File Template_lib.php*/
/*File Location: ./application/libraries/Template_lib.php*/

