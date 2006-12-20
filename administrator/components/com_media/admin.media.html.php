<?php
/**
* @version $Id$
* @package Joomla
* @subpackage Massmail
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software and parts of it may contain or be derived from works
* licensed under the GNU General Public License or other free or open source
* software licenses. See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

/**
* @package Joomla
* @subpackage Massmail
*/
class HTML_Media {
	function showMedia($dirPath,$listdir ) {
		?>
		<script language="javascript" type="text/javascript">
		function dirup(){
			var urlquery=frames['imgManager'].location.search.substring(1);
			var curdir= urlquery.substring(urlquery.indexOf('listdir=')+8);
			var listdir=curdir.substring(0,curdir.lastIndexOf('/'));
			frames['imgManager'].location.href='index3.php?option=com_media&task=list&listdir=' + listdir;
		}


		function goUpDir() {
			var selection = document.forms[0].dirPath;
			var dir = selection.options[selection.selectedIndex].value;
			frames['imgManager'].location.href='index3.php?option=com_media&task=list&listdir=' + dir;
		}
		</script>

		<form action="index2.php" name="adminForm" method="post" enctype="multipart/form-data" >
		<table width="100%" align="center">
		<tr>
			<th>
				<table class="adminheading">
				<tr>
					<th class="mediamanager">
						Media Manager
					</th>
					<td>
						<table border="0" align="right" cellpadding="0" cellspacing="4" width="600">
						<tr>
							<td align="right" width="200" style="padding-right:10px;white-space:nowrap">
								Create Directory
							</td>
							<td>
								<input class="inputbox" type="text" name="foldername" style="width:400px" />
							</td>
						</tr>
						<tr>
							<td align="right" style="padding-right:10px;;white-space:nowrap">
								Image/URL Code
							</td>
							<td>
								<input class="inputbox" type="text" name="imagecode" style="width:400px" />
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</th>
		<tr>
			<td align="center">
				<fieldset>
					<table width="99%" align="center" border="0" cellspacing="2" cellpadding="2">
					<tr>
						<td>
							<table border="0" cellspacing="1" cellpadding="3"  class="adminheading">
							<tr>
								<td>
									Directory
								</td>
								<td>
									<?php echo $dirPath;?>
								</td>
								<td class="buttonOut" width="10">
									<a href="javascript:dirup()">
										<img src="components/com_media/images/btnFolderUp.gif" width="15" height="15" border="0" alt="Up" />
									</a>
								</td>
								<td align="right">
									File Upload <small>[ Max = <?php echo ini_get( 'post_max_size' );?> ]</small>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<input class="inputbox" type="file" name="upload" id="upload" size="63" />&nbsp;
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="center" bgcolor="white">
							<div class="manager">
								<iframe height="360" src="index3.php?option=com_media&amp;task=list&amp;listdir=<?php echo $listdir?>" name="imgManager" id="imgManager" width="100%" marginwidth="0" marginheight="0" scrolling="auto" frameborder="0"></iframe>
							</div>
						</td>
					</tr>
					</table>
				</fieldset>
			</td>
		</tr>
		<tr>
			<td>

			</td>
		</tr>
		<tr>
			<td>
				<div style="text-align: right;">
				</div>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="com_media" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="cb1" id="cb1" value="0" />
		</form>
		<?php
	}


	//Built in function of dirname is faulty
	//It assumes that the directory nane can not contain a . (period)
	function dir_name($dir){
		$lastSlash = intval(strrpos($dir, '/'));
		if($lastSlash == strlen($dir)-1){
			return substr($dir, 0, $lastSlash);
		}
		else {
			return dirname($dir);
		}
	}

	function draw_no_results(){
		?>
		<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<div align="center" style="font-size:large;font-weight:bold;color:#CCCCCC;font-family: Helvetica, sans-serif;">
					No Images Found
				</div>
			</td>
		</tr>
		</table>
		<?php
	}

	function draw_no_dir() {
		global $BASE_DIR, $BASE_ROOT;
		?>
		<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<div align="center" style="font-size:small;font-weight:bold;color:#CC0000;font-family: Helvetica, sans-serif;">
					Configuration Problem: &quot;<?php echo $BASE_DIR.$BASE_ROOT; ?>&quot; does not exist.
				</div>
			</td>
		</tr>
		</table>
		<?php
	}


