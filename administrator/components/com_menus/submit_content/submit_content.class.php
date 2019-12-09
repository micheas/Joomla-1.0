<?php
/**
 * @version    $Id$
 * @package    Joomla
 * @subpackage Menus
 * @copyright  Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL, see docs/LICENSE.php
 *             Joomla! is free software. This version may have been modified pursuant
 *             to the GNU General Public License, and as distributed it includes or
 *             is derivative of works licensed under the GNU General Public License or
 *             other free or open source software licenses.
 *             See COPYRIGHT.php for copyright notices and details.
 */

/** ensure this file is being included by a parent file */
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

/**
 * @package    Joomla
 * @subpackage Menus
 */
class submit_content_menu
{

	/**
	 * @param database A database connector object
	 * @param integer  The unique id of the category to edit (0 if new)
	 */
	function edit(&$uid, $menutype, $option)
	{
		global $database, $my, $mainframe;

		$menu = new mosMenu($database);
		$menu->load((int) $uid);

		// fail if checked out not by 'me'
		if ($menu->checked_out && $menu->checked_out != $my->id)
		{
			mosErrorAlert("The module " . $menu->title . " is currently being edited by another administrator");
		}

		if ($uid)
		{
			$menu->checkout($my->id);
		}
		else
		{
			$menu->type = 'submit_content';
			$menu->menutype = $menutype;
			$menu->browserNav = 0;
			$menu->ordering = 9999;
			$menu->parent = intval(mosGetParam($_POST, 'parent', 0));
			$menu->published = 1;
		}
		// build the html select list for section
		$lists['componentid'] = mosAdminMenus::Section($menu, $uid);
		// build the html select list for ordering
		$lists['ordering'] = mosAdminMenus::Ordering($menu, $uid);
		// build the html select list for the group access
		$lists['access'] = mosAdminMenus::Access($menu);
		// build the html select list for paraent item
		$lists['parent'] = mosAdminMenus::Parent($menu);
		// build published button option
		$lists['published'] = mosAdminMenus::Published($menu);
		// build the url link output
		$lists['link'] = mosAdminMenus::Link($menu, $uid);

		// get params definitions
		$params =new mosParameters($menu->params, $mainframe->getPath('menu_xml', $menu->type), 'menu');

		submit_content_menu_html::edit($menu, $lists, $params, $option);
	}
}
