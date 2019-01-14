<?php error_reporting(0); ?>
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/themes/base/jquery.ui.all.css">
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.ui.addresspicker.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#pet_hide").hide();
    $("#age_boys").hide();
    $("#age_girls").hide();
     $('#have_pets').on('change', function() {
          //alert( this.value ); // or $(this).val()
          var pet = $('#have_pets').val();
          if(pet == 1){
            //$("#pet_hide option:first").prop('selected',true);
             $('select[name="pets_hide"] option:first').prop('selected', true);
            $("#pet_hide").show();
          }else{
            $("#pet_hide").hide();
                    
          }
     });
     
     $("#boys").on('change', function(){
        var boys = $("#boys").val();
        if(boys == 0){
          $("#age_boys").hide();
          $('select[name="age_of_boys"] option:first').prop('selected', true);
       }else{        
          $("#age_boys").show();
        }
     });
     
    $("#girls").on('change', function(){
       var girls = $("#girls").val();
       if(girls == 0){
        $("#age_girls").hide();
        $('select[name="age_of_girls"] option:first').prop('selected', true);
       }else{
        $("#age_girls").show();
       }
    });
    
    $("#days_per_week").change(function(){
      if($("textarea[name=display_weeks]").val($(this).val())){
       
      }
    });
  });
