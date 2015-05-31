<div class="col-lg-12 col-md-6 col-sm-2 show">
  <div class="panel panel-default">
    <div class="panel-heading"> User Login </div>
    <div class="panel-body">
    <?php
		echo form_open('/user/login', array('class' => 'form-vertical', 'role' => 'form'));
	?>
        <div class="form-group">
          <div class="error <?php if (validation_errors() != false || $this->session->flashdata('errormessage')!='') {?> bg-danger text-danger<?php } ?>"><?php echo validation_errors();
			echo $this -> session -> flashdata('errormessage');
 ?></div>
        </div>
        <div class="form-group">
          <label>User Email</label>
          <div>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo set_value('admin_username'); ?>" >
          </div>
        </div>
        <div class="form-group">
          <label>Password</label>
          <div>
            <input type="password" name="password" id="password" class="form-control" >
          </div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success"> Login </button>
           <?php echo anchor("facebook_login/login"," Facebook Login", array('class'=>'btn btn-info')) ?>
            <?php echo anchor("user/registration"," New user ? Register", array('class'=>'btn btn-default')) ?>
        </div>
     <?php
			echo form_close();
	 ?>
    </div>
  </div>
</div>


