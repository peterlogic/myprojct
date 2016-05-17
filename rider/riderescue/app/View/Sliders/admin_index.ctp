
<?php echo $this->element("admin_header"); ?>
<?php echo $this->element("admin_topright"); ?>
<?php echo $this->element("admin_nav"); ?>
<?php echo $this->element("admin_sidebar"); ?> 
<!--------------------------->
<div id="content">
    <div class="contentTop">
        <span class="pageTitle"><span class="icon-screen"></span>Slider Management</span>
        <ul class="quickStats">
         
        </ul>
    </div>
     <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'admin_dashboard')); ?>">Dashboard</a></li>
                <li><a href="<?php echo $this->Html->url(array('controller'=>'Sliders','action'=>'admin_view')); ?>">Sliders Management</a></li>
                 <li class="current"><a href="javascript:void:(0)">Add Slider</a></li>
            </ul>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">

    
    	<!-- Chart -->
 
            
         <div class="widget fluid">
        <div class="whead"><h6>Add Slider</h6></div>
        <div id="dyn" class="hiddenpars">
            
	<?php	  echo $this->Form->create('Slider', array('controller' => 'sliders','action'=>'add','enctype'=>'multipart/form-data' ));?>
                			 
                <div class="formRow">
                    <div class="grid3"><label>Title:</label></div>
                    <div class="grid9">
                    <input type="text" name="data[Slider][title]" required >                   
                                
				 
                    </div>
                </div>         
                 <div class="formRow">
                    <div class="grid3"><label>Content:</label></div>
                    <div class="grid9">
                 <textarea name="data[Slider][content]" style="width: 464px; height: 101px;" required="required"></textarea>
				 <?php //echo $this->Form->input('name', array('label'=>"",'type'=>'textarea','value'=>$data['Slider']['content']));?>
                    </div>
                </div>      
                 
                 <div class="formRow">
                    <div class="grid3"><label>Image:</label></div>
                    <div class="grid9">
					
					<input type="file" name="data[Slider][image]" id="fileUpload" required="required" />
					
				
                   
                    </div>
                </div>       				
                
				 <div class="formRow">
                    <div class="grid3"><label>Link:</label></div>
                    <div class="grid9">
                  <input type="text"  name="data[Slider][link]"  id="date"   required>
				 
                    </div>
                </div> 
				
				
			



			<div class="formRow">
                    <div class="grid3">
                    <div class="grid2">
                    <button type="submit" name="Save" id="update" class="buttonS bLightBlue" >Save</button>
                    </div>
					<div class="grid2">
                    <a href="<?php echo $this->webroot; ?>admin/categories/index" class="buttonS bLightBlue" >Cancel</a>
                    </div></div>
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

                        if (height < 600 && width < 1300) {

						
                            alert("Height and Width should not be less then 600px and 1300px.");
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