<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Navigation
{
	function __construct(){
		$CI =& get_instance();
		
		$CI->load->model('nav_menu_model');
	}
	
	function breadcrumb($controller='', $function='')
	{
		$CI =& get_instance();
		
		$get_icon = $CI->nav_model->info(array('title' => $controller));
		
		$data = array();
		if ($get_icon->num_rows > 0)
		{
			$data['icon'] = $get_icon->row()->icon;
			
			$get_function = $CI->nav_model->info(array('url' => $function));
			
			if ($get_function->num_rows() > 0)
			{
				$data['url'] = $get_function->row()->url;
				$data['description'] = $get_function->row()->description;
				$data['title'] = $get_function->row()->title;
				$data['controller'] = $controller;
			}
		}
		
		return $data;
	}
	
	function generate_sidebar($controller='', $function='')
	{
		$CI =& get_instance();
		
		$param = array();
		$param['type'] = 1;
		$param['order'] = 'menu_order';
		$param['sort'] = 'asc';
		$param['status'] = 1;
		$param['admin_role'] = 1;
		$get_sidebar = $CI->nav_model->lists($param);
		
		$data = array();
		if ($controller == 'property_item')
		{
			$data['controller'] = 'property item';
		}
		else
		{
			$data['controller'] = $controller;
		}
		
		$data['function'] = $function;
		
		if ($get_sidebar)
		{
			foreach ($get_sidebar as $row)
			{
				$temp = array();
				$temp = array(
					'title' => $row['title'],
					'icon' => $row['icon']
				);
				
				$param2 = array();
				$param2['type'] = 2;
				$param2['parent_name'] = $row['title'];
				$param2['order'] = 'menu_order';
				$param2['sort'] = 'asc';
				$param2['status'] = 1;
				$param2['administrator_role'] = $CI->session->userdata('role');
				$get_sidebar = $CI->nav_model->lists($param2);
				
				if ($get_sidebar)
				{
					foreach ($get_sidebar as $k)
					{
						$temp['sidebar'][$k['title']] = $k;
						
						$param3 = array();
						$param3['type'] = 3;
						$param3['parent_name'] = $k['title'];
						$param3['order'] = 'menu_order';
						$param3['sort'] = 'asc';
						$param3['status'] = 1;
						$param3['administrator_role'] = $CI->session->userdata('role');
						$get_child = $CI->nav_model->lists($param3);
						
						if ($get_child)
						{
							foreach ($get_child as $l)
							{
								$temp['sidebar'][$k['title']]['child'][$l['title']] = $l;
							}
						}
					}
				}
				
				$data['navigation'][$row['title']] = $temp;
			}
		}
		
		return $data;
	}
	
	function only_admin()
	{
		$CI =& get_instance();
		
		if ($CI->session->userdata('role') != 1)
		{
			echo 'You do not have authorize on this page';
			exit();
		}
	}
}	

/* End of file Navigation.php */
/* Location: ./application/libraries/Navigation.php */