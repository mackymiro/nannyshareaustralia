<?php error_reporting(0); ?>
<header class="main-header">
    <div class="container">
        <h1 class="page-title">Find a shared nanny</h1>
    </div>
</header>

<div class="container">
    <div class="row">
      <section>
        <div class="col-xs-12" >
						<form action="<?php echo base_url().'nanny-matches/search-nanny-matches'?>" method="post">
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
						</form>
            <div class="col-md-8">
              <section>
                  <div class="panel panel-primary">
										<div class="panel-heading"><i class="fa fa-search"></i> Search result for find a nanny match</div>
										 <?php if(isset($notFound)): ?>
											<h1><?php echo $notFound; ?></h1>
										<?php else: ?>		
												<?php if($searchNannyMatches): ?>
												<table class="table table-striped">
													<tr>
														<th>Name</th>
														<th>Postcode</th>
														<th>Profile Type</th>
													</tr>
												<?php foreach($Searches as $nanny): ?>
													<tr>
														<td><a href="<?php echo base_url().'profile/id/'.$nanny->user_id; ?>" ><?php echo $nanny->first_name; ?> <?php echo $nanny->last_name; ?></a></td>
														<td><?php echo $nanny->suburb_postcode;?></td>
														<td><?php echo $nanny->profile_type; ?></td>
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

