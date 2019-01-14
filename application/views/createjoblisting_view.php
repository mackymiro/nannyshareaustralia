
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="section-title no-margin-top">Create Job Listing</h2>
            <div class="panel panel-success-dark animated fadeInDown">
                <div class="panel-heading">Create Job Listing Form</div>
                <div class="panel-body">
                    <?php if($this->session->flashdata('success')): ?>
                      <div class="alert alert-success" role="alert">
                        You have successfully created a job. You may see your created job at <strong>see job listings</strong> page.
                      </div>
                    <?php endif; ?>
                    <form action="<?php echo base_url().'create-job-listing/add'?>" method="post">
                        <div class="error">
                            <?php echo validation_errors('<div class="error">','</div>');?>
                        </div>
                        <div class="form-group">
                            <label for="InputPostCode">Postcode<sup>*</sup></label>
                            <input type="text" class="form-control" value="<?php echo set_value('postcode');?>" name="postcode" />
                        </div>
                        <div class="form-group">
                            <label for="InputSuburb">Suburb<sup>*</sup></label>
                            <input type="text" class="form-control" value="<?php echo set_value('suburb');?>" name="suburb" />
                        </div>
                       <div class="form-group">
                          <label for="InputTypeofJob">Type of Job<sup>*</sup></label>
                          <select name="type_of_job" class="form-control">
                            <option value="0">-----SELECT ONE-----</option>
                            <option value="1">Mummy nanny</option>
                            <option value="2">Shared nanny</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="InputRateperHour">Rate per hour(total families combined)<sup>*</sup></label>
                            <input type="text" class="form-control" value="<?php echo set_value('rate_per_hour');?>" name="rate_per_hour" />
                        </div>
                        <div class="form-group">
                          <label for="InputNumberofChildren">Number of children(total families combined)<sup>*</sup></label>
                          <select name="number_of_children" class="form-control">
                            <option value="0">-----SELECT ONE-----</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="InputAgeofChildren">Age of children<sup>*</sup></label>
                          <select name="age_of_children" class="form-control">
                            <option value="0">-----SELECT ONE-----</option>
                            <option value="1">3 months</option>
                            <option value="2">6 months</option>
                            <option value="3">7 months</option>
                            <option value="4">8 months</option>
                            <option value="5">9 months</option>
                            <option value="6">1 yr</option>
                            <option value="7">2 yrs</option>
                            <option value="8">3 yrs</option>
                            <option value="9">4 yrs</option>
                            <option value="10">5 yrs</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="InputDaysofweek">Days of week required<sup>*</sup></label>
                          <select name="days_of_week" class="form-control">
                            <option value="0">-----SELECT ONE-----</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                            <option value="7">Sunday</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="InputFlexibledays">Flexible with days<sup>*</sup></label>
                          <select name="flexible_with_days" class="form-control">
                            <option value="0">-----SELECT ONE-----</option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="InputAboutUs">A little bit about us<sup>*</sup></label>
                          <textarea cols="5" rows="5" name="about_us" class="form-control" placeholder="A little bit about us"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" name="terms" value="option1"> I read <a href="<?php echo base_url().'terms-and-conditions.html'?>" title="Terms and Conditions" target="_blank">Terms and Conditions</a>.
                                </label>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-ar btn-primary pull-right">Create Job Listing</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container  -->