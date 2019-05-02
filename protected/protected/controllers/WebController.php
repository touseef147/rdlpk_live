<?php



class WebController extends Controller

{

	

	/**

	 * Creates a new model.

	 * If creation is successful, the browser will be redirected to the 'view' page.

	 */



	 

	



	/**

	 * Updates a particular model.

	 * If update is successful, the browser will be redirected to the 'view' page.

	 * @param integer $id the ID of the model to be updated

	 */

	

	/**

	 * Deletes a particular model.

	 * If deletion is successful, the browser will be redirected to the 'admin' page.

	 * @param integer $id the ID of the model to be deleted

	 */

		public function actionBallotres()

	{	

		$connection = Yii::app()->db;
$sql_setting ="select * from setting ";
$result_setting = $connection->createCommand($sql_setting)->queryRow();
if($result_setting['showsearch_bal']==1){

	   $this->layout='//layouts/front';

	   		

			$and = false;

			$where='';

			

			if (isset($_POST['appno']) && $_POST['appno']!=""){

				$where.="plots.sector = '".$_POST['appno']."'";

				$and = true;

				

			}

			

			if (isset($_POST['cnic']) && $_POST['cnic']!=""){

				

				if ($and==true)

				{

					  $where.=" and plots.category_id = '".$_POST['cnic']."'";

				}

				else

				{

					$where.=" plots.category_id = '".$_POST['cnic']."'";

				}

				$and=true;

			}

			

			

			

			

			

		

	$connection = Yii::app()->db; 

    $sql_member = "SELECT

	size_cat.size,

    member_plot.*

FROM

    member_plot

    Left JOIN app ON (member_plot.ms_id = app.id)

	Left JOIN plots ON (member_plot.plot_id = plots.id)

	Left JOIN projects ON (plots.project_id = projects.id)

	Left JOIN streets ON (plots.street_id = streets.id)

	Left JOIN size_cat ON (plots.size2 = size_cat.id)

"; 

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();

		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();

			

	   

	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$result_members = $connection->createCommand($sql_member)->query();

		 

		    $home=Yii::app()->request->baseUrl; 

			if(isset($_POST['search'])){

            $res=array();



            foreach($result_members as $key){



			



			



            	

            echo '<tr><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['plot_size'].'</td><td>'.$key['size2'].'&n('.$key['plot_size'].')</td><td>'.$key['com_res'].'</td><td>'.$key['sector'].'</td><td>'.$key['create_date'].'</td><td>';

			if($key['status']==''){ echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'">' ."Allot".'</a>';}else{ echo $key['status'];}echo '</td>

			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td></tr>'; 

            }}

			$this->render('ballotres',array('members'=>$result_members,'projects'=>$result_project,'sectors'=>$result_sector,'categories'=>$categories));

			

	   }

	}
 public function actionSearchreq1()

	 	{

		$this->layout='//layouts/front';

		$where='';

		$and=false;

		if ($_POST['cnic']=="" && $_POST['appno']==""){echo "<td colspan='8' style='color:red;'>Please Enter CNIC or Application No</td> ";exit;}

		

		if (isset($_POST['cnic']) && $_POST['cnic']!=""){

				$where.="members.CNIC ='".$_POST['cnic']."'";

				$and = true;

				

			}

			

			

			if (isset($_POST['appno']) && $_POST['appno']!=""){

			if (isset($_POST['cnic']) && $_POST['cnic']==""){echo "<td colspan='8' style='color:red;'>Please Enter CNIC</td>"; exit;}

				if ($and==true)
				{	  $where.=" and memberplot.plotno LIKE '%".$_POST['appno']."%'";
}
				else
				{
					$where.="memberplot.plotno LIKE '%".$_POST['appno']."%'";
				}
				$and=true;

			}

			

			

			$connection = Yii::app()->db; 

  echo  $sql_member = "SELECT
member_plot.status as mpst,
   size_cat.size,
member_plot.*
,memberplot.*
	,plots.*

	,projects.*

	,streets.*
	,members.*
	,sectors.sector_name

	

FROM

    member_plot

    Left JOIN memberplot ON (member_plot.ms_id= memberplot.id)
	Left JOIN members ON (memberplot.member_id= members.id)
	Left JOIN plots ON (member_plot.plot_id = plots.id)
	Left JOIN sectors ON (plots.sector=sectors.id)
	Left JOIN projects ON (plots.project_id = projects.id)
	Left JOIN streets ON (plots.street_id = streets.id)
	Left JOIN size_cat ON (plots.size2 = size_cat.id)
where $where"; 

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();

		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();

			

	   

	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$result_members = $connection->createCommand($sql_member)->query();

	

	$count=0;

	if (count($result_members)>0){

		$home=Yii::app()->request->baseUrl; 

    $res=array();

            foreach($result_members as $key){

            $count++;

			echo 'Cogartulation result found'.$count;
if($key['mpst']=='Blocked'){
	echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td colspan="6" ><b style="color:red;">Result Blocked </b></td>

			</tr>';
	}else{
			echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')'.'</td><td> <b>'.$key['plot_detail_address'].'</b></td><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td>
<td><a target="blank" href="#">View Map</a></td>
			</tr>';
}
			

			} 

			}else{echo '<td colspan="8">&nbsp;<b style="color:red;">Sorry! Result Not Found</b></td>' ;exit;}

	

	    

			



	}

