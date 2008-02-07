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
	. "\n WHERE m.published = 1"
	. "\n AND m.position = " . $database->Quote( $position )
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
	. "\n AND m.position = " . $database->Quote( $position )
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
	global $mosConfig_absolute_path, $mosConfig_live_site, $task;
	global $database, $acl, $my, $mainframe, $option;

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
	$rsscache			= $params->get( 'rsscache', 3600 );
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
			$rssDoc->setRSSTimeout(5);
			$rssDoc->useHTTPClient(true);
			$rssDoc->useCacheLite(true, $LitePath, $cachePath, $rsscache);
			$success = $rssDoc->loadRSS( $rssurl );

			if ( $success )	{
				$totalChannels = $rssDoc->getChannelCount();

				for ($i = 0; $i < $totalChannels; $i++) {
					$currChannel =& $rssDoc->getChannel($i);

					$feed_title = $currChannel->getTitle();
					$feed_title = mosCommonHTML::newsfeedEncoding( $rssDoc, $feed_title );

					echo '<tr>';
					echo '<td><strong><a href="'. $currChannel->getLink() .'" target="_child">';
					echo $feed_title .'</a></strong></td>';
					echo '</tr>';

					if ($rssdesc) {
						$feed_descrip = $currChannel->getDescription();
						$feed_descrip = mosCommonHTML::newsfeedEncoding( $rssDoc, $feed_descrip );

						echo '<tr>';
						echo '<td>'. $feed_descrip .'</td>';
						echo '</tr>';
					}

					$actualItems 	= $currChannel->getItemCount();
					$setItems 		= $rssitems;

					if ($setItems > $actualItems) {
						$totalItems = $actualItems;
					} else {
						$totalItems = $setItems;
					}

					for ($j = 0; $j < $totalItems; $j++) {
						$currItem =& $currChannel->getItem($j);

						$item_title = $currItem->getTitle();
						$item_title = mosCommonHTML::newsfeedEncoding( $rssDoc, $item_title );

						$text 		= $currItem->getDescription();
						$text 		= mosCommonHTML::newsfeedEncoding( $rssDoc, $text );

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
	// ensure a clean join with a single slash
	$path = ltrim( $path, '/' );
	$base = rtrim( $base, '/' ).'/';

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
		if (substr( $base, -1, 1 ) == '/') {
			$base = substr( $base, 0, -1 );
		}
		$ret = @mkdir($base, $mode);
	} else {
		$path = $base;
		for ($i = 0; $i < $n; $i++) {
			// don't add if part is empty
			if ($parts[$i]) {
				$path .= $parts[$i] . '/';
			}
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

/*
 * Added 1.0.11
 */
function josSecurityCheck($width='95%') {
	$wrongSettingsTexts = array();

	if ( ini_get('magic_quotes_gpc') != '1' ) {
		$wrongSettingsTexts[] = 'PHP magic_quotes_gpc setting is `OFF` instead of `ON`';
	}
	if ( ini_get('register_globals') == '1' ) {
		$wrongSettingsTexts[] = 'PHP register_globals setting is `ON` instead of `OFF`';
	}
	if ( RG_EMULATION != 0 ) {
		$wrongSettingsTexts[] = 'Joomla! &quot;Register Globals Emulation&quot; setting is `ON`. &nbsp; To disable Register Globals Emulation, navigate to Site -> Global Configuration -> Server, select `OFF`, and save.<br /><span style="font-weight: normal; font-style: italic; color: #666;">Register Globals Emulation is `ON` by default for backward compatibility.</span>';
	}

	if ( count($wrongSettingsTexts) ) {
		?>
		<div style="clear: both; margin: 3px; margin-top: 10px; padding: 5px 15px; display: block; float: left; border: 1px solid #cc0000; background: #ffffcc; text-align: left; width: <?php echo $width;?>;">
			<p style="color: #CC0000;">
				Following PHP Server Settings are not optimal for <strong>Security</strong> and it is recommended to change them:
			</p>
			<ul style="margin: 0px; padding: 0px; padding-left: 15px; list-style: none;" >
				<?php
				foreach ($wrongSettingsTexts as $txt) {
					?>
					<li style="min-height: 25px; padding-bottom: 5px; padding-left: 25px; color: red; font-weight: bold; background-image: url(../includes/js/ThemeOffice/warning.png); background-repeat: no-repeat; background-position: 0px 2px;" >
						<?php
						echo $txt;
						?>
					</li>
					<?php
				}
				?>
			</ul>
			<p style="color: #666;">
				Please check <a href="http://www.joomla.org/security10" target="_blank" style="color: blue; text-decoration: underline">the Official Joomla! Server Security post</a> for more information.
			</p>
		</div>
		<?php
	}
}
?>
