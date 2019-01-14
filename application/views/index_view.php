<!DOCTYPE html>
<html lang="en" class="sb-init"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">  <title><?php echo $title; ?></title>

    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/favicon.ico">

		<meta name="keywords" content="Share Care, nanny care, nanny, stay-at-home parents, live-out nanny, daycare, home daycare, caregiver, care giver nanny share, sharing a nanny, sharing childcare, share nanny, nanny services, part time nanny, part time childcare, flexible childcare"/>
		
		<meta property="og:title" content="<?php echo $title; ?>" />
		
		<!--<meta property="og:type" content="website" />-->

		<!--<meta property="og:image:width" content="200" />
		<meta property="og:image:height" content="200" />-->
    
    <!--<meta property="og:image" content="<?php echo base_url();?>assets/images/400dpiLogo.png" />-->
    <!--<meta property="og:description" content="Nanny Share Australia is an online platform where you can find families and nannies in your area. Join now and find a right family or nannies today." />-->
		
   
		
    <!-- Open Graph Meta Tags BEGIN -->
		<meta expr:content='data:blog.pageName' property='og:title'/>
		<b:if cond='data:blog.postImageThumbnailUrl'>
			<meta expr:content='data:blog.postImageThumbnailUrl' property='og:image'/>
		</b:if>
		<b:if cond='data:pageName.postImageThumbnailUrl'>
			<meta expr:content='data:pageName.postImageThumbnailUrl' property='og:image'/>
		</b:if>
		<meta expr:content='data:blog.title' property='og:title'/>
		<meta expr:content='data:blog.canonicalUrl' property='og:url'/>
		<b:if cond='data:blog.metaDescription'>
			<meta expr:content='data:blog.metaDescription' property='og:description'/>
		</b:if>
		<!-- Open Graph Meta Tags END -->
		
   
    
		<meta name="robots" content="index, nofollow" />
		
    <!-- CSS -->
    <link href="<?php echo base_url()?>assets/css/preload.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="<?php echo base_url()?>assets/css/animate.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url()?>assets/css/slidebars.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url()?>assets/css/lightbox.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url()?>assets/css/jquery.bxslider.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/syntaxhighlighter/shCore.css" rel="stylesheet" media="screen">

    <link href="<?php echo base_url()?>assets/css/style-blue.css" rel="stylesheet" media="screen" title="default">
    <link href="<?php echo base_url()?>assets/css/width-full.css" rel="stylesheet" media="screen" title="default">

    <link href="<?php echo base_url()?>assets/css/buttons.css" rel="stylesheet" media="screen">
   <!-- <script src="<?php //echo base_url()?>assets/js/jquery-1.7.2.min.js"></script>-->
   <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="../assets/js/html5shiv.min.js"></script>
        <script src="../assets/js/respond.min.js"></script>
    <![endif]-->
		<style id="holderjs-style" type="text/css"></style></head>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#error_subscribe").hide();
				$("#success_subscribe").hide();
				$("#subscribe").click(function(){
					var subscribe = $("#subscribe_email").val().trim();
					if(subscribe.length > 0){
						$.post("<?php echo base_url().'home/subscribe'?>", { subscribe:subscribe }, function(data){
							$("#success_subscribe").show();
							$("#subscribe_email").val('');
							$("#success_subscribe").fadeOut(3000);
						});
					}else{
						$("#error_subscribe").show();
						$("#error_subscribe").fadeOut(3000);
					}
				});
			});
		</script>

<body>
<div id="sb-site">
<div class="boxed">

