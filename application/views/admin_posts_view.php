<header class="main-header">
    <div class="container">
        <h1 class="page-title">Posts Blogs Here</h1>
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
    <?php echo form_open_multipart('admin/add');?>
     <div class="col-md-4">
          <section>
            <p>No picture </p>    
            <input type="file" name="photo" />            
          </section>
          <section>
            <br >
             <input type="submit" class="btn btn-ar btn-block btn-success" value="Post a blog">
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
                    <input type="text" class="form-control"  id="datepicker" name="date" value="<?php echo set_value('date');?>"/>
                </div>
                <div class="form-group">
                    <label for="InputFirstName">Title<sup>*</sup></label>
                    <input type="text" class="form-control"  name="title" value="<?php echo set_value('title');?>"/>
                </div>
                <div class="form-group">
                    <label for="InputFirstName">Content<sup>*</sup></label>
                    <textarea class="form-control ckeditor" name="content" id="content" rows="10"></textarea>
										<?php echo display_ckeditor($ckeditor); ?>
                </div>
              </div>
          </section>         
      </div>
      </form>
  </div>
</div> <!-- container  -->
<script> 
    var date = new Date();
    var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear();
    
    $('#datepicker').datepicker({
			minDate: new Date(currentYear, currentMonth, currentDate),
      dateFormat: "yy-mm-dd"
    });
    
</script>

