<?php
//function daily_scrum_insert_record($assign_to = 0, $date = 0, $action_items = 0 , $done = 0, $impediments = 0, $ds_submit_button){
	html_page_top( );
	$dt	= $_POST['date_year'] . '/' . date("m",strtotime($_POST['date_month'])) . '/' . $_POST['date_day'];
	if($_POST['date_year'] != date("Y") )
	{
		$dt = date("Y/m/d"); //Initialize to today's date
	}	
	echo $dt;
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if(! $conn )
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('bugtracker');


	if(isset($_POST))
	{
		var_dump ($_POST['ProjectID']);
	
		$projectID = $_POST['ProjectID'];
		foreach( $projectID as $key => $value)
		{
			//echo $value;
			$prid =  $_POST['ProjectID'][$key];
			$verb =  $_POST['Verbatim'][$key];
			$need =  $_POST['Need'][$key];
			$tech =  $_POST['Technical'][$key];
			$ctq =  $_POST['CTQ'][$key];
			$measure = $_POST['Measurement'][$key];
			
			echo $prid;
			echo $verb;
			echo $need;
			echo $tech;
			echo $ctq;
			echo $measure;
			
			if(!empty($prid))
			{
				$sql = "INSERT INTO mantis_voice_of_customer_table ".
					   "(project_id,creation_date,verbatim, clientsneed, RequirementTechnical, CriticalToQuality, MeasurementCriteria) ".
					   "VALUES ".
					   "('$prid','$dt','$verb','$need','$tech','$ctq','$measure')";
					   
				
				$retval = mysql_query( $sql, $conn );
				$data="";
				if(! $retval )
				{
				  $data = mysql_error();
				}
				else
				{
					$data = "Records affected: ".mysql_affected_rows();
				}
				$_SESSION['data'] = $data;
			}
		}	
	}
	
	
	mysql_close($conn);
	///$url = plugin_page( 'VOC_Main_Page' );
	//echo $url;
	///header('Location: '.$url);

?>



<?php	html_page_bottom();
	echo '<br /><div class="center">';
	echo lang_get( 'operation_successful' ) . '<br />';
	print_bracket_link( plugin_page( 'VOC_Main_Page' ), lang_get( 'proceed' ) );
	echo '</div>';
	?>

</body>
</html>