<?php require_once "phpfileuploader/phpuploader/include_phpuploader.php" ?>





<script src="//code.jquery.com/jquery-1.10.2.js"></script>



<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>







<script>



$(function() {



$( "#fromdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });



});



$(function() {



$( "#todatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });



});



</script>

<div class="">



  <div class="shadow">



    <h3>Allot A File</h3>



  </div>



  <!-- shadow -->



  <hr noshade="noshade" class="hr-5">



  <section class="reg-section margin-top-30">



 



  <div class="float-left">



   <div>



	



	



		</div>



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



  



 <?php 



    



	foreach($plot as $key){



	
 if($key['com_res']=='Commercial'){$type='C'; }else{$type='R';}


 ?> 



 <div id="error-div" class="errorMessage" style="display: none; color:#F00; "></div>

<h5>Plot Information</h5>

 



  <input type="hidden" name="file_id" id="file_id" value="<?php echo $key['id']?>" />



     



   


   



 
<input type="hidden" readonly="readonly" name="project" id="project" value="<?php echo $_REQUEST['pro']?>" />

<b>Plot No.</b><?php echo $key['plot_detail_address']?><br />
<b>Size.</b><?php echo $key['size'].' ('.$key['plot_size'].')'?><br />
<b>Street No.</b><?php echo $key['street']?><br />
<b>Sector Name.</b><?php echo $key['sector_name']?><br />
<b>Project Name.</b><?php echo $key['project_name']?><br />


 
 <hr noshade="noshade" class="hr-5">
<div class="clearfix"></div>
  



  



 



  <div class="float-left">



    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text" value="" name="cnic" id="cnic" class="reg-login-text-field" />



    </p>



  </div>

<div class="float-left">
      <p class="reg-left-text">File Membership No<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
         <input type="text" value="<?php echo $key['code'] ?>" name="procode" id="procode" class="reg-login-text-field" style="width:60px;"  readonly/>

      <input type="text" value="" name="plotno" id="plotno" class="reg-login-text-field" style="width:140px;" />
	
      <input type="text" value="<?php echo $key['scode'].$type ?>" name="sizecode" id="sizecode" class="reg-login-text-field" style="width:60px;" readonly/>
        
        <!-- <span style="color:#FF0000; display:block;" id="memerror"></span>--> 
        
      </p>
    </div>

  <div class="">



    <img name="image" id="image"/>



      



  </div>
<div class="float-left">
      <p class="reg-left-text">Discount <font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input type="number" value="" name="disc" id="disc" class="reg-login-text-field" />
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text">Discount Details <font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input type="text" value="" name="discd" id="discd" class="reg-login-text-field" />
      </p>
    </div>


    



  



   



   <div class="float-left">



    <p class="reg-left-text">No. Of Installment(After Months)<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="number" value="" name="noi" id="noi" class="reg-login-text-field" />



    </p>



  </div>
  <div class="float-left">



    <p class="reg-left-text">Plan Start Date<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



   <input name="date"  type="text" placeholder="Enter Date" class="new-input" id="todatepicker">



    </p>



  </div>

	<div class="float-left">



    <p class="reg-left-text">Installment Plan<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



     <select name="insplan" id="insplan">

     <option value="">Select Installment Plan</option>

     <?php

     foreach($plan as $p)

	 {

	echo'<option value="'.$p['id'].'">'.$p['tno'].'&nbsp;'.'Months'.'('.$p['description'].')</option>
';	 
	 

		 

	 }

	 

	 ?>

          

     </select>



    </p>



  </div>

   <div class="float-left">
      <p class="reg-left-text">Allotment Type<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <select name="atype" id="atype">
          <option value="">Select Type</option>
 <option value="Against Land">Against Land</option>          
<option value="On Payment">On Payment </option>
         
        </select>
      </p>
    </div>



    <?php echo CHtml::ajaxSubmitButton(



                                'Alot File',



    array('memberfile/alotafile'),



                                array(  



                'beforeSend' => 'function(){ 



                                             $("#login").attr("disabled",true);



            }',



                                        'complete' => 'function(){ 



                                             $("#user_login_form").each(function(){this.reset();});



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



                         array("id"=>"login","class" => "btn-info pull-right")      



                ); ?>



  







<!--  </form>-->   <?php }?>







<?php $this->endWidget(); ?>











 <!-- <input name="submit" value="Alot Plot" type="submit" class="btn-info pull-right" style="position: fixed; padding:5px;" />



 -->   <div style="height: 600px;



    padding: 0 0 0 32px;



    width: 300px;">



  <span style="color:#FF0000; display:block;" id="error-project"></span>



  <span style="color:#FF0000; display:block;" id="error-street_id"></span>



  <span style="color:#FF0000; display:block;" id="error-plot_id"></span>



 <span style="color:#FF0000;display:block;" id="error-cnic"></span>



  <span style="color:#FF0000;display:block;" id="error-downpayment"></span>   



  <span style="color:#FF0000;display:block;" id="error-discount"></span>   



  <span style="color:#FF0000;display:block;" id="error-noi"></span>   



 <span style="color:#FF0000;display:block;" id="error-payment_type"></span>   



 <span style="color:#FF0000;display:block;" id="error-plotno"></span>   



 



   </div>



 



  



  <!--VALIDATION START-->





<script>







function validateForm(){



	$("#error-project").hide();



	$("#error-street_id").hide();



	$("#error-plot_detail_address").hide();



	$("#error-cnic").hide();



	$("#error-plotno").hide();



	$("#error-downpayment").hide();



	$("#error-discount").hide();



	$("#error-noi").hide();



	$("#error-payment_type").hide();



	//	var x=document.forms["form"]["firstname"].value;



	var w = $("#project").val();



	var x = $("#street_id").val();



	var y = $("#plot_detail_address").val();



	var no = $("#plotno").val();



	var c = $("#cnic").val();



	var i = $("#downpayment").val();



	var j = $("#discount").val();



	var k = $("#noi").val();



	var l = $("#payment_type").val();







var counter=0;



if (w==null || w=="")



  {



  $("#error-project").html("Enter Project");



  $("#error-project").show();



  counter =1;



  }



if (no==null || no=="")



  {



  $("#error-plotno").html("Enter Plot Membership No");



  $("#error-plotno").show();



  counter =1;



  }







if (x==null || x=="")



  {



  $("#error-street_id").html("Enter Street");



  $("#error-street_id").show();



  counter =1;



  }



  if (y==null || y=="")



  {



  $("#error-plot_detail_address").html("Enter Plot No");



  $("#error-plot_detail_address").show();



  counter =1;



  }











 



  if (c==null || c=="")



  {



  $("#error-cnic").html("Enter CNIC");



  $("#error-cnic").show();



  counter =1;



  }



    if (i==null || i=="")



  {



  $("#error-downpayment").html("Enter Down Payment");



  $("#error-downpayment").show();



  counter =1;



  }  



    if (j==null || j=="")



  {



  $("#error-discount").html("Enter Discount");



  $("#error-discount").show();



  counter =1;



  }     



    if (k==null || k=="")



  {



  $("#error-noi").html("Enter No Of Installment");



  $("#error-noi").show();



  counter =1;



  }     



      



 if(counter==1)



  	return false;



  



}



 <!--VALIDATION END-->



 </script>











  



  



  <script>



 



  $(document).ready(function()



     {  	



		



       $("#project").change(function()



           {


           select_plan($(this).val());
         	select_street($(this).val());



		   });



		   



		   $("#street_id").change(function()



           {



         	select_plot($(this).val());



		   });



		   



		    $("#cnic").change(function()



           {



         	select_cnic($(this).val());



		   });



		     $("#plotno").change(function()



           {



         	select_mem($(this).val());



		   });



		    });



<!--function select_mem(id)



{



$.ajax({



      type: "POST",



      url:    "ajaxRequest6?val1="+id,



	  contenetType:"json",



      success: function(jsonList){var json = $.parseJSON(jsonList);



	  



var listItems='';



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>Membership Number Already in DB</option>";



      



});listItems+="";







$("#memerror").html(listItems);



          }



});



}

