<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
		
		$this->load->model('movie_model');
	}
	
	function check_photo()
	{
		if (isset($_FILES['photo']))
		{
			if ($_FILES["photo"]["error"] == 0)
			{
				$name = md5(basename($_FILES["photo"]["name"]) . date('Y-m-d H:i:s'));
				$target_dir = IMAGE_FOLDER;
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
	
	function movie_create()
	{
		$data = array();
		$data['create_error'] = '';
		
		if ($this->input->post('submit'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_rules('photo', 'photo', 'callback_check_photo');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
				$photo = '-';
				if (isset($_FILES['photo']))
				{
					$photo = check_all_photos($_FILES['photo']);
				}
					
				$param = array();
				$param['title'] = $this->input->post('title');
				$param['photo'] = $photo;
				$query = $this->movie_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_movie_lists').'?alert=success&type=create');
				}
				else
				{
					$data['create_error'] = $query->result;
				}
			}
		}
		
		$data['frame_content'] = 'movie/movie_create';
		$this->load->view('templates/frame', $data);
	}
	
	function movie_delete()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['action'] = $this->input->post('action');
		
		$get = $this->movie_model->info(array('id_movie' => $data['id']));
		
		if ($get->code == 200)
		{
			if ($this->input->post('delete'))
			{
				$param1 = array();
				$param1['id_movie'] = $data['id'];
				$query = $this->movie_model->delete($param1);
				
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
	
	function movie_edit()
	{
		$data = array();
		$data['id'] = $this->input->get_post('id');
		
		$info = $this->movie_model->info(array('id_movie' => $data['id']));
		
		$data['movie'] = $info->result;
		
		if ($info->code == 200)
		{
			if ($this->input->post('submit'))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('title', 'title', 'required');
				$this->form_validation->set_rules('photo', 'photo', 'callback_check_photo');
			
				if ($this->form_validation->run() == FALSE)
				{
					$data['create_error'] = validation_errors();
				}
				else
				{
					$param1 = array();
					if (isset($_FILES['photo']))
					{
						$param1['photo'] = check_all_photos($_FILES['photo']);
					}
					
					$param1['id_movie'] = $data['id'];
					$param1['title'] = $this->input->post('title');
					$query = $this->movie_model->update($param1);
					
					if ($query->code == 200)
					{
						redirect($this->config->item('link_movie_lists').'?alert=success&type=edit');
					}
					else
					{
						$data['create_error'] = $query->result;
						$data['frame_content'] = 'movie/movie_edit';
						$this->load->view('templates/frame', $data);
					}
				}
			}
			
			$data['create_error'] = '';
			$data['frame_content'] = 'movie/movie_edit';
			$this->load->view('templates/frame', $data);
		}
		else
		{
			echo "Data Not Found";
		}
	}
	
	function movie_get()
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
		
        $get = $this->movie_model->lists(array('q' => $q, 'limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
		$jsonData = array('data' => array(), 'total' => 0);
		
		if ($get->code == 200)
		{
			$jsonData['total'] = $get->total;
			
			foreach ($get->result as $row)
			{
				$action = '<a title="Edit" href="movie_edit?id='.$row->id_movie.'"><i class="fa fa-pencil fontorange font16"></i></a>&nbsp;
							<a title="View Cast" href="movie_cast_lists?id_movie='.$row->id_movie.'"><i class="fa fa-users fontblue font16"></i></a>&nbsp;
							<a title="Add Cast" href="movie_cast_create?id_movie='.$row->id_movie.'"><i class="fa fa-plus text-success font16"></i></a>&nbsp;
							<a title="Delete" id="'.$row->id_movie.'" class="delete '.$row->id_movie.'-delete" href="#"><i class="fa fa-times fontred font16"></i></a>';
				
				$photo = '<img src="'.$row->photo.'" width="150">';
				
				$entry = array(
					'No' => $i,
					'Title' => ucwords($row->title),
					'Photo' => $photo,
					'Action' => $action
				);
				
				$jsonData['data'][] = $entry;
				$i++;
			}
		}
		
		echo json_encode($jsonData);
	}
	
	function movie_lists()
	{
		$data = array();
		$data['alert'] = '';
		
		if ($this->input->get('alert') == 'success')
		{
			$data['alert'] = $this->input->get('type').' data success';
		}
		
		$data['frame_content'] = 'movie/movie_lists';
		$this->load->view('templates/frame', $data);
	}
}
