<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Movie_cast extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
		
		$this->load->model('movie_cast_model');
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
	
	function movie_cast_create()
	{
		$data = array();
		$data['create_error'] = '';
		$data['id_movie'] = $this->input->get_post('id_movie');
		
		if ($this->input->post('submit'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('actor', 'actor', 'required');
			$this->form_validation->set_rules('cast', 'cast', 'required');
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
					if ($_FILES["photo"]["error"] == 0)
					{
						$name = md5(basename($_FILES["photo"]["name"]) . date('Y-m-d H:i:s'));
						$imageFileType = strtolower(pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION));
						$photo = IMAGE_HOST . $name . '.' . $imageFileType;
					}
				}
					
				$param = array();
				$param['id_movie'] = $data['id_movie'];
				$param['actor'] = $this->input->post('actor');
				$param['cast'] = $this->input->post('cast');
				$param['photo'] = $photo;
				$query = $this->movie_cast_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_movie_cast_lists').'?alert=success&type=create&id_movie='.$data['id_movie']);
				}
				else
				{
					$data['create_error'] = $query->result;
				}
			}
		}
		
		$get_movie = $this->movie_model->info(array('id_movie' => $data['id_movie']));
		
		if ($get_movie->code == 200)
		{
			$data['movie'] = $get_movie->result;
		}
		
		$data['frame_content'] = 'movie_cast/movie_cast_create';
		$this->load->view('templates/frame', $data);
	}
	
	function movie_cast_delete()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['action'] = $this->input->post('action');
		$data['grid'] = $this->input->post('grid');
		
		$get = $this->movie_cast_model->info(array('id_movie_cast' => $data['id']));
		
		if ($get->code == 200)
		{
			if ($this->input->post('delete') == TRUE)
			{
				$query = $this->movie_cast_model->delete(array('id_movie_cast' => $data['id']));
				
				if ($query->code == 200)
				{
					$response =  array('msg' => 'Delete data success', 'type' => 'success', 'title' => 'Movie Cast');
				}
				else
				{
					$response =  array('msg' => 'Delete data failed', 'type' => 'error', 'title' => 'Movie Cast');
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
	
	function movie_cast_edit()
	{
		$data = array();
		$data['id'] = $this->input->get_post('id');
		
		$info = $this->movie_cast_model->info(array('id_movie_cast' => $data['id']));
		
		$data['movie_cast'] = $info->result;
		
		if ($info->code == 200)
		{
			if ($this->input->post('submit'))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('actor', 'actor', 'required');
				$this->form_validation->set_rules('cast', 'cast', 'required');
				$this->form_validation->set_rules('photo', 'photo', 'callback_check_photo');
			
				if ($this->form_validation->run() == FALSE)
				{
					$data['create_error'] = validation_errors();
				}
				else
				{
					$param = array();
					if (isset($_FILES['photo']))
					{
						$param['photo'] = check_all_photos($_FILES['photo']);
					}
					
					$param['id_movie_cast'] = $data['id'];
					$param['actor'] = $this->input->post('actor');
					$param['cast'] = $this->input->post('cast');
					$query = $this->movie_cast_model->update($param);
					
					if ($query->code == 200)
					{
						$id_movie = $data['movie_cast']->movie->id_movie;
						redirect($this->config->item('link_movie_cast_lists').'?alert=success&type=edit&id_movie='.$id_movie);
					}
					else
					{
						$data['create_error'] = $query->result;
						$data['frame_content'] = 'movie_cast/movie_cast_edit';
						$this->load->view('templates/frame', $data);
					}
				}
			}
			
			$data['create_error'] = '';
			$data['frame_content'] = 'movie_cast/movie_cast_edit';
			$this->load->view('templates/frame', $data);
		}
		else
		{
			echo "Data Not Found";
		}
	}
	
	function movie_cast_get()
	{
		$page = $this->input->post('page') ? $this->input->post('page') : 1;
		$pageSize = $this->input->post('pageSize') ? $this->input->post('pageSize') : 20;
		$offset = ($page - 1) * $pageSize;
		$i = $offset * 1 + 1;
		$order = 'name';
		$sort = 'asc';
		$q = '';
		$id_movie = $this->input->post('id_movie') ? $this->input->post('id_movie') : '';
		
		if ($this->input->post('sort') == TRUE)
		{
			$order = $_POST['sort'][0]['field'];
			$sort = $_POST['sort'][0]['dir'];
		}
		
		if ($this->input->post('filter') == TRUE)
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
		
        $get = $this->movie_cast_model->lists(array('id_movie' => $id_movie, 'q' => $q, 'limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
		$jsonData = array('data' => array(), 'total' => 0);
		
		if ($get->code == 200)
		{
			$jsonData['total'] = $get->total;
			
			foreach ($get->result as $row)
			{
				$action = '<a title="Edit" href="movie_cast_edit?id='.$row->id_movie_cast.'"><i class="fa fa-pencil fontorange font16"></i></a>&nbsp;
							<a title="Add Product" href="product_create?id_movie_cast='.$row->id_movie_cast.'"><i class="fa fa-plus text-success font16"></i></a>&nbsp;
							<a title="Delete" id="'.$row->id_movie_cast.'" class="delete '.$row->id_movie_cast.'-delete" href="#"><i class="fa fa-times fontred font16"></i></a>';
				
				$photo = '<img src="'.$row->photo.'" width="150">';
				$actor = ucwords($row->cast).' ('.ucwords($row->actor).')';
				
				$entry = array(
					'No' => $i,
					'Actor' => $actor,
					'Movie' => ucwords($row->movie->title),
					'Photo' => $photo,
					'Action' => $action
				);
				
				$jsonData['data'][] = $entry;
				$i++;
			}
		}
		else
		{
			echo "disinilah";
		}
		
		echo json_encode($jsonData);
	}
	
	function movie_cast_lists()
	{
		$data = array();
		$data['id_movie'] = $this->input->get_post('id_movie');
		$data['alert'] = '';
		
		$query = $this->movie_model->info(array('id_movie' => $data['id_movie']));
		
		if ($query->code == 200)
		{
			$data['movie'] = $query->result;
		}
		
		if ($this->input->get('alert') == 'success')
		{
			$data['alert'] = $this->input->get('type').' data success';
		}
		
		$data['frame_content'] = 'movie_cast/movie_cast_lists';
		$this->load->view('templates/frame', $data);
	}
}
