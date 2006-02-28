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
	global $mosConfig_live_site;
	
	// original text that might be replaced
	$original = 'href="'. $matches[1] .'"';
	
	// disable bot from being applied to mailto tags
	if ( strpos( $matches[1], 'mailto:' ) !== false ) {
		return $original;
	}
	
	if ( strpos( $matches[1], 'index.php?' ) !== false ) {
		if ( substr($matches[1],0,1) == '#' ) {
			// anchor
			$temp 		= split('index.php', $_SERVER['REQUEST_URI']);
			$link 		= sefRelToAbs( 'index.php' . @$temp[1] );
			$replace 	= 'href="'. $link . $matches[1] .'"';
		} else {
			$link 		= sefRelToAbs( $matches[1] );
			$replace 	= 'href="'. $link .'"';
		}
		
		// needed to stop site url being added to external site links
		$count = explode( 'http://', $replace );
		if ( count( $count ) > 2 || strpos( $replace, 'https://' ) !== false ) {
			$replace = str_replace( $mosConfig_live_site .'/', '', $replace );
		}
	
		return $replace;
	} else {
		return $original;
	}
}
?>