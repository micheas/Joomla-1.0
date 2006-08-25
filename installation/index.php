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

if (file_exists( '../configuration.php' ) && filesize( '../configuration.php' ) > 10) {
	header( "Location: ../index.php" );
	exit();
}
require( '../globals.php' );
require_once( '../includes/version.php' );

/** Include common.php */
include_once( 'common.php' );

$task 		= mosGetParam( $_GET, 'task', '' );

switch ($task) {
	case 'quickcheck':
		quickcheck();
		break;
		
	case 'fullcheck':
		fullcheck();
		break;
		
	default:
		view();
		break;		
}

/*
 * Added 1.0.11
 */
function view() {	
	$sp 		= ini_get( 'session.save_path' );
	
	$_VERSION 		= new joomlaVersion();				 	
	$versioninfo 	= $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '. $_VERSION->DEV_STATUS;
	$version 		= $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '. $_VERSION->DEV_STATUS.' [ '.$_VERSION->CODENAME .' ] '. $_VERSION->RELDATE .' '. $_VERSION->RELTIME .' '. $_VERSION->RELTZ;
	
	echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">";
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Joomla - Web Installer</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="shortcut icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="install.css" type="text/css" />
	</head>
	<body>
	
	<div id="wrapper">
		<div id="header">
			<div id="joomla">
				<img src="header_install.png" alt="Joomla Installation" />
			</div>
		</div>
	</div>
	
	<div id="ctr" align="center">
		<div class="install">
			<div id="stepbar">
				<div class="step-on">pre-installation check</div>
				<div class="step-off">license</div>
				<div class="step-off">step 1</div>
				<div class="step-off">step 2</div>
				<div class="step-off">step 3</div>
				<div class="step-off">step 4</div>
			</div>
	
			<div id="right">
				<div id="step">pre-installation check</div>
	
				<div class="far-right">
					<input name="Button2" type="submit" class="button" value="Next >>" onclick="window.location='install.php';" />
					<br/>
					<br/>
					<input type="button" class="button" value="Check Again" onclick="window.location=window.location" />
				</div>
				<div class="clr"></div>				
					
				<h1 style="text-align: center; border-bottom: 0px;">
					<?php echo $version; ?>
				</h1>
	
				<h1>
					Version Check:
				</h1>
				
				<div class="install-text">
					A live online check to see if your version of Joomla! is the newest version available
					<div class="ctr"></div>
				</div>
						
				<div class="install-form">
					<div class="form-block" style="text-align: center;">
						<table class="content">
						<tr>
							<td class="item">
								<script type="text/javascript">
									<!--//--><![CDATA[//><!--	
								    function makeRequest(url) {	
								        var http_request = false;
								
								        if (window.XMLHttpRequest) {
								            http_request = new XMLHttpRequest();
								            if (http_request.overrideMimeType) {
								                http_request.overrideMimeType('text/xml');
								            }
								        } else if (window.ActiveXObject) {
								            try {
								                http_request = new ActiveXObject("Msxml2.XMLHTTP");
								            } catch (e) {
								                try {
								                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
								                } catch (e) {}
								            }
								        }
								
								        if (!http_request) {
								            return false;
								        }
								        http_request.onreadystatechange = function() { alertContents(http_request); };
								        http_request.open('GET', url, true);
								        http_request.send(null);	
								    }
								
								    function alertContents(http_request) {	
								        if (http_request.readyState == 4) {
								            if ((http_request.status == 200) && (http_request.responseText.length < 1025)) {
												document.getElementById('JLatestVersion').innerHTML = http_request.responseText;
								            } else {
								                document.getElementById('JLatestVersion').innerHTML = 'Unknown, unable to check!';
								            }
								        }
								
								    }
								
								    function JInitAjax() {
								    	makeRequest('<?php echo 'index.php?task=quickcheck'; ?>');
								    }
								
								    function JAddEvent(obj, evType, fn){
								    	if (obj.addEventListener){
								    		obj.addEventListener(evType, fn, true);
								    		return true;
								    	} else if (obj.attachEvent){
								    		var r = obj.attachEvent("on"+evType, fn);
								    		return r;
								    	} else {
								    		return false;
								    	}
								    }
								
									JAddEvent(window, 'load', JInitAjax);
									//--><!]]>							
								</script>
								
								<div style="clear: both; margin: 3px; padding: 0px 15px; display: block; float: left; text-align: left; width: 95%;">
									<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
									<tr>
										<td colspan="2" style="text-align: center;">
											Your version of Joomla! [ <?php echo $versioninfo; ?> ] is:  
											<h3 style="margin-top: 20px; font-size: 13px;">
												<div id="JLatestVersion" style="display: inline; font-size: 13px; color:#888">
													...Checking...
												</div>
											</h3>
										</td>
									</tr>
								    </table>
								</div>
							
								<?php
								$link 	= 'index.php?task=fullcheck';
								$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=700,height=480,directories=no,location=no';
								?>
								<input name="Button3" type="submit" value="Detailed Version Check" onclick="window.open('<?php echo $link; ?>','win2','<?php echo $status; ?>'); return false;" />
							</td>
						</tr>
						</table>
					</div>
				</div>	
				<div class="clr"></div>		
				
				<h1>
					Pre-installation check
				</h1>
				
				<div class="install-text">
					If any of these items are highlighted
					in red then please take actions to correct them. Failure to do so
					could lead to your Joomla installation not functioning
					correctly.
					<div class="ctr"></div>
				</div>
	
				<div class="install-form">
					<div class="form-block">
						<table class="content">
						<tr>
							<td class="item">
								PHP version >= 4.1.0
							</td>
							<td align="left">
								<?php echo phpversion() < '4.1' ? '<b><font color="red">No</font></b>' : '<b><font color="green">Yes</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - zlib compression support
							</td>
							<td align="left">
								<?php echo extension_loaded('zlib') ? '<b><font color="green">Available</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - XML support
							</td>
							<td align="left">
								<?php echo extension_loaded('xml') ? '<b><font color="green">Available</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - MySQL support
							</td>
							<td align="left">
								<?php echo function_exists( 'mysql_connect' ) ? '<b><font color="green">Available</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td valign="top" class="item">
								configuration.php
							</td>
							<td align="left">
								<?php
								if (@file_exists('../configuration.php') &&  @is_writable( '../configuration.php' )){
									echo '<b><font color="green">Writeable</font></b>';
								} else if (is_writable( '..' )) {
									echo '<b><font color="green">Writeable</font></b>';
								} else {
									echo '<b><font color="red">Unwriteable</font></b><br /><span class="small">You can still continue the install as the configuration will be displayed at the end, just copy & paste this and upload.</span>';
								} 
								?>
							</td>
						</tr>
						<tr>
							<td class="item">
								Session save path
							</td>
							<td align="left" valign="top">
								<?php echo is_writable( $sp ) ? '<b><font color="green">Writeable</font></b>' : '<b><font color="red">Unwriteable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td class="item" colspan="2">
								<b>
									<?php echo $sp ? $sp : 'Not set'; ?>
								</b>
							</td>
						</tr>
						</table>
					</div>
				</div>
				<div class="clr"></div>
				
				<h1>
					Recommended settings:
				</h1>
				
				<div class="install-text">
					These settings are recommended for PHP in order to ensure full
					compatibility with Joomla.
					<br />
					However, Joomla will still operate if your settings do not quite match the recommended
					<div class="ctr"></div>
				</div>
		
				<div class="install-form">
					<div class="form-block">
		
						<table class="content">
						<tr>
							<td class="toggle" width="500px">
								Directive
							</td>
							<td class="toggle">
								Recommended
							</td>
							<td class="toggle">
								Actual
							</td>
						</tr>
						<?php
						$php_recommended_settings = array(array ('Safe Mode','safe_mode','OFF'),
							array ('Display Errors','display_errors','ON'),
							array ('File Uploads','file_uploads','ON'),
							array ('Magic Quotes GPC','magic_quotes_gpc','ON'),
							array ('Magic Quotes Runtime','magic_quotes_runtime','OFF'),
							array ('Register Globals','register_globals','OFF'),
							array ('Output Buffering','output_buffering','OFF'),
							array ('Session auto start','session.auto_start','OFF'),
						);
						
						foreach ($php_recommended_settings as $phprec) {
							?>
							<tr>
								<td class="item">
									<?php echo $phprec[0]; ?>:
								</td>
								<td class="toggle">
									<?php echo $phprec[2]; ?>:
								</td>
								<td>
									<b>
										<?php
										if ( get_php_setting($phprec[1]) == $phprec[2] ) {
											?>
											<font color="green">
											<?php
										} else {
											?>
											<font color="red">
											<?php
										}
										echo get_php_setting($phprec[1]);
										?>
										</font>
									</b>
								<td>
							</tr>
							<?php
						}
						?>
						<tr>
							<td class="item">
								Register Globals Emulation:
							</td>
							<td class="toggle">
								OFF:
							</td>
							<td>
								<?php
								if ( RG_EMULATION ) {
									?>
									<font color="red"><b>
									<?php
								} else {
									?>
									<font color="green"><b>
									<?php
								}
								echo ((RG_EMULATION) ? 'ON' : 'OFF');
								?>
								</b>
								</font>
							<td>
						</tr>
						</table>
					</div>
				</div>
				<div class="clr"></div>
		
				<h1>
					Directory and File Permissions:
				</h1>
				
				<div class="install-text">
					In order for Joomla to function
					correctly it needs to be able to access or write to certain files
					or directories. If you see "Unwriteable" you need to change the
					permissions on the file or directory to allow Joomla
					to write to it.
					<div class="clr">&nbsp;&nbsp;</div>
					<div class="ctr"></div>
				</div>
		
				<div class="install-form">
					<div class="form-block">	
						<table class="content">
						<?php
						writableCell( 'administrator/backups' );
						writableCell( 'administrator/components' );
						writableCell( 'administrator/modules' );
						writableCell( 'administrator/templates' );
						writableCell( 'cache' );
						writableCell( 'components' );
						writableCell( 'images' );
						writableCell( 'images/banners' );
						writableCell( 'images/stories' );
						writableCell( 'language' );
						writableCell( 'mambots' );
						writableCell( 'mambots/content' );
						writableCell( 'mambots/editors' );
						writableCell( 'mambots/editors-xtd' );
						writableCell( 'mambots/search' );
						writableCell( 'mambots/system' );
						writableCell( 'media' );
						writableCell( 'modules' );
						writableCell( 'templates' );
						?>
						</table>
					</div>
					<div class="clr"></div>
				</div>
	
				
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
	
	<div class="ctr">
		<a href="http://www.joomla.org" target="_blank">Joomla</a> is Free Software released under the GNU/GPL License.
	</div>
	
	</body>
	</html>
	<?php
}