</script>
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
            <h2 class="section-title no-margin-top">Create Family Profile Account</h2>
            <div class="panel panel-success-dark animated fadeInDown">
                <div class="panel-heading">Family Profile Form</div>
                <div class="panel-body">
                    <?php if($this->session->flashdata('success')): ?>
                      <div class="success_reg">
                        <p class="alert alert-success">You are successfully registered!</p>
                      </div>
                    <?php endif; ?>
                     <?php echo form_open_multipart('family-profile/add');?>
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
                        <div class="form-group" style="float:left;">
                            <label for="InputNumberofchildren">Number of children<sup>*</sup></label>
                            <select name="number_of_children" class="form-control" style="width:100%;" >
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
                        <div class="form-group" style="float:left; ">
                          <label for="InputNumberofboys">Boys<sup>*</sup></label>
                            <select name="boys" id="boys" class="form-control" style="width:100%; margin-left:10px;">
                              <option value="00">-----SELECT ONE-----</option>
															<option value="0" <?php echo set_select('boys', '0')?>>0</option>
                              <option value="1" <?php echo set_select('boys', '1')?>>1</option>
                              <option value="2" <?php echo set_select('boys', '2')?>>2</option>
                              <option value="3" <?php echo set_select('boys', '3')?>>3</option>
                              <option value="4" <?php echo set_select('boys', '4')?>>4</option>
                              <option value="5" <?php echo set_select('boys', '5')?>>5</option>
                              <option value="6" <?php echo set_select('boys', '6')?>>6</option>
                              <option value="7" <?php echo set_select('boys', '7')?>>7</option>
                              <option value="8" <?php echo set_select('boys', '8')?>>8</option>
                              <option value="9" <?php echo set_select('boys', '9')?>>9</option>
                              <option value="10" <?php echo set_select('boys', '10')?>>10</option>
                            </select>                         
                        </div>
                        <div id="age_boys" class="form-group" style="float:left; margin-left:15px;">
                          <label for="InputAgeofboys">Age of boys<sup>*</sup></label>
                            <br>
                            <input type="checkbox" name="age_of_boys[]" value="1" <?php echo set_checkbox('age_of_boys[]', '1'); ?>>3 months<br>
                            <input type="checkbox" name="age_of_boys[]" value="2" <?php echo set_checkbox('age_of_boys[]', '2'); ?>>6 months<br>
                            <input type="checkbox" name="age_of_boys[]" value="3" <?php echo set_checkbox('age_of_boys[]', '3'); ?>>7 months<br>
                            <input type="checkbox" name="age_of_boys[]" value="4" <?php echo set_checkbox('age_of_boys[]', '4'); ?>>8 months<br>
                            <input type="checkbox" name="age_of_boys[]" value="5" <?php echo set_checkbox('age_of_boys[]', '5'); ?>>9 months<br>
                            <input type="checkbox" name="age_of_boys[]" value="6" <?php echo set_checkbox('age_of_boys[]', '6'); ?>>1 yr<br>
                            <input type="checkbox" name="age_of_boys[]" value="7" <?php echo set_checkbox('age_of_boys[]', '7'); ?>>2 yrs<br>
                            <input type="checkbox" name="age_of_boys[]" value="8" <?php echo set_checkbox('age_of_boys[]', '8'); ?>>3 yrs<br>
                            <input type="checkbox" name="age_of_boys[]" value="9" <?php echo set_checkbox('age_of_boys[]', '9'); ?>>4 yrs<br>
                            <input type="checkbox" name="age_of_boys[]" value="10" <?php echo set_checkbox('age_of_boys[]', '10'); ?>>5 yrs<br>
                        </div>
                        <div class="form-group" style="float:left; margin-left:10px;">
                          <label for="InputNumberofgirls">Girls<sup>*</sup></label>
                            <select name="girls" id="girls" class="form-control" style="width:100%;">
                              <option value="00">-----SELECT ONE-----</option>
															<option value="0" <?php echo set_select('boys', '0')?>>0</option>
                              <option value="1" <?php echo set_select('girls', '1')?>>1</option>
                              <option value="2" <?php echo set_select('girls', '2')?>>2</option>
                              <option value="3" <?php echo set_select('girls', '3')?>>3</option>
                              <option value="4" <?php echo set_select('girls', '4')?>>4</option>
                              <option value="5" <?php echo set_select('girls', '5')?>>5</option>
                              <option value="6" <?php echo set_select('girls', '6')?>>6</option>
                              <option value="7" <?php echo set_select('girls', '7')?>>7</option>
                              <option value="8" <?php echo set_select('girls', '8')?>>8</option>
                              <option value="9" <?php echo set_select('girls', '9')?>>9</option>
                              <option value="10" <?php echo set_select('girls', '10')?>>10</option>
                            </select>                         
                        </div>
                         <div id="age_girls" class="form-group" style="float:left; margin-left:10px;">
                          <label for="InputAgeofgirls">Age of girls<sup>*</sup></label>
                            <br>
                            <input type="checkbox" name="age_of_girls[]" value="1" <?php echo set_checkbox('age_of_girls[]', '1'); ?>>3 months<br>
                            <input type="checkbox" name="age_of_girls[]" value="2" <?php echo set_checkbox('age_of_girls[]', '2'); ?>>6 months<br>
                            <input type="checkbox" name="age_of_girls[]" value="3" <?php echo set_checkbox('age_of_girls[]', '3'); ?>>7 months<br>
                            <input type="checkbox" name="age_of_girls[]" value="4" <?php echo set_checkbox('age_of_girls[]', '4'); ?>>8 months<br>
                            <input type="checkbox" name="age_of_girls[]" value="5" <?php echo set_checkbox('age_of_girls[]', '5'); ?>>9 months<br>
                            <input type="checkbox" name="age_of_girls[]" value="6" <?php echo set_checkbox('age_of_girls[]', '6'); ?>>1 yr<br>
                            <input type="checkbox" name="age_of_girls[]" value="7" <?php echo set_checkbox('age_of_girls[]', '7'); ?>>2 yrs<br>
                            <input type="checkbox" name="age_of_girls[]" value="8" <?php echo set_checkbox('age_of_girls[]', '8'); ?>>3 yrs<br>
                            <input type="checkbox" name="age_of_girls[]" value="9" <?php echo set_checkbox('age_of_girls[]', '9'); ?>>4 yrs<br>
                            <input type="checkbox" name="age_of_girls[]" value="10" <?php echo set_checkbox('age_of_girls[]', '10'); ?>>5 yrs<br>                            
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="Inputdate">Start date<sup>*</sup></label>
                            <input type="text" class="form-control" name="date" id="datepicker" value="<?php echo set_value('date');?>"/>
                        </div>
                        <div class="form-group">
                           <label for="InputDaysperweek">Days of week (you can choose more than one)<sup>*</sup></label>
                           <br>
                            <input type="checkbox" name="days_per_week[]" value="1" <?php echo set_checkbox('days_per_week[]', '1'); ?>>Sunday<br>
                            <input type="checkbox" name="days_per_week[]" value="2" <?php echo set_checkbox('days_per_week[]', '2'); ?>>Monday<br>
                            <input type="checkbox" name="days_per_week[]" value="3" <?php echo set_checkbox('days_per_week[]', '3'); ?>>Tuesday<br>
                            <input type="checkbox" name="days_per_week[]" value="4" <?php echo set_checkbox('days_per_week[]', '4'); ?>>Wednesday<br>
                            <input type="checkbox" name="days_per_week[]" value="5" <?php echo set_checkbox('days_per_week[]', '5'); ?>>Thursday<br>
                            <input type="checkbox" name="days_per_week[]" value="6" <?php echo set_checkbox('days_per_week[]', '6'); ?>>Friday<br>
                            <input type="checkbox" name="days_per_week[]" value="7" <?php echo set_checkbox('days_per_week[]', '7'); ?>>Saturday<br>
                        </div>
                        <div class="form-group">
                            <label for="InputFlexibledays">Are you flexible on days<sup>*</sup></label>
                            <select name="flexible_days" class="form-control" >
                              <option value="0">-----SELECT ONE-----</option>
                              <option value="1" <?php echo set_select('flexible_days', '1')?>>Yes</option>
                              <option value="2" <?php echo set_select('flexible_days', '2')?>>No</option>
                            </select>      
                        </div>
                         <div class="form-group">
                            <label for="InputHoursperweek">Hours required<sup>*</sup></label>
                            <input type="text" class="form-control" name="hours_required"  value="<?php echo set_value('hours_required');?>"/>
                        </div>
                        <div class="form-group" style="float:left;">
                            <label for="Inputhavepets">Have pets<sup>*</sup></label>
                            <select name="have_pets" id="have_pets" class="form-control" >
                              <option value="0">-----SELECT ONE-----</option>
                              <option value="1" <?php echo set_select('have_pets', '1')?>>Yes</option>
                              <option value="2" <?php echo set_select('have_pets', '2')?>>No</option>
                          
                            </select>      
                        </div>
                        <div id="pet_hide" class="form-group" style="float:left;" >
                            <label for="Inputhavepetsdog">&nbsp;</label>
                            <select name="pets_hide" class="form-control" >
                              <option value="0">-----SELECT PET-----</option>
                              <option value="1" <?php echo set_select('pets_hide', '1')?> >Dog</option>
                              <option value="2" <?php echo set_select('pets_hide', '2')?>>Cat</option>
                          
                            </select>      
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                          <label for="Inputchildactivities">Childs activities<sup>*</sup></label>
                          <input type="text" class="form-control" name="child_activities" value="<?php echo set_value('child_activities');?>"/>
                        </div>
                        <div class="form-group" >
                            <label for="Inputalreadyhavenanny">Already have nanny<sup>*</sup></label>
                            <select name="already_have_nanny" class="form-control" >
                              <option value="0">-----SELECT ONE-----</option>
                              <option value="1" <?php echo set_select('already_have_nanny', '1')?>>Yes</option>
                              <option value="2" <?php echo set_select('already_have_nanny', '2')?>>No</option>
                          
                            </select>      
                        </div>
                        <div class="form-group">
                          <label for="Inputrate">Hourly rate per family<sup>*</sup></label>
                          <input type="text" class="form-control" name="rate_of_pay" value="<?php echo set_value('rate_of_pay');?>"/>
                        </div>
                        <div class="form-group" >
                            <label for="Inputprefercareat">Prefer care at<sup>*</sup></label>
                            <select name="prefer_care" class="form-control" >
                              <option value="0">-----SELECT ONE-----</option>
                              <option value="1" <?php echo set_select('prefer_care', '1')?>>My house</option>
                              <option value="2" <?php echo set_select('prefer_care', '2')?>>Your house</option>
                              <option value="3" <?php echo set_select('prefer_care', '3')?>>Alternate</option>
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
                                    <input type="checkbox" id="inlineCheckbox1" name="terms[]" value="option1" <?php echo set_checkbox('terms[]', 'option1');?>> I read <a href="<?php echo base_url().'terms-and-conditions.html'?>" title="Terms and Conditions" target="_blank">Terms and Conditions</a>.
                                </label>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-ar btn-primary pull-right">Create Family Profile</button>
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
 