<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/* File Name : product_model.php
 * Author:Karthick Kumar
 * Description: product management
 * Created Date:30-05-2015
 * Modified Date:31-05-2015
 */
class Product_Model extends CI_Model {

	public function getProductList() {
		$this -> db -> select('*');
		$this -> db -> from('products');
		$this -> db -> join('category', 'category.category_id = products.products_category_id');
		$this -> db -> join('products_image', 'products_image.products_ref_id = products.products_id', 'left');
		$this -> db -> group_by("products.products_id");
		$query = $this -> db -> get();
		$results = $query -> result();

		return $results;
	}

	public function getProduct() {
		$query = $this -> db -> get_where('products', array('products_id' => $this -> input -> post('product_id')));
		if ($query -> num_rows() == 1) {
			$results = $query -> row();
			return $results;

		} else {
			return 0;
		}
	}

	public function saveProduct() {
		$productname = $this -> input -> post('product_name');
		$productcategory = $this -> input -> post('product_category');
		$productprice = $this -> input -> post('product_price');
		if ($this -> db -> insert('products', array('products_name' => $productname, 'products_category_id' => $productcategory, 'products_price' => $productprice))) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	public function updateProduct() {
		$productname = $this -> input -> post('product_name');
		$productcategory = $this -> input -> post('product_category');
		$productprice = $this -> input -> post('product_price');
		$productid = $this -> input -> post('product_id');
		$data = array('products_name' => $productname, 'products_category_id' => $productcategory, 'products_price' => $productprice);

		$this -> db -> where('products_id', $productid);
		// $this -> db -> update('category', $data);
		if ($this -> db -> update('products', $data)) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	public function deleteProduct() {
		$productid = $this -> input -> post('product_id');
		if ($this -> db -> delete('products', array('products_id' => $productid))) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function productImageSave($data = null) {
		foreach ($data['upload_data'] as $images) {
			$imagename = 'product_images/' . $images['file_name'];
			$productid = $data['product_id'];

			$this -> db -> insert('products_image', array('products_ref_id' => $productid, 'products_image_path' => $imagename));
		}
	}

	public function exportProduct() {
		$this -> load -> dbutil();

		$query = $this -> db -> query("SELECT * FROM products");

		$data = $this -> dbutil -> csv_from_result($query);
		write_file('./assets/csv/products.csv', $data);
		force_download('products.csv', $data);
	}

	public function importProduct($data = null) {
		$filename = $data['upload_data']['file_name'];
		//file_get_contents('./assets/import_csv/'.$filename);
		$file = fopen('./assets/import_csv/' . $filename, "r");
		$i = 0;
		while (!feof($file)) {
			if ($i != 0) {
				$arraydata = fgetcsv($file);
				$productname = $arraydata[0];
				$productcategory = $arraydata[2];
				$productprice = $arraydata[1];
				$this -> db -> insert('products', array('products_name' => $productname, 'products_category_id' => $productcategory, 'products_price' => $productprice));
			}
			$i++;
		}

		fclose($file);
	}

	public function getImages() {
		$productid = $this -> input -> post('product_id');
		$query = $this -> db -> get_where('products_image', array('products_ref_id' => $productid));
		print_r(json_encode($query -> result_array()));
	}

	public function addtocart() {
		$productid = $this -> input -> post('product_id');
		$quantity = $this -> input -> post('quantity');
		$this -> db -> where('products_id', $productid);

		$query = $this -> db -> get('products', 1);

		$result = $query -> row();

		$data = array('id' => $productid, 'qty' => $quantity, 'price' => $result -> products_price, 'name' => $result -> products_name);

		if ($this -> cart -> insert($data)) {
			return TRUE;
		} else {
			return FALSE;
		}
		//print_r($this -> cart -> contents());

	}

	public function orderRefId() {
		$length = 15;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function purchase() {
		$orderrefid = $this -> orderRefId();
		$carts = $this -> cart -> contents();
		$userid = $this -> session -> userdata('user_id');
		foreach ($carts as $cart) {
			$productid = $cart['id'];
			$userid = $userid;
			$order_ref_id = $orderrefid;
			$quantity = $cart['qty'];
			$price = $cart['price'];
			$total = $cart['subtotal'];

			$this -> db -> insert('orders', array('order_ref_id' => $order_ref_id, 'user_ref_id' => $userid, 'product_ref_id' => $productid, 'product_quantity' => $quantity, 'product_price' => $price, 'total' => $total));
		}
		$this -> cart -> destroy();
		return TRUE;

	}

	public function orders() {
		$userid = $this -> session -> userdata('user_id');
		$this -> db -> select('sum(orders.total) as totalamount,group_concat(products.products_name) as productname,sum(orders.product_quantity) as totalquantity,orders.order_ref_id');
		$this -> db -> from('orders');
		$this -> db -> where(array('orders.user_ref_id' => $userid));
		$this -> db -> join('products', 'products.products_id = orders.product_ref_id');

		$this -> db -> group_by("orders.order_ref_id");
		$query = $this -> db -> get();
		$results = $query -> result();
		return $results;
	}

}
?>