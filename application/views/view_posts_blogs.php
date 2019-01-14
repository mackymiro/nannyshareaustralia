
<header class="main-header">
    <div class="container">
        <h1 class="page-title">View Posts Blogs</h1>
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
		<table class="table table-striped">
				<tr>
					<th width="20%">Title</th>
					<th>Content</th>
					<th>Date</th>
					<th>Options</th>
				</tr>
				<?php foreach($getBlogPosts as $post): ?>
				<tr id="deleteId<?php echo $post->id; ?>">
					<td><a href="#" title="<?php echo $post->title; ?>"> <?php echo $post->title; ?></a></td>
					<td>	
						<?php $limitedWord = word_limiter($post->content, 10); ?>
						<?php echo $limitedWord; ?>
					</td>
					<td>
						<?php echo date('M',strtotime($post->date)); ?>
						<?php echo date('d',strtotime($post->date)); ?>
						<?php echo date('Y',strtotime($post->date)); ?>
					</td>
					<td>
						<a href="<?php echo base_url().'admin/view/id/'.$post->id; ?>" title="View" class="btn btn-primary">View</a>
						<a href="<?php echo base_url().'admin/edit/id/'.$post->id; ?>" title="Edit" class="btn btn-primary">Edit</a>
						<a class="various fancybox.ajax btn btn-danger" href="<?php echo base_url().'admin/delete/id/'.$post->id?>">Delete</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
  </div>
</div> <!-- container  -->

