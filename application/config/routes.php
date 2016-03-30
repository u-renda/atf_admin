<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'login/index';
$route['logout'] = 'login/logout';

$route['dashboard'] = 'home/dashboard';

$route['member_create'] = 'member/member_create';
$route['member_delete'] = 'member/member_delete';
$route['member_edit'] = 'member/member_edit';
$route['member_get'] = 'member/member_get';
$route['member_lists'] = 'member/member_lists';

$route['admin_create'] = 'admin/admin_create';
$route['admin_delete'] = 'admin/admin_delete';
$route['admin_edit'] = 'admin/admin_edit';
$route['admin_get'] = 'admin/admin_get';
$route['admin_lists'] = 'admin/admin_lists';

$route['movie_create'] = 'movie/movie_create';
$route['movie_delete'] = 'movie/movie_delete';
$route['movie_edit'] = 'movie/movie_edit';
$route['movie_get'] = 'movie/movie_get';
$route['movie_lists'] = 'movie/movie_lists';

$route['movie_cast_create'] = 'movie_cast/movie_cast_create';
$route['movie_cast_delete'] = 'movie_cast/movie_cast_delete';
$route['movie_cast_edit'] = 'movie_cast/movie_cast_edit';
$route['movie_cast_get'] = 'movie_cast/movie_cast_get';
$route['movie_cast_lists'] = 'movie_cast/movie_cast_lists';

$route['product_create'] = 'product/product_create';
$route['product_delete'] = 'product/product_delete';
$route['product_edit'] = 'product/product_edit';
$route['product_get'] = 'product/product_get';
$route['product_lists'] = 'product/product_lists';

$route['product_brand_create'] = 'product_brand/product_brand_create';
$route['product_brand_delete'] = 'product_brand/product_brand_delete';
$route['product_brand_edit'] = 'product_brand/product_brand_edit';
$route['product_brand_get'] = 'product_brand/product_brand_get';
$route['product_brand_lists'] = 'product_brand/product_brand_lists';

$route['product_category_create'] = 'product_category/product_category_create';
$route['product_category_delete'] = 'product_category/product_category_delete';
$route['product_category_edit'] = 'product_category/product_category_edit';
$route['product_category_get'] = 'product_category/product_category_get';
$route['product_category_lists'] = 'product_category/product_category_lists';