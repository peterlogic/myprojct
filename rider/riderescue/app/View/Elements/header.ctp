<ul>
	<li><span>Book now</span></li>
	 <li><a class="call" href="tel:<?php echo $Sitesetting['Sitesetting']['contact']; ?>"><?php echo $this->Html->image('front/mobile-ico.png',array('alt'=>'call')); ?></a></li>
	<li><a class="mail" href="mailTo:<?php echo $Sitesetting['Sitesetting']['site_email'];?>"><img src="<?php echo FULL_BASE_URL.$this->webroot."img".DS."front"."/"."mail-ico.png";?>" alt="mail" /></a></li>
</ul>