
<header class="main-header">
    <div class="container">
        <h1 class="page-title">Family Matches</h1>
    </div>
</header>

<div class="container">
    <div class="row">
        <?php if(isset($address)): ?>
          <h1><?php echo $address;?></h1>
        <?php else: ?>
         <?php if($countFamilyMatches > 0):?>
            <table class="table table-striped">
                <tr>
                  <th>Name</th>
                  <th>Suburb/Postcode</th>
                </tr>
                <?php foreach($getFamilyMatches as $matches): ?>
                <tr>
                  <td><a href="<?php echo base_url().'profile/id/'.$matches->user_id; ?>"><?php echo $matches->first_name; ?> <?php echo $matches->last_name; ?></a></td>
                  <td>
                    <?php echo $matches->suburb_postcode; ?>
                  </td>
                </tr>
                <?php endforeach; ?>
            </table>
          <?php else: ?>
            <h1>You have no family matche(s)</h1>
          <?php endif; ?>
        <?php endif; ?>
    </div>
</div> <!-- container  -->
