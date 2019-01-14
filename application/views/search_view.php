
<div class="container">
    <div class="row">
      <div class="col-md-12">
      <h2 class="section-title no-margin-top">Search Result</h2>
      <?php if(isset($notFound)): ?>
        <h2>No results found.</h2>       
      <?php else: ?>
          <?php if($q): ?>
            <table class="table table-striped">
                <tr>
                  <th>Name</th>
                  <th>Profile Type</th>
                </tr>
                 <?php foreach($search as $s): ?>
                <tr>                    
                  <td><a href="<?php echo base_url().'profile/id/'.$s->user_id; ?>"><?php echo $s->first_name .$s->last_name;  ?></a></td>
              
                  <td><?php echo $s->profile_type; ?></td>       
                </tr> 
                <?php endforeach; ?>              
              </table>            
          <?php elseif($q == ""): ?>
              <h2>No results found.</h2>                
          <?php else: ?>
               <h2>No results found.</h2> 
          <?php endif; ?>
      <?php endif; ?>
      </div>
    </div>
</div> <!-- container  -->
 