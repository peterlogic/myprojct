
<?php echo $this->element("admin_header"); ?>
<?php echo $this->element("admin_topright"); ?>
<?php echo $this->element("admin_nav"); ?>
<?php echo $this->element("admin_sidebar"); ?> 
<!--------------------------->
<div id="content">
    <div class="contentTop">
        <span class="pageTitle"><span class="icon-screen"></span>Service Management</span>
        <ul class="quickStats">
           
        </ul>
    </div>
     <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'admin_dashboard')); ?>">Dashboard</a></li>
                <li><a href="<?php echo $this->Html->url(array('controller'=>'Services','action'=>'admin_view')); ?>">Services Management</a></li>
                 <li class="current"><a href="javascript:void:(0)">Add Service</a></li>
            </ul>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">

    
    	<!-- Chart -->
 
            
         <div class="widget fluid">
        <div class="whead"><h6>Add Service</h6></div>
        <div id="dyn" class="hiddenpars">
            
	<?php	   echo $this->Form->create('Service', array('controller' => 'services','action'=>'add','enctype'=>'multipart/form-data' ));?>
                			 
                <div class="formRow">
                    <div class="grid3"><label>Name:</label></div>
                    <div class="grid9">
                    <input type="text" name="data[Service][title]"  required>                   
                             
				 
                    </div>
                </div>         
                 <div class="formRow">
                    <div class="grid3"><label>Description:</label></div>
                    <div class="grid9">
                 <textarea name="data[Service][content]" style="width: 464px; height: 101px;" required></textarea>
				 <?php //echo $this->Form->input('name', array('label'=>"",'type'=>'textarea','value'=>$data['Slider']['content']));?>
                    </div>
                </div>      
                     
                 <div class="formRow">
                    <div class="grid3"><label>Image:</label></div>
                    <div class="grid9">
					
					<input type="file" name="data[Service][image]"  id="fileUpload" required="required">
					
				
                   
                    </div>
                </div>       				
                
				
				
				
			



			<div class="formRow">
                    <div class="grid3"><label></label></div>
                    <div class="grid2">
                    <button type="submit" name="Save" id="update" class="buttonS bLightBlue" >Save</button>
                    </div>
					<div class="grid2">
                    <a href="<?php echo $this->webroot; ?>admin/categories/index" class="buttonS bLightBlue" >Cancel</a>
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

                         if (height < 200 && width < 450) {

						
                            alert("Height and Width should not be less then 200px and 450px.");
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