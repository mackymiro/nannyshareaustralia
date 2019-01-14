<header class="main-header">
    <div class="container">
        <h1 class="page-title">Contact Us</h1>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="section-title no-margin-top">Send Message</h2>
        </div>
        <div class="col-md-8">
            <section>
                <p>So you've navigated your way through the site,read through our Q&As and blog information, but your question remains unanswered? Please drop us a brief email outlining your query and we will reply with an answer as soon as possible! Thankyou </p>
                <?php if($this->session->flashdata('send')): ?>
                  <div class="success_reg"> 
                     <p class="alert alert-success">Your message is successfully sent! you will receive an email shortly.</p>
                  </div>  
                <?php endif; ?>
                <form action="<?php echo base_url().'contact-us/send-messages'?>" method="post">
                    <div class="error">
                      <?php echo validation_errors('<div class="error">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="InputName">Name</label>
                        <input type="text" name="name" class="form-control" id="InputName">
                    </div>
                    <div class="form-group">
                        <label for="InputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="InputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="InputMessage">Mesagge</label>
                        <textarea class="form-control" name="message" id="InputMessage" rows="8"></textarea>
                    </div>
                    <button type="submit" class="btn btn-ar btn-primary">Submit</button>
                    <div class="clearfix"></div>
                </form>
            </section>
        </div>

        <div class="col-md-4">
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-envelope-o"></i> Additional Information</div>
                    <div class="panel-body">
                        <h4 class="section-title no-margin-top">Contacts</h4>
                        <address>
                            <strong>info@nannyshareaustralia.com.au</strong><br>
                            Franciska Framke<br>
                            <strong> email:</strong> info@nannyshareaustralia.com.au<br>
                        </address>

                        <!-- Business Hours -->
                        <h4 class="section-title no-margin-top">Business Hours</h4>
                        <ul class="list-unstyled">
                            <li><strong>Monday-Saturday:</strong> 9am to 5pm</li>
                            <li>
                            we will endeavor to reply to all emails within 24 hours<br></strong></li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div> <!-- container -->
