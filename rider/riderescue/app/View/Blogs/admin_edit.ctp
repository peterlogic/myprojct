<?php echo $this->element("admin_header"); ?>
<?php echo $this->element("admin_topright"); ?>
<?php echo $this->element("admin_nav"); ?>
<?php echo $this->element("admin_sidebar"); ?> 

<!--------------------------->
<div id="content">
    <div class="contentTop">
        <span class="pageTitle"><span class="icon-screen"></span>Blog Management</span>       
    </div>
     <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'admin_dashboard')); ?>">Dashboard</a></li>
                <li><a href="<?php echo $this->Html->url(array('controller'=>'Blogs','action'=>'admin_view')); ?>">Blogs Management</a></li>
                 <li class="current"><a href="javascript:void:(0)">Edit Blog</a></li>
            </ul>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">

    
    	<!-- Chart -->
 
            
         <div class="widget fluid">
        <div class="whead"><h6>Edit Blog</h6></div>
        <div id="dyn" class="hiddenpars">
            
	<?php	 echo $this->Form->create('Blog', array('controller' => 'Blogs','action'=>'edit',$data['Blog']['id'],'enctype'=>'multipart/form-data' ));?>
                			 
                <div class="formRow">
                    <div class="grid3"><label>Title:</label></div>
                    <div class="grid9">
                    <input type="text" name="data[Blog][title]" value="<?php echo $data['Blog']['title']; ?>"required >                   
                    <input type="hidden" name="data[Blog][id]" value="<?php echo $data['Blog']['id']; ?>">                   
				 
                    </div>
                </div>         
                 <div class="formRow">
                    <div class="grid3"><label>Content:</label></div>
                    <div class="grid9">
                 <textarea name="data[Blog][content]" style="width: 464px; height: 101px;" required><?php echo $data['Blog']['content'];?></textarea>
				 <?php //echo $this->Form->input('name', array('label'=>"",'type'=>'textarea','value'=>$data['Blog']['content']));?>
                    </div>
                </div>      
                 
                 <div class="formRow">
                    <div class="grid3"><label>Image:</label></div>
                    <div class="grid9">
					<img src="<?php echo $this->webroot;?>blogs/<?php echo h($data['Blog']['image']);?>" alt="<?php echo h($data['Blog']['image']); ?>" style="width:160px; height:60px;">
					<input type="file" name="data[Blog][image]" style="margin-left:30px;" id="fileUpload" >
					<input type="hidden" name="data[Blog][old_image]" value="<?php echo h($data['Blog']['image']);?>">	
                    </div>
                </div>       				
                
				 <div class="formRow">
                    <div class="grid3"><label>Url:</label></div>
                    <div class="grid9">
                  <input type="text"  name="data[Blog][link]"  id="date"  value="<?php echo $data['Blog']['link'];?>" required>
				 
                    </div>
                </div> 
				
				
			



			<div class="formRow">
                    <div class="grid3"><label></label></div>
                    <div class="grid2">
                    <button type="submit" name="Save" id="update" class="buttonS bLightBlue" >Save</button>
                    </div>
					<div class="grid2">
                    <a href="<?php echo $this->webroot; ?>admin/blogs/view" class="buttonS bLightBlue" >Cancel</a>
                    </div>
                </div>
           </form>
     
        </div>  
          
        </div>        
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function()  {
    $("#fileUpload").change(function () {

		  var fileUpload = $("#fileUpload")[0];



        //Check whether the file is valid Image.

        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");

        if (regex.test(fileUpload.value.toLowerCase())) {



            //Check whether HTML5 is supported.

            if (typeof (fileUpload.files) != "undefined") {

                //Initiate the FileReader object.

                var reader = new FileReader();



                //Read the contents of Image File.

                reader.readAsDataURL(fileUpload.files[0]);

                reader.onload = function (e) {



                    //Initiate the JavaScript Image object.

                    var image = new Image();



                    //Set the Base64 string return from FileReader as source.

                    image.src = e.target.result;

                    image.onload = function () {



                        //Determine the Height and Width.

                        var height = this.height;

                        var width = this.width;

    if (height < 200 && width < 550) {

						
                            alert("Height and Width should not be less then 200px and 550px.");
							$(fileUpload).val("");

                            return false;

                        }


                      

                        return true;

                    };

                }

            } else {

                alert("This browser does not support HTML5.");

                return false;

            }

        } else {

            alert("Please select a valid Image file.");

            return false;

        }
});
});

</script>