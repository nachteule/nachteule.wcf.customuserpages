<?php
require_once(WCF_DIR.'lib/action/AbstractSecureAction.class.php');
require_once(WCF_DIR.'lib/data/user/customPage/UserCustomPageEditor.class.php');

/**
 * @author	Nachteule`
 * @license	GNU Lesser General Public License
 * @package nachteule.wcf.customuserpages
 */
class UserCustomPageDeleteAction extends AbstractSecureAction {
	public $pageID = 0;
	public $page;
	
	/**
	 * @see Action::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		if (!empty($_GET['pageID']))
			$this->pageID = intval($_GET['pageID']);
		
		$this->page = new UserCustomPageEditor($this->pageID);
		
		if (!$this->page->pageID)
			throw new IllegalLinkException();
		
		if ($this->page->userID != WCF::getUser->userID
			|| WCF::getUser()->getPermission('user.customPages.canUse'))
			throw new PermissionDeniedException();
	}
	
	/**
	 * @see Action::execute()
	 */
	public function execute() {
		parent::execute();
		
		$this->page->delete();
		$this->executed();
		
		HeaderUtil::redirect('index.php?page=User&userID='.$this->page->userID.SID_ARG_2ND_NOT_ENCODED);
		exit;
	}
}
