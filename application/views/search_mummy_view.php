
<div class="container">
    <div class="row">
      <div class="col-md-12">
      <h2 class="section-title no-margin-top">Search Result for find a mummy nanny </h2>
        <?php if(isset($notFound)): ?>
          <h1><?php echo $notFound; ?></h1>
        <?php else: ?>
           <?php if($searchMummyNanny): ?>
             <table class="table table-striped">
              <tr>
                <th>Name</th>
                <th>Suburb/Postcode</th>
                <th>Profile Type</th>
              </tr>
              <?php foreach($Searches as $searchMummyNanny): ?>
              <tr>
                <td><a href="<?php echo base_url().'profile/id/'.$searchMummyNanny->user_id; ?>" ><?php echo $searchMummyNanny->first_name; ?> <?php echo $searchMummyNanny->last_name; ?></a></td>
                <td><?php echo $searchMummyNanny->suburb_postcode;?></td>
                <td><?php echo $searchMummyNanny->profile_type; ?></td>
              </tr>
              <?php endforeach;?>
             </table>
           <?php elseif($searchMummyNanny == ""): ?>
              <h1>No results found</h1>
           <?php else: ?>
              <h1>No results found</h1>
           <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
</div> <!-- container  -->
 