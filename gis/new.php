<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Zoom In / Zoom Out </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<script type="text/javascript">  
        function ZoomIn() {  
            var ZoomInValue = parseInt(document.getElementById("divContent").style.zoom) + 10 + '%'  
            document.getElementById("divContent").style.zoom = ZoomInValue;  
            return false;  
        }  
  
        function ZoomOut() {  
            var ZoomOutValue = parseInt(document.getElementById("divContent").style.zoom) - 10 + '%'  
            document.getElementById("divContent").style.zoom = ZoomOutValue;  
            return false;  
        } 
         function Zoomorg() {  
            var ZoomOutValue = parseInt(100) + '%'  
            document.getElementById("divContent").style.zoom = ZoomOutValue;  
            return false;  
        }  

    </script>  
</HEAD>

<BODY>
<div>  
            <input type="button" value="Zoom In" OnClick="return ZoomIn();" />   
            <input type="button" value="Zoom out" OnClick="return ZoomOut();" />   
              <input type="button" value="Orignal Size" OnClick="return Zoomorg();" />    <br><br>
        </div>



    <div id="divContent" style="zoom: 100%; background:#000; width:100px; height:100px;">  

</div>
</BODY>
</HTML>