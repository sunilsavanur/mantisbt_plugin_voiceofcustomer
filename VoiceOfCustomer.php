<?php
 
class VoiceOfCustomerPlugin extends MantisPlugin {
 
  function register() {
    $this->name        = 'Voice Of Customer';
    $this->description = 'Gives your Mantis VOC powers.';
 
    $this->version     = '1.0';
    $this->requires    = array(
      'MantisCore'       => '1.2.0',
    );
 
    $this->author      = 'Sunil Savanur';
    $this->contact     = 'b3204sunil@gmail.com';
    $this->url         = 'http://sunilsavanur.wordpress.com/';
  }
 
	function events() {
        return array(
            'EVENT_DAILYSCRUM_FOO' => EVENT_TYPE_EXECUTE,
            'EVENT_DAILYSCRUM_BAR' => EVENT_TYPE_CHAIN,
        );
    }
 
	function hooks() {
        return array(
            'EVENT_DAILYSCRUM_FOO' => 'foo',
            'EVENT_DAILYSCRUM_BAR' => 'bar',
			'EVENT_MENU_MAIN' => 'main_voc_menu',
        );
    }
 
    function foo( $p_event ) {
        echo 'In method foo(). ';
    }

    function bar( $p_event, $p_chained_param ) {
        return str_replace( 'foo', 'bar', $p_chained_param );
    }

	function config() {
        return array(
            'foo_or_bar' => 'foo',
        );
	}	

	function init() {
	plugin_event_hook( 'EVENT_PLUGIN_INIT', 'header' );
	}
 
  /**
   * Handle the EVENT_PLUGIN_INIT callback.
   */
	function header() {
	header( 'DailyScrum-Mantis: This Mantis has Voice Of Customer powers.' );
	}

	function main_voc_menu( ) {
		return array( '<a href="' . plugin_page( 'VOC_Main_Page' ) . '">' . ( 'Voice Of Customer' ) . '</a>', );
	}

//	function summary_ds_menu( ) {
	//	return array( '<a href="' . plugin_page( 'summary_daily_scrum' ) . '">' . plugin_lang_get( 'daily_scrum_summary' ) . '</a>', );
	//}

 	
	function schema() {
	}
	
	function plugin_callback_VOC_schema() {
	}
	
	function  plugin_callback_VOC_upgrade()	{
	}
	
	function  plugin_callback_VOC_uninstall()	{
		return array( 'DropTableSQL', array( mantis_voice_of_customer_table ) );
	}
	
}
