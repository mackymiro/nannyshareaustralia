
<div class="container">
    <div class="center-block logig-form">
        <h2 class="section-title no-margin-top">Login</h2>
        <div class="panel panel-primary">
            <div class="panel-heading">Login Form</div>
            <div class="panel-body">
                <form action="<?php echo base_url().'login/auth'?>" method="post">
                    <div class="form-group">
                        <div class="error">
                          <?php echo validation_errors('<div class="error">','</div>');?>
                        </div>
                        <br />
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Username/Email Address" name="username" value="<?php echo set_value("username");?>" /> 
                        </div>
                        <br>
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo set_value("password"); ?>" />
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember_me" value="remember_me"> Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-ar btn-primary pull-right">Login</button>
												<br>
                        <hr class="dotted margin-10">
                        <a href="<?php echo base_url().'password-recovery'?>" class="btn btn-ar btn-warning">Password Recovery</a>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- container  -->