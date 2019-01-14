<script type="text/javascript">
  $(document).ready(function(){
    $('.delete-block').on("click","a#deleteBtn", function() {
        var id =$(this).data("deleteid");
        $.ajax({
          type: "post",
          url: $(this).data("href"),
          data: {
            msgId: id
          },						
          success: function(data){
            popClose();
            $("#deleteId"+ id).fadeOut('slow'); 
          }
        });
        return false;
      }); 
  });
  function popClose(){
    jQuery.fancybox.close();
  }
</script>
<div class="delete-block">
  <p style="margin-top:20px;">Are you sure you want to delete this?</p>
  <a href="javascript:jQuery.fancybox.close();" class="btn btn-primary pull-right" style="margin-left:10px;">Cancel</a>
    <?php foreach($getMySendMessages as $sendMessage): ?>
      <a href="#" id="deleteBtn" data-deleteid="<?php echo $sendMessage->id; ?>" data-href="<?php echo base_url().'delete/my-messages'?>" class="btn btn-primary pull-right" >Delete</a>
    <?php endforeach; ?>
</div>