<style>
.td{text-align:right;}
</style>
<div class="shadow">

  <h3>Payment Details<div style="float:right;">
      <a href="installment_details?id=<?php echo $_REQUEST['id']?> && pid=<?php echo $_REQUEST['id']?>">
      <h5>Installment Details</h5> </a></div>
</h3>
</div>
<hr noshade="noshade" class="hr-5">
<span style="float:right;">
	<h4>Member Details</h4>
<?php $res=array();
$msid=0; 
    foreach($members as $mem){             
	echo '<b>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b>' .$mem['name'].'<br/>';
    echo '<b>CNIC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b>' .$mem['cnic'].'<br/>';
	echo '<b>Membership # :&nbsp;</b>' .$mem['plotno'].'<br/>';
	  $msid=$mem['id'];
	} ?> 
	</span><?php $numbers=0;?>
<h4>Plot Details</h4>
<?php $res=array();
$pro='';
    foreach($info as $row){
		 echo '<b>Project    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;</b>' .$row['project_name'].'</br>';
		 echo '<b>Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b>' .$row['com_res'].'&nbsp;'; 
	if($row['com_res']=='Residential'){
		if($row['isvilla']==1){
		 echo'Villa';}else{ echo'Plot';
		 }}

$pro=$row['project_id'];
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle);echo'</br>'; 
if($row['type']=='file'){echo '<b>File Size &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  :&nbsp;</b>';}else {echo '<b>Plot Size &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b>';}
  echo $row['size'].'&nbsp;('.$row['plot_size'].')'.'</br>';

	
			
			
			if($row['type']=='file'){
		echo '<b>File No.</b>';
		} 
		else{
			echo '<strong>Plot No.</strong>';
			}
			
			
		if($row['stst']==2){ echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red">Blocked</span>';}else{echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;'.$row['plot_detail_address'].'/'.$row['street'].'/'.$row['sector_name'].'</br>';}
    echo'<br><tr><td><strong> Plot Features:</strong></td><td>';foreach($primeloc as $prime){ 
			  if(empty($prime['title'])){
				   echo'Normal';
				   }else{ echo $prime['title'].',';
			  }} echo'</td></tr>';
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	$price=$row['price'];
	} ?>
    <hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30" style="font-size:11px;">
<?php



// Check connection



$reciveable=0;

$paid=0;
$due=0;



?><table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>
        	<th><b>Sr.# </b></th>
			<th><b>Account Head </b></th>
            <th><b>Due Amount</b></th>
			<th><b>Paid Amount</b></th>
            <th><b>Discount</b></th>
            <th><b>Balance Amount</b></th>
			<th><b>Due Date</b></th>
			<th><b>Paid Date</b></th>
			<th><b>Due Surcharge</b></th>
			<th><b>Paid Surcharge</b></th>
            <th><b>Paid Install</b></th>
            <th><b>Action</b></th>

	</tr>		
        </thead>
		<tbody>
         <h4>Installment Summary:</h4>
 <?php $res=array();
 $dis=0;
    foreach($members as $mem){
	}?>
		<?php
$tbalance=0;
        $i=1;
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
$connection = Yii::app()->db;
		$discount  = "SELECT * FROM discnt where ms_id='".$msid."' ";
		$discountr = $connection->createCommand($discount)->queryRow();
		$dis= $discountr['discount'];
		if($land['paidamount']!=''){
			$tpayed++;
			}
	
	}
	if($dis==''){$dis=0;}
echo '<tr><td>' . $i . '</td>
 <td align="left">Installment</td>
 <td style="text-align:right;">' .number_format($tlcost+$dis). '</td>
 <td style="text-align:right;">' .number_format($tpcost). '</td>
 <td style="text-align:right;">'.number_format($dis).'</td>
  <td style="text-align:right;">'.number_format($bamount).'</td>
  <td>As Per Plan</td>
  <td style="text-align:right;"></td>
  <td style="text-align:right;">' .number_format($surch). '</td>
  <td style="text-align:right;">' .number_format($paidsurch). '</td>
 
  <td>'.number_format($tpayed).'</td>
   <td><a href="installment_details?id='.$_REQUEST['id'].'&& pid='.$_REQUEST['id'].'">Detail</a>/<a href="discount?id='.$msid.'">Discount</a></td>
</tr></tbody></table>  ';
$tbalance=$tbalance+$bamount;
 $duesurcharge=$duesurcharge+$surch;	
$paidsurcharge=$paidsurcharge+$paidsurch;
?>

 <h4 style="float:left;">Others Charges Details:</h4>
