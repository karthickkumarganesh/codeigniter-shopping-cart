<div class="col-lg-12 col-md-6 col-sm-9">
  <div class="panel panel-default">
    <div class="panel-heading"> Cart View </div>
    <div class="panel-body">
    <div class="info"><?php echo  $this->session->flashdata('message');?></div>
      <div class="responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Product name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Sub Total</th>
            </tr>
          </thead>
          <tbody>
          
            <?php if(count($carts)>0){ foreach($carts as $cart){?>
            <tr>
              <td><?php echo $cart['name'];?></td>
              <td><?php echo $cart['qty'];?></td>
              <td>Rs <?php echo $cart['price'];?></td>
              <td>Rs <?php echo $cart['subtotal'];?></td>
            </tr>
            <?php }}else{
			?>
            <tr><td colspan="4" align="center">Cart is empty</td></tr>
            <?php
			}?>
          </tbody>
        </table>
        <?php if(count($carts)>0){ ?>
        <table class="table table-bordered table-striped table-hover" style="width:23%" align="right">
          <tbody>
            <tr> 
              
              <td  style="text-align:left" align="right">Rs <?php echo $this->cart->format_number($this->cart->total());?></td>
            </tr>
          </tbody>
         
            <tr> 
              <?php
		echo form_open('/product_list/purchase', array('class' => 'form-vertical', 'role' => 'form'));
	?>
              <td  style="text-align:left" align="right"><button type="submit" class="btn btn-success">Confirm</button></td>
             <?php 
			 echo form_close();
			 ?>
            </tr>
          
        </table>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
