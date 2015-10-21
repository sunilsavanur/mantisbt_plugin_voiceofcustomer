<?php
//function daily_scrum_insert_record($assign_to = 0, $date = 0, $action_items = 0 , $done = 0, $impediments = 0, $ds_submit_button){
html_page_top( );

$the_tid = $_SESSION['the_tid'];
echo $the_tid;

var_dump ($_POST['voc_row']);

$VOC = $_POST['voc_row'];
	foreach( $VOC as $key => $value)
	{
		$prid =  $_POST['voc_row'][0];
		$date =  $_POST['voc_row'][1];
		$verb =  $_POST['voc_row'][2];
		$need =  $_POST['voc_row'][3];
		$tech =  $_POST['voc_row'][4];
		$ctq =  $_POST['voc_row'][5];
		$measure = $_POST['voc_row'][6];		
	}
	echo $the_tid; echo " ";
	echo $prid;echo " ";
	echo $date;echo " ";
	echo $verb;echo " ";
	echo $need;echo " ";
	echo $tech;echo " ";
	echo $ctq;echo " ";
	echo $measure;echo " ";
	
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';

	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if(! $conn )
	{
	  die('Could not connect: ' . mysql_error());
	}
//	echo 'Connected successfully';
//	echo " ";

	$access_level = current_user_get_access_level();
	
	if ( isset( $_POST['delete'] ) ) 
	{
		if( $access_level >= 70) // manager and administrator access
		{
			echo "Deleting the record...   " ;
			$sql = "DELETE FROM mantis_voice_of_customer_table WHERE tid=$the_tid" ; // Delete
		}
		else
		{
			echo "Can not delete the record...   " ;
			echo '<br /><div class="center">';
			//echo lang_get( 'operation_successful' ) . '<br />';
			print_bracket_link( plugin_page( 'VOC_Main_Page' ), lang_get( 'proceed' ) );
			echo '</div>';
			exit();
		}
		
	}
	else // It is update operation
	{

   $sql = "UPDATE mantis_voice_of_customer_table SET project_id = '$prid', verbatim = '$verb', clientsneed = '$need', RequirementTechnical = '$tech', CriticalToQuality = '$ctq', MeasurementCriteria = '$measure' WHERE tid=$the_tid" ;
	echo $sql;
	}
	
	mysql_select_db('bugtracker');
	//echo $sql;
	$retval = mysql_query( $sql, $conn );
	$data = "";
	if(! $retval )
	{
		 $data = mysql_error();
	}
	else
	{
		$data = "Records affected: ". mysql_affected_rows();
	}
	
	mysql_close($conn);
	
	echo '<br /><div class="center">';
	echo lang_get( 'operation_successful' ) . '<br />';
	print_bracket_link( plugin_page( 'VOC_Main_Page' ), lang_get( 'proceed' ) );
	echo '</div>';
	
	
	html_page_bottom();

?>