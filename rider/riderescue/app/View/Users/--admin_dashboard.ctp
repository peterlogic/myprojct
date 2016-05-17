<?php echo $this->element("admin_header"); ?>
<?php echo $this->element("admin_topright"); ?>
<?php echo $this->element("admin_nav"); ?>
<?php echo $this->element("admin_sidebar"); ?>    

<div class="span3">
		<a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'index')); ?>" class="info-tiles tiles-inverse has-footer">
		
			    <div class="tiles-heading">
			        <div class="pull-left">Users</div>
			        <div class="pull-right">
			        	<div class="sparkline-block" id="tileorders"><canvas style="display: inline-block; width: 39px; height: 13px; vertical-align: top;" width="39" height="13"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
				<?php //echo $use_count;?>
			        <div class="text-center"><?php echo count($use_count); ?></div>
			    </div>
			    <div class="tiles-footer">
			    	<div class="pull-left">Manage Users</div>
			    	<div class="pull-right percent-change"></div>
			    </div>
			</a>
		</div>