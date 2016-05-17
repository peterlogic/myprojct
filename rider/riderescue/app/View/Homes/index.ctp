

<body>

<!-- =================================   ======== slide ======================================== -->
 <section class="ride-slide" id="home-top">
   <!-- loop -->
		<section class="sample slider--animated" data-slidizle data-slidizle-loop="true">
			<ul class="slider-content" data-slidizle-content>
				   <?php if(!empty($slider)) { ?>
				  <?php  foreach($slider as $sliderdata)
                            {?>   
				<li class="slider-item" style="background-image:url('<?php  echo FULL_BASE_URL.$this->webroot."sliders".DS.$sliderdata['Slider']['image'];?>')">
			       <div class="slide-text">
                    <h1><?php echo $sliderdata['Slider']['title'];?></h1>
                    <p><?php echo $sliderdata['Slider']['content'];?><br /></p>
                <?php echo $this->Html->link('read more','https://'.$sliderdata['Slider']['link'], array('target' => '_blank')); ?>
                </div>
                </li>
							<?php }?>
				   <?php }?>  
			</ul>	 
			<div class="slider-next" data-slidizle-next>
				<span class="slide arrow-next"><?php echo $this->Html->image('front/slide-next.png',array('alt'=>'next')); ?></span>
			</div>
			<div class="slider-previous" data-slidizle-previous>
				<span class="slide arrow-pre"><?php echo $this->Html->image('front/slide-pre.png',array('alt'=>'previous')); ?></span>
			</div>
		</section>
    <!-- slider ends -->
   </section>
 
<!-- ========================================= services ======================================== -->

<section class="main-section" id="services-header">
	<section class="wrapper">
    	<div class="page-header">
        	<h2>Services</h2>
            <p>We are offering Worlwide Services</p> 
            <span></span>       
    	</div>
        
    </section><!-- wrapper ends -->
      
    <div class="ride-services">
	<?php if(!empty($service)) { 
	//pr($service);exit;?>
	
	<?php foreach($service as $servicedata) {?>
    	<div class="service-block">
        	<a class="service-img">
				<?php 
				$service_image = $servicedata['Service']['image'];
						if(!empty($service_image)) { ?>
					<img src="<?php  echo FULL_BASE_URL.$this->webroot."services".DS.$service_image;?>">
			<?php } ?>
            </a>
            <div class="service-info">
            	<h2><?php echo  $servicedata['Service']['title']; ?></h2>
                <p><?php echo $servicedata['Service']['content'];?></p>
                
            </div>
	</div>  <?php } }?><!-- services block ends -->
		       <!-- services block ends -->
    </div>
       
</section>

<!-- ========================================= What’s new  ======================================== -->

<section class="wrapper">
    	<div class="page-header" id="blog-header">
        	<h2>What's new </h2>
            <p>Check out our latest News and much more</p> 
            <span></span>       
    	</div>
        
        <div class="ride-news">
            <div id="owl-example" class="owl-carousel">
            <?php if(!empty($blog)) { ?>
				  <?php  foreach($blog as $blogdata)
                            {?>
			<div>    
			       <div class="news-block">
                    <a href="#">
                      			<?php 
				$blog_image = $blogdata['Blog']['image'];
						if(!empty($blog_image)) { ?>
					<img src="<?php  echo FULL_BASE_URL.$this->webroot."blogs".DS.$blog_image;?>">
			<?php } ?>
					 </a>
                     <div class="news-story">
                        <div class="story-head">
						<div class="date-s"><?php echo date("d",strtotime($blogdata['Blog']['created'])); ?><br><?php echo date("M",strtotime($blogdata['Blog']['created'])); ?></div>
                            <p><?php echo $blogdata['Blog']['title']; ?></p>
                         </div>
                         <p><?php echo (strlen(strip_tags($blogdata['Blog']['content']))>300 ? substr(strip_tags($blogdata['Blog']['content']),0,300).'...' : strip_tags($blogdata['Blog']['content'])); ?></p>
                            <?php echo $this->Html->link('Read more..',array('controller'=>'blogs','action'=>'view',$blogdata['Blog']['id'])); ?>
                    </div>
                </div><!-- block ends -->
			   </div>
                
					<?php }?>
				   <?php }?>  
				
        </div>
		  </div> <!-- carousel ends -->
		   </section><!-- wrapper ends -->
		

<!-- ========================================= contact form  ======================================== -->  

<section id="join-now" class="contact-ride">
	<section class="wrapper">
    
        <div class="page-header">
                <h2>Contact us</h2>
                <p>Because we&#039;d like to hear from you</p> 
                <span></span>       
            </div>
			
  
			
        <div class="contact-form"> 
			<?php  echo $this->Form->create('Contact', array('controller' => 'Contacts', 'id'=>'validate','name'=>'contactForm'));?>
			<!--form method="post" action="" id="validate"-->
			<?php echo $this->Form->input('full_name', array('label'=>"",'type'=>'text','id'=>'full_name','placeholder'=>'Full Name','required'=>false));?>
			<?php echo $this->Form->input('email', array('label'=>"",'type'=>'text','id'=>'email','placeholder'=>'Email','required'=>false));?>
			<?php echo $this->Form->input('phone', array('label'=>"",'type'=>'text','id'=>'phone','required'=>false,'placeholder'=>'Phone'));?>
			<?php echo $this->Form->input('message', array('label'=>"",'type'=>'textarea','id'=>'message','required'=>false,'placeholder'=>'Message'));?>
			
            <div class="captcha-s">
			<?php  //echo $this->Recaptcha->display(array('recaptchaOptions' => array('theme' => 'blackglass')));?>
		   </div><br>
            <input type="button"  value="Submit" id="submitContactForm" class="custom"/>
			<div style="color: rgb(255, 153, 0);float:left; margin-top:6px;margin-left:50px; font-size:28px; font-family: Gabrielle-Regular;" id="smessage"></div>
            </form>
        </div> <!-- contact form ends -->
	</section>
</section>
<?php echo $this->Html->script(array('jquery.validate.js')); ?>
<script>
$(document).ready(function() {
	/* Ajax here */
	$("#submitContactForm").click(function() {
		if($("#validate").valid()){
			var formValue = $("#validate").serialize();
			$.ajax({
				type: 'post',
				// url : 'http://dev414.trigma.us/riderescue/Contacts/index',
				url: '<?php echo $this->Html->url(array('controller' => 'Contacts', 'action' => 'index'));?>',
				data: formValue,
				success: function(data){
					$("#validate").trigger('reset');
					$("#smessage").html(data);	
				}
			});
		} else {
          return false;		
		}
	});
});
</script>	  
<script type="text/javascript">	
$(document).ready(function(){
$.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Alphabets allowed only"); 
$("#validate").validate({
	  rules:
	   {
      		"data[Contact][full_name]":{
				required:true,
			},
			"data[Contact][email]":{
				required:true,
				email: true,
			},
			"data[Contact][phone]":{
				required:true,
				maxlength:11,
				minlength:10,
			},		
			"data[Contact][message]":{
				required:true,
			}							
        },
  messages:
	    {
			"data[Contact][full_name]": {
				required: "Please enter your name"
			},
			"data[Contact][email]": {
				required: "Please enter your email",
				email: "Please enter a valid email address"
			},								
			"data[Contact][phone]": {
				required: "Please fill up mobile no",				
			},	
			"data[Contact][message]": {
				required: "Please fill up message",				
			}														
	    }	
});    	

});
</script> 