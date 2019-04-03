
 
<style>  
 body { padding: 30px }  
 form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }  
 .progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }  
 .bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }  
 .percent { position:absolute; display:inline-block; top:3px; left:48%; }  
 </style> 

<form action="Virtual_tour_video_uploaded" method="post" enctype="multipart/form-data">
<h6>Video Title </h6>
<input type="text" name="video_name" />
<h6>Video Description </h6>
<textarea name="video_description" id="$connection = Yii::app()->db;video_description" cols="45" rows="5"></textarea>
<br /><br />
<input  name="file" id="file" type="file" /><br /><br />
<input type="Add" class="btn btn-info" value="Add Video"  name="submit" />

</form>
<div class="progress">  
     <div class="bar"></div >  
     <div class="percent">0%</div >  
   </div>  
   <div id="status"></div>
   
   <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.js"></script>  
 <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.form.js"></script>  
 <script>  
 (function() {  
 var bar = $('.bar');  
 var percent = $('.percent');  
 var status = $('#status');  
 $('form').ajaxForm({  
   beforeSend: function() {  
     status.empty();  
     var percentVal = '0%';  
     bar.width(percentVal)  
     percent.html(percentVal);  
   },  
   uploadProgress: function(event, position, total, percentComplete) {  
     var percentVal = percentComplete + '%';  
     bar.width(percentVal)  
     percent.html(percentVal);  
   },  
   complete: function(xhr) {  
     bar.width("100%");  
     percent.html("100%");  
     status.html(xhr.responseText);  
   }  
 });   
 })();      
 </script>  