	function draw_table_header() {
		mosCommonHTML::loadOverlib();
		?>
		<script language="javascript" type="text/javascript">
		function dirup(){
			var urlquery=frames['imgManager'].location.search.substring(1);
			var curdir= urlquery.substring(urlquery.indexOf('listdir=')+8);
			var listdir=curdir.substring(0,curdir.lastIndexOf('/'));
			frames['imgManager'].location.href='index3.php?option=com_media&task=list&listdir=' + listdir;
		}
		</script>
		<div class="manager">
		<?php
	}

	function draw_table_footer() {
		?>
		</div>
		<?php
	}

	function show_image($img, $file, $info, $size, $listdir) {
		$img_file 		= basename($img);
		$img_url_link 	= COM_MEDIA_BASEURL . $listdir . '/' . rawurlencode( $img_file );

		$filesize 		= HTML_Media::parse_size( $size );

		if ( ( $info[0] > 70 ) || ( $info[0] > 70 ) ) {
			$img_dimensions = HTML_Media::imageResize($info[0], $info[1], 80);
		} else {
			$img_dimensions = 'width="'. $info[0] .'" height="'. $info[1] .'"';
		}

		$overlib = '<table>';
		$overlib .= '<tr>';
		$overlib .= '<td>';
		$overlib .= 'Width:';
		$overlib .= '</td>';
		$overlib .= '<td>';
		$overlib .= $info[0].' px';
		$overlib .= '</td>';
		$overlib .= '</tr>';
		$overlib .= '<tr>';
		$overlib .= '<td>';
		$overlib .= 'Height:';
		$overlib .= '</td>';
		$overlib .= '<td>';
		$overlib .= $info[1] .' px';
		$overlib .= '</td>';
		$overlib .= '</tr>';
		$overlib .= '<tr>';
		$overlib .= '<td>';
		$overlib .= 'Filesize:';
		$overlib .= '</td>';
		$overlib .= '<td>';
		$overlib .= $filesize;
		$overlib .= '</td>';
		$overlib .= '</tr>';
		$overlib .= '</table>';
		$overlib .= '<br/> *Click to Enlarge*';
		$overlib .= '<br/> *Click for Image Code*';
		?>
		<div style="float:left; padding: 5px">
			<div class="imgTotal"  onmouseover="return overlib( '<?php echo $overlib; ?>', CAPTION, '<?php echo addslashes( $file ); ?>', BELOW, LEFT, WIDTH, 150 );" onmouseout="return nd();">
				<div align="center" class="imgBorder">
					<a href="#" onclick="javascript: window.open( '<?php echo $img_url_link; ?>', 'win1', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=<?php echo $info[0] * 1.5;?>,height=<?php echo $info[1] * 1.5;?>,directories=no,location=no,left=120,top=80'); window.top.document.forms[0].imagecode.value = '<img src=&quot;<?php echo $img_url_link;?>&quot; align=&quot;left&quot; hspace=&quot;6&quot; alt=&quot;Image&quot; />';" style="display: block; width: 100%; height: 100%">
						<div class="image">
							<img src="<?php echo $img_url_link; ?>" <?php echo $img_dimensions; ?> border="0" />
						</div></a>
				</div>
			</div>
			<div class="imginfoBorder">
				<small>
					<?php echo htmlspecialchars( substr( $file, 0, 10 ) . ( strlen( $file ) > 10 ? '...' : ''), ENT_QUOTES ); ?>
				</small>
				<div class="buttonOut">
					<a href="index2.php?option=com_media&amp;task=delete&amp;delFile=<?php echo $file; ?>&amp;listdir=<?php echo $listdir; ?>" target="_top" onclick="return deleteImage('<?php echo $file; ?>');" title="Delete Item">
						<img src="components/com_media/images/edit_trash.gif" width="15" height="15" border="0" alt="Delete" /></a>
					<a href="#" onclick="javascript:window.top.document.forms[0].imagecode.value = '<img src=&quot;<?php echo $img_url_link;?>&quot; align=&quot;left&quot; hspace=&quot;6&quot; alt=&quot;Image&quot; />';" title="Image Code">
						<img src="components/com_media/images/edit_pencil.gif" width="15" height="15" border="0" alt="Code" /></a>
				</div>
			</div>
		</div>
		<?php
	}

