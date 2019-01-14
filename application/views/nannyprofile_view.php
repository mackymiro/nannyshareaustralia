<?php error_reporting(0); ?>
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/themes/base/jquery.ui.all.css">
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.ui.addresspicker.js"></script>

<script>
  $(function() {
    var addresspicker = $( "#addresspicker" ).addresspicker({
      componentsFilter: 'country:FR'
    });
    
    var addresspickerMap = $( "#addresspicker_map" ).addresspicker({
      regionBias: "fr",
      updateCallback: showCallback,
      mapOptions: {
        zoom: 4,
        center: new google.maps.LatLng(46, 2),
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      },
      elements: {
        map:      "#map",
        lat:      "#lat",
        lng:      "#lng",
        street_number: '#street_number',
        route: '#route',
        locality: '#locality',
        administrative_area_level_2: '#administrative_area_level_2',
        administrative_area_level_1: '#administrative_area_level_1',
        country:  '#country',
        postal_code: '#postal_code',
        type:    '#type'
      }
    });
    
    var gmarker = addresspickerMap.addresspicker( "marker");
    gmarker.setVisible(true);
    addresspickerMap.addresspicker( "updatePosition");

    $('#reverseGeocode').change(function(){
      //alert('test');
      $("#addresspicker_map").addresspicker("option", "reverseGeocode", ($(this).val() === 'true'));
      
    });

    function showCallback(geocodeResult, parsedGeocodeResult){
      //alert('test');
      $('#callback_result').text(JSON.stringify(parsedGeocodeResult, null, 4));
    }
    // Update zoom field
    var map = $("#addresspicker_map").addresspicker("map");
    google.maps.event.addListener(map, 'idle', function(){
      $('#zoom').val(map.getZoom());
    });
    

  });
 
