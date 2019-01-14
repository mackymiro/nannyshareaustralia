
<div class="container">
    <div class="row">
        <div class="col-md-12">     
            <h2 class="section-title no-margin-top">Payment</h2>
            <div class="panel panel-success-dark animated fadeInDown">
                <div class="panel-heading">Payment Form</div>
                <form action="<?php echo base_url().'payment/proceed_payment_data'?>" method="post">
                  <div class="panel-body">
                    <p>Personal Information: </p>
                    <div class="form-group">
                       <label for="InputUserName">Username</label><br />
                       <?php echo $username = $this->session->flashdata('username');?>
                       <input type="hidden" name="username" value="<?php echo $username;?>" />
                    </div>
                    <div class="form-group">
                       <label for="InputFirstName">First Name</label><br />
                       <?php echo $firstname = $this->session->flashdata('firstname');?>
                       <input type="hidden" name="firstname" value="<?php echo $firstname;?>" />
                    </div>
                    <div class="form-group">
                       <label for="InputLastName">Last Name</label><br />
                       <?php echo $lastname = $this->session->flashdata('lastname');?>
                       <input type="hidden" name="lastname" value="<?php echo $lastname;?>" />
                    </div>
                    <div class="form-group">
                      <label for="InputAddress">Address</label><br />
                        <?php echo $address = $this->session->flashdata('address');?>
                       <input type="hidden" name="address" value="<?php echo $address;?>" />
                    </div>
                    <div class="form-group">
                       <label for="InputEmail">Email</label><br />
                       <?php echo $email = $this->session->flashdata('email');?>
                       <input type="hidden" name="email" value="<?php echo $email;?>" />
                    </div>
                   
                    <div class="form-group">
                        <label for="InputAmount">Amount</label><br />
                          <label for="InputNumbert">$49.00</label>
                       
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
 