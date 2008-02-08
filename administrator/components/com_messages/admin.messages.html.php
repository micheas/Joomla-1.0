<?php
/**
* @version $Id$
* @package Joomla
* @subpackage Messages
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
* @subpackage Messages
*/
class HTML_messages {
	function showMessages( &$rows, $pageNav, $search, $option ) {
		?>
		<form action="index2.php" method="post" name="adminForm">
		
		<table class="adminheading">
		<tr>
			<th class="inbox">
				Private Messaging
			</th>
			<td>
				Search:
			</td>
			<td> 
				<input type="text" name="search" value="<?php echo htmlspecialchars( $search );?>" class="inputbox" onChange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>
  
		<table class="adminlist">
		<tr>
			<th width="20">
				#
			</th>
			<th width="5%" class="title"> 
				<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th width="60%" class="title">
				Subject
			</th>
			<th width="15%" class="title">
				From
			</th>
			<th width="15%" class="title">
				Date
			</th>
			<th width="5%" class="title">
				Read
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row =& $rows[$i];
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="20">
					<?php echo $i+1+$pageNav->limitstart;?>
				</td>
				<td width="5%">
					<?php echo mosHTML::idBox( $i, $row->message_id ); ?>
				</td>
				<td width="60%"> 
					<a href="#edit" onClick="hideMainMenu();return listItemTask('cb<?php echo $i;?>','view')">
						<?php echo $row->subject; ?></a> 
				</td>
				<td width="15%">
					<?php echo $row->user_from; ?>
				</td>
				<td width="15%">
					<?php echo $row->date_time; ?>
				</td>
				<td width="15%">
					<?php
					if (intval( $row->state ) == "1") {
						echo 'Read';
					} else {
						echo 'Unread';
					} 
					?>
				</td>
			</tr>
			<?php $k = 1 - $k;
		} 
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>
		
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php 
	}
	
	function editConfig( &$vars, $option) {	
		$tabs = new mosTabs(0);
		?>
		<form action="index2.php" method="post" name="adminForm">
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'saveconfig') {
				if (confirm ("Are you sure?")) {
					submitform( pressbutton );
				}
			} else {
				document.location.href = 'index2.php?option=<?php echo $option;?>';
			}
		}
		</script>
		
		<table class="adminheading">
		<tr>
			<th class="msgconfig">
				Private Messaging Configuration
			</th>
		</tr>
		</table>
	
		<table class="adminform">
		<tr>
			<td width="25%">
				Lock Inbox:
			</td>
			<td> 
				<?php echo $vars['lock']; ?> 
			</td>
		</tr>
		<tr>
			<td>
				Mail me on new Message:
			</td>
			<td> 
				<?php echo $vars['mail_on_new']; ?> 
			</td>
		</tr>
		<tr>
			<td>
				Auto Purge Messages:
			</td>
			<td> 
				<input type="text" name="vars[auto_purge]" size="5" value="<?php echo $vars['auto_purge']; ?>" class="inputbox" /> days old
			</td>
		</tr>
		</table>				
		
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="task" value="">
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php 
	}
	
	function viewMessage( &$row, $option ) {
		?>
		<form action="index2.php" method="post" name="adminForm">
		
		<table class="adminheading">
		<tr>
			<th class="inbox">
				View Private Message
			</th>
		</tr>
		</table>
	
		<table class="adminform">
		<tr>
			<td width="100">
				From:
			</td>
			<td width="85%" bgcolor="#ffffff">
				<?php echo $row->user_from;?>
			</td>
		</tr>
		<tr>
			<td>
				Posted:
			</td>
			<td bgcolor="#ffffff">
				<?php echo $row->date_time;?>
			</td>
		</tr>
		<tr>
			<td>
				Subject:
			</td>
			<td bgcolor="#ffffff">
				<?php echo htmlspecialchars( $row->subject, ENT_QUOTES );?>
			</td>
		</tr>
		<tr>
			<td valign="top">
				Message:
			</td>
			<td width="100%" bgcolor="#ffffff">
				<pre><?php echo htmlspecialchars( $row->message, ENT_QUOTES );?></pre>
			</td>
		</tr>
		</table>
		
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="1" />
		<input type="hidden" name="cid[]" value="<?php echo $row->message_id; ?>" />
		<input type="hidden" name="userid" value="<?php echo $row->user_id_from; ?>" />
		<input type="hidden" name="subject" value="<?php echo ( substr( $row->subject, 0, 4 ) != 'Re: ' ? 'Re: ' : '' ) . htmlspecialchars( $row->subject, ENT_QUOTES ); ?>" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php 
	}
	
	function newMessage($option, $recipientslist, $subject ) {
		global $my;
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
	
			// do field validation
			if (form.subject.value == "") {
				alert( "You must provide a subject." );
			} else if (form.message.value == "") {
				alert( "You must provide a message." );
			} else if (getSelectedValue('adminForm','user_id_to') < 1) {
				alert( "You must select a recipient." );
			} else {
				submitform( pressbutton );
			}
		}
		</script>
	
		<table class="adminheading">
		<tr>
			<th class="inbox">
				New Private Message
			</th>
		</tr>
		</table>
	
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminform">
		<tr>
			<td width="100">
				To:
			</td>
			<td width="85%">
				<?php echo $recipientslist; ?>
			</td>
		</tr>
		<tr>
			<td>
				Subject:
			</td>
			<td>
				<input type="text" name="subject" size="50" maxlength="100" class="inputbox" value="<?php echo htmlspecialchars( $subject, ENT_QUOTES ); ?>"/>
			</td>
		</tr>
		<tr>
			<td valign="top">
				Message:
			</td>
			<td width="100%">
				<textarea name="message" style="width:100%" rows="30" class="inputbox"></textarea>
			</td>
		</tr>
		</table>
		
		<input type="hidden" name="user_id_from" value="<?php echo $my->id; ?>">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="task" value="">
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php 
	}
}
?>
