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

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

$mosmsg = strval( ( stripslashes( strip_tags( mosGetParam( $_REQUEST, 'mosmsg', '' ) ) ) ) );

// Browser Check
$browserCheck = 0;
if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && isset( $_SERVER['HTTP_REFERER'] ) && strpos($_SERVER['HTTP_REFERER'], $mosConfig_live_site) !== false ) {
	$browserCheck = 1;
}

if ($mosmsg && $browserCheck ) {	
	// limit mosmsg to 200 characters
	if ( strlen( $mosmsg ) > 200 ) {
		$mosmsg = substr( $mosmsg, 0, 200 );
	}	
	?>
	<div class="message">
		<?php echo $mosmsg; ?>
	</div>
	<?php
}
?>