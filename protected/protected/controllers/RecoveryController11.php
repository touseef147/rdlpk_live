<?php



class RecoveryController extends Controller

{
	
	
			 	public function actionUpdatecdate()

	      {

		if(Yii::app()->session['user_array']['per7']=='1')

			{

	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM projects where id=".$_GET['id'];

	$result_projects = $connection->createCommand($sql_projects)->query();

	$this->render('updatecdate',array('update_project'=>$result_projects));

		}else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }

		public function actionUpdate_proj()

	     {

		 $connection = Yii::app()->db;

			$sql_update = "UPDATE projects SET cut_date='".$_POST['cut_date']."' WHERE id =".$_POST['id'];
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			  $this->redirect(array("defaulter_list"));	
	   }

	 	  public function actionGraphical_view(){
			 if((Yii::app()->session['user_array']['per31']=='1')&& isset(Yii::app()->session['user_array']['username'])){
	
		$connection = Yii::app()->db; 
        // return $cmdrow->queryAll();
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
	
	   $this->render('graphical_view',array('projects'=>$result_projects));
			 }
	  }
	  
	 public function actionReceivable(){
	

		$connection = Yii::app()->db; 
     
		
       // return $cmdrow->queryAll();
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
	  //////////////////////////////////FUNCTION 3 END///////////////////////////////////////////
	 $this->render('receivable',array('projects'=>$result_projects));
	 
	  }
	    public function actionSearch_receivable_ajax()
	 	{
		$where='';
		$and=false;
			 
			if (!empty($_POST['cut_date'])){
			 $cut_date=$_POST['cut_date'];
			 }else{
				 
				 $cut_date=date('d-m-Y');
				 }
				 if (!empty($_POST['plotno'])){
			 $plotno=$_POST['plotno'];
			 }else{
				 
				 $plotno='';
				 }
		$connection = Yii::app()->db; 
	  $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
		
		
		
					 
	///////////////////////FUNCTION 1 END/////////////////////////
	///////////////////////FUNCTIOM 2 START//////////////////////
		  $date=date("d-m-Y",strtotime($cut_date));
		 //echo $date;exit();
		  $type=3;
		$model=array();
      //////////////////////////////////FUNCTION 2 END/////////////////////////////// 
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
        $fixedcolumns.="  memberplot.member_id,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,plots.price,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email,  size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";
        $fixedcolumns.=" ,duepayments.Due_Amount, payments.Received_Amount";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  (Select
			  Sum(installpayment.dueamount) As Due_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <=
			  Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) duepayments 
			  
			on duepayments.plot_id = memberplot.plot_id left join
			  
			  (Select
			  Sum(installpayment.paidamount) As Received_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d') <=
			  Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) payments 
			  
			on payments.plot_id = memberplot.plot_id  ";

		$where="where plots.project_id='".$_POST['project_name']."'and memberplot.plotno LIKE '%".$plotno."%'";
		  $sorting.=" Order By  memberplot.plotno ";
		 $sql_member = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting; 
	
		$result_members = $connection->createCommand($sql_member)->query();
		 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();
			$tplotprice=0;
			$tdueamount=0;
			$tdiscount=0;
			$balance_amount=0;
			$treceivedamount=0;
            $tbalance_amount=0;
			$balance_percentage=0;
			$tbalance_percentage=0;
			foreach($result_members as $key){
			$tdiscount=$key['discount']+$tdiscount;
			$tplotprice=$key['price']+$tplotprice;
            $tdueamount=$key['Due_Amount']+$tdueamount;
			$treceivedamount=$key['Received_Amount']+$treceivedamount;
			//$balance_amount=$key['Due_Amount']-$key['Received_Amount'];
			$balance_amount=$key['price']-$key['discount']-$key['Received_Amount'];
                          $tbalance_amount=$balance_amount+$tbalance_amount;
		 	$tbalancedue=$key['Due_Amount']-$key['Received_Amount']+$tbalancedue;
                        $balance_amount=$key['price']-$key['discount']-$key['Received_Amount'];
		/*	if(empty($balance_percentage)){
				$balance_percentage=($balance_amount/$key['price'])*100;
				}else{
					 $balance_percentage=0;
					}*/
			$count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><strong>'.$key['phone'].'</strong><td style="text-align:right">'.number_format(floatval($key['price'])).'</td><td style="text-align:right">'.number_format(floatval($key['discount'])).'</td><td style="text-align:right">'.number_format($key['Due_Amount']).'</td><td style="text-align:right">'.number_format($key['Received_Amount']).'</td>
<td style="text-align:right">'.number_format($key['Due_Amount']-$key['Received_Amount']).'</td><td style="text-align:right">'.number_format($balance_amount).'</td>
                          
                        <td>';
			if($key['Due_Amount']>0){
				$balance_percentage=$balance_amount/$key['price']*100;
				echo ROUND($balance_percentage,2);
				}else{
					echo'0';
					}
			 echo'%</td></tr>';
			}
			echo'<tr><td><strong>Total</strong>:</td><td ></td><td></td><td></td><td></td><td align="right"><strong>'.number_format($tplotprice).'</strong></td>
			<td style="text-align:right"><strong>'.number_format($tdiscount).'</strong></td><td style="text-align:right"><strong>'.number_format($tdueamount).'</strong></td>
			<td style="text-align:right"><strong>'.number_format($treceivedamount).'</strong></td>
                         <td style="text-align:right"><strong>'.number_format($tbalancedue).'</strong></td>
                        <td style="text-align:right"><strong>'.number_format($tbalance_amount).'</strong></td>
			<td><strong>';echo (ROUND($tbalance_amount/$tplotprice*100,2)).'%';'</strong></td>
			</tr>';
	}

	
	}

	  /////////OVERALL GRAPH REPORT////////////////////////
	 public function actionOverall_graph_report(){
		$connection = Yii::app()->db; 
        // return $cmdrow->queryAll();
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
	  //////////////////////////////////FUNCTION 3 END///////////////////////////////////////////
	   $this->render('overall_graph_report',array('projects'=>$result_projects));
	  }
	 public function actionSearch_overall_graph()
	 	{
			 $date=date('d-m-Y', strtotime(date('Y-m')));
		$where='';
		$and=false;
			 
			
				 if (!empty($_POST['plotno'])){
			 $plotno=$_POST['plotno'];
			 }else{
				 
				 $plotno='';
				 }
		$connection = Yii::app()->db; 
	    $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
		  //$date=date("d-m-Y",strtotime($cut_date));
		  //$date="date(d-m-Y)"-3;
		 //echo $date;exit();
		  $type=3;
		$model=array();
      //////////////////////////////////FUNCTION 2 END/////////////////////////////// 
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
        $fixedcolumns.="  memberplot.member_id,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,plots.price,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email,  size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";
        $fixedcolumns.=" ,duepayments.Due_Amount, payments.Received_Amount";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  (Select
			  Sum(installpayment.dueamount) As Due_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <=
			  Date_Format(Str_To_Date('".$date. "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) duepayments 
			  
			on duepayments.plot_id = memberplot.plot_id left join
			  
			  (Select
			  Sum(installpayment.paidamount) As Received_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d') <=
			  Date_Format(Str_To_Date('" .$date. "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) payments 
			  
			on payments.plot_id = memberplot.plot_id  ";

		$where="where plots.project_id='".$_POST['project_name']."'";
		  $sorting.=" Order By  memberplot.plotno ";
		  $sql_member = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting; 
	//exit();
		$result_members = $connection->createCommand($sql_member)->query();
		
	$count=0;

	if ($result_members!=''){
			$home=Yii::app()->request->baseUrl; 
			$check=1;
 		   $res=array();
			$tplotprice=0;
			$tdueamount=0;
			$tdiscount=0;
			$balance_amount=0;
			$treceivedamount=0;
            $tbalance_amount=0;
			$balance_percentage=0;
			$tbalance_percentage=0;
			foreach($result_members as $key){
			$tdiscount=$key['discount']+$tdiscount;
			$tplotprice=$key['price']+$tplotprice;
            $tdueamount=$key['Due_Amount']+$tdueamount;
			$treceivedamount=$key['Received_Amount']+$treceivedamount;
			$balance_amount=$key['Due_Amount']-$key['Received_Amount'];
			$tbalance_amount=$balance_amount+$tbalance_amount;
		 	
		/*	if(empty($balance_percentage)){
				$balance_percentage=$balance_amount/$key['Due_Amount']*100;
				}else{
					 $balance_percentage=0;
					}*/
			$count++;?>
			
			<?php echo $count.' result found';
			/* echo ' 
<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><strong>'.$key['phone'].'</strong><td>'.$key['email'].'</td><td style="text-align:right">'.number_format(floatval($key['price'])).'</td><td style="text-align:right;">'.number_format(floatval($key['discount'])).'</td><td style="text-align:right">'.number_format($key['Due_Amount']).'</td><td style="text-align:right">'.number_format($key['Received_Amount']).'</td><td style="text-align:right">'.number_format($balance_amount).'</td><td>';*/
			if($key['Due_Amount']>0){
				$balance_percentage=$balance_amount/$key['Due_Amount']*100;
				echo ROUND($balance_percentage,2);
				}else{
					echo'0';
					}
			 echo'%</td></tr>';
			}
			$tdim=($tdiscount/1000000);
			$trim=($treceivedamount/1000000);
			$nbp=$tplotprice-$tdiscount-$treceivedamount;
			$nbpim=($nbp/1000000);
			echo'<tr style="font-weight:bold;">
      				<td style="background-color:#B3B3FF; border-top:inset; font-size:16px; font-weight:bold; text-align:center;" colspan="6">Total Value Breakup Upto Date</td>
    				</tr>
			  	
				  <tr>
				   <td style="width:6%;"><table width="100%"><tr>Status</tr></table></td>
				   <td style="width:18%;"><table width="100%"><tr>Account Head </tr></table></td>
				   <td style="width:14%;"><table width="100%"><tr>Amount (Million)</tr></table></td>
				   <td style="width:8%;"><table width="100%"><tr>wt %age</tr></table></td>
				   <td><table width="100%"><tr>Remarks</tr></table></td>
				   </tr>					   
				   <tr>
				 <td><img src="'.Yii::app()->request->baseUrl.'/images/receieved-icon.png" width="30"  /></td>
				   <td><table width="100%"><tr>Total Received </tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.(number_format($trim,2)).'</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.(ROUND(($treceivedamount/$tplotprice*100),2)).'%</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr></tr></table></td>
				   </tr>
				  <tr>
				   <td><img src="'.Yii::app()->request->baseUrl.'/images/discount-icon.png" width="30" /></td>
				   <td><table width="100%"><tr>Discount (Net Payment)</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.number_format($tdim,2).'</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.(ROUND(($tdiscount/$tplotprice*100),2)).'%</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr></tr></table></td>
				   </tr>
				  <tr>
				   <td><img src="'.Yii::app()->request->baseUrl.'/images/net-balance-icon.png" width="30"  /></td>
				   <td><table width="100%"><tr>Net Balance Receivable</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.number_format($nbpim,2).'</tr></table></td>
				   <td style="text-align:right" ><table width="100%"><tr>'.(ROUND(($nbp/$tplotprice*100),2)).'%</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr></tr></table></td>
				   </tr>
				   <tr>';
				  $recperc=(ROUND(($treceivedamount/$tplotprice*100),1));
				  $nbperc=(ROUND(($nbp/$tplotprice*100),1));
				  $tdisperc=(ROUND(($tdiscount/$tplotprice*100),1));
				   echo'<td></td><td><table width="100%"><tr>Total Sold Value</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr >'.($tdim+$trim+$nbpim).'</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.($recperc+$nbperc+$tdisperc).'%</tr></table></td>
				   
				   <td><table width="100%"><tr></tr></table></td>
				   </tr>';}?>
                   <tr >
				   
                   <td colspan="5" >
                   <table width="100%">
				
                    <tr id="piechart" style="height: 300px;">
					
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart);
                      function drawChart() {
       				 var data = google.visualization.arrayToDataTable([
					  ['Task', 'Hours per Day'],
					  ['Total Received',<?php echo $trim?>],
					  ['Discount',      <?php echo $tdim?>],
					  ['Net Balance Receivable' ,  <?php echo $nbpim?>],			 
					]);
					var options = {
					  title: 'Total Value Breakup Upto Date'
					};
						var chart = new google.visualization.PieChart(document.getElementById('piechart'));		
						chart.draw(data, options);
					  }
					    </script>
                        </tr>
                        
                        </table></td></tr>
   						
	<?php
				
				 }
	//////////////////////////////////////////////////////
	
	/////////////RECEIPT VS DUE GRAPH REPORT//////////////
	 public function actionReceipt_due_report(){
		$connection = Yii::app()->db; 
        // return $cmdrow->queryAll();
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
	  //////////////////////////////////FUNCTION 3 END///////////////////////////////////////////
	   $this->render('receipt_due_report',array('projects'=>$result_projects));
		}
	
	public function actionSearch_receipt_vs_due_graph()
	 	{
			 $date=date('d-m-Y', strtotime(date('Y-m')));
		$where='';
		$and=false;
			 
			
				 if (!empty($_POST['plotno'])){
			 $plotno=$_POST['plotno'];
			 }else{
				 
				 $plotno='';
				 }
		$connection = Yii::app()->db; 
	    $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
		  //$date=date("d-m-Y",strtotime($cut_date));
		  //$date="date(d-m-Y)"-3;
		 //echo $date;exit();
		  $type=3;
		$model=array();
      //////////////////////////////////FUNCTION 2 END/////////////////////////////// 
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
        $fixedcolumns.="  memberplot.member_id,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,plots.price,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email,  size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";
        $fixedcolumns.=" ,duepayments.Due_Amount, payments.Received_Amount";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  (Select
			  Sum(installpayment.dueamount) As Due_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <=
			  Date_Format(Str_To_Date('".date('d-m-Y', strtotime($_POST['cut_date'])). "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) duepayments 
			  
			on duepayments.plot_id = memberplot.plot_id left join
			  
			  (Select
			  Sum(installpayment.paidamount) As Received_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d') <=
			  Date_Format(Str_To_Date('" .date('d-m-Y', strtotime($_POST['cut_date'])). "', '%d-%m-%Y'), '%Y-%m-%d')
			  
			Group By
			  installpayment.plot_id) payments 
			  
			on payments.plot_id = memberplot.plot_id  ";

		$where="where plots.project_id='".$_POST['project_name']."'";
		  $sorting.=" Order By  memberplot.plotno ";
		  $sql_member = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting; 
	//exit();
		$result_members = $connection->createCommand($sql_member)->query();
		
	$count=0;

	if ($result_members!=''){
			$home=Yii::app()->request->baseUrl; 
			$check=1;
 		   $res=array();
			$tplotprice=0;
			$tdueamount=0;
			$tdiscount=0;
			$balance_amount=0;
			$treceivedamount=0;
            $tbalance_amount=0;
			$balance_percentage=0;
			$tbalance_percentage=0;
			foreach($result_members as $key){
			$tdiscount=$key['discount']+$tdiscount;
			$tplotprice=$key['price']+$tplotprice;
            $tdueamount=$key['Due_Amount']+$tdueamount;
			$treceivedamount=$key['Received_Amount']+$treceivedamount;
			$balance_amount=$key['Due_Amount']-$key['Received_Amount'];
			$tbalance_amount=$balance_amount+$tbalance_amount;
		 	
		/*	if(empty($balance_percentage)){
				$balance_percentage=$balance_amount/$key['Due_Amount']*100;
				}else{
					 $balance_percentage=0;
					}*/
			$count++;?>
			
			<?php echo $count.' result found';
			/* echo ' 
<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><strong>'.$key['phone'].'</strong><td>'.$key['email'].'</td><td style="text-align:right">'.number_format(floatval($key['price'])).'</td><td style="text-align:right;">'.number_format(floatval($key['discount'])).'</td><td style="text-align:right">'.number_format($key['Due_Amount']).'</td><td style="text-align:right">'.number_format($key['Received_Amount']).'</td><td style="text-align:right">'.number_format($balance_amount).'</td><td>';*/
			if($key['Due_Amount']>0){
				$balance_percentage=$balance_amount/$key['Due_Amount']*100;
				echo ROUND($balance_percentage,2);
				}else{
					echo'0';
					}
			 echo'%</td></tr>';
			}
			$tbalance_overdueinm=($balance_amount/1000000);
			$tdim=($tdiscount/1000000);
			$tdueim=($tdueamount/1000000);
			$trim=($treceivedamount/1000000);
			$nbp=$tplotprice-$tdiscount-$treceivedamount;
			$nbpim=($nbp/1000000);
			echo'<tr style="font-weight:bold;">
      				<td style="background-color:#B3B3FF; font-size:16px; font-weight:bold; text-align:center;" colspan="5">Receipt vs Due Payments 
					Upto:'.date('d-m-Y', strtotime($_POST['cut_date'])).'</td>
    				</tr>
			  	  <tr>
				   <td style="width:4%"><table width="100%"><tr>Status</tr></table></td>
				   <td style="width:17%"><table width="100%"><tr>Account Head</tr></table></td>
				   <td style="width:12%"><table width="100%"><tr>Amount (Million)</tr></table></td>
				   <td style="width:5%"><table width="100%"><tr>wt %age</tr></table></td>
				   <td><table width="100%"><tr>Remarks</tr></table></td>
				   </tr>					   
				   <tr>
				    <td><img src="'.Yii::app()->request->baseUrl.'/images/receieved-icon.png" width="30"  /></td>
				   <td><table width="100%"><tr>Total Received</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.(number_format($trim,2)).'</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.(ROUND(($treceivedamount/$tplotprice*100),2)).'%</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr></tr></table></td>
				   </tr>
				  
				  <tr>
				  <td><img src="'.Yii::app()->request->baseUrl.'/images/balance-overdue-icon.png" width="30"  /></td>
				   <td><table width="100%"><tr>Balance Overdue</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.number_format($nbpim,2).'</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.(ROUND(($nbp/$tplotprice*100),2)).'%</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr></tr></table></td>
				   </tr>
				   <tr>
				   
				   ';
				  $recperc=(ROUND(($treceivedamount/$tplotprice*100),1));
				  $nbperc=(ROUND(($nbp/$tplotprice*100),1));
				   echo'<td></td><td><table width="100%"><tr>Total Payable(Due)</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr >'.number_format($tdim+$trim+$nbpim,2).'</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.number_format($recperc+$nbperc,2).'%</tr></table></td>
				   
				   <td><table width="100%"><tr></tr></table></td>
				   </tr>';}?>
                   <tr >
				   
                   <td colspan="5" >
                   <table width="100%">
				
                    <tr id="piechart" style="height: 300px;">
					
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart);
                      function drawChart() {
       				 var data = google.visualization.arrayToDataTable([
					  ['Task', 'Hours per Day'],
					  ['Total Received',<?php echo $trim;?>],
					  ['Balance  Overdue',      <?php echo $tbalance_overdueinm;?>],
					  ['Net Balance' ,  <?php echo $nbpim;?>],			 
					]);
					var options = {
					  title: 'Receipt vs Due Payments'
					};
						var chart = new google.visualization.PieChart(document.getElementById('piechart'));		
						chart.draw(data, options);
					  }
					    </script>
                        </tr>
                        
                        </table></td></tr>
   						
	<?php
				
				 }
	
	///////////////////////////////////////////////////////
	
	
	////////////////////RECOVERIES CUT DATE///////////
	
		 public function actionRecoveries_cutdate_report(){
		$connection = Yii::app()->db; 
        // return $cmdrow->queryAll();
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
	  //////////////////////////////////FUNCTION 3 END///////////////////////////////////////////
	   $this->render('recoveries_cutdate_report',array('projects'=>$result_projects));
		}
	
	    public function actionSearch_receipt_uptodate_graph()
	 	{
			  $date=date('d-m-Y', strtotime(date('Y-m')." -1 month"));
			//exit;
			 //$date=date('d-m-Y');
		$where='';
		$and=false;
			 
			
				 if (!empty($_POST['plotno'])){
			 $plotno=$_POST['plotno'];
			 }else{
				 
				 $plotno='';
				 }
		$connection = Yii::app()->db; 
	    $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
		  //$date=date("d-m-Y",strtotime($cut_date));
		  //$date="date(d-m-Y)"-3;
		 //echo $date;exit();
		  $type=3;
		$model=array();
      //////////////////////////////////FUNCTION 2 END/////////////////////////////// 
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
        $fixedcolumns.="  memberplot.member_id,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,plots.price,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email, memberplot.status, size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";
        $fixedcolumns.=" ,paymentsupto.Received_Amount_Upto, payments.Received_Amount_During";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  (Select
			  Sum(installpayment.paidamount) As Received_Amount_Upto,
			  installpayment.plot_id
			From  installpayment
			Where installpayment.paid_date <='".$date."'
			Group By
			  installpayment.plot_id) paymentsupto 
			  
			on paymentsupto.plot_id = memberplot.plot_id
			
			 left join
			  
			  (Select
			  Sum(installpayment.paidamount) As Received_Amount_During,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d')  >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH
          AND  Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d') < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY  
			Group By
			  installpayment.plot_id) payments 
			  
			on payments.plot_id = memberplot.plot_id  ";

		$where="where plots.project_id='".$_POST['project_name']."'";
		  $sorting.=" Order By  memberplot.plotno ";
 			 $sql_member = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting; 
	//exit();
		$result_members = $connection->createCommand($sql_member)->query();
		
	$count=0;

	if ($result_members!=''){
			$home=Yii::app()->request->baseUrl; 
			$check=1;
 		   $res=array();
			$tplotprice=0;
		
		
			
			$treceivedamountduring=0;
			$treceivedamountupto=0;
          
			$balance_percentage=0;
			$tbalance_percentage=0;
			foreach($result_members as $key){
			$key['Received_Amount_Upto'];
			
			$tplotprice=$key['price']+$tplotprice;
          
			$treceivedamountduring=$key['Received_Amount_During']+$treceivedamountduring;
			$treceivedamountupto=$key['Received_Amount_Upto']+$treceivedamountupto;
			
		 	
		/*	if(empty($balance_percentage)){
				$balance_percentage=$balance_amount/$key['Due_Amount']*100;
				}else{
					 $balance_percentage=0;
					}*/
			$count++;?>
			
			<?php 
			} //echo $treceivedamountupto;exit;
			
			$trdim=($treceivedamountduring/1000000);
	        $truim=($treceivedamountupto/1000000);
			
			 $totalamount=$trdim+$trdim;
			  $duringperc=(ROUND((($treceivedamountduring/$tplotprice)*100),1));
				  $uptoperc=(ROUND((($treceivedamountupto/$tplotprice)*100),1));
				 
			echo'<tr style="font-weight:bold;">
      				<td style="background-color:#B3B3FF; font-size:16px; font-weight:bold; text-align:center;" colspan="5">Recoveries Uptodate
					Upto:'.date('d-m-Y').'</td>
    				</tr>
			  	  <tr>
				   <td style="width:4%;"><table width="100%"><tr>Status</tr></table></td>
				   <td style="width:17%;"><table width="100%"><tr>Account Head</tr></table></td>
				   <td style="width:12%;"><table width="100%"><tr>Amount (Million)</tr></table></td>
				   <td style="width:5%;"><table width="100%"><tr>wt %age</tr></table></td>
				   <td><table width="100%"><tr>Remarks</tr></table></td>
				   </tr>					   
				   <tr>
				    <td><img src="'.Yii::app()->request->baseUrl.'/images/receieved-icon.png" width="30"  /></td>
				   <td><table width="100%"><tr>Receipts upto:&nbsp;'.$date.'</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.(number_format($truim,2)).'</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.$uptoperc.'%</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr></tr></table></td>
				   </tr>
				  
				  <tr>
				  <td><img src="'.Yii::app()->request->baseUrl.'/images/balance-overdue-icon.png" width="30"  /></td>
				   <td><table width="100%"><tr>Receipts during:&nbsp;<strong style="color:green;">'.date("F", mktime(0, 0, 0, date('m'), 1)).'</strong></tr></table></td>
				   <td style="text-align:right"><table width="100%">'.(number_format($trdim,2)).'<tr></tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.$duringperc.' %</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr></tr></table></td>
				   </tr>';
				  
				    echo'<tr>
				  <td></td>
				   <td><table width="100%"><tr>Total Receipts today </tr></table></td>
				   <td style="text-align:right"><table width="100%">'.(number_format($totalamount,2)).'<tr></tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.($duringperc+$uptoperc).'%</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr></tr></table></td>
				   </tr>
				  
				   ';
				 
				 }?>
                   <tr >
				   
                   <td colspan="5" >
                   <table width="100%">
				
                    <tr id="piechart" style="height: 300px;">
					
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart);
                      function drawChart() {
       				 var data = google.visualization.arrayToDataTable([
					  ['Task', 'Hours per Day'],
					  ['Receipts Upto',<?php echo $uptoperc;?>],
					  ['Receipts During ', <?php echo $duringperc;?>],
								 
					]);
					var options = {
					  title: 'Recoveries Uptodate'
					};
						var chart = new google.visualization.PieChart(document.getElementById('piechart'));		
						chart.draw(data, options);
					  }
					    </script>
                        </tr>
                        
                        </table></td></tr>
   						
	<?php
				
				 }
	
	
	
	
	////////////////////////////////////////////////////



	////////////////////RECEIPT UPTO DATE///////////
	
		 public function actionReceipt_uptodate_report(){
		$connection = Yii::app()->db; 
        // return $cmdrow->queryAll();
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
	  //////////////////////////////////FUNCTION 3 END///////////////////////////////////////////
	   $this->render('receipt_uptodate_report',array('projects'=>$result_projects));
		}
	
	    public function actionSearch_recoveries_cutdate_graph()
	 	{
			  //$date=date('d-m-Y', strtotime(date('Y-m')." month"));
			 //$date=date('d-m-Y');
		$where='';
		$and=false;
			 
			
				 if (!empty($_POST['plotno'])){
			 $plotno=$_POST['plotno'];
			 }else{
				 
				 $plotno='';
				 }
		$connection = Yii::app()->db; 
	    $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
		  //$date=date("d-m-Y",strtotime($cut_date));
		  //$date="date(d-m-Y)"-3;
		 //echo $date;exit();
		  $type=3;
		$model=array();
      //////////////////////////////////FUNCTION 2 END/////////////////////////////// 
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
        $fixedcolumns.="  memberplot.member_id,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,plots.price,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email, memberplot.status, size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";
        $fixedcolumns.=" ,duepayments.Due_Amount, payments.Received_Amount";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  (Select
			  Sum(installpayment.dueamount) As Due_Amount,
			  installpayment.plot_id
			From
			  installpayment
			
			Group By
			  installpayment.plot_id) duepayments 
			  
			on duepayments.plot_id = memberplot.plot_id left join
			  
			  (Select
			  Sum(installpayment.paidamount) As Received_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d') =
			  Date_Format(Str_To_Date('" .date('d-m-Y', strtotime($_POST['cut_date'])). "', '%d-%m-%Y'), '%Y-%m-%d')
			  
			Group By
			  installpayment.plot_id) payments 
			  
			on payments.plot_id = memberplot.plot_id  ";

		$where="where plots.project_id='".$_POST['project_name']."' and memberplot.wlstatus=1";
		  $sorting.=" Order By  memberplot.plotno ";
		   $sql_member = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting; 
	//exit();
		$result_members = $connection->createCommand($sql_member)->query();
		
	$count=0;

	if ($result_members!=''){
			$home=Yii::app()->request->baseUrl; 
			$check=1;
 		   $res=array();
			$tplotprice=0;
			$tdueamount=0;
			$tdiscount=0;
			$balance_amount=0;
			$treceivedamount=0;
            $tbalance_amount=0;
			$balance_percentage=0;
			$tbalance_percentage=0;
			foreach($result_members as $key){
			$tdiscount=$key['discount']+$tdiscount;
			$tplotprice=$key['price']+$tplotprice;
            $tdueamount=$key['Due_Amount']+$tdueamount;
			$treceivedamount=$key['Received_Amount']+$treceivedamount;
			$balance_amount=$key['Due_Amount']-$key['Received_Amount'];
			$tbalance_amount=$balance_amount+$tbalance_amount;
		 	
		/*	if(empty($balance_percentage)){
				$balance_percentage=$balance_amount/$key['Due_Amount']*100;
				}else{
					 $balance_percentage=0;
					}*/
			$count++;?>
			
			<?php echo $count.' result found';
			/* echo ' 
<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><strong>'.$key['phone'].'</strong><td>'.$key['email'].'</td><td style="text-align:right">'.number_format(floatval($key['price'])).'</td><td style="text-align:right;">'.number_format(floatval($key['discount'])).'</td><td style="text-align:right">'.number_format($key['Due_Amount']).'</td><td style="text-align:right">'.number_format($key['Received_Amount']).'</td><td style="text-align:right">'.number_format($balance_amount).'</td><td>';*/
			if($key['Due_Amount']>0){
				$balance_percentage=$balance_amount/$key['Due_Amount']*100;
				echo ROUND($balance_percentage,2);
				}else{
					echo'0';
					}
			 echo'%</td></tr>';
			}
			$tdim=($tdiscount/1000000);
			$trim=($treceivedamount/1000000);
			$nbp=$tplotprice-$tdiscount-$treceivedamount;
			$nbpim=($nbp/1000000);
			echo'<tr style="font-weight:bold;">
      				<td style="background-color:#B3B3FF; font-size:16px; font-weight:bold; text-align:center;" colspan="5">Recoveries Uptodate
					Upto:'.date('d-m-y',strtotime($_POST['cut_date'])).'</td>
    				</tr>
			  	  <tr>
				   <td style="width:4%"><table width="100%"><tr>Status</tr></table></td>
				   <td style="width:17%"><table width="100%"><tr>Account Head</tr></table></td>
				   <td style="width:12%"><table width="100%"><tr>Amount (Million)</tr></table></td>
				   <td style="width:5%"><table width="100%"><tr>wt %age</tr></table></td>
				   <td><table width="100%"><tr>Remarks</tr></table></td>
				   </tr>					   
				   <tr>
				    <td><img src="'.Yii::app()->request->baseUrl.'/images/receieved-icon.png" width="30"  /></td>
				   <td><table width="100%"><tr>Recoveries After</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.(number_format($trim,2)).'</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.(fmod($treceivedamount,$tplotprice)).'%</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr></tr></table></td>
				   </tr>
				  
				  <tr>
				  <td><img src="'.Yii::app()->request->baseUrl.'/images/balance-overdue-icon.png" width="30"  /></td>
				   <td><table width="100%"><tr>Overdue Upto</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.number_format($nbpim,2).'</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.(fmod($nbp,$tplotprice)).'%</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr></tr></table></td>
				   </tr>
				   <tr>
				   
				   ';
				  $recperc=(fmod($treceivedamount,$tplotprice));
				  $nbperc=(fmod($nbp,$tplotprice));
				   echo'<td></td><td><table width="100%"><tr>Balance Overdue today</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr >'.($tdim+$trim+$nbpim).'</tr></table></td>
				   <td style="text-align:right"><table width="100%"><tr>'.($recperc+$nbperc).'%</tr></table></td>
				   
				   <td><table width="100%"><tr></tr></table></td>
				   </tr>';}?>
                   <tr >
				   
                   <td colspan="5" >
                   <table width="100%">
				
                    <tr id="piechart" style="height: 300px;">
					
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart);
                      function drawChart() {
       				 var data = google.visualization.arrayToDataTable([
					  ['Task', 'Hours per Day'],
					  ['Overdue Upto',<?php echo $nbpim?>],
					  ['Recoveries After',      <?php echo $trim?>],
								 
					]);
					var options = {
					  title: 'Recoveries Upto date'
					};
						var chart = new google.visualization.PieChart(document.getElementById('piechart'));		
						chart.draw(data, options);
					  }
					    </script>
                        </tr>
                        
                        </table></td></tr>
   						
	<?php
				
				 }
	
	
	
	
	
	
	////////////////////////////////////////////////////


	 public function actionSearch_prev_month()
	 	{
			 $date=date('d-m-Y', strtotime(date('Y-m')." -1 month"));
		$where='';
		$and=false;
			 
			
				 if (!empty($_POST['plotno'])){
			 $plotno=$_POST['plotno'];
			 }else{
				 
				 $plotno='';
				 }
		$connection = Yii::app()->db; 
	  $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
		
		
		
					 
	///////////////////////FUNCTION 1 END/////////////////////////
	///////////////////////FUNCTIOM 2 START//////////////////////
		  //$date=date("d-m-Y",strtotime($cut_date));
		  //$date="date(d-m-Y)"-3;
		 //echo $date;exit();
		  $type=3;
		$model=array();
      //////////////////////////////////FUNCTION 2 END/////////////////////////////// 
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
        $fixedcolumns.="  memberplot.member_id,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,plots.price,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email,  size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";
        $fixedcolumns.=" ,duepayments.Due_Amount, payments.Received_Amount";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  (Select
			  Sum(installpayment.dueamount) As Due_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') =
			  Date_Format(Str_To_Date('".$date. "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) duepayments 
			  
			on duepayments.plot_id = memberplot.plot_id left join
			  
			  (Select
			  Sum(installpayment.paidamount) As Received_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d') =
			  Date_Format(Str_To_Date('" .$date. "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) payments 
			  
			on payments.plot_id = memberplot.plot_id  ";

		$where="where plots.project_id='".$_POST['project_name']."'";
		  $sorting.=" Order By  memberplot.plotno ";
		   $sql_member = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting; 
	//exit();
		$result_members = $connection->createCommand($sql_member)->query();
		 
	$count=0;

	if ($result_members!=''){
			$home=Yii::app()->request->baseUrl; 
			$check=1;
 		   $res=array();
			$tplotprice=0;
			$tdueamount=0;
			$tdiscount=0;
			$balance_amount=0;
			$treceivedamount=0;
            $tbalance_amount=0;
			$balance_percentage=0;
			$tbalance_percentage=0;
			foreach($result_members as $key){
			$tdiscount=$key['discount']+$tdiscount;
			$tplotprice=$key['price']+$tplotprice;
            $tdueamount=$key['Due_Amount']+$tdueamount;
			$treceivedamount=$key['Received_Amount']+$treceivedamount;
			$balance_amount=$key['Due_Amount']-$key['Received_Amount'];
			$tbalance_amount=$balance_amount+$tbalance_amount;
		 	
		/*	if(empty($balance_percentage)){
				$balance_percentage=$balance_amount/$key['Due_Amount']*100;
				}else{
					 $balance_percentage=0;
					}*/
			$count++;?>
			
			<?php echo $count.' result found';
			/* echo ' 
<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><strong>'.$key['phone'].'</strong><td>'.$key['email'].'</td><td style="text-align:right">'.number_format(floatval($key['price'])).'</td><td style="text-align:right;">'.number_format(floatval($key['discount'])).'</td><td style="text-align:right">'.number_format($key['Due_Amount']).'</td><td style="text-align:right">'.number_format($key['Received_Amount']).'</td><td style="text-align:right">'.number_format($balance_amount).'</td><td>';*/
			if($key['Due_Amount']>0){
				$balance_percentage=$balance_amount/$key['Due_Amount']*100;
				echo ROUND($balance_percentage,2);
				}else{
					echo'0';
					}
			 echo'%</td></tr>';
			}
			
			echo'<tr><td style="text-align:right"><strong>'.number_format($tplotprice).'</strong></td>
			<td style="text-align:right"><strong>'.number_format($tdiscount).'</strong></td><td style="text-align:right"><strong>'.number_format($tdueamount).'</strong></td>
			<td style="text-align:right"><strong>'.number_format($treceivedamount).'</strong></td><td style="text-align:right"><strong>'.number_format($tbalance_amount).'</strong></td>
			<td style="text-align:right"><strong>';echo number_format($tplotprice-$tdiscount-$treceivedamount);'</strong></td>
			
			</tr>';
			$nbp=$tplotprice-$tdiscount-$treceivedamount;
			echo'<tr><td></td><td>'.(ROUND(($tdiscount/$tplotprice*100),2)).'%</td><td>'.(ROUND(($tdueamount/$tplotprice*100),2)).'%</td><td>'.(ROUND(($treceivedamount/$tplotprice*100),2)).'%</td><td>'.(ROUND(($tbalance_amount/$tplotprice*100),2)).'%</td><td>'.(ROUND(($nbp/$tplotprice*100),2)).'%</td></tr>
			<tr><td><strong style="color:green;">Month: &nbsp;'.date("F", mktime(0, 0, 0, date('m')-1, 1)).'</strong></td></td></tr>';
				}
			

	}
	
	
	public function actionPrevmonth_report(){$connection = Yii::app()->db; 
     if((Yii::app()->session['user_array']['per31']=='1')&& isset(Yii::app()->session['user_array']['username'])){
	
		
       // return $cmdrow->queryAll();
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
	  //////////////////////////////////FUNCTION 3 END///////////////////////////////////////////
	   $this->render('prevmonth_report',array('projects'=>$result_projects));
	 }}
	
	public function actionMainreport(){$connection = Yii::app()->db; 
     
		if((Yii::app()->session['user_array']['per31']=='1')&& isset(Yii::app()->session['user_array']['username'])){
	
       // return $cmdrow->queryAll();
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
	  //////////////////////////////////FUNCTION 3 END///////////////////////////////////////////
	   $this->render('mainreport',array('projects'=>$result_projects));
		}}
	
	////////////Recovered Payment//////
	public function actionRecovered_sum(){
		
      $connection=yii::app()->db;
		 $sqluodate="SELECT * FROM  memberplot  WHERE WLSTATUS='1'";
		$sqlresult=$connection->createCommand($sqluodate)->query();
		
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
		$this->render('recovered_sum',array('projects'=>$result_projects));
		
					}
	   public function actionRecovered_summary()
	{  
	 
	 
	    if (!empty($_POST['uptodate1'])){
			  $uptodate=$_POST['uptodate1'];
			}else{
				 $uptodate=date('d-m-Y');
				
				}
		$where='';
		$and=false;
		$and = false;
			
			//echo $_POST['project_name'];exit;

				if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND p.project_id=".$_POST['project_name']."";
				}
				else
				{
					$where.="  p.project_id =".$_POST['project_name']."";
				}
				$and=true;
			}
			
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
				       
                                       $where.=" and mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				$and==true;
			}
                        
					$subqry="";
						
	$connection = Yii::app()->db; 
     
     $sql_member = "
	 
	Select
  projects.project_name,
  Sum(installpayment.paidamount) as recovered_amount,
  Sum(installpayment.dueamount) as due_amount
From
   projects
   Inner Join
  plots On plots.project_id = projects.id 
    Inner Join
  memberplot On plots.id = memberplot.id Inner Join
  installpayment On installpayment.plot_id = plots.id Inner Join
  memberplot memberplot1 On plots.id = memberplot1.plot_id
Where
  memberplot1.id = 1
Group By
  projects.project_name, projects.id "; 
//echo $sql_member;
//exit();
		$result_members = $connection->createCommand($sql_member)->query();
	
	   $sum='';
	$count=0;
$tpaidamount=0;
	$tdueamount=0;
	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();
            foreach($result_members as $key){
					$balance=$key['recovered_amount']-$key['due_amount'];
				//	$tpaidamount=$key['paidamount']+$tpaidamount;
					//$tdueamount=$key['dueamount']+$tdueamount;
					//$paidinstallments="SELECT COUNT(installpayment.plot_id) as paid FROM installpayment WHERE plot_id='".$key['plot_id']."' and installpayment.paidamount!='' ";
					//$result_paidins=$connection->createCommand($paidinstallments)->queryRow();
					//$dueinstallments="SELECT COUNT(installpayment.plot_id) as due FROM installpayment WHERE plot_id='".$key['plot_id']."' and installpayment.paidamount='' ";
					//$result_dueins=$connection->createCommand($dueinstallments)->queryRow();
                //if(floatval($key["amount_due"])> floatval($key["amount_paid"]))
                //{
            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['project_name'].'</td><td>'.$key['recovered_amount'].'</td><td>'.$key['due_amount'].'</td><td>'.$balance.'</td>';?>
					
		
		 
               
<?php //}
			}
					 ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		
			
<script>

    $('#select_all').on('click',function(){
        if(this.checked){ // alert('checked');
            $('#select_all').each(function(){
                this.checked = true;alert('asd');
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
  
});
</script>
	<?php  exit; 
	// for pagination END 

			
			
			}else{echo '';}

	echo $count.' result found' ;exit;
	    if(isset($_POST['username']) && empty($_POST['username']))

			{

				$error = 'Please enter username<br>';

			}

			if(isset($_POST['password']) && empty($_POST['password']))

			{

				$error .= 'Please enter Password<br>';

			}

			if(empty($error))

			{

				  $username = $_POST['username'];

				 $password = md5($_POST['password']);

				  $connection = Yii::app()->db;  

				   $sql = "SELECT * FROM user where username ='".$username."' AND  password='".$password."' AND status=1";

				  $result_data = $connection->createCommand($sql)->queryRow();

				  if($result_data)

				  {

						Yii::app()->session['user_array'] = $result_data;

						echo 1;exit();

				  }else

				  {

					 echo "Invalid Username and Password"; 

				  }

			}else

			{

				echo $error;

			}

	exit;	 



	}				
					
	public function Actionupdate_cut_date(){
	
			$connection = Yii::app()->db; 
		 echo $sqluodate="UPDATE projects cut_date=".$_POST['cut_date']."and id=".$_POST['project_id'];exit;
		$sqlresult=$connection->createCommand($sqluodate);
	     $sqlresult->execute(); 

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
		$this->render('watch_list',array('projects'=>$result_projects));
	}
		public function Actiontest(){
		$i=1;					  
		  foreach($_POST as $key=> $value)
		  {
			  if(substr($key,0,5) == "chkb_")
			  {  
			//  echo	$plot_id = $_POST[$value]; 
				 //echo " value : ".$value;
			$connection = Yii::app()->db; 
		 $sqluodate="UPDATE memberplot SET WLSTATUS='1',WLDATE='".date('Y-m-d')."' WHERE id='".$value."'";
	$sqlresult=$connection->createCommand($sqluodate);
	     $sqlresult->execute(); 

				
			  }
		  }
		//  echo $sqluodate;
		 // exit;
//	return;	
	
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
		$this->render('watch_list',array('projects'=>$result_projects));
	}
		public function Actionremovewlj(){
		$i=1;					  
		  foreach($_POST as $key=> $value)
		  {
			  if(substr($key,0,5) == "chkb_")
			  {  
			//  echo	$plot_id = $_POST[$value]; 
				 //echo " value : ".$value;
			$connection = Yii::app()->db; 
		 $sqluodate="UPDATE memberplot SET WLSTATUS='0',WLDATE='' WHERE id='".$value."'";
	$sqlresult=$connection->createCommand($sqluodate);
	     $sqlresult->execute(); 

				
			  }
		  }
		//  echo $sqluodate;
		 // exit;
//	return;	
	
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
		$this->render('watch_list',array('projects'=>$result_projects));
	}
	public function actionRecovered_payment_detail()

	{
if(isset(Yii::app()->session['user_array']['username']))

			{
		$where='';		
		$connection = Yii::app()->db;
		$cut_date=$_GET['cut_date'];
		//  $payment_date=date("d-m-Y",strtotime($_GET['payment_date']));
		
		
		$where .= ($where == "" ? "" : " and ")." installpayment.plot_id =".intval($_GET['id']);
		/*$where .= ($where == "" ? "" : " and ")." mp.plot_id in (Select
  memberplot.plot_id
From
  installpayment Inner Join
  memberplot On installpayment.plot_id = memberplot.plot_id
Where
  Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d') >
  Date_Format(Str_To_Date(memberplot.cut_date, '%Y-%m-%d'), '%Y-%m-%d') And
  memberplot.cut_date != '0000-00-00' And
  memberplot.wlstatus = 1
Group By
  memberplot.plot_id)";*/
		    $sql_payment  = "SELECT * from installpayment 

where $where  and Date_Format(Str_To_Date(due_date, '%d-%m-%Y'), '%Y-%m-%d')<'".date('Y-m-d',strtotime($cut_date))."'"
                           . "and Date_Format(Str_To_Date(paid_date, '%d-%m-%Y'), '%Y-%m-%d')>='".date('Y-m-d',strtotime($cut_date))."' and paidamount != '' and paid_date='".date('d-m-Y')."'";
               //   echo $sql_payment;
                 //  exit();
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
			   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."'";
		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
	//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
		$sql_plotinfo  = "SELECT p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

		
		$sql_minfo  = "SELECT * FROM memberplot where plot_id='".$_REQUEST['id']."'";

		$result_minfo = $connection->createCommand($sql_minfo)->queryAll();
		$sql_primeloc  = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
		

		$this->render('recovered_payment_detail',array('payments'=>$result_payments,'primeloc'=>$result_prime,'charges'=>$result_charges,'info'=>$result_plotinfo,'minfo'=>$result_minfo,'members'=>$result_members));

		}else{
				
					$this->redirect(array('user/dashboard'));

				}

	}
	////////////Recovered Payment//////
	public function actionRecovered_payment(){
		if((Yii::app()->session['user_array']['per31']=='1')&& isset(Yii::app()->session['user_array']['username'])){
	
      $connection=yii::app()->db;
		 $sqluodate="SELECT * FROM  memberplot  WHERE WLSTATUS='1'";
		$sqlresult=$connection->createCommand($sqluodate)->query();
		
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
		$this->render('recovered_payment',array('projects'=>$result_projects));
		}
					}
					
		
	   public function actionRlist()
	{  
	 
	 
	    if (!empty($_POST['uptodate1'])){
			  $uptodate=$_POST['uptodate1'];
			}else{
				 $uptodate=date('d-m-Y');
				
				}
		$where='';
		$and=false;
		$and = false;
			
			//echo $_POST['project_name'];exit;

				if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND p.project_id=".$_POST['project_name']."";
				}
				else
				{
					$where.="  p.project_id =".$_POST['project_name']."";
				}
				$and=true;
			}
			
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
				       
                                       $where.=" and mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				$and==true;
			}
                        
					$subqry="";
					
					if($_POST['from'] != "")
					{
                        $subqry .= " and 
  Date_Format(Str_To_Date(insp.paid_date, '%d-%m-%Y'), '%Y-%m-%d') >=
  Date_Format(Str_To_Date('".$_POST['from']."', '%d-%m-%Y'), '%Y-%m-%d')";
					}
					
					if($_POST['to'] != "")
					{
                        $subqry .= " And
  Date_Format(Str_To_Date(insp.paid_date, '%d-%m-%Y'), '%Y-%m-%d') <=
  Date_Format(Str_To_Date('".$_POST['to']."', '%d-%m-%Y'), '%Y-%m-%d') ";
					}
					
                        $where .= ($where == "" ? "" : " and ")." 
  Date_Format(Str_To_Date(j.cut_date, '%Y-%m-%d'), '%Y-%m-%d') <
  Date_Format(Str_To_Date(insp.paid_date, '%d-%m-%Y'), '%Y-%m-%d') And
  mp.wlstatus = 1 ".$subqry;
					
	//for Pagination 
if(isset($_POST['limit']) && $_POST['limit']!==''){$limit = $_POST['limit'];}else{
$limit = 15;}
$adjacent = 15;
$page = (isset($_REQUEST['page'])? $_REQUEST['page'] : 1);
if($page==1){
$start = 0;  
}
else{
$start = ($page-1)*$limit;
} 
$connection = Yii::app()->db;
  $sql_memberas= "SELECT insp.paid_date,mp.wlstatus,mp.id as mp_id , mp.member_id,mp.plotno,mp.create_date,m.email,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,s.street,s.id,j.cut_date,j.id,j.project_name,sec.sector_name,size_cat.size, paiddates.payment_date, mp.cut_date FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id
left join installpayment insp on insp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id


inner join (Select
  installpayment.plot_id,installpayment.paid_date,
  
  max(Str_To_Date(installpayment.paid_date, '%d-%m-%Y')) as payment_date
From
  installpayment
Group By
  installpayment.plot_id) paiddates on mp.plot_id= paiddates.plot_id

where $where";
//echo $sql_memberas;exit();
  $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	$connection = Yii::app()->db; 
     
     $sql_member = "SELECT insp.lab,insp.paid_date,insp.dueamount,insp.paidamount,mp.wlstatus,mp.id as mp_id , mp.member_id,mp.plotno,mp.create_date,m.email,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size, paiddates.payment_date, mp.cut_date FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id
left join installpayment insp on insp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

inner join (Select
  installpayment.plot_id,installpayment.paid_date,installpayment.paidamount,installpayment.dueamount,
  
  (Str_To_Date(installpayment.paid_date, '%d-%m-%Y')) as payment_date
From
  installpayment
Group By
  installpayment.plot_id) paiddates on mp.plot_id= paiddates.plot_id

where $where  limit $start,$limit"; 
//echo $sql_member;
//exit();
		$result_members = $connection->createCommand($sql_member)->query();
	
	   $sum='';
	$count=0;
$tpaidamount=0;
	$tdueamount=0;
	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();
            foreach($result_members as $key){
					$tpaidamount=$key['paidamount']+$tpaidamount;
				$tdueamount=$key['dueamount']+$tdueamount;
					//$paidinstallments="SELECT COUNT(installpayment.plot_id) as paid FROM installpayment WHERE plot_id='".$key['plot_id']."' and installpayment.paidamount!='' ";
					//$result_paidins=$connection->createCommand($paidinstallments)->queryRow();
					//$dueinstallments="SELECT COUNT(installpayment.plot_id) as due FROM installpayment WHERE plot_id='".$key['plot_id']."' and installpayment.paidamount='' ";
					//$result_dueins=$connection->createCommand($dueinstallments)->queryRow();
                //if(floatval($key["amount_due"])> floatval($key["amount_paid"]))
                //{
            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['lab'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td>'.date("d-m-Y",strtotime($key['paid_date'])).'</td>	
		<td>'.$key['paidamount'].'</td><td>'.$key['dueamount'].'</td>
			<td><div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">';
				  if($key['wlstatus']==1){
					  	echo '<li role="presentation"><a  href="Removewl?id='.$key['plot_id'].'">Remove From Watch List</a></li>';
					  }else{
							echo '<li role="presentation"><a  href="Addwl?id='.$key['plot_id'].'">Add To Watch List</a></li>';
							}
				echo '<li role="presentation"><a target="_blank" href="recovered_payment_detail?id='.$key['plot_id'].'&& pid='.$key['project_id'].'&& cut_date='.date("d-m-Y",strtotime($key['cut_date'])).'">Payment Details</a></li>
				<li role="presentation"><a href="comments?plotid='.$key['plot_id'].'&& pid='.$key['project_id'].'&& mp_id='.$key['mp_id'].'">Follow up Detail</a></li>
		
					 '; ?>
			</td></tr></div>				
		
		 
               
<?php //}
			}
			echo'<tr><td></td><td></td><td></td><td></td><td></td><td></td><td><strong>'.$tpaidamount.'</strong></td><td><strong>'.$tdueamount.'</strong></td><td></td></tr>';
		 
			// for pagination 
$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit);	
	$next_='';
	$last='';
	$adjacents=$adjacent;
	if($lastpage > 1)
	{	if ($page > 1) 
			$prev_.= "<a class='page-numbers' href=\"?page=$prev\">previous</a>";
		else{	}
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			$first='';
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
			$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
		       $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			else
			{
			    $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last='';
			}
        	}
		if ($page < $counter - 1) 
			$next_.= "<a class='page-numbers' href=\"?page=$next\">next</a>";
		else{
			}
		$pagination = "<div class=\"pagination\">".$first.$prev_.$pagination.$next_.$last;
		$pagination.= "</div>\n";		
	}
    echo '<tr  ><td colspan="10"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';?>
	<?php echo '<tr><td colspan="10">'.$pagination;?></td></tr>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		
			
<script>

    $('#select_all').on('click',function(){
        if(this.checked){ // alert('checked');
            $('#select_all').each(function(){
                this.checked = true;alert('asd');
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
  
});
</script>
	<?php  exit; 
	// for pagination END 

			
			
			}else{echo '';}

	echo $count.' result found' ;exit;
	    if(isset($_POST['username']) && empty($_POST['username']))

			{

				$error = 'Please enter username<br>';

			}

			if(isset($_POST['password']) && empty($_POST['password']))

			{

				$error .= 'Please enter Password<br>';

			}

			if(empty($error))

			{

				  $username = $_POST['username'];

				 $password = md5($_POST['password']);

				  $connection = Yii::app()->db;  

				   $sql = "SELECT * FROM user where username ='".$username."' AND  password='".$password."' AND status=1";

				  $result_data = $connection->createCommand($sql)->queryRow();

				  if($result_data)

				  {

						Yii::app()->session['user_array'] = $result_data;

						echo 1;exit();

				  }else

				  {

					 echo "Invalid Username and Password"; 

				  }

			}else

			{

				echo $error;

			}

	exit;	 



	}				
					
					
	///////////////////////////////////
	
	
	
	public function actioncomm(){
		
    
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
		$this->renderPartial('comm',array('projects'=>$result_projects));
		
					}
			////////////Add Comments //////
	public function actioncomments(){
		
      $connection=yii::app()->db;
					 $sqlview="SELECT mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size   FROM memberplot mp
			
			left join members m on mp.member_id=m.id
			left join plots p on mp.plot_id=p.id
			left join sectors sec on sec.id=p.sector
			left join size_cat size_cat on size_cat.id=p.size2
			left join streets s on p.street_id=s.id
			left join projects j on p.project_id=j.id
			
			 where mp.id='".$_GET['mp_id']."'";
		   $sqlresult=$connection->createCommand($sqlview)->queryAll();
			$sql_plotinfo  = "SELECT p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['plotid']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
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
		$this->render('comments',array('projects'=>$result_projects,'result'=>$sqlresult,'info'=>$result_plotinfo));
		
					}

	public function actionAddcomments(){
		
      $connection=yii::app()->db;
	  
	    $error='';
	 	if(empty($_POST['comments'])){
			$error="Please Enter Comments";
			} 
		if(empty($error))
		{
		   $sqluodate="INSERT INTO recovery_comments(user_id,mp_id,date,comments,moc,next_reminder) VALUES('".Yii::app()->session['user_array']['id']."',".$_POST['mp_id'].",'".date('Y-m-d')."','".$_POST['comments']."','".$_POST['moc']."','".$_POST['uptodate1']."') "; 
		$sqlresult=$connection->createCommand($sqluodate);
		$sqlresult->execute();
		 }else{
		echo $error;exit;
		}
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
		
		 $sqlview="SELECT mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size   FROM memberplot mp
			
			left join members m on mp.member_id=m.id
			left join plots p on mp.plot_id=p.id
			left join sectors sec on sec.id=p.sector
			left join size_cat size_cat on size_cat.id=p.size2
			left join streets s on p.street_id=s.id
			left join projects j on p.project_id=j.id
			
			 where mp.id='".$_POST['mp_id']."'";
		   $sqlresult=$connection->createCommand($sqlview)->queryAll();
			$sql_plotinfo  = "SELECT p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_POST['plotid']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
		$this->render('comments',array('projects'=>$result_projects,'mp_id'=>$_POST['mp_id'],'plotid'=>$_POST['plotid'],'result'=>$sqlresult,'info'=>$result_plotinfo));
		
					}
	///////////////////////////////////	
	
	   public function actionWlist()
	{  
	 
	 
	    if (!empty($_POST['uptodate1'])){
			  $uptodate=$_POST['uptodate1'];
			}else{
				 $uptodate=date('d-m-Y');
				
				}
		$where='';
		$and=false;
		$and = false;
			
			//echo $_POST['project_name'];exit;

				if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND p.project_id=".$_POST['project_name']."";
				}
				else
				{
					$where.="  p.project_id =".$_POST['project_name']."";
				}
				$and=true;
			}
			
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
				       
                                       $where.=" and mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				$and==true;
			}
					
	//for Pagination 
if(isset($_POST['limit']) && $_POST['limit']!==''){$limit = $_POST['limit'];}else{
$limit = 15;}
$adjacent = 15;
$page = (isset($_REQUEST['page'])? $_REQUEST['page'] : 1);
if($page==1){
$start = 0;  
}
else{
$start = ($page-1)*$limit;
} 
$connection = Yii::app()->db;
  $sql_memberas= "SELECT * FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join transferplot tp on p.id=tp.id

left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where and   mp.wlstatus=1  ";
 
  $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	$connection = Yii::app()->db; 
     
     $sql_member = "SELECT mp.wlstatus,mp.id as mp_id , mp.member_id,mp.plotno,mp.create_date,m.email,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where  and  mp.wlstatus=1 limit $start,$limit"; 
//echo $sql_member;
//exit();
		$result_members = $connection->createCommand($sql_member)->query();
	
	   
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){
					//$paidinstallments="SELECT COUNT(installpayment.plot_id) as paid FROM installpayment WHERE plot_id='".$key['plot_id']."' and installpayment.paidamount!='' ";
					//$result_paidins=$connection->createCommand($paidinstallments)->queryRow();
					//$dueinstallments="SELECT COUNT(installpayment.plot_id) as due FROM installpayment WHERE plot_id='".$key['plot_id']."' and installpayment.paidamount='' ";
					//$result_dueins=$connection->createCommand($dueinstallments)->queryRow();
                //if(floatval($key["amount_due"])> floatval($key["amount_paid"]))
                //{
            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td>'.$key['email'].'</td>	
		
			<td><div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">';
				  if($key['wlstatus']==1){
					  	echo '<li role="presentation"><a  href="Removewl?id='.$key['plot_id'].'">Remove From Watch List</a></li>';
					  }else{
							echo '<li role="presentation"><a  href="Addwl?id='.$key['plot_id'].'">Add To Watch List</a></li>';
							}
				echo '<li role="presentation"><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
				<li role="presentation"><a href="comments?plotid='.$key['plot_id'].'&& pid='.$key['project_id'].'&& mp_id='.$key['mp_id'].'">Follow up Detail</a></li>';?>
			</td></div><td>
           <?php
		   
		    echo'<input type="checkbox" class="checkbox" name="chkb_'.$key["mp_id"].'" id="" value="0" data-tag="'.$key["mp_id"].'" onclick="if(this.checked ==true) this.value ='.$key["mp_id"].'; else this.value=0;" />
            </td></tr>';
			
				}
				echo '<tr><td colspan="7"></td><td><input type="checkbox" id="select_all"/> Select all
                  <input type="submit" name="Add" value="Remove"  />
                  
                </td></tr>';
		
			// for pagination 
$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit);	
	$next_='';
	$last='';
	$adjacents=$adjacent;
	if($lastpage > 1)
	{	if ($page > 1) 
			$prev_.= "<a class='page-numbers' href=\"?page=$prev\">previous</a>";
		else{	}
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			$first='';
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
			$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
		       $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			else
			{
			    $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last='';
			}
        	}
		if ($page < $counter - 1) 
			$next_.= "<a class='page-numbers' href=\"?page=$next\">next</a>";
		else{
			}
		$pagination = "<div class=\"pagination\">".$first.$prev_.$pagination.$next_.$last;
		$pagination.= "</div>\n";		
	}
    echo '<tr  ><td colspan="7"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	 echo '<tr><td colspan="7">'.$pagination;?></td></tr>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		
			
<script>
/*function UnCheckAllCheckboxes(frm,len)
{
	//will be tested lated
	var str="";
	var elementval="";
	
	for (key in frm.elements) 
	{
		element = frm.elements[key];

		if (element != null)
		{
		   if (element.type == null) continue;
		   if (element.name == undefined) continue;
//		   if (document.getElementById(element.name).value == null) continue;
//		   alert(element.name);
		   //alert(element.name+" :"+document.getElementById(element.name).value);
		   //if (str== "")
			//   str = element.name+'='+escape(element.value);
		   //else
			try
			{
//				alert(element.name.substr(0,2));
				if(element.name.substr(0,3)=="chk")
				{
					if (document.getElementById(element.name).disabled==false)
					{
						document.getElementById(element.name).checked=false;
						if (len)
							document.getElementById(element.name).value=0;
						else						
							document.getElementById(element.name).value=0;
						//alert(document.getElementById(element.name).value);
						//alert(element.name.substr(3,element.name.length-3) + '  ' + element.name)
					}
				}
			   //str = str+"&"+element.name+'='+escape(document.getElementById(element.name).value);
			}
			catch(ex)
			{
				if (ex =="TypeError: document.getElementById(element.name) is null")
				{
				}
				else
					alert(ex+element.name);
			}
	   }
	}
		
	//return str;
}

function SelectAllCheckboxes(frm,len)
{
	//will be tested lated
	var str="";
	var elementval="";
	
	for (key in frm.elements) 
	{
		element = frm.elements[key];

		if (element != null)
		{

		   if (element.type == null) continue;
		   if (element.name == undefined) continue;
//		   if (document.getElementById(element.name).value == null) continue;
//		   alert(element.name);
		   //alert(element.name+" :"+document.getElementById(element.name).value);
		   //if (str== "")
			//   str = element.name+'='+escape(element.value);
		   //else
			try
			{
//				alert(element.name.substr(0,2));
				if(element.name.substr(0,3)=="chk")
				{
					if (document.getElementById(element.name).disabled==false)
					{
						document.getElementById(element.name).checked=true;
						if (len)
							document.getElementById(element.name).value=element.name.substr(len,element.name.length-len);
						else						
							document.getElementById(element.name).value=element.name.substr(3,element.name.length-3);
						//alert(document.getElementById(element.name).value);
						//alert(element.name.substr(3,element.name.length-3) + '  ' + element.name)
					}
				}
			   //str = str+"&"+element.name+'='+escape(document.getElementById(element.name).value);
			}
			catch(ex)
			{
				if (ex =="TypeError: document.getElementById(element.name) is null")
				{
				}
				else
					alert(ex+element.name);
			}
	   }
	}
		
	//return str;
}
*/
   $(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
                this.value = $(this).attr("data-tag");
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
                this.value = 0;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
}); 	
</script>
	<?php  exit; 
	// for pagination END 

			
			
			}else{echo '';}

	echo $count.' result found' ;exit;
	    if(isset($_POST['username']) && empty($_POST['username']))

			{

				$error = 'Please enter username<br>';

			}

			if(isset($_POST['password']) && empty($_POST['password']))

			{

				$error .= 'Please enter Password<br>';

			}

			if(empty($error))

			{

				  $username = $_POST['username'];

				 $password = md5($_POST['password']);

				  $connection = Yii::app()->db;  

				   $sql = "SELECT * FROM user where username ='".$username."' AND  password='".$password."' AND status=1";

				  $result_data = $connection->createCommand($sql)->queryRow();

				  if($result_data)

				  {

						Yii::app()->session['user_array'] = $result_data;

						echo 1;exit();

				  }else

				  {

					 echo "Invalid Username and Password"; 

				  }

			}else

			{

				echo $error;

			}

	exit;	 



	}	
////////////watch list//////
	public function actionWatch_list(){
		if((Yii::app()->session['user_array']['per31']=='1')&& isset(Yii::app()->session['user_array']['username'])){
	
      $connection=yii::app()->db;
		 $sqluodate="SELECT * FROM  memberplot  WHERE WLSTATUS='1'";
		$sqlresult=$connection->createCommand($sqluodate)->query();
		
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
		$this->render('watch_list',array('projects'=>$result_projects));
		}
					}
	///////////////////////////////////


	////////////Add to watch list//////
	public function actionAddwl(){
		
         $connection=yii::app()->db;
		 $sqluodate="UPDATE memberplot SET WLSTATUS='1',WLDATE='".date('Y-m-d')."' WHERE plot_id='".$_GET['id']."'";
		$sqlresult=$connection->createCommand($sqluodate);
		$sqlresult->execute();
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
		$this->render('defaulter_list',array('projects'=>$result_projects));
		
					}
	///////////////////////////////////
	////////////Remove from watch list//////
	public function actionRemovewl(){
		
      $connection=yii::app()->db;
		 $sqluodate="UPDATE memberplot SET WLSTATUS='0',WLDATE='' WHERE plot_id='".$_GET['id']."'";
		$sqlresult=$connection->createCommand($sqluodate);
		$sqlresult->execute();
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
		$this->render('defaulter_list',array('projects'=>$result_projects));
		
					}
	///////////////////////////////////
	
	public function actionRecovery(){
		
		$this->render('recovery');
		}
   public function actionSearchsheet()
	{  
	
	//echo $_POST['cut_date'];exit;
	 
	//  $uptodate=date('d-m-Y');
	if (!empty($_POST['cut_date'])){
				 $uptodate= date('d-m-Y', strtotime($_POST['cut_date']));
			
			}else{
				 $uptodate=date('d-m-Y');
				
				}
		$where='';
		$and=false;
	//echo $_POST['cut_date'];exit;
		if (!empty($_POST['new'])){
				if($and==true)
				{
					$where.=" AND memberplot.wlstatus =''";
				}
				else
				{
					$where.=" memberplot.wlstatus ='' ";
				}
				$and=true;
			}
		if (!empty($_POST['project_id'])){
				if($and==true)
				{
					$where.=" AND projects.id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.="  projects.id LIKE '%".$_POST['project_id']."%' ";
				}
				$and=true;
			}
		
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
				       
                                       $where.=" and memberplot.plotno LIKE '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="memberplot.plotno LIKE '%".$_POST['plotno']."%'";
				}
				$and==true;
			}
			
			
			
			/*
			if (!empty($_POST['allotmentstatus'])){
if($_POST['allotmentstatus']==1){ $where.=" and mp.status='Approved'";}
if($_POST['allotmentstatus']==2){ $where.=" and mp.status!='Approved' and mp.fstatus!='Approved'";}
			}		*/		
	//for Pagination 
if(isset($_POST['limit']) && $_POST['limit']!==''){$limit = $_POST['limit'];}else{
$limit = 20;}
$adjacent = 20;
$page = $_REQUEST['page'];
if($page==1){
$start = 0;  
}
else{
$start = ($page-1)*$limit;
} 
$connection = Yii::app()->db; 
 $dueamountsquery = "Select    installpayment.plot_id,    Sum(installpayment.dueamount) As amount_due, count(id) as due_installments
   From    installpayment  Where
  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <=
    Date_Format(Str_To_Date('".$uptodate."', '%d-%m-%Y'), '%Y-%m-%d')
  Group By    installpayment.plot_id";
        $dueinstsquery = "Select    installpayment.plot_id,    count(id) as due_installments
  From    installpayment  Where
  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <=
    Date_Format(Str_To_Date('".$uptodate."', '%d-%m-%Y'), '%Y-%m-%d')
  Group By    installpayment.plot_id";

//    Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d') <=
//    Date_Format(Str_To_Date('01-09-2016', '%d-%m-%Y'), '%Y-%m-%d')
        
        $paidamountquery="Select    installpayment.plot_id,    Sum(installpayment.paidamount) As amount_paid, count(id) as paid_installments
  From    installpayment  Where
    paidamount!=''
  Group By    installpayment.plot_id";
        //    Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d') <=
//    Date_Format(Str_To_Date('01-09-2016', '%d-%m-%Y'), '%Y-%m-%d')

        $paidinstquery="Select    installpayment.plot_id,    count(id) as paid_installments
  From    installpayment  Where
     paidamount!=''
  Group By    installpayment.plot_id";
        
        $subquery = "Select  memberplot.id,  dueamounts.amount_due,  paidamounts.amount_paid, dueinst.due_installments, paidinst.paid_installments
From  memberplot Left Join
  (".$dueamountsquery.") dueamounts On memberplot.plot_id =
    dueamounts.plot_id Left Join
  (".$paidamountquery.") paidamounts On memberplot.plot_id =
    paidamounts.plot_id left join 
    (".$dueinstsquery.") dueinst on memberplot.plot_id =
        dueinst.plot_id left join 
        (".$paidinstquery.") paidinst on memberplot.plot_id = 
            paidinst.plot_id";
 $sql_memberas = "Select memberplot.insplan,memberplot.wlstatus,memberplot.wldate,projects.project_name,plots.price,plots.project_id, memberplot.member_id,size_cat.size,plots.plot_detail_address, memberplot.plot_id,plots.plot_size, memberplot.id, memberplot.plotno, members.name, members.sodowo, members.cnic, members.phone, members.email, size_cat.code, discnt.discount, amounts.amount_due, amounts.amount_paid, amounts.amount_due - ifnull(amounts.amount_paid,0) as difference, amounts.due_installments, amounts.paid_installments From members Inner Join memberplot On members.id = memberplot.member_id Inner Join plots On memberplot.plot_id = plots.id Inner Join size_cat On plots.size2 = size_cat.id Left Join discnt On memberplot.id = discnt.ms_id Left Join projects On plots.project_id = projects.id Left Join (Select Sum(installpayment.dueamount) As Due_Amount, Sum(installpayment.paidamount) As Received_Amount, installpayment.plot_id From installpayment group by installpayment.plot_id ) installpayments On installpayments.plot_id = memberplot.plot_id inner join (".$subquery.") amounts On memberplot.id = amounts.id   where plots.atype!='Against Land' and amounts.due_installments != amounts.paid_installments and amounts.amount_due > amounts.amount_paid ".($where =="" ? "" : " and ".$where);
 
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	   $connection = Yii::app()->db; 
        
        //where ifnull( dueamounts.amount_due,0) != 0 and ifnull( paidamounts.amount_paid,0) !=0
       //echo $dueamountsquery;
       //exit();
     $sql_member = "Select projects.cut_date, memberplot.insplan ,memberplot.id as mp_id,memberplot.wlstatus,memberplot.wldate,projects.project_name,plots.price,plots.project_id, memberplot.member_id,size_cat.size,plots.plot_detail_address, memberplot.plot_id,plots.plot_size, memberplot.id, memberplot.plotno, members.name, members.sodowo, members.cnic, members.phone, members.email, size_cat.code, discnt.discount, amounts.amount_due, amounts.amount_paid, amounts.amount_due - ifnull(amounts.amount_paid,0) as difference, amounts.due_installments, amounts.paid_installments From members Inner Join memberplot On members.id = memberplot.member_id Inner Join plots On memberplot.plot_id = plots.id Inner Join size_cat On plots.size2 = size_cat.id Left Join discnt On memberplot.id = discnt.ms_id Left Join projects On plots.project_id = projects.id Left Join (Select Sum(installpayment.dueamount) As Due_Amount, Sum(installpayment.paidamount) As Received_Amount, installpayment.plot_id From installpayment group by installpayment.plot_id ) installpayments On installpayments.plot_id = memberplot.plot_id inner join (".$subquery.") amounts On memberplot.id = amounts.id   where plots.atype!='Against Land' and amounts.due_installments != amounts.paid_installments and amounts.amount_due > amounts.amount_paid ".($where=="" ? "" : " and ".$where)."  Order By memberplot.plotno  limit $start,$limit"; 
//echo $sql_member;
//exit();
		$result_members = $connection->createCommand($sql_member)->queryAll();
	
	   
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){
					//$paidinstallments="SELECT COUNT(installpayment.plot_id) as paid FROM installpayment WHERE plot_id='".$key['plot_id']."' and installpayment.paidamount!='' ";
					//$result_paidins=$connection->createCommand($paidinstallments)->queryRow();
					//$dueinstallments="SELECT COUNT(installpayment.plot_id) as due FROM installpayment WHERE plot_id='".$key['plot_id']."' and installpayment.paidamount='' ";
					//$result_dueins=$connection->createCommand($dueinstallments)->queryRow();
                //if(floatval($key["amount_due"])> floatval($key["amount_paid"]))
                //{
            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td style="text-align:right;">'.floatval($key['price']).'</td><td style="text-align:right;">'.floatval($key['discount']).'</td><td style="text-align:right;">'.floatval($key['amount_due']).'</td><td style="text-align:right;">'.floatval($key['amount_paid']).'</td><td style="text-align:right;">'.floatval($key['difference']).'</td><td>'.$key['due_installments'].'</td>
			
			<td>'.$key['paid_installments'].'</td>
			<td><div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">';
				  if($key['wlstatus']==1){
					  	echo '<li role="presentation"><a  href="Removewl?id='.$key['plot_id'].'">Remove From Watch List</a></li>';
					  }else{
							echo '<li role="presentation"><a  href="Addwl?id='.$key['plot_id'].'">Add To Watch List</a></li>';
							}
				echo '<li role="presentation"><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
			</td></div>
			<td><input type="checkbox" class="checkbox" name="chkb_'.$key["mp_id"].'" id="" value="0" data-tag="'.$key["mp_id"].'" onclick="if(this.checked ==true) this.value ='.$key["mp_id"].'; else this.value=0;" />';?>
         
       </td>
            </tr>
			  <?php }
		
		  echo '<tr><td colspan="13">';?>
             <form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">

                 <input type="hidden" name="paper" value="a4">
                  <input type="hidden" name="orientation" value="landscape">
                <textarea style="display:none;" name="html" id="html">
                
                <head>
                    <link rel="stylesheet" type="text/css" href="../views/recovery/report.css">
                    <style>
                    td{ padding:0px;  border:1px solid #000; border-left:1px thin #000;
					@page { margin: 0px; }
						body {
					padding:0 0 0 0;;
					background-size: cover;
					width:auto;
					background-repeat:no-repeat;
						}
					}
                    .table-bordered{ border:1px solid #000; border-bottom:1px solid #000;}
                    </style></head><body>
                    <table  width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding:0 50 0 0; "><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="130" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                  <?php   echo'<img style="height:40px;"  src="'.Yii::getPathOfAlias('webroot').'/images/logo1.png"/>';?>
                  </td>
                  <td colspan="2" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:14px;  font-weight:bold"><span class="style6">Defaulter List PDF Report</span></td>
                  <td width="120" valign="top" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="25" style="border-bottom:inset; font-size:10px"><span class="style6">Doc #: RDL/</span></td>
                    </tr>
                    <tr>
                      <td height="25" style="border-bottom:inset; font-size:10px"><span class="style6">Rev: 00</span></td>
                    </tr>
                    <tr>
                      <td height="25" valign="middle" style="font-size:10px"><span class="style6">Page: 1 of 1</span></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="25" colspan="4" style="padding-left:5px; border-left:thin; border-left-style:solid; border-top:thin;  font-size:14px; border-top-style:solid; border-right:thin; border-right-style:solid"><span class="style6">Project:  <strong style="font-size:14px;"><?php echo $key['project_name']; ?></strong></span></td>
                </tr>
                <tr>
                  <td height="40" colspan="4" valign="middle" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:solid; border-right-style:solid">
                  <table class="style6" style="font-size:12px;">
    <thead style="background:#666; border-color:#ccc; color:#fff; ">
          <tr>
            <th width="4%">MS No.</th>
          <th width="6%">Name</th>
          <th width="5%">Father/Spouse</th>
          <th width="4%">CNIC</th>
          <th width="4%">Plot Size</th>
          <th width="4%">Plot Price</th>
          <th width="3%">Discount</th>
          <th width="3%">Due Amount</th>
          <th width="5%">Received Amount</th>
          <th width="4%">Over Due</th>
          <th width="5%">Due Installments</th>
          <th width="5%">Paid Installments</th>   
          </tr>  
        </thead>
    <tbody>
        <?php 
		foreach($result_members as $key){
		 echo '<tr><td>'.$key['plotno'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'('.$key['plot_size'].')</td><td style="text-align:right;">'.floatval($key['price']).'</td><td style="text-align:right;">'.floatval($key['discount']).'</td><td style="text-align:right;">'.floatval($key['amount_due']).'</td><td style="text-align:right;">'.floatval($key['amount_paid']).'</td><td style="text-align:right;">'.floatval($key['difference']).'</td><td>'.$key['due_installments'].'</td>
		<td>'.$key['paid_installments'].'</td>	
		';} ?>
      </tr>
      </tbody>
      </table></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
      </tr>
    <tr>
      <td style="padding:0 90 0 0; border-top:thin; border-style:solid; ">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
          <td width="65" valign="top" class="" style="border-left:thin;  border-bottom:thin; border-style:solid; border-bottom-style:solid"><div align="center"><span class="BoledText style4" style="font-size:9px;">
            <?php   echo'<img style="height:40px; float:left;"  src="'.Yii::getPathOfAlias('webroot').'/images/logo.gif"/>';?>
            This is Computer generated slip and no signature is required
          </span></div></td>
        </tr>
      </table></td>
    </tr>
   
  </table></body>
                </textarea>
					<input type="submit" class="btn-input" name="Add" value="Print" style="float:right;"  />
							</form>
          </td> 
         
		   <?php echo' <td><input type="checkbox" id="select_all"/> Select all
                  <input type="submit" name="Add" value="Add All"  />
                  
                </td></tr>';?>
                	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		
			
<script>
   $(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
                this.value = $(this).attr("data-tag");
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
                this.value = 0;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
}); 	
</script><?php
		// for pagination 
$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit);	
	$next_='';
	$last='';
	$adjacents=$adjacent;
	if($lastpage > 1)
	{	if ($page > 1) 
			$prev_.= "<a class='page-numbers' href=\"?page=$prev\">previous</a>";
		else{	}
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			$first='';
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
			$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
		       $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			else
			{
			    $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last='';
			}
        	}
		if ($page < $counter - 1) 
			$next_.= "<a class='page-numbers' href=\"?page=$next\">next</a>";
		else{
			}
		$pagination = "<div class=\"pagination\">".$first.$prev_.$pagination.$next_.$last;
		$pagination.= "</div>\n";		
	}
	   echo '<tr  ><td colspan="12"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="12">'.$pagination.'</td></tr>'; exit; 
	// for pagination END 
		}else{echo '';}

	echo $count.' result found' ;exit;
	    if(isset($_POST['username']) && empty($_POST['username']))

			{

				$error = 'Please enter username<br>';

			}

			if(isset($_POST['password']) && empty($_POST['password']))

			{

				$error .= 'Please enter Password<br>';

			}

			if(empty($error))

			{

				  $username = $_POST['username'];

				 $password = md5($_POST['password']);

				  $connection = Yii::app()->db;  

				   $sql = "SELECT * FROM user where username ='".$username."' AND  password='".$password."' AND status=1";

				  $result_data = $connection->createCommand($sql)->queryRow();

				  if($result_data)

				  {

						Yii::app()->session['user_array'] = $result_data;

						echo 1;exit();

				  }else

				  {

					 echo "Invalid Username and Password"; 

				  }

			}else

			{

				echo $error;

			}

	exit;	 



	}
	public function actionDefaulter_list()
	{	
	if((Yii::app()->session['user_array']['per31']=='1')&& isset(Yii::app()->session['user_array']['username'])){
			$name='';
			$sodowo='';
			$cnic='';
			$plotno='';
			$project_name='';
			$plot_detail_address='';
			$where='';
			$and = false;
			if (!empty($_POST['name'])){
				$where.=" m.name =".$_POST['name']."";
				$and = true;
			}
			if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and m.sodowo =".$_POST['sodowo']."";

				}
				else
				{

					$where.=" m.sodowo =".$_POST['sodowo']."";

				}
				$and=true;

			}

			if (!empty($_POST['cnic'])){

				if ($and==true)
				{
					$where.=" and m.cnic =".$_POST['cnic']."";
				}
				else
				{
					$where.=" m.cnic =".$_POST['cnic']."";
				}
				$and=true;
			}
			if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND p.project_id  '%".$_POST['project_name']."%'";
				}
				else
				{
					$where.="  p.project_id LIKE '%".$_POST['project_name']."%'";
				}
				$and=true;
			}
				if (!empty($_POST['plot_detail_address'])){

				if ($and==true)
				{
					$where.=" and p.plot_detail_address ='".$_POST['plot_detail_address']."'";
				}
				else
				{
					$where.="p.plot_detail_address='".$_POST['plot_detail_address']."'";
				}
				$and==true;
			}
				
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
					$where.=" and mp.plotno ='".$_POST['plotno']."'";
				}
				else
				{
					$where.="mp.plotno='".$_POST['plotno']."'";
				}
				$and==true;
			}
				$sql2='';
				$members="";
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
					$error="";
			$and = false;
			$where='';
			if (!empty($_POST['name'])){
				$where.=" m.name LIKE '%".$_POST['name']."%'";
				$and = true;
			}
			if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and m.sodowo LIKE '%".$_POST['sodowo']."%'";

				}
				else
				{

					$where.=" m.sodowo LIKE '%".$_POST['sodowo']."%'";

				}
				$and=true;

			}

			if (!empty($_POST['cnic'])){

				if ($and==true)
				{
					$where.=" and m.cnic LIKE '%".$_POST['cnic']."%'";
				}
				else
				{
					$where.=" m.cnic LIKE '%".$_POST['cnic']."%'";
				}
				$and=true;
			}
			if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND p.project_id LIKE '%".$_POST['project_name']."%'";
				}
				else
				{
					$where.="  p.project_id LIKE '%".$_POST['project_name']."%'";
				}
				$and=true;
			}

			if (!empty($_POST['plotno'])){

				if ($and==true)

				{

					$where.=" and mp.plotno ='".$_POST['plotno']."'";

				}

				else

				{

					$where.="mp.plotno='".$_POST['plotno']."'";

				}

				$and==true;

			}

