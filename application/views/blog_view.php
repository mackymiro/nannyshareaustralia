
<header class="main-header">
    <div class="container">
        <h1 class="page-title">Blogs</h1>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <article class="post animated fadeInDown animation-delay-6">
                <?php foreach($getBlogPosts1 as $post): ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="post-title"><a href="<?php echo base_url().'blog/view-details/'.$post->slug; ?>" class="transicion"><?php echo $post->title; ?></a></h3>
                        <div class="row">
                            <div class="col-md-6">
                                <?php if($post->image == NULL):?>
                                   <img src="<?php echo base_url()?>assets/images/img_full.jpg" class="img-responsive imageborder" alt="Image">
                                <?php else: ?>
                                  <img src="<?php echo base_url()?>assets/uploads/blogs/<?php echo "medium_size_".$post->image; ?>" alt="<?php echo $post->title; ?>" class="img-responsive imageborder">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <p>
																<?php $limitedWord = word_limiter($post->content, 180); ?>
																<?php echo $limitedWord; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-lg-10 col-md-9 col-sm-4">
                                <i class="fa fa-clock-o"></i>
																	<?php echo date('M',strtotime($post->date)); ?>
																	<?php echo date('d',strtotime($post->date)); ?>
																	<?php echo date('Y',strtotime($post->date)); ?>
																	<!--<i class="fa fa-user"> </i> <a href="#">Patrick</a> <i class="fa fa-folder-open"></i> <a href="#">Portfolio</a>, <a href="#">Design</a>.-->
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <a href="<?php echo base_url().'blog/view-details/'.$post->slug; ?>" class="pull-right">Read more &raquo;</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </article> <!-- post -->
         
           <!-- <section>
                <ul class="pagination">
                    <li class="disabled"><a href="#">&laquo;</a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li><a href="#">7</a></li>
                    <li><a href="#">8</a></li>
                    <li><a href="#">9</a></li>
                    <li><a href="#">10</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </section>-->
        </div> <!-- col-md-8 -->

    </div> <!-- row -->
</div> <!-- container  -->