<header id="header-full-top" class="hidden-xs header-full">
    <div class="container">
				<a href="<?php echo base_url(); ?>" class="active">
        <div class="header-full-title">
            <h1 class="animated fadeInRight"><div style="margin-left:22px;">Nanny<span>Share</span></div></h1>
            <p class="animated fadeInRight">Australia</p>
        </div>
				</a>
        <nav class="top-nav">
            <ul class="top-nav-social hidden-sm">
                <li><a href="https://www.facebook.com/nannyshareaustralia" target="_blank" class="animated fadeIn animation-delay-8 facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/nannyshareaus" target="_blank" class="animated fadeIn animation-delay-7 twitter"><i class="fa fa-twitter"></i></a></li>
								<li><a href="http://instagram.com/nannyshareaustralia" target="_blank" class="animated fadeIn animation-delay-9 instagram"><i class="fa fa-instagram"></i></a></li>
								<li><a href="http://www.pinterest.com/nannyshareaustr/" target="_blank" class="animated fadeIn animation-delay-9 pinterest"><i class="fa fa-pinterest"></i></a></li>
            </ul>

            <div class="dropdown animated fadeInDown animation-delay-11">
                  <?php if($this->session->userdata('loggedIn')): ?>
                    <a href="<?php echo base_url().'logout'?>" title="Logout"><i class="fa fa-user"></i> Logout</a>
                  <?php else: ?>
                     <a href="<?php echo base_url().'login'?>" title="Login"><i class="fa fa-user"></i> Login</a>
                 <?php endif; ?>
                  
                <div class="dropdown-menu dropdown-menu-right dropdown-login-box animated fadeInUp">
                    <form role="form">
                        <h4>Login Form</h4>

                        <div class="form-group">
                            <div class="input-group login-input">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Username">
                            </div>
                            <br>
                            <div class="input-group login-input">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="checkbox pull-left">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-ar btn-primary pull-right">Login</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div> <!-- dropdown -->

            <div class="dropdown animated fadeInDown animation-delay-13">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-search-box animated fadeInUp">
                    <form action="<?php echo base_url().'search'?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" placeholder="Search suburb/postcode. . . ">
                           
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-ar btn-primary">Go!</button>
                            </span>
                        </div><!-- /input-group -->
                    </form>
                </div>
            </div> <!-- dropdown -->
        </nav>
    </div> <!-- container -->
</header> <!-- header-full -->
<?php $register; $login; $search; $payment; $terms; $privacy; $nannyProfile; $familyProfile; $messages; $create_job_listing; $payment_job_listing; $paymentSuccess; $searchFamilies; $recoverPassword; $blogs;
      $searchNannies; $searchMummyNanny;?>
