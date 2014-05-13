<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation

{

	function run($module = '', $group = '') {

		(is_object($module)) AND $this->CI =& $module;

		return parent::run($group);

	}


    function valid_url($str){

           $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
            if (!preg_match($pattern, $str))
            {
                return FALSE;
            }

            return TRUE;
    }


}
