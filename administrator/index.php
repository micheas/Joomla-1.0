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

require( '../globals.php' );
require_once( '../configuration.php' );

// SSL check - $http_host returns <live site url>:<port number if it is 443>
$http_host = explode(':', $_SERVER['HTTP_HOST'] );
if( (!empty( $_SERVER['HTTPS'] ) && strtolower( $_SERVER['HTTPS'] ) != 'off' || isset( $http_host[1] ) && $http_host[1] == 443) && substr( $mosConfig_live_site, 0, 8 ) != 'https://' ) {
	$mosConfig_live_site = 'https://'.substr( $mosConfig_live_site, 7 );
}

require_once( '../includes/joomla.php' );
include_once ( $mosConfig_absolute_path . '/language/'. $mosConfig_lang .'.php' );

//Installation sub folder check, removed for work with SVN
if (file_exists( '../installation/index.php' ) && $_VERSION->SVN == 0) {
	define( '_INSTALL_CHECK', 1 );
	include ($mosConfig_absolute_path .'/offline.php');
	exit();
}

$option = strtolower( strval( mosGetParam( $_REQUEST, 'option', NULL ) ) );

// mainframe is an API workhorse, lots of 'core' interaction routines
$mainframe = new mosMainFrame( $database, $option, '..', true );

