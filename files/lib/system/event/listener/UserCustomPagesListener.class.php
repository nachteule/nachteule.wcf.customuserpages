<?php
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');
require_once(WCF_DIR.'lib/data/user/customPage/UserCustomPage.class.php');

/**
 * Adds tabs to custom user pages to the user profile.
 *
 * @author	Nachteule`
 * @license	GNU Lesser General Public License
 * @package nachteule.wcf.customuserpages
 */
class UserCustomPagesListener implements EventListener {
	/**
	 * @see EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		if (!$eventObj->getUser()->getPermission('user.customUserPages.canUse'))
			return;
		
		$pages = UserCustomPage::getPagesByUserID($eventObj->getUser()->userID);
		
		foreach ($pages as $name => $menuItem) {
			UserProfileMenu::getInstance()->menuItems[''][] = array(
				'menuItem' => $menuItem,
				'menuItemLink' => 'index.php?page=UserCustomPage&userID='.$eventObj->getUser()->userID.'&pageName='.$name.SID_ARG_2ND_NOT_ENCODED,
				'menuItemIcon' => StyleManager::getStyle()->getIconPath('messageM.png')
			);
		}
	}
}
