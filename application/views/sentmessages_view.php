<header class="main-header">
    <div class="container">
        <h1 class="page-title">Sent Messages</h1>
    </div>
</header>
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $(".various").fancybox({
      maxWidth	: 240,
      maxHeight	: 100,
      fitToView	: false,
      width		: '70%',
      height		: '70%',
      autoSize	: false,
      closeClick	: false,
      openEffect : 'none',
         helpers     : { 
            overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
          },	
    });
  });
</script>

<div class="container">
    <div class="row">
      <?php if($getSendMessages): ?>
        <table class="table table-striped">
          <tr>
          <th>To:</th>  
          <th>Option</th>
          </tr>
          <?php foreach($getSendMessages as $sendMessages): ?>
            <tr id="deleteId<?php echo $sendMessages->id; ?>">
              <td><?php echo $sendMessages->first_name."&nbsp;".$sendMessages->last_name;  ?></td>
              <td>
                <a href="<?php echo base_url().'messages/view-send-messages/'.$sendMessages->id; ?>" class="btn btn-success">View</a> |
                <a class="various fancybox.ajax btn btn-danger" href="<?php echo base_url().'delete/send-messages/'.$sendMessages->id; ?>">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php else: ?>
        <h1>No sent messages.</h1>
      <?php endif;?>
    </div>
</div> <!-- container  -->
