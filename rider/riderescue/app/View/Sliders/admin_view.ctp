<?php echo $this->element("admin_header"); ?>
<?php echo $this->element("admin_topright"); ?>
<?php echo $this->element("admin_nav"); ?>
<?php echo $this->element("admin_sidebar"); ?> 

<?php echo $this->Html->script(array('jquery.tablednd'));?>
<script type="text/javascript">
$(function() {

	$(".tbl_repeat tbody").tableDnD({
		onDrop: function(table, row) {
			var orders = $.tableDnD.serialize();
			//alert(orders);
			$.post('<?php echo $this->webroot; ?>/admin/users/sortRows', { orders : orders });
		}
	});

});
</script>
<script type="text/javascript">
$(document).ready(function(){
$(".fancybox").fancybox();
});
</script>
<div id="content">
    <div class="contentTop">
        <span class="pageTitle"><span class="icon-screen"></span>Slider Management</span>
      
    </div>
     <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?php echo $this->Html->url(array('controller'=>'users','action'=>'admin_dashboard')); ?>">Dashboard</a></li>
                <li class="current"><a href="<?php echo $this->Html->url(array('controller'=>'sliders','action'=>'admin_index')); ?>">Slider Management</a></li>
            </ul>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
     <?php $x=$this->Session->flash(); ?>
     <?php if($x){ ?>
     <div class="nNote nSuccess" id="flash">
       <div class="alert alert-success" style="text-align:center" ><?php echo $x; ?></div>
     </div><?php } ?>
                   <ul class="middleNavA">
            <li><a href="<?php echo $this->Html->url(array('controller'=>'Sliders','action'=>'index')); ?>" title="Add Slider"  class="tool-tip"><?php echo $this->Html->image('/images/icons/color/order-149.png'); ?><span>Add Slider</span></a></li>
        </ul> 
      <!--  <ul class="middleNavR">
            <li><a href="<?php //echo $this->Html->url(array('controller'=>'users','action'=>'admin_admin')); ?>" title="Add Admin"  class="tool-tip"><?php echo $this->Html->Image('/images/icons/middlenav/add.png'); ?></a></li>
        </ul>    -->
    	<!-- Chart -->
 
        
           <!-----------------------filter---------------->
            <br/>
       <!--     <div class="breadLine1" style="margin-bottom: 100px;">
                    <div class="bc1">
                        <?php // echo $this->Form->create('User', array('controller'=>'Users','action'=>'index','id'=>'filter')); ?>			   	 				 	
                            <div>		
                                    <div style="float:left;padding:10px;"> 
                                            <select name="data[type]"  class="selectme">
                                                         <option value="" >Select Type</option>
                                                         <option value="7" >Bar Owner</option>
                                                         <option value="6" >User</option>                                                               	   
                                            </select>
                                    </div>                                     
                                <div style="float:left;padding:10px;"> <button type ="submit" class="buttonS bGreen" name="filter" value="Filter" >Filter</button></div> 
                            </div>
                            </form>
                    </div>
            </div>  -->
	<!------------------end--------------------------->
        
        
        
            
       <div class="widget check grid6">
        <div class="whead">
        <!--<span class="titleIcon"><div id="uniform-titleCheck" class="checker">--><span class="titleIcon">
        <input title="Select All" class="tool-tip" id="titleCheck" name="titleCheck" type="checkbox"></span>
        <!--</div></span>--><h6>Slider Management</h6>
       
        
        </div>
        <div id="dyn" class="hiddenpars">
           <?php  if(!empty($sliderdata)){ ?>
             <?php  echo $this->Form->create('Slider',array("action" => "deleteall",'id' => 'mbc')); ?>
            <table cellpadding="0" cellspacing="0" class="tDefault checkAll tMedia tbl_repeat" id="checkAll" width="100%">
            <thead>
            <tr>
            <th></th>
			
			<th><?php echo ('Title'); ?></th>
            <th><?php echo ('Content'); ?></th>
          
            <th><?php echo ('Image');?></th>
            <th><?php echo ('Url');?></th>
            <th><?php echo ('Status');?></th>
			  <th><?php echo('Created '); ?></th>
             <th>Action</th>
            </tr> 
            </thead>
            <tbody>
            <?php  foreach ($sliderdata as $data): ?>
            <tr class="gradeX" id="order_<?php echo $data['Slider']['id']; ?>">
             <td><?php echo $this->Form->checkbox("use"+$data['Slider']['id'],array('value' => $data['Slider']['id'],'class'=>'checkAll')); ?></td>
          
           
            <td><?php echo h($data['Slider']['title']); ?></td>
            <td><?php echo h($data['Slider']['content']); ?></td>
            
			
            <td><img src="<?php echo $this->webroot;?>sliders/<?php echo h($data['Slider']['image']);?>" alt="<?php echo h($data['Slider']['image']); ?>" style="width:140px; height:50px;"></td>
           <td><?php echo h($data['Slider']['link']); ?></td>
		   <td><?php if($data['Slider']['status'] == '0'){echo "Deactivated";}else if($data['Slider']['status'] == '1'){echo "Activated";} ?></td>
		   <td><?php echo date("d-M-Y",strtotime($data['Slider']['created'])); ?></td>
            <td class="center">
             <form></form>
            <a href="<?php echo $this->Html->url(array('action' => 'edit', $data['Slider']['id'])); ?>" class="tablectrl_small bDefault tipS tool-tip" title="Edit"  style="margin-bottom:-7px;"><span class="edit-icn" data-icon="&#xe1db;"></span></a>
             <?php echo $this->Form->postLink('<span class="iconb" data-icon="&#xe136;"></span>',array('controller'=>'Sliders','action'=>'delete',$data['Slider']['id']),array('escape'=>false,'class'=>'tablectrl_small bDefault tipS tool-tip','title'=>'Delete'),__('Are you sure to want to delete?'));?>    
              <?php if ($data['Slider']['status']=='0'){ ?>

			<?php echo $this->Form->postLink('<span class="iconb" data-icon="&#xe1bf;"></span>', array('action' => 'activate', $data['Slider']['id']),array('escape'=>false,'class'=>'tablectrl_small bDefault tipS tool-tip','title'=>'Active'));?><?php }else { ?>

 <?php echo $this->Form->postLink('<span class="iconb" data-icon="&#xe1c1;"></span>', array('action' => 'block', $data['Slider']['id']), array('escape'=>false,'class'=>'tablectrl_small bDefault tipS tool-tip','title'=>'Deactive')); ?><?php }?>
      
           
            
            
  
			
            </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
            </table> 
            <br/><br/>
 <button onclick="$('#mbc').submit();" value="Delete" class="buttonS bRed" style="margin-left:20px"> Delete All</button>

           <div class="tPages">
              <ul class="pages">
               <!--<li class="prev"><?php //echo $this->Paginator->prev('' ,null, null, array('class' => 'icon-arrow-14'));?></li>-->
               <li><?php echo $this->Paginator->numbers(); ?>&nbsp;&nbsp;</li>
               <!--<li class="next"><?php //echo $this->Paginator->next('', null, null, array('class' => 'icon-arrow-17'));?></li>-->
               <!-- prints X of Y, where X is current page and Y is number of pages -->
               <?php //echo $this->Paginator->counter(); ?>
              </ul>
            </div>
		      <?php //debug($this->Paginator->numbers()); ?>
              <div style="margin-top:10px;"></div>
           </form>
		   <?php  } else { ?>
			<div class="no-record">No record found</div>
			<?php } ?>
             </div>  
        </div>        
    </div>
</div>
</div>

<script>
   
        $("#deactive").click(function(){  
                document.usr_form.action = '<?php echo $this->webroot;?>admin/users/deactivateall';
				document.usr_form.submit(); 
        });
		$("#activate").click(function(){  
                document.usr_form.action = '<?php echo $this->webroot;?>admin/users/activateall';
				document.usr_form.submit(); 
        });
		
	
	
	

</script>
      
