
<div class="container">
    <div class="center-block logig-form">
        <h2 class="section-title no-margin-top">Blog Login</h2>
        <div class="panel panel-primary">
            <div class="panel-heading">Blog Login Form</div>
            <div class="panel-body">
                <form action="<?php echo base_url().'blog/auth'?>" method="post">
                    <div class="form-group">
                        <div class="error">
                          <?php echo validation_errors('<div class="error">','</div>');?>
                        </div>
                        <br />
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo set_value("username");?>" /> 
                        </div>
                        <br>
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo set_value("password"); ?>" />
                        </div>
                        <br>
                        <button type="submit" class="btn btn-ar btn-primary pull-right">Login</button>
                        <hr class="dotted margin-10">
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- container  -->