//if($and ==true){echo 0;}else{echo 1;}exit;

			

			if (!empty($_POST['plot_detail_address'])){

				if ($and==true)

				{

					$where.=" and p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";

				}


			    else

				{

					$where.=" p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";

				}

				/*if($where!='')

					$where.=" AND ";

				else $where.=' WHERE ';

				$where.="p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";*/

			}

			

		

	$connection = Yii::app()->db; 

	 $sql_member = "Select memberplot.member_id, memberplot.plot_id, memberplot.id, memberplot.plotno, members.name, members.sodowo, members.cnic, members.phone, members.email, size_cat.code, discnt.discount, installpayments.Due_Amount, installpayments.Received_Amount From members Inner Join memberplot On members.id = memberplot.member_id Inner Join plots On memberplot.plot_id = plots.id Inner Join size_cat On plots.size2 = size_cat.id Left Join discnt On memberplot.id = discnt.ms_id Left Join (Select Sum(installpayment.dueamount) As Due_Amount, Sum(installpayment.paidamount) As Received_Amount, installpayment.plot_id From installpayment group by installpayment.plot_id ) installpayments On installpayments.plot_id = memberplot.plot_id where installpayments.Due_Amount - ifnull( installpayments.Received_Amount,0) - ifnull(discnt.discount,0)=0 Order By memberplot.plotno  "; 
	     	$result_members = $connection->createCommand($sql_member)->query();

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
		$result_projects = $connection->createCommand($sql_project)->queryAll() or mysql_error();

			if(isset($_POST['search'])){

            $res=array();
			

            foreach($members as $key){

  echo '<tr><td>'.$key['create_date'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="payment?id='.$key['plot_id'].' & pid='.$key['project_id'].'">Add Payment</a></br><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a>
  </br><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a>

</br>';if($key['status']=='New Request'){ echo'Cancel Request';}else {echo'<a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'">Transfer asdsaasdPlot</a>';}

echo'  </td></tr>'; 

            }
			}

			$this->render('defaulter_list',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects));
	}else{
		 $this->redirect(array("user/dashboard"));	

		}
	}
	//////////////////////////////////////////////////////////////

     public function actionSearchreq()
	 	{
		$where='';
		$and=false;
		
			if (!empty($_POST['name1'])){
				$where.=" m.name LIKE '%".$_POST['name1']."%'";
				$and = true;
			}
			if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and m.sodowo LIKE '%".$_POST['sodowo']."%'";

				}
				else
				{

					$where.=" m.sodowo LIKE '%".$_POST['sodowo']."%'";

				}
				$and=true;

			}

			if (!empty($_POST['cnic'])){

				if ($and==true)
				{
					$where.=" and m.cnic =".$_POST['cnic']."";
				}
				else
				{
					$where.=" m.cnic =".$_POST['cnic']."";
				}
				$and=true;
			}if (!empty($_POST['allotmentstatus'])){
$allotmentstatus='';
if($_POST['allotmentstatus']==1){if ($and==true)
				{
					$where.=" and mp.status='Approved'";
				}
				else
				{
					$where.=" mp.status='Approved'";
				}}
if($_POST['allotmentstatus']==2){if ($and==true)
				{
					$where.=" and mp.status!='Approved'";
				}
				else
				{
					$where.=" mp.status!='Approved'";
				}}
				
				$and=true;
			}
			if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND p.project_id LIKE '%".$_POST['project_name']."%'";
				}
				else
				{
					$where.="  p.project_id LIKE '%".$_POST['project_name']."%'";
				}
				$and=true;
			}
			if (!empty($_POST['plot_detail_address'])){

				if ($and==true)
				{
					$where.=" and p.plot_detail_address ='".$_POST['plot_detail_address']."'";
				}
				else
				{
					$where.="p.plot_detail_address='".$_POST['plot_detail_address']."'";
				}
				$and==true;
			}
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
				       
                                       $where.=" and mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="mp.plotnoLIKE '%".$_POST['plotno']."%'";
				}
				$and==true;
			}
			if (!empty($_POST['allotmentstatus'])){
if($_POST['allotmentstatus']==1){ $where.=" and mp.status='Approved'";}
if($_POST['allotmentstatus']==2){ $where.=" and mp.status!='Approved' and mp.fstatus!='Approved'";}
			}				
	//for Pagination 
