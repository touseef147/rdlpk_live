<?php $create=0;?>
<div class="shadow">
   <h3>Installment Details</h3>
</div>

<hr noshade="noshade" class="hr-5">
<span style="float:right;">
	<h4>Member Details</h4>
<?php $res=array();
    foreach($members as $mem){             
	echo '<b>Name:</b>' .$mem['name'].'</br>';
    echo '<b>CNIC :</b>' .$mem['cnic'].'</br>';
	  echo '<b>Membership # :</b>' .$mem['plotno'].'</br>';
	} ?> 
	</span><?php $numbers=0;?>
<h4>Plot Details</h4>
<?php $res=array();
    foreach($info as $row){
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
	echo '<b>Property No:</b>' .$mem['pname'].'</br>';
    echo '<b>Property Type  :</b>' .$mem['proname'].'('.$mem['floors'].')'.'</br>';
	echo '<b>Address     :</b>' .$row['sector_name'].'/'.$row['street'].'</br>';
    echo '<b>Project     :</b>' .$row['project_name'].'</br>';
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	$price=$row['price'];
	}  ?>
    
    <?php
foreach($minfo as $row6){
	$numbers=$row6['noi'];
	$create=$row6['create_date'];
	$months=$row6['insplan'];
}
	$perins=0;
   $perins=$price/$numbers;
   
    ?>
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30" style="font-size:11px;">
  <?php

;

// Check connection



$reciveable=0;

$paid=0;
$due=0;
$duesurcharge=0;
$paidsurcharge=0;