<?php if(!isset($register)): ?>
  <?php if(!isset($login)): ?>
  <?php if(!isset($search)): ?>
    <?php if(!isset($payment)): ?>
      <?php if(!isset($terms)): ?>
        <?php if(!isset($privacy)): ?> 
          <?php if(!isset($nannyProfile)): ?>
            <?php if(!isset($familyProfile)): ?>
              <?php if(!isset($create_job_listing)): ?>
                <?php if(!isset($payment_job_listing)): ?>
                  <?php if(!isset($paymentSuccess)): ?>
                    <?php if(!isset($searchFamilies)): ?>
                    <?php if(!isset($recoverPassword)): ?>
                    <?php if(!isset($searchNannies)): ?>
                     <?php if(!isset($searchMummyNanny)): ?>
                     <?php if(!isset($blogs)):?>
              <?php if(!$this->session->userdata('loggedIn')):?>
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
                      <li class="<?php echo ($menu == "home") ? 'active' : '' ?>">
                          <a href="<?php echo base_url(); ?>" title="Home" >Home</a>           
                      </li>
                      <li class="<?php echo ($menu == "about_us") ? 'active' : '' ?>">
                          <a href="<?php echo base_url().'about-us.html'?>" title="About Us">About Us</a>
                      </li>
                      <li class="<?php echo ($menu == "how-it-works") ? 'active' : '' ?>">
                          <a href="<?php echo base_url().'how-it-works.html'?>" title="How It Works">How It Works</a>
                      </li>
                      <li class="<?php echo ($menu == "q_a") ? 'active' : '' ?>">
                          <a href="<?php echo base_url().'q-a.html'?>" title="Q&As">Q & As</a>
                      </li>
                      <li class="<?php echo ($menu == "blog") ? 'active' : '' ?>">
                          <a href="<?php echo base_url().'blog.html'?>" title="Blog">Blog</a>
                      </li>
                      <li class="<?php echo ($menu == "testimonials") ? 'active' : '' ?>">
                          <a href="<?php echo base_url().'testimonials.html'?>" title="Testimonials">Testimonials</a>
                      </li>
                      <li class="<?php echo ($menu == "see_job_listings") ? 'active' : '' ?>">
                          <a href="<?php echo base_url().'see-job-listings.html'?>" title="See job listings">See job listings</a>
                      </li>
                      <li class="<?php echo ($menu == "contact_us") ? 'active' : '' ?>">
                          <a href="<?php echo base_url().'contact-us.html'?>" title="Contact Us">Contact Us</a>           
                      </li>
                      <li id="mobile_button">
                        <a  href="<?php echo base_url().'login'?>" title="Login">Login</a>           
                      </li>          
                 </ul>
                 
              </div><!-- navbar-collapse -->
             
          </div><!-- container -->
      </nav>
    <?php else: ?>
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
                          <?php if($profile == "view_profile"): ?>
                          <li class="<?php echo ($profile == "profile") ? 'active' : '' ?>">
                              <a href="<?php echo base_url();  ?>" title="Profile" >Profile</a>           
                            </li>  
                          <li class="<?php echo ($profile == "view_profile") ? 'active' : '' ?>">
                              <a href="#" title="View Profile" >View Profile</a>           
                          </li>
                          <?php elseif($profile == "messages_view"): ?>
                            <li class="<?php echo ($profile == "profile") ? 'active' : '' ?>">
                              <a href="<?php echo base_url();  ?>" title="Profile" >Profile</a>           
                            </li> 
                            <li class="<?php echo ($profile == "messages_view") ? 'active' : '' ?>">
                              <a href="#" title="Send A Message" >Send A Message</a>           
                            </li> 
                          
                          <?php else: ?>
                            <li class="<?php echo ($profile == "profile") ? 'active' : '' ?>">
                              <a href="<?php echo base_url();  ?>" title="Profile" >Profile</a>           
                            </li> 
                            <li class="<?php echo ($profile == "edit_profile") ? 'active' : '' ?>">
                                <a href="<?php echo base_url().'profile/edit/id/'.$id;  ?>" title="Edit Profile" >Edit Profile</a>           
                            </li>  
                            <li class="dropdown <?php echo ($profile == "messages_index") ? 'active' : '' ?>">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="Messages" >Messages</a>   
                                <ul class="dropdown-menu dropdown-menu-left">
                                  <li><a href="<?php echo base_url().'messages.html'?>" title="Messages">Messages</a></li>
                                  <li><a href="<?php echo base_url().'messages/sent-messages.html'?>" title="Sent messages">Sent messages</a></li>    
                                </ul>
                            </li>
                            <li class="<?php echo ($profile == "family_matches") ? 'active' : '' ?>">
                                  <a href="<?php echo base_url().'family-matches';  ?>" title="Family matches" >Family matches</a>           
                            </li> 
														<?php if($type == "Family Profile"): ?>
                            <li class="<?php echo ($profile == "nanny_matches") ? 'active' : '' ?>">
                                  <a href="<?php echo base_url().'nanny-matches';  ?>" title="Nanny matches" >Nanny matches</a>           
                            </li>
														<?php endif; ?>
														<li class="<?php echo ($profile == "see_job_listings") ? 'active' : '' ?>">
                                <a href="<?php echo base_url().'see-job-listings';  ?>" title="See job listings" >See job listings</a>           
                            </li> 
                            <li class="dropdown <?php echo ($profile == "find_matches") ? 'active' : '' ?>">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Search</a>
                               <ul class="dropdown-menu dropdown-menu-left">
                                  <li><a href="<?php echo base_url().'family-matches/find-family'?>" title="Find a family">Find a family</a></li>
																	<?php if($type == "Family Profile"): ?>
																	<li><a href="<?php echo base_url().'nanny-matches/find-shared-nanny'?>" title="Find a shared nanny">Find a shared nanny</a></li>
                                  <li><a href="<?php echo base_url().'nanny-matches/find-mummy-nanny'?>" title="Find a mummy nanny">Find a mummy nanny</a></li>
																	<?php endif; ?>
															</ul>
                            </li>
                           <li class="dropdown <?php echo ($profile == "change_password") ? 'active' : '' ?>">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Settings</a>
                               <ul class="dropdown-menu dropdown-menu-left">
                                  <li><a href="<?php echo base_url().'change-password.html'?>" title="Change Password">Change Password</a></li>
                               </ul>
                            </li>
                          <li id="mobile_button">
                              <a  href="<?php echo base_url().'logout'?>" title="Logout">Logout</a>           
                          </li>                              
                          <?php endif; ?>
                            
                     </ul>
                     
                  </div><!-- navbar-collapse -->
                 
              </div><!-- container -->
          </nav>      

                          <?php endif; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
               <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>
        <?php endif; ?>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>

<?php echo $main_content; ?>

