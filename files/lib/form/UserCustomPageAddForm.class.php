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
	public $templateName = 'userCustomPageAdd';
	public $showAttachments = false;
	public $showPoll = false;
	public $showSignatureSetting = false;
	public $useCaptcha = false;
	public $frame;
	
	public $pageName = '';
	public $menuItem = '';
	public $showOrder = 0;
	
	public $page;
	
	/**
	 * @see Page::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		$this->frame = new UserProfileFrame($this, WCF::getUser()->userID);
		
		if (!$this->frame->getUser()->getPermission('user.customUserPages.canUse'))
			throw new IllegalLinkException();
	}
	
	/**
	 * @see Form::readFormParameters()
	 */
	public function readFormParameters() {
		parent::readFormParameters();
		
		if (!empty($_POST['pageName']))
			$this->pageName = StringUtil::trim($_POST['pageName']);
		
		if (!empty($_POST['menuItem']))
			$this->menuItem = StringUtil::trim($_POST['menuItem']);
		
		if (!empty($_POST['showOrder']))
			$this->showOrder = intval($_POST['showOrder']);
	}
	
	/**
	 * @see Form::validate()
	 */
	public function validate() {
		parent::validate();
		
		if (empty($this->pageName))
			throw new UserInputException('pageName', 'empty');
		
		if (!preg_match('/^[a-z0-9_-]+$/i', $this->pageName))
			throw new UserInputException('pageName', 'invalid');
		
		if (StringUtil::length($this->pageName) > 20)
			throw new UserInputException('pageName', 'tooLong');
		
		if (empty($this->menuItem))
			throw new UserInputException('menuItem', 'empty');
		
		if (StringUtil::length($this->menuItem) > 20)
			throw new UserInputException('menuItem', 'tooLong');
	}
	
	/**
	 * @see Form::save()
	 */
	public function save() {
		parent::save();
		
		$this->page = UserCustomPageEditor::create(
			$this->frame->getUser()->userID,
			$this->pageName,
			$this->subject,
			$this->text,
			$this->menuItem
		);
		
		$this->saved();
		
		HeaderUtil::redirect('index.php?page=UserCustomPage&userID='.$this->frame->getUser()->userID.'&pageName='.$this->pageName.SID_ARG_2ND_NOT_ENCODED);
		exit;
	}
	
	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		$this->frame->assignVariables();
		
		WCF::getTPL()->assign(array(
			'action' => 'add',
			'pageName' => $this->pageName,
			'menuItem' => $this->menuItem
		));
	}
}
