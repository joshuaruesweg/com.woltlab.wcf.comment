<script type="text/javascript" src="{@$__wcf->getPath('wcf')}js/WCF.Comment.js"></script>
<script type="text/javascript">
	//<![CDATA[
	$(function() {
		WCF.Language.addObject({
			'wcf.comment.add': '{lang}wcf.comment.add{/lang}',
			'wcf.comment.description': '{lang}wcf.comment.description{/lang}',
			'wcf.comment.more': '{lang}wcf.comment.more{/lang}',
			'wcf.comment.response.add': '{lang}wcf.comment.response.add{/lang}',
			'wcf.comment.response.more': '{lang}wcf.comment.response.more{/lang}'
		});
		
		new {if $commentHandlerClass|isset}{@$commentHandlerClass}{else}WCF.Comment.Handler{/if}('{$commentContainerID}', '{@$__wcf->getUserProfileHandler()->getAvatar()->getImageTag(32)}');
		{if MODULE_LIKE && $__wcf->getSession()->getPermission('user.like.canViewLike')}
			new WCF.Comment.Like({if $__wcf->getUser()->userID && $__wcf->getSession()->getPermission('user.like.canLike')}1{else}0{/if}, {@LIKE_ENABLE_DISLIKE}, false);
		{/if}
	});
	//]]>
</script>