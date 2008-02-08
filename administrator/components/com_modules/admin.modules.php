<?php
/**
* @version $Id$
* @package Joomla
* @subpackage Modules
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'modules', 'all' ) | $acl->acl_check( 'administration', 'install', 'users', $my->usertype, 'modules', 'all' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );

$client 	= strval( mosGetParam( $_REQUEST, 'client', '' ) );
$moduleid 	= mosGetParam( $_REQUEST, 'moduleid', null );

$cid 		= josGetArrayInts( 'cid' );

if ($cid[0] == 0 && isset($moduleid) ) {
	$cid[0] = $moduleid;
}

switch ( $task ) {
	case 'copy':
		copyModule( $option, intval( $cid[0] ), $client );
		break;

	case 'new':
		editModule( $option, 0, $client );
		break;

	case 'edit':
		editModule( $option, intval( $cid[0] ), $client );
		break;

	case 'editA':
		editModule( $option, $id, $client );
		break;

	case 'save':
	case 'apply':
		saveModule( $option, $client, $task );
		break;

	case 'remove':
		removeModule( $cid, $option, $client );
		break;

	case 'cancel':
		cancelModule( $option, $client );
		break;

	case 'publish':
	case 'unpublish':
		publishModule( $cid, ($task == 'publish'), $option, $client );
		break;

	case 'orderup':
	case 'orderdown':
		orderModule( intval( $cid[0] ), ($task == 'orderup' ? -1 : 1), $option );
		break;

	case 'accesspublic':
	case 'accessregistered':
	case 'accessspecial':
		accessMenu( intval( $cid[0] ), $task, $option, $client );
		break;

	case 'saveorder':
		saveOrder( $cid, $client );
		break;

	default:
		viewModules( $option, $client );
		break;
}

/**
* Compiles a list of installed or defined modules
*/
function viewModules( $option, $client ) {
	global $database, $my, $mainframe, $mosConfig_list_limit, $mosConfig_absolute_path;

	$filter_position 	= $mainframe->getUserStateFromRequest( "filter_position{$option}{$client}", 'filter_position', 0 );
	$filter_type	 	= $mainframe->getUserStateFromRequest( "filter_type{$option}{$client}", 'filter_type', 0 );
	$limit 				= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart 		= intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	$search 			= $mainframe->getUserStateFromRequest( "search{$option}{$client}", 'search', '' );
	if (get_magic_quotes_gpc()) {
		$search				= stripslashes( $search );
		$filter_position	= stripslashes( $filter_position );
		$filter_type		= stripslashes( $filter_type );
	}

	if ($client == 'admin') {
		$where[] 	= "m.client_id = 1";
		$client_id 	= 1;
	} else {
		$where[] 	= "m.client_id = 0";
		$client_id 	= 0;
		$client 	= '';
	}

	// used by filter
	if ( $filter_position ) {
		$where[] = "m.position = " . $database->Quote( $filter_position );
	}
	if ( $filter_type ) {
		$where[] = "m.module = " . $database->Quote( $filter_type );
	}
	if ( $search ) {
		$where[] = "LOWER( m.title ) LIKE '%" . $database->getEscaped( trim( strtolower( $search ) ) ) . "%'";
	}

	// get the total number of records
	$query = "SELECT COUNT(*)"
	. "\n FROM #__modules AS m"
	. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
	;
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $mosConfig_absolute_path . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$query = "SELECT m.*, u.name AS editor, g.name AS groupname, MIN(mm.menuid) AS pages"
	. "\n FROM #__modules AS m"
	. "\n LEFT JOIN #__users AS u ON u.id = m.checked_out"
	. "\n LEFT JOIN #__groups AS g ON g.id = m.access"
	. "\n LEFT JOIN #__modules_menu AS mm ON mm.moduleid = m.id"
	. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
	. "\n GROUP BY m.id"
	. "\n ORDER BY position ASC, ordering ASC"
	;
	$database->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	// get list of Positions for dropdown filter
	$query = "SELECT t.position AS value, t.position AS text"
	. "\n FROM #__template_positions as t"
	. "\n LEFT JOIN #__modules AS m ON m.position = t.position"
	. "\n WHERE m.client_id = " . (int) $client_id
	. "\n GROUP BY t.position"
	. "\n ORDER BY t.position"
	;
	$positions[] = mosHTML::makeOption( '0', _SEL_POSITION );
	$database->setQuery( $query );
	$positions = array_merge( $positions, $database->loadObjectList() );
	$lists['position']	= mosHTML::selectList( $positions, 'filter_position', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_position" );

	// get list of Positions for dropdown filter
	$query = "SELECT module AS value, module AS text"
	. "\n FROM #__modules"
	. "\n WHERE client_id = " . (int) $client_id
	. "\n GROUP BY module"
	. "\n ORDER BY module"
	;
	$types[] = mosHTML::makeOption( '0', _SEL_TYPE );
	$database->setQuery( $query );
	$types = array_merge( $types, $database->loadObjectList() );
	$lists['type']	= mosHTML::selectList( $types, 'filter_type', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_type" );

	HTML_modules::showModules( $rows, $my->id, $client, $pageNav, $option, $lists, $search );
}

/**
* Compiles information to add or edit a module
* @param string The current GET/POST option
* @param integer The unique id of the record to edit
*/
function copyModule( $option, $uid, $client ) {
	global $database, $my;
	
	josSpoofCheck();

	$row = new mosModule( $database );
	// load the row from the db table
	$row->load( (int)$uid );
	$row->title 		= 'Copy of '.$row->title;
	$row->id 			= 0;
	$row->iscore 		= 0;
	$row->published 	= 0;

	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->checkin();
	if ($client == 'admin') {
		$where = "client_id='1'";
	} else {
		$where = "client_id='0'";
	}
	$row->updateOrder( 'position=' . $database->Quote( $row->position ) . " AND ($where)" );

	$query = "SELECT menuid"
	. "\n FROM #__modules_menu"
	. "\n WHERE moduleid = " . (int) $uid
	;
	$database->setQuery( $query );
	$rows = $database->loadResultArray();

	foreach($rows as $menuid) {
		$query = "INSERT INTO #__modules_menu"
		. "\n SET moduleid = " . (int) $row->id . ", menuid = " . (int) $menuid
		;
		$database->setQuery( $query );
		$database->query();
	}

	mosCache::cleanCache( 'com_content' );
	
	$msg = 'Module Copied ['. $row->title .']';
	mosRedirect( 'index2.php?option='. $option .'&client='. $client, $msg );
}

/**
* Saves the module after an edit form submit
*/
function saveModule( $option, $client, $task ) {
	global $database;
	
	josSpoofCheck();

	$params = mosGetParam( $_POST, 'params', '' );
	if (is_array( $params )) {
		$txt = array();
		foreach ($params as $k=>$v) {
			$txt[] = "$k=$v";
		}
		$_POST['params'] = mosParameters::textareaHandling( $txt );
	}

	$row = new mosModule( $database );
	if (!$row->bind( $_POST, 'selections' )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	$row->checkin();
	if ($client == 'admin') {
		$where = "client_id=1";
	} else {
		$where = "client_id=0";
	}
	$row->updateOrder( 'position=' . $database->Quote( $row->position ) . " AND ($where)" );

	$menus 	= josGetArrayInts( 'selections' );

	// delete old module to menu item associations
	$query = "DELETE FROM #__modules_menu"
	. "\n WHERE moduleid = " . (int) $row->id
	;
	$database->setQuery( $query );
	$database->query();

	// check needed to stop a module being assigned to `All` 
	// and other menu items resulting in a module being displayed twice
	if ( in_array( '0', $menus ) ) {
		// assign new module to `all` menu item associations
		$query = "INSERT INTO #__modules_menu"
		. "\n SET moduleid = " . (int) $row->id . ", menuid = 0"
		;
		$database->setQuery( $query );
		$database->query();
	} else {
		foreach ($menus as $menuid){
			// this check for the blank spaces in the select box that have been added for cosmetic reasons
			if ( $menuid != "-999" ) {
				// assign new module to menu item associations
				$query = "INSERT INTO #__modules_menu"
				. "\n SET moduleid = " . (int) $row->id . ", menuid = " . (int) $menuid
				;
				$database->setQuery( $query );
				$database->query();
			}
		}				
	}

	mosCache::cleanCache( 'com_content' );
	
	switch ( $task ) {
		case 'apply':
			$msg = 'Successfully Saved changes to Module: '. $row->title;
			mosRedirect( 'index2.php?option='. $option .'&client='. $client .'&task=editA&hidemainmenu=1&id='. $row->id, $msg );
			break;

		case 'save':
		default:
			$msg = 'Successfully Saved Module: '. $row->title;
			mosRedirect( 'index2.php?option='. $option .'&client='. $client, $msg );
			break;
	}
}

/**
* Compiles information to add or edit a module
* @param string The current GET/POST option
* @param integer The unique id of the record to edit
*/
function editModule( $option, $uid, $client ) {
	global $database, $my, $mainframe;
	global $mosConfig_absolute_path;

	$lists = array();
	$row = new mosModule( $database );
	// load the row from the db table
	$row->load( (int)$uid );
	// fail if checked out not by 'me'
	if ($row->isCheckedOut( $my->id )) {
		mosErrorAlert( "The module ".$row->title." is currently being edited by another administrator" );
	}

	$row->content = htmlspecialchars( $row->content );

	if ( $uid ) {
		$row->checkout( $my->id );
	}
	// if a new record we must still prime the mosModule object with a default
	// position and the order; also add an extra item to the order list to
	// place the 'new' record in last position if desired
	if ($uid == 0) {
		$row->position 	= 'left';
		$row->showtitle = true;
		//$row->ordering = $l;
		$row->published = 1;
	}


	if ( $client == 'admin' ) {
		$where 				= "client_id = 1";
		$lists['client_id'] = 1;
		$path				= 'mod1_xml';
	} else {
		$where 				= "client_id = 0";
		$lists['client_id'] = 0;
		$path				= 'mod0_xml';
	}
	$query = "SELECT position, ordering, showtitle, title"
	. "\n FROM #__modules"
	. "\n WHERE $where"
	. "\n ORDER BY ordering"
	;
	$database->setQuery( $query );
	if ( !($orders = $database->loadObjectList()) ) {
		echo $database->stderr();
		return false;
	}

	$query = "SELECT position, description"
	. "\n FROM #__template_positions"
	. "\n WHERE position != ''"
	. "\n ORDER BY position"
	;
	$database->setQuery( $query );
	// hard code options for now
	$positions = $database->loadObjectList();

	$orders2 = array();
	$pos = array();
	foreach ($positions as $position) {
		$orders2[$position->position] = array();
		$pos[] = mosHTML::makeOption( $position->position, $position->description );
	}

	$l = 0;
	$r = 0;
	for ($i=0, $n=count( $orders ); $i < $n; $i++) {
		$ord = 0;
		if (array_key_exists( $orders[$i]->position, $orders2 )) {
			$ord =count( array_keys( $orders2[$orders[$i]->position] ) ) + 1;
		}

		$orders2[$orders[$i]->position][] = mosHTML::makeOption( $ord, $ord.'::'.addslashes( $orders[$i]->title ) );
	}

	// build the html select list
	$pos_select = 'onchange="changeDynaList(\'ordering\',orders,document.adminForm.position.options[document.adminForm.position.selectedIndex].value, originalPos, originalOrder)"';
	$active = ( $row->position ? $row->position : 'left' );
	$lists['position'] = mosHTML::selectList( $pos, 'position', 'class="inputbox" size="1" '. $pos_select, 'value', 'text', $active );

	// get selected pages for $lists['selections']
	if ( $uid ) {
		$query = "SELECT menuid AS value"
		. "\n FROM #__modules_menu"
		. "\n WHERE moduleid = " . (int) $row->id
		;
		$database->setQuery( $query );
		$lookup = $database->loadObjectList();
	} else {
		$lookup = array( mosHTML::makeOption( 0, 'All' ) );
	}

	if ( $row->access == 99 || $row->client_id == 1 || $lists['client_id'] ) {
		$lists['access'] 			= 'Administrator<input type="hidden" name="access" value="99" />';
		$lists['showtitle'] 		= 'N/A <input type="hidden" name="showtitle" value="1" />';
		$lists['selections'] 		= 'N/A';
	} else {
		if ( $client == 'admin' ) {
			$lists['access'] 		= 'N/A';
			$lists['selections'] 	= 'N/A';
		} else {
			$lists['access'] 		= mosAdminMenus::Access( $row );
			$lists['selections'] 	= mosAdminMenus::MenuLinks( $lookup, 1, 1 );
		}
		$lists['showtitle'] = mosHTML::yesnoRadioList( 'showtitle', 'class="inputbox"', $row->showtitle );
	}

	// build the html select list for published
	$lists['published'] 			= mosAdminMenus::Published( $row );

	$row->description = '';
	// XML library
	require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php' );
	// xml file for module
	$xmlfile = $mainframe->getPath( $path, $row->module );
	$xmlDoc = new DOMIT_Lite_Document();
	$xmlDoc->resolveErrors( true );
	if ($xmlDoc->loadXML( $xmlfile, false, true )) {
		$root = &$xmlDoc->documentElement;

		if ($root->getTagName() == 'mosinstall' && $root->getAttribute( 'type' ) == 'module' ) {
			$element = &$root->getElementsByPath( 'description', 1 );
			$row->description = $element ? trim( $element->getText() ) : '';
		}
	}

	// get params definitions
	$params = new mosParameters( $row->params, $xmlfile, 'module' );

	HTML_modules::editModule( $row, $orders2, $lists, $params, $option );
}

/**
* Deletes one or more modules
*
* Also deletes associated entries in the #__module_menu table.
* @param array An array of unique category id numbers
*/
function removeModule( &$cid, $option, $client ) {
	global $database, $my;
	
	josSpoofCheck();

	if (count( $cid ) < 1) {
		echo "<script> alert('Select a module to delete'); window.history.go(-1);</script>\n";
		exit;
	}

	mosArrayToInts( $cid );
	$cids = 'id=' . implode( ' OR id=', $cid );

	$query = "SELECT id, module, title, iscore, params"
	. "\n FROM #__modules WHERE ( $cids )"
	;
	$database->setQuery( $query );
	if (!($rows = $database->loadObjectList())) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit;
	}

	$err = array();
	$cid = array();
	foreach ($rows as $row) {
		if ($row->module == '' || $row->iscore == 0) {
			$cid[] = $row->id;
		} else {
			$err[] = $row->title;
		}
		// mod_mainmenu modules only deletable via Menu Manager
		if ( $row->module == 'mod_mainmenu' ) {
			if ( strstr( $row->params, 'mainmenu' ) ) {
				echo "<script> alert('You cannot delete mod_mainmenu module that displays the \'mainmenu\' as it is a core Menu'); window.history.go(-1); </script>\n";
				exit;
			}
		}
	}

	if (count( $cid )) {
		mosArrayToInts( $cid );
		$cids = 'id=' . implode( ' OR id=', $cid );
		$query = "DELETE FROM #__modules"
		. "\n WHERE ( $cids )"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit;
		}
		// mosArrayToInts( $cid ); // just done a few lines earlier
		$cids = 'moduleid=' . implode( ' OR moduleid=', $cid );
		$query = "DELETE FROM #__modules_menu"
		. "\n WHERE ( $cids )"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."');</script>\n";
			exit;
		}
		$mod = new mosModule( $database );
		$mod->ordering = 0;
		$mod->updateOrder( "position='left'" );
		$mod->updateOrder( "position='right'" );
	}

	if (count( $err )) {
		$cids = addslashes( implode( "', '", $err ) );
		echo "<script>alert('Module(s): \'$cids\' cannot be deleted they can only be un-installed as they are Joomla! modules.');</script>\n";
	}

	mosCache::cleanCache( 'com_content' );
	
	mosRedirect( 'index2.php?option='. $option .'&client='. $client );
}

