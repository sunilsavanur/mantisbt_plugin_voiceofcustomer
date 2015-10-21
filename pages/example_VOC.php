<?php
//require_once( 'ds_sql_api.php' );
html_page_top( );

?>

<br>
</br>

<h2 align="center">Example of Voice of Customer</h2>

<!--//create table-->
<table border="2" align="center">
<!--//create the row counter-->
<?php $numberofrow = 5;?>
<!--//create the for loop-->

<tr><th>ProjectID</th><th>Verbatim</th><th>Client's Need</th><th>Technical Requirement</th><th>CriticalToQuality</th><th>Measurement Criteria</th></tr>
<tr>
<td>Bristol12G</td>
<td>I want support of SAS Zoning</td>
<td>Need to support static as well as dynamic SAS Zoning</td>
<td>The SAS expander to support the “saved” zone parameters, allowing dynamically configured zone tables to be saved in non-volatile memory</td>
<td>Reconfigurability</td>
<td>Ability to support 256 zone groups</td>
</tr>

<tr>
<td>Titan12G</td>
<td>I want support of High Availability</td>
<td>Need to support failure, removal or reset of IO modules gracefully</td>
<td>On failure, reset or removal of the I/O module, the slave must assume the master role with no disruption to I/O or management functionality</td>
<td>Availability</td>
<td>Mean Time Between Failures or Number of times system not responding</td>
</tr>




</table>




<br>
</br>

<?php
	echo '<br /><div class="center">';
	echo lang_get( 'operation_successful' ) . '<br />';
	print_bracket_link( plugin_page( 'VOC_Main_Page' ), lang_get( 'proceed' ) );
	echo '</div>';
	
	html_page_bottom();
?>