<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('image');
	}
	
	function check_email()
	{
		$email = strtolower($this->input->post('email'));
		$email_default = strtolower($this->input->post('email_default'));
		$get = $this->admin_model->info(array('email' => $email));
		
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
		$get = $this->admin_model->info(array('name' => $name));
		
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
	
	function check_photo()
	{
		if (isset($_FILES['photo']))
		{
			if ($_FILES["photo"]["error"] == 0)
			{
				$name = md5(basename($_FILES["photo"]["name"]) . date('Y-m-d H:i:s'));
				$target_dir = IMAGE_HOST;
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
		$get = $this->admin_model->info(array('username' => $username));
		
		if ($get->code == 200 && $username != $username_default)
		{
			$this->form_validation->set_message('check_username', '%s already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function admin_create()
	{
		$data = array();
		$data['create_error'] = '';
		
		if ($this->input->post('submit'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required|callback_check_name');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
			$this->form_validation->set_rules('photo', 'Photo', 'callback_check_photo');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
				if (isset($_FILES['photo']))
				{
					$photo = check_all_photos($_FILES['photo']);
				}
				else
				{
					$photo = '-';
				}
				
				$param = array();
				$param['username'] = $this->input->post('username');
				$param['password'] = $this->input->post('password');
				$param['name'] = $this->input->post('name');
				$param['email'] = $this->input->post('email');
				$param['admin_role'] = 1;
				$param['admin_initial'] = $this->input->post('admin_initial');
				$param['photo'] = $photo;
				$query = $this->admin_model->create($param);
				
				if ($query->code == 200)
				{
					redirect('admin_lists');
				}
				else
				{
					$data['create_error'] = $query->result;
				}
			}
		}
		
		$data['frame_content'] = 'admin/admin_create';
		$this->load->view('templates/frame', $data);	
	}
	
	function admin_delete()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['action'] = $this->input->post('action');
		
		$get = $this->admin_model->info(array('id_admin' => $data['id']));
		
		if ($get->code == 200)
		{
			if ($this->input->post('delete'))
			{
				$param1 = array();
				$param1['id_admin'] = $data['id'];
				$query = $this->admin_model->delete($param1);
				
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
	
	function admin_edit()
	{
		$data = array();
		$data['id'] = $this->input->get_post('id');
		
		$info = $this->admin_model->info(array('id_admin' => $data['id']));
		
		$data['admin'] = $info->result;
		
		if ($info->code == 200)
		{
			if ($this->input->post('submit'))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');
				$this->form_validation->set_rules('name', 'Name', 'required|callback_check_name');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
				$this->form_validation->set_rules('photo', 'Photo', 'callback_check_photo');
				
				if ($this->form_validation->run() == FALSE)
				{
					$data['error'] = validation_errors();
				}
				else
				{
					if (isset($_FILES['photo']) && $_FILES['photo']['error'] != 4)
					{
						$photo = check_all_photos($_FILES['photo']);
					}
					else
					{
						$photo = $info->result->photo;
					}
					
					$param1 = array();
					$param1['id_admin'] = $data['id'];
					$param1['username'] = $this->input->post('username');
					$param1['name'] = $this->input->post('name');
					$param1['email'] = $this->input->post('email');
					$param1['admin_initial'] = $this->input->post('admin_initial');
					$param1['photo'] = $photo;
					$query = $this->admin_model->update($param1);
					
					if ($query->code == 200)
					{
						redirect('admin_lists');
					}
					else
					{
						$data['create_error'] = $query->result;
						$data['frame_content'] = 'admin/admin_edit';
						$this->load->view('templates/frame', $data);
					}
				}
			}
			
			$data['create_error'] = '';
			$data['frame_content'] = 'admin/admin_edit';
			$this->load->view('templates/frame', $data);
		}
		else
		{
			echo "Data Not Found";
		}
	}
	
	function admin_get()
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
		
        $get = $this->admin_model->lists(array('q' => $q, 'limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
		$jsonData = array('data' => array(), 'total' => 0);
		
		if ($get->code == 200)
		{
			$jsonData['total'] = $get->total;
			
			foreach ($get->result as $row)
			{
				$action = '<a title="View Detail" id="'.$row->id_admin.'" class="view '.$row->id_admin.'-view" href="#"><span class="glyphicon glyphicon-folder-open fontblue font16" aria-hidden="true"></span></a>&nbsp;
							<a title="Edit" href="admin_edit?id='.$row->id_admin.'"><span class="glyphicon glyphicon-pencil fontorange font16" aria-hidden="true"></span></a>&nbsp;
							<a title="Delete" id="'.$row->id_admin.'" class="delete '.$row->id_admin.'-delete" href="#"><span class="glyphicon glyphicon-remove fontred font16" aria-hidden="true"></span></a>';
				
				$entry = array(
					'No' => $i,
					'Name' => ucwords($row->name),
					'Email' => $row->email,
					'Username' => $row->username,
					'AdminRole' => $row->admin_role,
					'Action' => $action
				);
				
				$jsonData['data'][] = $entry;
				$i++;
			}
		}
		
		echo json_encode($jsonData);
	}
	
	function admin_lists()
	{
		$data = array();
		$data['frame_content'] = 'admin/admin_lists';
		$this->load->view('templates/frame', $data);
	}
}
