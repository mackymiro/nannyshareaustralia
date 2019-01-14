
<header class="main-header">
    <div class="container">
        <h1 class="page-title">Send a message to "<?php echo $query->first_name; ?> <?php echo $query->last_name; ?>"</h1>
    </div>
</header>

<div class="container">
    <div class="row">
      <div id="error" class="alert alert-danger">
        <p>Please enter a message.</p>
      </div>
      <div id="success" class="alert alert-success">
        <p>Your message is successfully sent.</p>
      </div>
      <i class="fa fa-clipboard"></i>
       <textarea class="form-control" cols="10" rows="10" id="messages" name="messages"></textarea>
       <br />
       <button class="btn btn-primary pull-right" id="send_message" >Send Message</button>
    </div>
</div> <!-- container  -->

<script type="text/javascript">
  $(document).ready(function(){
    $("#error").hide();
    $("#success").hide();
    $("#send_message").click(function(){
      var messages = $("#messages").val().trim();
      if(messages.length > 0 ){
        $.post("<?php echo base_url().'messages/send-message'?>", {messages:messages, sender_id:<?php echo $query->user_id;?>}, function(data){
          $("#success").show();
          $("#messages").val('');
          $("#success").fadeOut(3000);
        });
        $("#error").hide();
      }else{
        $("#error").show();
      }
    }); 
  });
</script>