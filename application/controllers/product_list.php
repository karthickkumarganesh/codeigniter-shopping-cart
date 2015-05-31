<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Product_List extends CI_Controller {

	public function __construct() {
		parent::__construct();
		header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Pragma: no-cache');
		if (!$this -> session -> userdata('user_logged_in')) {
			redirect('user');
		}
		$this -> load -> model('product_model');

	}

	public function index() {

		$data['title'] = "Product List";
		$data['products'] = $this -> product_model -> getProductList();
		$this -> load -> view('common_files/header', $data);
		$this -> load -> view('common_files/navbar_alogin');
		$this -> load -> view('product_user_list', $data);
		$this -> load -> view('common_files/footer');
	}

	public function get() {
		echo json_encode($this -> product_model -> getProduct());
	}

	public function getImages() {
		$this -> product_model -> getImages();

	}

	public function addtocart() {
		if ($this -> product_model -> addtocart()) {
			echo 1;
		} else {
			echo 0;
		}
	}

	public function cart() {
		$data['carts'] = $this -> cart -> contents();

		$data['title'] = "cart";
		$this -> load -> view('common_files/header', $data);
		$this -> load -> view('common_files/navbar_alogin');
		$this -> load -> view('cart', $data);
		$this -> load -> view('common_files/footer');
	}

	public function purchase() {
		if ($this -> product_model -> purchase()) {
			$this -> session -> set_flashdata('message', 'Order is successful');
			redirect('product_list/cart');
		}
	}

	public function orders() {
		$data['title'] = "Orders";
		$data['orders'] = $this -> product_model -> orders();
		$this -> load -> view('common_files/header', $data);
		$this -> load -> view('common_files/navbar_alogin');
		$this -> load -> view('orders', $data);
		$this -> load -> view('common_files/footer');
	}

}
