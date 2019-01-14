
<header class="main-header">
    <div class="container">
        <h1 class="page-title">Edit Posts Blogs</h1>
    </div>
</header>

<script type="text/javascript">
  $(document).ready(function(){
		(function($) {
		jQuery.fn.cke_resize = function() {
			 return this.each(function() {
					var $this = $(this);
					var rows = $this.attr('rows');
					var height = rows * 60;
					$this.next("div.cke").find(".cke_contents").css("height", height);
			 });
		};
		})(jQuery);

		CKEDITOR.on( 'instanceReady', function(){
			$("textarea.ckeditor").cke_resize();
		})
	
	});
</script>
<div class="container">
  <div class="row">
		 <?php if($this->session->flashdata('successUpdate')): ?>
			<div id="alert-success" class="alert alert-success">
				<button class="close" data-dismiss="alert" type="button">×</button>
				<p >Blog successfully updated!</p>
			</div>
		<?php endif;?>
    <?php echo form_open_multipart('admin/update');?>
     <div class="col-md-4">
          <section>
						<?php if($query->image == NULL):?>
                <p>No Image</p>
              <?php else: ?>
                <img src="<?php echo base_url()?>assets/uploads/blogs/<?php echo "medium_size_".$query->image; ?>" alt="avatar" class="img-responsive imageborder">
              <?php endif; ?>						
            <input type="file" name="photo" />            
          </section>
          <section>
            <br >
							<input type="hidden" name="editData" value="<?php echo $query->id; ?>" />
             <input type="submit" class="btn btn-ar btn-block btn-success" value="Edit blog">
            <hr>
          </section>
      </div>
      <div class="col-md-8">
          <section>
              <div class="panel-primary">
                <div class="panel-heading"><i class="fa fa-user"></i>Post Content here</div>
                <br>
                 <?php if($this->session->flashdata('error')): ?>
                  <div id="alert-danger" class="alert alert-danger">
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    <p >The filetype you are attempting to upload is not allowed.</p>
                  </div>
                <?php endif; ?>
                <?php if($this->session->flashdata('success')): ?>
                  <div class="success_reg">
                    <p class="alert alert-success">You have successfully posted a blog!</p>
                  </div>
                <?php endif; ?>
                <div class="error">
                  <?php echo validation_errors('<div class="error">','</div>');?>
                </div>
                <div class="form-group">
                    <label for="InputFirstName">Date<sup>*</sup></label>
                    <input type="text" class="form-control"  id="datepicker" name="date" value="<?php echo $query->date; ?>"/>
                </div>
                <div class="form-group">
                    <label for="InputFirstName">Title<sup>*</sup></label>
                    <input type="text" class="form-control"  name="title" value="<?php echo $query->title; ?>"/>
                </div>
                <div class="form-group">
                    <label for="InputFirstName">Content<sup>*</sup></label>
                    <textarea class="form-control ckeditor" name="content" id="content" cols="15" rows="10"><?php echo $query->content; ?></textarea>
										<?php echo display_ckeditor($ckeditor); ?>
								</div>
              </div>
          </section>         
      </div>
      </form>
  </div>
</div> <!-- container  -->
<script> 
    $('#datepicker').datepicker({
      dateFormat: "yy-mm-dd"
    });
    
</script>

