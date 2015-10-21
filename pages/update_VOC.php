<?php

html_page_top( );
//echo 'Hello ' . htmlspecialchars($_GET["action"]) . '!';
$the_tid=htmlspecialchars($_GET["action"]);
?>

<?php

if(isset($_SESSION['page']))
{
	unset($_SESSION['page']);
	$_SESSION['page'] = basename(__FILE__,'.php');
	if(isset($_SESSION['data']))
	{
		?>
		<script>
		alert("<?php print($_SESSION['data']); ?>");
		</script>
		<?php
		unset($_SESSION['data']);
	}
}
else
{
	$_SESSION['page'] = basename(__FILE__,'.php');
}

?>

<html>
<body>

<h1 align="center">Update Voice Of Customer </h1>
<form action="<?php echo plugin_page( 'update_VOC_SQL' ) ?>" method="post">

</br>
<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	
	$_SESSION['the_tid'] = $the_tid;
	
	$temp= array();
	$index=0;
	
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if(! $conn )
	{
	  die('Could not connect: ' . mysql_error());
	}
	$access_level = current_user_get_access_level();
	//echo $access_level;
	$user_id = auth_get_current_user_id();	
	//echo $user_id;
	
	$g_project = helper_get_current_project();
	//echo $g_project;
	
	if( $access_level >= 70) // manager and administrator access
		$sql = "SELECT tid,project_id,creation_date,verbatim, clientsneed, RequirementTechnical, CriticalToQuality, MeasurementCriteria FROM `mantis_voice_of_customer_table` where tid=$the_tid";
		   
	//echo $sql;
	
	mysql_select_db('bugtracker');
	$retval = mysql_query( $sql, $conn );
	if(! $retval )
	{
	  die('Could not select row table: ' . mysql_error());
	  echo $sql;
	  print_bracket_link( plugin_page( 'VOC_Main_Page' ), lang_get( 'proceed' ) );
	}
	else 
	{
		echo '<table BORDER cellpadding="2" cellspacing="5" class="db-table" align="center">';
		echo '<tr><th>Transaction ID</th><th>Project ID</th><th>Date</th><th>Verbatim</th><th>Need</th><th>Tech Req</th><th>Critical To Quality</th><th>Measurement</th>';
		while($row2 = mysql_fetch_row($retval)) {
			echo '<tr>';
	
			foreach($row2 as $key=>$value) {
			//echo $key;
			if($key == 0)
				echo '<td>',"<a href=plugin.php?page=VoiceOfCustomer/update_VOC.php&action=$value>" . $value . "</a>",'</td>';
			else
				//echo '<td><input type=text name=voc$cnt value='" . $value. "'></td>';
				echo "<td><input type=text name=voc_row[] value='".$value."' ></td>";
			}
			echo '</tr>';
		}
		echo '</table><br />';
	}
	
	mysql_close($conn);
?>

<input type="submit" class="button" id="button1" align="center" value="Update" name="submit2"/>
<input type="submit" class="button" id="button2" value="Delete" align="center" name="delete"/>
</form>

</body>
</html>

<?php
	echo '<br /><div class="center">';
	echo lang_get( 'operation_successful' ) . '<br />';
	print_bracket_link( plugin_page( 'VOC_Main_Page' ), lang_get( 'proceed' ) );
	echo '</div>';
html_page_bottom();