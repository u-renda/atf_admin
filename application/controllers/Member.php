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
			$this->form_validation->set_rules('name', 'name', 'required|callback_check_name');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_check_email');
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
				$param['gender'] = intval($this->input->post('gender'));
				$param['birthday'] = date('Y-m-d', strtotime($this->input->post('birthday')));
				$query = $this->member_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_member_lists').'?alert=success&type=create');
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
		$data['grid'] = $this->input->post('grid');
		
		$get = $this->member_model->info(array('id_member' => $data['id']));
		
		if ($get->code == 200)
		{
			if ($this->input->post('delete') == TRUE)
			{
				$query = $this->member_model->delete(array('id_member' => $data['id']));
				
				if ($query->code == 200)
				{
					$response =  array('msg' => 'Delete data success', 'type' => 'success', 'title' => 'Member');
				}
				else
				{
					$response =  array('msg' => 'Delete data failed', 'type' => 'error', 'title' => 'Member');
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
		
		$data['member'] = $info->result;
		
		if ($info->code == 200)
		{
			if ($this->input->post('submit'))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('name', 'name', 'required|callback_check_name');
				$this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_check_email');
				$this->form_validation->set_rules('gender', 'gender', 'required');
				$this->form_validation->set_rules('birthday', 'birthday', 'required');
			
				if ($this->form_validation->run() == FALSE)
				{
					$data['create_error'] = validation_errors();
				}
				else
				{
					$param1 = array();
					if ($this->input->post('password') != '')
					{
						$param1['password'] = $this->input->post('password');
					}
					
					$param1['id_member'] = $data['id'];
					$param1['name'] = $this->input->post('name');
					$param1['email'] = $this->input->post('email');
					$param1['gender'] = intval($this->input->post('gender'));
					$param1['birthday'] = date('Y-m-d', strtotime($this->input->post('birthday')));
					$query = $this->member_model->update($param1);
					
					if ($query->code == 200)
					{
						redirect($this->config->item('link_member_lists').'?alert=success&type=edit');
					}
					else
					{
						$data['create_error'] = $query->result;
						$data['frame_content'] = 'member/member_edit';
						$this->load->view('templates/frame', $data);
					}
				}
			}
			
			$data['code_member_gender'] = $this->config->item('code_member_gender');
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
				$action = '<a title="Edit" href="member_edit?id='.$row->id_member.'"><i class="fa fa-pencil fontorange font16"></i></a>&nbsp;
							<a title="Product Loved" href="member_love_lists?id_member='.$row->id_member.'"><i class="fa fa-heart fontpink font16"></i></a>&nbsp;
							<a title="Wishlists" href="member_wishlist_lists?id_member='.$row->id_member.'"><i class="fa fa-list fontblack font16"></i></a>&nbsp;
							<a title="Delete" id="'.$row->id_member.'" class="delete '.$row->id_member.'-delete" href="#"><i class="fa fa-times fontred font18"></i></a>';
				
				$code_member_gender = $this->config->item('code_member_gender');
				
				$entry = array(
					'No' => $i,
					'Name' => ucwords($row->name),
					'Email' => strtolower($row->email),
					'Gender' => $code_member_gender[$row->gender],
					'Birthday' => date('d M Y', strtotime($row->birthday)),
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
		$data['alert'] = '';
		
		if ($this->input->get('alert') == 'success')
		{
			$data['alert'] = $this->input->get('type').' data success';
		}
		
		$data['frame_content'] = 'member/member_lists';
		$this->load->view('templates/frame', $data);
	}
}
