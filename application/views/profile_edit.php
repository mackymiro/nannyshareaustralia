<header class="main-header">
    <div class="container">
        <h1 class="page-title"><?php echo "Edit " .$type; ?> </h1>
    </div>
</header>
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/themes/base/jquery.ui.all.css">
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script><script src="<?php echo base_url()?>assets/js/jquery.ui.addresspicker.js"></script><script type="text/javascript">    $(document).ready(function(){      $("#have_pets").on('change', function(){         var pet = $("#have_pets").val();         if(pet == 1){            $('select[name="pets_hide"] option:first').prop('selected', true);           $("#pet_hide").show();         }else{           $("#pet_hide").hide();         }      });      $("#alert-success").fadeOut(3000);      $("#alert-danger").fadeOut(3000);    });        </script><script>    $(function() {      var addresspicker = $( "#addresspicker" ).addresspicker({        componentsFilter: 'country:FR'      });            var addresspickerMap = $( "#addresspicker_map" ).addresspicker({        regionBias: "fr",        updateCallback: showCallback,        mapOptions: {          zoom: 4,          center: new google.maps.LatLng(46, 2),          scrollwheel: false,          mapTypeId: google.maps.MapTypeId.ROADMAP        },        elements: {          map:      "#map",          lat:      "#lat",          lng:      "#lng",          street_number: '#street_number',          route: '#route',          locality: '#locality',          administrative_area_level_2: '#administrative_area_level_2',          administrative_area_level_1: '#administrative_area_level_1',          country:  '#country',          postal_code: '#postal_code',          type:    '#type'        }      });            var gmarker = addresspickerMap.addresspicker( "marker");      gmarker.setVisible(true);      addresspickerMap.addresspicker( "updatePosition");          $('#reverseGeocode').change(function(){        //alert('test');        $("#addresspicker_map").addresspicker("option", "reverseGeocode", ($(this).val() === 'true'));              });          function showCallback(geocodeResult, parsedGeocodeResult){        //alert('test');        $('#callback_result').text(JSON.stringify(parsedGeocodeResult, null, 4));      }      // Update zoom field      var map = $("#addresspicker_map").addresspicker("map");      google.maps.event.addListener(map, 'idle', function(){        $('#zoom').val(map.getZoom());      });              });    </script>
<div class="container">
    <div class="row">
        <?php if($type =="Family Profile"): ?>         <?php if($this->session->flashdata('error')): ?>                  
        <div id="alert-danger" class="alert alert-danger">
            <button class="close" data-dismiss="alert" type="button">×</button>                        
            <p >The filetype you are attempting to upload is not allowed.</p>
        </div>
        <?php endif; ?>        <?php if($this->session->flashdata('success')): ?>                  
        <div id="alert-success" class="alert alert-success">
            <button class="close" data-dismiss="alert" type="button">×</button>                        
            <p >Profile successfully updated!</p>
        </div>
        <?php endif;?>        <?php echo form_open_multipart('profile/update');?>        
        <div class="col-md-4">
            <section>                <?php if($query->profile_image == NULL):?>                  <img src="<?php echo base_url()?>assets/images/empty_image.png"  alt="avatar" class="img-responsive imageborder">                <?php else: ?>                  <img src="<?php echo base_url()?>assets/uploads/<?php echo "medium_size_".$query->profile_image; ?>" alt="avatar" class="img-responsive imageborder">                <?php endif; ?>                <input type="file" name="photo" />            </section>
            <section>
                <hr>
                <input type="hidden" name="profileType" value="<?php echo $query->account_type; ?>" />                <input type="hidden" name="editData" value="<?php echo $query->user_id; ?>" />                <input type="submit" class="btn btn-ar btn-block btn-warning" value="Update Profile" />            
            </section>
        </div>
        <div class="col-md-8">
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-user"></i> General Information</div>
                    <table class="table table-striped">
                        <tr>
                            <th>User Name</th>
                            <td><input disabled type="text" name="username" class="form-control" value="<?php echo $query->username; ?>" /></td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td><input type="text" name="firstname" class="form-control"  value="<?php echo $query->first_name; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td><input type="text" name="lastname" class="form-control"  value="<?php echo $query->last_name; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Address <br>(street number/name/suburb/state/postcode)</th>
                            <td><input disabled type="text" name="address" id="addresspicker_map" class="form-control"  value="<?php echo $query->address; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input disabled type="text" name="email" class="form-control"  value="<?php echo $query->email_address; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Number of children</th>
                            <td>
                                <select name="number_of_children" class="form-control">
                                    <?php foreach($numberOfChildrens as $key=>$children): ?>                                    
                                    <option value="<?php echo $key;?>" <?php echo ($query->number_of_children == $key) ? 'selected="selected"' : ''?>><?php echo $children; ?></option>
                                    <?php endforeach; ?>                                
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Boys</th>
                            <td>
                                <select name="boys" class="form-control">
                                    <?php foreach($numberOfboys as $key=>$boys): ?>                                    
                                    <option value="<?php echo $key;?>" <?php echo ($query->boys == $key) ? 'selected="selected"' : '' ?>><?php echo $boys; ?></option>
                                    <?php endforeach; ?>                                
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Age of boys</th>
                            <td>                            <?php $ageOfBoys = $query->age_of_boys; ?>                            <?php $ageOfBoys1 = explode("-", $ageOfBoys); ?>                            <?php foreach($agesOfBoysAndGirls as $key=>$boy): ?>                               <input type="checkbox" name="age_of_boys[]" value="<?php echo $key;?>" <?php echo(in_array($key, $ageOfBoys1)) ? 'checked="checked"' : ''?> ><?php echo $boy; ?><br>                            <?php endforeach; ?>                          </td>
                        </tr>
                        <tr>
                            <th>Girls</th>
                            <td>
                                <select name="girls" class="form-control">
                                    <?php foreach($numberOfgirls as $girls): ?>                                    
                                    <option value="<?php echo $girls; ?>" <?php echo ($query->girls == $girls) ? 'selected="selected"' : '' ?>><?php echo $girls; ?></option>
                                    <?php endforeach; ?>                                
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Age of girls</th>
                            <td>                            <?php $ageOfGirls = $query->age_of_girls; ?>                            <?php $ageOfGirls1 = explode("-", $ageOfGirls); ?>                            <?php foreach($agesOfBoysAndGirls as $key=>$girl): ?>                               <input type="checkbox" name="age_of_girls[]" value="<?php echo $key;?>" <?php echo(in_array($key, $ageOfGirls1)) ? 'checked="checked"' : ''?> ><?php echo $girl; ?><br>                            <?php endforeach; ?>                          </td>
                        </tr>
                        <tr>
                            <th>Start date</th>
                            <td><input type="text" name="start_date" id="datepicker" class="form-control" value="<?php echo $query->start_date; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Days per week</th>
                            <td>                            <?php $daysPerWeeks = $query->available_days_per_week; ?>                            <?php $daysPerWeeks1 = explode("-", $daysPerWeeks); ?>                             <?php foreach($daysPerWeekCheckboxes as $key=>$week): ?>                                <input type="checkbox" name="days_per_week[]" value="<?php echo $key;?>" <?php echo(in_array($key, $daysPerWeeks1)) ? 'checked="checked"' : ''?> ><?php echo $week; ?><br>                            <?php endforeach; ?>                            </td>
                        </tr>
                        <tr>
                            <th>Flexible days</th>
                            <td>
                                <select name="flexible_days" class="form-control">
                                    <?php foreach($flexibleDays as $key=>$flexibleDay): ?>                                                                  
                                    <option value="<?php echo $key;?>" <?php echo($query->available_days_per_week == $key) ? 'selected="selected"' : '' ?>><?php echo $flexibleDay; ?></option>
                                    <?php endforeach; ?>                                                            
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Hours required</th>
                            <td><input type="text" name="hours_required" class="form-control" value="<?php echo $query->hours_required; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Have pets</th>
                            <td>
                                <select id="have_pets" name="have_pets" class="form-control">
                                    <?php foreach($havePets as $key=>$pet): ?>                                    
                                    <option value="<?php echo $key;?>" <?php echo($query->have_pets == $key) ? 'selected="selected"' : '' ?>><?php echo $pet;?></option>
                                    <?php endforeach; ?>                                
                                </select>
                            </td>
                        </tr>
                        <tr id="pet_hide">
                            <th>Dog/Cat</th>
                            <td>
                                <select name="pets_hide" class="form-control" >
                                    <?php foreach($dogCat as $key=>$dogCat): ?>                                    
                                    <option value="<?php echo $key; ?>" <?php echo ($query->dog_cat == $key) ? 'selected="selected"' : ''?>><?php echo $dogCat; ?></option>
                                    <?php endforeach; ?>                                
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Childs activities</th>
                            <td><input type="text" name="child_act" class="form-control" value="<?php echo $query->childs_activities; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Already have nanny</th>
                            <td>
                                <select name="already_have_nanny" class="form-control">
                                    <?php foreach($alreadyHaveNannies as $key=>$nanny): ?>                                    
                                    <option value="<?php echo $key;?>" <?php echo ($query->already_have_nanny == $key) ? 'selected="selected"' : ''?>><?php echo $nanny;?></option>
                                    <?php endforeach; ?>                                
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Rate of pay</th>
                            <td><input type="text" name="rate_of_pay" class="form-control" value="<?php echo $query->rate_of_pay; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Prefer care</th>
                            <td>
                                <select name="prefer_care" class="form-control">
                                    <?php foreach($preferCares as $key=>$house): ?>                                    
                                    <option value="<?php echo $key; ?>" <?php echo ($query->prefer_care == $key) ? 'selected="selected"' : ''?>><?php echo $house; ?></option>
                                    <?php endforeach; ?>                                
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Additional Comments</th>
                            <td>                                <textarea name="add_comments" class="form-control" cols="20" rows="5" ><?php echo $query->additional_comments; ?></textarea>                            </td>
                        </tr>
                        <tr>
                            <th>Make profile visible/invisible</th>
                            <td>
                                <select name="visible" class="form-control">
                                    <?php foreach($visibles as $key=>$profileV): ?>                                    
                                    <option value="<?php echo $key;?>" <?php echo ($query->make_profile == $key) ? 'selected="selected"' : ''?>><?php echo $profileV; ?></option>
                                    <?php endforeach; ?>                                
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>
        </div>
        </form>        <?php elseif($type == "Nanny Profile"): ?>        <?php if($this->session->flashdata('error')): ?>                  
        <div id="alert-danger" class="alert alert-danger">
            <button class="close" data-dismiss="alert" type="button">×</button>                        
            <p >The filetype you are attempting to upload is not allowed.</p>
        </div>
        <?php endif; ?>         <?php if($this->session->flashdata('success')): ?>                  
        <div id="alert-success" class="alert alert-success">
            <button class="close" data-dismiss="alert" type="button">×</button>                        
            <p >Profile successfully updated!</p>
        </div>
        <?php endif;?>        <?php echo form_open_multipart('profile/update');?>              
        <div class="col-md-4">
            <section>                <?php if($query->profile_image == NULL):?>                <img src="<?php echo base_url()?>assets/images/empty_image.png" alt="avatar" class="img-responsive imageborder">                <?php else: ?>                  <img src="<?php echo base_url()?>assets/uploads/<?php echo "medium_size_".$query->profile_image; ?>" alt="avatar" class="img-responsive imageborder">                <?php endif; ?>                <input type="file" name="photo" />            </section>
            <section>
                <hr>
                <input type="hidden" name="profileType" value="<?php echo $query->account_type; ?>" />                <input type="hidden" name="editData" value="<?php echo $query->user_id; ?>" />                <input type="submit" class="btn btn-ar btn-block btn-warning" value="Update Profile" />            
            </section>
        </div>
        <div class="col-md-8">
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-user"></i> General Information</div>
                    <table class="table table-striped">
                        <tr>
                            <th>User Name</th>
                            <td><input disabled type="text" name="username" class="form-control" value="<?php echo $query->username;?>" /></td>
                        </tr>
                        <tr>
                            <th>FirstName</th>
                            <td><input type="text" name="firstname" class="form-control" value="<?php echo $query->first_name; ?>" /></td>
                        </tr>
                        <tr>
                            <th>LastName</th>
                            <td><input type="text" name="lastname" class="form-control" value="<?php echo $query->last_name; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Address <br>(street number/name/suburb/state/postcode)</th>
                            <td><input disabled type="text" name="address" id="addresspicker_map" class="form-control"  value="<?php echo $query->address; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input disabled type="text" name="email" class="form-control"  value="<?php echo $query->email_address; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Date of birth</th>
                            <td>
                                <?php                               $dob = $query->date_of_birth;                              $explode_dob = explode("-",$dob);                              ?>                                
                                <select name="year" class="form-control" style="width:90px; float:left;">
                                    <?php foreach($years as $key=>$y): ?>                                                                      
                                    <option value="<?php echo $key; ?>" <?php echo($explode_dob[0] == $key) ? 'selected="selected"' : '' ?>> <?php echo $y; ?></option>
                                    <?php endforeach; ?>                                
                                </select>
                                <select name="month" class="form-control" style="width:140px; float:left;">
                                    <?php foreach($months as $key=>$m): ?>                                                                      
                                    <option value="<?php echo $key;?>"  <?php echo($explode_dob[1] == $key) ? 'selected="selected"' : '' ?>> <?php echo $m; ?></option>
                                    <?php endforeach; ?>                                
                                </select>
                                <select name="days" class="form-control" style="width:90px; float:left;">
                                    <?php foreach($days as $key=>$day): ?>                                                                      
                                    <option value="<?php echo $key; ?>" <?php echo($explode_dob[2] == $key) ? 'selected="selected"' : '' ?>><?php echo $day; ?></option>
                                    <?php endforeach; ?>                                
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Mummy nanny/Shared nanny</th>
                            <td>
                                <select name="mummy_shared_nanny" class="form-control">
                                    <?php foreach($getMummySharedNannies as $key=>$mummyShared): ?>                                                                  
                                    <option value="<?php echo $key;?>" <?php echo($query->mummy_shared_nanny == $key) ? 'selected="selected"' : '' ?>><?php echo $mummyShared;?></option>
                                    <?php endforeach; ?>                                                            
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>I am a mummy nanny with a child aged</th>
                            <td><input type="text" name="mummynanny_childage" class="form-control" value="<?php echo $query->mummy_nanny_child_age; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Number of children prepared to care for</th>
                            <td>
                                <select name="number_of_children_prepared" class="form-control">
                                    <?php foreach($numberOfChildrenPrepares as $key=>$num): ?>                                                                      
                                    <option value="<?php echo $key; ?>" <?php echo($query->number_of_children_prepared_to_care_for == $key) ? 'selected="selected"' : '' ?>><?php echo $num; ?></option>
                                    <?php endforeach; ?>                                                              
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Ages of children cared for</th>
                            <td>                              <?php $agesOfChildrens = $query->ages_of_children_cared_of; ?>                              <?php $agesOfChildrens1 = explode("-", $agesOfChildrens); ?>                              <?php foreach($agesOfChildrenCheckboxes as $key=>$ageOfChildren): ?>                                <input type="checkbox" name="ages_of_children[]" value="<?php echo $key;?>" <?php echo(in_array($key, $agesOfChildrens1)) ? 'checked="checked"' : ''?> ><?php echo $ageOfChildren; ?><br>                              <?php endforeach; ?>                            </td>
                        </tr>
                        <tr>
                            <th>Available start date</th>
                            <td><input type="text" name="start_date" id="datepicker" class="form-control" value="<?php echo $query->start_date; ?>"  /></td>
                        </tr>
                        <tr>
                            <th>Available days per week</th>
                            <td>                            <?php $daysPerWeeks = $query->available_days_per_week; ?>                            <?php $daysPerWeeks1 = explode("-", $daysPerWeeks); ?>                             <?php foreach($daysPerWeekCheckboxes as $key=>$week): ?>                                <input type="checkbox" name="available_days_week[]" value="<?php echo $key;?>" <?php echo(in_array($key, $daysPerWeeks1)) ? 'checked="checked"' : ''?> ><?php echo $week; ?><br>                            <?php endforeach; ?>                            </td>
                        </tr>
                        <tr>
                            <th>Expected hourly rate</th>
                            <td><input type="text" name="hourly_rate" class="form-control" value="<?php echo $query->expected_hourly_rate; ?>" /></td>
                        </tr>
                        <tr>
                            <th>Have ABN</th>
                            <td>
                                <select name="have_abn" class="form-control">
                                    <?php foreach($haveAbns as $key=>$abn): ?>                                                                    
                                    <option value="<?php echo $key; ?>" <?php echo($query->have_abn == $key) ? 'selected="selected"' : '' ?>><?php echo $abn; ?></option>
                                    <?php endforeach; ?>                                                              
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Have driver's licence</th>
                            <td>
                                <select name="have_driverslicence" class="form-control">
                                    <?php foreach($haveDriversLicences as $key=>$licence): ?>                                                                    
                                    <option value="<?php echo $key; ?>" <?php echo($query->have_drivers_licence == $key) ? 'selected="selected"' : '' ?>><?php echo $licence;?></option>
                                    <?php endforeach; ?>                                                              
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Have first aid certificate</th>
                            <td>
                                <select name="have_firstaid" class="form-control">
                                    <?php foreach($haveFirstAids as $key=>$aid): ?>                                                                    
                                    <option value="<?php echo $key; ?>" <?php echo($query->have_first_aid_certificate == $key) ? 'selected="selected"' : '' ?>><?php echo $aid; ?></option>
                                    <?php endforeach; ?>                                                              
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Registered carrer</th>
                            <td>
                                <select name="registered_carrer" class="form-control">
                                    <?php foreach($registeredCarrers as $key=>$carrer): ?>                                                                      
                                    <option value="<?php echo $key; ?>" <?php echo($query->registered_carrer == $key) ? 'selected="selected"' : '' ?>><?php echo $carrer; ?></option>
                                    <?php endforeach; ?>                                                              
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Years experience as a nanny</th>
                            <td>
                                <select name="nanny_exp" class="form-control">
                                    <?php foreach($nannyExps as $key=>$exp): ?>                                                                    
                                    <option value="<?php echo $key?>" <?php echo($query->yr_exp_as_nanny == $key) ? 'selected="selected"' : '' ?>><?php echo $exp; ?></option>
                                    <?php endforeach; ?>                                                              
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Multiple children experience</th>
                            <td>
                                <select name="multiple_exp" class="form-control">
                                    <?php foreach($multipleExps as $key=>$exp): ?>                                                                    
                                    <option value="<?php echo $key;?>" <?php echo ($query->multiple_children_exp == $key) ? 'selected="selected"' : '' ?>><?php echo $exp; ?></option>
                                    <?php endforeach; ?>                                                              
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Other skills</th>
                            <td>                                <textarea name="other_skills" class="form-control" cols="20" rows="5"><?php echo $query->other_skills; ?></textarea>                            </td>
                        </tr>
                        <tr>
                            <th>A little about myself</th>
                            <td>                                <textarea name="about_myself" class="form-control" cols="20" rows="5"><?php echo $query->a_little_about_myself; ?></textarea>                            </td>
                        </tr>
                        <tr>
                            <th>Make profile visible/invisible</th>
                            <td>
                                <select name="visible" class="form-control">
                                    <?php foreach($visibles as $key=>$v): ?>                                    
                                    <option value="<?php echo $key; ?>" <?php echo($query->make_profile == $key) ? 'selected="selected"' : '' ?>><?php echo $v; ?></option>
                                    <?php endforeach; ?>                                                            
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>
        </div>
        </form>        <?php endif; ?>          
    </div>
</div>
<!-- container  --><script>       var date = new Date();      var currentMonth = date.getMonth();      var currentDate = date.getDate();      var currentYear = date.getFullYear();            $('#datepicker').datepicker({        minDate: new Date(currentYear, currentMonth, currentDate),        dateFormat: "yy-mm-dd"      });    </script>

