<?php
/**
* @version $Id$
* @package Joomla
* @subpackage Admin
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
require_once( $mainframe->getPath( 'admin_html' ) );

switch ($task) {

	case 'clean_cache':
		mosCache::cleanCache( 'com_content' );
		mosRedirect( 'index2.php', 'Content caches cleaned' );
		break;

	case 'clean_all_cache':
		mosCache::cleanCache();
		mosRedirect( 'index2.php', 'All caches cleaned' );
		break;

	case 'redirect':
		$goto = strval( strtolower( mosGetParam( $_REQUEST, 'link' ) ) );
		if ($goto == 'null') {
			$msg = 'There is no link associated with this item';
			mosRedirect( 'index2.php?option=com_admin&task=listcomponents', $msg );
			exit();
		}
		$goto = str_replace( "'", '', $goto );
		mosRedirect( $goto );
		break;

	case 'listcomponents':
		HTML_admin_misc::ListComponents();
		break;

	case 'sysinfo':
		HTML_admin_misc::system_info( $version, $option );
		break;

	case 'changelog':
		HTML_admin_misc::changelog();
		break;

	case 'help':
		HTML_admin_misc::help();
		break;

	case 'version':
		HTML_admin_misc::version();
		break;
	
	case 'preview':
		HTML_admin_misc::preview();
		break;

	case 'preview2':
		HTML_admin_misc::preview( 1 );
		break;

	case 'versioncheck':
		HTML_admin_misc::versionCheck();
		break;

	case 'uptodate':
		uptodate();
		break;

	case 'cpanel':
	default:
		HTML_admin_misc::controlPanel();
		break;

}

function uptodate(){
	global $database, $mainframe, $mosConfig_absolute_path, $mosConfig_cachepath, $Itemid, $my;
	
	// check if cache directory is writeable
	$cacheDir = $mosConfig_cachepath .'/';
	if ( !is_writable( $cacheDir ) ) {	
		echo 'Cache Directory Unwriteable';
		return;
	}

	$uptodate 	= '&nbsp;<span style="color: black;">Unknown</span>';
	
	$_VERSION 			= new joomlaVersion();			
	 	
	$versioninfo 		= $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL;
	if (strpos(strtolower($_VERSION->DEV_STATUS), 'beta') == 0) {
		$versioninfo 	.= 'beta'; 
	} else if (strpos(strtolower($_VERSION->DEV_STATUS), 'svn') == 0) {
		$versioninfo 	.= 'svn';			
	}
	$url				= 'http://www.joomla.org/index.php?option=com_rss_xtd&feed=RSS2.0&version='. $versioninfo .'&type=versioncheck';
	
	// full RSS parser used to access image information
	require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_rss.php');
	$LitePath = $mosConfig_absolute_path . '/includes/Cache/Lite.php';

	// full RSS parser used to access image information
	$rssDoc 	= new xml_domit_rss_document();
	$rssDoc->useCacheLite( true, $LitePath, $cacheDir, 86400 );
	$success 	= $rssDoc->loadRSS( $url );
	
	if ( $success ) {
		$currChannel	=& $rssDoc->getChannel(0);		
		$totalItems		= $currChannel->getItemCount();
	
		if ($totalItems > 1) {				
			// load data from feed item
			$currItem 	=& $currChannel->getItem(1);
			
			// check to see if the item loaded is the Status info
			$rawtitle 	= '';
			$rawtitle 	= strtolower($currItem->getTitle());							
			if ($rawtitle == 'status') {	
				// Status Information
				$rawdata 	= $currItem->getDescription();
				$rawdata 	= str_replace('||', '&', $rawdata);
				parse_str($rawdata, $data);
				
				if ($data['outofdate'] == 1) {
					$uptodate 	= '&nbsp;<span style="color: red;">OUT OF DATE</span>&nbsp;';
					$uptodate 	.= '<img src="../images/publish_x.png"  style="vertical-align: middle;" />';				
				} else if ($data['outofdate'] == 0) {
					$uptodate 	= '&nbsp;<span style="color: green;">UP-TO-DATE</span>&nbsp;';
					$uptodate 	.= '<img src="../images/tick.png"  style="vertical-align: middle;" />';
				} else {
					$uptodate 	= '&nbsp;<span style="color: black;">Unknown</span>';
				}
			}
		}		
	}	
	
	echo $uptodate;
}
?>