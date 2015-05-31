<div class="col-lg-12 col-md-6 col-sm-2 ">
  <div class="panel panel-default">
    <div class="panel-heading"> Category View </div>
    <div class="panel-body">
      <div>
        <button type="button" class="btn btn-success" data-toggle="modal" id="showAddCategory">Add
        Category</button>
      </div>
      <div class="info"></div>
      <br>
      <div class="responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>Category name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($categories)>0){ foreach($categories as $category){?>
          <tr >
            <td><?php echo $category->category_name?></td>
            <td><button type="button" class="btn btn-warning showEditCategory" data-toggle="modal" data-category-id="<?php echo $category->category_id; ?>" > Edit</button>
              <button type="button" class="btn btn-danger showDeleteCategory" data-toggle="modal" data-category-id="<?php echo $category->category_id; ?>"  >Delete </button></td>
          </tr>
          <?php }}else{ ?>
           <tr><td colspan="2">No Category Found</td></tr>
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
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        <div class="error"></div>
        <?php 
	echo form_open('',array('class'=>'form-vertical','role'=>'form','id'=>'addcategory'));
	?>
        <div class="form-group">
          <label>Category Name</label>
          <div>
            <input type="text" name="category_name" id="category_name" class="form-control" >
          </div>
        </div>
        <?php 
	 echo form_close();
	 ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="savecategory">Save</button>
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
	echo form_open('',array('class'=>'form-vertical','role'=>'form','id'=>'editcategory'));
	?>
        <div class="form-group">
          <label>Category Name</label>
          <div>
            <input type="text" name="category_name" id="category_name" class="form-control" >
            <input type="hidden" name="category_id" id="category_id" class="form-control" >
          </div>
        </div>
        <?php 
	 echo form_close();
	 ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="updatecategory">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
