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

/**
* @param string THe template position
*/
function mosCountAdminModules(  $position='left' ) {
	global $database;

	$query = "SELECT COUNT( m.id )"
	. "\n FROM #__modules AS m"
	. "\n WHERE m.published = '1'"
	. "\n AND m.position = '$position'"
	. "\n AND m.client_id = 1"
	;
	$database->setQuery( $query );

	return $database->loadResult();
}
/**
* Loads admin modules via module position
* @param string The position
* @param int 0 = no style, 1 = tabbed
*/
function mosLoadAdminModules( $position='left', $style=0 ) {
	global $database, $acl, $my;

	$cache =& mosCache::getCache( 'com_content' );

	$query = "SELECT id, title, module, position, content, showtitle, params"
	. "\n FROM #__modules AS m"
	. "\n WHERE m.published = 1"
	. "\n AND m.position = '$position'"
	. "\n AND m.client_id = 1"
	. "\n ORDER BY m.ordering"
	;
	$database->setQuery( $query );
	$modules = $database->loadObjectList();
	if($database->getErrorNum()) {
		echo "MA ".$database->stderr(true);
		return;
	}

	switch ($style) {
		case 1:
			// Tabs
			$tabs = new mosTabs(1);
			$tabs->startPane( 'modules-' . $position );
			foreach ($modules as $module) {
				$params = new mosParameters( $module->params );
				$editAllComponents 	= $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' );
				// special handling for components module
				if ( $module->module != 'mod_components' || ( $module->module == 'mod_components' && $editAllComponents ) ) {
					$tabs->startTab( $module->title, 'module' . $module->id );
					if ( $module->module == '' ) {
						mosLoadCustomModule( $module, $params );
					} else {
						mosLoadAdminModule( substr( $module->module, 4 ), $params );
					}
					$tabs->endTab();
				}
			}
			$tabs->endPane();
			break;

		case 2:
			// Div'd
			foreach ($modules as $module) {
				$params = new mosParameters( $module->params );
				echo '<div>';
				if ( $module->module == '' ) {
					mosLoadCustomModule( $module, $params );
				} else {
					mosLoadAdminModule( substr( $module->module, 4 ), $params );
				}
				echo '</div>';
			}
			break;

		case 0:
		default:
			foreach ($modules as $module) {
				$params = new mosParameters( $module->params );
				if ( $module->module == '' ) {
					mosLoadCustomModule( $module, $params );
				} else {
					mosLoadAdminModule( substr( $module->module, 4 ), $params );
				}
			}
			break;
	}
}
/**
* Loads an admin module
*/
function mosLoadAdminModule( $name, $params=NULL ) {
	global $mosConfig_absolute_path, $mosConfig_live_site;
	global $database, $acl, $my, $mainframe, $option;

	$task = mosGetParam( $_REQUEST, 'task', '' );
	// legacy support for $act
	$act = mosGetParam( $_REQUEST, 'act', '' );

	$name = str_replace( '/', '', $name );
	$name = str_replace( '\\', '', $name );
	$path = "$mosConfig_absolute_path/administrator/modules/mod_$name.php";
	if (file_exists( $path )) {
		require $path;
	}
}

