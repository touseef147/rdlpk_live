  
  <?php 

  $connection = Yii::app()->db; 
   $conn = mysql_connect('localhost','rdlpk_admin','creative123admin') or die(mysql_error());
$select_db = mysql_select_db('rdlpk_db1',$conn) or die(mysql_error());
				$sql = "select * from forms";
				$result = mysql_query($sql) or die(mysql_error());
 //echo 123;exit;
// $co=count($result_form);
 //$i=0; 
 echo 'membership</br>';
while($row = mysql_fetch_array($result)){
$result_form1='';
$form1='';
$co=0; 
 $form1= "Select *, installform.id as fid from installform 
  left join forms on (forms.id=installform.form_id)
  where installform.type='membership' and installform.form_id='".$row['id']."'";
 $result_form1 = $connection->createCommand($form1)->queryAll(); 
$co=count($result_form1);
if($co>1){
	foreach($result_form1 as $row3)
	
	echo $row3['fid'].'-'.$row3['form_id'].'--'.$row3['formno'].'--'.$row3['name'].'</br>';
	}
}

?>