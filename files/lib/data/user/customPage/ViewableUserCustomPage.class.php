<?php
require_once(WCF_DIR.'lib/data/user/customPage/UserCustomPage.class.php');

/**
 * @author	Nachteule`
 * @license	GNU Lesser General Public License
 * @package nachteule.wcf.customuserpages
 */
class ViewableUserCustomPage extends UserCustomPage {
	/**
	 * Returns the formatted content.
	 *
	 * @return string
	 */
	public function getFormattedContent() {
		require_once(WCF_DIR.'lib/data/message/bbcode/MessageParser.class.php');
		
		MessageParser::getInstance()->setOutputType('text/html');
		
		return MessageParser::getInstance()->parse($this->content, true, false, true, false);
	}
}
