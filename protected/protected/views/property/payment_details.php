<style>
.td{text-align:right;}
</style>
<div class="shadow">

  <h3>Payment Details<div style="float:right;"><a href="installment_details?id=<?php echo $_REQUEST['id']?> && pid=<?php echo $_REQUEST['pid']?>"><h5>Installment Details</h5> </a></div>

</h3>

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
<h4>Property Details</h4>
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
    

    <hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30" style="font-size:11px;">

<?php



// Check connection



$reciveable=0;

$paid=0;
$due=0;



?> <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>
        	<th><b>S# </b></th>
			<th><b>Account Head </b></th>
            <th><b>Due Amount</b></th>
			 <th><b>Paid Amount</b></th>
              <th><b>Balance Amount</b></th>
			<th><b>Due Date</b></th>
			<th><b>Paid Date</b></th>
			<th><b>Due Surcharge</b></th>
			<th><b>Paid Surcharge</b></th>
			<th><b>Others</b></th>
			<th><b>Remarks</b></th>
            <th><b>Paid Install</b></th>
            <th><b>Action</b></th>

	</tr>		
        </thead>
		<tbody>
         <h4>Installment Summary:</h4>
 <?php $res=array();
    foreach($members as $mem){
	}?>
		<?php
        $i=0;
		$tlcost=0;
		$tpcost=0;
		$tpayed=0;
		$bamount=0;
		$surch=0;
		 $duesurcharge=0;
		 $paidsurcharge=0;	
		$paidsurch=0;
foreach($landcost as $land){
	$tlcost=$tlcost+$land['dueamount'];
		$tpcost=$tpcost+$land['paidamount'];
		$surch=$surch+$land['surcharge'];
		$paidsurch=$paidsurch+$land['paidsurcharge'];
		$bamount=$tlcost-$tpcost;
$tbalance=0;
		if($land['paidamount']!=''){
			$tpayed++;
			}
	
	}
echo '<tr><td>' . $i . '</td>
 <td align="left">Installment</td>
 <td style="text-align:right;">' .number_format($tlcost). '</td>
 <td style="text-align:right;">' .number_format($tpcost). '</td>
  <td style="text-align:right;">'.number_format($bamount).'</td>
  <td>As Per Plan</td>
  <td style="text-align:right;"></td>
  <td style="text-align:right;">' .number_format($surch). '</td>
  <td style="text-align:right;">' .number_format($paidsurch). '</td>
  <td></td>
  <td></td>
  <td>'.number_format($tpayed).'</td>
   <td><a href="installment_details?id='.$_REQUEST['id'].'&& pid='.$_REQUEST['pid'].'">Detail</a></td>
</tr></tbody></table>  ';
$tbalance=$tbalance+$bamount;
 $duesurcharge=$duesurcharge+$surch;	
$paidsurcharge=$paidsurcharge+$paidsurch;
?>

 <h4>Others Charges Details:</h4>
<table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>

        	<th><b>S# </b></th>

			<th><b>Account Head </b></th>

            <th><b>Due Amount</b></th>
			 <th><b>Paid Amount</b></th>
              <th><b>Balance Amount</b></th>
			<th><b>Due Date</b></th>
              <th><b>Paid Date</b></th>
			
			<th><b>Due Surcharge</b></th>
			<th><b>Paid Surcharge</b></th>

			<th><b>Others</b></th>

			<th><b>Remarks</b></th>
            <th><b>Document Voucher No</b></th>

            <th><b>Action</b></th>

	</tr>		

        </thead>

		<tbody>
<?php
	$bsurcharge=0;
    	
	//$paidsurcharge=0;
	$bsur=0;
	$res=array();

    foreach($payments as $row)
 
	{	
	
	
	
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle);
		$i++;
		
		$due=$due+$row['amount'];
		$paid=$paid+$row['paidamount'];
		$duesurcharge=$duesurcharge+$row['surcharge'];
		$paidsurcharge=$paidsurcharge+$row['paidsurcharge'];
		$bsur=$row['amount']-$row['paidamount'];
		
  echo '<tr><td>' . $i . '</td>

 <td>' .$row['payment_type']. '</td>

 <td style="text-align:right;">' .$row['amount']. '</td>
 <td style="text-align:right;">' .$row['paidamount']. '</td>
 <td style="text-align:right;">'.number_format($bsur).'</td>
  <td>' . $row['duedate']. '</td>

 

  <td>' . $row['date'] . '</td>

  <td style="text-align:right;">' . $row['surcharge'] . '</td>
    <td style="text-align:right;">' . $row['paidsurcharge'] . '</td>

  <td>' . $row['others'] . '</td>

  <td>' . $row['remarks'] . '</td>
   <td>' . $row['detail'] . '</td>
