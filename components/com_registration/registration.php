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

global $mosConfig_frontend_login;

require_once( $mainframe->getPath( 'front_html' ) );

if ( $mosConfig_frontend_login != NULL && ($mosConfig_frontend_login === 0 || $mosConfig_frontend_login === '0')) {
	echo _NOT_AUTH;
	return;
}

switch( $task ) {
	case 'lostPassword':
		lostPassForm( $option );
		break;

	case 'sendNewPass':
		sendNewPass( $option );
		break;

	case 'register':
		registerForm( $option, $mosConfig_useractivation );
		break;

	case 'saveRegistration':
		saveRegistration();
		break;

	case 'activate':
		activate( $option );
		break;
}

function lostPassForm( $option ) {
	global $mainframe;

	$mainframe->SetPageTitle(_PROMPT_PASSWORD);

	HTML_registration::lostPassForm($option);
}

function sendNewPass( $option ) {
	global $database;
	global $mosConfig_live_site, $mosConfig_sitename;
	global $mosConfig_mailfrom, $mosConfig_fromname;

	// simple spoof check security
	josSpoofCheck();

	$_live_site = $mosConfig_live_site;
	$_sitename 	= $mosConfig_sitename;

	$checkusername	= stripslashes( mosGetParam( $_POST, 'checkusername', '' ) );
	$confirmEmail	= stripslashes( mosGetParam( $_POST, 'confirmEmail', '') );

	$query = "SELECT id"
	. "\n FROM #__users"
	. "\n WHERE username = " . $database->Quote( $checkusername )
	. "\n AND email = " . $database->Quote( $confirmEmail )
	;
	$database->setQuery( $query );
	if (!($user_id = $database->loadResult()) || !$checkusername || !$confirmEmail) {
		mosRedirect( "index.php?option=$option&task=lostPassword&mosmsg="._ERROR_PASS );
	}

	$newpass = mosMakePassword();
	$message = _NEWPASS_MSG;
	eval ("\$message = \"$message\";");
	$subject = _NEWPASS_SUB;
	eval ("\$subject = \"$subject\";");

	mosMail($mosConfig_mailfrom, $mosConfig_fromname, $confirmEmail, $subject, $message);

	$newpass = md5( $newpass );
	$sql = "UPDATE #__users"
	. "\n SET password = " . $database->Quote( $newpass )
	. "\n WHERE id = " . (int) $user_id
	;
	$database->setQuery( $sql );
	if (!$database->query()) {
		die("SQL error" . $database->stderr(true));
	}

	mosRedirect( 'index.php?option=com_registration&mosmsg='. _NEWPASS_SENT );
}

function registerForm( $option, $useractivation ) {
	global $mainframe;

	if (!$mainframe->getCfg( 'allowUserRegistration' )) {
		mosNotAuth();
		return;
	}

  	$mainframe->SetPageTitle(_REGISTER_TITLE);

	HTML_registration::registerForm($option, $useractivation);
}

