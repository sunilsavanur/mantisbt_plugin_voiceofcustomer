<?php
//require_once( 'ds_sql_api.php' );
html_page_top( );

?>
<?php

	$g_access_level = current_user_get_access_level();	
	//echo $g_access_level;
	
	if( $g_access_level < 70)
	{
		echo '<br /><div class="center">';
		//echo lang_get( 'operation_successful' ) . '<br />';
		echo "You are not authorised for this operation" . '<br />';
		print_bracket_link( plugin_page( 'main_daily_scrum' ), lang_get( 'proceed' ) );
		echo '</div>';
		exit();
	}
	
function date_dropdown($year_limit = 0){
        $html_output = '    <div id="date_select" >'."\n";
        $html_output .= '        <label for="date_day">Capture Voice of Customer Date    :</label>'."\n";
		$date_day=date("d");
		$date_month=date("F");
		$date_year=date("Y");
		$daystr = "";
		/*days*/
        $html_output .= '           <select name="date_day" id="day_select">'."\n";
		
            for ($day = 1; $day <= 31; $day++) {
				$daystr="";
				if($day < 10)
				{
					$daystr = "0".$day;
				}
				else
				{
					$daystr = $daystr+$day;
				}
				//echo $daystr;
                if(strcmp($date_day."",$daystr) == 0)
				{
					$html_output .= '               <option selected value='.$daystr.'>' . $daystr . '</option>'."\n";
				}
				else
				{
					$html_output .= '               <option value='.$daystr.'>' . $daystr . '</option>'."\n";
				}
				//echo $daystr;
				//echo $date_day;
            }
        $html_output .= '           </select>'."\n";

        /*months*/
        $html_output .= '           <select name="date_month" id="month_select" >'."\n";
        $months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            for ($arrayindex = 1; $arrayindex <= 12; $arrayindex++) {
               // $html_output .= '               <option value="' . $month . '">' . $months[$month] . '</option>'."\n";
			   if(strcmp($date_month,$months[$arrayindex]) == 0)
			   {
					$html_output .= '               <option selected value='.$months[$arrayindex].'>' . $months[$arrayindex] . '</option>'."\n";
			   }
			   else
			   {
					$html_output .= '               <option value='.$months[$arrayindex].'>' . $months[$arrayindex] . '</option>'."\n";
			   }
			    //$html_output .= '               <option value=date("F");>' . $months[$month] . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";
//echo $date_month;
        /*years*/
        $html_output .= '           <select name="date_year" id="year_select">'."\n";
            for ($year = 2012; $year <= (date("Y") - $year_limit); $year++) {
                if($date_year == $year)
				{
					$html_output .= '               <option selected value='.$year.'>' . $year . '</option>'."\n";
				}
				else
				{
					$html_output .= '               <option value='.$year.'>' . $year . '</option>'."\n";
				}
				//$html_output .= '               <option value=date("Y");>' . $year . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";

        $html_output .= '   </div>'."\n";
		
		echo $html_ouput;
		

// <form action="ds_sql_api.php" method="POST">		
//<form action="<?php $_PHP_SELF " method="POST" name="ds_submit">
    return $html_output;
}
?>


<?php ?>
<form action="<?php echo plugin_page( 'process_VOC' ) ?>" method="POST" >
		<!-- Start date -->
	<br>
	</br>	
<?php 
$date_day=date("d");
$date_month=date("F");
$date_year=date("Y");
echo date_dropdown();

?>
	<br>
	</br>

	<h2 align="center">Voice of Customer Table</h2>

	<!--//create table-->
	<table border="2" align="center">
	<!--//create the row counter-->
	<?php $numberofrow = 5;?>
	<!--//create the for loop-->
	
	<tr><th>ProjectID</th><th>Verbatim</th><th>Client's Need</th><th>Technical Requirement</th><th>CriticalToQuality</th><th>Measurement Criteria</th></tr>
	<?php for($counter = 1;$counter<=$numberofrow;$counter++){ ?>
	<!--//create 1 row for repeating-->
		<tr>
		<!--//column 1 is to print out the counter for you to see.-->
		<td><input type=text name="ProjectID[]" value="" ></td>
		<!--<td><input type=text name=JiraID1 value="" ></td>-->
		<!--<td><input type=text name=AssignedTo1 value="" ></td>-->
		<td><input type=text name="Verbatim[]" value="" ></td>
		<td><input type=text name="Need[]" value="" ></td>
		<td><input type=text name="Technical[]" value="" ></td>
		<td><input type=text name="CTQ[]" value="" ></td>
		<td><input type=text name="Measurement[]" value="" ></td>
		</tr>
	<?php }?>
	</table>
	
	<br>
	</br>
	
	
	<input type="submit" class="button" value="<?php echo lang_get( 'submit_button' ) ?>" name="voc_submit" />	
		<br>
	</br>
		<br>
	</br>
	<h2 align="center">
	<?php
	print_bracket_link( plugin_page( 'view_voc' ), plugin_lang_get( 'view_voc' ) );
	print_bracket_link( plugin_page( 'example_VOC' ), plugin_lang_get( 'example_voc' ) );
	?>	


	<br>
	</br>
	
		<br>
	</br>
		<br>
	</br>
		
	<h2 align="center"><?php
	print_bracket_link( plugin_page( 'install_db_voc' ), plugin_lang_get( 'install_db_voc' ) );
	?>	
	</form>

	 <?php	$t_username = current_user_get_field( 'username' );
	$t_access_level = get_enum_element( 'access_levels', current_user_get_access_level() );
	$t_now = date( config_get( 'complete_date_format' ) );
	$t_realname = current_user_get_field( 'realname' );
	?>	

	<br>
	</br>
	
	<?php     

	$dt	= $_POST['date_year'] . '-' . $_POST['date_month'] . '-' . $_POST['date_day'];
	$dt	= $date_year . '-' . $date_month . '-' . $date_day;
	//echo $dt;
	
	$datestamp = date("Y/m/d", strtotime($dt));
	
	 exit();
	 ?>

	
<?php

html_page_bottom();