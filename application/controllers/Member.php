<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
	}
	
	function check_email()
	{
		$email = strtolower($this->input->post('email'));
		$email_default = strtolower($this->input->post('email_default'));
		$get = $this->member_model->info(array('email' => $email));
		
		if ($get->code == 200 && $email != $email_default)
		{
			$this->form_validation->set_message('check_email', '%s already registered');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function check_name()
	{
		$name = strtolower($this->input->post('name'));
		$name_default = strtolower($this->input->post('name_default'));
		$get = $this->member_model->info(array('name' => $name));
	
		if ($get->code == 200 && $name != $name_default)
		{
			$this->form_validation->set_message('check_name', '%s already registered');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function member_create()
	{
		$data = array();
		$data['create_error'] = '';
		
		if ($this->input->post('submit'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('gender', 'gender', 'required');
			$this->form_validation->set_rules('birthday', 'birthday', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
				$param = array();
				$param['name'] = $this->input->post('name');
				$param['email'] = $this->input->post('email');
				$param['password'] = $this->input->post('password');
				$param['gender'] = $this->input->post('gender');
				$param['birthday'] = $this->input->post('birthday');
				$query = $this->member_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_member_lists'));
				}
				else
				{
					$data['create_error'] = $query->result;
				}
			}
		}
		
		$data['code_member_gender'] = $this->config->item('code_member_gender');
		$data['frame_content'] = 'member/member_create';
		$this->load->view('templates/frame', $data);
	}
	
	function member_delete()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['action'] = $this->input->post('action');
		
		$get = $this->member_model->info(array('id_member' => $data['id']));
		
		if ($get->code == 200)
		{
			if ($this->input->post('delete'))
			{
				$param1 = array();
				$param1['id_member'] = $data['id'];
				$query = $this->member_model->delete($param1);
				
				if ($query)
				{
					$response =  array('msg' => 'Delete data success', 'type' => 'success');
				}
				else
				{
					$response =  array('msg' => 'Delete data failed', 'type' => 'error');
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
	
	function member_edit()
	{
		$data = array();
		$data['id'] = $this->input->get_post('id');
		
		$info = $this->member_model->info(array('id_member' => $data['id']));
		
		$data['kota_lists'] = $this->kota_model->lists(array('limit' => 500))->result;
		$data['code_member_idcard_type'] = $this->config->item('code_member_idcard_type');
		$data['code_member_gender'] = $this->config->item('code_member_gender');
		$data['code_member_marital_status'] = $this->config->item('code_member_marital_status');
		$data['code_member_religion'] = $this->config->item('code_member_religion');
		$data['code_member_shirt_size'] = $this->config->item('code_member_shirt_size');
		$data['code_member_status'] = $this->config->item('code_member_status');
		$data['member'] = $info->result;
		
		if ($info->code == 200)
		{
			if ($this->input->post('submit'))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('name', 'Name', 'required|callback_check_name');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
				$this->form_validation->set_rules('idcard_type', 'ID Type', 'required');
				$this->form_validation->set_rules('idcard_number', 'ID Number', 'required');
				$this->form_validation->set_rules('idcard_address', 'ID Address', 'required');
				$this->form_validation->set_rules('shipment_address', 'Shipment Address', 'required');
				$this->form_validation->set_rules('postal_code', 'Postal Code', 'required');
				$this->form_validation->set_rules('id_kota', 'Kota', 'required');
				$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|callback_check_phone_number');
				$this->form_validation->set_rules('marital_status', 'Marital Status', 'required');
				$this->form_validation->set_rules('occupation', 'Occupation', 'required');
				$this->form_validation->set_rules('religion', 'Religion', 'required');
				$this->form_validation->set_rules('shirt_size', 'Shirt Size', 'required');
				$this->form_validation->set_rules('idcard_photo', 'ID Photo', 'callback_check_idcard_photo');
				$this->form_validation->set_rules('photo', 'Photo', 'callback_check_photo');
				$this->form_validation->set_rules('status', 'Status', 'required');
				$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');
				
				if ($this->form_validation->run() == FALSE)
				{
					$data['error'] = validation_errors();
				}
				else
				{
					if (isset($_FILES['idcard_photo']) && $_FILES['idcard_photo']['error'] != 4)
					{
						$idcard_photo = check_all_photos($_FILES['idcard_photo']);
					}
					else
					{
						$idcard_photo = $info->result->idcard_photo;
					}
					
					if (isset($_FILES['photo']) && $_FILES['photo']['error'] != 4)
					{
						$photo = check_all_photos($_FILES['photo']);
					}
					else
					{
						$photo = $info->result->photo;
					}
					
					$param1 = array();
					$param1['id_member'] = $data['id'];
					$param1['name'] = $this->input->post('name');
					$param1['email'] = $this->input->post('email');
					$param1['idcard_type'] = $this->input->post('idcard_type');
					$param1['idcard_number'] = $this->input->post('idcard_number');
					$param1['idcard_address'] = $this->input->post('idcard_address');
					$param1['shipment_address'] = $this->input->post('shipment_address');
					$param1['postal_code'] = $this->input->post('postal_code');
					$param1['id_kota'] = $this->input->post('id_kota');
					$param1['phone_number'] = $this->input->post('phone_number');
					$param1['marital_status'] = $this->input->post('marital_status');
					$param1['occupation'] = $this->input->post('occupation');
					$param1['religion'] = $this->input->post('religion');
					$param1['shirt_size'] = $this->input->post('shirt_size');
					$param1['username'] = $this->input->post('username');
					$param1['status'] = $this->input->post('status');
					$param1['idcard_photo'] = $idcard_photo;
					$param1['photo'] = $photo;
					$query = $this->member_model->update($param1);
					
					if ($query->code == 200)
					{
						redirect('member_lists');
					}
					else
					{
						$data['create_error'] = $query->result;
						$data['frame_content'] = 'member/member_edit';
						$this->load->view('templates/frame', $data);
					}
				}
			}
			
			$data['create_error'] = '';
			$data['frame_content'] = 'member/member_edit';
			$this->load->view('templates/frame', $data);
		}
		else
		{
			echo "Data Not Found";
		}
	}
	
	function member_get()
	{
		$page = $this->input->post('page') ? $this->input->post('page') : 1;
		$pageSize = $this->input->post('pageSize') ? $this->input->post('pageSize') : 20;
		$offset = ($page - 1) * $pageSize;
		$i = $offset * 1 + 1;
		$order = 'name';
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
		
        $get = $this->member_model->lists(array('q' => $q, 'limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
		$jsonData = array('data' => array(), 'total' => 0);
		
		if ($get->code == 200)
		{
			$jsonData['total'] = $get->total;
			
			foreach ($get->result as $row)
			{
				$action = '<a title="View Detail" id="'.$row->id_member.'" class="view '.$row->id_member.'-view" href="#"><span class="glyphicon glyphicon-folder-open fontblue font16" aria-hidden="true"></span></a>&nbsp;
							<a title="Edit" href="member_edit?id='.$row->id_member.'"><span class="glyphicon glyphicon-pencil fontorange font16" aria-hidden="true"></span></a>&nbsp;
							<a title="Product Loved" href="member_love_lists?id_member='.$row->id_member.'"><i class="fa fa-heart fontpink font16"></i></a>&nbsp;
							<a title="Wishlists" href="member_wishlists_lists?id_member='.$row->id_member.'"><i class="fa fa-list fontblack font16"></i></a>&nbsp;
							<a title="Delete" id="'.$row->id_member.'" class="delete '.$row->id_member.'-delete" href="#"><span class="glyphicon glyphicon-remove fontred font16" aria-hidden="true"></span></a>';
				
				$entry = array(
					'No' => $i,
					'Name' => ucwords($row->name),
					'Email' => strtolower($row->email),
					'Gender' => $row->gender,
					'Action' => $action
				);
				
				$jsonData['data'][] = $entry;
				$i++;
			}
		}
		
		echo json_encode($jsonData);
	}
	
	function member_lists()
	{
		$data = array();
		$data['frame_content'] = 'member/member_lists';
		$this->load->view('templates/frame', $data);
	}
}
