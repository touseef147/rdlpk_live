<?php



	$con=mysqli_connect("localhost","rdlpk_admin","creative123admin","rdlpk_db1");
$sql="SELECT * from streets where sector_id='".$_REQUEST['val1']."'";
$result = mysqli_query($con,$sql);

		
		$street=array();
		while($row =  mysqli_fetch_array($result)){
			$street[]=$row;
			} 
	echo json_encode($street); exit();
	
?>
