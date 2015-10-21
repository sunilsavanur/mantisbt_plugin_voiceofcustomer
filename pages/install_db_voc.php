<?php

html_page_top( );

?>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
$sql = 'CREATE TABLE mantis_voice_of_customer_table( '.
       'tid INT NOT NULL AUTO_INCREMENT, '.
	   'project_id VARCHAR(32) NOT NULL, '.
   	   'jira_id VARCHAR(32) NOT NULL, '.
	   'handler_id INT NOT NULL, '.
	   'creation_date    date NOT NULL, '.
       'verbatim VARCHAR(255) NOT NULL UNIQUE, '.
       'clientsNeed  VARCHAR(767) NOT NULL, '.
	   'RequirementTechnical  VARCHAR(767) NOT NULL, '.
	   'CriticalToQuality  VARCHAR(767) NOT NULL, '.
   	   'MeasurementCriteria  VARCHAR(767) NOT NULL, '.
       'primary key ( tid ))';

mysql_select_db('bugtracker');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not create table: ' . mysql_error());
}
echo " Table employee created successfully. \n";


//$sql ="update `mantis_config_table` set value=1 where config_id='plugin_DailyScrum_schema'";
//$retval = mysql_query( $sql, $conn );
//printf("Records affected: %d\n", mysql_affected_rows());

mysql_close($conn);
?>
<?php
	//echo '<br /><div class="center">';
	echo lang_get( 'operation_successful' ) . '<br />';
	print_bracket_link( plugin_page( 'VOC_Main_Page' ), lang_get( 'proceed' ) );
	echo '</div>';
	
html_page_bottom();