<?php
require_once(WCF_DIR.'lib/data/DatabaseObject.class.php');

/**
 * @author	Nachteule`
 * @license	GNU Lesser General Public License
 * @package nachteule.wcf.customuserpages
 */
class UserCustomPage extends DatabaseObject {
	public function __construct($pageID, $row = null, $userID = null, $pageName = null) {
		if (!empty($pageID)) {
			$sql = "SELECT *
					FROM wcf".WCF_N."_user_custom_page
					WHERE pageID = ".$pageID;
			$row = WCF::getDB()->getFirstRow($sql);
		}
		
		if (!empty($userID) && !empty($pageName)) {
			$sql = "SELECT *
					FROM wcf".WCF_N."_user_custom_page
					WHERE userID = ".$userID." AND pageName = '".escapeString($pageName)."'";
			$row = WCF::getDB()->getFirstRow($sql);
		}
		
		return parent::__construct($row);
	}
	
	/**
	 * Gets pageName and menuItem of all pages of a user, sorted by showOrder.
	 */
	 public static function getMenuItemsByUserID($userID) {
	 	$sql = "SELECT pageName, menuItem
	 			FROM wcf".WCF_N."_user_custom_page
	 			WHERE userID = ".$userID."
	 			ORDER BY showOrder ASC";
	 	$result = WCF::getDB()->sendQuery($sql);
	 	
	 	$items = array();
	 	while ($row = WCF::getDB()->fetchArray($result))
	 		$items[$row['pageName']] = $row['menuItem'];
	 	
	 	return $items;
	 }
	
	/**
	 * Gets all pages of a user, sorted by showOrder.
	 */
	 public static function getPagesByUserID($userID) {
	 	$sql = "SELECT *
	 			FROM wcf".WCF_N."_user_custom_page
	 			WHERE userID = ".$userID."
	 			ORDER BY showOrder ASC";
	 	$result = WCF::getDB()->sendQuery($sql);
	 	
	 	$pages = array();
	 	while ($row = WCF::getDB()->fetchArray($result))
	 		$pages[] = new UserCustomPage(null, $row);
	 	
	 	return $pages;
	 }
}