if (isset( $_POST['submit'] )) {
	/** escape and trim to minimise injection of malicious sql */
	$usrname 	= stripslashes( mosGetParam( $_POST, 'usrname', NULL ) );
	$pass 		= stripslashes( mosGetParam( $_POST, 'pass', NULL ) );

	if($pass == NULL) {
		echo "<script>alert('Please enter a password'); document.location.href='index.php?mosmsg=Please enter a password'</script>\n";
		exit();
	} else {
		$pass = trim( $pass );
	}

	$query = "SELECT COUNT(*)"
	. "\n FROM #__users"
	. "\n WHERE ("
	// Administrators
	. "\n gid = 24"
	// Super Administrators
	. "\n OR gid = 25"
	. "\n )"
	;
	$database->setQuery( $query );
	$count = intval( $database->loadResult() );
	if ($count < 1) {
		mosErrorAlert( _LOGIN_NOADMINS );
	}

	$my = null;
	$query = "SELECT u.*, m.*"
	. "\n FROM #__users AS u"
	. "\n LEFT JOIN #__messages_cfg AS m ON u.id = m.user_id AND m.cfg_name = 'auto_purge'"
	. "\n WHERE u.username = " . $database->Quote( $usrname )
	. "\n AND u.block = 0"
	;
	$database->setQuery( $query );
	$database->loadObject( $my );

	/** find the user group (or groups in the future) */
	if (@$my->id) {
		$grp 			= $acl->getAroGroup( $my->id );
		$my->gid 		= $grp->group_id;
		$my->usertype 	= $grp->name;

		// Conversion to new type
		if ((strpos($my->password, ':') === false) && $my->password == md5($pass)) {
			// Old password hash storage but authentic ... lets convert it
			$salt = mosMakePassword(16);
			$crypt = md5($pass.$salt);
			$my->password = $crypt.':'.$salt;

			// Now lets store it in the database
			$query = 'UPDATE #__users ' .
					'SET password = '.$database->Quote($my->password) .
					'WHERE id = '.(int)$my->id;
			$database->setQuery($query);
			if (!$database->query()) {
				// This is an error but not sure what to do with it ... we'll still work for now
			}
		}

		list($hash, $salt) = explode(':', $my->password);
		$cryptpass = md5($pass.$salt);

		if ( strcmp( $hash, $cryptpass ) || !$acl->acl_check( 'administration', 'login', 'users', $my->usertype ) ) {
			mosErrorAlert("Incorrect Username, Password, or Access Level.  Please try again", "document.location.href='index.php'");
		}

		session_name( md5( $mosConfig_live_site ) );
		session_start();

		// construct Session ID
		$session_id = session_id();

		// add Session ID entry to DB
		$query = "INSERT INTO #__session"
		. "\n SET time = " . $database->Quote( $logintime ) . ", session_id = " . $database->Quote( $session_id ) . ", userid = " . (int) $my->id . ", usertype = " . $database->Quote( $my->usertype) . ", username = " . $database->Quote( $my->username )
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo $database->stderr();
		}

		// check if site designated as a production site
		// for a demo site allow multiple logins with same user account
		if ( $_VERSION->SITE == 1 ) {
			// delete other open admin sessions for same account
			$query = "DELETE FROM #__session"
			. "\n WHERE userid = " . (int) $my->id
			. "\n AND username = " . $database->Quote( $my->username )
			. "\n AND usertype = " . $database->Quote( $my->usertype )
			. "\n AND session_id != " . $database->Quote( $session_id )
			// this ensures that frontend sessions are not purged
			. "\n AND guest = 1"
			. "\n AND gid = 0"
			;
			$database->setQuery( $query );
			if (!$database->query()) {
				echo $database->stderr();
			}
		}

		$_SESSION['session_id'] 			= $session_id;
		$_SESSION['session_user_id'] 		= $my->id;
		$_SESSION['session_username'] 		= $my->username;
		$_SESSION['session_usertype'] 		= $my->usertype;
		$_SESSION['session_gid'] 			= $my->gid;
		$_SESSION['session_logintime'] 		= $logintime;
		$_SESSION['session_user_params']	= $my->params;
		$_SESSION['session_userstate'] 		= array();

		session_write_close();

		$expired = 'index2.php';

		// check if site designated as a production site
		// for a demo site disallow expired page functionality
		if ( $_VERSION->SITE == 1 && @$mosConfig_admin_expired === '1' ) {
			$file 	= $mainframe->getPath( 'com_xml', 'com_users' );
			$params =& new mosParameters( $my->params, $file, 'component' );

			$now 	= time();

			// expired page functionality handling
			$expired 		= $params->def( 'expired', '' );
			$expired_time 	= $params->def( 'expired_time', '' );

			// if now expired link set or expired time is more than half the admin session life set, simply load normal admin homepage
			$checktime = ( $mosConfig_session_life_admin ? $mosConfig_session_life_admin : 1800 ) / 2;
			if (!$expired || ( ( $now - $expired_time ) > $checktime ) ) {
				$expired = 'index2.php';
			}
			// link must also be a Joomla link to stop malicious redirection
			if ( strpos( $expired, 'index2.php?option=com_' ) !== 0 ) {
				$expired = 'index2.php';
			}

			// clear any existing expired page data
			$params->set( 'expired', '' );
			$params->set( 'expired_time', '' );

			// param handling
			if (is_array( $params->toArray() )) {
				$txt = array();
				foreach ( $params->toArray() as $k=>$v) {
					$txt[] = "$k=$v";
				}
				$saveparams = implode( "\n", $txt );
			}

			// save cleared expired page info to user data
			$query = "UPDATE #__users"
			. "\n SET params = " . $database->Quote( $saveparams )
			. "\n WHERE id = " . (int) $my->id
			. "\n AND username = " . $database->Quote( $my->username )
			. "\n AND usertype = " . $database->Quote( $my->usertype )
			;
			$database->setQuery( $query );
			$database->query();
		}

		// check if auto_purge value set
		if ( $my->cfg_name == 'auto_purge' ) {
			$purge 	= $my->cfg_value;
		} else {
		// if no value set, default is 7 days
			$purge 	= 7;
		}
		// calculation of past date
		$past = date( 'Y-m-d H:i:s', time() - $purge * 60 * 60 * 24 );

		// if purge value is not 0, then allow purging of old messages
		if ($purge != 0) {
		// purge old messages at day set in message configuration
			$query = "DELETE FROM #__messages"
			. "\n WHERE date_time < " . $database->Quote( $past )
			. "\n AND user_id_to = " . (int) $my->id
			;
			$database->setQuery( $query );
			if (!$database->query()) {
				echo $database->stderr();
			}
		}

		/** cannot using mosredirect as this stuffs up the cookie in IIS */
		// redirects page to admin homepage by default or expired page
		echo "<script>document.location.href='$expired';</script>\n";
		exit();
	} else {
		mosErrorAlert("Incorrect Username, Password.  Please try again", "document.location.href='index.php?mosmsg=Incorrect Username, Password. Please try again'");
	}
} else {
	initGzip();
	$path = $mosConfig_absolute_path . '/administrator/templates/' . $mainframe->getTemplate() . '/login.php';
	require_once( $path );
	doGzip();
}
?>