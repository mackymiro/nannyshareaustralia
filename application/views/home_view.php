<script type="text/javascript">
  $(document).ready(function(){
    $("#createBox").click(function(){     
       var profile = $('#profile_family').val();
       if(profile == 1){
         window.location.replace('<?php echo base_url().'nanny-profile.html'?>');
       }else{
        window.location.replace('<?php echo base_url().'family-profile.html'?>');
       }
     });
   
    $("#search_families").click(function(){
      $("#form_search").attr("action", "<?php echo base_url().'search-families'?>");
      $("#form_search").submit();
    });
    
    $("#shared_nanny").click(function(){
      $("#form_search").attr("action", "<?php echo base_url().'search-shared-nanny'?>");
      $("#form_search").submit();
    });
  
    $("#mummy_nanny").click(function(){
      $("#form_search").attr("action", "<?php echo base_url().'search-mummy-nanny'?>");
      $("#form_search").submit();
    });
  });
 
</script>
<section class="carousel-section">
    <div id="carousel-example-generic" class="carousel carousel-razon slide" data-ride="carousel" data-interval="10000">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-7">
                            <div class="carousel-caption">
                                <div class="carousel-text">
                                   <h1 class="animated fadeInDownBig animation-delay-7 carousel-title">Develop life-long friendships</h1>
                                   <ul class="list-unstyled carousel-list">
                                       <li class="animated bounceInLeft animation-delay-11"><i class="fa fa-check"></i><p style="word-break: break-all; margin-top:-28px; margin-left:43px;">Nanny share arrangements can be a wonderful social <br>experience</p></li>
                                       <li class="animated bounceInLeft animation-delay-13"><i class="fa fa-check"></i><p style="margin-top:-28px; margin-left:43px;">Beautiful bonds are created between the children, the parents and the nannies</p></li>
                                       <li class="animated bounceInLeft animation-delay-15"><i class="fa fa-check"></i><p style="margin-top:-28px; margin-left:43px;">This often results in loving relationships that can last a life-time</p></li>
                                   </ul>
                               </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-5 hidden-xs carousel-img-wrap">
                            <div class="carousel-img">
                                <img src="<?php echo base_url()?>assets/images/babyfamilies.jpg" class="img-responsive animated bounceInUp animation-delay-3" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item active">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-8">
                            <div class="carousel-caption">
                                <div class="carousel-text">
                                   <h1 class="animated fadeInDownBig  carousel-title">Sharing is caring</h1>
                                   <h2 class="animated fadeInDownBig   crousel-subtitle">Share the love. Share the support. Share the cost.</h2>
                                   <ul class="list-unstyled carousel-list">
                                     <li class="animated bounceInLeft "><i class="fa fa-check"></i><p style="margin-top:-28px; margin-left:43px;">Nanny share arrangements allow 2 or more families to share the cost of a qualified nanny.</p></li>
                                     <li class="animated bounceInLeft "><i class="fa fa-check"></i><p style="margin-top:-28px; margin-left:43px;">They provide support for each other and promote social skills amongst their children.</p></li>
                                   </ul>
                               </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-4 hidden-xs carousel-img-wrap">
                            <div class="carousel-img">
                                <img src="<?php echo base_url()?>assets/images/babytwo.jpg" class="img-responsive animated bounceInUp animation-delay-3" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-7 col-sm-9">
                            <div class="carousel-caption">
                                <div class="carousel-text">
                                   <h1 class="animated fadeInDownBig  carousel-title">Less germs means less illness</h1>
                                   <p class="animated fadeInUpBig ">It is statistically proven that children attending day care become sick more often than those cared for at home. Hiring a <span>nanny</span> can minimise  your little ones being exposed to germs and also allows you, the parent,  to still attend work knowing that your child is given the extra love and attention they need when unwell.</p>
                               </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-3 hidden-xs carousel-img-wrap">
                            <div class="carousel-img" style="z-index:-99999999;">
                                <img src="<?php echo base_url()?>assets/images/babysick.jpg" class="img-responsive animated bounceInUp animation-delay-3" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      
    </div>
</section> <!-- carousel -->

<section class="margin-bottom">
    <div class="container">
        <div class="row">
          <form id="form_search" method="post">
							<div class="col-md-3 col-sm-6">
                <div class="content-box box-default animated fadeInUp animation-delay-14">
                   <img alt="" src="<?php echo base_url()?>assets/images/create_profile.png" />
                    <h4 class="content-box-title">Create a profile</h4>
                    <p style="margin-bottom:70px;">
                      <select id="profile_family" name="families" class="form-control">  
                        <?php foreach($profile as $p): ?>
                         <option  value="<?php echo $p->id?>"><?php echo $p->profile_type; ?></option>
                         <?php endforeach; ?>
                      </select>
                      <input style="margin-top:27px;" type="button" id="createBox" class="btn btn-primary"  value="Create profile" />         
                      
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="content-box box-default animated fadeInUp animation-delay-10">
                    <img alt="" src="<?php echo base_url()?>assets/images/familymatch.png" />
                    <h4 class="content-box-title">Find a family match</h4>
                      <p>
                        <input type="text" name="search_families" class="form-control" placeholder="Enter postcode . . " />
                        <br />
                        <select name="family_kilometers" class="form-control">
                          <option value="5">5kms</option>
                          <option value="10">10kms</option>
                          <option value="15">15kms</option>
                          <option value="20">20kms</option>
                        </select>
                        <br />
                        <input id="search_families" type="submit" class="btn btn-primary" value="Search" />
                      </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="content-box box-default animated fadeInUp animation-delay-16">
                    <img alt="" src="<?php echo base_url()?>assets/images/search_for_nannies.png" />
                    <h4 class="content-box-title">Find a shared nanny</h4>
                    <p>
                      <input type="text" name="search_nannies" class="form-control" placeholder="Enter postcode. . . " />
                      <br />
                      <select name="nanny_kilometers" class="form-control">
                        <option value="5">5kms</option>
                        <option value="10">10kms</option>
                        <option value="15">15kms</option>
                        <option value="20">20kms</option>
                      </select>
                      <br />
                      <input id="shared_nanny" type="submit" class="btn btn-primary" value="Search" />
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="content-box box-default animated fadeInUp animation-delay-12">
                    <img alt="" src="<?php echo base_url()?>assets/images/findamummynanny.png" />
                    <h4 class="content-box-title">Find a mummy nanny</h4>
                    <p>
                      <input type="text" name="search_mummy" class="form-control" placeholder="Enter postcode. . ." />
                      <br />
                      <select name="mummy_kilometers" class="form-control">
                        <option value="5">5kms</option>
                        <option value="10">10kms</option>
                        <option value="15">15kms</option>
                        <option value="20">20kms</option>
                      </select>
                      <br />
                      <input id="mummy_nanny" type="submit" class="btn btn-primary" value="Search" />
                    </p>
                </div>
            </div>
          </form>
        </div>
    </div>
