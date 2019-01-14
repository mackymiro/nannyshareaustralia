
<header class="main-header">
    <div class="container">
        <h1 class="page-title">Blog Details View</h1>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <article class="post animated fadeInDown animation-delay-6">
                <?php foreach($getBlogDetails as $detail): ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="post-title"><a href="<?php echo base_url().'blog/view-details/'.$detail->slug; ?>" class="transicion"><?php echo $detail->title; ?></a></h3>
                        <div class="row">
                            <div class="col-md-6">
                                <?php if($detail->image == NULL):?>
                                   <img src="<?php echo base_url()?>assets/images/img_full.jpg" class="img-responsive imageborder" alt="Image">
                                <?php else: ?>
                                  <img src="<?php echo base_url()?>assets/uploads/blogs/<?php echo $detail->image; ?>" alt="<?php echo $detail->title; ?>" class="img-responsive imageborder">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $detail->content; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-lg-10 col-md-9 col-sm-4">
                                <i class="fa fa-clock-o"></i>
																	<?php echo date('M',strtotime($detail->date)); ?>
																	<?php echo date('d',strtotime($detail->date)); ?>
																	<?php echo date('Y',strtotime($detail->date)); ?>
																	<!--<i class="fa fa-user"> </i> <a href="#">Patrick</a> <i class="fa fa-folder-open"></i> <a href="#">Portfolio</a>, <a href="#">Design</a>.-->
                            </div>
                           
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </article> <!-- post -->
         
        </div> <!-- col-md-8 -->

    </div> <!-- row -->
</div> <!-- container  -->

