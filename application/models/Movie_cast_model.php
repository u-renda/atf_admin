<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie_cast_model extends CI_Model
{
    var $page = 'movie_cast';
    
    function __construct()
    {
        parent::__construct();
		$this->key = array('api_key' => $this->config->item('api_key'));
    }
    
    function create($params)
    {
        $result = null;
		$url = $this->config->item('atf_api'). $this->page . '/create';
		$params = array_merge($params, $this->key);
		$result = $this->rest->post($url, $params);
		return $result;
    }
    
    function delete($params)
    {
        $result = null;
		$url = $this->config->item('atf_api'). $this->page . '/delete';
		$params = array_merge($params, $this->key);
		$result = $this->rest->post($url, $params);
		return $result;
    }
    
    function info($params)
    {
		$result = null;
		$url = $this->config->item('atf_api'). $this->page . '/info';
		$params = array_merge($params, $this->key);
		$result = $this->rest->get($url, $params);
		return $result;
    }
    
    function lists($params)
    {
		$result = null;
		$url = $this->config->item('atf_api'). $this->page . '/lists';
		$params = array_merge($params, $this->key);
		$result = $this->rest->get($url, $params);
		return $result;
    }
    
    function update($params)
    {
        $result = null;
		$url = $this->config->item('atf_api'). $this->page . '/update';
		$params = array_merge($params, $this->key);
		$result = $this->rest->post($url, $params);
		return $result;
    }
}