/**
* Publishes or Unpublishes one or more modules
* @param array An array of unique record id numbers
* @param integer 0 if unpublishing, 1 if publishing
*/
function publishModule( $cid=null, $publish=1, $option, $client ) {
	global $database, $my;
	
	josSpoofCheck();

	if (count( $cid ) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('Select a module to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	mosArrayToInts( $cid );
	$cids = 'id=' . implode( ' OR id=', $cid );

	$query = "UPDATE #__modules"
	. "\n SET published = " . (int) $publish
	. "\n WHERE ( $cids )"
	. "\n AND ( checked_out = 0 OR ( checked_out = " . (int) $my->id . " ) )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosModule( $database );
		$row->checkin( $cid[0] );
	}

	mosCache::cleanCache( 'com_content' );
	
	mosRedirect( 'index2.php?option='. $option .'&client='. $client );
}

/**
* Cancels an edit operation
*/
function cancelModule( $option, $client ) {
	global $database;
	
	josSpoofCheck();

	$row = new mosModule( $database );
	// ignore array elements
	$row->bind( $_POST, 'selections params' );
	$row->checkin();

	mosRedirect( 'index2.php?option='. $option .'&client='. $client );
}

/**
* Moves the order of a record
* @param integer The unique id of record
* @param integer The increment to reorder by
*/
function orderModule( $uid, $inc, $option ) {
	global $database;
	
	josSpoofCheck();

	$client = strval( mosGetParam( $_POST, 'client', '' ) );

	$row = new mosModule( $database );
	$row->load( (int)$uid );
	if ($client == 'admin') {
		$where = "client_id = 1";
	} else {
		$where = "client_id = 0";
	}

	$row->move( $inc, "position = " . $database->Quote( $row->position ) . " AND ( $where )"  );
	if ( $client ) {
		$client = '&client=admin' ;
	} else {
		$client = '';
	}

	mosCache::cleanCache( 'com_content' );
	
	mosRedirect( 'index2.php?option='. $option .'&client='. $client );
}

/**
* changes the access level of a record
* @param integer The increment to reorder by
*/
function accessMenu( $uid, $access, $option, $client ) {
	global $database;
	
	josSpoofCheck();

	switch ( $access ) {
		case 'accesspublic':
			$access = 0;
			break;

		case 'accessregistered':
			$access = 1;
			break;

		case 'accessspecial':
			$access = 2;
			break;
	}

	$row = new mosModule( $database );
	$row->load( (int)$uid );
	$row->access = $access;

	if ( !$row->check() ) {
		return $row->getError();
	}
	if ( !$row->store() ) {
		return $row->getError();
	}

	mosCache::cleanCache( 'com_content' );
	
	mosRedirect( 'index2.php?option='. $option .'&client='. $client );
}

function saveOrder( &$cid, $client ) {
	global $database;
	
	josSpoofCheck();

	$total		= count( $cid );
	$order 		= josGetArrayInts( 'order' );
	
	$row 		= new mosModule( $database );
	$conditions = array();

	// update ordering values
	for( $i=0; $i < $total; $i++ ) {
		$row->load( (int) $cid[$i] );
		if ($row->ordering != $order[$i]) {
			$row->ordering = $order[$i];
			if (!$row->store()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			} // if
			// remember to updateOrder this group
			$condition = "position = " . $database->Quote( $row->position ) . " AND client_id = " . (int) $row->client_id;
			$found = false;
			foreach ( $conditions as $cond )
				if ($cond[1]==$condition) {
					$found = true;
					break;
				} // if
			if (!$found) $conditions[] = array($row->id, $condition);
		} // if
	} // for

	// execute updateOrder for each group
	foreach ( $conditions as $cond ) {
		$row->load( $cond[0] );
		$row->updateOrder( $cond[1] );
	} // foreach

	mosCache::cleanCache( 'com_content' );
	
	$msg 	= 'New ordering saved';
	mosRedirect( 'index2.php?option=com_modules&client='. $client, $msg );
} // saveOrder
?>
