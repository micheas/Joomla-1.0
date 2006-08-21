<?php
/**
* @version $Id$
* @package Joomla
* @subpackage Installer
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

// XML library
require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php' );
require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$element 	= mosGetParam( $_REQUEST, 'element', '' );
$client 	= mosGetParam( $_REQUEST, 'client', '' );
$path 		= $mosConfig_absolute_path . "/administrator/components/com_installer/$element/$element.php";

// ensure user has access to this function
if ( !$acl->acl_check( 'administration', 'install', 'users', $my->usertype, $element . 's', 'all' ) ) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

// map the element to the required derived class
$classMap = array(
	'component' => 'mosInstallerComponent',
	'language' 	=> 'mosInstallerLanguage',
	'mambot' 	=> 'mosInstallerMambot',
	'module' 	=> 'mosInstallerModule',
	'template' 	=> 'mosInstallerTemplate'
);

if (array_key_exists ( $element, $classMap )) {
	require_once( $mainframe->getPath( 'installer_class', $element ) );

	switch ($task) {

		case 'uploadfile':
			uploadPackage( $classMap[$element], $option, $element, $client );
			break;

		case 'installfromdir':
			installFromDirectory( $classMap[$element], $option, $element, $client );
			break;

		case 'remove':
			removeElement( $classMap[$element], $option, $element, $client );
			break;

		default:
			$path = $mosConfig_absolute_path . "/administrator/components/com_installer/$element/$element.php";

			if (file_exists( $path )) {
				require $path;
			} else {
				echo "Installer not found for element [$element]";
			}
			break;
	}
} else {
	echo "Installer not available for element [$element]";
}

/**
* @param string The class name for the installer
* @param string The URL option
* @param string The element name
*/
function uploadPackage( $installerClass, $option, $element, $client ) {
	$installer = new $installerClass();

	// Check if file uploads are enabled
	if (!(bool)ini_get('file_uploads')) {
		HTML_installer::showInstallMessage( "The installer can't continue before file uploads are enabled. Please use the install from directory method.",
			'Installer - Error', $installer->returnTo( $option, $element, $client ) );
		exit();
	}

	// Check that the zlib is available
	if(!extension_loaded('zlib')) {
		HTML_installer::showInstallMessage( "The installer can't continue before zlib is installed",
			'Installer - Error', $installer->returnTo( $option, $element, $client ) );
		exit();
	}

	$userfile = mosGetParam( $_FILES, 'userfile', null );

	if (!$userfile) {
		HTML_installer::showInstallMessage( 'No file selected', 'Upload new module - error',
			$installer->returnTo( $option, $element, $client ));
		exit();
	}

	$userfile_name = $userfile['name'];

	$msg = '';
	$resultdir = uploadFile( $userfile['tmp_name'], $userfile['name'], $msg );

	if ($resultdir !== false) {
		if (!$installer->upload( $userfile['name'] )) {
			HTML_installer::showInstallMessage( $installer->getError(), 'Upload '.$element.' - Upload Failed',
				$installer->returnTo( $option, $element, $client ) );
		}
		$ret = $installer->install();

		HTML_installer::showInstallMessage( $installer->getError(), 'Upload '.$element.' - '.($ret ? 'Success' : 'Failed'),
			$installer->returnTo( $option, $element, $client ) );
		cleanupInstall( $userfile['name'], $installer->unpackDir() );
	} else {
		HTML_installer::showInstallMessage( $msg, 'Upload '.$element.' -  Upload Error',
			$installer->returnTo( $option, $element, $client ) );
	}
}

/**
* Install a template from a directory
* @param string The URL option
*/
function installFromDirectory( $installerClass, $option, $element, $client ) {
	$userfile = mosGetParam( $_REQUEST, 'userfile', '' );

	if (!$userfile) {
		mosRedirect( "index2.php?option=$option&element=module", "Please select a directory" );
	}

	$installer = new $installerClass();

	$path = mosPathName( $userfile );
	if (!is_dir( $path )) {
		$path = dirname( $path );
	}

	$ret = $installer->install( $path );
	HTML_installer::showInstallMessage( $installer->getError(), 'Upload new '.$element.' - '.($ret ? 'Success' : 'Error'), $installer->returnTo( $option, $element, $client ) );
}
/**
*
* @param
*/
function removeElement( $installerClass, $option, $element, $client ) {
	$cid = mosGetParam( $_REQUEST, 'cid', array(0) );
	if (!is_array( $cid )) {
		$cid = array(0);
	}

	$installer 	= new $installerClass();
	$result 	= false;
	if ($cid[0]) {
		$result = $installer->uninstall( $cid[0], $option, $client );
	}

	$msg = $installer->getError();

	mosRedirect( $installer->returnTo( $option, $element, $client ), $result ? 'Success ' . $msg : 'Failed ' . $msg );
}
/**
* @param string The name of the php (temporary) uploaded file
* @param string The name of the file to put in the temp directory
* @param string The message to return
*/
function uploadFile( $filename, $userfile_name, &$msg ) {
	global $mosConfig_absolute_path;
	$baseDir = mosPathName( $mosConfig_absolute_path . '/media' );

	if (file_exists( $baseDir )) {
		if (is_writable( $baseDir )) {
			if (move_uploaded_file( $filename, $baseDir . $userfile_name )) {
				if (mosChmod( $baseDir . $userfile_name )) {
					return true;
				} else {
					$msg = 'Failed to change the permissions of the uploaded file.';
				}
			} else {
				$msg = 'Failed to move uploaded file to <code>/media</code> directory.';
			}
		} else {
			$msg = 'Upload failed as <code>/media</code> directory is not writable.';
		}
	} else {
		$msg = 'Upload failed as <code>/media</code> directory does not exist.';
	}
	return false;
}
?>