
<header class="main-header">
    <div class="container">
        <h1 class="page-title">See Job Listings </h1>
    </div>
</header>

<div class="container">
    <div class="row">
        <section>
          <div class="col-xs-12" >
            <?php if($getAllJobs >0):?>
              <?php foreach($getJobListing as $job):?>
                <h1>Posted by: <a href="<?php echo base_url().'profile/id/'.$job->user_id?>"><?php echo $job->first_name; ?> <?php echo $job->last_name; ?></a></h1>
                
                <table class="table table-striped">
                  <tr class="info">
                    <td><strong>Postcode: </strong> <?php echo $job->postcode; ?></td>
                    <td><strong>Suburb: </strong><?php echo $job->suburb; ?></td>
                  </tr>
                  <tr class="info">
                    <td>
                      <strong>Type of job: </strong>
                      <?php if($job->type_of_job == 1): ?>
                        <?php echo "Mummy nanny";?>
                      <?php else: ?>
                        <?php echo "Shared nanny";?>
                      <?php endif; ?>
                    </td>
                    <td><strong>Rate per hour:  </strong><?php echo $job->rate_per_hour; ?></td>
                  </tr>
                  <tr class="info">
                    <td><strong>Number of children: </strong><?php echo $job->number_of_children; ?></td>
                    <td><strong>Age of children: </strong><?php echo $job->age_of_children; ?></td>
                  </tr>
                  <tr class="info">
                    <td>
                      <strong>Days of week required: </strong>
                      <?php $weeks = $job->days_of_week_required; ?>
                      <?php if($weeks ==  1): ?>
                        <?php echo "Sunday";?>
                      <?php elseif($weeks ==  2): ?>
                        <?php echo "Monday"; ?>
                      <?php elseif($weeks ==  3): ?>
                        <?php echo "Tuesday"; ?>
                      <?php elseif($weeks ==  4): ?>
                        <?php echo "Wednesday"; ?>
                      <?php elseif($weeks ==  5): ?>
                        <?php echo "Thursday"; ?>
                      <?php elseif($weeks ==  6): ?>
                        <?php echo "Friday"; ?>
                      <?php elseif($weeks ==  7): ?>
                        <?php echo "Saturday"; ?>
                      <?php else: ?>
                        <?php echo "Sunday"; ?>
                      <?php endif; ?>
                    </td>
                    <td>
                      <strong>Flexible with days: </strong>
                      <?php $days = $job->flexible_with_days; ?>
                      <?php if($days == 1):?>
                        <?php echo "Yes"; ?>
                      <?php else: ?>
                        <?php echo "No"; ?>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <tr class="warning" >
                    <td colspan="2">
                      <strong>About us: </strong><br />
                      <?php echo $job->a_little_bit_about_us;?>
                    </td>
                  </tr>
                
                </table>
            
              <?php endforeach; ?>
              <?php else: ?>
                <h1>There are no job posts yet.</h1>
              <?php endif;?>
           </div>
         </div>
        </section>
     
    </div> <!-- row -->
</div> <!-- container -->

