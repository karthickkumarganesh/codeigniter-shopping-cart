<div class="col-lg-12 col-md-6 col-sm-9">
  <div class="panel panel-default">
    <div class="panel-heading"> Product View </div>
    <div class="panel-body">
      <div>
        <button type="button" class="btn btn-success" data-toggle="modal" id="showAddProduct">Add
        Product</button>
        <a  class="btn btn-success" href="product/exportProduct"> Export</a>
        <button type="button" class="btn btn-success" data-toggle="modal" id="importproduct"> Import </button>
      </div>
      <div class="info"></div>
      <br>
      <div class="responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Product name</th>
              <th>Category</th>
              <th>Price</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php  if(count($products)>0){ foreach($products as $product){?>
            <tr>
              <td><?php echo $product->products_name;?></td>
              <td><?php echo $product->category_name;?></td>
              <td>Rs <?php echo $product->products_price;?></td>
              <td><?php if($product->products_image_path!="") {?>
                <img src="<?php echo asset_url().$product->products_image_path;?>" width="50px" height="50px" />
                <?php }else{ ?>
                <img src="<?php echo asset_url()?>product_images/noimage.jpg" width="50px" height="50px" />
                <?php } ?></td>
              <td><button type="button" class="btn btn-warning showEditProduct" data-toggle="modal" data-product-id="<?php echo $product->products_id; ?>" > Edit</button>
                <button type="button" class="btn btn-info showAddImages" data-toggle="modal" data-product-id="<?php echo $product->products_id; ?>" >Add
                Images</button>
                <button type="button" class="btn btn-danger showDeleteProduct" data-toggle="modal" data-product-id="<?php echo $product->products_id; ?>"  > Delete </button></td>
            </tr>
            <?php }}else{ ?>
             <tr><td colspan="5" align="center">No Products Found</td></tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
      </div>
      <div class="modal-body">
        <div class="error"></div>
        <?php 
	echo form_open('',array('class'=>'form-vertical','role'=>'form','id'=>'addproduct'));
	?>
        <div class="form-group">
          <label>Product Name</label>
          <div>
            <input type="text" name="product_name" id="product_name" class="form-control" >
          </div>
        </div>
        <div class="form-group">
          <label>Product Category</label>
          <div>
            <select name="product_category" id="product_category" class="form-control" >
              <option value="">Select</option>
              <?php  foreach($categories as $category){?>
              <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Product Price</label>
          <div>
            <input type="text" name="product_price" id="product_price" class="form-control" >
          </div>
        </div>
        <?php 
	 echo form_close();
	 ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="saveproduct">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Category</h4>
      </div>
      <div class="modal-body">
        <div class="error"></div>
        <?php 
	echo form_open('',array('class'=>'form-vertical','role'=>'form','id'=>'editproduct'));
	?>
        <div class="form-group">
          <label>Product Name</label>
          <div>
            <input type="text" name="product_name" id="product_name" class="form-control" >
          </div>
        </div>
        <div class="form-group">
          <label>Product Category</label>
          <div>
            <select name="product_category" id="product_category" class="form-control" >
              <option value="">Select</option>
              <?php  foreach($categories as $category){?>
              <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Product Price</label>
          <div>
            <input type="text" name="product_price" id="product_price" class="form-control" >
            <input type="hidden" id="product_id" name="product_id" />
          </div>
        </div>
        <?php 
	 echo form_close();
	 ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="updateproduct">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
<div class="modal-dialog"> 
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Images</h4>
    </div>
    <div class="modal-body">
      <div class="error"></div>
      <?php 
	echo form_open_multipart('upload/do_upload',array('class'=>'form-vertical','role'=>'form','id'=>'imagesform'));
	?>
      <div class="form-group">
        <div>
          <input type="file" name="product_images[]" class="form-control" multiple="multiple" style="width:70%">
        </div>
      </div>
      <input type="hidden" name="product_id" id="product_id" />
      <button type="submit" name="submit" value="submit" class="btn btn-success" id="saveimages" style="float:right;margin-top:-50px;">submit</button>
      <?php 
	 echo form_close();
	 ?>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>

<div id="myModal3" class="modal fade" role="dialog">
<div class="modal-dialog"> 
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Import Product</h4>
    </div>
    <div class="modal-body">
      <div class="error"></div>
      <?php 
	echo form_open_multipart('upload/do_upload_csv',array('class'=>'form-vertical','role'=>'form','id'=>'uploadcsv'));
	?>
      <div class="form-group">
        <div>
          <input type="file" name="csvfile" class="form-control"  style="width:70%">
        </div>
      </div>
      <button type="submit" name="submit" value="submit" class="btn btn-success" id="importcsv" style="float:right;margin-top:-50px;">submit</button>
      <?php 
	 echo form_close();
	 ?>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>