<aside id="footer-widgets">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3 class="footer-widget-title">Sitemap</h3>
                 <ul class="list-unstyled three_cols">
                  <?php $register; $login; $search; $payment; $terms; $privacy; $nannyProfile; $familyProfile; $messages; $messagesIndex; $create_job_listing; $paymentSuccess; $searchFamilies; $recoverPassword; $searchNannies; $searchMummyNanny; $blogs;?>
                  <?php if(!$this->session->userdata('loggedIn')): ?>
                      <?php if(isset($register) || isset($login) || isset($search)|| isset($payment) || isset($terms) || isset($privacy) || isset($nannyProfile) || isset($familyProfile) || isset($messages) || isset($messagesIndex) || isset($create_job_listing) || isset($paymentSuccess)
                        || isset($searchFamilies) || isset($recoverPassword) || isset($searchNannies) || isset($searchMummyNanny) || isset($blogs))
                       :?>
                        <li ><a  href="<?php echo base_url(); ?>" title="Home">Home</a></li>
                        <li ><a  href="<?php echo base_url().'about-us.html'?>" title="About Us">About Us</a></li>
                        <li ><a href="<?php echo base_url().'how-it-works.html'?>" title="How It Works">How It Works</a></li>
                        <li ><a href="<?php echo base_url().'q-a.html'?>" title="Q&A">Q & As</a></li>
                        <li ><a href="<?php echo base_url().'blog.html'?>" title="Blog">Blog</a></li>
                        <li ><a href="<?php echo base_url().'testimonials.html'?>" title="Testimonials">Testimonials</a></li>
                        <li><a href="<?php echo base_url().'see-job-listings.html'?>"  title="See job listings">See job listings</a></li>
                        <li><a href="<?php echo base_url().'contact-us.html'?>" title="Contact Us">Contact Us</a></li>  
                        <li><a href="<?php echo base_url().'privacy-policy.html'?>" target="_blank" title="Privacy Policy" >Privacy Policy</a></li>
                        <li><a href="<?php echo base_url().'terms-and-conditions.html'?>" target="_blank" title="Terms and Conditions">Terms and Conditions</a></li>  
                    <?php else: ?>
                      <li id="<?php echo ($menu == "home") ? 'footer-menu' : '' ?>"><a  href="<?php echo base_url(); ?>" title="Home">Home</a></li>
                      <li id="<?php echo ($menu == "about_us") ? 'footer-menu' : '' ?>"><a  href="<?php echo base_url().'about-us.html'?>" title="About Us">About Us</a></li>
                      <li id="<?php echo ($menu == "how-it-works") ? 'footer-menu' : '' ?>"><a href="<?php echo base_url().'how-it-works.html'?>" title="How It Works">How It Works</a></li>
                      <li id="<?php echo ($menu == "q_a") ? 'footer-menu' : '' ?>"><a href="<?php echo base_url().'q-a.html'?>" title="Q&A">Q & As</a></li>
                      <li id="<?php echo ($menu == "blog") ? 'footer-menu' : '' ?>"><a href="<?php echo base_url().'blog.html'?>" title="Blog">Blog</a></li>
                      <li id="<?php echo ($menu == "testimonials") ? 'footer-menu' : '' ?>"><a href="<?php echo base_url().'testimonials.html'?>" title="Testimonials">Testimonials</a></li>
                      <li id="<?php echo ($menu == "see_job_listings") ? 'footer-menu' : '' ?>"><a href="<?php echo base_url().'see-job-listings.html'?>" title="See job listings">See job listings</a></li>
                      <li id="<?php echo ($menu == "contact_us") ? 'footer-menu' : '' ?>"><a href="<?php echo base_url().'contact-us.html'?>" title="Contact Us">Contact Us</a></li> 
                      <li id="<?php echo ($menu == "privacy") ? 'footer-menu' : '' ?>"><a href="<?php echo base_url().'privacy-policy.html'?>" target="_blank" title="Privacy Policy">Privacy Policy</a></li> 
                      <li id="<?php echo ($menu == "terms") ? 'footer-menu' : '' ?>"><a href="<?php echo base_url().'terms-and-conditions.html'?>" target="_blank" title="Terms and Conditions">Terms and Conditions</a></li> 
                    <?php endif; ?>
                  <?php else: ?>
                    <li id="<?php echo ($profile == "profile") ? 'footer-menu' : '' ?>"><a  href="<?php echo base_url(); ?>" title="Profile">Profile</a></li>
                    <li id="<?php echo ($profile == "edit_profile") ? 'footer-menu' : '' ?>"><a  href="<?php echo base_url().'profile/edit/id/'.$id; ?>" title="Edit Profile">Edit Profile</a></li>
                    <?php if($profile == "view_profile"): ?>
                      <li id="<?php echo ($profile == "view_profile") ? 'footer-menu' : '' ?>"><a  href="#" title="View Profile">View Profile</a></li>
                    <?php endif; ?>
                     <?php if($profile == "messages_view"): ?>
                      <li id="<?php echo ($profile == "messages_view") ? 'footer-menu' : '' ?>"><a  href="#" title="Send a messages">Send a messages</a></li>
                    <?php else: ?>
                      <?php if(!$profile == "search"): ?>
                      <li id="<?php echo ($profile == "edit_profile") ? 'footer-menu' : '' ?>"><a  href="<?php echo base_url().'profile/edit/id/'.$id; ?>" title="Edit Profile">Edit Profile</a></li>
                      <?php endif; ?>
                    <li id="<?php echo ($profile == "messages_index") ? 'footer-menu' : '' ?>"><a  href="<?php echo base_url().'messages'?>" title="Messages">Messages</a></li>
                    <li id="<?php echo ($profile == "family_matches") ? 'footer-menu' : '' ?>"><a  href="<?php echo base_url().'family-matches' ?>" title="Family matches">Family matches</a></li>
                    <li id="<?php echo ($profile == "nanny_matches") ? 'footer-menu' : '' ?>"><a  href="<?php echo base_url().'nanny-matches' ?>" title="Nanny matches">Nanny matches</a></li>
										<li id="<?php echo ($profile == "see_job_listings") ? 'footer-menu' : '' ?>"><a  href="<?php echo base_url().'see-job-listings' ?>" title="See job listings">See job listings</a></li>
                   <?php endif; ?>
										<li id="<?php echo ($profile == "terms") ? 'footer-menu' : '' ?>"><a href="<?php echo base_url().'terms-and-conditions.html'?>" target="_blank" title="Terms and Conditions">Terms and Conditions</a></li>
                    <li id="<?php echo ($profile == "privacy") ? 'footer-menu' : '' ?>"><a href="<?php echo base_url().'privacy-policy.html'?>" title="Privacy Policy" target="_blank">Privacy Policy</a></li>       
                  <?php endif; ?>
               </ul>
							  <h3 class="footer-widget-title">Subscribe</h3>
								<p>Subscribe to our newsletter here.</p>
								<div class="input-group">
										 <div id="error_subscribe" class="alert alert-danger">
											<p>Please enter an email address.</p>
										</div>
										<div id="success_subscribe" class="alert alert-success">
											<p>Thank you for subscribing a newsletter to us.</p>
										</div>
										<div>
											<input type="text" id="subscribe_email" name="subscribe_email" class="form-control" placeholder="Email Adress" />
											<span class="input-group-btn">
													<button class="btn btn-ar btn-primary" type="button" id="subscribe">Subscribe</button>
											</span>
										</div>
								</div><!-- /input-group -->
                
            </div>
						<div class="col-md-4">
                <div class="footer-widget">
                    <h3 class="footer-widget-title">Recent Blog Post</h3>
										<?php foreach($getBlogPosts as $post): ?>
                    <div class="media">
                        <a class="pull-left" href="">
													<img class="media-object" src="<?php echo base_url()?>assets/uploads/blogs/<?php echo "thumb_".$post->image; ?>" width="75" height="75" alt="image">
												</a>
                        <div class="media-body">
                            <h4 class="media-heading" ><a href="<?php echo base_url().'blog/view-details/'.$post->slug; ?>"><?php echo $post->title; ?></a></h4>
														<p class="media-heading" style="color:#FFF";>
															<?php $limitedWord = word_limiter($post->content, 10); ?>
															<?php echo $limitedWord; ?>
														</p>
                            <small>
															<?php echo date('M',strtotime($post->date)); ?>
															<?php echo date('d',strtotime($post->date)); ?>
															<?php echo date('Y',strtotime($post->date)); ?>
														</small>
                        </div>
                    </div>
										<?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-widget">
                    <h3 class="footer-widget-title">Latest Registered Users</h3>
										<?php if($countUsers): ?>
                    <div class="row">
                        <?php foreach($getAllData as $data): ?>
                          <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                              <?php if($data->profile_image == NULL): ?>
                                <a href="<?php echo base_url().'profile/id/'.$data->user_id; ?>" class="thumbnail"><img src="<?php echo base_url()?>assets/images/thumb_empty_image.png" class="img-responsive" alt="Image"></a>
                              <?php else: ?>
                                <a href="<?php echo base_url().'profile/id/'.$data->user_id; ?>" class="thumbnail"><img src="<?php echo base_url()?>assets/uploads/<?php echo "thumb_".$data->profile_image; ?>" class="img-responsive" alt="Image"></a>
                              <?php endif; ?>
                          </div>
                        <?php endforeach; ?>
                    </div>
										<?php else: ?>
											<p>No registered users yet</p>
										<?php endif;?>
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</aside> <!-- footer-widgets -->
<footer id="footer">
    <script type="text/javascript">
        vDatenow = new Date();
        with(vDatenow){
          document.write("Copyright &copy; 2014-");
          document.write(getFullYear());
          document.write("<a href='<?php echo base_url(); ?>'>");
					document.write("&nbsp;&nbsp;Nanny Share Australia");
					document.write("</a>");
          document.write(" All Rights Reserved");
        }
      </script>
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