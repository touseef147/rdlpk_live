<div class="shadow">

  <h3>Advance Search</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 float-left">

<section class="reg-section margin-top-30">

<?php 

$pages_data = Yii::app()->session['pages_array'];

?>


<form action="plots_lis" method="post"> 
 
  <div class="clear-fix"></div>
 <span>Project:</span>
 	<select name="project_id" id="project" style="width:180px;"><?php	

			if($pro!=''){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				echo '<option value="">Select Project</option>';
				}

            $res=array();

            foreach($projects as $key){

            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 

            }?></select> 
    <span >Street:</span>
   <select style="width:180px;" name="street_id" id="street_id" >
	<?php
			if($st!=''){echo '<option value="'.$st.'">'.$st.'</option>'; }
  	?>

   <option value="">Select Street</option>
  <option value="street">street</option>


    
    </select> <span>Sector:</span>
    <select name="sector" id="sector"  style="width:180px;"><?php 
			
			if($sector!=''){echo '<option value="'.$sector.'">'.$sector.'</option>'; }else{
				echo '<option value="">Select Sector</option>';
				}
			$res=array();
            foreach($sectors as $sec){

            echo '<option value="'.$sec['sector'].'">'.$sec['sector'].'</option>'; 

            }?></select> 
  
<input type="text" value="<?php if($plotno!=''){echo $plotno; }?>" name="plotno" id="plotno" class="new-input" placeholder="Enter Plot No" />
  <!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />
    -->
   <button name="submit" type="submit" class="btn btn-info btn-new">Search</button>
     <?php 

	

	$res=array();

	$i = 1;

	foreach($categories as $key1)

	{

	

	echo'<div class="">

    <input style="float:left; margin-right:10px; margin-left:10px;"   id="cat" name="cat" type="checkbox"	value="'.$key1['id'].'" />

	<label for="checkbox" style="float:left;">'.$key1['name'].'</label>

	


	</div>';
	$i++;

	}

	?>

  </form>

  <div class="float-left">

            
            

            <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>
                        <th width="10%">Project</th>
                        <th width="5%">Street</th>
                        <th width="6%">Plot No</th>
                        <th width="7%">Plot Size</th>
                        <th width="7%">Dimension</th>
                        <th width="7%">Type</th>
                        <th width="5%">Sector</th>
                        <th width="7%">Create Date</th>
                        
                        <th width="5%">Status</th>
                        
                         <th width="8%">Reallocation</th>
                        
                         <th width="7%">Action</th>
                        
                        </tr>

                </thead>

                <tbody>

                <?php

		    $home=Yii::app()->request->baseUrl; 

            $res=array();

            foreach($members as $key){

			

			

            	
            echo '<tr><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['plot_size'].'</td><td>'.$key['size2'].'</td><td>'.$key['com_res'].'</td><td>'.$key['sector'].'</td><td>'.$key['create_date'].'</td><td>';
			if($key['status']==''){ echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'">' ."Allot".'</a>';}else{ echo $key['status'];}echo '</td>
			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td></tr>'; 
            }?>

                    

                </tbody>

            </table>

 			

  	

  </div>
<hr noshade="noshade" class="hr-5 float-left">

  

  

 

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
 
 <script>
 
 
 

  $(document).ready(function()

     {  	

		

       $("#project").change(function()

           {

         	select_street($(this).val());

		   });

		   

		  

     });

 

 

function select_street(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';
	listItems+="<option value=''>Select Street</option>";

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";

      



});listItems+="";



$("#street_id").html(listItems);

          }

    });

}

</script>