?>

  <table class="table table-striped table-new table-bordered">
    <thead style="background:#666; border-color:#ccc; color:#fff; ">
      <tr>
        <th><b>S# </b></th>
       <th><b>Due Date</b></th>
        <th><b>Paid Date</b></th>
        <th><b>Due Amount</b></th>
        <th><b>Paid Amount</b></th>
       <th><b>Payment Mode</b></th>
        <th><b>Voucher No</b></th>
        <th><b>Due Surcharge</b></th>
          <th><b>Paid Surcharge</b></th>
        <th><b>Remarks</b></th>
        <th><b>Status</b></th>
      </tr>
    </thead>
    <tbody>
     <?php
	  $i=0;
	 $ins='';
	$res=array();
	foreach($payments as $pay)
	{	
$i++;
  $due=$due+$pay['dueamount'];
  $paid=$paid+$pay['paidamount'];
   $duesurcharge=$duesurcharge+$pay['surcharge'];
    $paidsurcharge=$paidsurcharge+$pay['paidsurcharge'];
	$oins=$due-$paid;
  echo '<tr><td>'.$pay['lab']. '</td>

     <td>'.$pay['due_date'].'</td>
     <td>'.$pay['paid_date'].'</td>
     <td align="right">'.$pay['dueamount'].'</td>
     <td align="right">'.$pay['paidamount'].'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>'.$pay['detail'].'</td>
     <td align="right">'.$pay['surcharge'].'</td>
	 <td align="right">'.$pay['paidsurcharge'].'</td>
     <td>'.$pay['remarks'].'</td>
     <td>';if(!empty($pay['fstatus'])){ echo'<b style="color:Green;">Verified</b>';} else{ echo'<a href="installment_up?id='.$pay['id'].'">Edit</a>
	 /<a href="delete_ins?id='.$_GET['id'].'&&pid='.$_GET['pid'].'&&did='.$pay['id'].'">Delete</a>';echo'/<a href="installment_update?id='.$pay['id'].'">Pay</a></td>';}} 
	
	echo '<tr><td><b>Total:</b></td>
<td></td>
<td></td>
<td align="right"><b>'.number_format($due).'</b></td>
<td><b>'.number_format($paid).'</b></td>
<td align="right"></td>
<td></td>
<td align="right"><b>'.number_format($duesurcharge).'</b></td>
<td align="right"><b>'.number_format($paidsurcharge).'</b></td>
<td></td>
</tr>
<tr><td><b>Outstanding Installment</b></td><td><b>'.number_format($oins).'</b></td><td><b>'.number_format($oins/$due*100).'%'.'</b></td></tr>

';

	?>
    </tbody>
  </table>
</section>
</div>
<form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">

 <input type="hidden" name="paper" value="a4">
  <input type="hidden" name="orientation" value="portrait">
<textarea style="visibility:hidden;" name="html" id="html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDF Report</title>
<style>
td{ padding:0px;  border-top:1px solid #000; border-left:1px solid #000;}
.table-bordered{ border-right:1px solid #000; border-bottom:1px solid #000;}


</style>
</head>

<body>


<section class="reg-section margin-top-30" style="font-size:11px;">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td colspan="2" style="border-bottom:thin solid #000"><img  src="<?php echo Yii::getPathOfAlias('webroot')."/images/projects/royal_orchard/royal_orchard.jpg";  ?>" height="92px">
   </td>
  </tr>
  <tr>
    <td width="60%"><h4>Plot Details</h4>
<?php $res=array();
    foreach($info as $row){
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
	echo '<p style="margin:none;"><b>Plot No:</b>' .$row['plot_detail_address'].'</br></p>';
    echo '<p style="margin:none;"><b>Plot Size  :</b>' .$row['size'].'('.$row['plot_size'].')'.'</br></p>';
	echo '<p style="margin:none;"><b>Address     :</b>' .$row['sector'].'/'.$row['street'].'</br></p>';
    echo '<p style="margin:none;"><b>Project     :</b>' .$row['project_name'].'</br></p>';
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	$price=$row['price'];
	}  ?><?php $numbers=0;?>
</td>
    <td><h4>Member Details</h4>
	<?php $res=array();
    foreach($members as $mem){             
	echo '<p style="margin:none;"><b>Name:</b>' .$mem['name'].'</br></p>';
    echo '<p style="margin:none;"><b>CNIC :</b>' .$mem['cnic'].'</br></p>';
	  echo '<p style="margin:none;"><b>Membership # :</b>' .$mem['plotno'].'</br></p>';
	} ?> 
    </td>
  </tr>
</table>

 <span style="float:right;">
	

	</span>
    
  <?php



// Check connection



$reciveable=0;

$paid=0;
$due=0;
$duesurcharge=0;
$paidsurcharge=0;



?>

  <table class="table table-striped table-new table-bordered">
    <thead style="background:#666; border-color:#ccc; color:#fff; ">
      <tr>
        <th><b>S# </b></th>
       <th><b>Due Date</b></th>
        <th><b>Paid Date</b></th>
        <th><b>Due Amount</b></th>
        <th><b>Paid Amount</b></th>
       <th><b>Payment Mode</b></th>
        <th><b>Voucher No</b></th>
        <th><b>Due Surcharge</b></th>
          <th><b>Paid Surcharge</b></th>
        <th><b>Remarks</b></th>
        <th><b>Status</b></th>
      </tr>
    </thead>
    <tbody>
     <?php
	  $i=0;
	 $ins='';
	$res=array();
	foreach($payments as $pay)
	{	
$i++;
  $due=$due+$pay['dueamount'];
  $paid=$paid+$pay['paidamount'];
   $duesurcharge=$duesurcharge+$pay['surcharge'];
    $paidsurcharge=$paidsurcharge+$pay['paidsurcharge'];
	$oins=$due-$paid;
  echo '<tr><td>'.$pay['lab']. '</td>

     <td>'.$pay['due_date'].'</td>
     <td>'.$pay['paid_date'].'</td>
     <td align="right">'.$pay['dueamount'].'</td>
     <td align="right">'.$pay['paidamount'].'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>'.$pay['detail'].'</td>
     <td align="right">'.$pay['surcharge'].'</td>
	 <td align="right">'.$pay['paidsurcharge'].'</td>
     <td>'.$pay['remarks'].'</td>
     <td>';if(!empty($pay['fstatus'])){ echo'<b style="color:Green;">Verified</b>';}  echo'</td>';}
	
	echo '<tr><td><b>Total:</b></td>
<td></td>
<td></td>
<td align="right"><b>'.number_format($due).'</b></td>
<td align="right"><b>'.number_format($paid).'</b></td>
<td></td>
<td></td>
<td align="right"><b>'.number_format($duesurcharge).'</b></td>
<td align="right"><b>'.number_format($paidsurcharge).'</b></td>
<td></td>
<td></td>
</tr>
<tr><td colspan="3"><b>Outstanding Installment</b></td><td align="right"><b>'.number_format($oins).'</b></td><td align="right"><b>'.number_format($oins/$due*100).'%'.'</b></td><td colspan="6"></td></tr>

';

	?>
    </tbody>
  </table>
</section>
             
</body>
</html>
</textarea>
<input style="float:left;" type="submit" name="submit" value="Print Report" /></form>
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
