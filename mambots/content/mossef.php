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

$_MAMBOTS->registerFunction( 'onPrepareContent', 'botMosSef' );

/**
* Converting internal relative links to SEF URLs
*
* <b>Usage:</b>
* <code><a href="...relative link..."></code>
*/
function botMosSef( $published, &$row, &$params, $page=0 ) {
	global $mosConfig_sef;
	
	// check whether mambot has been unpublished
	if ( !$published ) {
		return true;
	}
	
	// check whether SEF is off
	if ( !$mosConfig_sef ) {
		return true;
	}
	
	// simple performance check to determine whether bot should process further
	if ( strpos( $row->text, 'href="' ) === false ) {
		return true;
	}
	
	// define the regular expression for the bot
	$regex = "#href=\"(.*?)\"#s";

	// perform the replacement
	$row->text = preg_replace_callback( $regex, 'botMosSef_replacer', $row->text );

	return true;
}

/**
* Replaces the matched tags
* @param array An array of matches (see preg_match_all)
* @return string
*/
function botMosSef_replacer( &$matches ) {
	// original text that might be replaced
	$original = 'href="'. $matches[1] .'"';

	// array list of non http/https	URL schemes
	$url_schemes = explode( ', ', _URL_SCHEMES );
	
	foreach ( $url_schemes as $url ) {
		// disable bot from being applied to specific URL Scheme tag
		if ( strpos( $matches[1], $url ) !== false ) {
			return $original;
		}
	}

	if ( strpos( $matches[1], 'index.php?option' ) !== false  ) {
	// links containing 'index.php?option
		// convert url to SEF link
		$link 		= sefRelToAbs( $matches[1] );
		// reconstruct html output
		$replace 	= 'href="'. $link .'"';
		
		return $replace;
	} else if ( strpos( $matches[1], '#' ) === 0 ) {
	// special handling for anchor only links
		$url = $_SERVER['REQUEST_URI'];
		$url = explode( '?option', $url );
		
		if (is_array($url) && isset($url[1])) {
			$link = 'index.php?option'. $url[1] ;
			// convert url to SEF link
			$link 		= sefRelToAbs( $link ) . $matches[1];
		} else {
			$link = $matches[1];
			// convert url to SEF link
			$link 		= sefRelToAbs( $link );
		}
		// reconstruct html output
		$replace 	= 'href="'. $link .'"';
		
		return $replace;
	} else {
		return $original;
	}
}
?>
	