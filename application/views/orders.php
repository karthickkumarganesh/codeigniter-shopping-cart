<div class="col-lg-12 col-md-6 col-sm-9">
  <div class="panel panel-default">
    <div class="panel-heading"> Orders View </div>
    <div class="panel-body">
    <div class="info"><?php echo  $this->session->flashdata('message');?></div>
      <div class="responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Order Id</th>
              <th>Quantity</th>
              <th>Products</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
          
            <?php if(count($orders)>0){ foreach($orders as $order){?>
            <tr>
              <td><?php echo $order->order_ref_id;?></td>
              <td><?php echo $order->totalquantity;?></td>
              <td> <?php echo $order->productname;?></td>
              <td>Rs <?php echo $order->totalamount;?></td>
            </tr>
            <?php }}else{
			?>
            <tr><td colspan="4" align="center">No orders found</td></tr>
            <?php
			}?>
          </tbody>
        </table>
       
      </div>
    </div>
  </div>
</div>
