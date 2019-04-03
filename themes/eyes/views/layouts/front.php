<!DOCTYPE html>

<html>
    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/mystyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Developers & Builders</title>
    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/rd-icon.png" type="image/x-icon"/>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700,600' rel='stylesheet' type='text/css'>
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/my-style.css" rel="stylesheet" media="screen">
    <link type='text/css' rel='stylesheet' href='<?php echo Yii::app()->theme->baseUrl; ?>/css/css/liquidcarousel.css' />
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/main.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/js/jsCarousel-2.0.0.js" type="text/javascript"></script>
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/jsCarousel-2.0.0.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/js/assets/js/superfish.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/js//assets/js/easyaspie.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {

       //// $('nav').easyPie();
    });    
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#carouselh').jsCarousel();

        });       
    </script>
    </head>

    <body>

<?php 
$error='';

if(isset($_POST['submit'])){
    $name=$_POST['name'];
	$email=$_POST['email'];
	$message=$_POST['message'];
	if(empty($name))
	{
		$error='Please Enter Required Fields';
	}
	if(empty($email))
	{
		$error='Please Enter Required Fields';
	}
	if(empty($message))
	{
		$error='Please Enter Required Fields';
	}
	if(empty($error)){
	
	$connection = Yii::app()->db;
$sql  = 'INSERT INTO unregister_user_query (name,email,message,status,create_date) VALUES ( "'.$_POST['name'].'","'.$_POST['email'].'", "'.$_POST['message'].'",0,"'.date('Y-m-d h:i:s').'")';		
$command = $connection -> createCommand($sql);
 $command -> execute();
echo"<script type=text/javascript>alert('Message Delivered Successfully');</script>";
	}
	else{
		echo "<script type=text/javascript>alert('$error');</script>";
		}
	}?>

<!-- <----------top-bar starts here----------->

<div class="row-fluid" id="topbar">
<div class="container-fluid ">
<!-- Mobile Banner -->

<div class="col-lg-4 pull-left contact1">
<ul class="contact1 list-inline">
<?php

     $connection = Yii::app()->db;

	 $qry="select * From setting";

	 $result = $connection->createCommand($qry)->query();
	 foreach($result as $key)
	 {
		 echo'
        <li>
        '.$key['phone'].' 
        </li>
        <li>
        '.$key['email'].'
        </li>
     </ul>	 ';
	 }
	 ?>
</div>
<div class="col-lg-3 pull-right top2">
      <ul class="list-inline topleft" >
    <li> <a  href="<?php echo $this->createAbsoluteUrl('member/dashboard')?>">
          <?php $uname=Yii::app()->session['member_array']['username'];
	if($uname=="")
	{
		echo'<img src="'.Yii::app()->request->baseUrl.'/images/Icon-user1.png"/> Member Login </a></li>';
	}

	else{
		echo' <li> Dashboard</a></li>'.'<li><img src="'.Yii::app()->request->baseUrl.'/images/logout-icon-normal.png"/><a href="'.$this->createAbsoluteUrl('member/logout').'">Logout</a></li>';
	}
	?>
      </ul>
    </div>
</div>
</div>

<!-- <----------top-bar ends here-----------> 

<!-- <----------header starts here----------->

<div class="row-fluid" id="headbg">
<div class="container-fluid">
<div class="col-lg-3 pull-left" id="logo">
      <div class="span12"> <a href="<?php echo $this->CreateAbsoluteUrl("web/");?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"> </a> </div>
    </div>
<div class="col-lg-3 pull-right" id="social"  >
      <div class="row-fluid">
    <div class="col-lg-11 text-center" >
          <div class="span12" id="follow1"> <span>Follow us </span> </div>
        </div>
  </div>
      <div class="row-fluid" >
    <div class="col-lg-11" >
          <?php
     $connection = Yii::app()->db;
	 $q="select * From setting";
	 $res = $connection->createCommand($q)->query();

	 foreach($res as $key1)
	 {
		 echo'
    <ul class="list-inline" id="flinks" style="margin:0px; padding:0px;">
     <li><a href="'.$key1['facebook'].'"><img src="'.Yii::app()->request->baseUrl.'/images/facebook.png"></a></li>
     <li><a href="'.$key1['twitter'].'"> <img src="'.Yii::app()->request->baseUrl.'/images/twitter.png"> </a> </li>
     <li><a href="'.$key1['flicker'].'"><img src="'. Yii::app()->request->baseUrl.'/images/flicker.png"> </a> </li>
     <li><a href="'.$key1['googleplus'].'"><img src="'.Yii::app()->request->baseUrl.' /images/google.png"> </a> </li>
     </ul> ';
	 }
	?>
        </div>
  </div>
    </div>
<div class="clearfix"> </div>
<div class="row-fluid">
<div class="span12">
<nav class="applePie">
<!----<div class="menubtn">Menu Button</div>---->
<ul id="nav">
<li class="active"><a href="<?php echo $this->CreateAbsoluteUrl("index");?>">Home</a></li>
<?php 

				//$conn = mysql_connect('localhost','root','') or die(mysql_error());
	          /* $conn = mysql_connect('localhost','rdlpk_admin','creative123admin') or die(mysql_error());*/

                $conn = mysqli_connect('localhost', 'rdlpk_admin','creative123admin');
				$select_db = mysqli_select_db($conn,'rdlpk_db1') or die(mysql_error());

				$sql = "select * from menu where sub_level=0 and status=1";
				$result = mysqli_query($conn,$sql) or die(mysql_error());
				while($menu_item = mysqli_fetch_array($result)){
				echo '<li><a href="'.$this->CreateAbsoluteUrl("web/pages?id=".$menu_item['page_id']."").'">'.$menu_item['menu_title'].'</a>

			<ul>';        
			 $sql = 'select * from menu where status=1 and sub_level>0 and sub_level='.$menu_item['id'];
			  $sub_menu_query = mysql_query($sql) or die(mysql_error());
			 while($sub_menu_item = mysql_fetch_array($sub_menu_query)){
			 echo '

	        <li><a href="'.$this->CreateAbsoluteUrl("web/pages?id=".$sub_menu_item['page_id']."").'">'.$sub_menu_item['menu_title'].'</a></li> ';
			 }
				echo '</ul> </li>';

				}

			   ?>
