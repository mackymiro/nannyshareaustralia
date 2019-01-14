<header class="main-header">
    <div class="container">
        <h1 class="page-title"><?php echo $query->profile_type; ?> </h1>
    </div>
</header>

<div class="container">
    <div class="row">
       <?php if($query->profile_type =="Family Profile"): ?>
        <div class="col-md-4">
            <section>
                <?php if($query->profile_image == NULL):?>
                  <img src="<?php echo base_url()?>assets/images/empty_image.png"  alt="avatar" class="img-responsive imageborder">
                <?php else: ?>
                  <img src="<?php echo base_url()?>assets/uploads/<?php echo "medium_size_".$query->profile_image; ?>" alt="avatar" class="img-responsive imageborder">
                <?php endif; ?>
                <br />
                
                <a href="<?php echo base_url().'messages/id/'.$query->user_id;?>" title="Send A Message" class="btn btn-ar btn-block btn-primary" >Send A Message</a>
            </section>
        </div>
        <div class="col-md-8">
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-user"></i> General Information</div>
                    <table class="table table-striped">
                         <tr>
                            <th>User Name</th>
                            <td>
                               <?php echo $query->username; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Fullname</th>
                            <td><?php echo $query->first_name; ?> <?php echo $query->last_name; ?></td>
                        </tr>
                        <tr>
                            <th>Postcode</th>
                            <td>
                              <?php if($query->suburb_postcode == NULL): ?>
                                <?php echo "N/A";?>
                              <?php else: ?>
                                <?php echo $query->suburb_postcode; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                          <th>Number of children</th>
                          <td>
                            <?php if($query->number_of_children == NULL): ?>
                              <?php echo "N/A";?>
                            <?php else: ?>
                              <?php echo $query->number_of_children; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Boys</th>
                          <td>
                            <?php if($query->boys == 0): ?>
                              <?php echo "No boys"; ?>
                            <?php else: ?>
                              <?php echo $query->boys; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Age of boys</th>
                         <td>
                            <?php $ageOfBoys = $query->age_of_boys; ?>
                            <?php $ageOfBoys1 = explode("-", $ageOfBoys); ?> 
                            <?php if($ageOfBoys == NULL || $ageOfBoys == 0): ?>
                              <?php echo "N/A";?>
                            <?php else: ?>
                            <?php foreach($agesOfBoysAndGirls as $key=>$boy): ?>
                              <input type="checkbox" name="age_of_boys[]" value="<?php echo $key;?>" <?php echo(in_array($key, $ageOfBoys1)) ? 'style="color:green; " checked="checked"' : ''?> ><?php echo $boy; ?><br>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        </tr>
                        <tr>
                          <th>Girls</th>
                          <td>
                            <?php if($query->girls == 0): ?>
                              <?php echo "No girls"; ?>
                            <?php else: ?>
                              <?php echo $query->girls; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Age of girls</th>
                          <td>
                           <?php $ageOfGirls = $query->age_of_girls; ?>
                            <?php $ageOfGirls1 = explode("-", $ageOfGirls); ?> 
                            <?php if($ageOfGirls == NULL || $ageOfGirls == 0): ?>
                              <?php echo "N/A";?>
                            <?php else: ?>
                            <?php foreach($agesOfBoysAndGirls as $key=>$girl): ?>
                              <input type="checkbox" name="age_of_boys[]" value="<?php echo $key;?>" <?php echo(in_array($key, $ageOfGirls1)) ? 'style="color:green; " checked="checked"' : ''?> ><?php echo $girl; ?><br>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Start date</th>
                          <td>
                           <?php if($query->start_date == "0000-00-00"): ?>
                              <?php echo "N/A";?>
                            <?php else: ?>
                              <?php echo $query->start_date; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Days per week</th>
                          <td>
                            <?php $daysPerWeeks = $query->available_days_per_week; ?>
                            <?php $daysPerWeeks1 = explode("-", $daysPerWeeks); ?> 
                            <?php if($daysPerWeeks == NULL || $daysPerWeeks == 0): ?>
                              <?php echo "N/A";?>
                            <?php else: ?>
                            <?php foreach($daysPerWeekCheckboxes as $key=>$week): ?>
                              <input type="checkbox" name="days_per_week[]" value="<?php echo $key;?>" <?php echo(in_array($key, $daysPerWeeks1)) ? 'style="color:green; " checked="checked"' : ''?> ><?php echo $week; ?><br>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                         <tr>
                          <th>Flexible days</th>
                          <td>  
                          <?php $flexible_days =  $query->flexible_days; ?>
                          <?php if($flexible_days == 0): ?>
                            <?php echo "N/A"; ?>
                          <?php elseif($flexible_days == 1): ?>
                            <?php echo "Yes"; ?>
                          <?php else: ?>
                            <?php echo "No"; ?>
                          <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Hours required</th>
                          <td>
                            <?php if($query->hours_required == NULL): ?>
                              <?php echo "N/A";?>
                            <?php else: ?>
                              <?php echo $query->hours_required; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Have pets</th>
                          <td>
                            <?php if($query->have_pets == 0): ?>
                              <?php echo "N/A";?>
                            <?php elseif($query->have_pets == 1): ?>
                              <?php echo  "Yes"; ?>
                            <?php else: ?>
                              <?php echo "No"; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <?php if($query->have_pets == 1): ?>
                        <tr>
                          <th>Dog/Cat</th>
                          <td>
                            <?php if($query->dog_cat == 1): ?>
                              <?php echo "Dog"; ?>
                            <?php else: ?>
                              <?php echo "Cat"; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                          <th>Childs activities</th>
                          <td>
                            <?php if($query->childs_activities == NULL): ?>
                              <?php echo "N/A";?>
                            <?php else: ?>
                               <?php echo $query->childs_activities; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Already have nanny</th>
                          <td>
                            <?php if($query->already_have_nanny == NULL | $query->already_have_nanny == 0): ?>
                              <?php echo "N/A"; ?>
                            <?php elseif($query->already_have_nanny == 1): ?>
                              <?php echo "Yes"; ?>
                            <?php else: ?>
                              <?php echo "No"; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Hourly rate per family</th>
                          <td>
                            <?php if($query->rate_of_pay == NULL): ?>
                              <?php echo "N/A"; ?>
                            <?php else: ?>
                              <?php echo $query->rate_of_pay; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Prefer care at</th>
                          <td>
                            <?php if($query->prefer_care == 1): ?>
                              <?php echo  "My house";?>
                            <?php elseif($query->prefer_care == 2): ?>
                              <?php echo "Your house"; ?>
                            <?php elseif($query->prefer_care == 3): ?>
                              <?php echo "Alternate"; ?>
                            <?php else: ?>
															<?php echo  "My house";?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Additional Comments</th>
                          <td>
                            <?php if($query->additional_comments == NULL): ?>
                              <?php echo "N/A"; ?>
                            <?php else: ?>
                              <?php echo $query->additional_comments; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Profile is </th>
                          <td>
                            <?php if($query->make_profile == 1): ?>
                              <?php echo "Visible";?>
                            <?php else: ?>
                              <?php echo "Invisible"; ?>
                            <?php endif; ?>
                          </td>
                        </tr>  
                    </table>
                    
                </div>
            </section>          
        </div>
      <?php elseif($query->profile_type == "Nanny Profile"): ?>
        <div class="col-md-4">
            <section>
                <?php if($query->profile_image == NULL):?>
                  <img src="<?php echo base_url()?>assets/images/empty_image.png"  alt="avatar" class="img-responsive imageborder">
                <?php else: ?>
                  <img src="<?php echo base_url()?>assets/uploads/<?php echo "medium_size_".$query->profile_image; ?>" alt="avatar" class="img-responsive imageborder">
                <?php endif; ?>
                <br />
                <a href="<?php echo base_url().'messages/id/'.$query->user_id;?>" title="Send A Message" class="btn btn-ar btn-block btn-primary" >Send A Message</a>
            </section>
        </div>
        <div class="col-md-8">
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-user"></i> General Information</div>
                    <table class="table table-striped">
                         <tr>
                            <th>User Name</th>
                            <td><?php echo $query->username; ?></td>
                        </tr>
                        <tr>
                            <th>Fullname</th>
                            <td><?php echo $query->first_name; ?> <?php echo $query->last_name; ?></td>
                        </tr>
                        <tr>
                            <th>Date of birth</th>
                            <td>
                              <?php if($query->date_of_birth == "0000-00-00"): ?>
                                <?php echo "N/A";?>
                              <?php else: ?>
                                <?php echo date('M',strtotime($query->date_of_birth));?> 
                                <?php echo date('d',strtotime($query->date_of_birth));?>
                                <?php echo date('Y',strtotime($query->date_of_birth));?>
                              <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Postcode</th>
                            <td>
                              <?php if($query->suburb_postcode == NULL): ?>
                                <?php echo "N/A";?>
                              <?php else: ?>
                                <?php echo $query->suburb_postcode; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                          <th>Mummy nanny/Shared nanny</th>
                          <td>
                            <?php if($query->mummy_shared_nanny == 0): ?>
                              <?php echo "N/A"?>
                            <?php elseif($query->mummy_shared_nanny == 1): ?>
                              <?php echo  "Mummy Nanny"; ?>
                            <?php else: ?>
                              <?php echo "Shared Nanny"; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
												<tr>
													<th>I am a mummy nanny with a child aged</th>
													<td>
														<?php if($query->mummy_nanny_child_age == NULL): ?>
															<?php echo "N/A";?>
														<?php else: ?>
															<?php echo $query->mummy_nanny_child_age; ?>
														<?php endif; ?>
													</td>
                        </tr>
                         <tr>
                            <th>Number of children prepared to care for</th>
                            <td>
                              <?php if($query->number_of_children_prepared_to_care_for == NULL || $query->number_of_children_prepared_to_care_for == 0): ?>
                                <?php echo "N/A";?>
                              <?php else: ?>
                                 <?php echo $query->number_of_children_prepared_to_care_for; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                         <tr>
                            <th>Ages of children cared for</th>
                            <td>
                              <?php $agesOfChildrens = $query->ages_of_children_cared_of; ?>
                              <?php $agesOfChildrens1 = explode("-", $agesOfChildrens); ?>
                              <?php if($agesOfChildrens == NULL || $agesOfChildrens == 0): ?>
                                <?php echo "N/A";?>
                              <?php else: ?>
                              <?php foreach($agesOfChildrenCheckboxes as $key=>$ageOfChildren): ?>
                                <input type="checkbox" name="ages_of_children[]" value="<?php echo $key;?>" <?php echo(in_array($key, $agesOfChildrens1)) ? 'checked="checked"' : ''?> ><?php echo $ageOfChildren; ?><br>
                              <?php endforeach; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Available start date</th>
                            <td>
                              <?php if($query->start_date == "0000-00-00"): ?>
                                <?php echo "N/A";?>
                              <?php else: ?>
                                <?php echo $query->start_date; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                          <th>Available days per week</th>
                          <td>
                            <?php $daysPerWeeks = $query->available_days_per_week; ?>
                            <?php $daysPerWeeks1 = explode("-", $daysPerWeeks); ?> 
                            <?php if($daysPerWeeks == NULL || $daysPerWeeks == 0): ?>
                              <?php echo "N/A";?>
                            <?php else: ?>
                            <?php foreach($daysPerWeekCheckboxes as $key=>$week): ?>
                              <input type="checkbox" name="available_days_week[]" value="<?php echo $key;?>" <?php echo(in_array($key, $daysPerWeeks1)) ? 'style="color:green; " checked="checked"' : ''?> ><?php echo $week; ?><br>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                         <tr>
                            <th>Expected hourly rate</th>
                            <td>
                              <?php if($query->expected_hourly_rate == NULL): ?>
                                <?php echo "N/A";?>
                              <?php else: ?>
                                <?php echo $query->expected_hourly_rate; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Have ABN</th>
                            <td>
                              <?php if($query->have_abn == NULL || $query->have_abn == 0): ?>
                                <?php echo "N/A"; ?>
                              <?php elseif($query->have_abn == 1): ?>
                                <?php echo "Yes"; ?>
                              <?php else: ?>
                                <?php echo "No";?>
                              <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Have driver's licence</th>
                            <td>
                              <?php if($query->have_drivers_licence == NULL || $query->have_drivers_licence == 0): ?>
                                <?php echo "N/A"; ?>
                              <?php elseif($query->have_drivers_licence == 1): ?>
                                <?php echo "Yes"; ?>
                              <?php else: ?>
                                <?php echo "No"; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Have first aid certificate</th>
                            <td>
                              <?php if($query->have_first_aid_certificate == NULL || $query->have_first_aid_certificate == 0): ?>
                                <?php echo "N/A"; ?>
                              <?php elseif($query->have_first_aid_certificate == 1): ?>
                                <?php echo "Yes"; ?>
                              <?php else: ?>
                                <?php echo "No"; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                         <tr>
                            <th>Registered carrer</th>
                            <td>
                              <?php if($query->registered_carrer == NULL || $query->registered_carrer == 0): ?>
                                <?php echo "N/A"; ?>
                              <?php elseif($query->registered_carrer == 1): ?>
                                <?php echo "Yes"; ?>
                              <?php else: ?>
                                <?php echo "No";?>
                              <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Years experience as a nanny</th>
                            <td>
                              <?php if($query->yr_exp_as_nanny == NULL || $query->yr_exp_as_nanny == 0 ):?>
                                <?php echo "N/A";?>
                              <?php else: ?>
                                <?php echo $query->yr_exp_as_nanny; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                         <tr>
                            <th>Multiple children experience</th>
                            <td>
                              <?php if($query->multiple_children_exp == NULL || $query->multiple_children_exp == 0): ?>
                                <?php echo "N/A"; ?>
                              <?php elseif($query->multiple_children_exp == 1): ?>
                                <?php echo "Yes"; ?>
                              <?php else: ?>
                                <?php echo "No"; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Other skills</th>
                            <td>
                              <?php if($query->other_skills == NULL):?>
                                <?php echo "N/A";?>
                              <?php else: ?>
                                <?php echo $query->other_skills; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                         <tr>
                            <th>A little about myself</th>
                            <td>
                              <?php if($query->a_little_about_myself == NULL):?>
                                <?php echo "N/A";?>
                              <?php else: ?>
                                <?php echo $query->a_little_about_myself; ?>
                              <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                          <th>Profile is</th>
                          <td><?php if($query->make_profile == 1): ?>
                                <?php echo "Visible"; ?>
                              <?php else: ?>
                                <?php echo  "Invisible"; ?>
                              <?php endif; ?>
                          </td>
                        </tr>
                     
                    </table>
                </div>
            </section>    
        </div>
      <?php endif; ?>  
    </div>
</div> <!-- container  -->