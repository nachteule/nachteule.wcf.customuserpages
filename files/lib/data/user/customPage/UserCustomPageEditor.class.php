<?php
require_once(WCF_DIR.'lib/data/user/customPage/UserCustomPage.class.php');

/**
 * @author	Nachteule`
 * @license	GNU Lesser General Public License
 * @package nachteule.wcf.customuserpages
 */
class UserCustomPageEditor extends UserCustomPage {
	/**
	 * Creates a new custom page.
	 *
	 * @param	integer	$userID
	 * @param	string	$pageName
	 * @param	string	$title
	 * @param	string	$content
	 * @param	string	$menuItem
	 * @param	string	$showOrder
	 * @return	UserCustomPageEditor
	 */
	public static function create($userID, $pageName, $title, $content, $menuItem, $showOrder) {
		$sql = "INSERT INTO wcf".WCF_N."_user_custom_page
					(userID, pageName, title, content, menuItem, showOrder)
				VALUES (".$userID.",
					'".escapeString($pageName)."',
					'".escapeString($title)."',
					'".escapeString($content)."',
					'".escapeString($menuItem)."',
					".$showOrder.")";
		WCF::getDB()->sendQuery($sql);
		$pageID = WCF::getDB()->getInsertedID();
		return new UserCustomPageEditor($pageID);
	}
	
	/**
	 * Updates a page.
	 *
	 * @param	integer	$userID
	 * @param	string	$pageName
	 * @param	string	$title
	 * @param	string	$content
	 * @param	string	$menuItem
	 * @param	string	$showOrder
	 */
	public static function update($userID, $pageName, $title, $content, $menuItem, $showOrder) {
		$sql = "UPDATE wcf".WCF_N."_user_custom_page SET
					userID = ".$userID.",
					pageName = '".escapeString($pageName)."',
					title = '".escapeString($title)."',
					content = '".escapeString($content)."',
					menuItem = '".escapeString($menuItem)."',
					showOrder = ".$showOrder;
		WCF::getDB()->sendQuery($sql);
	}
}
