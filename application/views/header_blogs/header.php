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
								<li><a href="http://www.pinterest.com/nannyshareaustr/" target="_blank" class="animated fadeIn animation-delay-9 pinterest"><i class="fa fa-pinterest"></i></a></li>
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
                          <a href="<?php echo base_url(); ?>" title="Posts Blogs">Posts Blogs</a>           
                      </li>
											<li class="<?php echo ($blogpost == "view_posts_blogs") ? 'active' : '' ?>">
                          <a href="<?php echo base_url().'admin/view-posts-blogs/'?>" title="View Posts Blogs">View Posts Blogs</a>           
                      </li>
											<li class="<?php echo ($blogpost == "view_all_registered_users") ? 'active' : '' ?>">
                          <a href="<?php echo base_url().'admin/view-all-registered-users/'?>" title="View all registered users">View all registered users</a>           
                      </li>
											<li id="mobile_button">
                        <a  href="<?php echo base_url().'logout/blog'?>" title="Logout">logout</a>           
                      </li>   
                 </ul>
                 
              </div><!-- navbar-collapse -->
             
          </div><!-- container -->
      </nav>