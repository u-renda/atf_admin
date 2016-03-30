<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
		
		$this->load->model('movie_model');
		$this->load->model('product_brand_model');
		$this->load->model('product_category_model');
		$this->load->model('product_model');
		$this->load->model('product_subcategory_model');
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
	
	function product_create()
	{
		$data = array();
		$data['create_error'] = '';
		
		if ($this->input->post('submit'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_movie', 'movie', 'required');
			$this->form_validation->set_rules('id_product_brand', 'brand', 'required');
			$this->form_validation->set_rules('id_product_subcategory', 'category', 'required');
			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('price', 'price', 'required');
			$this->form_validation->set_rules('url', 'url', 'required');
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
				$param['id_movie'] = $this->input->post('id_movie');
				$param['id_product_brand'] = $this->input->post('id_product_brand');
				$param['id_product_subcategory'] = $this->input->post('id_product_subcategory');
				$param['name'] = $this->input->post('name');
				$param['price'] = $this->input->post('price');
				$param['matched'] = $this->input->post('matched');
				$param['url'] = $this->input->post('url');
				$param['photo'] = $photo;
				$query = $this->product_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_product_lists'));
				}
				else
				{
					$data['create_error'] = $query->result;
				}
			}
		}
		
		$query2 = $this->movie_model->lists(array());
		$query3 = $this->product_brand_model->lists(array());
		$query4 = $this->product_category_model->lists(array());
		$query5 = $this->product_subcategory_model->lists(array());
		
		if ($query2->code == 200)
		{
			$data['movie_lists'] = $query2->result;
		}
		
		if ($query3->code == 200)
		{
			$data['product_brand_lists'] = $query3->result;
		}
		
		if ($query4->code == 200)
		{
			$data['product_category_lists'] = $query4->result;
		}
		
		if ($query5->code == 200)
		{
			$data['product_subcategory_lists'] = $query5->result;
		}
		
		$data['frame_content'] = 'product/product_create';
		$this->load->view('templates/frame', $data);
	}
	
	function product_delete()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['action'] = $this->input->post('action');
		
		$get = $this->product_model->info(array('id_product' => $data['id']));
		
		if ($get->code == 200)
		{
			if ($this->input->post('delete'))
			{
				$param1 = array();
				$param1['id_product'] = $data['id'];
				$query = $this->product_model->delete($param1);
				
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
	
	function product_edit()
	{
		$data = array();
		$data['id'] = $this->input->get_post('id');
		
		$info = $this->product_model->info(array('id_product' => $data['id']));
		
		$data['product'] = $info->result;
		
		if ($info->code == 200)
		{
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
						if ($_FILES["photo"]["error"] == 0)
						{
							$name = md5(basename($_FILES["photo"]["name"]) . date('Y-m-d H:i:s'));
							$imageFileType = strtolower(pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION));
							$photo = IMAGE_HOST . $name . '.' . $imageFileType;
						}
					}
					
					$param1 = array();
					$param1['id_product'] = $data['id'];
					$param1['title'] = $this->input->post('title');
					$param1['photo'] = $photo;
					$query = $this->product_model->update($param1);
					
					if ($query->code == 200)
					{
						redirect($this->config->item('link_product_lists'));
					}
					else
					{
						$data['create_error'] = $query->result;
						$data['frame_content'] = 'product/product_edit';
						$this->load->view('templates/frame', $data);
					}
				}
			}
			
			$data['create_error'] = '';
			$data['frame_content'] = 'product/product_edit';
			$this->load->view('templates/frame', $data);
		}
		else
		{
			echo "Data Not Found";
		}
	}
	
	function product_get()
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
		
        $get = $this->product_model->lists(array('q' => $q, 'limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
		$jsonData = array('data' => array(), 'total' => 0);
		
		if ($get->code == 200)
		{
			$jsonData['total'] = $get->total;
			
			foreach ($get->result as $row)
			{
				$action = '<a title="View Detail" id="'.$row->id_product.'" class="view '.$row->id_product.'-view" href="#"><span class="glyphicon glyphicon-folder-open fontblue font16" aria-hidden="true"></span></a>&nbsp;
							<a title="Edit" href="product_edit?id='.$row->id_product.'"><span class="glyphicon glyphicon-pencil fontorange font16" aria-hidden="true"></span></a>&nbsp;
							<a title="Delete" id="'.$row->id_product.'" class="delete '.$row->id_product.'-delete" href="#"><span class="glyphicon glyphicon-remove fontred font16" aria-hidden="true"></span></a>';
				
				$matched = '';
				if ($row->matched == 1)
				{
					$matched = '<span class="label label-success"><i class="fa fa-thumbs-up"></i></span>';
				}
				
				$name = ucwords($row->name).' '.$matched;
				$photo = '<img src="'.$row->photo.'" width="150">';
				
				$entry = array(
					'No' => $i,
					'MovieTitle' => ucwords($row->movie->title),
					'ProductBrand' => ucwords($row->brand->name),
					'Name' => $name,
					'Photo' => $photo,
					'Price' => number_format($row->price,0,'','.'),
					'Matched' => $matched,
					'Action' => $action
				);
				
				$jsonData['data'][] = $entry;
				$i++;
			}
		}
		
		echo json_encode($jsonData);
	}
	
	function product_lists()
	{
		$data = array();
		$data['frame_content'] = 'product/product_lists';
		$this->load->view('templates/frame', $data);
	}
}
