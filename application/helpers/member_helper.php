<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('check_all_photos'))
{
    function check_all_photos($param)
	{
		$CI =& get_instance();
		
		if ($param["error"] == 0)
		{
			$name = md5(basename($param["name"]) . date('Y-m-d H:i:s'));
			$imageFileType = strtolower(pathinfo($param["name"],PATHINFO_EXTENSION));
			$photo = base_url() . 'uploads/' . $name . '.' . $imageFileType;
			return $photo;
		}
    }
}
