<?php error_reporting(0); ?>
<header class="main-header">
    <div class="container">
        <h1 class="page-title">Find a family</h1>
    </div>
</header>
<div class="container">
    <div class="row">
      <section>
        <div class="col-xs-12" >
           <div class="col-md-3 col-sm-6">
							<form action="<?php echo base_url().'family-matches/search-families'?>" method="post">
                <div class="content-box box-default animated fadeInUp animation-delay-10">
                    <img alt="" src="<?php echo base_url()?>assets/images/familymatch.png" />
                    <h4 class="content-box-title">Find a family</h4>
                      <p>
                        <input type="text" name="search_families" class="form-control" placeholder="Enter postcode. . . " />
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
								</form>
            </div>
            <div class="col-md-8">
              <section>
                  <div class="panel panel-primary">
										<div class="panel-heading"><i class="fa fa-search"></i> Search result for find a family match</div>
										<?php if(isset($notFound)): ?>
											<h1><?php echo $notFound; ?></h1>
										<?php else: ?>							
											<?php if($searchFamilyMatches): ?>
											<table class="table table-striped">
												<tr>
													<th>Name</th>
													<th>Postcode</th>
													<th>Profile Type</th>
												</tr>
												<?php foreach($Searches as $family): ?>
												<?php 
														$address =  $family->address;
														$addressExp = explode(",",$address);
														$postcode = $addressExp[3];
												 ?>
												<tr>
													<td><a href="<?php echo base_url().'profile/id/'.$family->user_id; ?>" ><?php echo $family->first_name; ?> <?php echo $family->last_name; ?></a></td>
													<td><?php echo $family->suburb_postcode; ?></td>
													<td><?php echo $family->profile_type; ?></td>
												</tr>
												<?php endforeach; ?>
											</table>
											
											<?php else: ?>
												<h1>No results found</h1>
											<?php endif;?>
									<?php endif; ?>
                  </div>
              </section>         
            </div>
        </div>
    </section>
     
    </div> <!-- row -->
</div> <!-- container -->

