<div class="shadow">
  <h3>Detail Report<b>  ::  Re-allocation</b></h3>
             <?php
  $connection = Yii::app()->db;  
 $sql  = "SELECT * from projects where id='".$_POST['project']."'"; 
$result = $connection->createCommand($sql)->query();
foreach($result as $ro)
{
echo '<b>Project Name:</b>'.$ro['project_name']; 
}
?>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<style>
.bgd { background-color:#999; }
.float-left{ height:auto;}

</style>
<section class="reg-section margin-top-30">


<div>
 
 </div>
  <div class="float-left">
          <?php
		  $connection = Yii::app()->db; 
          $sql_plots  = "SELECT * FROM size_cat";
$result_plots = $connection->createCommand($sql_plots)->queryAll();	
foreach($result_plots as $row1){
	echo '<b>Plot Category  ::'.$row1['size'].'</b>';
		  ?>  
            
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                   		<tr>
                        <th width="4%">Sr #</th>
                        <th width="6%">Plot No</th>
                        <th width="7%">Dimension</th>
                        <th width="7%">Plot Address</th>
                        <th width="7%">Plot Features</th>
                        <th width="5%">Cost </th>
                        <th width="5%">P.Plot No</th>
                        <th width="5%">P.Dimension</th>
                        <th width="5%">P.Plot Address</th>
                        <th width="5%">Status </th>
                        </tr>
                        
                </thead>
                <tbody>
                
           <?php
		   $_POST['project']=1;
	$count=0;
	$sql_plots1  = "SELECT reallocation_history.id,reallocation_history.plot_detail_address,reallocation_history.plot_size,reallocation_history.price,reallocation_history.status,reallocation_history.sector,reallocation_history.cstatus, streets.street FROM reallocation_history
	Left JOIN streets ON (reallocation_history.street_id = streets.id)
	 where reallocation_history.project_id='".$_POST['project']."' and size2='".$row1['id']."'";
$result_plots1 = $connection->createCommand($sql_plots1)->query();	

foreach($result_plots1 as $row2){
	$count++;
	$sql_plots3  = "SELECT plots.id,plots.plot_detail_address,plots.plot_size,plots.price,plots.status,plots.sector,plots.cstatus, streets.street FROM plots
	Left JOIN streets ON (plots.street_id = streets.id)
	  where plots.id='".$row2['id']."'";
//echo $sql_plots3;exit;
$result_plots3 = $connection->createCommand($sql_plots3)->queryRow();	

	echo '<tr><td>'.$count.'</td>
	<td>'.$row2['plot_detail_address'].'</td>
	<td>'.$row2['plot_size'].'</td>
	<td>Str. #'.$row2['street'].'Sec-'.$row2['sector'].'</td>
	<td></td>
	<td>'.$row2['price'].'</td>
	<td>'.$result_plots3['plot_detail_address'].'</td>
	<td>'.$result_plots3['plot_size'].'</td>
	<td>Str. #'.$result_plots3['street'].'Sec-'.$result_plots3['sector'].'</td>
	<td>'.$row2['status'].'//'.$row2['cstatus'].'</td></tr>';
	
	}
	
 ?>
                    
                </tbody>
            </table><?php }?>
                <form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">

 <input type="hidden" name="paper" value="a4">
  <input type="hidden" name="orientation" value="landscape">
<textarea style="visibility:hidden;" name="html" id="html">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDF Report</title>
<style>
td{ padding:0px; border-top:1px solid #000; border-left:1px solid #000;}
.table-bordered{ border-right:1px solid #000; border-bottom:1px solid #000;}
</style>
</head>

<body>

<section class="reg-section margin-top-30">
 <h3>Detail Report<b> :Re-allocation</b></h3>
          <?php
  $connection = Yii::app()->db;  
 $sqal  = "SELECT * from projects where id='".$_POST['project']."'"; 
$resultas = $connection->createCommand($sqal)->query();
foreach($resultas as $roo)
{
echo '<p><b>Project Name:</b>'.$roo['project_name'].'</p>'; 
}
?>
</div>
   <?php
		  $connection = Yii::app()->db; 
          $sql_plots  = "SELECT * FROM size_cat";
$result_plots = $connection->createCommand($sql_plots)->queryAll();	
foreach($result_plots as $row1){
	echo '<b><p>Plot Category  ::'.$row1['size'].'</p></b>';
		  ?>  
            
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                   		<tr>
                        <th width="4%">Sr #</th>
                        <th width="6%">Plot No</th>
                        <th width="7%">Dimension</th>
                        <th width="7%">Plot Address</th>
                        <th width="7%">Plot Features</th>
                        <th width="5%">Cost </th>
                        <th width="5%">P.Plot No</th>
                        <th width="5%">P.Dimension</th>
                        <th width="5%">P.Plot Address</th>
                        <th width="5%">Status </th>
                        </tr>
                        
                </thead>
                <tbody>
                
           <?php
		   $_POST['project']=1;
	$count=0;
	$sql_plots1  = "SELECT reallocation_history.id,reallocation_history.plot_detail_address,reallocation_history.plot_size,reallocation_history.price,reallocation_history.status,reallocation_history.sector,reallocation_history.cstatus, streets.street FROM reallocation_history
	Left JOIN streets ON (reallocation_history.street_id = streets.id)
	 where reallocation_history.project_id='".$_POST['project']."' and size2='".$row1['id']."'";
$result_plots1 = $connection->createCommand($sql_plots1)->query();	

foreach($result_plots1 as $row2){
	$count++;
	$sql_plots3  = "SELECT plots.id,plots.plot_detail_address,plots.plot_size,plots.price,plots.status,plots.sector,plots.cstatus, streets.street FROM plots
	Left JOIN streets ON (plots.street_id = streets.id)
	  where plots.id='".$row2['id']."'";
//echo $sql_plots3;exit;
$result_plots3 = $connection->createCommand($sql_plots3)->queryRow();	

	echo '<tr><td>'.$count.'</td>
	<td>'.$row2['plot_detail_address'].'</td>
	<td>'.$row2['plot_size'].'</td>
	<td>Str. #'.$row2['street'].'Sec-'.$row2['sector'].'</td>
	<td></td>
	<td>'.$row2['price'].'</td>
	<td>'.$result_plots3['plot_detail_address'].'</td>
	<td>'.$result_plots3['plot_size'].'</td>
	<td>Str. #'.$result_plots3['street'].'Sec-'.$result_plots3['sector'].'</td>
	<td>'.$row2['status'].'//'.$row2['cstatus'].'</td></tr>';
	
	}
	
 ?>
                    
                </tbody>
            </table><?php }?>        
            </body>
</html>
</textarea>
<input style="float:left;" type="submit" name="submit" value="Generate PDF" /></form>
</form> 
<hr noshade="noshade" class="hr-5 float-left">
 			  
  </div>
  
  
  
  
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

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";

      



});listItems+="";



$("#street_id").html(listItems);

          }

    });

}

</script>