<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_brand extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
		
		$this->load->model('product_brand_model');
	}
	
	function product_brand_create()
	{
		$data = array();
		$data['create_error'] = '';
		
		if ($this->input->post('submit'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'name', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
				$param = array();
				$param['name'] = $this->input->post('name');
				$query = $this->product_brand_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_product_brand_lists').'?alert=success&type=create');
				}
				else
				{
					$data['create_error'] = $query->result;
				}
			}
		}
		
		$data['frame_content'] = 'product_brand/product_brand_create';
		$this->load->view('templates/frame', $data);
	}
	
	function product_brand_delete()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['action'] = $this->input->post('action');
		$data['grid'] = $this->input->post('grid');
		
		$get = $this->product_brand_model->info(array('id_product_brand' => $data['id']));
		
		if ($get->code == 200)
		{
			if ($this->input->post('delete') == TRUE)
			{
				$query = $this->product_brand_model->delete(array('id_product_brand' => $data['id']));
				
				if ($query->code == 200)
				{
					$response =  array('msg' => 'Delete data success', 'type' => 'success', 'title' => 'Product Brand');
				}
				else
				{
					$response =  array('msg' => 'Delete data failed', 'type' => 'error', 'title' => 'Product Brand');
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
	
	function product_brand_edit()
	{
		$data = array();
		$data['id'] = $this->input->get_post('id');
		
		$info = $this->product_brand_model->info(array('id_product_brand' => $data['id']));
		
		$data['product_brand'] = $info->result;
		
		if ($info->code == 200)
		{
			if ($this->input->post('submit'))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('name', 'title', 'required');
			
				if ($this->form_validation->run() == FALSE)
				{
					$data['create_error'] = validation_errors();
				}
				else
				{
					$param1 = array();
					$param1['id_product_brand'] = $data['id'];
					$param1['name'] = $this->input->post('name');
					$query = $this->product_brand_model->update($param1);
					
					if ($query->code == 200)
					{
						redirect($this->config->item('link_product_brand_lists').'?alert=success&type=edit');
					}
					else
					{
						$data['create_error'] = $query->result;
						$data['frame_content'] = 'product_brand/product_brand_edit';
						$this->load->view('templates/frame', $data);
					}
				}
			}
			
			$data['create_error'] = '';
			$data['frame_content'] = 'product_brand/product_brand_edit';
			$this->load->view('templates/frame', $data);
		}
		else
		{
			echo "Data Not Found";
		}
	}
	
	function product_brand_get()
	{
		$page = $this->input->post('page') ? $this->input->post('page') : 1;
		$pageSize = $this->input->post('pageSize') ? $this->input->post('pageSize') : 20;
		$offset = ($page - 1) * $pageSize;
		$i = $offset * 1 + 1;
		$order = 'title';
		$sort = 'asc';
		$q = '';
		
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
		
        $get = $this->product_brand_model->lists(array('q' => $q, 'limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
		$jsonData = array('data' => array(), 'total' => 0);
		
		if ($get->code == 200)
		{
			$jsonData['total'] = $get->total;
			
			foreach ($get->result as $row)
			{
				$action = '<a title="Edit" href="product_brand_edit?id='.$row->id_product_brand.'"><i class="fa fa-pencil fontorange font16"></i></a>&nbsp;
							<a title="Delete" id="'.$row->id_product_brand.'" class="delete '.$row->id_product_brand.'-delete" href="#"><i class="fa fa-times fontred font16"></i></a>';
				
				$entry = array(
					'No' => $i,
					'Name' => ucwords($row->name),
					'Action' => $action
				);
				
				$jsonData['data'][] = $entry;
				$i++;
			}
		}
		
		echo json_encode($jsonData);
	}
	
	function product_brand_lists()
	{
		$data = array();
		$data['alert'] = '';
		
		if ($this->input->get('alert') == 'success')
		{
			$data['alert'] = $this->input->get('type').' data success';
		}
		
		$data['frame_content'] = 'product_brand/product_brand_lists';
		$this->load->view('templates/frame', $data);
	}
}
