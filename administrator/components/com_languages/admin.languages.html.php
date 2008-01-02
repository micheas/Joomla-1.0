<?php
/**
* @version $Id$
* @package Joomla
* @subpackage Languages
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
* @package Joomla
* @subpackage Languages
*/
class HTML_languages {

	function showLanguages( $cur_lang, &$rows, &$pageNav, $option ) {
		global $my;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="langmanager">
			Language Manager <small><small>[ Site ]</small></small>
			</th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20">
			#
			</th>
			<th width="30">
			&nbsp;
			</th>
			<th width="25%" class="title">
			Language
			</th>
			<th width="5%">
			Published
			</th>
			<th width="10%">
			Version
			</th>
			<th width="10%">
			Date
			</th>
			<th width="20%">
			Author
			</th>
			<th width="25%">
			Author E-mail
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="20"><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td width="20">
				<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->language; ?>" onClick="isChecked(this.checked);" />
				</td>
				<td width="25%">
				<a href="#edit" onclick="hideMainMenu();return listItemTask('cb<?php echo $i;?>','edit_source')"><?php echo $row->name;?></a></td>
				<td width="5%" align="center">
				<?php
				if ($row->published == 1) {	 ?>
					<img src="images/tick.png" alt="Published"/>
					<?php
				} else {
					?>
					&nbsp;
				<?php
				}
				?>
				</td>
				<td align=center>
				<?php echo $row->version; ?>
				</td>
				<td align=center>
				<?php echo $row->creationdate; ?>
				</td>
				<td align=center>
				<?php echo $row->author; ?>
				</td>
				<td align=center>
				<?php echo $row->authorEmail; ?>
				</td>
			</tr>
		<?php
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php
	}

	function editLanguageSource( $language, &$content, $option ) {
		global $mosConfig_absolute_path;
		$language_path = $mosConfig_absolute_path . "/language/" . $language . ".php";
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table cellpadding="1" cellspacing="1" border="0" width="100%">
		<tr>
			<td width="270"><table class="adminheading"><tr><th class="langmanager">Language Editor</th></tr></table></td>
			<td width="240">
				<span class="componentheading"><?php echo $language; ?>.php is :
				<b><?php echo is_writable($language_path) ? '<font color="green"> Writeable</font>' : '<font color="red"> Unwriteable</font>' ?></b>
				</span>
			</td>
<?php
			if (mosIsChmodable($language_path)) {
				if (is_writable($language_path)) {
?>
			<td>
				<input type="checkbox" id="disable_write" name="disable_write" value="1"/>
				<label for="disable_write">Make unwriteable after saving</label>
			</td>
<?php
				} else {
?>
			<td>
				<input type="checkbox" id="enable_write" name="enable_write" value="1"/>
				<label for="enable_write">Override write protection while saving</label>
			</td>
<?php
				} // if
			} // if
?>
		</tr>
		</table>
		<table class="adminform">
			<tr><th><?php echo $language_path; ?></th></tr>
			<tr><td><textarea style="width:100%" cols="110" rows="25" name="filecontent" class="inputbox"><?php echo $content; ?></textarea></td></tr>
		</table>
		<input type="hidden" name="language" value="<?php echo $language; ?>" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
	<?php
	}

}
?>
