<style>
.btn span.glyphicon {    			
	opacity: 0;				
}
.btn.active span.glyphicon {				
	opacity: 1;				
}
.month{
	display:none;
	border-top:1 px solid;
	}
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>

<script>



</script>

<?php 

$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;

?>

<script>	
 $(function(){
	  var project_name=$("#project_name").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/reciept/Dreportrereq",
                  type:"POST",
                 data:$("#user_login_form").serialize(),
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
     url:"http://<?php echo $address ?>/index.php/reciept/Dreportrereq",
                  type:"POST",
                  data:$("#user_login_form").serialize()+"&&page="+$page,
				//  data:"actionfunction=showData&page="+$page,
       cache: false,
        success: function(response){
		  $('#error-div').html(response);
		   $('#error-div123').html(response);
		}
	   });
	return false;
	});
});
</script>





<div class="shadow">



  <h3>Monthly Receiving Report </span></h3>

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30"> 
<div class="span4" style="float:right;">

<?php 


?> 

<!-- <table class="table table-striped table-new table-bordered" style="font-size:12px;">

 <th style="border-right:none;border-left:none;" width="15%">Payment Received</th>

 <th style="border-right:none;border-left:none;" width="20%">Target</th>
 <th style="border-right:none;border-left:none;" width="20%">Percentage</th>
 <tbody id="error-div123" style="font-size:15px;">

  </tbody>
</table>-->

</div>
  

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
   <select name="project_id" id="project_id" style="width:185px;">
   <?php	
            $res=array();
            foreach($pro as $key){

            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 

            }?>

  </select>
 <select onchange="Myfunc()" name="year" id="year" style="width:185px;">
 <option value="">Select Year</option>
 <option value="2014">2014</option>
 <option value="2015">2015</option>
 <option value="2016">2016</option>
 <option value="2017">2017</option>
 </select>
 <span style="background:#6FC;">
        <div class="month" id="month">			
		<div class="btn-group" data-toggle="buttons">		
			<label class="btn btn-success active">
				<input type="radio" name="mon" id="mon" value="01" autocomplete="off" chacked> January
				<span class="glyphicon glyphicon-ok"></span>
			</label>
			<label class="btn btn-primary">
				<input type="radio" name="mon" id="mon" value="02" autocomplete="off">February
				<span class="glyphicon glyphicon-ok"></span>
			</label>
			<label class="btn btn-info">
				<input type="radio" name="mon" id="mon" value="03" autocomplete="off">March 
				<span class="glyphicon glyphicon-ok"></span>
			</label>

			<label class="btn btn-default">
				<input type="radio" name="mon" id="mon" value="04" autocomplete="off">April
				<span class="glyphicon glyphicon-ok"></span>
			</label>
			<label class="btn btn-warning">
				<input type="radio" name="mon" id="mon" value="05" autocomplete="off">May 
				<span class="glyphicon glyphicon-ok"></span>
			</label>
			<label class="btn btn-danger">
				<input type="radio" name="mon" id="mon" value="06" autocomplete="off">June
				<span class="glyphicon glyphicon-ok"></span>
			</label>
            <label class="btn btn-success active">
				<input type="radio" name="mon" id="mon" value="07" autocomplete="off" chacked> July
				<span class="glyphicon glyphicon-ok"></span>
			</label>
			<label class="btn btn-primary">
				<input type="radio" name="mon" id="mon" value="08" autocomplete="off">August
				<span class="glyphicon glyphicon-ok"></span>
			</label>
			<label class="btn btn-info">
				<input type="radio" name="mon" id="mon" value="09" autocomplete="off">September 
				<span class="glyphicon glyphicon-ok"></span>
			</label>
			<label class="btn btn-default">
				<input type="radio" name="mon" id="mon" value="10" autocomplete="off">October
				<span class="glyphicon glyphicon-ok"></span>
			</label>
			<label class="btn btn-warning">
				<input type="radio" name="mon" id="mon" value="11" autocomplete="off">November 
				<span class="glyphicon glyphicon-ok"></span>
			</label>
			<label class="btn btn-danger">
				<input type="radio" name="mon" id="mon" value="12" autocomplete="off">December
				<span class="glyphicon glyphicon-ok"></span>
			</label>
		</div>
        </div>
  </span>
   <?php echo CHtml::ajaxSubmitButton(
                                'Search',
    array('/reciept/Dreportrereq'),
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

                            }

          else{

                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }
                                       }' 

    ),

                         array("id"=>"login","class" => "btn")      

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

<style>th { vertical-align:middle !important; text-align:center !important;}</style>
<!--<span style="float:right;"><a href="add_target">Add Monthly Target</a></span>-->
<table class="table table-striped table-new table-bordered">

  <thead style=" vertical-align:middle !important;background:#666; border-color:#ccc; font-size:15px; color:#fff;">
    <th width="2%">Sr. No.</th>
    <th width="4%">Receiving Date</th>
    <th width="4%">Fees/Charges Payment</th>
    <th width="4%">Installment Payment</th>
    <th width="4%">Total Payment</th>
    
    <th width="10%">Remarks</th>
      </thead>
  <tbody id="error-div" style="font-size:15px;">
  </tbody>

</table>

</div>

<hr noshade="noshade" class="hr-5 float-left">

<script>
function Myfunc(){
	
	document.getElementById('month').style.display="block";
	}

  $(document).ready(function()
     {  	
       $("#project").change(function()
           {
         	select_street($(this).val());
		   });
     });

</script>