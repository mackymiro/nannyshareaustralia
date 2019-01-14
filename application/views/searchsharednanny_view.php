
<div class="container">
    <div class="row">
      <div class="col-md-12">
      <h2 class="section-title no-margin-top">Search Result for find a shared nanny </h2>
        <?php if(isset($notFound)): ?>
          <h1><?php echo $notFound; ?></h1>
        <?php else: ?>
           <?php if($searchSharedNanny): ?>
             <table class="table table-striped">
              <tr>
                <th>Name</th>
                <th>Suburb/Postcode</th>
                <th>Profile Type</th>
              </tr>
              <?php foreach($Searches as $searchSharedNanny): ?>
              <tr>
                <td><a href="<?php echo base_url().'profile/id/'.$searchSharedNanny->user_id; ?>" ><?php echo $searchSharedNanny->first_name; ?> <?php echo $searchSharedNanny->last_name; ?></a></td>
                <td><?php echo $searchSharedNanny->suburb_postcode;?></td>
                <td><?php echo $searchSharedNanny->profile_type; ?></td>
              </tr>
              <?php endforeach;?>
             </table>
           <?php elseif($searchSharedNanny == ""): ?>
              <h1>No results found</h1>
           <?php else: ?>
              <h1>No results found</h1>
           <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
</div> <!-- container  -->
 