<?php
/**
* @version $Id$
* @package Joomla
* @subpackage Users
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
* @subpackage Users
*/
class HTML_user {
	function frontpage() {
		?>
		<div class="componentheading">
			<?php echo _WELCOME; ?>
		</div>

		<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td>
				<?php echo _WELCOME_DESC; ?>
			</td>
		</tr>
		</table>
		<?php
	}

	function userEdit( $row, $option, $submitvalue, &$params ) {
		global $mosConfig_absolute_path, $mosConfig_frontend_userparams;

		require_once( $mosConfig_absolute_path .'/includes/HTML_toolbar.php' );

		// used for spoof hardening
		$validate = josSpoofValue();
		
		mosCommonHTML::loadOverlib();		
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton( pressbutton ) {
			var form = document.mosUserForm;
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

			if (pressbutton == 'cancel') {
				form.task.value = 'cancel';
				form.submit();
				return;
			}

			// do field validation
			if (form.name.value == "") {
				alert( "<?php echo addslashes( _REGWARN_NAME );?>" );
			} else if (form.username.value == "") {
				alert( "<?php echo addslashes( _REGWARN_UNAME );?>" );
			} else if (r.exec(form.username.value) || form.username.value.length < 3) {
				alert( "<?php printf( addslashes( _VALID_AZ09 ), addslashes( _PROMPT_UNAME ), 4 );?>" );
			} else if (form.email.value == "") {
				alert( "<?php echo addslashes( _REGWARN_MAIL );?>" );
			} else if ((form.password.value != "") && (form.password.value != form.verifyPass.value)){
				alert( "<?php echo addslashes( _REGWARN_VPASS2 );?>" );
			} else if (r.exec(form.password.value)) {
				alert( "<?php printf( addslashes( _VALID_AZ09 ), addslashes( _REGISTER_PASS ), 4 );?>" );
			} else {
				form.submit();
			}
		}
		</script>
		<form action="index.php" method="post" name="mosUserForm">
		<div class="componentheading">
			<?php echo _EDIT_TITLE; ?>
		</div>

		<div style="float: right;">
			<?php
			mosToolBar::startTable();
			mosToolBar::spacer();
			mosToolBar::save();
			mosToolBar::cancel();
			mosToolBar::endtable();
			?>
		</div>

		<table cellpadding="5" cellspacing="0" border="0" width="100%">
		<tr>
			<td width=85>
				<?php echo _YOUR_NAME; ?>
			</td>
			<td>
				<input class="inputbox" type="text" name="name" value="<?php echo $row->name;?>" size="40" />
			</td>
		</tr>
		<tr>
			<td>
				<?php echo _EMAIL; ?>
			</td>
			<td>
				<input class="inputbox" type="text" name="email" value="<?php echo $row->email;?>" size="40" />
			</td>
		</tr>
		<tr>
			<td>
				<?php echo _UNAME; ?>
			</td>
			<td>
				<input class="inputbox" type="text" name="username" value="<?php echo $row->username;?>" size="40" />
			</td>
		</tr>
		<tr>
			<td>
				<?php echo _PASS; ?>
			</td>
			<td>
				<input class="inputbox" type="password" name="password" value="" size="40" />
			</td>
		</tr>
		<tr>
			<td>
				<?php echo _VPASS; ?>
			</td>
			<td>
				<input class="inputbox" type="password" name="verifyPass" size="40" />
			</td>
		</tr>
		<?php 
		if ($mosConfig_frontend_userparams == '1' || $mosConfig_frontend_userparams == 1 || $mosConfig_frontend_userparams == NULL) {
			?>
			<tr>
				<td colspan="2">
					<?php echo $params->render( 'params' ); ?>
				</td>
			</tr>
			<?php
		}
		?>
		</table>

		<input type="hidden" name="id" value="<?php echo $row->id;?>" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="saveUserEdit" />
		<input type="hidden" name="<?php echo $validate; ?>" value="1" />
		</form>
		<?php
	}

	function confirmation() {
		?>
		<div class="componentheading">
			<?php echo _SUBMIT_SUCCESS; ?>
		</div>

		<table>
		<tr>
			<td>
				<?php echo _SUBMIT_SUCCESS_DESC; ?>
			</td>
		</tr>
		</table>
		<?php
	}
}
?>