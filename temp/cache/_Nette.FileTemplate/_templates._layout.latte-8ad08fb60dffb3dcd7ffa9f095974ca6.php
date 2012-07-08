<?php //netteCache[01]000390a:2:{s:4:"time";s:21:"0.59378400 1341590861";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:68:"/Applications/MAMP/htdocs/diplomka-nette/app/templates/@layout.latte";i:2;i:1341590859;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"eb558ae released on 2012-04-04";}}}?><?php

// source file: /Applications/MAMP/htdocs/diplomka-nette/app/templates/@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'lg82o16sd3')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb424595a2ac_head')) { function _lb424595a2ac_head($_l, $_args) { extract($_args)
;
}}

//
// block _flashMessages
//
if (!function_exists($_l->blocks['_flashMessages'][] = '_lbecf47889a7__flashMessages')) { function _lbecf47889a7__flashMessages($_l, $_args) { extract($_args); $_control->validateControl('flashMessages')
;$iterations = 0; foreach ($flashes as $flash): ?>		<div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta name="description" content="Nette Framework web application skeleton" />
<?php if (isset($robots)): ?>	<meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>

	<title><?php if (isset($title)): echo Nette\Templating\Helpers::escapeHtml($title, ENT_NOQUOTES) ?>
 &ndash; <?php endif ?>Úkolníček</title>

	<link rel="stylesheet"  href="<?php echo htmlSpecialChars($basePath) ?>/css/tasklist.css" type="text/css" />
	<link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon.ico" type="image/x-icon" />

	<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        <link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/jquery-ui.css" />
	<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/_netteForms.js"></script>
	<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/ajax.js"></script>
        
        <script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/datepicker.js"></script>
	<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/timepicker.js"></script>
	
        <script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.ui.datepicker-en-GB.min.js"></script>
        
        <script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript">
            tinyMCE.init({
                    mode: "specific_textareas",
                    editor_selector: "mceEditor",
                    theme : "simple"
            });
        </script>
<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

</head>

<body>
<div id="header">
    <div id="header-inner">
        <div class="title"><a href="<?php echo htmlSpecialChars($_control->link("Homepage:")) ?>
">Úkolníček</a></div>
          <a href="<?php echo htmlSpecialChars($_control->link("Cms:form")) ?>">Formular</a> |
           <a href="<?php echo htmlSpecialChars($_control->link("Homepage:contact")) ?>
">Kontakt</a> |
	   <a href="<?php echo htmlSpecialChars($_control->link("Cms:admin")) ?>">Tvorba stranky</a> |
<?php $iterations = 0; foreach ($cms as $list): ?>	 <span><a href="<?php echo htmlSpecialChars($_control->link("Cms:", array($list->id))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($list->nadpis, ENT_NOQUOTES) ?></a>
	 <?php if ($user->isInRole('admin')): ?>(<a href="<?php echo htmlSpecialChars($_control->link("Cms:admin", array($list->id))) ?>
">Edit</a>,<a href="<?php echo htmlSpecialChars($_control->link("deleteCms!", array($list->id))) ?>
">X</a>)<?php endif ?>

	 </span> 
<?php $iterations++; endforeach ;if ($user->isLoggedIn()): ?>
        <div class="user">
            <a class="icon user" href="<?php echo htmlSpecialChars($_control->link("User:info")) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->name, ENT_NOQUOTES) ?>
 (<?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->role, ENT_NOQUOTES) ?>)</span> |
	    <a href="<?php echo htmlSpecialChars($_control->link("User:password")) ?>">Změna hesla</a> |
<?php if (isset($facebookLogoutUrl)): ?>
            <a href="<?php echo htmlSpecialChars($facebookLogoutUrl) ?>">Odhlásit se FB</a>
<?php else: ?>
            <a href="<?php echo htmlSpecialChars($_control->link("signOut!")) ?>
">Odhlásit se</a>
<?php endif ?>
            
        </div>
<?php else: ?>
	<div class="user">
	<a href="<?php echo htmlSpecialChars($_control->link("Sign:in")) ?>">Přihlásit se</a> | 
        <a href="<?php echo htmlSpecialChars($_control->link("Registration:default")) ?>
">Registrace</a>
	</div>
<?php endif ?>
	
	
        
           
        
    </div>
    
</div>

<div id="container">
	
	
<div id="sidebar">
    
     <div class="title">Vyhledat</div>
     <div><?php $_ctrl = $_control->getComponent("searchForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?></div>
    <div class="title">Seznamy úkolů</div>

    <div class="task-lists">
        <ul>
<?php $iterations = 0; foreach ($taskLists as $list): ?>            <li><a href="<?php echo htmlSpecialChars($_control->link("Task:default", array($list->id))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($list->title, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach ?>
        </ul>
    </div>
<?php if ($user->isLoggedIn()): ?>
    <fieldset>
        <legend>Nový seznam</legend>
<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("newTasklistForm") ? "newTasklistForm" : $_control["newTasklistForm"]), array()) ?>
        <div class="new-tasklist-form">
            <?php echo $_form["title"]->getControl()->addAttributes(array()) ?>

            <?php echo $_form["create"]->getControl()->addAttributes(array()) ?>

        </div>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ?>
    </fieldset>
<?php endif ?>
</div>

    <div id="content">
<div id="<?php echo $_control->getSnippetId('flashMessages') ?>"><?php call_user_func(reset($_l->blocks['_flashMessages']), $_l, $template->getParameters()) ?>
</div>
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
    </div>

    <div id="footer">

    </div>
</div>
</body>
</html>
