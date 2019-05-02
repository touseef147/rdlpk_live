<div class="shadow">
  <h3>Add Plots</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">

<!--<form name="login-form" method="post" action="">-->
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); ?>



<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
    
  
  <input type="hidden" value="<?php echo $_REQUEST['pid'];?>" name="project_id" id="project_id" />
  <input type="hidden" value="<?php echo $_REQUEST['size'];?>" name="size" id="size" />

 
 <?php echo CHtml::ajaxSubmitButton(
                                'Search',
    array('/allotments/searchreq'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){});
                                             $("#login").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
        
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "http://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }
 
                                        }' 
    ),
                         array("id"=>"login","class" => "btn btn-success")      
                ); ?>
  

<!--  </form>-->
<?php $this->endWidget(); ?>

</section>
</div>
<!-- section 3 --> 




 
  <div class="clear-fix"></div>

  <!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />
    -->


  </form>

  <div class="float-left">
   
<div style="float:right;">
<a id="check-all" href="javascript:void(0);">Select all ||</a>
<a id="uncheck-all" href="javascript:void(0);">Unselect all</a> 
	 </div>        
            
<form method="post" action="addtoballot">
<input type="hidden" name="bid" value="<?php echo $_REQUEST['bid']; ?>" />
<input type="hidden" name="size" value="<?php echo $_REQUEST['size']; ?>" />
<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>" />
            <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>
                        <th width="10%">Project</th>
                        <th width="5%">Street</th>
                        <th width="6%">Plot No</th>
                        <th width="7%">Plot Size</th>
                        <th width="7%">Dimension</th>
                        <th width="7%">Type</th>
                        <th width="5%">Sector</th>
                       
                       <th width="7%">Select</th>
                        
                        </tr>

                </thead>

                <tbody id="error-div">

              

                    

                </tbody>

            </table>

 	<input type="submit" name="submit" value="Add" />		
</form>
  	

  </div>
<hr noshade="noshade" class="hr-5 float-left">

  

  

 

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
 
 <script>
 
 
 

  $(document).ready(function()

     {  	

		

       $("#project").change(function()

           {

         	select_street($(this).val());

		   });

		   

		  

     });

 

 

function select_street(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';
	listItems+="<option value=''>Select Street</option>";

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";

      



});listItems+="";



$("#street_id").html(listItems);

          }

    });

}
$(document).ready(function() {
  $('#check-all').click(function(){
    $("input:checkbox").attr('checked', true);
  });
  $('#uncheck-all').click(function(){
    $("input:checkbox").attr('checked', false);
  });
});
</script>