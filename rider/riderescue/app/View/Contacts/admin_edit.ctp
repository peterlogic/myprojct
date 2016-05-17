<?php echo $this->element("admin_header"); ?>
<?php echo $this->element("admin_topright"); ?>
<?php echo $this->element("admin_nav"); ?>
<?php echo $this->element("admin_sidebar"); ?> 

<?php echo $this->Html->script(array('jquery.tablednd'));?>
<!--------------------------->

<div id="content">
    <div class="contentTop">
        <span class="pageTitle"><span class="icon-calendar"></span>Contact us Management</span>
    </div>

     <!-- Breadcrumbs line -->
	<?php echo $this->Session->flash(); ?>
    <div class="breadLine">

        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'admin_dashboard')); ?>">Dashboard</a></li>
                 <li class="current"><a href="javascript:void:(0)"><?php echo 'Contact us'; ?></a></li>
            </ul>
        </div>
    </div>


    <?php //debug($reply);exit ?>
    <!-- Main content -->

    <div class="wrapper">
         <div class="widget fluid">
        <div class="whead"><h6><?php echo ' Contact us'; ?></h6></div>
        <div id="dyn" class="hiddenpars">
            <?php //echo $this->Form->create('Contact',array('method'=>'Post','type'=>'file','id'=>'validate')); ?>
                <div class="formRow">
                    <div class="grid3"><label>Full name:</label></div>
                    <div class="grid9">
					<?php echo $userinfo['Contact']['full_name']; ?>
                 
                    </div>
                </div>
				
				<div class="formRow">
                    <div class="grid3"><label>Last name:</label></div>
                    <div class="grid9">
                  <?php echo $userinfo['Contact']['email']; ?>
                    </div>
                </div>
				
				<div class="formRow">
                    <div class="grid3"><label>Email:</label></div>
                    <div class="grid9">
                    <?php echo $userinfo['Contact']['phone']; ?>
                    </div>
                </div>
				
				<div class="formRow">
                    <div class="grid3"><label>Message:</label></div>
                    <div class="grid9">
                     <?php echo $userinfo['Contact']['message']; ?>
                    </div>
                </div>

           </form>     
        </div> 
        </div>
    </div>
</div>

