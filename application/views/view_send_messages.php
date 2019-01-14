<header class="main-header">
    <div class="container">
        <h1 class="page-title">View <?php echo $getToMessages->first_name."&nbsp;".$getToMessages->last_name; ?> Messages</h1>
    </div>
</header>

<div class="container">
    <div class="row">
      <h1>Message</h1>
      <?php echo $getToMessages->message; ?>
   </div>
</div> <!-- container  -->