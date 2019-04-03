<div class="container-fluid" style="font-size:12px; background:#FFF;">

<style> .float-left1 {

	 width: 400px;

    float: left;

    margin-left: 20px;

}
input{width: 200px;
padding: 3px;}</style>

<div class="row-fluid">

<div class="shadow">

  <h3>Plot Transfer Form</h3>

</div>

<!-- shadow -->
<script type="text/javascript">
$(document).ready(function (e){
$("#user_login_form").on('submit',(function(e){
e.preventDefault();
$.ajax({
url: "RequestTransfer",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data){
$("#error-div").html(data);
},
error: function(){}          
});
}));
});
</script>
<hr noshade="noshade" class="hr-5 float-left">
<div id="error-div" style="font-size:12px; color:red;"></div>
<form action="RequestTransfer" id="user_login_form" method="post" onsubmit="return validateForm()"  >



<div class="span12"><a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/member/register" style="float:right;" class="btn">Add New Member</a>

  	

  <div class="span6">
<h4 style="text-align:left;">Plot Details</h4> 
  	<b>Plot No.:</b> <?php echo $plotdetails['plot_detail_address']?>

    <input type="hidden" value="<?php echo $plotdetails['plot_id']?> " name="plot_id" id="plot_id" class="f-left span4 clearfix" />
<br />
  	<b>Street/Lane:</b>

    <?php echo $plotdetails['street']?><br>
  	<b>Block/Sector:</b>

    <?php echo $plotdetails['sector_name']?><br>
<br />
  	<b>Plot Size:</b>

    <?php echo  $plotdetails['size'].'('.$plotdetails['plot_size'].')';?><br>
  	<b>Project Name:</b>
    <?php echo $plotdetails['project_name']?><br>
   <h4 style="text-align:left;">Transfer From </h4>
      <input type="hidden" value="<?php echo $plotdetails['member_id']?>" name="transfer_from_memberid" id="member_id" class="reg-login-text-field" />
      <b>Name:</b> <?php echo $plotdetails['name'].' <br><b>S/o D/O W/O:</b> '.$plotdetails['sodowo'];?>
  </div>
<div class="span6 pull-right">
<hr noshade="noshade" class="hr-5">
  <h4 style="text-align:left;">Transfer To</h4>
  	<div class="float-left1">
    <label class="span3 pull-left">CNIC</label>
    <input type="text" value="" name="cnic" id="cnic" class="text" />
    <span style="background-color:#9FF; width:300px; display: block;" id="error-cnic"></span>
    <span style="background-color:#9FF; width:300px; display: block;" id="error-cnic1"></span>
  </div>
	<div class="float-left1">
  <input name="submit" value="Send Transfer Request" type="submit" class="btn-info pull-right" style="padding:5px 10px; margin-right: 150px;" />
 </div>
</div>
 </form>




<!-- section 3 --> 

 <div class="clearfix"></div>

 

 

 

 </div> 

 </div>