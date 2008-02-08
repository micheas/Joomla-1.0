<?php
/**
* @version $Id$
* @package Joomla
* @subpackage Installer
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

/**
* @package Joomla
* @subpackage Installer
*/
class HTML_component {
/**
* @param array An array of records
* @param string The URL option
*/
	function showInstalledComponents( $rows, $option ) {
		if (count( $rows )) {
			?>
			<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
			<tr>
				<th class="install">
				Installed Components
				</th>
			</tr>
			</table>

			<table class="adminlist">
			<tr>
				<th width="20%" class="title">
				Currently Installed
				</th>
				<th width="20%" class="title">
				Component Menu Link
				</th>
				<th width="10%" align="left">
				Author
				</th>
				<th width="5%" align="center">
				Version
				</th>
				<th width="10%" align="center">
				Date
				</th>
				<th width="15%" align="left">
				Author E-mail
				</th>
				<th width="15%" align="left">
				Author URL
				</th>
			</tr>
			<?php
			$rc = 0;
			for ($i = 0, $n = count( $rows ); $i < $n; $i++) {
				$row =& $rows[$i];
				?>
				<tr class="<?php echo "row$rc"; ?>">
					<td align="left">
					<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);">
					<span class="bold">
					<?php echo $row->name; ?>
					</span>
					</td>
					<td align="left">
					<?php echo @$row->link != "" ? $row->link : "&nbsp;"; ?>
					</td>
					<td align="left">
					<?php echo @$row->author != "" ? $row->author : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row->version != "" ? $row->version : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row->creationdate != "" ? $row->creationdate : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row->authorEmail != "" ? $row->authorEmail : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row->authorUrl != "" ? "<a href=\"" .(substr( $row->authorUrl, 0, 7) == 'http://' ? $row->authorUrl : 'http://'.$row->authorUrl). "\" target=\"_blank\">$row->authorUrl</a>" : "&nbsp;";?>
					</td>
				</tr>
				<?php
				$rc = 1 - $rc;
			}
		} else {
			?>
			<td class="small">
			There are no custom components installed
			</td>
			<?php
		}
		?>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_installer" />
		<input type="hidden" name="element" value="component" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php
	}
}
?>
