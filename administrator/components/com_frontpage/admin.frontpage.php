<?php
/**
* @version $Id$
* @package Joomla
* @subpackage Content
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

// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' ) | $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_frontpage' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

// call
require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$cid = josGetArrayInts( 'cid' );

switch ($task) {
	case 'publish':
		changeFrontPage( $cid, 1, $option );
		break;

	case 'unpublish':
		changeFrontPage( $cid, 0, $option );
		break;

	case 'archive':
		changeFrontPage( $cid, -1, $option );
		break;

	case 'remove':
		removeFrontPage( $cid, $option );
		break;

	case 'orderup':
		orderFrontPage( intval( $cid[0] ), -1, $option );
		break;

	case 'orderdown':
		orderFrontPage( intval( $cid[0] ), 1, $option );
		break;

	case 'saveorder':
		saveOrder( $cid );
		break;

	case 'accesspublic':
		accessMenu( intval( $cid[0] ), 0 );
		break;

	case 'accessregistered':
		accessMenu( intval( $cid[0] ), 1 );
		break;

	case 'accessspecial':
		accessMenu( intval( $cid[0] ), 2 );
		break;

	default:
		viewFrontPage( $option );
		break;
}


/**
* Compiles a list of frontpage items
*/
function viewFrontPage( $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

	$catid 				= intval( $mainframe->getUserStateFromRequest( "catid{$option}", 'catid', 0 ) );
	$filter_authorid 	= intval( $mainframe->getUserStateFromRequest( "filter_authorid{$option}", 'filter_authorid', 0 ) );
	$filter_sectionid 	= intval( $mainframe->getUserStateFromRequest( "filter_sectionid{$option}", 'filter_sectionid', 0 ) );

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	$search 	= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	if (get_magic_quotes_gpc()) {
		$search	= stripslashes( $search );
	}

	$where = array(
	"c.state >= 0"
	);

	// used by filter
	if ( $filter_sectionid > 0 ) {
		$where[] = "c.sectionid = " . (int) $filter_sectionid;
	}
	if ( $catid > 0 ) {
		$where[] = "c.catid = " . (int) $catid;
	}
	if ( $filter_authorid > 0 ) {
		$where[] = "c.created_by = " . (int) $filter_authorid;
	}

	if ($search) {
		$where[] = "LOWER( c.title ) LIKE '%" . $database->getEscaped( trim( strtolower( $search ) ) ) . "%'";
	}

	// get the total number of records
	$query = "SELECT count(*)"
	. "\n FROM #__content AS c"
	. "\n INNER JOIN #__categories AS cc ON cc.id = c.catid"
	. "\n INNER JOIN #__sections AS s ON s.id = cc.section AND s.scope='content'"
	. "\n INNER JOIN #__content_frontpage AS f ON f.content_id = c.id"
	. (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
	;
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$query = "SELECT c.*, g.name AS groupname, cc.name, s.name AS sect_name, u.name AS editor, f.ordering AS fpordering, v.name AS author"
	. "\n FROM #__content AS c"
	. "\n INNER JOIN #__categories AS cc ON cc.id = c.catid"
	. "\n INNER JOIN #__sections AS s ON s.id = cc.section AND s.scope='content'"
	. "\n INNER JOIN #__content_frontpage AS f ON f.content_id = c.id"
	. "\n INNER JOIN #__groups AS g ON g.id = c.access"
	. "\n LEFT JOIN #__users AS u ON u.id = c.checked_out"
	. "\n LEFT JOIN #__users AS v ON v.id = c.created_by"
	. (count( $where ) ? "\nWHERE " . implode( ' AND ', $where ) : "")
	. "\n ORDER BY f.ordering"
	;
	$database->setQuery( $query, $pageNav->limitstart,$pageNav->limit );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	// get list of categories for dropdown filter
	$query = "SELECT cc.id AS value, cc.title AS text, section"
	. "\n FROM #__categories AS cc"
	. "\n INNER JOIN #__sections AS s ON s.id = cc.section "
	. "\n ORDER BY s.ordering, cc.ordering"
	;
	$categories[] = mosHTML::makeOption( '0', _SEL_CATEGORY );
	$database->setQuery( $query );
	$categories = array_merge( $categories, $database->loadObjectList() );
	$lists['catid'] = mosHTML::selectList( $categories, 'catid', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $catid );

	// get list of sections for dropdown filter
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['sectionid']	= mosAdminMenus::SelectSection( 'filter_sectionid', $filter_sectionid, $javascript );

	// get list of Authors for dropdown filter
	$query = "SELECT c.created_by, u.name"
	. "\n FROM #__content AS c"
	. "\n INNER JOIN #__sections AS s ON s.id = c.sectionid"
	. "\n LEFT JOIN #__users AS u ON u.id = c.created_by"
	. "\n WHERE c.state != -1"
	. "\n AND c.state != -2"
	. "\n GROUP BY u.name"
	. "\n ORDER BY u.name"
	;
	$authors[] = mosHTML::makeOption( '0', _SEL_AUTHOR, 'created_by', 'name' );
	$database->setQuery( $query );
	$authors = array_merge( $authors, $database->loadObjectList() );
	$lists['authorid']	= mosHTML::selectList( $authors, 'filter_authorid', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'created_by', 'name', $filter_authorid );

	HTML_content::showList( $rows, $search, $pageNav, $option, $lists );
}

/**
* Changes the state of one or more content pages
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
*/
function changeFrontPage( $cid=null, $state=0, $option ) {
	global $database, $my;
	
	josSpoofCheck();

	if (count( $cid ) < 1) {
		$action = $state == 1 ? 'publish' : ($state == -1 ? 'archive' : 'unpublish');
		echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	mosArrayToInts( $cid );
	$cids = 'id=' . implode( ' OR id=', $cid );

	$query = "UPDATE #__content"
	. "\n SET state = " . (int) $state
	. "\n WHERE ( $cids )"
	. "\n AND ( checked_out = 0 OR ( checked_out = " . (int) $my->id . " ) )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosContent( $database );
		$row->checkin( $cid[0] );
	}
	
	// clean any existing cache files
	mosCache::cleanCache( 'com_content' );

	mosRedirect( "index2.php?option=$option" );
}

function removeFrontPage( &$cid, $option ) {
	global $database;
	
	josSpoofCheck();

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
		exit;
	}
	$fp = new mosFrontPage( $database );
	foreach ($cid as $id) {
		if (!$fp->delete( (int)$id )) {
			echo "<script> alert('".$fp->getError()."'); </script>\n";
			exit();
		}
		$obj = new mosContent( $database );
		$obj->load( (int)$id );
		$obj->mask = 0;
		if (!$obj->store()) {
			echo "<script> alert('".$fp->getError()."'); </script>\n";
			exit();
		}
	}
	$fp->updateOrder();
	
	// clean any existing cache files
	mosCache::cleanCache( 'com_content' );

	mosRedirect( "index2.php?option=$option" );
}