if(isset($_POST['limit']) && $_POST['limit']!==''){$limit = $_POST['limit'];}else{
$limit = 15;}
$adjacent = 15;
$page = $_REQUEST['page'];
if($page==1){
$start = 0;  
}
else{
$start = ($page-1)*$limit;
} 
$connection = Yii::app()->db; 
 $sql_memberas = "SELECT mp.member_id,insp.paidamount,insp.due_date,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
left join installpayment insp on insp.plot_id=p.id


left join projects j on p.project_id=j.id

where insp.paidamount='' and insp.due_date<='".date('d-m-Y')."' and  $where and p.type='plot' ";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	$connection = Yii::app()->db; 
     $sql_member = "SELECT mp.member_id,insp.paidamount,insp.due_date,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
left join installpayment insp on insp.plot_id=p.id


left join projects j on p.project_id=j.id

where insp.paidamount='' and insp.due_date<='".date('d-m-Y')."' and $where and p.type='plot'  limit $start,$limit"; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){

            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'"><strong>'.$key['plot_detail_address'].'</strong></a><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td><td>'.$key['project_name'].'</td><td>
			  <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a></li>
			<li role="presentation"><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
			<li role="presentation"><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a></li>
			<li role="presentation"><a target="_blank" href="reallocate?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Reallocation</a></li>
