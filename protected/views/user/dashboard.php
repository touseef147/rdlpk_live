<style>

.row-fluid [class*="span"]{ margin-left:0px; margin:2px;}

.main-icons{ margin:0px; height:118px;}

.main-icons p{ font-size:12px; line-height:1px;}





</style>

<div class="span8">



<div role="tabpanel">



  <!-- Nav tabs -->

 





 

  <h5>Forms Management</a></h5>

   <hr noshade="noshade">

    <div role="tabpanel" class="tab-pane active" id="home"><div class="span12" id="demo">

<?php if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per16']=='1')

			{?>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/forms_lis"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/listf.png"><br />Forms List</a></span><?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1' )

			{?>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/selectpr"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon4.png"><br />Add New Form</a>



</span><span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/schema_lis"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon5.png"><br />Schema</a></span>



<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/formpayment_lis"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon7.png"><br />Charges Management</a></span>



<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/allot"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/distribution.png"><br />Distributor forms Allocation </a></span>

<?php }?>













<?php if(Yii::app()->session['user_array']['per13']=='1' )

			{?>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/authorize" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ch2.png"><br />User form Allocation</a></span>



<span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/finance"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/financem.png"><br />Finance form Allocation</a></span><?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per14']=='1')

			{?>

<span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/mainreport"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon1.png"><br />Reporting</a></span>

<?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per15']=='1')

			{?>

<span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/financedb"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/adminfa.png"><br />Finance Administration</a></span>

<?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1' )

			{?>

            <span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/seller/seller_lis" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ch2.png"><br />Manage Distributor</a></span>

<span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/seller/sdealer_lis"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/subd.png"><br />Sub Dealers</a></span>

<?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per15']=='1' or Yii::app()->session['user_array']['per14']=='1' or Yii::app()->session['user_array']['per16']=='1')

			{?>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/formssearch"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon6.png"><br />Search Forms</a></span><?php }?>

<?php if(Yii::app()->session['user_array']['per13']!=='1' and Yii::app()->session['user_array']['per17']=='1')

			{?>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/editorlis"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon6.png"><br />Search Forms</a></span><?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('forms/addbal')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/draw.png" />

<h6>Form Balloting </h6>

</a>

</div>

<?php } ?>

</div>

  <!-- Tab panes -->



   <h5>Add New</h5>

 <hr noshade="noshade">

    <div role="tabpanel" class="tab-pane active" id="home"><div class="span12" id="demo">

<?php if(Yii::app()->session['user_array']['per3']=='1'){ ?>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('streets/streets_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />

<h6>Streets</h6>



</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per7']=='1'){ ?>

<div class="span2 main-icons">
<?php 
$connection=yii::app()->db;
$sql_pro  = "SELECT * FROM projects where status='1' ";
			$repro = $connection->createCommand($sql_pro)->queryAll();
			$projects=count ($repro);?>
<a href="<?php echo $this->createAbsoluteUrl('projects/project_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_projects.png" />

<h6>Projects</h6>



</a>
<span style="color:#093; font-weight:bold";>(<?php echo $projects;?>)</span>
</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per7']=='1'){ ?>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('uprojects/uproject_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/coming_soon_icon.png" />

<h6>Upcoming Projects</h6>



</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('banks/bank_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon4.png" />

<h6>Banks</h6>



</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('memberplot/broadcast')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/broadcast.jpg" />

<h6>Broadcast</h6>



</a>

</div>

<?php } ?>



<?php if(Yii::app()->session['user_array']['per3']=='1'){

	echo '<div class="span2 main-icons" style="padding:5px 25px;"><img src="'. Yii::app()->request->baseUrl.'/images/category-icon.png" />

<h6 style=" text-align:center;"><a href="'.$this->createAbsoluteUrl("category/category_list").'">Categories List</h6></a></div>'; }?>

<?php if(Yii::app()->session['user_array']['per3']=='1'){

	echo '<div class="span2 main-icons" style="padding:5px 25px;"><img src="'. Yii::app()->request->baseUrl.'/images/charges-icon.png"" />

<h6 style=" text-align:center;"><a href="'.$this->createAbsoluteUrl("charges/charges_list").'">Charges List</h6></a></div>'; }?>

<?php if(Yii::app()->session['user_array']['per3']=='1'){?>

<div class="span2 main-icons" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('size/size_list')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/landsize.png" />

<h6 style=" text-align:center;">Plot Size Categories</h6></a></div> 

<?php }?>

<?php if(Yii::app()->session['user_array']['per3']=='1'){?>

<div class="span2 main-icons" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('installmentplan/list')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/i-scheduled-payment.png" />

<h6 style=" text-align:center;">Installment Plan</h6></a></div> 

<?php }?>

<?php if(Yii::app()->session['user_array']['per3']=='1'){ ?>

<div class="span2 main-icons" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('projects/sector')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/i-scheduled-payment.png" />

<h6>Sectors</h6>

</a></div> 

<?php }?>

<?php if(Yii::app()->session['user_array']['per3']=='1'){ ?>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('ptype/ptype_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />

<h6>Property Type</h6>



</a>

</div>

<?php } ?>
<?php if(Yii::app()->session['user_array']['per3']=='1'){ ?>
<div class="span2 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('reciept/target_list')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/target-icon.png" />
<h6>Monthly Target</h6>

</a>
</div>
<?php } ?>
</div></div>



 <h5>Media & website</a></h5>

    <hr noshade="noshade" >

    <div role="tabpanel" class="tab-pane" id="profile"><div class="span12">

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('user/virtual_tour_video_gallery')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/magnifier.png" />

<h6>Virtual Tour</h6>



</a>

</div>



<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('pages/splashscreen')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/hoarding.png" />

<h6>Splash Screen</h6>



</a>

</div>



<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateAbsoluteUrl('slider/slider_list');?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/s1.png" />

<h6>Slider</h6>



</a>

</div>



<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateABsoluteurl('centers/centers_list');?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/office_building.png" />

<h6>Sales Center</h6>

<p></p>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo Yii::app()->request->baseUrl; ?>/filemanager/index.php">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/File-Manager-Icon.png" />

<h6>File Manager</h6>

</a></div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateABsoluteurl('news/news_list');?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/news-icon.png" />

<h6>News</h6>



</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per1']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateABsoluteurl('setting/setting_list');?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/toolbars-icon.png" />

<h6>Setting</h6>



</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per4']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateAbsoluteUrl('pages/pages_list');?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-05.png" />

<h6>Pages</h6>



</a>

</div>

<?php } ?>



<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('gallery/gallery_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gallery-icon.png" />

<h6>Image Gallery</h6>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('country/country_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/country.png" />

<h6>Manage Country</h6>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('hordings/hordings_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/hoarding.png" />

<h6>Hoardings</h6>

</a>

</div> 

<?php } ?>

<?php if(Yii::app()->session['user_array']['per4']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('downloads/downloads_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/downloads.png" />

<h6>Downloads</h6>

</a>

</div> 

<?php } ?>

</div></div>

<h5>Users/members</a></h5>

    <hr noshade="noshade" >

    <div role="tabpanel" class="tab-pane" id="messages"><div class="span12">

<?php if(Yii::app()->session['user_array']['per2']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateABsoluteurl('user/membershiprequest');?>">
<?php 
$connection=yii::app()->db;
$sql_mem  = "SELECT * FROM members where status='1' ";
			$resmem = $connection->createCommand($sql_mem)->queryAll();
			$members=count ( $resmem );?>

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/add-membership.png" />

<h6>Member's Directory</h6>
<span style="color:#093; font-weight:bold";>(<?php echo $members;?>)</span>
</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per1']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('user/user_list')?>">

<?php 
$connection=yii::app()->db;
$sql_usr  = "SELECT * FROM user where status='1' ";
			$resusr = $connection->createCommand($sql_usr)->queryAll();
			$users=count ($resusr);?>

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-01.png" />

<h6>User</h6>

</a>
<span style="color:#093; font-weight:bold";>(<?php echo $users;?>)</span>
</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per12']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('visitors/visitors_dashboard')?>">



<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-visitor.png" />

<h6>Daily Visitors Report</h6>

</a>

</div>

<?php } ?>

</div></div>

<h5>Security, Reporting, Balloting,Recovery </a></h5>

    <hr noshade="noshade" >

    <div role="tabpanel" class="tab-pane" id="settings"><div class="span12">

<?php if(Yii::app()->session['user_array']['per7']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('allotments/ballotting')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/draw.png" />

<h6>Balloting </h6>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per11']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('plots/reporting')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/draw1.png" />

<h6>Reporting</h6>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per10']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('user/fpreader')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fingerprint.png" />

<h6>Security</h6>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per9']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('finance/finance')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/finance.png" />

<h6>Finance System</h6>

</a>

</div>

<?php } ?>



<?php if(Yii::app()->session['user_array']['per31']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateAbsoluteUrl('recovery/recovery');?>">

<img style="height:50px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/recovery-icon.png" />

<h6>Recovery System</h6>



</a>

</div>



<?php } ?>

</div></div>

<?php if(Yii::app()->session['user_array']['per22']=='1' or Yii::app()->session['user_array']['per23']=='1'){?>

<h5>Land and Socity Map Managment</a></h5>

<hr noshade="noshade" >

<div role="tabpanel" class="tab-pane" id="settings"><div class="span12">

<div class="span2 main-icons">

<a href="<?php echo Yii::app()->request->baseUrl; ?>/gis/Townp.php?id=1">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mapp.png" />

<h6>View Map</h6>

</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo Yii::app()->request->baseUrl; ?>/gis/developer.php?id=1">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mapde.png" />

<h6>Developer View </h6>

</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo Yii::app()->request->baseUrl; ?>/gis/images/index.php?id=1">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/map.png" />

<h6>Create Map</h6>

</a>

</div>



</div></div>

<?php }?>





<?php if(Yii::app()->session['user_array']['per1']=='1' )

			{?>

<h5>Property</a></h5>

<hr noshade="noshade" >

<div role="tabpanel" class="tab-pane" id="settings">

<div class="span12">





<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('property/addnew')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />

<h6>Add New Property</h6>

</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('property/memberproperty_lis')?>">

<img width="50px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/leaders_icon.png" />

<h6>Member Property Alloted</h6>

</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('property/property_list')?>">

<img width="50px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/ForSaleIcon.jpg" />

<h6>Property</h6>

</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('property/memberproperty')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />

<h6>Allot A Property</h6>

</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('property/list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />

<h6>Instalment Plan</h6>

</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('property/adminrequest')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />

<h6>Admin Request</h6>

</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('property/financerequest')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />

<h6>Finance Request</h6>

</a>

</div>





</div>

</div>

  <?php } ?>

</div>

</div>

</div>





<div class="span4">





<div role="tabpanel" style="background:#E6FFF1;">



  <!-- Nav tabs -->

  <ul class="nav nav-tabs" role="tablist">

    <li role="presentation" class="active"><a href="#home1" aria-controls="home1" role="tab" data-toggle="tab">Notifications</a></li>

    

    

  </ul>



  <!-- Tab panes -->

  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="home1">

			<?php if(Yii::app()->session['user_array']['per6']=='1'){

            $connection = Yii::app()->db;

            $sql_plot  = "SELECT mp.member_id,mp.id,mp.create_date,p.type,p.status, m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp

            left join members m on mp.member_id=m.id

            left join plots p on mp.plot_id=p.id

            left join streets s on p.street_id=s.id

            left join projects j on s.project_id=j.id where p.type='plot' and mp.status='new' and mp.fstatus='Approved'   ";

            $result_plot = $connection->createCommand($sql_plot)->query();

            

            $count=0;

            $res=array();

            foreach($result_plot as $key){

            $count++;

            

            } ?>

            

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplot/memberplot_list')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/request-icon.png" />

            <h6 style=" text-align:center;">Allot a Plot Request </h6></a></div> <?php }?>

            <?php if(Yii::app()->session['user_array']['per6']=='1'){

            $connection = Yii::app()->db;

            $sql_plot  = "SELECT mp.member_id,mp.id,mp.create_date,p.type,p.status, m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp

            left join members m on mp.member_id=m.id

            left join plots p on mp.plot_id=p.id

            left join streets s on p.street_id=s.id

            left join projects j on s.project_id=j.id where p.type='file' and mp.status='new' and mp.fstatus='Approved' ";

            $result_plot = $connection->createCommand($sql_plot)->query();

            

            $count=0;

            $res=array();

            foreach($result_plot as $key){

            $count++;

            

            } ?>

            

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberfile/memberfile_list')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/plotrequest.jpg" />

            <h6 style=" text-align:center;">Allot a File Request </h6></a></div> <?php }?>
	<?php if(Yii::app()->session['user_array']['per33']=='1'){
            $connection = Yii::app()->db;
            $sql_cplot  = "SELECT cp.fstatus,cp.status,mp.*,sec.sector_name,s.street,siz.size,p.price,mp.comment,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name, cp.status as cpstatus, mp.plotno,m.name from memberplot mp
			Left JOIN members m ON m.id=mp.member_id		
			Left JOIN plots p ON p.id=mp.plot_id			
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
			Left JOIN sectors sec  ON p.sector = sec.id
			Left JOIN projects pro ON pro.id=p.project_id 
			Left JOIN cancelplot cp ON cp.plot_id=p.id
			where cp.status='approved' and cp.fstatus='Approved'";
            $result_cplot = $connection->createCommand($sql_cplot)->query();
            $ccount=0;
            $res=array();
            foreach($result_cplot as $cplot){
            $ccount++;
            } ?>
            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplot/cancellation_list')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $ccount; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cancel-icon.png" />

            <h6 style=" text-align:center;">Cancel a Plot Request </h6></a></div> <?php }?>
            <?php if(Yii::app()->session['user_array']['per6']=='1'){

$connection = Yii::app()->db;

$sql_plot  = "SELECT mp.member_id,mp.id,mp.create_date,p.type,p.status, m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM property mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id

left join projects j on s.project_id=j.id where mp.status='New' and mp.fstatus='Approved'   ";

$result_plot = $connection->createCommand($sql_plot)->query();



$count=0;

$res=array();

foreach($result_plot as $key){

$count++;



} ?>



<div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('property/memberplot_list')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/request-icon.png" />

<h6 style=" text-align:center;">Allot a Property Request </h6></a></div> <?php }?>

   

		<?php if(Yii::app()->session['user_array']['per6']=='1'){

$connection = Yii::app()->db;

$sqlmember  = "SELECT * from transferplot where RFM='RFM' ";

$resulrmem = $connection->createCommand($sqlmember)->query();



$count1=0;

$res=array();

foreach($resulrmem as $mem){

$count1++;



} ?>



<div class="span3" style="padding:12px 20px;"><a href="<?php echo $this->createAbsoluteUrl('member/RFM')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count1; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/member-request.png" />

<h6 style=" text-align:center;">Member Transfer Request</h6></a></div> <?php }?>

	

			<?php if(Yii::app()->session['user_array']['per8']=='1'){

            $connection = Yii::app()->db;

            $sql_projects  = "SELECT * from query where replied=0 or replied='' ";

            $result_projects = $connection->createCommand($sql_projects)->query();

            

            $count=0;

            $res=array();

            foreach($result_projects as $key){

            $count++;

            

            } ?>

            

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('user/register_member_query')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/E-mail-icon.png" />

            <h6 style=" text-align:center;">Member Message</h6></a></div> <?php }?>
			  <?php if(Yii::app()->session['user_array']['per8']=='1'){
            $connection = Yii::app()->db;
            $sql_projects  = "SELECT * from forgot_password_requests where status=0 and replied=0 or replied='' ";
            $result_projects = $connection->createCommand($sql_projects)->query();
            
            $count=0;
            $res=array();
            foreach($result_projects as $key){
            $count++;
            
            } ?>
            
            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('member/forgot_password_requests')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/forgot_password.png" />
            <h6 style=" text-align:center;">Forgot Password Request</h6></a></div> <?php }?>
              <?php if(Yii::app()->session['user_array']['per8']=='1'){
            $connection = Yii::app()->db;
            $sql_projects  = "SELECT * from ua_activate_requests where status=0 and replied=0 or replied='' ";
            $result_projects = $connection->createCommand($sql_projects)->query();
            
            $count=0;
            $res=array();
            foreach($result_projects as $key){
            $count++;
            
            } ?>
                  <?php if(Yii::app()->session['user_array']['per2']=='1'){?>
            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplot/posspay_list')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php // echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/possession-icon.png" />
            <h6 style=" text-align:center;">Possession Payment</h6></a></div> <?php }?>
            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('member/ua_activate_requests')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/account-activate.png" />
            <h6 style=" text-align:center;">Account Activation Request</h6></a></div> <?php }?>
            <?php if(Yii::app()->session['user_array']['per8']=='1'){

            $connection = Yii::app()->db;

            $sql_projects  = "SELECT * from unregister_user_query where status=0 and replied=0 or replied='' ";

            $result_projects = $connection->createCommand($sql_projects)->query();

            

            $count=0;

            $res=array();

            foreach($result_projects as $key){

            $count++;

            

            } ?>

            

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('user/visitor_query')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/dialog_question.png" />

            <h6 style=" text-align:center;">Visitor's Message</h6></a></div> <?php }?>

            <?php if(Yii::app()->session['user_array']['per8']=='1'){

            $connection = Yii::app()->db;

            $sql_projects  = "SELECT * from mailto_member ";

            $result_projects = $connection->createCommand($sql_projects)->query();

            

            $count=0;

            $res=array();

            foreach($result_projects as $key){

            $count++;

            

            } ?>

            

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('member/maillist')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/email-icon.jpg" />

            <h6 style=" text-align:center;">Email To Member</h6></a></div> <?php }?>

                       <?php if(Yii::app()->session['user_array']['per8']=='1'){?>

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('user/subcriber_list')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/subcriber.gif" />

            <h6 style=" text-align:center;">Subcriber List</h6></a></div><?php }?>

<div class="span12">
   <?php if(Yii::app()->session['user_array']['per33']=='1'){ ?>
            <?php  $sql_noc = "SELECT cp.status as cpstatus,mp.*,sec.sector_name,s.street,siz.size,p.price,mp.comment,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name, cp.status as cpstatus, mp.plotno,m.name from memberplot mp
			Left JOIN members m ON m.id=mp.member_id
			
			Left JOIN plots p ON p.id=mp.plot_id
			
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
			Left JOIN sectors sec  ON p.sector = sec.id
			Left JOIN projects pro ON pro.id=p.project_id 
			Left JOIN cancelplot cp ON cp.plot_id=p.id
			where cp.status='New'"; 
	
		$result_noc = $connection->createCommand($sql_noc)->query();
		?>
            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplot/cancellation_lis')?>" >

           <span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;">

            <?php  echo count($result_noc);?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cancel.png" />

            <h6 style=" text-align:center;">Cancellation</h6></a></div>
            <?php }?>
            
            
           

            <?php 

			$connection = Yii::app()->db; 

      $temp_projects_array = Yii::app()->session['projects_array'];

		$num_of_projects_counter = count($temp_projects_array);	

		$num_of_projects_counter2 = $num_of_projects_counter;

		$sql1 =   "select * from projects where";

		$num_of_projects_counter--;

		while($num_of_projects_counter>-1)

		{

			$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];

			$num_of_projects_counter--;

		}

		

		$sql_project = $sql1;

		$sql_project = $sql_project.implode(' or',$sql2);

		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

$prooo='';$pos=0;

foreach($result_projects as $pro){

if($pos==0){$prooo .=$pro['id'];}else{

$prooo .=','.$pro['id'];}

$pos=$pos+1;

}

			

			$sql_transfer  = "SELECT * from transferplot

			left join plots on(plots.id=transferplot.plot_id)

			 where transferplot.status='sales' and plots.project_id in (".$prooo.") ";

            $result_transfer = $connection->createCommand($sql_transfer)->query();

			

			$sql_allotment  = "SELECT * from memberplot 			

			left join plots on(plots.id=memberplot.plot_id)

			 where memberplot.status='sales' and plots.project_id in (".$prooo.") ";

            $result_allotment = $connection->createCommand($sql_allotment)->query();

			

			if(Yii::app()->session['user_array']['per20']=='1'){ ?>

            <h5>Request from Sale Center</h5>

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplotsales/transfer_lis')?>" >

            <span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;">

            <?php echo count($result_transfer);?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/transferIcon.png
" />

            <h6 style=" text-align:center;">Transfer</h6></a></div>

			<div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplotsales/allotments_lis')?>" >

                        <span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;">

            <?php echo count($result_allotment);?></span>

                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/subcriber.gif" />

            <h6 style=" text-align:center;">Allotments</h6></a></div>

			

			<?php }?>
            
            
            
            
            
            
            </div>

	</div>	

</div>



   

  </div>



</div>

</div>

<hr noshade="noshade" class="hr-5 float-left">



<!-- section 3 -->