<div style="float:right;"><a href="plotcharges?id=<?php echo $_REQUEST['id']?> && pid=<?php echo $pro;?>"><h5>Add Charges/Fee</h5></a><a href="plotsurcharge?id=<?php echo $_REQUEST['id']?> && pid=<?php echo $pro;?>"><h5>Add Surcharge</h5> </a></div>


<table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>

        	<th><b>Sr.# </b></th>

			<th><b>Account Head </b></th>

            <th><b>Due Amount</b></th>
			 <th><b>Paid Amount</b></th>
<th><b>Discount</b></th>
              <th><b>Balance Amount</b></th>
			<th><b>Due Date</b></th>
              <th><b>Paid Date</b></th>
			
			<th><b>Due Surcharge</b></th>
			<th><b>Paid Surcharge</b></th>

            <th><b>Ref No.</b></th>

            <th><b>Action</b></th>

	</tr>		

        </thead>

		<tbody>
<?php
	$bsurcharge=0;
    	
	//$paidsurcharge=0;
	$bsur=0;
	$res=array();
$ndis=0;
$ii=0;
    foreach($payments as $row)
 
	{	
$ii=$ii+1;	
	
	
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle);
		$i++;

		$due=$due+$row['amount'];
		$paid=$paid+$row['paidamount'];
		$duesurcharge=$duesurcharge+$row['surcharge'];
		$paidsurcharge=$paidsurcharge+$row['paidsurcharge'];
		$bsur=$row['amount']-$row['paidamount'];
		$ndis=$ndis+$row['discount'];
		if($row['discount']==''){$row['discount']=0;}
  echo '<tr><td>';
  echo $ii;
  echo '</td>
 <td>' .$row['payment_type']. '</td>
 <td style="text-align:right;">' .$row['amount']. '</td>
 <td style="text-align:right;">' .$row['paidamount']. '</td>
 
  <td style="text-align:right;">'.number_format($row['discount']).' </td>
 <td style="text-align:right;">'.number_format($bsur-$row['discount']).'</td>
  <td>' . $row['duedate']. '</td>
  <td>' . $row['date'] . '</td>
  <td style="text-align:right;">' . $row['surcharge'] . '</td>
    <td style="text-align:right;">' . $row['paidsurcharge'] . '</td>
   <td>';
if($row['r_id']>0){
    $connection = Yii::app()->db;
	  $re1 = "SELECT * FROM rpt_print where rid='".$row['r_id']."' and msid='".$row['plot_id']."'";
		$rec1=$connection->createCommand($re1)->queryRow();	
		echo $rec1['slipno'].'/<b style="color:blue;">'.$rec1['r_no'];
		if($rec1['jvno'] > 1 ){echo 'JV-'.$rec1['jvno'];}
		echo '</b>';
		}elseif($row['re_id']>0){
  		$re = "SELECT * FROM rpt_print where id='".$row['re_id']."'";
		$rec=$connection->createCommand($re)->queryRow();
		echo $rec['slipno'].'/<b style="color:blue;">'.$rec['r_no'];
		if($rec['jvno'] > 1 ){echo 'JV-'.$rec['jvno'];}
		echo '</b>';
		}else{echo $row['detail'];}
echo '</td>
<td>';if(!empty($row['fstatus'])){if($row['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{echo '<b style="color:Green;">'.$row['fstatus'].'</b>';}}else{ 
if($row['r_id']==0 and $row['re_id']==0){
echo'<a href="up_charges?pid='.$_REQUEST['id'].'&&id='.$row['id'].'&&mem_id='.$mem['member_id'].'">Edit</a>/ <a href="update_charges?pid='.$_REQUEST['id'].'&&id='.$row['id'].'&&mem_id='.$mem['member_id'].'">Pay</a>';
}
echo '</td></tr>	';} 
  
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
  $fd=$dis+$ndis;
echo '<tr><td><b>Grand Total(PKR):</b></td>
<td></td>
<td style="text-align:right;"><b>'.number_format($due+$dis).'</b></td>
<td style="text-align:right;"><b>'.number_format($paid).'</b></td>
  <td style="text-align:right;">' . number_format($fd) . '</td>
<td style="text-align:right;"><b>'.number_format($tbalance-$ndis).'</td></td>
<td></td>
<td></td>
<td style="text-align:right;"><b>'.number_format($duesurcharge).'</td>
<td style="text-align:right;"><b>'.number_format($paidsurcharge).'</td>

<td></td>

<td></td></tr>';
if($due==0){$due=1;}
//echo $tbalance;
  $percentage=($tbalance)/$due*100;
echo '<tr><td><b>Percentage Outstanding</b></td><td></td><td></td><td></td><td></td><td style="text-align:right;"><b>'.number_format($percentage).'%'.'</b></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
?></tbody></table>