'; 

$sqltest = "SELECT * FROM  plots where id='".$key['plot_id']."'  "; 
	
		$resulttest = $connection->createCommand($sqltest)->query();
	
	echo'
	<script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to cancel?");
      if (x)
          return true;
      else
        return false;
    }
</script>    
	
	';
            foreach($resulttest as $test){
 	
	 
			if($test['status']=='Requested(T)'){ echo '<li role="presentation"><a  href="'.$home.'/index.php/memberplot/treq_detail?id='.$key['plot_id'].'">Transfer Details</a></li>';}
			if($test['status']!='Requested(T)') {echo '<li role="presentation"><a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'"> Transfer Plot</a></li>';}
			
			
			}
  echo'
 
<li role="presentation"><a href="amembers?mid='.$key['msid'].'">Associates Member</a></li>

<li role="presentation"><a href="updatemember_plot?id='.$key['plot_id'].'">Update Membership</a></li>
  </ul></div>
  </td>';
			}
			
		 
			// for pagination 
$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit);	
	$next_='';
	$last='';
	$adjacents=$adjacent;
	if($lastpage > 1)
	{	if ($page > 1) 
			$prev_.= "<a class='page-numbers' href=\"?page=$prev\">previous</a>";
		else{	}
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			$first='';
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
			$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
		       $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			else
			{
			    $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last='';
			}
        	}
		if ($page < $counter - 1) 
			$next_.= "<a class='page-numbers' href=\"?page=$next\">next</a>";
		else{
			}
		$pagination = "<div class=\"pagination\">".$first.$prev_.$pagination.$next_.$last;
		$pagination.= "</div>\n";		
	}
    echo '<tr  ><td colspan="11"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="11">'.$pagination.'</td></tr>'; exit; 
	// for pagination END 

			
			
			}else{echo '';}

	echo $count.' result found' ;exit;
	    if(isset($_POST['username']) && empty($_POST['username']))

			{

				$error = 'Please enter username<br>';

			}

			if(isset($_POST['password']) && empty($_POST['password']))

			{

				$error .= 'Please enter Password<br>';

			}

			if(empty($error))

			{

				  $username = $_POST['username'];

				 $password = md5($_POST['password']);

				  $connection = Yii::app()->db;  

				   $sql = "SELECT * FROM user where username ='".$username."' AND  password='".$password."' AND status=1";

				  $result_data = $connection->createCommand($sql)->queryRow();

				  if($result_data)

				  {

						Yii::app()->session['user_array'] = $result_data;

						echo 1;exit();

				  }else

				  {

					 echo "Invalid Username and Password"; 

				  }

			}else

			{

				echo $error;

			}

	exit;	 



	}
		////////////////////TRANSFER DETAIL//////////////
	public function actionAjaxRequest32($val1)
	{	
		$connection = Yii::app()->db;  
		$sql_city  = "SELECT * from installpayment where id='".$val1."' ";
		$result_city = $connection->createCommand($sql_city)->query();
		$city=array();

		foreach($result_city as $cit){
			$city[]=$cit;
			} 
	echo json_encode($city); exit();
	}
	
	public function actionDue_lis()
	{	
	if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username'])){
			$name='';
			$sodowo='';
			$cnic='';
			$plotno='';
			$project_name='';
			$plot_detail_address='';
			$where='';
			$and = false;
			if (!empty($_POST['name'])){
				$where.=" m.name =".$_POST['name']."";
				$and = true;
			}
			if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and m.sodowo =".$_POST['sodowo']."";

				}
				else
				{

					$where.=" m.sodowo =".$_POST['sodowo']."";

				}
				$and=true;

			}

			if (!empty($_POST['cnic'])){

				if ($and==true)
				{
					$where.=" and m.cnic =".$_POST['cnic']."";
				}
				else
				{
					$where.=" m.cnic =".$_POST['cnic']."";
				}
				$and=true;
			}
			if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND p.project_id  '%".$_POST['project_name']."%'";
				}
				else
				{
					$where.="  p.project_id LIKE '%".$_POST['project_name']."%'";
				}
				$and=true;
			}
				if (!empty($_POST['plot_detail_address'])){

				if ($and==true)
				{
					$where.=" and p.plot_detail_address ='".$_POST['plot_detail_address']."'";
				}
				else
				{
					$where.="p.plot_detail_address='".$_POST['plot_detail_address']."'";
				}
				$and==true;
			}
				
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
					$where.=" and mp.plotno ='".$_POST['plotno']."'";
				}
				else
				{
					$where.="mp.plotno='".$_POST['plotno']."'";
				}
				$and==true;
			}
				$sql2='';
				$members="";
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
					$error="";
			$and = false;
			$where='';
			if (!empty($_POST['name'])){
				$where.=" m.name LIKE '%".$_POST['name']."%'";
				$and = true;
			}
			if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and m.sodowo LIKE '%".$_POST['sodowo']."%'";

				}
				else
				{

					$where.=" m.sodowo LIKE '%".$_POST['sodowo']."%'";

				}
				$and=true;

			}

			if (!empty($_POST['cnic'])){

				if ($and==true)
				{
					$where.=" and m.cnic LIKE '%".$_POST['cnic']."%'";
				}
				else
				{
					$where.=" m.cnic LIKE '%".$_POST['cnic']."%'";
				}
				$and=true;
			}
			if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND p.project_id LIKE '%".$_POST['project_name']."%'";
				}
				else
				{
					$where.="  p.project_id LIKE '%".$_POST['project_name']."%'";
				}
				$and=true;
			}

			if (!empty($_POST['plotno'])){

				if ($and==true)

				{

					$where.=" and mp.plotno ='".$_POST['plotno']."'";

				}

				else

				{

					$where.="mp.plotno='".$_POST['plotno']."'";

				}

				$and==true;

			}

