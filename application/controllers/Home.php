<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
		
		$this->load->model('member_model');
	}
	
	function dashboard()
	{
		$data = array();
		
		$data['frame_content'] = 'home/dashboard';
		$this->load->view('templates/frame', $data);
	}
}