</section>

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
   <td colspan="2" align="left" style="border-bottom:thin solid #000"><img  src="<?php echo Yii::getPathOfAlias('webroot')."/images/royal_orchard.jpg";  ?>" height="92px">
   </td>
<td><?php if($mem['image']==''){ echo'';} else{echo'<img src="'.Yii::getPathOfAlias('webroot').'/upload_pic/'.$mem['image'].'" width=100 height=100/>';}?></td>

  </tr>
   <table align="left" border="0">
  <tr >
  
    <td  style="text-align:left" ><b>Plot Details</b>
    
<?php $res=array();
    
	foreach($info as $row){
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
	echo '<p style="margin:none;"><b>Project</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;' .$row['project_name'].'</p>';
		 echo '<p style="margin:none;"><b>Type</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;' .$row['com_res'].'&nbsp;'; 
	if($row['com_res']=='Residential'){
		if($row['isvilla']==1){
		 echo'Villa';}else{ echo'Plot';
		 }}
	echo '</p><p style="margin:none;">';
	if($row['type']=='file'){
		echo '<b>File Size&nbsp;&nbsp;&nbsp;:&nbsp;</b>';
		} 
		else{
			echo '<b>Plot Size&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b>';
			}echo $row['size'].'('.$row['plot_size'].')'.'</p>';	
				echo'<br/>';	
			if($row['type']=='file'){
		echo 'File No.&nbsp;';
		} 
		else{
			echo 'Plot No. &nbsp;';
			}
			if($row['stst']==2){echo'<span style="color:red">Blocked</span>';}else{echo '&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;'.$row['plot_detail_address'].'/'.$row['street'].'/'.$row['sector_name'].'</br>';}

     echo'<p style="margin:none;"><strong> Plot Features:</strong>';foreach($primeloc as $prime){ 
			  if(empty($prime['title'])){
				   echo'Normal';
				   }else{ echo $prime['title'].',';
			  }} 
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	$price=$row['price'];
	}  ?><br/><br/></td>
    <table align="right" border="0">
	
	
	<?php $res=array();
$msid=0; 
    foreach($members as $mem){
		echo' <tr ><td style="text-align:left"><b>Member Details</b></td></tr>';            
	echo '<tr><td style="text-align:left"><b>Name:&nbsp;</b>' .$mem['name'].'<br/></td></tr>';
    echo '<tr><td style="text-align:left"><b>CNIC :&nbsp;</b>' .$mem['cnic'].'<br/></td></tr>';
	  echo '<tr><td><b>Membership # :&nbsp;</b>' .$mem['plotno'].'<br/></td></tr>';
	  $msid=$mem['id'];
	} ?></table>
<?php $res=array();
    
	
	  	
		  
		 echo'</tr></tbody></table>';

?> 
	<?php $numbers=0;?>
  </tr>
</table>

<?php



// Check connection



$reciveable=0;

$paid=0;
$due=0;



	?>
  
<br /><br /><br /><br />
<br /><br />

<h4 style="margin-top:0px; margin-bottom:0px">Installment Summary</h4>

 <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>

        	<th width="40px" ><b>Sr.# </b></th>

			<th width="115px"><b>Account Head </b></th>

            <th width="100px"><b>Due Amount</b></th>
			<th width="100px"><b>Paid Amount</b></th>
            <th width="70px"><b>Discount</b></th>
            <th width="115px"><b>Balance Amount</b></th>
			<th width="80px"><b>Due Date</b></th>
			<th width="80px"><b>Paid Date</b></th>
			<th width="120px"><b>Due Surcharge</b></th>
			<th width="120px"><b>Paid Surcharge</b></th>
			
			
            <th width="80px" ><b>Paid Install</b></th>
            

	</tr>		

        </thead>
		<tbody>
      
 <?php $res=array();

    foreach($members as $mem){
	}   $i=1;
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
 <td><?php echo number_format($tlcost+$dis)?></td>
 <td><?php echo number_format($tpcost)?></td>
  <td><?php echo $dis?></td>
  <td><?php echo number_format($bamount)?></td>
  <td>As Per Plan</td>
  <td></td>
  <td><?php echo number_format($surch)?></td>
 <td><?php echo number_format($paidsurch)?></td>
  
  <td><?php echo number_format($tpayed)?> </td>
   
  
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
        	<th width="40px"><b>Sr.# </b></th>
			<th width="115px"><b>Account Head </b></th>
            <th width="100px"><b>Due Amount</b></th>
			<th width="100px"><b>Paid Amount</b></th>
           <th width="70px"><b>Discount</b></th>
            <th width="115px"><b>Balance Amount</b></th>
			<th width="80px"><b>Due Date</b></th>
			<th width="80px"><b>Paid Date</b></th>
			<th width="120px"><b>Due Surcharge</b></th>
			<th width="120px"><b>Paid Surcharge</b></th>
			
            <th width="80px"><b>Ref No.</b></th>
            
         	</tr>		
        </thead>
		<tbody>