//if($and ==true){echo 0;}else{echo 1;}exit;

			

			if (!empty($_POST['plot_detail_address'])){

				if ($and==true)

				{

					$where.=" and p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";

				}

			    else

				{

					$where.=" p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";

				}

				/*if($where!='')

					$where.=" AND ";

				else $where.=' WHERE ';

				$where.="p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";*/

			}

			

		

	$connection = Yii::app()->db; 

	 $sql_member = "SELECT mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where p.type='plot' and mp.status='Approved' "; 
	     	$result_members = $connection->createCommand($sql_member)->query();

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

			if(isset($_POST['search'])){

            $res=array();
			

            foreach($members as $key){

  echo '<tr><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td>'.$key['create_date'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="payment?id='.$key['plot_id'].' & pid='.$key['project_id'].'">Add Payment</a></br><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a>
  </br><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a>

</br>';if($key['status']=='New Request'){ echo'Cancel Request';}else {echo'<a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'">Transfer asdsaasdPlot</a>';}

echo'  </td></tr>'; 

            }
			}

			$this->render('due_lis',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects));
	}else{
		 $this->redirect(array("user/dashboard"));	

		}
	}
    public function actionPayment_details()
	{
if(isset(Yii::app()->session['user_array']['username']))

			{
		$connection = Yii::app()->db;

	$land  = "SELECT * FROM installpayment where plot_id='".$_REQUEST['id']."' ";

		$land_cost = $connection->createCommand($land)->queryAll();
		

		$sql_payment  = "SELECT * FROM plotpayment where plot_id='".$_REQUEST['id']."'";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

		

	   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.image,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."'";

		$result_members = $connection->createCommand($sql_member)->queryAll();
		

		

		$sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc

left join charges c on pc.charges_id=c.id 

where plot_id='".$_REQUEST['id']."'";

		$res=$connection->createCommand($sql)->queryAll();

		

		//$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";

		//$result_charges = $connection->createCommand($sql_charges)->queryAll();

		

		$sql_plotinfo  = "SELECT p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
			$connection = Yii::app()->db;
			$sql_primeloc  = "SELECT *  FROM cat_plot
			LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
			WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
			$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
					

	

		$this->render('payment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'landcost'=>$land_cost,'info'=>$result_plotinfo,'receivable'=>$res,'members'=>$result_members));
			}else{
				
					$this->redirect(array('user/dashboard'));

				}
		

	}
	public function actionInstallment_details()

	{
if(isset(Yii::app()->session['user_array']['username']))

			{
		$connection = Yii::app()->db;
		$sql_payment  = "SELECT * FROM installpayment where plot_id='".$_REQUEST['id']."' ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
			   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."'";
		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
	//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
		$sql_plotinfo  = "SELECT p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

		
		$sql_minfo  = "SELECT * FROM memberplot where plot_id='".$_REQUEST['id']."'";

		$result_minfo = $connection->createCommand($sql_minfo)->queryAll();
		$sql_primeloc  = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
		

		$this->render('installment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'charges'=>$result_charges,'info'=>$result_plotinfo,'minfo'=>$result_minfo,'members'=>$result_members));

		}else{
				
					$this->redirect(array('user/dashboard'));

				}

	}

	public function actionUpdate()

     	{

		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
	  /*?>$sql= "SELECT
    projects.project_name
	,size_cat.size
	,ins.*
    FROM
    installment_plan ins
	Left JOIN projects  ON (ins.project_id = projects.id)
	  Left JOIN size_cat  ON (ins.category_id = size_cat.id)  

	  WHERE ins.id='".$_GET['id']."'";

	$result = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
   $sql_size = "SELECT * from size_cat";
	$result_size = $connection->createCommand($sql_size)->query();<?php */

//	$this->render('update',array('pla'=>$result,'projects'=>$result_project,'size'=>$result_size));
$this->render('update');
	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
	public function actionUpdate_charges()

     	{

		if(Yii::app()->session['user_array']['per3']=='1' &&Yii::app()->session['user_array']['per2']=='1'&& isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
			
		 $sql_payment  = "SELECT * FROM plotpayment where id='".$_GET['id']."'";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

			$sql_charges  = "SELECT * from charges where project_id='".$_REQUEST['pid']."'";

			$result_charges = $connection->createCommand($sql_charges)->query();

			
		$this->render('update_charges',array('charges'=>$result_charges,'payments'=>$result_payments));


	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
	public function actionUp_charges()

     	{

		if(Yii::app()->session['user_array']['per3']=='1' &&Yii::app()->session['user_array']['per2']=='1'&& isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
			
		 $sql_payment  = "SELECT * FROM plotpayment where id='".$_GET['id']."'";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

			$sql_charges  = "SELECT * from charges where project_id='".$_REQUEST['pid']."'";

			$result_charges = $connection->createCommand($sql_charges)->query();

			
		$this->render('up_charges',array('charges'=>$result_charges,'payments'=>$result_payments));


	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
	
    public function actionPaymentupdate()

	{       $error='';
			if ((isset($_POST['dueamount']) && empty($_POST['dueamount']))){
			$error.="Enter Due Amount. <br>";}
			if ((isset($_POST['lab']) && empty($_POST['lab']))){
			$error.="Enter Label. <br>";}
			if ((isset($_POST['paidamount']) && empty($_POST['paidamount']))){
			$error.="Enter Paid Amount. <br>";
			}
			if ((isset($_POST['payment_type']) && empty($_POST['payment_type']))){
			$error.="Please Select Payment Type <br>";
			}		  
			if ((isset($_POST['detail']) && empty($_POST['detail']))){
			$error.="Enter Voucher NO. <br>";
			 }
		  if ((isset($_POST['remarks']) && empty($_POST['remarks']))){
			$error.="Enter Remarks. <br>";
			}
			
			if ((isset($_POST['paid_date']) && empty($_POST['paid_date']))){
			$error.="Enter Paid Date. <br>";
			 }	
			   $connection = Yii::app()->db;  
				  if(empty($error))

			{
			   $sql="UPDATE installpayment set 
			 dueamount='".$_POST['dueamount']."',
			 lab='".$_POST['lab']."',  
			 paidsurcharge='".$_POST['paidsurcharge']."',
			 paidamount='".$_POST['paidamount']."',
			 payment_type='".$_POST['payment_type']."',
			 detail='".$_POST['detail']."',
			 surcharge='".$_POST['surcharge']."',
			 remarks='".$_POST['remarks']."',
			 paid_date='".$_POST['paid_date']."',
			 due_date='".$_POST['due_date']."'
			  where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Installment Updated Successfully';}
				else{
					echo $error;
					}
			  
	}
	public function actionInstallmentup()

	{       $error='';
			if ((isset($_POST['dueamount']) && empty($_POST['dueamount']))){
			$error.="Enter Due Amount. <br>";}
			if ((isset($_POST['lab']) && empty($_POST['lab']))){
			$error.="Enter Label. <br>";}
			
		  if ((isset($_POST['remarks']) && empty($_POST['remarks']))){
			$error.="Enter Remarks. <br>";
			}
			
			if ((isset($_POST['due_date']) && empty($_POST['due_date']))){
			$error.="Enter Due Date. <br>";
			 }	
			   $connection = Yii::app()->db;  
				  if(empty($error))

			{
			   $sql="UPDATE installpayment set 
			 dueamount='".$_POST['dueamount']."',
			 lab='".$_POST['lab']."',  
			surcharge='".$_POST['surcharge']."',
			 remarks='".$_POST['remarks']."',
			 due_date='".$_POST['due_date']."'
			  where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Installment Updated Successfully';}
				else{
					echo $error;
					}
			  
	}
    public function actionChargupdate()

	{        $error='';
			if ((isset($_POST['amount']) && empty($_POST['amount']))){
			$error.="Enter Due Amount. <br>";}
			if ((isset($_POST['paidamount']) && empty($_POST['amount']))){
			$error.="Enter Paid Amount. <br>";
			}
			if ((isset($_POST['payment_type']) && empty($_POST['payment_type']))){
			$error.="Please Select Payment Type <br>";
			}		  
			if ((isset($_POST['detail']) && empty($_POST['detail']))){
			$error.="Enter Voucher NO. <br>";
			 }
		  if ((isset($_POST['remarks']) && empty($_POST['remarks']))){
			$error.="Enter Remarks. <br>";
			}
			
			if ((isset($_POST['date']) && empty($_POST['date']))){
			$error.="Enter Paid Date. <br>";
			 }	
			

			   $connection = Yii::app()->db;  
				
			if(empty($error)){
			   $sql="UPDATE plotpayment set 
			 amount='".$_POST['amount']."',
			  paidas='".$_POST['paidas']."',
			 paidsurcharge='".$_POST['paidsurcharge']."',
			 paidamount='".$_POST['paidamount']."',
			 payment_type='".$_POST['payment_type']."',
			 detail='".$_POST['detail']."',
			 surcharge='".$_POST['surcharge']."',
			 remarks='".$_POST['remarks']."',

			 date='".$_POST['date']."',
			 duedate='".$_POST['duedate']."',
			  mem_id='".$_POST['mem_id']."'
			  where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Payments Updated Successfully';
			}
			else{
				echo $error;
				}
			  
	}
	public function actionChargup()

	{        
	
	
	$error='';
			if ((isset($_POST['amount']) && empty($_POST['amount']))){
			$error.="Enter Due Amount. <br>";}
			
			if ((isset($_POST['payment_type']) && empty($_POST['payment_type']))){
			$error.="Please Select Payment Type <br>";
			}		
			if(empty($_POST['duedate'])){
				$error.="Please Enter Due Date";
				}  
		
		
				
			   $connection = Yii::app()->db;  
				
			if(empty($error)){
			   $sql="UPDATE plotpayment set 
			 amount='".$_POST['amount']."',
			 remarks='".$_POST['remarks']."',
 discount='".$_POST['discount']."',
			 disdetails='".$_POST['disdetails']."',
			 duedate='".$_POST['duedate']."',
			  mem_id='".$_POST['mem_id']."'
			  where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Payments Updated Successfully';
			}
			else{
				echo $error;
				}
			  
	}
	public function actionRequested_detail()
	 {

	if(Yii::app()->session['user_array']['per2']=='1')

			{

			$connection = Yii::app()->db; 	

		 $sql_details  = "SELECT mp.member_id, u.firstname,u.cnic,u.email,c.size,mp.noi,mp.id,mp.create_date,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.status,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name FROM  memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat c on p.size2=c.id
left join user u on mp.user_name=u.id

left join projects j on s.project_id=j.id where mp.status!='Approved' And mp.plot_id=".$_REQUEST['id'];

			$result_details = $connection->createCommand($sql_details)->query();

			

			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['id']."'";

			$result_payments = $connection->createCommand($sql_payment)->queryRow();

			$this->render('requested_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments)); 

			}else{$this->redirect(array("dashboard"));}

	}
	public function actionReq_detail()

	 {

	if(Yii::app()->session['user_array']['per2']=='1')

			{

			$connection = Yii::app()->db; 	

		$sql_details  = "SELECT mp.member_id, u.firstname,u.cnic,u.email,c.size,mp.noi,mp.id,mp.fcomment,mp.create_date,mp.fstatus,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.status,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name FROM  memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat c on p.size2=c.id
left join user u on mp.user_name=u.id

left join projects j on s.project_id=j.id where mp.plot_id=".$_REQUEST['plot_id'];

			$result_details = $connection->createCommand($sql_details)->query();

			

			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['id']."'";

			$result_payments = $connection->createCommand($sql_payment)->queryRow();

			$this->render('req_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments)); 

			}else{$this->redirect(array("dashboard"));}

	}
	public function actionAjaxRequest($pro,$sec)
	{	

	$connection = Yii::app()->db;  

		$sql_street  = "SELECT * from streets where project_id='".$pro."' and sector_id='".$sec."'";

		$result_streets = $connection->createCommand($sql_street)->query();

			

		$street=array();

		foreach($result_streets as $str){

			$street[]=$str;

			} 

		

	echo json_encode($street); exit();

	}
	public function actionAjaxRequest1()
	{	

		$connection = Yii::app()->db;  

		$sql_plot  = "SELECT * from plots where street_id='".$_POST['street']."' and project_id='".$_POST['pro']."' and size2='".$_POST['size']."' and sector='".$_POST['sector']."' and type='Plot' and status=''";
		$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	}
	public function actionAjaxRequestdate($project_id)
	{	
		$connection = Yii::app()->db;  
		$sql_projects  = "SELECT  DATE_FORMAT(cut_date, '%d-%m-%Y') as cut_date from projects where id='".$project_id."' ";
		$result_projects = $connection->createCommand($sql_projects)->query();
		$cdate=array();
		foreach($result_projects as $date){
			$cdate[]=$date;
		//	$cdate[]=date("d-m-Y",strtotime($date["cut_date"]));
			} 
	echo json_encode($cdate); exit();

	}
	public function actionAjaxRequest31($val1)
	{	
		$connection = Yii::app()->db;  
		$sql_city  = "SELECT * from charges where id='".$val1."' ";
		$result_city = $connection->createCommand($sql_city)->query();
		$city=array();

		foreach($result_city as $cit){
			$city[]=$cit;
			} 
	echo json_encode($city); exit();
	}
	public function actionAjaxRequest5($val1)

	{	

		$connection = Yii::app()->db;  

		$sql_city  = "SELECT * from members where cnic=".$val1." AND status=1";

		$result_city = $connection->createCommand($sql_city)->query();

			

		$city=array();

		foreach($result_city as $cit){

			$city[]=$cit;


			} 

		

	echo json_encode($city); exit();

	}
	public function actionAjaxRequest6($val1)

	{	

		$connection = Yii::app()->db;  

		$sql_city  = "SELECT * from memberplot where plotno='".$val1."'";

		$result_city = $connection->createCommand($sql_city)->query();

			

		$city=array();

		foreach($result_city as $cit){

			$city[]=$cit;

			} 

		

	echo json_encode($city); exit();

	}	
	public function loadModel($id)

	{

		$model=User::model()->findByPk($id);

		if($model===null)

			throw new CHttpException(404,'The requested page does not exist.');

		return $model;

	}
	protected function performAjaxValidation($model)


	{

		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')

		{

			echo CActiveForm::validate($model);

			Yii::app()->end();

		}

	}

}