<header class="main-header">
    <div class="container">
        <h1 class="page-title">My Messages</h1>
    </div>
</header>

<div class="container">
    <div class="row">
      <?php foreach($getMyMessage as $msgs): ?>
        <textarea disabled class="form-control" cols="15" rows="10"><?php echo $msgs->message; ?></textarea><br />
      <?php endforeach; ?>
      <br />
      <div id="error" class="alert alert-danger">
        <p>Please enter a message.</p>
      </div>
      <div id="success" class="alert alert-success">
        <p>Your message is successfully sent.</p>
      </div>
      <i class="fa fa-clipboard"></i>
      <textarea  class="form-control" cols="10" id="messages" name="messages" rows="10"></textarea>
      <br />
      <button class="btn btn-primary pull-right" id="send_message" >Reply Message</button>
    </div>
</div> <!-- container  -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#error").hide();
    $("#success").hide()
    $("#send_message").click(function(){
      var messages = $("#messages").val().trim();
      if(messages.length > 0){
        $.post('<?php echo base_url().'messages/reply-message' ?>',{message:messages, user_id:<?php echo $id; ?>, senders_id:<?php echo $msgs->user_id; ?> }, function(data){
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