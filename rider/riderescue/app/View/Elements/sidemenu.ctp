<ul id="nav" class="hidden">
			<li><a href="<?php  echo $base_url; ?>#home-top">Home</a></li>
			<li><a href="<?php  echo $base_url; ?>#services-header">Services</a></li>
			<li><a href="<?php  echo $base_url; ?>#blog-header">Blog</a></li>
			<li><a href="<?php  echo $base_url; ?>#join-now">Join Our Team</a></li>
           
		    <li><?php echo $this->Html->link("About Us","javascript:void(0)")?>
		   
			<ul class="sub-links">
				<li><?php echo $this->Html->link("What we do",$base_url."staticpages/view/1")?>
				<li><?php echo $this->Html->link("The Executive Team",$base_url."staticpages/view/2")?>
				
			</ul>
		   </li>
    </ul>
	