<?php
/**
* @version $Id$
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Set flag that this is a parent file
define( '_VALID_MOS', 1 );

if (!file_exists( '../configuration.php' )) {
	header( 'Location: ../installation/index.php' );
	exit();
}

require_once( '../globals.php' );
require_once( '../configuration.php' );
require_once( $mosConfig_absolute_path . '/includes/joomla.php' );
include_once( $mosConfig_absolute_path . '/language/'. $mosConfig_lang .'.php' );
require_once( $mosConfig_absolute_path . '/administrator/includes/admin.php' );

// must start the session before we create the mainframe object
session_name( md5( $mosConfig_live_site ) );
session_start();

$option 		= strtolower( mosGetParam( $_REQUEST, 'option', '' ) );
$task 			= strval( mosGetParam( $_REQUEST, 'task', '' ) );

// mainframe is an API workhorse, lots of 'core' interaction routines
$mainframe 		= new mosMainFrame( $database, $option, '..', true );

// admin session handling
$my 			= $mainframe->initSessionAdmin( $option, $task );

// initialise some common request directives
$act 			= strtolower( mosGetParam( $_REQUEST, 'act', '' ) );
$section 		= mosGetParam( $_REQUEST, 'section', '' );
$no_html 		= strtolower( mosGetParam( $_REQUEST, 'no_html', '' ) );
$id         	= intval( mosGetParam( $_REQUEST, 'id', 0 ) );

$cur_template 	= $mainframe->getTemplate();

// default admin homepage
if ($option == '') {
	$option = 'com_admin';
}

// set for overlib check
$mainframe->set( 'loadOverlib', false );

// precapture the output of the component
require_once( $mosConfig_absolute_path . '/editor/editor.php' );

ob_start();
if ($path = $mainframe->getPath( 'admin' )) {
		require_once ( $path );
} else {
	?>
	<img src="images/joomla_logo_black.jpg" border="0" alt="<?php echo 'Joomla! Logo'; ?>" />
	<br />
	<?php
}

$_MOS_OPTION['buffer'] = ob_get_contents();
ob_end_clean();

initGzip();

// start the html output
if ($no_html == 0) {
	// loads template file
	if ( !file_exists( $mosConfig_absolute_path .'/administrator/templates/'. $cur_template .'/index.php' ) ) {
		echo 'TEMPLATE '. $cur_template .' NOT FOUND' ;
	} else {
		require_once( $mosConfig_absolute_path .'/administrator/templates/'. $cur_template .'/index.php' );
	}
} else {
	mosMainBody_Admin();
}

// displays queries performed for page
if ($mosConfig_debug) {
	echo $database->_ticker . ' queries executed';
	echo '<pre>';
	foreach ($database->_log as $k=>$sql) {
		echo $k+1 . "\n" . $sql . '<hr />';
	}
}

doGzip();

// if task action is 'save' or 'apply' redo session check
if ( $task == 'save' || $task == 'apply' ) {
	$mainframe->initSessionAdmin( $option, '' );
}
?>