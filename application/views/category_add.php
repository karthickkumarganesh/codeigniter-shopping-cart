<div class="col-lg-12 col-md-6 col-sm-2 show">
  <div class="panel panel-default">
    <div class="panel-heading"> Add Category </div>
    <div class="panel-body">
    <?php 
	echo form_open('/category/add',array('class'=>'form-vertical','role'=>'form'));
	?>
        <div class="form-group">
          <div class="error <?php if (validation_errors() != false || $this->session->flashdata('errormessage')!='') {?> bg-danger text-danger<?php } ?>"><?php echo validation_errors(); echo $this->session->flashdata('errormessage'); ?></div>
        </div>
        <div class="form-group">
          <label>Add Category </label>
          <div>
            <input type="text" name="category_name" id="category_name" class="form-control" value="<?php echo set_value('category_name'); ?>" >
          </div>
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-success"> Save </button>
        </div>
     <?php 
	 echo form_close();
	 ?>
    </div>
  </div>
</div>
