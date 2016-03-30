<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
		
		$this->load->model('member_model');
		$this->load->model('movie_model');
		$this->load->model('product_model');
	}
	
	function dashboard()
	{
		$data = array();
		$query = $this->member_model->lists(array());
		$query2 = $this->movie_model->lists(array());
		$query3 = $this->product_model->lists(array());
		
		if ($query->code == 200)
		{
			$data['total_member'] = $query->total;
		}
		
		if ($query2->code == 200)
		{
			$data['total_movie'] = $query2->total;
		}
		
		if ($query3->code == 200)
		{
			$data['total_product'] = $query3->total;
		}
		
		$data['frame_content'] = 'home/dashboard';
		$this->load->view('templates/frame', $data);
	}
}
