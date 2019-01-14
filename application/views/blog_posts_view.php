<!DOCTYPE html>
<!-- saved from url=(0074)header-light-dark/index.html -->
<html lang="en" class="sb-init"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title><?php echo $title; ?></title>

    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/favicon.ico">

    <meta name="description" content="">

    <!-- CSS -->
    <link href="<?php echo base_url()?>assets/css/preload.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="<?php echo base_url()?>assets/css/animate.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url()?>assets/css/slidebars.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url()?>assets/css/jquery.bxslider.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/syntaxhighlighter/shCore.css" rel="stylesheet" media="screen">

    <link href="<?php echo base_url()?>assets/css/style-blue.css" rel="stylesheet" media="screen" title="default">
    <link href="<?php echo base_url()?>assets/css/width-full.css" rel="stylesheet" media="screen" title="default">

    <link href="<?php echo base_url()?>assets/css/buttons.css" rel="stylesheet" media="screen">
   
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <style id="holderjs-style" type="text/css"></style></head>

<body>
<div id="sb-site">
<div class="boxed">

<header id="header-full-top" class="hidden-xs header-full">
    <div class="container">
        <div class="header-full-title">
            <h1 class="animated fadeInRight"><a href="<?php echo base_url(); ?>" class="active">Nanny <span>Share</span></a></h1>
            <p class="animated fadeInRight">Australia</p>
        </div>
        <nav class="top-nav">
						<ul class="top-nav-social hidden-sm">
                <li><a href="https://www.facebook.com/nannyshareaustralia" target="_blank" class="animated fadeIn animation-delay-8 facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/nannyshareaus" target="_blank" class="animated fadeIn animation-delay-7 twitter"><i class="fa fa-twitter"></i></a></li>
								<li><a href="http://instagram.com/nannyshareaustralia" target="_blank" class="animated fadeIn animation-delay-9 instagram"><i class="fa fa-instagram"></i></a></li>
								<li><a href="header-light-dark/index.html#" class="animated fadeIn animation-delay-9 googleplus"><i class="fa fa-pinterest"></i></a></li>
            </ul>

            <div class="dropdown animated fadeInDown animation-delay-11">
                  <?php if($this->session->userdata('loggedInBlog')): ?>
                    <a href="<?php echo base_url().'logout/blog'?>" title="Logout"><i class="fa fa-user"></i> Logout</a>
                  <?php else: ?>
                     <a href="<?php echo base_url().'login'?>" title="Login"><i class="fa fa-user"></i> Login</a>
                 <?php endif; ?>
                  
            </div> <!-- dropdown -->

        </nav>
    </div> <!-- container -->
</header> <!-- header-full -->
  <nav class="navbar navbar-static-top navbar-default navbar-header-full navbar-dark" role="navigation" id="header">
          <div class="container">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <i class="fa fa-bars"></i>
                  </button>
                  <a class="navbar-brand hidden-lg hidden-md hidden-sm active" href="<?php echo base_url(); ?>">Nanny <span>Share</span>Australia</a>
              </div> <!-- navbar-header -->

              <!-- Collect the nav links, forms, and other content for toggling -->
              <!--<div class="pull-right">
                  <a href="javascript:void(0);" class="sb-icon-navbar sb-toggle-right"><i class="fa fa-bars"></i></a>
              </div>-->  
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                      <li class="<?php echo ($blogpost == "blogpost") ? 'active' : '' ?>">
                          <a href="<?php echo base_url().''?>" title="Posts Blogs">Posts Blogs</a>           
                      </li>
                 </ul>
                 
              </div><!-- navbar-collapse -->
             
          </div><!-- container -->
      </nav>
<header class="main-header">
    <div class="container">
        <h1 class="page-title">Posts Blogs Here</h1>
    </div>
</header>
<div class="container">
  <div class="row">
    <?php echo form_open_multipart('blog/add');?>
     <div class="col-md-4">
          <section>
            <p>No picture </p>    
            <input type="file" name="photo" />            
          </section>
          <section>
            <br >
             <input type="submit" class="btn btn-ar btn-block btn-success" value="Post a blog">
            <hr>
          </section>
      </div>
      <div class="col-md-8">
          <section>
              <div class="panel-primary">
                <div class="panel-heading"><i class="fa fa-user"></i>Post Content here</div>
                <br>
                 <?php if($this->session->flashdata('error')): ?>
                  <div id="alert-danger" class="alert alert-danger">
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    <p >The filetype you are attempting to upload is not allowed.</p>
                  </div>
                <?php endif; ?>
                <?php if($this->session->flashdata('success')): ?>
                  <div class="success_reg">
                    <p class="alert alert-success">You have successfully posted a blog!</p>
                  </div>
                <?php endif; ?>
                <div class="error">
                  <?php echo validation_errors('<div class="error">','</div>');?>
                </div>
                <div class="form-group">
                    <label for="InputFirstName">Date<sup>*</sup></label>
                    <input type="text" class="form-control"  id="datepicker" name="date" value="<?php echo set_value('date');?>"/>
                </div>
                <div class="form-group">
                    <label for="InputFirstName">Title<sup>*</sup></label>
                    <input type="text" class="form-control"  name="title" value="<?php echo set_value('title');?>"/>
                </div>
                <div class="form-group">
                    <label for="InputFirstName">Content<sup>*</sup></label>
                    <textarea class="form-control" name="content" cols="15" rows="20"></textarea>
                </div>
              </div>
          </section>         
      </div>
      </form>
  </div>
</div> <!-- container  -->
<script> 
    var date = new Date();
    var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear();
    
    $('#datepicker').datepicker({
			minDate: new Date(currentYear, currentMonth, currentDate),
      dateFormat: "yy-mm-dd"
    });
    
</script>
<footer id="footer">
    <p>© 2014 <a href="<?php echo base_url();?>">Nanny Share Australia</a>, Inc. All rights reserved.</p>
</footer>

</div> <!-- boxed -->
</div> <!-- sb-site -->

<div id="back-top" style="display: none;">
    <a href="header-light-dark/index.html#header"><i class="fa fa-chevron-up"></i></a>
</div>
<!-- Scripts -->

<script src="<?php echo base_url()?>assets/js/jquery.cookie.js"></script>
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url()?>assets/js/slidebars.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.bxslider.min.js"></script>
<script src="<?php echo base_url()?>assets/js/holder.js"></script>
<script src="<?php echo base_url()?>assets/js/buttons.js"></script>
<script src="<?php echo base_url()?>assets/js/styleswitcher.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.mixitup.min.js"></script>
<script src="<?php echo base_url()?>assets/js/circles.min.js"></script>


</body>
</html>
