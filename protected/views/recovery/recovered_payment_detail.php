<?php $create=0;?>
<div class="shadow">
   <h3>Recovered Payment Detail</h3>
</div>

<hr noshade="noshade" class="hr-5">
<span style="float:right;">
	<h4>Member Details</h4>
<?php

 $res=array();
 $msid=0;	
    foreach($members as $mem){             
	echo   '<b>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>' .$mem['name'].'</br>';
    echo   '<b>CNIC #&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>' .$mem['cnic'].'</br>';
	  echo '<b>Membership #&nbsp;:</b>' .$mem['plotno'].'</br>';
	  $msid=$mem['id'];	
	}$connection = Yii::app()->db;
		$discount  = "SELECT * FROM discnt where ms_id='".$msid."' ";
		$discountr = $connection->createCommand($discount)->queryRow(); ?> 
	</span><?php $numbers=0;?>
<h4>Plot Details</h4>
<?php $res=array();
    foreach($info as $row){
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
 echo '<b>Project     :</b>&nbsp;&nbsp;&nbsp;' .$row['project_name'].'</br>';
	if($row['type']=='file'){echo '<b>File Size  :</b>';}else {echo '<b>Plot Size:</b>';}
    echo '&nbsp;&nbsp;' .$row['size'].'&nbsp;('.$row['plot_size'].')'.'</br>';

	if($row['type']=='file'){
		echo '<b>File No:</b>';
		} 
		else{
			echo '<b>Plot No: &nbsp;&nbsp;&nbsp;&nbsp;</b>';
			}
	echo $row['plot_detail_address'].'</br>';		
			echo '<b>Location     :</b>&nbsp;' .$row['street'].'/'.$row['sector_name'].'</br>';
    echo'<tr><td><strong> Plot Features:</strong></td><td>';foreach($primeloc as $prime){ 
			  if(empty($prime['title'])){
				   echo'Normal';
				   }else{ echo $prime['title'].',';
			  }} echo'</td></tr>';
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
	if($numbers==0){$numbers=1;}
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
  <table  class="table table-striped table-new table-bordered">
    <thead style="background:#666; border-color:#ccc; color:#fff; ">
      <tr>
        <th><b>Sr.# </b></th>
       <th style="width:65px;"><b>Due Date</b></th>
        <th style="width:65px;"><b>Paid Date</b></th>
        <th><b>Due Amount</b></th>
        <th><b>Paid Amount</b></th>
       <th><b>Payment Mode</b></th>
        <th><b>DD/PO/CH No.</b></th>
        <th><b>Due Surcharge</b></th>
          <th><b>Paid Surcharge</b></th>
        <th style="width:120px;"><b>Remarks</b></th>
        <th style="width:140px;"><b>Status/Action</b></th>
      </tr>
    </thead>
    <tbody>
     <?php
	  $i=1;
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
 	$co1=1;
	 foreach($payments as $pay2){if($pay2['ref']==$pay['id']){$co1++;}}
	if($pay['ref']==0){
		
  echo '<tr><td rowspan="'.$co1.'">'.$pay['lab']. '</td>

     <td rowspan="'.$co1.'">'.$pay['due_date'].'</td>
     <td>'.$pay['paid_date'].'</td>
     <td rowspan="'.$co1.'" style="text-align:right">'.$pay['dueamount'].'</td>
     <td style="text-align:right">'.$pay['paidamount'].'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>'.$pay['detail'].'</td>
     <td align="right">'.$pay['surcharge'].'</td>
	 <td align="right">'.$pay['paidsurcharge'].'</td>
     <td>'.$pay['remarks'].'</td>
     <td>';if(!empty($pay['fstatus'])){if($pay['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{echo '<b style="color:red;">'.$pay['fstatus'].'</b>';} echo '';} else{ echo'<a href="installment_up?id='.$pay['id'].'">Edit</a>
	 /<a href="delete_ins?id='.$_GET['id'].'&&pid='.$_GET['pid'].'&&did='.$pay['id'].'">Delete</a>';echo' / <a href="installment_update?id='.$pay['id'].'">Pay</a> / <a href="splitinstallment?id='.$pay['id'].'">Split</a></td>';}
	 $id='';
	$id=$pay['id'];
	 }
	 foreach($payments as $pay1){
	 if($pay1['ref']==$id){
	echo '<tr>

    
     <td>'.$pay1['paid_date'].'</td>
     <td style="text-align:right">'.$pay1['paidamount'].'</td>
     <td>'.$pay1['payment_type'].'</td>
     <td>'.$pay1['detail'].'</td>
     <td align="right">'.$pay1['surcharge'].'</td>
	 <td align="right">'.$pay1['paidsurcharge'].'</td>
     <td>'.$pay1['remarks'].'</td>
     <td>';if(!empty($pay1['fstatus'])){if($pay1['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{echo '<b style="color:red;">'.$pay1['fstatus'].'</b>';} echo '/ <a href="splitinstallment?id='.$pay1['id'].'">Split</a>';} else{ echo'<a href="installment_up?id='.$pay1['id'].'">Edit</a>
	 /<a href="delete_ins?id='.$_GET['id'].'&&pid='.$_GET['pid'].'&&did='.$pay1['id'].'">Delete</a>';echo' / <a href="installment_update?id='.$pay1['id'].'">Pay</a> </td>';}
	
	}}
	
	 }
	
	echo '<tr><td><b>Total:</b></td>
<td></td>
<td></td>
<td style="text-align:right"><b>'.number_format($due).'</b></td>
<td style="text-align:right"><b>'.number_format($paid).'</b></td>
<td align="right"></td>
<td></td>
<td align="right"><b>'.number_format($duesurcharge).'</b></td>
<td align="right"><b>'.number_format($paidsurcharge).'</b></td>
<td></td>
</tr>';
echo '<tr><td><b>Discount:</b></td>
<td></td>
<td></td>
<td align="right"></td><td style="text-align:right"><b>'.$discountr['discount'].'</b></td>
<td></td>
<td align="right"></td>
<td></td><td align="right"></td><td style="text-align:right"><b>'.$discountr['details'].'</b></td>
</tr>


';
if($due==0){$due=1;}
/*echo '<tr><td><b>Outstanding Installment</b></td><td></td><td></td><td style="text-align:right;"><b>'.number_format($oins-$discountr['discount']).'</b></td><td style="text-align:right;"><b>'.number_format(($oins-$discountr['discount'])/$due*100).'%'.'</b></td></tr>

';*/

	?>
    </tbody>
  </table>
</section>
</div>

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