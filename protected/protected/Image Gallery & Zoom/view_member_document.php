
<script>



function showimage(img_id){
	

	//BigImage = document.getElementById("BigImage");
	thumb = document.getElementById(img_id);
	
	//alert(thumb);
	source = thumb.src;
	
	BigImage.innerHTML="<img src='"+source+"' id='pic' />";
	//document.write(thumb);
	
	
	}

//window.onload = function(){zoom(1)}


function zoom(zm) {
	
img=document.getElementById("pic")
wid=img.width;
ht=img.height;
img.style.width=(wid*zm)+"px";
img.style.height=(ht*zm)+"px";

//img.window.scrollTo(1000,1000);

//window.scrollTo(5000,5000);

//document.getElementById("pic").style.textAlign="center";


    //img.style.marginLeft = -(img.width/10) + "px";
    //img.style.marginTop = -(img.height/10) + "px";
}
	

</script>


<div style="width:400px; float:left; border:solid 2px #90C; border-radius:5px; padding:5px; margin:5px;">


<?php 
//Can Change Directory from where it picks Images to Show in the Gallery

$dirname = "upload/";

$images = glob($dirname."*.{jpg,png,gif}", GLOB_BRACE);
//$images = glob($dirname."*.jpg");

$number_of_images = count($images);
$number_of_images = $number_of_images - 1;
//$number_of_imagess = 100;
//$num = $number_of_imagess / 6;
//$num = ceil($num);
//echo $num;
//exit;
while($number_of_images>-1) {


echo '<div style=" float:left; border:solid 2px #90C; border-radius:5px; padding:5px;margin:5px;"><img src="'.$images[$number_of_images].'" height="100" width="100" id="'.$number_of_images.'" onclick="showimage('.$number_of_images.');"  /></div>';

$number_of_images --;
}


?>

</div>
<body>
<div id="BigImage" style=" float:left; border:solid 2px #90C; border-radius:5px; padding:5px;margin:5px;width:750px; height:750px;overflow:auto";>





</div>
</body>
<input type="button" value ="-" onClick="zoom(0.9)"/>
<input type="button" value ="+" onClick="zoom(1.1)"/>