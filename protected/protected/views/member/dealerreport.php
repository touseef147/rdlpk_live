
<div class="shadow">
  <h3>Dealers </h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php 
$connection = Yii::app()->db;  
$sql  = "SELECT * FROM members where mtype ='Dealer'";
$result_dealer = $connection->createCommand($sql)->queryAll();
?>




  
  <div class="float-left">
   
    <p class="reg-right-field-area margin-left-5">
     <table class="table table-striped table-new table-bordered">
     <thead style="color:#FFF">
     <th>Name</th>
     <th>CNIC</th>
     <th>Phone Number</th>
     <th>Total Plot For Resale</th>
     <th>Sale</th>
     <th>Remaining</th>
     <th>Action</th>
     
     </thead>
     <tbody>
     <?php 
	 foreach($result_dealer as $row){
		$sqlp  = "SELECT * FROM memberplot where mmtype ='Dealer' and member_id='".$row['id']."'";
		$result_dealerp = $connection->createCommand($sqlp)->queryAll(); 
		
		$sqlh  = "SELECT * FROM plothistory where mmtype ='Dealer' and transferfrom_id='".$row['id']."'";
		$result_dealerh = $connection->createCommand($sqlh)->queryAll(); 
	 echo '<tr><td>'.$row['name'].'</td><td>'.$row['cnic'].'</td><td>'.$row['phone'].'</td><td>'.(count($result_dealerp)+count($result_dealerh)).'</td>
	 <td>'.count($result_dealerh).'</td><td>'.((count($result_dealerp)+count($result_dealerh))-count($result_dealerh)).'</td>
	 <td><a href="detaildealer?id='.$row['id'].'">Details</a></td>
	 </tr>';
	 }
	 ?>
     
     </tbody>
     </table> 			
  	
    </p>
  </div>
<?php //$this->endWidget(); ?>
 
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
      
		
   // $.each(val,function(k,v){
     //     console.log(k+" : "+ v);     
//});
});listItems+="";

$("#street_id").html(listItems);
          }//,
      //error: function(xhr){
      //alert("failure"+xhr.readyState+this.url)

      //}
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
      
		
   // $.each(val,function(k,v){
     //     console.log(k+" : "+ v);     
//});
});listItems+="";

$("#plot_id").html(listItems);
          }//,
      //error: function(xhr){
      //alert("failure"+xhr.readyState+this.url)

      //}
    });
}

</script>
 
 </section>
<?php 
$pages_data = Yii::app()->session['pages_array'];
?>