	function show_dir( $path, $dir, $listdir ) {
		$count = HTML_Media::num_files( COM_MEDIA_BASE . $listdir . $path );

		$num_files 	= $count[0];
		$num_dir 	= $count[1];

		if ($listdir == '/') {
			$listdir = '';
		}

		$link = 'index3.php?option=com_media&amp;task=list&amp;listdir='. $listdir . $path;

		$overlib = '<table>';
		$overlib .= '<tr>';
		$overlib .= '<td>';
		$overlib .= 'Files:';
		$overlib .= '</td>';
		$overlib .= '<td>';
		$overlib .= $num_files;
		$overlib .= '</td>';
		$overlib .= '</tr>';
		$overlib .= '<tr>';
		$overlib .= '<td>';
		$overlib .= 'Folders:';
		$overlib .= '</td>';
		$overlib .= '<td>';
		$overlib .= $num_dir;
		$overlib .= '</td>';
		$overlib .= '</tr>';
		$overlib .= '</table>';
		$overlib .= '<br/> *Click to Open*';
		?>
		<div style="float:left; padding: 5px">
			<div class="imgTotal" onmouseover="return overlib( '<?php echo $overlib; ?>', CAPTION, '<?php echo $dir; ?>', BELOW, RIGHT, WIDTH, 150 );" onmouseout="return nd();">
				<div align="center" class="imgBorder">
					<a href="<?php echo $link; ?>" target="imgManager" onclick="javascript:updateDir();">
						<img src="components/com_media/images/folder.gif" width="80" height="80" border="0" /></a>
				</div>
			</div>
			<div class="imginfoBorder">
				<small>
					<?php echo substr( $dir, 0, 10 ) . ( strlen( $dir ) > 10 ? '...' : ''); ?>
				</small>
				<div class="buttonOut">
					<a href="index2.php?option=com_media&amp;task=deletefolder&amp;delFolder=<?php echo $path; ?>&amp;listdir=<?php echo $listdir; ?>" target="_top" onclick="return deleteFolder('<?php echo $dir; ?>', <?php echo $num_files; ?>);">
						<img src="components/com_media/images/edit_trash.gif" width="15" height="15" border="0" alt="Delete" /></a>
				</div>
			</div>
		</div>
		<?php
	}

	function show_doc($doc, $size, $listdir, $icon) {
		$size 			= HTML_Media::parse_size( $size );
		$doc_url_link 	= COM_MEDIA_BASEURL . $listdir  .'/'. rawurlencode( $doc );

		$overlib = 'Filesize: '. $size;
		$overlib .= '<br/><br/> *Click for URL*';
		?>
		<div style="float:left; padding: 5px">
			<div class="imgTotal" onmouseover="return overlib( '<?php echo $overlib; ?>', CAPTION, '<?php echo $doc; ?>', BELOW, RIGHT, WIDTH, 200 );" onmouseout="return nd();">
				<div align="center" class="imgBorder">
				  <a href="index3.php?option=com_media&amp;task=list&amp;listdir=<?php echo $listdir; ?>" onclick="javascript:window.top.document.forms[0].imagecode.value = '<a href=&quot;<?php echo $doc_url_link;?>&quot;>Insert your text here</a>';">
		  				<img border="0" src="<?php echo $icon ?>" alt="<?php echo $doc; ?>" /></a>
		  		</div>
			</div>
			<div class="imginfoBorder">
				<small>
					<?php echo $doc; ?>
				</small>
				<div class="buttonOut">
					<a href="index2.php?option=com_media&amp;task=delete&amp;delFile=<?php echo $doc; ?>&amp;listdir=<?php echo $listdir; ?>" target="_top" onclick="return deleteImage('<?php echo $doc; ?>');">
						<img src="components/com_media/images/edit_trash.gif" width="15" height="15" border="0" alt="Delete" /></a>
				</div>
			</div>
		</div>
		<?php
	}

