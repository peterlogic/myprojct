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
        <span class="pageTitle"><span class="icon-screen"></span>Contact Management</span>
        
    </div>
     <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?php echo $this->Html->url(array('controller'=>'users','action'=>'admin_dashboard')); ?>">Dashboard</a></li>
                <li class="current"><a href="<?php echo $this->Html->url(array('controller'=>'users','action'=>'admin_index')); ?>">Contact Management</a></li>
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
        <!--</div></span>--><h6>Contact Management</h6>
       
        
        </div>
		  <?php if(!empty($info)) {?>
        <div id="dyn" class="hiddenpars">
           
             <?php  echo $this->Form->create('Contact',array("action" => "deleteall",'id' => 'mbc')); ?>
            <table cellpadding="0" cellspacing="0" class="tDefault checkAll tMedia tbl_repeat" id="checkAll" width="100%">
            <thead>
            <tr>
            <th></th>
			<th><?php echo ('Full Name'); ?></th>
			<th><?php echo ('Email'); ?></th>
            <th><?php echo ('Phone'); ?></th>
            <th><?php echo('Date'); ?></th>
             <th>Action</th>
            </tr> 
            </thead>
            <tbody>
            <?php  foreach ($info as $data): ?>
            <tr class="gradeX" id="order_<?php echo $data['Contact']['id']; ?>">
             <td><?php echo $this->Form->checkbox("use"+$data['Contact']['id'],array('value' => $data['Contact']['id'],'class'=>'checkAll')); ?></td>
            <td><?php echo h($data['Contact']['full_name']); ?></td>
            <td><?php echo h($data['Contact']['email']); ?></td>
            <td><?php echo h($data['Contact']['phone']); ?></td>
            <td><?php echo date("d M y",strtotime($data['Contact']['created']))?></td>
			
            <td class="center">
             <form></form>
            <a href="<?php echo $this->Html->url(array('action' => 'edit', $data['Contact']['id'])); ?>" class="tablectrl_small bDefault tipS tool-tip" title="Edit"  style="margin-bottom:-7px;"><span class="edit-icn" data-icon="&#xe1db;"></span></a>
             <?php echo $this->Form->postLink('<span class="iconb" data-icon="&#xe136;"></span>',array('controller'=>'Contacts','action'=>'delete',$data['Contact']['id']),array('escape'=>false,'class'=>'tablectrl_small bDefault tipS tool-tip','title'=>'Delete'),__('Are you sure to want to delete?'));?>    
            </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
            </table> 
            <br/><br/><?php
		echo $this->Html->link('Delete All','javascript:void(0);',array('onclick'=>'return deleteAll();','class'=>'buttonS bRed','style'=>"margin-left:20px")); ?>
     <?php  }
                        else{?>
                            <div id="dyn" style="text-align:center;">
					No records found.
				</div>
                      <?php  }
                        ?>

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
             </div>  
        </div>        
    </div>
</div>
</div>


 <script type="text/javascript">
function deleteAll() {
    var anyBoxesChecked = false;
	var arr = new Array();
	$('#mbc input[type="checkbox"]').each(function() {
        if ($(this).is(":checked")) {
			arr.push($(this).val());
			anyBoxesChecked = true;
        }
    });
 
    if (anyBoxesChecked == false) {
		alert('Please select at least one checkbox to delete User.');
		return false;
    } else {				
		if(confirm("Are you sure you want to delete this contact '?")){
					
					$.ajax({
						type:'POST',
						dataType: 'json',
						url:'<?php echo Router::url(array('controller'=>'contacts','action'=>'admin_deleteall')); ?>',
						 data: {'Contact':arr},
						success:function(result){
                            $('.checkAll').attr("checked", false);
							$('#titleCheck').attr("checked", false);
							window.location.reload();
						}
					});
					
					return false;
		}	
			return false;
	} 
}//end of func deleteAll//
</script>