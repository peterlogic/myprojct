<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo (isset($page_title) && (!empty($page_title))  ? $page_title :  'Ride & Rescue') ?></title>
<meta name="description" content="<?php echo (isset($page_description) && (!empty($page_description))  ? $page_description :  'Ride & Rescue') ?>">
<meta name="keywords" content="<?php echo (isset($page_keyword) && (!empty($page_keyword)) ? $page_keyword : 'Ride & Rescue') ?>">
<meta charset="utf-8">
<!-- css file -->
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<?php  echo $this->Html->css(array('front/style','front/owl.carousel','front/style-slider')); ?>
<!-- Javascript file -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<?php echo $this->Html->script(array('front/jquery.slidizle','front/core','front/owl.carousel.min','front/owl.carousel')); ?>
<title>Ride Rescue</title>
<!-- Get jQuery from CDN -->
		<script>
		jQuery(function($) {
			$('[data-slidizle]').slidizle({
				beforeChange : function(api) {
					console.log('previous', api.getPreviousSlide().index());
					console.log('current', api.getCurrentSlide().index());
					console.log('next', api.getNextSlide().index());
					console.log('previous active', api.getPreviousActiveSlide().index());
				}
			});
		});
	</script>
</head>
<body>
	 <?php echo $this->Element('sidemenu'); ?>
<header>
	<section class="wrapper">
        <div id="navTrigger" class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
                  <div class="ride-brand">
                	<?php echo $this->Html->link($this->Html->image('front/logo-sample.png',array('alt'=>'logo')),array('controller'=>'/'),array('escape'=>false)); ?>
					</div>
                <div class="quick-contact">
                	 <?php echo $this->Element('header'); ?>
                </div>
   </section>        
</header>
  <!--section here-->
  <?php echo $this->Session->flash(); ?>
  <?php echo $content_for_layout ?>
  <!--section here-->
<footer>
	<section class="wrapper ride-footer">
    	<?php echo $this->Element('footer'); ?>
            </section>
</footer>

    <!-- Frontpage Demo -->
    <script>
   $("#owl-example").owlCarousel({
   // Most important owl features
    items : 2,
    itemsCustom : false,
    itemsDesktop : [1336,2],
    itemsDesktopSmall : [980,2],
    itemsTablet: [768,2],
    itemsTabletSmall: false,
    itemsMobile : [479,1],
    singleItem : false,
    itemsScaleUp : false,
	//Autoplay
    autoPlay : false,
    stopOnHover : false,
		// Navigation
    navigation : true,
    navigationText : ["",""],
    rewindNav : true,
    scrollPerPage : false,
    });
</script>
</body>
</html>
