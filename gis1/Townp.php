<?php include 'sprt.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" media="print" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/my-style.css" />
<link rel="stylesheet" type="text/css" href="css/custom.css" />
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="js/jquery.fileupload.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="jquery.imagemapster.js"></script>
 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body style="background-color:#FFf;" >


<?php
include "../new.php";
$connection = Yii::app()->db;
if(Yii::app()->session['user_array']['id']==''){echo  'not authroize ';exit;}
//echo $_GET['project_id'];exit;
//if(!isset($_POST['street'])){$_POST['street']=1;}
if(!isset($_GET['project_id'])){ $_GET['project_id']=1;}


$sql  = "SELECT * FROM dmap where project_id='".$_GET['project_id']."'";
$result = $connection->createCommand($sql)->queryAll();

$sql12  = "SELECT * FROM projects where id='".$_REQUEST['id']."'";
$res = $connection->createCommand($sql12)->queryRow();
 ?>





<div class="span12" style=" background-color: #0C9A01;
    width: 100%;
    margin-left: 0 !important;
    color: #fff;
    margin-bottom: 10px; ">
<h3>Geographical Interaction </h3>
</div>
<div class="span12">
<div class="span3" id="new" style="background-color: #fff;
    padding: 14px;
    border-radius: 10px; width:270px; border: 1px solid #DADADA;
    box-shadow: 0px 8px 30px -8px; right:30px;">

<div style="margin-bottom:65px;">
<div>

<form method="post" action="gmap.php">
<input type="hidden" value="<?php echo $_GET['project_id']; ?>" id="project_id" name="project_id" />

<h3>Royal orchard 11</h3>


 

<h5>Members Layer</h5>  
<script type="text/javascript">
$(function(){
$(".search1").keyup(function() 
{ 
var searchid1 = $(this).val();
var dataString1 = 'search1='+ searchid1;
if(searchid1!='')
{
	$.ajax({
	type: "POST",
	url: "testdb.php",
	data: dataString1,
	cache: false,
	success: function(html)
	{
	$("#result1").html(html).show();
	}
	});
}
return false;    
});

jQuery("#result1").on("click",function(e){ 
		var $clicked1 = $(e.target);
	var $name1 = $clicked1.find('.name').html();
	var decoded1 = $("<div/>").html($name1).text();
	$('#searchid1').val(decoded1);
	cnic1();
});
jQuery(document).on("click", function(e) { 
	var $clicked1 = $(e.target);
	if (! $clicked1.hasClass("search1")){
	jQuery("#result1").fadeOut(); 
	}
});
$('#searchid1').click(function(){
	jQuery("#result1").fadeIn();
});

});
$(function(){
$(".search").keyup(function() 
{ 
var searchid = $(this).val();
var dataString = 'search='+ searchid;
if(searchid!='')
{
	$.ajax({
	type: "POST",
	url: "testdb.php",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#result").html(html).show();
	}
	});
}
return false;    
});

jQuery("#result").on("click",function(e){ 
		var $clicked = $(e.target);
	var $name = $clicked.find('.name').html();
	var decoded = $("<div/>").html($name).text();
	$('#searchid').val(decoded);
	cnic();
});
jQuery(document).on("click", function(e) { 
	var $clicked = $(e.target);
	if (! $clicked.hasClass("search")){
	jQuery("#result").fadeOut(); 
	}
});
$('#searchid').click(function(){
	jQuery("#result").fadeIn();
});


});
</script>
<style type="text/css">
	body{ 
		font-family:Tahoma, Geneva, sans-serif;
		font-size:18px;
	}
	.content{
		width:900px;
		margin:0 auto;
	}
	#searchid
	{
		width:500px;
		border:solid 1px #000;
		padding:10px;
		font-size:14px;
	}
	#result
	{
		position:absolute;
		width:500px;
		padding:10px;
		display:none;
		margin-top:-1px;
		border-top:0px;
		overflow:hidden;
		border:1px #CCC solid;
		background-color: white;
	}
	#result1
	{
		position:absolute;
		width:500px;
		padding:10px;
		display:none;
		margin-top:-1px;
		border-top:0px;
		overflow:hidden;
		border:1px #CCC solid;
		background-color: white;
	}
	.show
	{
		padding:10px; 
		border-bottom:1px #999 dashed;
		font-size:15px; 
		height:95px;
	}
	.show:hover
	{
		background:#4c66a4;
		color:#FFF;
		cursor:pointer;
	}
</style>

