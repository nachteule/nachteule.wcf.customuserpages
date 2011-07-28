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
		if (!WCF::getUser()->getPermission('user.ucstomUserPages.canViewPages'))
			return;
		
		switch ($className) {
			case 'UserProfileMenu':
				$items = UserCustomPage::getMenuItemsByUserID($eventObj->userID);
		
				foreach ($items as $name => $menuItem) {
					UserProfileMenu::getInstance()->menuItems[''][] = array(
						'menuItem' => $menuItem,
						'parentMenuItem' => '',
						'menuItemLink' => 'index.php?page=UserCustomPage&userID='.$eventObj->userID.'&pageName='.$name.SID_ARG_2ND_NOT_ENCODED,
						'menuItemIcon' => 'messageM.png',
						'permissions' => 'user.customUserPages.canViewPages'
					);
				}
				
				break;
			
			case 'UserProfileFrame':
				if (WCF::getUser()->userID == $eventObj->userID && $eventObj->getUser()->getPermission('user.customUserPages.canUse'))
					WCF::getTPL()->append('additionalUserCardOptions',
						WCF::getTPL()->display('customUserPagesUserCardOption')
					);
				
				break;
		}
	}
}