<td>';if(!empty($row['fstatus'])){ echo'<b style="color:Green;">Verified</b>';} else{ echo'
<a href="up_charges?pid='.$_REQUEST['pid'].'&&id='.$row['id'].'&&mem_id='.$mem['member_id'].'">Edit</a>/ <a href="update_charges?pid='.$_REQUEST['pid'].'&&id='.$row['id'].'&&mem_id='.$mem['member_id'].'">Pay</a>

</td></tr>	';} 
  
$tbalance=$tbalance+$bsur;

//$bsur=$bsur+$bsur;
}
?>
</tbody></table>
<table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>

	</tr>		

        </thead>

		<tbody>
        <h4>Overall Summary:</h4>
<?php
  $due=$due+$tlcost;
  $paid=$paid+$tpcost;
  $percentage=0;
echo '<tr><td><b>Grand Total(PKR):</b></td>
<td></td>
<td style="text-align:right;"><b>'.number_format($due).'</b></td>
<td style="text-align:right;"><b>'.number_format($paid).'</b></td>
<td style="text-align:right;"><b>'.number_format($tbalance).'</td></td>
<td></td>
<td></td>
<td style="text-align:right;"><b>'.number_format($duesurcharge).'</td>
<td style="text-align:right;"><b>'.number_format($paidsurcharge).'</td>
<td></td>
<td></td>
<td></td>
<td></td></tr>';

  $percentage=$tbalance/$due*100;
echo '<tr><td><b>Percentage Outstanding</b></td><td><b>'.number_format($percentage).'%'.'</b></td></tr>';
?></tbody></table></section>

 <form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">

 <input type="hidden" name="paper" value="a4">
  <input type="hidden" name="orientation" value="landscape">