<input type="text" class="search" id="searchid" placeholder="Name"  style="width:200px;" />
<div id="result">
</div>
<input type="text" class="search1" id="searchid1" placeholder="MS No." style="width:200px;"/> 
<div id="result1">
</div>
<h5>Advance Search</h5>  
<select name="sector" id="sector" style="width:200px;">
 <option value="">Select Sector</option>
 <?php 
 $sql_sec  = "SELECT * FROM sectors ";
$result_sec = $connection->createCommand($sql_sec)->queryAll();
foreach($result_sec as $ro)
{ echo '<option value="'.$ro['id'].'">'.$ro['sector_name'].'</option>';}
 ?>
 </select>
<select name="street" id="street" style="width:200px;">
<option value="">Select Street</option>
</select>

</form>
 <?php   	

 $sql_size  = "SELECT * FROM size_cat ";
$result_size = $connection->createCommand($sql_size)->queryAll();

foreach($result_size as $result_size11)
{

echo '<a class="btn" onClick="hello'.$result_size11['id'].'();">'.$result_size11['size'].'</a>';
}?>
<div style="float:left">
<a class="btn btn-primary dropdown-toggle"onClick="Res();">Res</a>
<a class="btn btn-primary dropdown-toggle"onClick="Com();">Com</a>
<a class="btn" onClick="hello2();">Map</a>
<a class="btn btn-success" onClick="hello();" >Available</a>
<a class="btn btn-warning dropdown-toggle" onClick="hello1();">Sold</a>


</div>

<?php 
	 $sqlplot  = "SELECT * FROM dmap where project_id='".$_GET['project_id']."' ";
$resplot = $connection->createCommand($sqlplot)->queryAll();
	
	?>
  



</div>
<div id="selections" style="clear:both; display:none;" > </div>
</div>
</div>
<div class="span12">
<div style="margin::0px 0px 10px 0px; position:absolute; z-index:1000;">
 <button class="btn" style="font-weight:800; background-color:#0C9;" OnClick="return ZoomIn();" >+</button>
<button class="btn" style="font-weight:800; background-color:#0C9;"  OnClick="return ZoomOut();" >-</button>
</div>
<div style="height:636px; width:1700px; overflow:hidden; float:left; background-color:#FFF; ">
<div id="veg_demo" style="zoom: 150%;margin:0 auto; text-align:center; margin-left:-100px;  ">
	<div class="span12" >
    <div class="span8">
	<div>
	<img id="veg" src="<?php echo 'http://rdlpk.com/images/projects/'.$res['project_map']; ?>" usemap="#veg" width="852px;" >
	</div>
    <div style="clear:both; height:8px;"></div>
   </div>
   <div class="span3">
   
    <div style="position:absolute; margin: 389px 0px 20px 50px;
  opacity: 19;">

</div>
    
</div></div>
</div> 
</div>


</div>
<script type="text/javascript">
function hello2(){
	
	document.querySelector("#selections").style.display = "block";	
$(document).ready(function () {
	   var image = $('img');
	   var xref = {
		   <?php $sohaib=1;
		  
foreach($result as $row)
{
	$sql3  = "SELECT *,p.id as pid FROM memberplot 
	left join members m on(memberplot.member_id=m.id)
        left join plots p on(memberplot.plot_id=p.id)
	left join projects pro on(p.project_id=pro.id)
	where p.id='".$row['plot_id']."' ";
$res3 = $connection->createCommand($sql3)->queryRow();


	
	if($sohaib!==1){echo ',';}
$sohaib++;
 echo 'Plot'.$res3['pid'].' :"'.$res3['name'].'<br>'.$res3['phone'].'<br>'.$res3['cnic'].'<br>'.$res3['email'].'</br>'.$row['plot_detail_address'].'<br>'.$row['sector'].'/'.$row['street_id'].'<br>'.$res3['project_name'].'<br>'.'<p><a href='.'http://localhost/ams/index.php/memberplot/payment_details?id='.$row['id'].'&&pid='.$row['project_id'].'>F-Details</a></p>"
' ;
}


?>
	   		
	   };
	   var defaultDipTooltip = 'I know you want the dip. But it\'s loaded with saturated fat, just skip it and enjoy as many delicious, crisp vegetables as you can eat.';

	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "d42e16",
       		strokeColor: "3320FF",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
            onClick: function (e) {
                var newToolTip = defaultDipTooltip;
                $('#selections').html(xref[e.key]);
                if (e.key==='asparagus') {
                	newToolTip = "OK. I know I have come down on the dip before, but let's be real. Raw asparagus without any of that " +
                			"delicious ranch and onion dressing slathered all over it is not so good.";
                }
                image.mapster('set_options',{areas: [{
                	key: "dip",
                	toolTip: newToolTip
                	}]
                });
            },
            showToolTip: true,
            toolTipClose: ["tooltip-click", "area-click"],
            areas: [
    {				
                	key: "1q1",
                	fillColor: "000"
                },
	            
                ]
        });
      });}  