/*
 * Added 1.0.11
 */
function quickcheck(){
	global $database, $mainframe, $mosConfig_absolute_path, $mosConfig_cachepath, $Itemid, $my;
	
	$basePath = dirname( __FILE__ );
					
	// check if cache directory is writeable
	$cacheDir = $basePath .'/../cache/';
	if ( !is_writable( $cacheDir ) ) {	
		echo '... Cache Directory Unwriteable';
		return;
	}

	$message 	= '<span style="color: black;">Unknown, unable to check</span>';
	
	$_VERSION 	= new joomlaVersion();			
	 	
	$url		= 'http://www.joomla.org/cache/versioncheck.xml';
	
	// full RSS parser used to access image information
	require_once( $basePath . '/../includes/domit/xml_domit_rss.php');
	$LitePath = $basePath . '/../includes/Cache/Lite.php';

	// full RSS parser used to access image information
	$rssDoc 	= new xml_domit_rss_document();
	$rssDoc->setRSSTimeout(30);
	$rssDoc->useHTTPClient(true);
	// file cached for 3 days
	$rssDoc->useCacheLite( true, $LitePath, $cacheDir, 86400 );
	$success 	= $rssDoc->loadRSS( $url );
	
	if ( $success ) {
		$currChannel	=& $rssDoc->getChannel(0);		
		$totalItems		= $currChannel->getItemCount();
	
		if ($totalItems > 0) {				
			// load data from feed item
			$currItem 	=& $currChannel->getItem(0);
			
			// version Information
			$rawdata 	= $currItem->getDescription();
			$rawdata 	= str_replace('||', '&', $rawdata);
			parse_str($rawdata, $data);
			
			$outofdate 	= 0;
			
			if (!isset($data['major']) || !isset($data['minor']) ) {
				$message = '<span style="color: black;">Unknown, unable to check</span>';
			} else {			
				if ($data['major'] > $_VERSION->RELEASE) {
				// out of date if major release number of latest larger				
					$outofdate 	= 1;				
				}
				if ($data['minor'] > $_VERSION->DEV_LEVEL) {
				// out of date if minor release number of latest larger				
					$outofdate 	= 1;				
				}
				
				if ($outofdate == 1) {
				// `out of date` message
					$message 	= '&nbsp;<span style="color: red;">OUT OF DATE</span>&nbsp;';
					$message 	.= '<img src="../images/publish_x.png"  style="vertical-align: middle;" />';				
				} else {
				// `up-to-date` message
					$message 	= '&nbsp;<span style="color: green;">UP-TO-DATE</span>&nbsp;';
					$message 	.= '<img src="../images/tick.png"  style="vertical-align: middle;" />';
				}
			}
		}		
	}	
	
	echo $message;
}