</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="section-title no-margin-top">Create Nanny Profile Account</h2>
            <div class="panel panel-success-dark animated fadeInDown">
                <div class="panel-heading">Nanny Profile Form</div>
                <div class="panel-body">
                    <?php if($this->session->flashdata('success')): ?>
                      <div class="success_reg">
                        <p class="alert alert-success">You are successfully registered!</p>
                      </div>
                    <?php endif; ?>
                    <?php echo form_open_multipart('nanny-profile/add');?>
                        <div class="error">
                            <?php echo validation_errors('<div class="error">','</div>');?>
                        </div>
                       <div style="color:red; font-size:18px; ">
                            <button class="close" data-dismiss="alert" type="button">×</button>            
                            <p ><?php echo $error; ?></p>
                        </div>
                       
                        <div style="color:red; font-size:18px; ">
                            <button class="close" data-dismiss="alert" type="button">×</button>            
                            <p ><?php echo $empty; ?></p>
                        </div>
 
                        <div class="form-group">
                            <label for="InputUserName">User Name<sup>*</sup></label>
                            <input type="text" class="form-control" value="<?php echo set_value('username');?>" name="username" />
                        </div>
                        <div class="form-group">
                            <label for="InputFirstName">First Name<sup>*</sup></label>
                            <input type="text" class="form-control" name="firstname" value="<?php echo set_value('firstname');?>"/>
                        </div>
                        <div class="form-group">
                            <label for="InputLastName">Last Name<sup>*</sup></label>
                            <input type="text" class="form-control" name="lastname" value="<?php echo set_value('lastname');?>" /> 
                        </div>
                        <div class="form-group">
                                <label for="InputAddress">Address (street number/name/suburb)<sup>*</sup></label>
                           <input type="text" class="form-control" name="address" id="addresspicker_map" value="<?php echo set_value('address');?>" /> 
                        </div>
                        <div class="form-group">
                                <label for="InputSuburb">Suburb<sup>*</sup></label>
                           <input type="text" class="form-control" name="suburb"  value="<?php echo set_value('suburb');?>" /> 
                        </div>
                        <div class="form-group">
                            <label for="InputState">State<sup>*</sup></label>
                             <select name="state" class="form-control">
                                    <option value="0">-----SELECT ONE-----</option>
                                    <option value="NSW" <?php echo set_select('state', 'NSW')?>>NSW</option>
                                    <option value="Victoria" <?php echo set_select('state', 'Victoria')?>>Victoria</option>
                                    <option value="South Australia" <?php echo set_select('state', 'South Australia')?>>South Australia</option>
                                    <option value="Western Australia" <?php echo set_select('state', 'Western Australia')?>>Western Australia</option>
                                    <option value="Queensland" <?php echo set_select('state', 'Queensland')?>>Queensland</option>
                                    <option value="Northern Territory" <?php echo set_select('state', 'Northern Territory')?>>Northern Territory</option>
                                    <option value="ACT" <?php echo set_select('state', 'ACT')?>>ACT</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="Inputsuburb">Postcode<sup>*</sup></label>
                            <input type="text" class="form-control" name="postcode" value="<?php echo set_value('postcode');?>"/>
                        </div>
                        <div class="form-group">
                            <label for="InputFile">Upload Photo<sup>*</sup></label>
                            <input type="file" name="photo" />
                        </div>
                        <div class="form-group">
                            <label for="Inputmummyandshared">Mummy nanny/Shared nanny<sup>*</sup></label>
                            <select name="mummy_shared_nanny" class="form-control">
                              <option value="0">-----SELECT ONE-----</option>
                              <option value="1" <?php echo set_select('mummy_shared_nanny', '1');?>>Mummy Nanny</option>
                              <option value="2" <?php echo set_select('mummy_shared_nanny', '2');?>>Shared Nanny</option>
                            </select>
                        </div>
												 <div class="form-group">
                            <label for="Inputmummynannychildage">I am a mummy nanny with a child aged<sup>*</sup></label>
                            <input type="text" class="form-control" name="mummynanny_childage" value="<?php echo set_value('mummynanny_childage');?>"/>
                        </div>
                        <div class="form-group">
                            <label for="InputNumberofchildren">Number of children prepared to care for<sup>*</sup></label>
                            <select name="number_of_children" class="form-control">
                              <option value="0">-----SELECT ONE-----</option>
                              <option value="1" <?php echo set_select('number_of_children', '1')?>>1</option>
                              <option value="2" <?php echo set_select('number_of_children', '2')?>>2</option>
                              <option value="3" <?php echo set_select('number_of_children', '3')?>>3</option>
                              <option value="4" <?php echo set_select('number_of_children', '4')?>>4</option>
                              <option value="5" <?php echo set_select('number_of_children', '5')?>>5</option>
                              <option value="6" <?php echo set_select('number_of_children', '6')?>>6</option>
                              <option value="7" <?php echo set_select('number_of_children', '7')?>>7</option>
                              <option value="8" <?php echo set_select('number_of_children', '8')?>>8</option>
                              <option value="9" <?php echo set_select('number_of_children', '9')?>>9</option>
                              <option value="10" <?php echo set_select('number_of_children', '10')?>>10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Inputagesofchildren">Ages of children cared for<sup>*</sup></label>
                            <br>
                            <input type="checkbox" name="ages_of_children[]" value="1" <?php echo set_checkbox('ages_of_children[]', '1'); ?>>0-3months<br>
                            <input type="checkbox" name="ages_of_children[]" value="2" <?php echo set_checkbox('ages_of_children[]', '2'); ?>>3-6months<br>
                            <input type="checkbox" name="ages_of_children[]" value="3" <?php echo set_checkbox('ages_of_children[]', '3'); ?>>6-12months<br>
                            <input type="checkbox" name="ages_of_children[]" value="4" <?php echo set_checkbox('ages_of_children[]', '4'); ?>>1-2years<br>
                            <input type="checkbox" name="ages_of_children[]" value="5" <?php echo set_checkbox('ages_of_children[]', '5'); ?>>2-3years<br>
                            <input type="checkbox" name="ages_of_children[]" value="6" <?php echo set_checkbox('ages_of_children[]', '6'); ?>>3-4years<br>
                            <input type="checkbox" name="ages_of_children[]" value="7" <?php echo set_checkbox('ages_of_children[]', '7'); ?>>4-5years<br>
                        </div>
                        <div class="form-group">
                            <label for="Inputdate">Available start date<sup>*</sup></label>
                            <input type="text" class="form-control" name="date" id="datepicker" value="<?php echo set_value('date');?>"/>
                        </div>
                        <div class="form-group">
                            <label for="Inputdaysperweek">Available days per week (you can choose more than one)<sup>*</sup></label>
                            <br>
                            <input type="checkbox" name="available_days_week[]" value="1" <?php echo set_checkbox('available_days_week[]', '1'); ?>>Sunday<br>
                            <input type="checkbox" name="available_days_week[]" value="2" <?php echo set_checkbox('available_days_week[]', '2'); ?>>Monday<br>
                            <input type="checkbox" name="available_days_week[]" value="3" <?php echo set_checkbox('available_days_week[]', '3'); ?>>Tuesday<br>
                            <input type="checkbox" name="available_days_week[]" value="4" <?php echo set_checkbox('available_days_week[]', '4'); ?>>Wednesday<br>
                            <input type="checkbox" name="available_days_week[]" value="5" <?php echo set_checkbox('available_days_week[]', '5'); ?>>Thursday<br>
                            <input type="checkbox" name="available_days_week[]" value="6" <?php echo set_checkbox('available_days_week[]', '6'); ?>>Friday<br>
                            <input type="checkbox" name="available_days_week[]" value="7" <?php echo set_checkbox('available_days_week[]', '7'); ?>>Saturday<br>
                        </div>
                        <div class="form-group">
                          <label for="Inputhourlyrate">Expected hourly rate<sup>*</sup></label>
                          <input type="text" name="hourly_rate" class="form-control" value="<?php echo set_value('hourly_rate');?>"/>  
                        </div>
                        <div class="form-group">
                            <label for="Inputhaveabn">Have ABN<sup>*</sup></label>
                            <select name="have_abn" class="form-control">
                              <option value="0">-----SELECT ONE-----</option>
                              <option value="1" <?php echo set_select('have_abn', '1')?>>Yes</option>
                              <option value="2" <?php echo set_select('have_abn', '2')?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Inputdriverslicence">Have driver's licence<sup>*</sup></label>
                            <select name="have_driversl" class="form-control">
                              <option value="0">-----SELECT ONE-----</option>
                              <option value="1" <?php echo set_select('have_driversl', '1')?>>Yes</option>
                              <option value="2" <?php echo set_select('have_driversl', '2')?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Inputhavefirstaid">Have first aid certificate<sup>*</sup></label>
                            <select name="have_firstaid" class="form-control">
                              <option value="0">-----SELECT ONE-----</option>
                              <option value="1" <?php echo set_select('have_firstaid', '1')?>>Yes</option>
                              <option value="2" <?php echo set_select('have_firstaid', '2')?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Inputregisteredcarrer">Registered carer<sup>*</sup></label>
                            <select name="registered_carrer" class="form-control">
                              <option value="0">-----SELECT ONE-----</option>
                              <option value="1" <?php echo set_select('registered_carrer', '1')?>>Yes</option>
                              <option value="2" <?php echo set_select('registered_carrer', '2')?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Inputnannyyrs">Years experience as a nanny<sup>*</sup></label>
                            <select name="yr_exp_nanny" class="form-control">
                            <option value="0">-----SELECT ONE-----</option>
                            <option value="1" <?php echo set_select('yr_exp_nanny', '1')?> >1yr</option>
                            <option value="2" <?php echo set_select('yr_exp_nanny', '2')?>>2yrs</option>
                            <option value="3" <?php echo set_select('yr_exp_nanny', '3')?>>3yrs</option>
                            <option value="4" <?php echo set_select('yr_exp_nanny', '4')?>>4yrs</option>
                            <option value="5" <?php echo set_select('yr_exp_nanny', '5')?>>5yrs</option>
                            <option value="6" <?php echo set_select('yr_exp_nanny', '6')?>>6yrs</option>
                            <option value="7" <?php echo set_select('yr_exp_nanny', '7')?>>7yrs</option>
                            <option value="8" <?php echo set_select('yr_exp_nanny', '8')?>>8yrs</option>
                            <option value="9" <?php echo set_select('yr_exp_nanny', '9')?>>9yrs</option>
                            <option value="10" <?php echo set_select('yr_exp_nanny', '10')?>>10yrs</option>
                            <option value="11" <?php echo set_select('yr_exp_nanny', '11')?>>11yrs</option>
                            <option value="12" <?php echo set_select('yr_exp_nanny', '12')?>>12yrs</option>
                            <option value="13" <?php echo set_select('yr_exp_nanny', '13')?>>13yrs</option>
                            <option value="14" <?php echo set_select('yr_exp_nanny', '14')?>>14yrs</option>
                            <option value="15" <?php echo set_select('yr_exp_nanny', '15')?>>15yrs</option>
                            <option value="16" <?php echo set_select('yr_exp_nanny', '16')?>>16yrs</option>
                            <option value="17" <?php echo set_select('yr_exp_nanny', '17')?>>17yrs</option>
                            <option value="18" <?php echo set_select('yr_exp_nanny', '18')?>>18yrs</option>
                            <option value="19" <?php echo set_select('yr_exp_nanny', '19')?>>19yrs</option>
                            <option value="20" <?php echo set_select('yr_exp_nanny', '20')?>>20yrs</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Inputmultiple">Multiple children experience<sup>*</sup></label>
                            <select name="multiple_children_exp" class="form-control">
                              <option value="0">-----SELECT ONE-----</option>
                              <option value="1" <?php echo set_select('multiple_children_exp', '1')?>>Yes</option>
                              <option value="2" <?php echo set_select('multiple_children_exp', '2')?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="InputEmail">Email<sup>*</sup></label>
                          <input type="email" class="form-control" name="email" value="<?php echo set_value('email');?>"/>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputPassword">Password<sup>*</sup></label>
                                    <input type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>" /> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputConfirmPassword">Confirm Password<sup>*</sup></label>
                                    <input type="password" class="form-control" name="conf_password" value="<?php echo set_value('conf_password');?>" />
                                </div>
                            </div>
                        </div>
 
                        <div class="row">
                            <div class="col-md-8">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" name="terms[]" value="option1" <?php echo set_checkbox('terms[]', 'option1');?> > I read <a href="<?php echo base_url().'terms-and-conditions.html'?>" title="Terms and Conditions" target="_blank">Terms and Conditions</a>.
                                </label>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-ar btn-primary pull-right">Create Nanny Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container  -->
<script> 
      var date = new Date();
      var currentMonth = date.getMonth();
      var currentDate = date.getDate();
      var currentYear = date.getFullYear();
      
      $('#datepicker').datepicker({
        minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: "yy-mm-dd"
      });
    
</script>
 