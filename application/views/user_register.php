<div class="col-lg-12 col-md-6 col-sm-2 show">
  <div class="panel panel-default">
    <div class="panel-heading"> User Registration </div>
    <div class="panel-body">
    <?php
		echo form_open('/user/register', array('class' => 'form-vertical', 'role' => 'form'));
	?>
        <div class="form-group">
          <div class="error <?php if (validation_errors() != false || $this->session->flashdata('errormessage')!='') {?> bg-danger text-danger<?php } ?>"><?php echo validation_errors();
			echo $this -> session -> flashdata('errormessage');
 ?></div>
        </div>
        <div class="form-group">
          <label>Email</label>
          <div>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo set_value('username'); ?>" >
          </div>
        </div>
        <div class="form-group">
          <label>Password</label>
          <div>
            <input type="password" name="password" id="password" class="form-control" >
          </div>
        </div>
         <div class="form-group">
          <label>Confirm Password</label>
          <div>
            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" >
          </div>
        </div>
       
        <div class="form-group">
          <button type="submit" class="btn btn-success"> Register </button>
        </div>
     <?php
			echo form_close();
	 ?>
    </div>
  </div>
</div>