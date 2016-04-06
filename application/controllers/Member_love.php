<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Member_love extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('member_love_model');
		$this->load->model('member_model');
		$this->load->model('product_model');
	}
	
	function member_love_delete()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['action'] = $this->input->post('action');
		$data['grid'] = $this->input->post('grid');
		
		$get = $this->member_love_model->info(array('id_member_love' => $data['id']));
		
		if ($get->code == 200)
		{
			if ($this->input->post('delete') == TRUE)
			{
				$query = $this->member_love_model->delete(array('id_member_love' => $data['id']));
				
				if ($query->code == 200)
				{
					$response =  array('msg' => 'Delete data success', 'type' => 'success', 'title' => 'Member Love');
				}
				else
				{
					$response =  array('msg' => 'Delete data failed', 'type' => 'error', 'title' => 'Member Love');
				}
				
				echo json_encode($response);
				exit();
			}
			else
			{
				$this->load->view('delete_confirm', $data);
			}
		}
		else
		{
			echo "Data Not Found";
		}
	}
	
	function member_love_get()
	{
		$page = $this->input->post('page') ? $this->input->post('page') : 1;
		$pageSize = $this->input->post('pageSize') ? $this->input->post('pageSize') : 20;
		$offset = ($page - 1) * $pageSize;
		$i = $offset * 1 + 1;
		$order = 'name';
		$sort = 'asc';
		$q = '';
		$id_member = $this->input->get_post('id_member') ? $this->input->get_post('id_member') : '';
		$id_product = $this->input->get_post('id_product') ? $this->input->get_post('id_product') : '';
		
		if ($this->input->post('sort'))
		{
			$order = $_POST['sort'][0]['field'];
			$sort = $_POST['sort'][0]['dir'];
		}
		
		if ($this->input->post('filter'))
		{
			if (empty($_POST['filter']['filters']))
			{
				$q = $this->input->post('filter');
			}
			else
			{
				$q = $_POST['filter']['filters'][0]['value'];
			}
		}
		
        $get = $this->member_love_model->lists(array('id_product' => $id_product, 'id_member' => $id_member, 'q' => $q, 'limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
		$jsonData = array('data' => array(), 'total' => 0);
		
		if ($get->code == 200)
		{
			$jsonData['total'] = $get->total;
			
			foreach ($get->result as $row)
			{
				$action = '<a title="Delete" id="'.$row->id_member_love.'" class="delete '.$row->id_member_love.'-delete" href="#"><i class="fa fa-times fontred font16"></i></a>';
				
				$entry = array(
					'No' => $i,
					'MemberName' => ucwords($row->member->name),
					'ProductName' => ucwords($row->product->name),
					'Action' => $action
				);
				
				$jsonData['data'][] = $entry;
				$i++;
			}
		}
		
		echo json_encode($jsonData);
	}
	
	function member_love_lists()
	{
		$data = array();
		$data['id_member'] = $this->input->get_post('id_member');
		$data['id_product'] = $this->input->get_post('id_product');
		
		if ($data['id_member'] == FALSE && $data['id_product'] == FALSE)
		{
			redirect($this->config->item('link_dashboard'));
		}
		
		$query = $this->member_model->info(array('id_member' => $data['id_member']));
		$query2 = $this->product_model->info(array('id_product' => $data['id_product']));
		
		if ($query->code == 200)
		{
			$data['member'] = $query->result;
		}
		
		if ($query2->code == 200)
		{
			$data['product'] = $query2->result;
		}
		
		$data['back_button'] = $this->config->item('link_member_lists');
		if ($data['id_product'] == TRUE)
		{
			$data['back_button'] = $this->config->item('link_product_lists');
		}
		
		$data['frame_content'] = 'member_love/member_love_lists';
		$this->load->view('templates/frame', $data);
	}
}
