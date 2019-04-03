<?php



class SettingController extends Controller

{

	

	/**

	 * Creates a new model.

	 * If creation is successful, the browser will be redirected to the 'view' page.

	 */

	 

	public function actionCreate()

	{

		if(Yii::app()->session['user_array']['per1']=='1')

			{

		

		

		

		$error = '';

		 $connection = Yii::app()->db;

		if ((isset($_POST['ownername']) && empty($_POST['ownername'])) || (isset($_POST['mobile']) && empty($_POST['mobile']))|| (isset($_POST['phone']) && empty($_POST['phone']))|| (isset($_POST['email']) && empty($_POST['email']))|| (isset($_POST['message']) && empty($_POST['message']))|| (isset($_POST['address']) && empty($_POST['address']))|| (isset($_POST['facebook']) && empty($_POST['facebook']))|| (isset($_POST['twitter']) && empty($_POST['twitter']))|| (isset($_POST['flicker']) && empty($_POST['flicker']))|| (isset($_POST['googleplus']) && empty($_POST['googleplus'])))

		{

			$error = 'Please complete all required fields <br />';

		}

			

		

		if(empty($error))

		        {

				  

				$ownername = mysql_real_escape_string($_POST['ownername']);				

			    $mobile = mysql_real_escape_string($_POST['mobile']);

			    $phone = mysql_real_escape_string($_POST['phone']);

			    $email = mysql_real_escape_string($_POST['email']);

			    $message = mysql_real_escape_string($_POST['message']);

			    $address = mysql_real_escape_string($_POST['address']);

			    $facebook = mysql_real_escape_string($_POST['facebook']);

			    $twitter = mysql_real_escape_string($_POST['twitter']);

			    $flicker = mysql_real_escape_string($_POST['flicker']);

			    $googleplus = mysql_real_escape_string($_POST['googleplus']);

			  

				  

                $sql  = "INSERT INTO setting(ownername,mobile,phone,email,message,address,facebook,twitter,flicker,googleplus) VALUES('".$ownername."','".$mobile."','".$phone."','".$email."','".$message."','".$address."','".$facebook."','".$twitter."','".$flicker."','".$googleplus."')";		

                $command = $connection -> createCommand($sql);

                $command -> execute();

				$this->redirect(array('setting/setting_list'));

				

				

				}

		

		

			}

			exit;

	}

	public function actionSetting_list()

	{	

	if(Yii::app()->session['user_array']['per1']=='1')

			{

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql = "SELECT * FROM setting";

	$result_setting = $connection->createCommand($sql)->query();

	$this->render('setting_list',array('setting'=>$result_setting));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	public function actionUpdate_setting()

	{

		if(Yii::app()->session['user_array']['per1']=='1')

			{

	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql = "SELECT * FROM setting where id=".$_GET['id'];

	$result = $connection->createCommand($sql)->query();

	$this->render('update_setting',array('update_setting'=>$result));

		}else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }

	

	

	

	

	

	

	/////////////////////////// function for update project 





		public function actionUpdate_set()

	     {

			 if(Yii::app()->session['user_array']['per1']=='1')

			{

		

		    $connection = Yii::app()->db;

	   

		    $id=$_POST['id']; 

		   

		

			 $ownername=$_POST['ownername'];

			$mobile=$_POST['mobile'];

			$phone=$_POST['phone'];

			$email=$_POST['email'];

			$message=$_POST['message'];

		    $subcriptiontext=$_POST['subcriptiontext'];

			$address=$_POST['address'];

		    $facebook=$_POST['facebook'];

				

			$twitter=$_POST['twitter'];

			$flicker=$_POST['flicker'];

			$googleplus=$_POST['googleplus'];

					

				 $sql_update = "UPDATE setting SET ownername ='$ownername',mobile ='$mobile',phone ='$phone',email ='$email',message ='$message',subcriptiontext ='$subcriptiontext',address ='$address',facebook ='$facebook',twitter ='$twitter',flicker ='$flicker',googleplus ='$googleplus' WHERE id =".$id;

	

    		 $command = $connection -> createCommand($sql_update);

              $command -> execute();

			  $this->redirect(array("setting_list"));	

	   }



	

		 }

	/**

	 * Updates a particular model.

	 * If update is successful, the browser will be redirected to the 'view' page.

	 * @param integer $id the ID of the model to be updated

	 */

	 function actionEdit()

	 {

		 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{

			$this->layout='column3';

			$this->render('edit_register');

		}

		 

	}

	public function actionUpdate($id)

	{

		$model=$this->loadModel($id);



		// Uncomment the following line if AJAX validation is needed

	



		if(isset($_POST['User']))

		{

			$model->attributes=$_POST['User'];

			if($model->save())

				$this->redirect(array('view','id'=>$model->user_id));

		}



		$this->render('update',array(

			'model'=>$model,

		));

	}

	



	/**

	 * Deletes a particular model.

	 * If deletion is successful, the browser will be redirected to the 'admin' page.

	 * @param integer $id the ID of the model to be deleted

	 */

	public function actionDelete($id)

	{

		$this->loadModel($id)->delete();



		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser

		if(!isset($_GET['ajax']))

			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

	}



	public function actionIndex()

	{

		

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{

			 $this->redirect(array('datasource'));

		}else

		{

			$error = '';

			$layout='//layouts/column1';

			$this->render('index');

		}

	}

	

	

	

	

	

	public function actionSetting()

	{

		if(Yii::app()->session['user_array']['per1']=='1')

			{

		

					

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	

				$this->render('setting');

			

			}

			else{

				$this->redirect(array('user/user'));

				

			}

			}

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