	function parse_size($size){
		if($size < 1024) {
			return $size.' bytes';
		} else if($size >= 1024 && $size < 1024*1024) {
			return sprintf('%01.2f',$size/1024.0).' Kb';
		} else {
			return sprintf('%01.2f',$size/(1024.0*1024)).' Mb';
		}
	}

	function imageResize($width, $height, $target) {
		//takes the larger size of the width and height and applies the
		//formula accordingly...this is so this script will work
		//dynamically with any size image

		if ($width > $height) {
			$percentage = ($target / $width);
		} else {
			$percentage = ($target / $height);
		}

		//gets the new value and applies the percentage, then rounds the value
		$width = round($width * $percentage);
		$height = round($height * $percentage);

		//returns the new sizes in html image tag format...this is so you
		//can plug this function inside an image tag and just get the

		return "width=\"$width\" height=\"$height\"";

	}

	function num_files($dir) {
		$total_file 	= 0;
		$total_dir 		= 0;

		if(is_dir($dir)) {
			$d = dir($dir);

			while ( false !== ($entry = $d->read()) ) {
				if ( substr($entry,0,1) != '.' && is_file($dir . DIRECTORY_SEPARATOR . $entry) && strpos( $entry, '.html' ) === false && strpos( $entry, '.php' ) === false ) {
					$total_file++;
				}
				if ( substr($entry,0,1) != '.' && is_dir($dir . DIRECTORY_SEPARATOR . $entry) ) {
					$total_dir++;
				}
			}

			$d->close();
		}

		return array( $total_file, $total_dir );
	}


	function imageStyle($listdir) {
		?>
		<script language="javascript" type="text/javascript">
		function updateDir(){
			var allPaths = window.top.document.forms[0].dirPath.options;
			for(i=0; i<allPaths.length; i++) {
				allPaths.item(i).selected = false;
				if((allPaths.item(i).value)== '<?php if (strlen($listdir)>0) { echo $listdir ;} else { echo '/';}  ?>') {
					allPaths.item(i).selected = true;
				}
			}
		}

		function deleteImage(file) {
			if(confirm("Delete file \""+file+"\"?"))
			return true;

			return false;
		}
		function deleteFolder(folder, numFiles) {
			if(numFiles > 0) {
				alert("There are "+numFiles+" files/folders in \""+folder+"\".\n\nPlease delete all files/folder in \""+folder+"\" first.");
				return false;
			}

			if(confirm("Delete folder \""+folder+"\"?"))
			return true;

			return false;
		}
		updateDir();
		</script>
		<style type="text/css">
		<!--
		div.imgTotal {
			border-top: 1px solid #ccc;
			border-left: 1px solid #ccc;
			border-right: 1px solid #ccc;
		}
		div.imgBorder {
			height: 70px;
			vertical-align: middle;
			width: 88px;
			overflow: hidden;
		}
		div.imgBorder a {
			height: 70px;
			width: 88px;
			display: block;
		}
		div.imgBorder a:hover {
			height: 70px;
			width: 88px;
			background-color: #f1e8e6;
			color : #FF6600;
		}
		.imgBorderHover {
			background: #FFFFCC;
			cursor: hand;
		}
		div.imginfoBorder {
			background: #f6f6f6;
			width: 84px !important;
			width: 90px;
			height: 35px;
			vertical-align: middle;
			padding: 2px;
			overflow: hidden;
			border: 1px solid #ccc;
		}

		.buttonHover {
			border: 1px solid;
			border-color: ButtonHighlight ButtonShadow ButtonShadow ButtonHighlight;
			cursor: hand;
			background: #FFFFCC;
		}

		.buttonOut {
		 	border: 0px;
		}

		.imgCaption {
			font-size: 9pt;
			font-family: "MS Shell Dlg", Helvetica, sans-serif;
			text-align: center;
		}
		.dirField {
			font-size: 9pt;
			font-family: "MS Shell Dlg", Helvetica, sans-serif;
			width:110px;
		}
		div.image {
			padding-top: 10px;
		}
		-->
		</style>
		<?php
	}
}
?>