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

global $mosConfig_offset, $option, $task;

$id 		= intval( mosGetParam( $_REQUEST, 'id', null ) );

$now 		= _CURRENT_SERVER_TIME;
$nullDate 	= $database->getNullDate();

if ($option == 'com_content' && $task == 'view' && $id) {
	// select the meta keywords from the item
	$query = "SELECT metakey"
	. "\n FROM #__content"
	. "\n WHERE id = " . (int) $id
	;
	$database->setQuery( $query );
	if ($metakey = trim( $database->loadResult() )) {
		// explode the meta keys on a comma
		$keys = explode( ',', $metakey );
		$likes = array();

		// assemble any non-blank word(s)
		foreach ($keys as $key) {
			$key = trim( $key );
			if ($key) {
				$likes[] = $database->getEscaped( $key, true );
			}
		}

		if (count( $likes )) {
			// select other items based on the metakey field 'like' the keys found
			$query = "SELECT a.id, a.title, a.sectionid, a.catid, cc.access AS cat_access, s.access AS sec_access, cc.published AS cat_state, s.published AS sec_state"
			. "\n FROM #__content AS a"
			. "\n LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id"
			. "\n LEFT JOIN #__categories AS cc ON cc.id = a.catid"
			. "\n LEFT JOIN #__sections AS s ON s.id = a.sectionid"
			. "\n WHERE a.id != " . (int) $id
			. "\n AND a.state = 1"
			. "\n AND a.access <= " . (int) $my->gid
			. "\n AND ( a.metakey LIKE '%" . implode( "%' OR a.metakey LIKE '%", $likes ) ."%' )"
			. "\n AND ( a.publish_up = " . $database->Quote( $nullDate ) . " OR a.publish_up <= " . $database->Quote( $now ) . " )"
			. "\n AND ( a.publish_down = " . $database->Quote( $nullDate ) . " OR a.publish_down >= " . $database->Quote( $now ) . " )"
			;
			$database->setQuery( $query );
			$temp = $database->loadObjectList();

			$related = array();
			if (count($temp)) {
				foreach ($temp as $row ) {
					if (($row->cat_state == 1 || $row->cat_state == '') &&  ($row->sec_state == 1 || $row->sec_state == '') &&  ($row->cat_access <= $my->gid || $row->cat_access == '') &&  ($row->sec_access <= $my->gid || $row->sec_access == '')) {
						$related[] = $row;
					}
				}
			}
			unset($temp);

			if ( count( $related ) ) {
				?>
				<ul>
					<?php
					foreach ($related as $item) {
						if ($option == 'com_content' && $task == 'view') {
							$Itemid = $mainframe->getItemid($item->id);
						}
						$href = sefRelToAbs( "index.php?option=com_content&amp;task=view&amp;id=$item->id&amp;Itemid=$Itemid" );
						?>
						<li>
							<a href="<?php echo $href; ?>">
								<?php echo $item->title; ?></a>
						</li>
						<?php
					}
					?>
				</ul>
				<?php
			}
		}
	}
}
?>