/**
* Moves the order of a record
* @param integer The increment to reorder by
*/
function orderFrontPage( $uid, $inc, $option ) {
	global $database;
	
	josSpoofCheck();

	$fp = new mosFrontPage( $database );
	$fp->load( (int)$uid );
	$fp->move( $inc );
	
	// clean any existing cache files
	mosCache::cleanCache( 'com_content' );

	mosRedirect( "index2.php?option=$option" );
}

/**
* @param integer The id of the content item
* @param integer The new access level
* @param string The URL option
*/
function accessMenu( $uid, $access ) {
	global $database;
	
	josSpoofCheck();

	$row = new mosContent( $database );
	$row->load( (int)$uid );
	$row->access = $access;

	if ( !$row->check() ) {
		return $row->getError();
	}
	if ( !$row->store() ) {
		return $row->getError();
	}
	
	// clean any existing cache files
	mosCache::cleanCache( 'com_content' );

	mosRedirect( 'index2.php?option=com_frontpage' );
}

function saveOrder( &$cid ) {
	global $database;
	
	josSpoofCheck();

	$total		= count( $cid );
	$order 		= josGetArrayInts( 'order' );
	
	for( $i=0; $i < $total; $i++ ) {
		$query = "UPDATE #__content_frontpage"
		. "\n SET ordering = " . (int) $order[$i]
		. "\n WHERE content_id = " . (int) $cid[$i];
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		// update ordering
		$row = new mosFrontPage( $database );
		$row->load( (int)$cid[$i] );
		$row->updateOrder();
	}
	
	// clean any existing cache files
	mosCache::cleanCache( 'com_content' );

	$msg 	= 'New ordering saved';
	mosRedirect( 'index2.php?option=com_frontpage', $msg );
}
?>
