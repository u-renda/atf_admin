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

if ( ! function_exists('check_image'))
{
    function check_image($param)
	{
        $CI =& get_instance();
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($param["tmp_name"]);
        
        if($check === FALSE)
        {
            $msg = "File is not an image.";
            return $msg;
        }
        else
        {
			// Check if file already exists
            if (file_exists($param['target_file']))
            {
                $msg = "Sorry, file already exists.";
                return $msg;
            }
            else
            {
				// Check file size
                if ($param["size"] > 2097152) // 2MB
                {
                    $msg = "Sorry, your file is too large.";
                    return $msg;
                }
                else
                {
                    // Allow certain file formats
                    if($param['imageFileType'] != "jpg" && $param['imageFileType'] != "png" && $param['imageFileType'] != "jpeg" && $param['imageFileType'] != "gif" )
                    {
                        $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        return $msg;
                    }
                    else
                    {
                        // if everything is ok, try to upload file
                        if (move_uploaded_file($param["tmp_name"], $param['target_file']))
                        {
                            $msg = 'true';
							return $msg;
                        }
                        else
                        {
                            $msg = "Sorry, there was an error uploading your file.";
                            return $msg;
                        }
                    }
                }
            }
        }
    }
}