<?php
	$bsurcharge=0;
	$bsur=0;
	$res=array();
$ii=0;
    foreach($payments as $row)
	{
$ii=$ii+1;	
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle);
		$i++;		
		$due=$due+$row['amount'];
		$paid=$paid+$row['paidamount'];
		$duesurcharge=$duesurcharge+$row['surcharge'];
		$paidsurcharge=$paidsurcharge+$row['paidsurcharge'];
		$bsur=$row['amount']-$row['paidamount'];
			$pam=0;
			if($row['discount']==''){$row['discount']=0;}
  if($row['paidamount']==''){$pam=0;}else{$pam=$row['paidamount'];}
  echo '<tr><td>';
echo $ii;
  
  echo '</td>
  <td align="left">' . $row['payment_type'] . '</td>
  <td>' .  number_format($row['amount']) . '</td>
  <td>' .  floatval($pam) . '</td>
 <td>'.number_format($row['discount']).'</td>
  <td>'.($bsur-$row['discount']).'</td>
  <td>' . $row['duedate']. '</td>
  <td>' . $row['date'] . '</td>
  <td>'. $row['surcharge'].'</td>
  <td>' .$row['paidsurcharge'].'</td>
 
  <td>';
if($row['r_id']>0){
	  $re1 = "SELECT * FROM rpt_print where rid='".$row['r_id']."' and msid='".$row['plot_id']."'";
		$rec1=$connection->createCommand($re1)->queryRow();	
		echo $rec1['slipno'].'/<b style="color:blue;">'.$rec1['r_no'];
		if($rec1['jvno'] > 1 ){echo 'JV-'.$rec1['jvno'];}
		echo '</b>';
		}elseif($row['re_id']>0){
  		$re = "SELECT * FROM rpt_print where id='".$row['re_id']."'";
		$rec=$connection->createCommand($re)->queryRow();
		echo $rec['slipno'].'/<b style="color:blue;">'.$rec['r_no'];
		if($rec['jvno'] > 1 ){echo 'JV-'.$rec['jvno'];}
		echo '</b>';
		}else{echo $row['detail'];}
echo '</td>
  
</tr>';

//$tbalance=$tbalance+$bsur;
	}
?>
</tbody></table><br />

<h4 style="margin-top:10px; margin-bottom:0px">Overall Summary</h4>
          <table class="table table-striped table-new table-bordered">
             <thead style="background:#666; border-color:#ccc; color:#fff; ">
            <tr>
        	<th width="40px"><b>Sr.# </b></th>
			<th width="115px"><b></b></th>
            <th width="100px"><b>Due Amount</b></th>
			<th width="100px"><b>Paid Amount</b></th>
            <th width="70px">Discount</th>
            <th width="115px"><b>Balance Amount</b></th>
			<th width="80px"><b></b></th>
			<th width="80px"><b></b></th>
			<th width="120px"><b>Due Surcharge</b></th>
			<th width="120px"><b>Paid Surcharge</b></th>
			
            <th width="80px"><b></b></th>
            
            
         	</tr>		
        </thead>
          		<tbody>
                  <tr>
<?php
  $due=$due+$tlcost;
  $paid=$paid+$tpcost;?>
  <td></td>
<td >Total</td>
<td><b><?php echo number_format($due+$dis); ?></b></td>
<td><b><?php echo number_format($paid)?></b></td>
<td><?php echo number_format($fd); ?></td>
<td><b><?php echo number_format($tbalance);?></td></td>

<td></td>
<td><b><?php echo number_format($duesurcharge)?></td>
<td><b><?php echo number_format($paidsurcharge)?></td>
<td></td><td></td>

</tr>
<?php
if($due==0){$due=1;}
 $percentage=($tbalance)/$due*100;?>
<tr><td colspan="3"><b>Percentage Outstanding</b></td><td></td><td></td><td><b><?php echo number_format($percentage).'%'.'</b></td><td></td><td></td><td></td><td></td><td></td></tr>';
?>
 
</thead></tbody></table>

           Note:This is computer generated statement and does not require any signature.
  
            </body>
</html>
</textarea>
<input style="float:left;" type="submit" name="submit" value="Generate PDF" /></form>

  

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">