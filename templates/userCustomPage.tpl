{include file="documentHeader"}
<head>
	<title>{lang}wcf.user.profile.title{/lang} - {lang}wcf.user.profile.members{/lang} - {lang}{PAGE_TITLE}{/lang}</title>
	{include file="headInclude" sandbox=false}
</head>
<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>
{* --- quick search controls --- *}
{assign var='searchFieldTitle' value='{lang}wcf.user.profile.search.query{/lang}'}
{capture assign=searchHiddenFields}
	<input type="hidden" name="userID" value="{@$user->userID}" />
{/capture}
{* --- end --- *}
{include file="header" sandbox=false}

<div id="main">
	{include file="userProfileHeader"}
	
	<div class="border {if $this|method_exists:'getUserProfileMenu' && $this->getUserProfileMenu()->getMenuItems('')|count > 1}tabMenuContent{else}content{/if}">
		<div class="container-1 customUserPage">
			<h3 class="subHeadline">{$page->title}</h3>
			
			{@$page->getFormattedContent()}
			
			<div class="buttonBar">
				<div class="smallButtons">
					<ul>
						<li class="extraButton"><a href="#top" title="{lang}wcf.global.scrollUp{/lang}"><img src="{icon}upS.png{/icon}" alt="{lang}wcf.global.scrollUp{/lang}" /> <span class="hidden">{lang}wcf.global.scrollUp{/lang}</span></a></li>
						
						{if $this->userID == $user->userID && $this->user->getPermission('user.customPages.canUse')}
							<li>
								<a href="index.php?action=UserCustomPageDelete&amp;pageID={@$page->pageID}{@SID_ARG_2ND}" onclick="return confirm('{lang}wcf.user.customPages.delete.sure{/lang}')">
									<img src="{icon}deleteS.png{/icon}" alt="{lang}wcf.user.customPages.delete{/lang}" />
									<span>{lang}wcf.user.customPages.delete{/lang}</span>
								</a>
							</li>
							
							<li>
								<a href="index.php?form=UserCustomPageEdit&amp;pageID={@$page->pageID}{@SID_ARG_2ND}">
									<img src="{icon}editS.png{/icon}" alt="{lang}wcf.user.customPages.edit{/lang}" />
									<span>{lang}wcf.user.customPages.edit{/lang}</span>
								</a>
							</li>
						{/if}
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

{include file="footer" sandbox=false}
</body>
</html>