-->

 

function select_plan(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest7?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.tno +"("+val.description+" Installment Plan) </option>";
});listItems+="";
$("#insplan").html(listItems);
          }
});



}

function select_street(id)



{



$.ajax({



      type: "POST",



      url:    "ajaxRequest?val1="+id,



	  contenetType:"json",



      success: function(jsonList){var json = $.parseJSON(jsonList);



var listItems='';







	listItems+= "<option value=''></option>";



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";



});listItems+="";







$("#street_id").html(listItems);



          }



    });



}



function select_plot(id)



{



$.ajax({



      type: "POST",



      url:    "ajaxRequest1?val1="+id,



	  contenetType:"json",



      success: function(jsonList){var json = $.parseJSON(jsonList);



	  



var listItems='';



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";



      



});listItems+="";







$("#plot_id").html(listItems);



          }



});



}







function select_cnic(id)



{



$.ajax({



      type: "POST",



      url:    "ajaxRequest5?val1="+id,



   contenetType:"json",



      success: function(jsonList){var json = $.parseJSON(jsonList);



   



var listItems='';



 $(json).each(function(i,val){



 listItems+= '<img src="/upload_pic/' + val.image +'"/>';



      



});listItems+="";







$("#image").html(listItems);



          }



});



}







</script> 



</div>



</section>



<!-- section 3 --> 


