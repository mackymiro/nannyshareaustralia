
<div class="container">
    <div class="center-block logig-form">
        <h2 class="section-title no-margin-top">Change Password</h2>
        <div class="panel panel-primary">
            <div class="panel-heading">Change Password Form</div>
            <div class="panel-body">
                <?php if($this->session->flashdata('success_edit')): ?>
                   <div class="success_reg">
                     <p class="alert alert-success">You have successfully changed your password.</p>
                   </div>
                <?php endif; ?>
                <form action="<?php echo base_url().'password-recovery/change'?>" method="post">
                   <div class="error">
                      <?php echo validation_errors('<div class="error">', '</div>'); ?>
                    </div>
                    <div class="form-group">  
                        <br />
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="password" class="form-control" placeholder="New Password" name="new_password" value="<?php echo set_value("new_password");?>" /> 
                        </div>
                        <br />
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="password" class="form-control" placeholder="Confirm New Password" name="conf_password" value="<?php echo set_value("conf_password");?>" /> 
                        </div>
                        <br>
                        <button type="submit" class="btn btn-ar btn-primary pull-right">Change Password</button>
                        <input type="hidden" name="get_random_code" value="<?php echo $getRandomCode; ?>" />
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- container  -->