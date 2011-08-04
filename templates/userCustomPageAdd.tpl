{include file="documentHeader"}
<head>
	<title>{lang}wcf.user.profile.title{/lang} - {lang}wcf.user.profile.members{/lang} - {lang}{PAGE_TITLE}{/lang}</title>
	{include file="headInclude" sandbox=false}
	<script type="text/javascript" src="{@RELATIVE_WCF_DIR}js/TabbedPane.class.js"></script>
	{include file="wysiwyg"}
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
	{capture append="additionalMessages"}
		{if $errorField}
			<p class="error">{lang}wcf.global.form.error{/lang}</p>
		{/if}
	{/captue}
	
	{include file="userProfileHeader"}
	
	<form method="post" action="index.php?form=UserCustomPage{@$action|ucfirst}{if $pageID|isset}{@$pageID}{/if}">
		<div class="border {if $this|method_exists:'getUserProfileMenu' && $this->getUserProfileMenu()->getMenuItems('')|count > 1}tabMenuContent{else}content{/if}">
			<div class="container-1 customUserPage">
				<h3 class="subHeadline">{lang}wcf.user.userCustomPages.{@$action}{/lang}</h3>
			
				<fieldset>
					<legend>{lang}wcf.user.userCustomPages.page.information{/lang}</legend>
					
					<div class="formElement{if $errorField == 'pageName'} formError{/if}">
						<div class="formFieldLabel">
							<label for="pageName">{lang}wcf.user.userCustomPages.page.pageName{/lang}</label>
						</div>
						<div class="formField">
							<input id="pageName" class="inputText" type="text" name="pageName" value="{$pageName}" tabindex="{counter name='tabindex'}" />
							
							{if $errorField == "pageName"}
								<p class="innerError">
									{if $errorType == "empty"}{lang}wcf.global.error.empty{/lang}{/if}
									{if $errorType == "invalid"}{lang}wcf.user.customUserPages.page.pageName.invalid{/lang}{/if}
									{if $errorType == "tooLong"}{lang}wcf.user.customUserPages.page.pageName.tooLong{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc">
							<p>{lang}wcf.user.customUserPages.page.pageName.description{/lang}</p>
						</div>
					</div>
					
					<div class="formElement{if $errorField == 'menuItem'} formError{/if}">
						<div class="formFieldLabel">
							<label for="menuItem">{lang}wcf.user.userCustomPages.page.menuItem{/lang}</label>
						</div>
						<div class="formField">
							<input id="menuItem" class="inputText" type="text" name="menuItem" value="{$menuItem}" tabindex="{counter name='tabindex'}" />
							
							{if $errorField == "menuItem"}
								<p class="innerError">
									{if $errorType == "empty"}{lang}wcf.global.error.empty{/lang}{/if}
									{if $errorType == "tooLong"}{lang}wcf.user.customUserPages.page.menuItem.tooLong{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc">
							<p>{lang}wcf.user.customUserPages.page.menuItem.description{/lang}</p>
						</div>
					</div>
					
					<div class="formElement">
						<div class="formFieldLabel">
							<label for="menuItem">{lang}wcf.user.userCustomPages.page.showOrder{/lang}</label>
						</div>
						<div class="formField">
							<input id="showOrder" class="inputText" type="text" name="showOrder" value="{$showOrder}" tabindex="{counter name='tabindex'}" />
						</div>
						<div class="formFieldDesc">
							<p>{lang}wcf.user.customUserPages.page.showOrder.description{/lang}</p>
						</div>
					</div>
					
					{if $additionalInformationFields|isset}{@$additionalInformationFields}{/if}
				</fieldset>
				
				<fieldset>
					<legend>{lang}wcf.user.customUserPages.page.content{/lang}</legend>
					
					<div class="formElement{if $errorField == 'subject'} formError{/if}">
						<div class="formFieldLabel">
							<label for="subject">{lang}wcf.user.userCustomPages.page.title{/lang}</label>
						</div>
						<div class="formField">
							<input id="subject" class="inputText" type="text" name="subject" value="{$subject}" tabindex="{counter name='tabindex'}" />
							
							{if $errorField == "menuItem"}
								<p class="innerError">
									{if $errorType == "empty"}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc">
							<p>{lang}wcf.user.customUserPages.page.title.description{/lang}</p>
						</div>
					</div>
					
					<div class="editorFrame formElement{if $errorField == 'text'} formError{/if}">
						<div class="formFieldLabel">
							<label for="text">{lang}wcf.user.customUserPages.page.content{/lang}</label>
						</div>
						<div class="formField">
							<textarea id="text" name="text" rows="15" cols="40" tabindex="{counter name='tabindex'}">{$text}</textarea>
							
							{if $errorField == "text"}
								<p class="innerError">
									{if $errorType == "empty"}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
					</div>
					
					{include file="messageFormTabs"}
				</fieldset>
			
				<div class="formSubmit">
					<input type="submit" name="send" accesskey="s" value="{lang}wcf.global.button.submit{/lang}" tabindex="{counter name='tabindex'}" />
					<input type="reset" name="reset" accesskey="r" value="{lang}wcf.global.button.reset{/lang}" tabindex="{counter name='tabindex'}" />
					{@SID_INPUT_TAG}
				</div>
			</div>
		</div>
	</form>
</div>

{include file="footer" sandbox=false}
</body>
</html>