<textarea style="visibility:hidden;" name="html" id="html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDF Report</title>
<style>
td{ padding:0px; text-align:right;  border-top:1px solid #000; border-left:1px solid #000;font-size:12px;}
.table-bordered{ border-right:1px solid #000; border-bottom:1px solid #000;}


</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td colspan="2" align="left" style="border-bottom:thin solid #000"><img  src="<?php echo Yii::getPathOfAlias('webroot')."/images/projects/royal_orchard/royal_orchard.jpg";  ?>" height="92px">
   </td>
  </tr>
  <tr>
    <td align="left" valign="top" width="60%"><h4>Plot Details</h4>
<?php $res=array();
    foreach($info as $row){
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
	echo '<p style="margin:none;"><b>Plot No:</b>' .$row['plot_detail_address'].'</p>';
    echo '<p style="margin:none;"><b>Plot Size  :</b>' .$row['size'].'('.$row['plot_size'].')'.'</p>';
	echo '<p style="margin:none;"><b>Address     :</b>' .$row['sector'].'/'.$row['street'].'</p>';
    echo '<p style="margin:none;"><b>Project     :</b>' .$row['project_name'].'</p>';
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	$price=$row['price'];
	}  ?></td>
    <td align="left" valign="top"><h4>Member Details</h4>
<?php $res=array();
    foreach($members as $mem){             
	echo '<p style="margin:none;"><b>Name:</b>' .$mem['name'].'</p>';
    echo '<p style="margin:none;"><b>CNIC :</b>' .$mem['cnic'].'</p>';
	  echo '<p style="margin:none;"><b>Membership # :</b>' .$mem['plotno'].'</p>';
	} ?> 
	<?php $numbers=0;?></td>
  </tr>
</table>

<?php



// Check connection



$reciveable=0;

$paid=0;
$due=0;



	?>
  
<br />

<h4 style="margin-top:0px; margin-bottom:0px">Installment Summary</h4>

 <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>

        	<th><b>S# </b></th>

			<th><b>Account Head </b></th>

            <th><b>Due Amount</b></th>
			 <th><b>Paid Amount</b></th>
              <th><b>Balance Amount</b></th>
			<th><b>Due Date</b></th>
			<th><b>Paid Date</b></th>
			<th><b>Due Surcharge</b></th>
			<th><b>Paid Surcharge</b></th>
			<th><b>Others</b></th>

			<th><b>Remarks</b></th>
            <th><b>Paid Install</b></th>
            <th><b>Action</b></th>

	</tr>		

        </thead>
		<tbody>
      
 <?php $res=array();

    foreach($members as $mem){
	}   $i=0;
		$tlcost=0;
		$tpcost=0;
		$tpayed=0;
		$bamount=0;
		$surch=0;
		 $duesurcharge=0;
		 $paidsurcharge=0;	
		$paidsurch=0;
foreach($landcost as $land){
	$tlcost=$tlcost+$land['dueamount'];
		$tpcost=$tpcost+$land['paidamount'];
		$surch=$surch+$land['surcharge'];
		$paidsurch=$paidsurch+$land['paidsurcharge'];
		$bamount=$tlcost-$tpcost;
$tbalance=0;
		if($land['paidamount']!=''){
			$tpayed++;
			}
	}?>
	
<tr><td><?php echo $i; ?></td>
 <td align="left">Installment</td>
 <td><?php echo number_format($tlcost)?></td>
 <td><?php echo number_format($tpcost)?></td>
  <td><?php echo number_format($bamount)?></td>
  <td>As Per Plan</td>
  <td></td>
  <td><?php echo number_format($surch)?></td>
 <td><?php echo number_format($paidsurch)?></td>
  <td></td>
   <td></td>
  <td><?php echo number_format($tpayed)?> </td>
   <td></td>
  
</tr></tbody></table>  

<?php 
$tbalance=$tbalance+$bamount;
 $duesurcharge=$duesurcharge+$surch;	
$paidsurcharge=$paidsurcharge+$paidsurch;
?><br />

<h4 style="margin-top:0px; margin-bottom:0px">Other Charges Detail</h4>
			<table class="table table-striped table-new table-bordered">
            <thead style="background:#666; border-color:#ccc; color:#fff; ">
            <tr>
        	<th><b>S# </b></th>
			<th><b>Account Head </b></th>
            <th><b>Due Amount</b></th>
			<th><b>Paid Amount</b></th>
            <th><b>Balance Amount</b></th>
			<th><b>Due Date</b></th>
			<th><b>Paid Date</b></th>
			<th><b>Due Surcharge</b></th>
			<th><b>Paid Surcharge</b></th>
			<th><b>Others</b></th>
			<th><b>Remarks</b></th>
            <th><b>Document Voucher No</b></th>
            <th><b>Action</b></th>
         	</tr>		
        </thead>
		<tbody>
<?php
	$bsurcharge=0;
	$bsur=0;
	$res=array();
    foreach($payments as $row)
	{	
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle);
		$i++;		
		$due=$due+$row['amount'];
		$paid=$paid+$row['paidamount'];
		$duesurcharge=$duesurcharge+$row['surcharge'];
		$paidsurcharge=$paidsurcharge+$row['paidsurcharge'];
		$bsur=$row['amount']-$row['paidamount'];	
  echo '<tr><td>'.$i.'</td>
  <td align="left">' . $row['payment_type'] . '</td>
  <td>' . $row['amount'] . '</td>
  <td>' . $row['paidamount'] . '</td>
  <td>'.$bsur.'</td>
  <td>' . $row['duedate']. '</td>
  <td>' . $row['date'] . '</td>
  <td>'.$row['surcharge'].'</td>
  <td>' . $row['paidsurcharge'].'</td>
  <td>' . $row['others'] . '</td>
  <td>' . $row['remarks'] . '</td>
  <td>' . $row['detail'] . '</td>
  <td><a href="update_charges?pid='.$_REQUEST['pid'].'&&id='.$row['id'].'&&mem_id='.$mem['member_id'].'"></a></td>
</tr>';
$tbalance=$tbalance+$bsur;
	}
?>
</tbody></table><br />

<h4 style="margin-top:10px; margin-bottom:0px">Overall Summary</h4>
          <table class="table table-striped table-new table-bordered">
             <thead style="background:#666; border-color:#ccc; color:#fff; ">
            <tr>
        	<th style="width:20px;"><b></b></th>
            <th><b>Due Amount</b></th>
			<th><b>Paid Amount</b></th>
            <th><b>Balance Amount</b></th>
			<th><b>Due Date</b></th>
			<th><b>Document Voucher No</b></th>
			<th><b>Due Surcharge</b></th>
			<th><b>Paid Surcharge</b></th>
			<th><b>Others</b></th>
			<th><b>Remarks</b></th>
            <th><b>Paid Date</b></th>
            
         	</tr>		
        </thead>
          		<tbody>
                  <tr>
<?php
  $due=$due+$tlcost;
  $paid=$paid+$tpcost;?>
<td style="width:20px;" ><b>Total(PKR):</b></td>
<td><b><?php echo number_format($due); ?></b></td>
<td><b><?php echo number_format($paid)?></b></td>
<td><b><?php echo number_format($tbalance)?></td></td>
<td></td>
<td></td>
<td><b><?php echo number_format($duesurcharge)?></td>
<td><b><?php echo number_format($paidsurcharge)?></td>
<td></td>
<td></td>
<td></td>
</tr>
<?php
 $percentage=$tbalance/$due*100;?>
<tr><td colspan="3"><b>Percentage Outstanding</b></td><td><b><?php echo number_format($percentage).'%'.'</b></td></tr>';
?>
 
</thead></tbody></table>

           Note:This Is Computer Generated Statement and does not required any signature.
  
            </body>
</html>
</textarea>
<input style="float:left;" type="submit" name="submit" value="Generate PDF" /></form>

  

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">