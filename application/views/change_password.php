<?php error_reporting(0); ?>
<div class="container">
    <div class="center-block logig-form">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">Change Password</div>
            <div class="panel-body">
                <form action="<?php echo base_url().'change-password/change'?>" method="post">
                    <div class="form-group">
                        <div class="error">
                          <?php echo validation_errors('<div class="error">','</div>');?>
                        </div>
                         <?php if($this->session->flashdata('successPassword')):?>
                            <div class="alert alert-success">
                              <p>Password successfully change</p>
                            </div>
                        <?php endif; ?>
                        <div class="error">
                          <p><?php echo $errorCurrentPassword; ?></p>
                        </div>
                        <br />
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Current Password" name="current_password" value="<?php echo set_value("current_password");?>" /> 
                        </div>
                        <br>
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="New Password" name="new_password" value="<?php echo set_value("new_password"); ?>" />
                        </div>
                        <br>
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Repeat New Password" name="repeat_new_password" value="<?php echo set_value("repeat_new_password"); ?>" />
                        </div>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-ar btn-primary pull-right">Change Password</button>
												<br>
                       
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- container  -->