		public function actionBallotres1()

	{	

		$connection = Yii::app()->db;
$sql_setting ="select * from setting ";
$result_setting = $connection->createCommand($sql_setting)->queryRow();
if($result_setting['showsearch_bal']==1){

	   $this->layout='//layouts/front';

	   		

			$and = false;

			$where='';

			

			if (isset($_POST['appno']) && $_POST['appno']!=""){

				$where.="plots.sector = '".$_POST['appno']."'";

				$and = true;

				

			}

			

			if (isset($_POST['cnic']) && $_POST['cnic']!=""){

				

				if ($and==true)

				{

					  $where.=" and plots.category_id = '".$_POST['cnic']."'";

				}

				else

				{

					$where.=" plots.category_id = '".$_POST['cnic']."'";

				}

				$and=true;

			}

			

			

			

			

			

		

	$connection = Yii::app()->db; 

    $sql_member = "SELECT

	size_cat.size,

    member_plot.*

FROM

    member_plot

    Left JOIN app ON (member_plot.ms_id = app.id)

	Left JOIN plots ON (member_plot.plot_id = plots.id)

	Left JOIN projects ON (plots.project_id = projects.id)

	Left JOIN streets ON (plots.street_id = streets.id)

	Left JOIN size_cat ON (plots.size2 = size_cat.id)

"; 

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();

		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();

			

	   

	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$result_members = $connection->createCommand($sql_member)->query();

		 

		    $home=Yii::app()->request->baseUrl; 

			if(isset($_POST['search'])){

            $res=array();



            foreach($result_members as $key){



			



			



            	

            echo '<tr><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td>'.$key['plot_size'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['size2'].'</td><td>'.$key['com_res'].'</td><td>'.$key['sector'].'</td><td>'.$key['create_date'].'</td><td>';

			if($key['status']==''){ echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'">' ."Allot".'</a>';}else{ echo $key['status'];}echo '</td>

			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td></tr>'; 

            }}

			$this->render('ballotres1',array('members'=>$result_members,'projects'=>$result_project,'sectors'=>$result_sector,'categories'=>$categories));

			

	   }

	}

	  public function actionSearchreq()

	 	{

		$this->layout='//layouts/front';

		$where='';

		$and=false;

		if ($_POST['cnic']=="" && $_POST['appno']==""){echo "<td colspan='8' style='color:red;'>Please Enter CNIC or Application No</td> ";exit;}

		

		if (isset($_POST['cnic']) && $_POST['cnic']!=""){

				$where.="members.CNIC ='".$_POST['cnic']."'";

				$and = true;

				

			}

			

			

			if (isset($_POST['appno']) && $_POST['appno']!=""){

			if (isset($_POST['cnic']) && $_POST['cnic']==""){echo "<td colspan='8' style='color:red;'>Please Enter CNIC</td>"; exit;}

				if ($and==true)
				{	  $where.=" and memberplot.plotno LIKE '%".$_POST['appno']."%'";
}
				else
				{
					$where.="memberplot.plotno LIKE '%".$_POST['appno']."%'";
				}
				$and=true;

			}

			

			

			$connection = Yii::app()->db; 

  echo  $sql_member = "SELECT
member_plot.status as mpst,
   size_cat.size,
member_plot.*
,memberplot.*
	,plots.*

	,projects.*

	,streets.*
	,members.*
	,sectors.sector_name

	

FROM

    member_plot

    Left JOIN memberplot ON (member_plot.ms_id= memberplot.id)
	Left JOIN members ON (memberplot.member_id= members.id)
	Left JOIN plots ON (member_plot.plot_id = plots.id)
	Left JOIN sectors ON (plots.sector=sectors.id)
	Left JOIN projects ON (plots.project_id = projects.id)
	Left JOIN streets ON (plots.street_id = streets.id)
	Left JOIN size_cat ON (plots.size2 = size_cat.id)
where $where"; 

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();

		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();

			

	   

	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$result_members = $connection->createCommand($sql_member)->query();

	

	$count=0;

	if (count($result_members)>0){

		$home=Yii::app()->request->baseUrl; 

    $res=array();

            foreach($result_members as $key){

            $count++;

			echo 'Cogartulation result found'.$count;
if($key['mpst']=='Blocked'){
	echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td colspan="6" ><b style="color:red;">Result Blocked </b></td>

			</tr>';
	}else{
			echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td>Revised Map will be published soon</td>
			</tr>';
}
			

			} 

			}else{echo '<td colspan="8">&nbsp;<b style="color:red;">Sorry! Result Not Found</b></td>' ;exit;}

	

	    

			



	}



	public function actionIndex()

	{	

		  	$connection = Yii::app()->db;

			$sql_projects  = "SELECT * from projects where status='1'";

			$result_projects = $connection->createCommand($sql_projects)->query();

			

			$sql_slider  = "SELECT * from slider  ORDER BY id DESC";

			$result_slider = $connection->createCommand($sql_slider)->query();
			
			
			$sql_slider1  = "SELECT * from slider";

			$result_slider1 = $connection->createCommand($sql_slider1)->query();

			

			$sql_uprojects  = "SELECT * from uprojects where status='1'";

			$result_uprojects = $connection->createCommand($sql_uprojects)->query();

			

			

			$sql_page  = "SELECT * from pages where page_type='index'";

			$result_pages = $connection->createCommand($sql_page)->query();

			

			//$sql_news  = "SELECT * from latest_news where status=1 OR status='active'";

			$sql_news ="select * from latest_news where status='Active' ";

			$result_news = $connection->createCommand($sql_news)->query();

			

			$sql_setting ="select * from setting ";

			$result_setting = $connection->createCommand($sql_setting)->queryAll();

			$sql_splash ="select * from splashscreen where status='1' ";

			$result_splash = $connection->createCommand($sql_splash)->query();

			$this->render('index',array('projects'=>$result_projects,'uprojects'=>$result_uprojects,'pages'=>$result_pages,'news'=>$result_news,'setting'=>$result_setting,'slider'=>$result_slider,'slider1'=>$result_slider1,'hord'=>$result_splash));

			

	}

	public function actionProject_detail()

	{

			$connection = Yii::app()->db;

			$sql  = "SELECT * from projects where id='".$_REQUEST['id']."'";

			$project = $connection->createCommand($sql)->query();

			

			$this->render('project_details',array('project'=>$project));

	}

	public function actionUproject_details()

	{ 

			$connection = Yii::app()->db;

		 $sql_page  = "SELECT * from uprojects where id='".$_REQUEST['id']."'";

			$result = $connection->createCommand($sql_page)->query();

			

			$this->render('uproject_details',array('content'=>$result));

	}

	public function actionPlots()

	{

			$connection = Yii::app()->db;

			//echo $_REQUEST['plotno']; exit;

			$sql = "SELECT mp.member_id,mp.create_date,p.id,p.type, m.name,m.image,m.sodowo,m.cnic,p.com_res,p.size2,siz.size,p.sector,mp.plotno,p.plot_detail_address,mp.plot_id,mp.status, 					p.plot_size,s.street, j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join size_cat siz on siz.id=p.size2

left join streets s on p.street_id=s.id

left join projects j on s.project_id=j.id 

where plotno='".$_REQUEST['plotno']."'";

			// $sql  = "SELECT * from plots where plot_detail_address=".$_REQUEST['plotno']; 

			$res = $connection->createCommand($sql)->query();

			

			$this->render('plots',array('plots'=>$res));

	}

	public function actionPages()

	{

		$connection = Yii::app()->db;

		$sql_page1  = "SELECT * from pages where id='".$_REQUEST['id']."'";

		$result1 = $connection->createCommand($sql_page1)->queryRow();

		if($result1['page_type']=="2col-left")

		{

			$sql_page  = "SELECT * from pages where id='".$_REQUEST['id']."'";

			$result = $connection->createCommand($sql_page)->query();

			

			$sql_news  = "SELECT * from latest_news where status=1 OR status='active'";

			$result1 = $connection->createCommand($sql_news)->query();

			

			$this->render('2col-left',array('content'=>$result,'news'=>$result1));

		}

		if($result1['page_type']=="1col_left")

		{

			$sql_page  = "SELECT * from pages where id='".$_REQUEST['id']."'";

			$result = $connection->createCommand($sql_page)->query();

			$this->render('1col-left',array('content'=>$result));

		}

		if($result1['page_type']=="3col_left")

		{

		$sql_page1  = "SELECT * from pages where id='".$_REQUEST['id']."'";

		$result1 = $connection->createCommand($sql_page1)->query();

		

		$sql  = "SELECT * from projects ";

		$res = $connection->createCommand($sql)->query();

		

		$sql_news  = "SELECT * from latest_news where status=1 OR status='active'";

		$result = $connection->createCommand($sql_news)->query();

			

			

		$this->render('3col-left',array('content'=>$result1,'projects'=>$res,'news'=>$result));

		}


	}

	

	

	 function actionView_gallery()

	 {

	

		

		$this->layout='//layouts/front';

	    $this->render('view_gallery');

		 

	}

	function actionV_tour()

	 {

	

		

		$this->layout='//layouts/front';

	    $this->render('v-tour');

		 

	}

	 function actionTabs()

	 {

	

		

		$this->layout='//layouts/front';

	    $this->render('tabs');

		 

	}

	

	public function actionGallery_list()

	{	

	

	$this->layout='//layouts/front';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM gallery";

	$result_projects = $connection->createCommand($sql_projects)->queryAll();

	$this->render('gallery_list',array('gallery'=>$result_projects));

	  	

	}	

	

	public function actionSend()

	{

		$error = '';

		



if((isset($_POST['name']) && empty($_POST['name'])) || (isset($_POST['email']) && empty($_POST['email'])) || (isset($_POST['message']) 	&& empty($_POST['message'])))

		{

			$error = 'Please complete all required fields <br />';

		}

	

		

		if(isset($_POST['email']) && !empty($_POST['email']) &&  !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 

			$error .= 'Please enter valid Email Address<br>';

		}

		

		$query="INSERT INTO message(name,email,message) VALUES('$_POST[name]','$_POST[email]','$_POST[message]'";

		if(mysql_query($query))

		{

			

		}

		

		

	}

	//////////////////////////EMAIL SUBCRIPTION//////////////

	

	public function actionSubcribe()

	{
		
			$connection = Yii::app()->db;
		$email=$_POST['email'];
       if(empty($email))
	   {
		$error='Please Enter Required Fields';
     	}

		$date=date('d-m-Y');
        if(empty($error)){
		$sql="INSERT INTO subcription(email,date) VALUES('".$email."','".$date."')";
		 $command = $connection -> createCommand($sql);
         $command -> execute();
    
		 
		
}
else{
		echo $error;
		
		}
				

		

	}

	

	

	public function actionDashboard()

	{

		if(isset(Yii::app()->session['user_array']))

		{

			$error = '';

			$arr = array();

			$this->layout='column2';

			$entity_dataset =array();

			$document_data = $this->GetDocument(Yii::app()->session['user_array']['user_id']);

			$dataset=(json_decode($document_data));

			if(isset($dataset))

			{

				foreach($dataset->data as $data) {

				if(isset($data->entities))

				{

					foreach($data->entities as $entities) {

							$current = date("Y-m-d", strtotime($data->publishedDate));

							$mod_date = time() + ( 24 * 60 * 60);

			

							if(in_array($entities->disambiguated_name,$arr, true))

							{

								$arr_exist_at = array_search($entities->disambiguated_name, $arr);

								$counter_array = count($entity_dataset[$arr_exist_at]['values']);

								

								$dtt = date("Y-m-d",strtotime($data->publishedDate) );

								$entity_dataset[$arr_exist_at]['values'][$counter_array][0] = strtotime( $data->publishedDate )*1000;

								$entity_dataset[$arr_exist_at]['values'][$counter_array][1] = round( $entities->frequency ,2);

							}

								

							else {

								$arr[] = $entities->disambiguated_name;

								

								$dtt = date("Y-m-d",strtotime($data->publishedDate) );

								

								$entity_dataset[] =  array(

															'key' => $entities->disambiguated_name,

															'values' => array(

																			array( time() * 1000, 0),

																					array(

																							( strtotime( $data->publishedDate ) ) * 1000  , round((( $entities->doccount )),2))));

																						

							}

					} // END FOREACH - ENTITIES

				}

			

		}

			}else

			{

			   $entity_dataset = '';	

			}

		

			$dataset_array = $dataset->data;

			$this->render('dashboard',array('document_data'=>$dataset_array,'entity_data'=>$entity_dataset));

		}else

		{

			 $this->redirect(array('index'));

		}

		

	}



	

	public function actionPieChart()

	{

			$document_data = $this->GetDocument(Yii::app()->session['user_array']['user_id']);

			$arr=(json_decode($document_data));

			$counter =1;

			$result = array();

			$count_entity = '0';

		

			foreach($arr->data as $data) {

				

				 foreach($data->source as $entities) {

				

					$result[] =  $entities;

					 break;

			 }

		 } 

		

			$result_data = array();

			$total_array = array_count_values($result);

			foreach ($total_array  as $key => $value)  

			  $result_data[] =  array('sources'=>$key,'results'=>number_format((($value/$arr->stats->found)*100),2),'total_results'=>$value); 

			echo json_encode($result_data);

			exit;

	}

	

	public $layout='//layouts/front';	

	public function actionWeb()

	

	{

		

		$this->layout='column3';

		$this->render('web');

	}



	

	public function actionProject_details()

	{	

	$connection = Yii::app()->db;  

		$sql_project  = "SELECT * from projects WHERE id='".$_REQUEST['id']."'";

		

			$result_projects = $connection->createCommand($sql_project)->query();

			$this->render('project_details',array('projects'=>$result_projects));

	}

	public function actionNews_details()

	{	

	$connection = Yii::app()->db;  

		$sql_project  = "SELECT * from latest_news where status='Active' AND id='".$_REQUEST['id']."'";

		$result_projects = $connection->createCommand($sql_project)->query();

		$this->render('newsevent',array('projects'=>$result_projects));

	}

	

	public function actionNewsevent()

	{	

	$connection = Yii::app()->db;  

		$sql_project  = "SELECT * from latest_news where status='Active'";

		$result_projects = $connection->createCommand($sql_project)->query();

		$this->render('newsevent',array('projects'=>$result_projects));

	}

    public function actionCenter_details()

	{	

	$connection = Yii::app()->db;  

		$sql  = "SELECT * from sales_center";

		

			$result = $connection->createCommand($sql)->queryAll();

			$this->render('center_details',array('center'=>$result));

	}



	 

	public function loadModel($id)

	{

		$model=User::model()->findByPk($id);

		if($model===null)

			throw new CHttpException(404,'The requested page does not exist.');

		return $model;

	}



	/**

	 * Performs the AJAX validation.

	 * @param User $model the model to be validated

	 */

	protected function performAjaxValidation($model)

	{

		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')

		{

			echo CActiveForm::validate($model);

			Yii::app()->end();

		}

	}

}