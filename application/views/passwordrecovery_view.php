
<div class="container">
    <div class="center-block logig-form">
        <h2 class="section-title no-margin-top">Password Recovery</h2>
        <div class="panel panel-primary">
            <div class="panel-heading">Password Recovery Form</div>
            <div class="panel-body">
                <?php if($this->session->flashdata('succ_send')):?>
                  <div class="success_reg">
                    <p class="alert alert-success">Your request has been sent to your email!</p>
                  </div>
                <?php endif; ?>
                <?php if($this->session->flashdata('success_edit')): ?>
                   <div class="success_reg">
                     <p class="alert alert-success">You have successfully changed your password.</p>
                   </div>
                <?php endif; ?>
                <?php if($this->session->flashdata('succ_failed')): ?>
                    <div class="error">
                      <p class="alert alert-dange">Email was not found on our database</p>
                    </div>
                <?php endif; ?>
                <form action="<?php echo base_url().'password-recovery/recover-password'?>" method="post">
                   <div class="error">
                      <?php echo validation_errors('<div class="error">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                      <br />
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="email" class="form-control" placeholder="Email Address" name="email" value="<?php echo set_value("email");?>" /> 
                        </div>
                        <br>
                        <button type="submit" class="btn btn-ar btn-primary pull-right">Recover Password</button>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- container  -->