/*
 * Added 1.0.11
 */
function fullcheck() {
	$basePath = dirname( __FILE__ );
					
	// check if cache directory is writeable
	$cacheDir = $basePath .'/../cache/';
	if ( !is_writable( $cacheDir ) ) {	
		?>
		<fieldset style="width: 70%; text-align: center; color: #CCC; margin-top: 20px;  margin-bottom: 30px; padding: 10px; background-color: white;">
			<h3 style="color: red">
				Currently unable to connect to Official Joomla! Site to check for the latest version
			</h3>
		</fieldset>
		<?php				
		return;
	}
	
	$_VERSION 			= new joomlaVersion();			
	$_VERSION->BUILD 	= str_replace('$Revision: ','',$_VERSION->BUILD); 			
	$_VERSION->BUILD 	= str_replace(' $','',$_VERSION->BUILD);
	 	
	$url		= 'http://www.joomla.org/cache/versioncheck.xml';
	
	// full RSS parser used to access image information
	require_once( $basePath . '/../includes/domit/xml_domit_rss.php');
	$LitePath = $basePath . '/../includes/Cache/Lite.php';
	
	// full RSS parser used to access image information
	$rssDoc 	= new xml_domit_rss_document();
	$rssDoc->setRSSTimeout(30);
	$rssDoc->useHTTPClient(true);
	$rssDoc->useCacheLite( true, $LitePath, $cacheDir, 86400 );
	$success 	= $rssDoc->loadRSS( $url );
	
	echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">";
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Joomla - Web Installer</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="shortcut icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="install.css" type="text/css" />
	</head>
	<body>
	
	<div id="ctr" align="center">
		<div class="install" style="width: 95%;">
			<?php
			if ( $success ) {
				$currChannel	=& $rssDoc->getChannel(0);		
				$totalItems		= $currChannel->getItemCount();
			
				if ($totalItems > 0) {				
					// load data from feed item
					$currItem 	=& $currChannel->getItem(0);
	
					// version Information
					$rawdata 	= $currItem->getDescription();
					$rawdata 	= str_replace('||', '&', $rawdata);
					parse_str($rawdata, $data);
					
					$outofdate 	= 0;
					
					if (!isset($data['major']) || !isset($data['minor']) ) {
						?>
						<fieldset style="width: 70%; text-align: center; color: #CCC; margin-top: 20px;  margin-bottom: 30px; padding: 10px; background-color: white;">
							<h3 style="color: red">
								Currently unable to connect to Official Joomla! Site to check for the latest version
							</h3>
						</fieldset>
						<?php				
					} else {			
						if ($data['major'] > $_VERSION->RELEASE) {
						// out of date if major release number of latest larger				
							$outofdate 	= 1;				
						}
						if ($data['minor'] > $_VERSION->DEV_LEVEL) {
						// out of date if minor release number of latest larger				
							$outofdate 	= 1;				
						}				

						if ($outofdate == 1) {
							$text 	= 'OUT OF DATE';
							$colour = 'red';
							$image	= '<img src="../images/cancel_f2.png"  style="vertical-align: middle;" />';
						} else if ($outofdate == 0) {
							$text 	= 'UP-TO-DATE';
							$colour = 'green';
							$image	= '<img src="../images/apply_f2.png"  style="vertical-align: middle;" />';				
						}
						
						if (!isset($data['major'])) {
							$data['major'] = '1.0';
						}			
						if (!isset($data['minor'])) {
							$data['major'] = '*';
						}			
						if (!isset($data['name'])) {
							$data['name'] = '***';
						}			
						if (!isset($data['date'])) {
							$data['date'] = '***';
						}			
						if (!isset($data['rev'])) {
							$data['rev'] = '***';
						}						
						?>
						<fieldset style="width: 520px; px; text-align: center; color: #CCC; margin-bottom: 30px; margin-top: 15px; padding: 10px; vertical-align: middle; border: 1px solid #ccc; background-color: white;">
							<h1 style="text-align: center; border-bottom: 0px;">
								<span style="color: #C0C0C0;">
									Your version of Joomla! is
								</span>
								<span style="color: <?php echo $colour; ?>;">
									<?php echo $text; ?> 
								</span>
								<?php echo $image; ?>
							</h1>
						</fieldset>
						
						<table class="adminlist" align="center" width="98%" style="border: 1px solid #ccc; background-color: white;">
						<tr>
							<th width="150">
							</th>							
							<th style="text-align: center;">
								Version Number
							</th>
							<th style="text-align: center;">
								Code Name
							</th>
							<th style="text-align: center;">
								Date
							</th>
							<th style="text-align: center;">
								Revision Number
							</th>
						</tr>
						<tr align="center" style="font-weight: bold; text-align: center; background-color: #F0E68C;">
							<td align="left">
								<h3 style="padding: 0px; margin: 8px;">
									Latest Version
								</h3>
							</td>
							<td style="text-align: center;">
								<?php echo $data['major'] .'.'. $data['minor'];?>
							</td>
							<td style="text-align: center;">
								<?php echo $data['name'];?>
							</td>
							<td style="text-align: center;">
								<?php echo $data['date'];?>
							</td>
							<td style="text-align: center;">
								<?php echo $data['rev'];?>
							</td>
						</tr>
						<tr class="row1">
							<td colspan="5" style="height: 10px;">
							</td>
						</tr>
						<tr align="center">
							<td align="left">
								<h3 style="padding: 0px; margin: 8px;">
									Your Version
								</h3>
							</td>
							<td style="text-align: center;">
								<?php echo $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL;?>
							</td>
							<td style="text-align: center;">
								<?php echo $_VERSION->CODENAME;?>
							</td>
							<td style="text-align: center;">
								<?php echo $_VERSION->RELDATE;?>
							</td>
							<td style="text-align: center;">
								<?php echo $_VERSION->BUILD;?>
							</td>
						</tr>
						</table>  
						
						<?php				
						if ($outofdate) {
							?>
							<fieldset style="width: 520px; text-align: center; color: #CCC; margin-top: 30px; padding: 10px; border: 1px solid #ccc; background-color: white;">
								<h3 style="color: #333">
									<a href="<?php echo $data['url']; ?>" target="_blank">
										Read about and Download the latest version of Joomla! here.
									</a>							
								</h3>
							</fieldset>
							<?php				
						}		
					}								
				}							
			} else {
				?>
				<fieldset style="width: 70%; text-align: center; color: #CCC; margin-top: 20px;  margin-bottom: 30px; padding: 10px; border: 1px solid #ccc; background: white;">
					<h3 style="color: red">
						Currently unable to connect to Official Joomla! Site to check for the latest version
					</h3>
				</fieldset>
				<?php				
			}
			?>
			<span style="margin-bottom: 30px">&nbsp;</span>		
		</div>
	</div>
	
	<div class="ctr">						
		<a href="#" onclick="window.close();">
			[ Close Window ]</a>				
	</div>
	
	<div style="margin-bottom: 20px">&nbsp;</div>		

	<div class="ctr">
		<a href="http://www.joomla.org" target="_blank">Joomla!</a> is Free Software released under the GNU/GPL License.
	</div>
	
	</body>
	</html>
	<?php
}

function get_php_setting($val) {
	$r =  (ini_get($val) == '1' ? 1 : 0);
	return $r ? 'ON' : 'OFF';
}

function writableCell( $folder, $relative=1, $text='' ) {
	$writeable 		= '<b><font color="green">Writeable</font></b>';
	$unwriteable 	= '<b><font color="red">Unwriteable</font></b>';
	
	echo '<tr>';
	echo '<td class="item">' . $folder . '/</td>';
	echo '<td align="right">';
	if ( $relative ) {
		echo is_writable( "../$folder" ) 	? $writeable : $unwriteable;
	} else {
		echo is_writable( "$folder" ) 		? $writeable : $unwriteable;
	}
	echo '</tr>';
}
?>