<?php

class Upload extends CI_Controller {

	public function __construct() {

		parent::__construct();
		// Load the helpers
		$this -> load -> model('product_model');
	}

	public function do_upload() {

		// Detect form submission.
		if ($this -> input -> post('submit')) {
			$data['product_id'] = $this -> input -> post('product_id');
			$path = './assets/product_images/';

			$this -> upload -> initialize(array("upload_path" => $path, "allowed_types" => "gif|jpg|png", "max_size" => '15000'));

			if ($this -> upload -> do_multi_upload("product_images")) {

				$data['upload_data'] = $this -> upload -> get_multi_upload_data();
				$this -> product_model -> productImageSave($data);
				echo '' . count($data['upload_data']) . 'File(s) successfully uploaded.';

			} else {
				
				$errors = array('error' => $this -> upload -> display_errors('<p class = "bg-danger">', '</p>'));

				foreach ($errors as $k => $error) {
					echo $error;
				}

			}

		} else {
			echo '<p class = "bg-danger">An error occured, please try again later.</p>';

		}
		
		exit();
	}

	public function do_upload_csv() {

		
		if ($this -> input -> post('submit')) {
			
			$path = './assets/import_csv/';

			$this -> upload -> initialize(array("upload_path" => $path, "allowed_types" => "csv", "max_size" => '1000'));

			if ($this -> upload -> do_upload("csvfile")) {

				$data['upload_data'] = $this -> upload -> data();
				$this -> product_model -> importProduct($data);
				echo 'Product import successfully';

			} else {
				// Output the errors
				$errors = array('error' => $this -> upload -> display_errors('<p class = "bg-danger">', '</p>'));

				foreach ($errors as $k => $error) {
					echo $error;
				}

			}

		} else {
			echo '<p class = "bg-danger">An error occured, please try again later.</p>';

		}
		
		exit();
	}

}
