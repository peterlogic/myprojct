<style>
.news-col > img {
  width: 100% !important;
}
</style>
<!-- ========================================= slide ======================================== -->
    <section class="about-banner news">
		<div class="wrapper">
			<br> <br> <br>
		</div>
    </section>

<!-- ========================================= services ======================================== -->
<section class="main-section">
	<section class="wrapper">
    	<div class="page-header">
        	<h2>Blog</h2>
            <p>Find out what is happening around us</p> 
            <span></span>       
    	</div>
		<div class="news-info">
			 	
				<div class="news-block detailed-news">
					<div class="col-head">
                            <div class="date-s"><?php echo date("d",strtotime($blog['Blog']['created'])); ?> <span><?php echo date("M",strtotime($blog['Blog']['created'])); ?></span></div>
                            <p><?php echo $blog['Blog']['title']; ?></p>
                         </div>
                    <div class="news-col">
                      			<?php 
						$blog_image = $blog['Blog']['image'];
								if(!empty($blog_image)) { ?>
									<img src="<?php  echo FULL_BASE_URL.$this->webroot."blogs".DS.$blog_image;?>">
							<?php } ?>
                         <p><?php echo $blog['Blog']['content']; ?> </p>       
                    </div>
                </div><!-- block ends -->
		</div>
    </section><!-- wrapper ends -->
</section>