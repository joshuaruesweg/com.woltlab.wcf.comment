<?php
namespace wcf\system\comment\manager;
use wcf\data\user\UserProfile;

/**
 * User profile comment manager implementation.
 * 
 * @author	Alexander Ebert
 * @copyright	2001-2013 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	com.woltlab.wcf.comment
 * @subpackage	system.comment.manager
 * @category	Community Framework
 */
class UserProfileCommentManager extends AbstractCommentManager {
	/**
	 * @see	wcf\system\comment\manager\AbstractCommentManager::$permissionAdd
	 */
	protected $permissionAdd = 'user.profileComment.canAddComment';
	
	/**
	 * @see	wcf\system\comment\manager\AbstractCommentManager::$permissionDelete
	 */
	protected $permissionDelete = 'user.profileComment.canDeleteComment';
	
	/**
	 * @see	wcf\system\comment\manager\AbstractCommentManager::$permissionEdit
	 */
	protected $permissionEdit = 'user.profileComment.canEditComment';
	
	/**
	 * @see	wcf\system\comment\manager\AbstractCommentManager::$permissionModDelete
	 */
	protected $permissionModDelete = '';
	
	/**
	 * @see	wcf\system\comment\manager\AbstractCommentManager::$permissionModEdit
	 */
	protected $permissionModEdit = '';
	
	/**
	 * @see	wcf\system\comment\manager\ICommentManager::isAccessible()
	 */
	public function isAccessible($objectID) {
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
		if (!$userProfile->isAccessible('canWriteProfileComments')) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * @see	wcf\system\comment\manager\ICommentManager::updateCounter()
	 */
	public function updateCounter($objectID, $value) { }
}