</section>

<div class="container">
    <section class="margin-bottom">
        <p class="lead lead-lg text-center primary-color margin-bottom">Many families dismiss the idea of hiring a <strong>nanny</strong> with the assumption that its  unaffordable.  </p>
       <div class="row">
            <div class="col-md-6">
               <div class="panel panel-default">
                  <div class="panel-heading panel-heading-link">
                      <a data-toggle="collapse" data-parent="#accordion" href="header-light-dark/index.html#collapseOne">
                        <i class="fa fa-male"></i> For families
                      </a>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                      <p>First 100 families join for FREE!</p>
                      <p>After 100 families on database, for a low one-off payment of $29.00AUD, receive a six month membership to create and edit your profile,  post unlimited job listings and message other families and/or nannies..</p>
                      <p>Create your profile with as much detail as possible. Profile picture is optional, but many people like to put a face to a name.  Please be aware that your photo will be visible on the site.</p>
                      <p>Search our database for family matches in your area.</p>
                      <p>Message families of interest and also reply to any messages received.  </p>
                      <p>Arrange a face-to-face meet up. Refer to blog on 'How to find the right family match.</p>
                      <p>Already have a family to share with? Post a job listing. Message nannies of interest or wait for nannies to respond to your job. Refer to blog for "how to find the right nanny'. Where possible, both families should be involved in the nanny selection process.</p>
                      <p>You may prefer to find a family match who already have a nanny, hence eliminating the need to create a job post.</p>
                      <p>If you would choose a mummy- nanny over nanny-share, stipulate this in your profile and job listing.</p>
                      <p>All nannies on our site must possess agency standard criteria including: references showing a minimum 2 years experience and/or formal child care qualifications, current first aid certificate, the relevant  police checks for working with children and a full drivers licence. </p>
                      <p>Please report any nanny who is unable provide documentation to prove they meet the above criteria, and they will be permanently banned from using the site.</p>
											<p><a href="<?php echo base_url().'family-profile'?>" title="create your family profile now">Create your family profile now!</a></p>
										</div>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading panel-heading-link">
                        <a data-toggle="collapse" data-parent="#accordion" href="header-light-dark/index.html#collapseTwo" class="collapsed">
                          <i class="fa fa-male"></i> For nannies
                        </a>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <p>Free for nannies to join, create profile and message families.</p>
                        <p>Create your profile with detail, (picture is optional),  some people prefer to put a face to a name. Please be aware that your photo will be visible on the database search should you choose to include one in your profile..</p>
                        <p>Remember to state in your profile if you are a shared-nanny or mummy-nanny. </p>
                        <p>Free to search our database and apply for jobs in your area.</p>
                        <p>Free to contact families of interest. Please exercise courtesy by responding to ALL messages received. </p>
                        <p>All nannies registering with the site must possess the following criteria: references to prove a minimum of 2 years experience and/or formal qualifications in child care, a current first aid certificate, the relevant state checks for working with children and a full drivers licence.</p>
                        <p>Any nanny who attempts to join the site without holding the above requirements will be banned for life from using the site. The nannies on this website need to be of agency standard. </p>
                        <p>Don't have a current first aid certificate? Get one now! <a href="http://www.redcross.org.au/first-aid" target="_blank" >www.redcross.org.au/first-aid</a></p>
                        <p>Don't have your working with children check? Apply now (nsw link only)
                           <a href="http://www.kidsguardian.nsw.gov.au/Working-with-children/working-with-children-check" target="_blank" >www.kidsguardian.nsw.gov.au/Working-with-children/working-with-children-check</a></p>
                        <p>Nannies with an ABN are favourable in nanny share arrangements. It eliminates the need for 2 families to organise tax payments, as well as reducing second income tax penalties for the nanny. Don't have and ABN? Apply now!
                            <a href="http://www.business.gov.au/registration-and-licences/Pages/register-for-an-australian-business-number-abn.aspx" target="_blank">www.business.gov.au/registration-and-licences/Pages/register-for-an-australian-business-number-abn.aspx</a></p>
                        <p>As a guide for income, its suggested that a nanny who takes on 2 families charges a rate of 30% extra on their usual sole charge rate. For mummy nannies, the suggested rate is 20% less than your hourly rate before having your own child.</p>
                        <p>Please refer to our blog for more information on all things nanny share!</p>
												<p><a href="<?php echo base_url().'nanny-profile'?>" title="Create your nanny profile now">Create your nanny profile now!</a></p>
										 </div>
                    </div>
                  </div>
                 
                </div>
            </div>
       </div>
   </section>
</div>
