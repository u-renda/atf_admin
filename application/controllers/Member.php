<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('kota_model');
		$this->load->model('member_model');
		$this->load->helper(array('image', 'member'));
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
	
	function check_idcard_photo()
	{
		if (isset($_FILES['idcard_photo']))
		{
			if ($_FILES["idcard_photo"]["error"] == 0)
			{
				$name = md5(basename($_FILES["idcard_photo"]["name"]) . date('Y-m-d H:i:s'));
				$target_dir = "uploads/";
				$imageFileType = strtolower(pathinfo($_FILES["idcard_photo"]["name"],PATHINFO_EXTENSION));
				
				$param2 = array();
				$param2['target_file'] = $target_dir . $name . '.' . $imageFileType;
				$param2['imageFileType'] = $imageFileType;
				$param2['tmp_name'] = $_FILES["idcard_photo"]["tmp_name"];
				$param2['size'] = $_FILES["idcard_photo"]["size"];
				
				$check_image = check_image($param2);
				
				if ($check_image == 'true')
				{
					return TRUE;
				}
				else
				{
					$this->form_validation->set_message('check_idcard_photo', $check_image);
					return FALSE;
				}
			}
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
	
	function check_phone_number()
	{
		$phone_number = $this->input->post('phone_number');
		$phone_number_default = $this->input->post('phone_number_default');
		$get = $this->member_model->info(array('phone_number' => $phone_number));
		
		if ($get->code == 200 && $phone_number != $phone_number_default)
		{
			$this->form_validation->set_message('check_phone_number', '%s already registered');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function check_photo()
	{
		if (isset($_FILES['photo']))
		{
			if ($_FILES["photo"]["error"] == 0)
			{
				$name = md5(basename($_FILES["photo"]["name"]) . date('Y-m-d H:i:s'));
				$target_dir = "uploads/";
				$imageFileType = strtolower(pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION));
				
				$param2 = array();
				$param2['target_file'] = $target_dir . $name . '.' . $imageFileType;
				$param2['imageFileType'] = $imageFileType;
				$param2['tmp_name'] = $_FILES["photo"]["tmp_name"];
				$param2['size'] = $_FILES["photo"]["size"];
				
				$check_image = check_image($param2);
				
				if ($check_image == 'true')
				{
					return TRUE;
				}
				else
				{
					$this->form_validation->set_message('check_photo', $check_image);
					return FALSE;
				}
			}
		}
	}
	
	function check_username()
	{
		$username = strtolower($this->input->post('username'));
		$username_default = strtolower($this->input->post('username_default'));
		$get = $this->member_model->info(array('username' => $username));
	
		if ($get->code == 200 && $username != $username_default)
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
		$data['kota_lists'] = $this->kota_model->lists(array('limit' => 500))->result;
		$data['code_member_idcard_type'] = $this->config->item('code_member_idcard_type');
		$data['code_member_gender'] = $this->config->item('code_member_gender');
		$data['code_member_marital_status'] = $this->config->item('code_member_marital_status');
		$data['code_member_religion'] = $this->config->item('code_member_religion');
		$data['code_member_shirt_size'] = $this->config->item('code_member_shirt_size');
		$data['create_error'] = '';
		
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
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|callback_check_phone_number');
			$this->form_validation->set_rules('birth_place', 'Birth Place', 'required');
			$this->form_validation->set_rules('birth_date', 'Birth Date', 'required');
			$this->form_validation->set_rules('marital_status', 'Marital Status', 'required');
			$this->form_validation->set_rules('occupation', 'Occupation', 'required');
			$this->form_validation->set_rules('religion', 'Religion', 'required');
			$this->form_validation->set_rules('shirt_size', 'Shirt Size', 'required');
			$this->form_validation->set_rules('idcard_photo', 'ID Photo', 'callback_check_idcard_photo');
			$this->form_validation->set_rules('photo', 'Photo', 'callback_check_photo');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
				if (isset($_FILES['idcard_photo']))
				{
					$idcard_photo = check_all_photos($_FILES['idcard_photo']);
				}
				else
				{
					$idcard_photo = '-';
				}
				
				if (isset($_FILES['photo']))
				{
					$photo = check_all_photos($_FILES['photo']);
				}
				else
				{
					$photo = '-';
				}
				
				$get_member_number = $this->member_model->lists(array('order' => 'member_number', 'sort' => 'desc'));
				
				if ($get_member_number->code == 200)
				{
					$last_number = $get_member_number->result[0]->member_number;
					$next_number = $last_number + 1;
					$explode_birth_date = explode('-', $this->input->post('birth_date'));
					$month = $explode_birth_date[1];
					$year = substr($explode_birth_date[0], -2);
					$admin_initial = $this->session->userdata('initial');
					$this_year = date('y');
					$explode_name = explode(' ', strtolower($this->input->post('name')));
					
					if ($this->input->post('gender') == 0)
					{
						$gender = 'M';
					}
					else
					{
						$gender = 'F';
					}
					
					$member_number = str_pad($next_number, 5, "0", STR_PAD_LEFT);
					$member_card = $month.$year.$gender."W".$admin_initial.$this_year.$member_number;
					$username = $explode_name[0].$explode_birth_date[2].$month;
					
					$param = array();
					$param['name'] = $this->input->post('name');
					$param['email'] = $this->input->post('email');
					$param['idcard_type'] = $this->input->post('idcard_type');
					$param['idcard_number'] = $this->input->post('idcard_number');
					$param['idcard_address'] = $this->input->post('idcard_address');
					$param['shipment_address'] = $this->input->post('shipment_address');
					$param['postal_code'] = $this->input->post('postal_code');
					$param['id_kota'] = $this->input->post('id_kota');
					$param['gender'] = $this->input->post('gender');
					$param['phone_number'] = $this->input->post('phone_number');
					$param['birth_place'] = $this->input->post('birth_place');
					$param['birth_date'] = date('Y-m-d', strtotime($this->input->post('birth_date')));
					$param['marital_status'] = $this->input->post('marital_status');
					$param['occupation'] = $this->input->post('occupation');
					$param['religion'] = $this->input->post('religion');
					$param['shirt_size'] = $this->input->post('shirt_size');
					$param['idcard_photo'] = $idcard_photo;
					$param['photo'] = $photo;
					$param['status'] = 4;
					$param['member_number'] = $member_number;
					$param['member_card'] = $member_card;
					$param['username'] = $username;
					$param['password'] = $username;
					$param['approved_date'] = date('Y-m-d H:i:s');
					$query = $this->member_model->create($param);
					
					if ($query->code == 200)
					{
						redirect('member_lists');
					}
					else
					{
						$data['create_error'] = $query->result;
					}
				}
			}
		}
		
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
		$order = 'member_number';
		$sort = 'desc';
		$q = '';
		$status = $this->input->post('status');
		
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
		
        $get = $this->member_model->lists(array('q' => $q, 'status' => $status, 'limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
		$jsonData = array('total' => 0, 'results' => array());
		
		if ($get->code == 200)
		{
			$jsonData['total'] = $get->total;
			
			foreach ($get->result as $row)
			{
				$code_member_status = $this->config->item('code_member_status');
				$code_member_shirt_size = $this->config->item('code_member_shirt_size');
				
				$action = '<a title="View Detail" id="'.$row->id_member.'" class="view '.$row->id_member.'-view" href="#"><span class="glyphicon glyphicon-folder-open fontblue font16" aria-hidden="true"></span></a>&nbsp;
							<a title="Edit" href="member_edit?id='.$row->id_member.'"><span class="glyphicon glyphicon-pencil fontorange font16" aria-hidden="true"></span></a>&nbsp;
							<a title="Delete" id="'.$row->id_member.'" class="delete '.$row->id_member.'-delete" href="#"><span class="glyphicon glyphicon-remove fontred font16" aria-hidden="true"></span></a>';
				
				$entry = array(
					'no' => $i,
					'name' => ucwords($row->name),
					'email' => strtolower($row->email),
					'member_card' => strtoupper($row->member_card),
					'shirt_size' => strtoupper($code_member_shirt_size[$row->shirt_size]),
					'status' => $code_member_status[$row->status],
					'action' => $action
				);
				
				$jsonData['results'][] = $entry;
				$i++;
			}
		}
		
		echo json_encode($jsonData);
	}
	
	function member_lists()
	{
		$data = array();
		$data['code_member_status'] = $this->config->item('code_member_status');
		$data['frame_content'] = 'member/member_lists';
		$this->load->view('templates/frame', $data);
	}
}
