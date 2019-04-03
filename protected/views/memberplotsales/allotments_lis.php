<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
	  var project_name=$("#project_name").val();
	   var stat=2;	
 $.ajax({
	     url:"https://<?php echo $address ?>/index.php/memberplotsales/searchreq1",
                  type:"POST",
                 data:"actionfunction=showData&page=1&project_name="+project_name+"&stat="+stat,
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
	     url:"https://<?php echo $address ?>/index.php/memberplotsales/searchreq1",
                  type:"POST",
                  data:$("#user_login_form").serialize()+"&&page="+$page,
				//  data:"actionfunction=showData&page="+$page,
        cache: false,
        success: function(response){
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
});
</script>
<?php header('Cache-Control: max-age=900'); ?>

<div class="shadow">

<a href="memberplot" class="btn" style="float:right">New Allotment</a>

  <h3>Allotment List</h3></div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">

<?php 

$pages_data = Yii::app()->session['pages_array'];

?>
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
<input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" style="width:150px;"/>
<input type="text" value="" name="appno" id="appno" class="new-input" placeholder="Application #" style="width:150px;"/>
 <input type="text" value="" name="name1" id="name" class="new-input" placeholder="Name" style="width:150px;"/>
    <input type="text" value="" name="cnic" id="cnic" class="new-input" style="width:150px;" placeholder="CNIC" />
	    	<select name="project_name" id="project_name" style="width:150px;"><?php	
	if(!empty($pro)){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 
             <select name="allotmentstatus" id="allotmentstatus" style="width:150px;">
<option value="">Select Status</option>

<option value="1">Alloted</option>
<option value="2">Under Allotment</option>   </select>

             <select name="com_res" id="com_res" style="width:150px;">
<option value="">Select Type</option>

<option value="Residential">Residential</option>
<option value="Commercial">Commercial</option>   </select>


<select id="stat" name="stat" style="width:150px;">
<option value="2">Awaited Submission</option>
<option value="1">Submitted</option>


</select>
                  
 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('memberplotsales/searchreq1/?page=1'),

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

                                         location.href = "https://rdlpk.com/index.php/user/dashboard";

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

  



<!--  </form>-->

<?php $this->endWidget(); ?>

  <div class="">

    <p class="reg-left-textResult For"></p>

     

            <table class="table table-striped table-new table-bordered" style="font-size:12px;">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>

                         <th width="8%">MS No.</th>
                         <th width="4%">App No.</th>

                       

                         <th width="6%">Image</th>
                        <th width="9%">Name</th>

                        <th width="8%">Father/Spouse</th>

                        <th width="6%">CNIC</th>
  						 <th width="6%">Plot Size</th>
                        <th width="3%">Plot No.</th>

                        <th width="6%">Street/Lane</th>
						
                        <th width="4%">Block</th>

                        <th width="8%">Project</th>

                        

                        <th width="6%">Action</th>

                        

                    

                    </tr>

                </thead>

              
                <tbody id="error-div">



              


</tbody>

</table>

  </div>
  

 

 

 <script>

 

  $(document).ready(function()

     {  	

		

       $("#project").change(function()

           {

         	select_street($(this).val());

		   });

		   

		   $("#street_id").change(function()

           {

         	select_plot($(this).val());

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



</script>

 

 </section>

<!-- section 3 --> 

