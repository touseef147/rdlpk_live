<style>
.alert {
	background: none repeat scroll 0 0 #f00;
	border: medium none #000;
	border-radius: 25px;
	color: #fff;
	position: fixed;
	width: 0;
	float: right;
	padding:8px 86px 8px 14px;
	position: unset;
}
td {
	width:200px;
}
.new {
	text-align:center;
	border: 3px solid #eeeeee;
	border-radius: 24px;
	float: left;
	height: 155px;
	margin: 50px;
	padding: 5px;
	width: 146px;
}
</style>

<div class="dropdown" style="width:15px;" ></div>
<?php 

$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;

?>
<script>	

 $(function(){

	  var uid=$("#uid").val();	

 $.ajax({

	     url:"http://<?php echo $address ?>/index.php/visitors/searchreq",

                  type:"POST",

                data:"actionfunction=showData&page=1&uid="+uid,

        cache: false,

        success: function(response){

		   

		  $('#error-div').html(response);

		}

	   });

    $('#error-div').on('click','.page-numbers',function(){

       $page = $(this).attr('href');

	   $pageind = $page.indexOf('page=');

	   $page = $page.substring(($pageind+5));

	   $.ajax({

	     url:"http://<?php echo $address ?>/index.php/visitors/searchreq",

                  type:"POST",

                //  data:"actionfunction=showData&page="+$page,

          data:$("#user_login_form").serialize()+"&&page="+$page,

		cache: false,

        success: function(response){

		  $('#error-div').html(response);

		}

	   });

	return false;

	});

});

</script>
<div class="shadow">
  <h3>Visitors List</h3>
</div>
<div style="float:right"><a href="followup_lis">
  <div class="alert"><?php echo $result.'&nbsp;FollowUp';?></div>
  </a></div>
<!-- shadow -->

  <?php	
			/*foreach($centers as $cent){
           
        
            echo '<b>'.$cent['name'].'</b>'; 
         }*/
		 ?>
<hr noshade="noshade" class="hr-5">


<input type="hidden" name="uid" id="uid" value="<?php  print_r(Yii::app()->session['centers_array']);?>" />
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
  <input type="text" value="" name="name1" id="name" class="new-input" placeholder="Enter Name" />
  <input type="text" value="" name="contactno" id="contactno" class="new-input" placeholder="Enter Contact No." />
 
  <?php echo CHtml::ajaxSubmitButton(
                                'Search',
    array('visitors/searchreq/?page=1'),
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

                         array("id"=>"login","class" => "login-btn")      
                ); ?> 
  
  <?php $this->endWidget(); ?>
<section class="login-section margin-top-30">
<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
<div class="clearfix"></div>
<div class="">
  <table class="table table-striped table-new table-bordered" style="font-size:12px;">
    <thead style="background:#666; border-color:#ccc; color:#fff;">
      <tr>
        <th width="4%">Serial #</th>
        <th width="5%">Visit Date</th>
        <th width="8%">Name</th>
        <th width="5%">Profession</th>
        <th width="5%">Contact#</th>
        <th width="5%">Email</th>
        <th width="5%">City</th>
        <th width="4%">Refered By </th>
        <th width="4%">Reference </th>
        <th width="5%">Action</th>
      </tr>
    </thead>
    <tbody id="error-div">
    </tbody>
  </table>
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







</script>