function saveRegistration() {
	global $database, $acl;
	global $mosConfig_sitename, $mosConfig_live_site, $mosConfig_useractivation, $mosConfig_allowUserRegistration;
	global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailfrom, $mosConfig_fromname;

	if ( $mosConfig_allowUserRegistration == 0 ) {
		mosNotAuth();
		return;
	}

	// simple spoof check security
	josSpoofCheck();

	$row = new mosUser( $database );

	if (!$row->bind( $_POST, 'usertype' )) {
		mosErrorAlert( $row->getError() );
	}

	mosMakeHtmlSafe($row);

	$row->id 		= 0;
	$row->usertype 	= '';
	$row->gid 		= $acl->get_group_id( 'Registered', 'ARO' );

	if ( $mosConfig_useractivation == 1 ) {
		$row->activation = md5( mosMakePassword() );
		$row->block = '1';
	}

	if (!$row->check()) {
		echo "<script> alert('".html_entity_decode($row->getError())."'); window.history.go(-1); </script>\n";
		exit();
	}

	$pwd 				= $row->password;
	$row->password 		= md5( $row->password );
	$row->registerDate 	= date( 'Y-m-d H:i:s' );

	if (!$row->store()) {
		echo "<script> alert('".html_entity_decode($row->getError())."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->checkin();

	$name 		= trim($row->name);
	$email 		= trim($row->email);
	$username 	= trim($row->username);

	$subject 	= sprintf (_SEND_SUB, $name, $mosConfig_sitename);
	$subject 	= html_entity_decode($subject, ENT_QUOTES);

	if ($mosConfig_useractivation == 1){
		$message = sprintf (_USEND_MSG_ACTIVATE, $name, $mosConfig_sitename, $mosConfig_live_site."/index.php?option=com_registration&task=activate&activation=".$row->activation, $mosConfig_live_site, $username, $pwd);
	} else {
		$message = sprintf (_USEND_MSG, $name, $mosConfig_sitename, $mosConfig_live_site);
	}

	$message = html_entity_decode($message, ENT_QUOTES);

	// check if Global Config `mailfrom` and `fromname` values exist
	if ($mosConfig_mailfrom != '' && $mosConfig_fromname != '') {
		$adminName2 	= $mosConfig_fromname;
		$adminEmail2 	= $mosConfig_mailfrom;
	} else {
	// use email address and name of first superadmin for use in email sent to user
		$query = "SELECT name, email"
		. "\n FROM #__users"
		. "\n WHERE LOWER( usertype ) = 'superadministrator'"
		. "\n OR LOWER( usertype ) = 'super administrator'"
		;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		$row2 			= $rows[0];

		$adminName2 	= $row2->name;
		$adminEmail2 	= $row2->email;
	}

	// Send email to user
	mosMail($adminEmail2, $adminName2, $email, $subject, $message);

	// Send notification to all administrators
	$subject2 = sprintf (_SEND_SUB, $name, $mosConfig_sitename);
	$message2 = sprintf (_ASEND_MSG, $adminName2, $mosConfig_sitename, $row->name, $email, $username);
	$subject2 = html_entity_decode($subject2, ENT_QUOTES);
	$message2 = html_entity_decode($message2, ENT_QUOTES);

	// get email addresses of all admins and superadmins set to recieve system emails
	$query = "SELECT email, sendEmail"
	. "\n FROM #__users"
	. "\n WHERE ( gid = 24 OR gid = 25 )"
	. "\n AND sendEmail = 1"
	. "\n AND block = 0"
	;
	$database->setQuery( $query );
	$admins = $database->loadObjectList();

	foreach ( $admins as $admin ) {
		// send email to admin & super admin set to recieve system emails
		mosMail($adminEmail2, $adminName2, $admin->email, $subject2, $message2);
	}

	if ( $mosConfig_useractivation == 1 ){
		echo _REG_COMPLETE_ACTIVATE;
	} else {
		echo _REG_COMPLETE;
	}
}

function activate( $option ) {
	global $database, $my;
	global $mosConfig_useractivation, $mosConfig_allowUserRegistration;

	if($my->id) {
		// They're already logged in, so redirect them to the home page
		mosRedirect( 'index.php' );
	}


	if ($mosConfig_allowUserRegistration == '0' || $mosConfig_useractivation == '0') {
		mosNotAuth();
		return;
	}

	$activation = stripslashes( mosGetParam( $_REQUEST, 'activation', '' ) );

	if (empty( $activation )) {
		echo _REG_ACTIVATE_NOT_FOUND;
		return;
	}

	$query = "SELECT id"
	. "\n FROM #__users"
	. "\n WHERE activation = " . $database->Quote( $activation )
	. "\n AND block = 1"
	;
	$database->setQuery( $query );
	$result = $database->loadResult();

	if ($result) {
		$query = "UPDATE #__users"
		. "\n SET block = 0, activation = ''"
		. "\n WHERE activation = " . $database->Quote( $activation )
		. "\n AND block = 1"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			if(!defined(_REG_ACTIVATE_FAILURE)) {
				DEFINE('_REG_ACTIVATE_FAILURE', '<div class="componentheading">Activation Failed!</div><br />The system was unable to activate your account, please contact the site administrator.');
			}
			echo "SQL error" . $database->stderr(true);
			echo _REG_ACTIVATE_FAILURE;
		} else {
			echo _REG_ACTIVATE_COMPLETE;
		}
	} else {
		echo _REG_ACTIVATE_NOT_FOUND;
	}
}
?>