function cnic(){
	//document.querySelector("#selections").style.display = "none";	
	image = $('img');
	 var cnic=$("#searchid").val();
	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "d42e16",
       		strokeColor: "3320FF",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
            
            areas: [

{key : cnic , selected : true,
	fillColor: "FF0404",
	strokeColor: "FF0404"

},
    
                ]
				
        });
    


	}
function cnic1(){
	document.querySelector("#selections").style.display = "none";	
	image = $('img');
	 var cnic=$("#searchid1").val();
	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "d42e16",
       		strokeColor: "3320FF",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
            
            areas: [

{key : cnic , selected : true,
	fillColor: "FF0404",
	strokeColor: "FF0404"

},
    
                ]
				
        });
    


	}
      </script>
      <?php
//	print_r($_GET);
	  ?>
<map id="veg_map" name="veg">
	<?php
 $sql1  = "SELECT dmap.*,members.cnic,memberplot.plotno,plots.street_id,plots.type,plots.id as pid FROM dmap
 Left Join memberplot on (dmap.plot_id=memberplot.plot_id)
 Left Join members on (memberplot.member_id=members.id)
 Left Join plots on (memberplot.plot_id=plots.id)
  where plots.project_id='".$_GET['project_id']."' ";
$result1 = $connection->createCommand($sql1)->queryAll();

foreach($result1 as $row1)
{
 if($row1['map']!==''){$tag='';$tagres='';$size='';
 if($row1['status']=='Alotted'){$tag='red';}else{$tag='green';}
 if($row1['com_res']=='Residential'){$tagres='yellow';}else{$tagres='blue';}
 echo '<area shape="poly" 

name="Plot'.$row1['pid'].','.$tagres.','.$tag.',SS'.$row1['street_id'].''.$row1['size2'].','.$row1['cnic'].','.$row1['plotno'].'" coords='.$row1['map'].' href="#"/>';
}}?>

</map>



<script type="text/javascript">  
     


	    function ZoomIn() {  
            var ZoomInValue = parseInt(document.getElementById("veg_demo").style.zoom) + 10 + '%'  
            document.getElementById("veg_demo").style.zoom = ZoomInValue;  
            return false;  
        }  
  
        function ZoomOut() {  
            var ZoomOutValue = parseInt(document.getElementById("veg_demo").style.zoom) - 10 + '%'  
            document.getElementById("veg_demo").style.zoom = ZoomOutValue;  
            return false;  
        } 
         function Zoomorg() {  
            var ZoomOutValue = parseInt(100) + '%'  
            document.getElementById("veg_demo").style.zoom = ZoomOutValue;  
            return false;  
        }  

$(document).ready(function()
     { 
	  	
       $("#street").change(function()
           {
         	searchstreet($(this).val());
		   });
     });
function searchstreet(id){
	document.querySelector("#selections").style.display = "none";	
	image = $('img');
	 var cnic1='SS'+ id;
	// alert(cnic);
	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "d42e16",
       		strokeColor: "3320FF",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
            
            areas: [

{key : cnic1 , selected : true,
	fillColor: "FF0404",
	strokeColor: "FF0404"

},
    
                ]
				
        });
    


	}
$(document).ready(function()
     { 
	  	
       $("#sector").change(function()
           {
         	select_street($(this).val());
		   });
     });

function select_street(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest.php?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	//  success: function(data){alert(JSON.stringify(data));
var listItems='';
	listItems+= "<option value=''>Select Street</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
});listItems+="";
$("#street").html(listItems);
          }
    });
}

    </script>
    
<?php
if(isset($_GET['project_id'])){
	echo'<script>
	var id ='.$_GET['project_id'].';
     
	
$.ajax({
	 
	  type: "POST",
      url:    "ajaxRequest.php?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	//  success: function(data){alert(JSON.stringify(data));
var listItems="";
	
	$(json).each(function(i,val){
	listItems+= "<option value=" + val.id + ">" + val.street + "</option>";
});listItems+="";
$("#street").html(listItems);
          }
    });

</script>';
}
	

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 <script>
  $(function() {
    $( "#veg_demo" ).draggable();
	 $( "#selections" ).draggable();
	  $( "#new" ).draggable();
	   $( "#new1" ).draggable();
  });
  </script>
</body></html>