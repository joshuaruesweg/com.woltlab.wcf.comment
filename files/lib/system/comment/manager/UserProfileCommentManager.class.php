<?php
namespace wcf\system\comment\manager;
use wcf\data\user\UserProfile;
use wcf\system\WCF;

/**
 * User profile comment manager implementation.
 * 
 * @author	Alexander Ebert
 * @copyright	2001-2011 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	com.woltlab.wcf.comment
 * @subpackage	system.comment.manager
 * @category 	Community Framework
 */
class UserProfileCommentManager extends AbstractCommentManager {
	/**
	 * @see wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		if (WCF::getUser()->userID) {
			// validate general permissions
			if (WCF::getSession()->getPermission('user.community.profileComment.canAddComment')) {
				$this->canAdd = true;
			}
			
			if (WCF::getSession()->getPermission('user.community.profileComment.canDeleteComment')) {
				$this->canDelete = true;
			}
			
			if (WCF::getSession()->getPermission('user.community.profileComment.canEditComment')) {
				$this->canEdit = true;
			}
		}
	}
	
	/**
	 * @see wcf\system\comment\manager\AbstractCommentManager::canAdd()
	 */
	public function canAdd($objectID) {
		if (!$this->canAdd) {
			return false;
		}
		
		// check object id
		$userProfile = UserProfile::getUserProfile($objectID);
		if ($userProfile === null) {
			return false;
		}
		
		// check visibility
		if ($userProfile->isProtected()) {
			return false;
		}
		
		// check target user settings
		if (!$userProfile->isAccessible('allowComments')) {
			return false;
		}
		
		return true;
	}
}