function mosLoadCustomModule( &$module, &$params ) {
	global $mosConfig_absolute_path, $mosConfig_cachepath;

	$rssurl 			= $params->get( 'rssurl', '' );
	$rssitems 			= $params->get( 'rssitems', '' );
	$rssdesc 			= $params->get( 'rssdesc', '' );
	$moduleclass_sfx 	= $params->get( 'moduleclass_sfx', '' );
	$cachePath			= $mosConfig_cachepath .'/';
	
	echo '<table cellpadding="0" cellspacing="0" class="moduletable' . $moduleclass_sfx . '">';

	if ($module->content) {
		echo '<tr>';
		echo '<td>' . $module->content . '</td>';
		echo '</tr>';
	}

	// feed output
	if ( $rssurl ) {
		if (!is_writable( $cachePath )) {
			echo '<tr>';
			echo '<td>Please make cache directory writable.</td>';
			echo '</tr>';
		} else {
			$LitePath = $mosConfig_absolute_path .'/includes/Cache/Lite.php';
			require_once( $mosConfig_absolute_path .'/includes/domit/xml_domit_rss_lite.php');
			$rssDoc = new xml_domit_rss_document_lite();
			$rssDoc->useCacheLite(true, $LitePath, $cachePath, 3600);
			$rssDoc->useHTTPClient(true); 
			$success = $rssDoc->loadRSS( $rssurl );
			
			if ( $success )	{		
				$totalChannels = $rssDoc->getChannelCount();
	
				// special handling for feed encoding
				$encoding = mosCommonHTML::newsfeedEncoding( $rssDoc );
				
				for ($i = 0; $i < $totalChannels; $i++) {
					$currChannel =& $rssDoc->getChannel($i);
					
					$feed_title = $currChannel->getTitle();
					$feed_title = $encoding( $feed_title );
					$feed_title = html_entity_decode($feed_title);
					$feed_title = str_replace('&apos;', "'", $feed_title);				

					echo '<tr>';
					echo '<td><strong><a href="'. $currChannel->getLink() .'" target="_child">';
					echo $feed_title .'</a></strong></td>';
					echo '</tr>';
					
					if ($rssdesc) {
						$feed_descrip = $currChannel->getDescription();
						$feed_descrip = $encoding( $feed_descrip );
						$feed_descrip = html_entity_decode($feed_descrip);
						$feed_descrip = str_replace('&apos;', "'", $feed_descrip);
						
						echo '<tr>';
						echo '<td>'. $feed_descrip .'</td>';
						echo '</tr>';
					}
	
					$actualItems = $currChannel->getItemCount();
					$setItems = $rssitems;
	
					if ($setItems > $actualItems) {
						$totalItems = $actualItems;
					} else {
						$totalItems = $setItems;
					}
	
					for ($j = 0; $j < $totalItems; $j++) {
						$currItem =& $currChannel->getItem($j);
	
						$item_title = $currItem->getTitle();
						$item_title = $encoding( $item_title );
						$item_title = html_entity_decode($item_title);
						$item_title = str_replace('&apos;', "'", $item_title);
						
						$text 		= $currItem->getDescription();
						$text 		= $encoding( $text );
						$text 		= html_entity_decode($text);
						$text 		= str_replace('&apos;', "'", $text);					

						echo '<tr>';
						echo '<td><strong><a href="'. $currItem->getLink() .'" target="_child">';
						echo $item_title .'</a></strong> - '. $text .'</td>';
						echo '</tr>';
					}
				}
			}
		}
	}
	echo '</table>';
}

function mosShowSource( $filename, $withLineNums=false ) {
	ini_set('highlight.html', '000000');
	ini_set('highlight.default', '#800000');
	ini_set('highlight.keyword','#0000ff');
	ini_set('highlight.string', '#ff00ff');
	ini_set('highlight.comment','#008000');

	if (!($source = @highlight_file( $filename, true ))) {
		return 'Operation Failed';
	}
	$source = explode("<br />", $source);

	$ln = 1;

	$txt = '';
	foreach( $source as $line ) {
		$txt .= "<code>";
		if ($withLineNums) {
			$txt .= "<font color=\"#aaaaaa\">";
			$txt .= str_replace( ' ', '&nbsp;', sprintf( "%4d:", $ln ) );
			$txt .= "</font>";
		}
		$txt .= "$line<br /><code>";
		$ln++;
	}
	return $txt;
}

function mosIsChmodable($file) {
	$perms = fileperms($file);

	if ( $perms !== FALSE ) {
		if (@chmod($file, $perms ^ 0001)) {
			@chmod($file, $perms);

			return TRUE;
		} // if
	}

	return FALSE;
} // mosIsChmodable

/**
* @param string An existing base path
* @param string A path to create from the base path
* @param int Directory permissions
* @return boolean True if successful
*/
function mosMakePath($base, $path='', $mode = NULL) {
	global $mosConfig_dirperms;

	// convert windows paths
	$path = str_replace( '\\', '/', $path );
	$path = str_replace( '//', '/', $path );

	// check if dir exists
	if (file_exists( $base . $path )) return true;

	// set mode
	$origmask = NULL;
	if (isset($mode)) {
		$origmask = @umask(0);
	} else {
		if ($mosConfig_dirperms=='') {
			// rely on umask
			$mode = 0777;
		} else {
			$origmask = @umask(0);
			$mode = octdec($mosConfig_dirperms);
		} // if
	} // if

	$parts = explode( '/', $path );
	$n = count( $parts );
	$ret = true;
	if ($n < 1) {
		$ret = @mkdir($base, $mode);
	} else {
		$path = $base;
		for ($i = 0; $i < $n; $i++) {
			$path .= $parts[$i] . '/';
			if (!file_exists( $path )) {
				if (!@mkdir(substr($path,0,-1),$mode)) {
					$ret = false;
					break;
				}
			}
		}
	}
	if (isset($origmask)) {
		@umask($origmask);
	}

	return $ret;
}

function mosMainBody_Admin() {
	echo $GLOBALS['_MOS_OPTION']['buffer'];
}
?>