<li> <a href="">Current Project</a>
      <ul>
    <?php















     $connection = Yii::app()->db;







	 







	 







	 $new = "select * From projects where status='1'";







	 $projectn = $connection->createCommand($new)->query();







			







	 foreach($projectn as $ke1)







	 {  







		echo'<li><a href="'.$this->CreateAbsoluteUrl("web/project_details?id=".$ke1['id']."").'">'.$ke1['project_name'].'</a></li>      ';







	}







	?>
  </ul>
    </li>
<li> <a href="">Upcoming Project</a>
      <ul>
    <?php















     $connection = Yii::app()->db;







	 $q="select * From uprojects where status='1'";







	 $res11 = $connection->createCommand($q)->queryAll();







	 foreach($res11 as $ke)







	 {  







		echo'<li><a href="'.$this->CreateAbsoluteUrl("web/uproject_details?id=".$ke['id']."").'">'.$ke['project_name'].'</a></li>      ';







	}







	?>
  </ul>
    </li>
<li class=""><a href="#" class="sf-with-ul">Media Center</a>
      <ul>
    <li><a href="<?php echo $this->CreateAbsoluteUrl("web/pages?id=39");?>">Brochures</a></li>
    <li><a href="<?php echo $this->CreateAbsoluteUrl("web/gallery_list");?>">Picture Gallery</a></li>
    <li><a href="<?php echo $this->CreateAbsoluteUrl("web/v_tour");?>">Virtual Tour</a></li>
    <li><a href="<?php echo $this->CreateAbsoluteUrl("web/newsevent");?>">News &amp; Events</a></li>
  </ul>
    </li>
<li style="background:#F05; font-weight:bold; float:right "><a style="color:#FFFFFF;" href="<?php echo $this->CreateAbsoluteUrl("user/pdf_forms")?>">Download Forms</a></li>
<li style="font-weight:bold; float:right "><img style="width: 26px;







height: 26px;







margin-left: 10px;







padding-left: 0px;







margin-right: 10px;" src="/images/down_icon.gif"/></li>
</form>
</nav>
</div>
</div>
</div>
</div>

<!-- <----------header  ends  here----------->

<div class="clearfix"> </div>
<?php $this->widget('zii.widgets.CBreadcrumbs', array(















		'links'=>$this->breadcrumbs,















	)); ?>

<!-- breadcrumbs --> 

<?php echo $content; ?>
<div class="clearfix"> </div>

<!-- <----------footer starts here----------->

<div id="footer-sec">
      <div class="container-fluid">
      
    <div class="col-lg-3">
          <h3>Sales Centers </h3>
          <ul class="f-list">
        <?php















     $connection = Yii::app()->db;















	 $r="select * From sales_center";















	 $ress = $connection->createCommand($r)->query();















			















	 foreach($ress as $key3)


	 { echo'

<li> <a href="'.$this->CreateAbsoluteUrl("web/center_details").'">'.$key3['name'].'</a></li>';

	 }?>
      </ul>
        </div>
    <div class="col-lg-3">
          <h3>Browse Projects</h3>
          <ul class="f-list">
        <?php
     $connection = Yii::app()->db;
	 $p="select * From projects where status='1'";
	 $resp = $connection->createCommand($p)->query();

	 foreach($resp as $key2)
	 { echo'


<li> <a href="'.$this->CreateAbsoluteUrl("web/project_details?id=".$key2['id']."").'">'.$key2['project_name'].'</a></li>';


	 }?>
      </ul>
        </div>
    <div class="col-lg-3">
          <h3>Contact Us</h3>
          <ul class="f-list">
        <li><?php echo $key1['address'];?></li>
        <li>Phone #:<?php echo $key1['phone'];?></li>
        <li>Email:<?php echo $key1['email'];?></li>
      </ul>
        </div>
    <div class="col-lg-3">
          <h3>Query </h3>
          <form name="myForm"  action="<?php $_PHP_SELF ?>" method="post" >
        <b>Name</b> (required)<br>
        <input type="text" name="name" style="color:#2A3F55;">
        <br>
        <b>Email</b> (required) <br>
        <input type="text" name="email" style="color:#2A3F55;">
        <br>
        <b>Message</b> (required) <br>
        <textarea name="message" style="color:#2A3F55;"> </textarea>
        <br>
        <input type="submit" class="btn btn-primary btn-md pull-left" name="submit" value="Submit">
      </form>
        </div>
    <div class="clearfix"> </div>
    <div class="copyright">
          <div class=" pull-left">© Copyright 2014 - RDLPK.com &nbsp;&nbsp; |&nbsp;&nbsp;  Designed by <a href="http://www.hrlpk.com/" style="background:none !important; padding-left: 0;">HRL eSolutions</a></div>
          <div class="pull-right"><a href="http://www.creativegarage.org" > Powered by Creative Garage</a></div>
          <div class="clearfix"> </div>
        </div>
  </div>



    </div>

<!-- <----------footer ends here----------->

</body>
</html>