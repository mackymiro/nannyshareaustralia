
<div class="container">
    <div class="row">
        <div class="col-md-12">     
            <h2 class="section-title no-margin-top">Payment</h2>
            <div class="panel panel-success-dark animated fadeInDown">
                <div class="panel-heading">Payment Form</div>
                <form action="<?php echo base_url().'payment/proceed_data'?>" method="post">
                  <div class="panel-body">
                    <strong>Personal Information: </strong>
                    <div class="form-group">
                        <label for="InputPhoto">Profile Picture</label><br />
                        <div class="row">
                        <div class="col-md-2">
                            <?php if($getFamilyInformation->profile_image == NUll): ?>
                                <img src="<?php echo base_url()?>assets/images/thumb_empty_image.png" class="img-responsive" alt="Image">
                            <?php else: ?>
                                 <img src="<?php echo base_url()?>assets/uploads/<?php echo "thumb_".$getFamilyInformation->profile_image; ?>"  alt="avatar" class="img-responsive imageborder">
                            <?php endif; ?>
                        </div>
                        </div>
                   </div>
                   <div class="clear"></div>
                    <div class="form-group">
                       <label for="InputUserName">Username</label><br />
                       <?php echo $getFamilyInformation->username; ?>
                       <input type="hidden" name="username" value="<?php echo $getFamilyInformation->username;?>" />
                    </div>
                    <div class="form-group">
                      <label for="InputFirstName">First Name</label><br />
                      <?php echo $getFamilyInformation->first_name;?>
                      <input type="hidden" name="firstname" value="<?php echo $getFamilyInformation->first_name;?>" />
                    </div>
                    <div class="form-group">
                      <label for="InputLastName">Last Name</label><br />
                      <?php echo $getFamilyInformation->last_name; ?>
                      <input type="hidden" name="lastname" value="<?php echo $getFamilyInformation->last_name;?>" />
                    </div>
                    <div class="form-group">
                       <label for="InputAddress">Address</label><br />
                       <?php echo $getFamilyInformation->address; ?>
                       <input type="hidden" name="address" value="<?php echo $getFamilyInformation->address;?>" />
                    </div>
                    <div class="form-group">
                      <label for="InputSuburb">Suburb/Postcode</label><br />
                      <?php echo $getFamilyInformation->suburb_postcode; ?>
                      <input type="hidden" name="suburb" value="<?php echo $getFamilyInformation->suburb_postcode;?>" />
                    </div>
                    <div class="form-group">
                      <label for="InputNumberofchildren">Number of children</label><br />
                      <?php echo $getFamilyInformation->number_of_children; ?>
                       <input type="hidden" name="number_of_children" value="<?php echo $getFamilyInformation->number_of_children;?>" />
                    </div>
                    <div class="form-group">
                      <label for="InputBoys">Boys</label><br />
                      <?php echo $getFamilyInformation->boys; ?>
                      <input type="hidden" name="boys" value="<?php echo $getFamilyInformation->boys;?>" />
                    </div>
                    <div class="form-group">
                      <label for="InputAgeofboys">Age of boys</label><br />
                      <?php $ageBoys = $getFamilyInformation->age_of_boys; ?>
                      <?php $ageExplodeBoys = explode("-", $ageBoys); ?>
                      <?php foreach($getAgeOfBoys as $key=>$ageOfBoys): ?>   
                        <input type="checkbox" name="ages_of_children[]" value="<?php echo $key;?>" <?php echo(in_array($key, $ageExplodeBoys)) ? 'checked="checked"' : ''?> ><?php echo $ageOfBoys; ?><br>
                      <?php endforeach; ?>
                      <input type="hidden" name="age_of_boys" value="<?php echo $getFamilyInformation->age_of_boys; ?>" />
                    </div>
                    <div class="form-group">
                      <label for="InputGirls">Girls</label><br />
                      <?php echo $getFamilyInformation->girls; ?>
                      <input type="hidden" name="girls" value="<?php echo $getFamilyInformation->girls; ?>" />
                    </div>
                   
                    <?php $ageGirls = $getFamilyInformation->age_of_girls; ?>
                    <?php $ageExplodeGirls = explode("-", $ageGirls); ?>
                    <div class="form-group">
                      <label for="InputAgeofgirls">Age of girls</label><br />
                        
                      <?php foreach($getAgeOfGirls as $key=>$ageOfGirls): ?>
                        <input type="checkbox" name="ages_of_children[]" value="<?php echo $key;?>" <?php echo(in_array($key, $ageExplodeGirls)) ? 'checked="checked"' : ''?> ><?php echo $ageOfGirls; ?><br>
                      <?php endforeach; ?>
                      <input type="hidden" name="age_of_girls" value="<?php echo $getFamilyInformation->age_of_girls; ?>" />
              
                    </div>
                    <div class="form-group">
                        <label for="InputStartdate">Start date</label><br />
                        <?php echo $getFamilyInformation->start_date; ?>
                        <input type="hidden" name="date" value="<?php echo $getFamilyInformation->start_date; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="InputDaysperweek">Days per week</label><br />
                        <?php $days_per_week = $getFamilyInformation->available_days_per_week; ?>
                        <?php $explodeWeek = explode("-", $days_per_week); ?>
                        <?php foreach($getDaysPerWeeks as $key=>$week): ?>
                            <input type="checkbox" name="ages_of_children[]" value="<?php echo $key;?>" <?php echo(in_array($key, $explodeWeek)) ? 'checked="checked"' : ''?> ><?php echo $week; ?><br>
                        <?php endforeach; ?>
                          <input type="hidden" name="days_per_week" value="<?php echo $getFamilyInformation->available_days_per_week;;?>" />
                    </div>
                    <div class="form-group">
                        <label for="InputFlexibledays">Are you flexible on days</label><br />
                        <?php $flexible_days = $getFamilyInformation->flexible_days; ?>
                        <?php if($flexible_days == 1):?>
                          <?php echo "Yes"; ?>
                        <?php else: ?>
                          <?php echo "No"; ?>
                        <?php endif; ?>
                        <input type="hidden" name="flexible_days" value="<?php echo $getFamilyInformation->flexible_days;?>" />
                    </div>

                    <div class="form-group">
                        <label for="InputHoursrequired">Hours required</label><br />
                        <?php echo $getFamilyInformation->hours_required; ?>
                        <input type="hidden" name="hours_required" value="<?php echo $getFamilyInformation->hours_required; ?>" />
                    </div>
                    <div class="form-group">
                      <label for="InputHavepets">Have pets</label><br />
                      <?php $have_pets = $getFamilyInformation->have_pets;?>
                      <?php if($have_pets == 1):?>
                        <?php echo "Yes"; ?>
                      <?php else: ?>
                        <?php echo "No"; ?>
                      <?php endif;?>
                      <input type="hidden" name="have_pets" value="<?php echo $getFamilyInformation->have_pets;  ?>" />
                    </div>
                    <?php if($getFamilyInformation->dog_cat != 0): ?>
                    <div class="form-group">
                        <label for="InputHavepets">Pets</label><br />
                        <?php $dog_cat =  $getFamilyInformation->dog_cat; ?>
                        <?php if($dog_cat == 1):?>
                          <?php echo "Dog"; ?>
                        <?php elseif($dog_cat == 2): ?>
                          <?php echo "Cat"; ?>
                        <?php endif;?>
                        <input type="hidden" name="pets_hide" value="<?php echo $getFamilyInformation->dog_cat;?>" />
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="InputChildactivities">Child activities</label><br />
                        <?php echo $getFamilyInformation->childs_activities; ?>
                        <input type="hidden" name="child_activities" value="<?php echo $getFamilyInformation->childs_activities;?>" />
                    </div>
                    <div class="form-group">
                        <label for="InputAlreadyhavenanny">Already have nanny</label><br />
                        <?php $aHn = $getFamilyInformation->already_have_nanny; ?>
                        <?php if($aHn == 1): ?>
                             <?php echo "Yes"; ?>
                        <?php else: ?>
                             <?php echo "No"; ?>
                        <?php endif; ?>
                        <input type="hidden" name="already_have_nanny" value="<?php echo $getFamilyInformation->already_have_nanny;?>" />
                    </div>
                    <div class="form-group">
                      <label for="InputRate">Rate of pay</label><br />
                      <?php echo $getFamilyInformation->rate_of_pay; ?> AUD
                      <input type="hidden" name="rate_of_pay" value="<?php echo $getFamilyInformation->rate_of_pay;?>" />
                    </div>
                    <div class="form-group">
                        <label for="InputPrefercare">Prefer care at</label><br />
                        <?php $prefer_care = $getFamilyInformation->prefer_care; ?>
                        <?php if($prefer_care == 1):?>
                          <?php echo "My House"; ?>
                        <?php elseif($prefer_care == 2): ?>
                          <?php echo "Your House"; ?>
                        <?php elseif($prefer_care == 3): ?>
                          <?php echo "Alternate"; ?>
                        <?php endif;?>
                        <input type="hidden" name="prefer_care" value="<?php echo $getFamilyInformation->prefer_care;?>" />
                    </div>
                    <div class="form-group">
                        <label for="Inputemail">Email</label><br />
                        <?php echo $getFamilyInformation->email_address;?>
                        <input type="hidden" name="email" value="<?php echo $getFamilyInformation->email_address;?>" />
                    </div>
                    
                    <div class="form-group">
                        <label for="InputAmount">Amount</label><br />
                          <label for="InputNumbert">$29.00 AUD</label>
                       
                    </div>
                    
                    <i class="fa fa-paypal">aypal</i>

                    <div class="col-md-13">
                      <input type="hidden" name="uId" value="<?php echo $getFamilyInformation->user_id; ?>" />
                      <button type="submit" class="btn btn-ar btn-primary pull-right">Proceed With Payment</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- container  -->
 