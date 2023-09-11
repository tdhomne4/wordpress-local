<div class="col-md-12 mb-lg-5 mb-md-4 mb-0 lead-block1">
	<figure class="blog-figure">
		<div class="col-md-12">
	    <img src="<?php echo get_the_post_thumbnail(); ?>">
	        <span class="tag-button tag-rounded"><?php echo the_category(); ?><span>
		</div>
	</figure>
	<div class="blog-details">
	    <div class="blog-post-date mb-lg-4 mb-md-3 mb-2">
	    	<strong class="author-name"><?php echo the_author(); ?></strong>
			<span class="b-post-date"><?php echo the_date(); ?></span>
	    </div>
		<h3 class="title-24 mb-lg-4 mb-md-3 mb-2"><?php echo the_title(); ?></h3>
	</div>
</div>

<div class="col-md-12 mb-lg-5 mb-md-4 mb-2 lead-block2">
	<div class="row">
		<div class="col-md-6">
			<p class="lead-text mb-md-0 mb-15"><?php echo the_content(); ?></p>
		</div>
	</div>
</div>					    <!-- ./ blogs_content end -->
					    
<div class="comments-block mt-3">
    <h4 class="title-20 mb-md-4 mb-3">2 Comments</h4>
	    <div class="comments-listing">
			<div class="comment-items">
	    		<div class="comment-by">
		        	<h4 class="user-name">Samanta Bay</h4>
		            	<div class="cmt-date-time">
							<span>Aug 9, 2019</span> at <span>1:20 pm</span></div>
		                </div>
		        	<div class="comment-desc">
	            	   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
	            	</div>
	        	</div>	<!-- ./ comment-items -->
	    	<div class="comment-items">
	            <div class="comment-by">
		            <h4 class="user-name">Tommy Nobel</h4>
		                <div class="cmt-date-time">
							<span>Aug 9, 2019</span> at <span>1:20 pm</span></div>
		                </div>
		                <div class="comment-desc">
	                        		   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
	                        		</div>
	                        	</div>
	                        	<!-- ./ comment-items -->
	                        </div>
					    </div>
					    <!-- ./ end comments-block -->
					    <div class="post-comment">
					    	<h4 class="title-20 mb-md-4 mb-3 pb-1">Post Comment</h4>
					    	<div class="post-comment-form">
					    		<form action="" method="get">
					    			<div class="row">
						    			<div class="form-group col-md-6 mb-md-5 mb-3">
						    			 	<div class="input-flat-field">
										        <input type="text" id="name" class="form-control flat-input" required>
										        <label class="form-control-placeholder" for="name">Name *</label>
									        </div>
									    </div>
									    <div class="form-group col-md-6 mb-md-5 mb-3">
						    			 	<div class="input-flat-field">
										        <input type="text" id="Email" class="form-control flat-input" required>
										        <label class="form-control-placeholder" for="Email">Email *</label>
									        </div>
									    </div>
									    <div class="form-group col-md-12 mb-md-5 mb-3">
						    			 	<div class="input-flat-field">
										        <textarea rows="1" id="Message" class="form-control flat-input" required></textarea>
										        <label class="form-control-placeholder" for="Message">Message *</label>
									        </div>
									    </div>
									</div>
									<div class="form-submit">
										<button class="btn btn-theme" type="button">Submit</button>
									</div>
					    		</form>
					    	</div>
					    </div>