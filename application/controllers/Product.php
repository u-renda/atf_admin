<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
		
		$this->load->model('movie_cast_model');
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
		$data['id_movie_cast'] = $this->input->get_post('id_movie_cast');
		
		if ($this->input->post('submit') || $this->input->post('submit_another'))
		{
			$this->load->library('form_validation');
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
				$param['id_movie_cast'] = $data['id_movie_cast'];
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
					if ($this->input->post('submit_another') == TRUE)
					{
						redirect($this->config->item('link_product_create').'?id_movie_cast='.$data['id_movie_cast']);
					}
					else
					{
						redirect($this->config->item('link_product_lists').'?alert=success&type=create');
					}
				}
				else
				{
					$data['create_error'] = $query->result;
				}
			}
		}
		
		$query3 = $this->product_brand_model->lists(array('order' => 'name', 'sort' => 'asc'));
		$query4 = $this->product_category_model->lists(array('order' => 'name', 'sort' => 'asc'));
		$query5 = $this->product_subcategory_model->lists(array('order' => 'name', 'sort' => 'asc'));
		$get_movie_cast = $this->movie_cast_model->info(array('id_movie_cast' => $data['id_movie_cast']));
		
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
		
		if ($get_movie_cast->code == 200)
		{
			$data['movie_cast'] = $get_movie_cast->result;
		}
		
		$data['code_product_matched'] = $this->config->item('code_product_matched');
		$data['frame_content'] = 'product/product_create';
		$this->load->view('templates/frame', $data);
	}
	
	function product_delete()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['action'] = $this->input->post('action');
		$data['grid'] = $this->input->post('grid');
		
		$get = $this->product_model->info(array('id_product' => $data['id']));
		
		if ($get->code == 200)
		{
			if ($this->input->post('delete') == TRUE)
			{
				$query = $this->product_model->delete(array('id_product' => $data['id']));
				
				if ($query->code == 200)
				{
					$response =  array('msg' => 'Delete data success', 'type' => 'success', 'title' => 'Product');
				}
				else
				{
					$response =  array('msg' => 'Delete data failed', 'type' => 'error', 'title' => 'Product');
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
				$this->form_validation->set_rules('id_product_brand', 'brand', 'required');
				$this->form_validation->set_rules('id_product_subcategory', 'category', 'required');
				$this->form_validation->set_rules('name', 'name', 'required');
				$this->form_validation->set_rules('price', 'price', 'required');
				$this->form_validation->set_rules('url', 'url', 'required');
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
					
					$param['id_product'] = $data['id'];
					$param['id_movie_cast'] = $this->input->post('id_movie_cast');
					$param['id_product_brand'] = $this->input->post('id_product_brand');
					$param['id_product_subcategory'] = $this->input->post('id_product_subcategory');
					$param['name'] = $this->input->post('name');
					$param['price'] = $this->input->post('price');
					$param['matched'] = $this->input->post('matched');
					$param['url'] = $this->input->post('url');
					$query = $this->product_model->update($param);
					
					if ($query->code == 200)
					{
						redirect($this->config->item('link_product_lists').'?alert=success&type=edit');
					}
					else
					{
						$data['create_error'] = $query->result;
						$data['frame_content'] = 'product/product_edit';
						$this->load->view('templates/frame', $data);
					}
				}
			}
			
			$query3 = $this->product_brand_model->lists(array('order' => 'name', 'sort' => 'asc'));
			$query4 = $this->product_category_model->lists(array('order' => 'name', 'sort' => 'asc'));
			$query5 = $this->product_subcategory_model->lists(array('order' => 'name', 'sort' => 'asc'));
			
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
			
			$data['code_product_matched'] = $this->config->item('code_product_matched');
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
				$action = '<a title="View Detail" id="'.$row->id_product.'" class="view '.$row->id_product.'-view" href="#"><i class="fa fa-folder-open fontblue font16"></i></a>&nbsp;
							<a title="Edit" href="product_edit?id='.$row->id_product.'"><i class="fa fa-pencil fontorange font16"></i></a>&nbsp;
							<a title="Product Loved" href="member_love_lists?id_product='.$row->id_product.'"><i class="fa fa-heart fontpink font16"></i></a>&nbsp;
							<a title="Wishlists" href="member_wishlist_lists?id_product='.$row->id_product.'"><i class="fa fa-list fontblack font16"></i></a>&nbsp;
							<a title="Delete" id="'.$row->id_product.'" class="delete '.$row->id_product.'-delete" href="#"><i class="fa fa-times fontred font16"></i></a>';
				
				$matched = '';
				if ($row->matched == 1)
				{
					$matched = '<span class="label label-success" title="Matched"><i class="fa fa-thumbs-up"></i></span>';
				}
				
				$name = ucwords($row->name).' '.$matched;
				$photo = '<img src="'.$row->photo.'" width="150">';
				
				$entry = array(
					'No' => $i,
					'ProductName' => $name,
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
		$data['alert'] = '';
		
		if ($this->input->get('alert') == 'success')
		{
			$data['alert'] = $this->input->get('type').' data success';
		}
		
		$data['frame_content'] = 'product/product_lists';
		$this->load->view('templates/frame', $data);
	}
	
	function product_view()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['action'] = $this->input->post('action');
		
		$get = $this->product_model->info(array('id_product' => $data['id']));
		
		if ($get->code == 200)
		{
			$data['result'] = $get->result;
			$this->load->view('product/product_view', $data);
		}
		else
		{
			echo "Data Not Found";
		}
	}
}
