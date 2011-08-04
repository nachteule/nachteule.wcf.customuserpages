<?php
require_once(WCF_DIR.'lib/form/MessageForm.class.php');
require_once(WCF_DIR.'lib/data/user/UserProfileFrame.class.php');
require_once(WCF_DIR.'lib/data/user/customPage/UserCustomPageEditor.class.php');

/**
 * @author	Nachteule`
 * @license	GNU Lesser General Public License
 * @package nachteule.wcf.customuserpages
 */
class UserCustomPageAddForm extends MessageForm {
	public $pageID = 0;
	
	/**
	 * @see Page::readParameters()
	 */
	public function readParameters() {
		MessageForm::readParameters();
		
		if (!empty($_GET['pageID']))
			$this->pageID = intval($_GET['pageID']);
		
		$this->page = UserCustomPageEditor($this->pageID);
		
		if (!$this->page->pageID)
			throw new IllegalLinkException();
		
		$this->frame = new UserProfileFrame($this, $this->page->userID);
		
		if (!$this->frame->getUser()->getPermission('user.customUserPages.canUse'))
			throw new IllegalLinkException();
		
		if ($this->frame->getUser()->userID != WCF::getUser()->userID)
			WCF::getUser()->checkPermission('mod.customUserPages.canEdit');
	}
	
	/**
	 * @see Form::save()
	 */
	public function save() {
		parent::save();
		
		$this->page->update(
			$this->page->userID,
			$this->pageName,
			$this->subject,
			$this->text,
			$this->menuItem,
			$this->showOrder
		);
		
		$this->saved();
		
		HeaderUtil::redirect('index.php?page=UserCustomPage&userID='.$this->page->userID.'&pageName='.$this->pageName.SID_ARG_2ND_NOT_ENCODED);
		exit;
	}
	
	/**
	 * @see Page::readData()
	 */
	public function readData() {
		if (!count($_POST)) {
			$this->pageName = $this->page->pageName;
			$this->subject = $this->page->title;
			$this->text = $this->page->content;
			$this->menuItem = $this->page->menuItem;
			$this->showOrder = $this->page->showOrder;
		}
	}
	
	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'action' => 'edit',
			'pageID' => $this->pageID
		));
	}
}
