
<div class="shadow">
  <h3>Add Splash Screen</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<?php 
$pages_data = Yii::app()->session['pages_array'];
$result_pages = Yii::app()->session['pages_array'];
?>
<form action="Addnewsplash" method="post" enctype="multipart/form-data">

<div class="float-left">
  <p class="reg-left-text">Heading<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="" name="heading" id="heading" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Detail <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="" name="detail" id="detail" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Status <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <select name="status" id="status">
   <option value="1">Active</option>
   <option value="0">inActive</option>
   </select>
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Image<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="file" name="image1" id="image1" class="reg-login-text-field" />
    
  </p>
</div>



<button type="submit" class="btn btn-success">Submit</button>



</section>
<!-- section 3 --> 
