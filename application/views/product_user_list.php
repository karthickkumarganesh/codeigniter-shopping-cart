<div class="col-lg-12 col-md-6 col-sm-9">
  <div class="panel panel-default">
    <div class="panel-heading"> Product View </div>
    <div class="panel-body">
      <div>
        
      <div class="info"></div>
      <br>
      <div class="responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Product name</th>
              <th>Category</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($products)>0){ foreach($products as $product){?>
            <tr>
              <td><?php echo $product -> products_name; ?></td>
              <td><?php echo $product -> category_name; ?></td>
              <td>Rs <?php echo $product -> products_price; ?></td>
              <td><select name="quantity_<?php echo $product -> products_id; ?>" id="quantity_<?php echo $product -> products_id; ?>"><option value="1">1</option>
              	<option value="2">2</option>
              	<option value="3">3</option>
              	<option value="4">4</option>
              	<option value="5">5</option>
              	
              	
              </select></td>
              <td><?php if($product->products_image_path!="") {?>
                <img src="<?php echo asset_url() . $product -> products_image_path; ?>" width="50px" height="50px" />
                <?php }else{ ?>
                <img src="<?php echo asset_url()?>product_images/noimage.jpg" width="50px" height="50px" />
                <?php } ?></td>
              <td>
              	<button type="button" class="btn btn-success addcart" data-product-id="<?php echo $product -> products_id; ?>" >Add to Cart
                </button>
                <button type="button" class="btn btn-info showMoreImages" data-toggle="modal" data-product-id="<?php echo $product -> products_id; ?>" >More
                Images</button>
               </td>
            </tr>
            <?php }}else{ ?>
            <tr><td colspan="5" align="center">No Products Found</td></tr>
            <?php }?>
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
        <h4 class="modal-title">Product Images</h4>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
