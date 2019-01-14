<header class="main-header">
    <div class="container">
        <h1 class="page-title">My Inbox</h1>
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
      <?php if($mesaageInbox): ?>
      <table class="table table-striped">
        <tr>
        <th>From: <br>View Message</th>  
        <th></th>
        <th>Status</th>
        <th>Option</th>
        </tr>
        <?php foreach($mesaageInbox as $msgs): ?>
        <tr id="deleteId<?php echo $msgs->msg_id?>">
          <td><a href="<?php echo base_url().'messages/read/id/'.$msgs->msg_id?>"><?php echo $msgs->first_name; ?> <?php echo $msgs->last_name; ?></a></td>
          <td><a href="<?php echo base_url().'profile/id/'.$msgs->user_id; ?>" >View Profile</a></td>
          <td>
            
            <?php if($msgs->flag == 0):?>
               <?php echo "Unread"; ?>
            <?php else: ?>
                <?php echo "Read"; ?>
            <?php endif; ?>
          </td>
          <td><a class="various fancybox.ajax" href="<?php echo base_url().'delete/id/'.$msgs->msg_id; ?>"><i class="fa fa-times"></i></a></td>
        </tr>
       <?php endforeach; ?>
      </table>
      <?php else: ?>
        <h1>No messages in inbox.</h1>
      <?php endif;?>
   </div>
</div> <!-- container  -->