
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
          
            <h2 class="section-title no-margin-top">Payment</h2>
            <div class="panel panel-success-dark animated fadeInDown">
                <div class="panel-heading">Payment Form</div>
                <form action="<?php echo base_url().'payment/proceed'?>" method="post">
                  <div class="panel-body">
                    <p>Personal Information: </p>
                    <div class="form-group">
                        <label for="InputFirstName">First name</label><br />
                        <?php echo $query->first_name; ?>
                    </div>
                    <div class="form-group">
                        <label for="InputLastName">Last name</label><br />
                        <?php echo $query->last_name; ?>
                    </div>
                    <div class="form-group">
                        <label for="InpuAddress">Address</label><br />
                        <?php echo $query->address; ?>
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">Email</label><br />
                        <?php echo $query->email_address; ?>
                    </div>
                    <div class="form-group">
                        <label for="InputAmount">Amount</label><br />
                        <label for="Inputnumber">$49.00</label>
                    </div>
                    
                    <i class="fa fa-paypal">aypal</i>

                    <div class="col-md-13">
                      <button type="submit" class="btn btn-ar btn-primary pull-right">Proceed With Payment</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- container  -->
 