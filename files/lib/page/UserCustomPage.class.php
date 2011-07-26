<?php
require_once(WCF_DIR.'lib/page/AbstractPage.class.php');
require_once(WCF_DIR.'lib/data/user/UserProfileFrame.class.php');
require_once(WCF_DIR.'lib/data/user/customPage/UserCustomPage.class.php');

/**
 * @author	Nachteule`
 * @license	GNU Lesser General Public License
 * @package nachteule.wcf.customuserpages
 */
class UserCustomPagePage extends AbstractPage {
	public $templateName = 'userCustomPage';
	public $neededPermissions = 'user.customUserPages.canViewPages';
	public $frame;
	
	public $pageName = '';
	public $page;
	
	/**
	 * @see Page::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		$this->frame = new UserProfileFrame($this);
		
		if (!$this->frame->getUser()->getPermission('user.customUserPages.canUse'))
			throw new IllegalLinkException();
		
		if (!empty($_GET['pageName']))
			$this->pageName = StringUtil::trim($_GET['pageName']);
	}
	
	/**
	 * @see Page::readData()
	 */
	public function readData() {
		parent::readData();
		
		$this->page = new UserCustomPage(null, null, $this->frame->getUser()->userID, $this->pageName);
		
		if (!$this->page->pageID)
			throw new IllegalLinkException();
	}
	
	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		$this->frame->assignVariables();
		
		WCF::getTPL()->assign(array(
			'page' => $this->page
		))
	}
	
	/**
	 * @see Page::show()
	 */
	public function show() {
		UserProfileMenu::getInstance()->setActiveMenuItem($this->page->menuItem);
		
		parent::show();
	}
}
