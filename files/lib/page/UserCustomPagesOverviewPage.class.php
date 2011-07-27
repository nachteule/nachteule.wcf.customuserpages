<?php
require_once(WCF_DIR.'lib/page/AbstractPage.class.php');
require_once(WCF_DIR.'lib/page/util/menu/UserCPMenu.class.php')
require_once(WCF_DIR.'lib/data/user/customPage/UserCustomPage.class.php');

/**
 * @author	Nachteule`
 * @license	GNU Lesser General Public License
 * @package nachteule.wcf.customuserpages
 */
class UserCustomPagesOverviewPage extends AbstractPage {
	public $templateName = 'userCustomPagesOverview';
	public $neededPermissions = 'user.customUserPages.canUse';
	
	public $pages = array();
	
	/**
	 * @see Page::readData()
	 */
	public function readData() {
		parent::readData();
		
		$this->pages = UserCustomPage::getPagesByUserID(WCF::getUser()->userID);
	}
	
	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'pages' => $this->pages
		));
	}
	
	/**
	 * @see Page::show()
	 */
	public function show() {
		if (!WCF::getUser()->userID)
			throw new PermissionDeniedException();
		
		UserCPMenu::getInstance()->setActiveMenuItem('wcf.user.usercp.menu.link.profile.customPagesOverview');
		
		parent::show();
	}
}
