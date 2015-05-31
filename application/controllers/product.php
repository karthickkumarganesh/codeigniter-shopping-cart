<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();
		header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Pragma: no-cache');
		if (!$this -> session -> userdata('admin_logged_in')) {
			redirect('admin');
		}
		$this -> load -> model('category_model');
		$this -> load -> model('product_model');

	}

	public function index() {

		$data['title'] = "Product Management";
		$data['products'] = $this -> product_model -> getProductList();
		$data['categories'] = $this -> category_model -> getCategoryList();
		$this -> load -> view('common_files/header', $data);
		$this -> load -> view('common_files/admin_navbar');
		$this -> load -> view('product_view', $data);
		$this -> load -> view('common_files/footer');
	}

	public function get() {
		echo json_encode($this -> product_model -> getProduct());
	}

	public function add() {
		$this -> form_validation -> set_rules('product_name', 'Product Name', 'trim|required|xss_clean');
		$this -> form_validation -> set_rules('product_category', 'Product Category', 'trim|required|xss_clean');
		$this -> form_validation -> set_rules('product_price', 'Product Price', 'trim|required|xss_clean|decimal');
		if ($this -> form_validation -> run() == FALSE) {
			$errors = validation_errors();
			print_r(json_encode($errors));
		} else {
			if ($this -> product_model -> saveProduct()) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}

	public function edit() {

		$this -> form_validation -> set_rules('product_name', 'Product Name', 'trim|required|xss_clean');
		$this -> form_validation -> set_rules('product_category', 'Product Category', 'trim|required|xss_clean');
		$this -> form_validation -> set_rules('product_price', 'Product Price', 'trim|required|xss_clean|decimal');
		if ($this -> form_validation -> run() == FALSE) {
			$errors = validation_errors();
			print_r(json_encode($errors));
		} else {
			if ($this -> product_model -> updateProduct()) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}

	public function delete() {
		if ($this -> product_model -> deleteProduct()) {
			echo 1;
		} else {
			echo 0;
		}
	}

	public function exportProduct() {
		$this -> product_model -> exportProduct();
		
	}

}
