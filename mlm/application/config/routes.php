<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
|
 
*/
$route['default_controller'] = 'AdminLoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['authlogincheck'] = 'AdminLoginController/ovecab_seatsellers_authlogincheck';
$route['admin-logout'] = 'AdminLoginController/seatsellers_logout';
$route['v3/profile'] = 'AdminLoginController/user_profile';
$route['upload-profile'] = 'AdminLoginController/change_photo';
$route['profile-password-update'] = 'AdminLoginController/change_user_profile_password_update';
$route['profile-details-update'] = 'AdminLoginController/user_update_profile_data';
$route['i-forgot-my-password'] = 'AdminLoginController/forgot_password';
$route['forgot-password'] = 'AdminLoginController/forgot_password_email';
 

/////
$route['v3/dashboard'] = 'DashboardController/index';

$route['v3/add-product'] = 'ProductController/index';
$route['add_product'] = 'ProductController/add_product';
$route['v3/product-list'] = 'ProductController/product_list_template';
$route['product-grid-data'] = 'ProductController/product_grid_data';
$route['v3/product-view'] = 'ProductController/product_view';
$route['edit_product'] = 'ProductController/edit_product';
$route['trash-product'] = 'ProductController/product_trash';



$route['v3/add-order'] = 'OrderController/index';
$route['v3/order-list'] = 'OrderController/order_list_template';
$route['get_product_detail'] = 'OrderController/get_product_detail';
$route['get_member_detail'] = 'OrderController/get_member_details';
$route['add_order'] = 'OrderController/add_order';
$route['order-grid-data'] = 'OrderController/order_grid_data';
$route['trash-order'] = 'OrderController/order_trash';

 



$route['v3/customer-list'] = 'CustomerController/index';
$route['customer-grid-data'] = 'CustomerController/customer_grid_data';
$route['trash-member'] = 'CustomerController/trash';





 
$route['v3/member-net-sale-view'] = 'Member/view_member_template';
$route['v3/member-net-sale-view-chart'] = 'Member/login_customer_view';

$route['v3/member-net-sale-json'] = 'Member/json';
$route['v3/member-net-sale-infinity'] = 'Member/Parent';


$route['v3/invoice/generate'] = 'InvoiceController/index';
$route['v3/invoice/search'] = 'InvoiceController/index';
$route['v3/invoice/print'] = 'InvoiceController/index';
$route['v3/invoice/print-view'] = 'InvoiceController/print_view';
$route['genreate_invoice_html'] = 'InvoiceController/genreate_invoice_html';

$route['v3/purchase-product'] = 'PurchaseController/index';
$route['add-purchase-product'] = 'PurchaseController/add_product';
$route['purchase-product-grid-data'] = 'PurchaseController/purchase_product_grid_data';
$route['product_view'] = 'PurchaseController/product_view';
$route['edit-purchase-product'] = 'PurchaseController/edit_product';
$route['trash-purchase-product'] = 'PurchaseController/product_trash';




$route['excel-purchase-product'] = 'ExcelController/index_purchase_products';


$route['v3/category-list'] = 'CategoryController/index';
$route['add-category'] = 'CategoryController/add_category';
$route['category-grid-data'] = 'CategoryController/category_grid_data';
$route['category_view'] = 'CategoryController/category_view';
$route['edit-category'] = 'CategoryController/edit_category';
$route['trash-category'] = 'CategoryController/category_trash';




$route['v3/settings'] = 'SettingsController/index';
$route['settings-update-tax'] = 'SettingsController/update_tax';






 
 



