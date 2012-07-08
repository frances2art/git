<?php //netteCache[01]000395a:2:{s:4:"time";s:21:"0.30108500 1340789742";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:73:"/Applications/MAMP/htdocs/diplomka-nette/app/templates/Task/default.latte";i:2;i:1340789740;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"eb558ae released on 2012-04-04";}}}?><?php

// source file: /Applications/MAMP/htdocs/diplomka-nette/app/templates/Task/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'gargut40hc')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb76ff9b35db_content')) { function _lb76ff9b35db_content($_l, $_args) { extract($_args)
;$_ctrl = $_control->getComponent("navigation"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>


<h1><?php echo Nette\Templating\Helpers::escapeHtml($taskList->title, ENT_NOQUOTES) ?>
 <?php if ($user->isInRole('admin')): ?><a class="icon tick" href="<?php echo htmlSpecialChars($_control->link("deleteTaskList!")) ?>
">Smazat</a><?php endif ?></h1>
<?php if ($user->isLoggedIn()): ?>
<fieldset>
    <legend>Přidat úkol</legend>
<div id="<?php echo $_control->getSnippetId('form') ?>"><?php call_user_func(reset($_l->blocks['_form']), $_l, $template->getParameters()) ?>
</div></fieldset>
<?php endif ?>


<?php $_ctrl = $_control->getComponent("taskList"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>


<?php
}}

//
// block _form
//
if (!function_exists($_l->blocks['_form'][] = '_lb31b60e789a__form')) { function _lb31b60e789a__form($_l, $_args) { extract($_args); $_control->validateControl('form')
;Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("taskForm") ? "taskForm" : $_control["taskForm"]), array('class' => 'ajax')) ?>
<div class="task-form">
<?php if (is_object($form)) $_ctrl = $form; else $_ctrl = $_control->getComponent($form); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render('errors') ?>

    <?php if ($_label = $_form["text"]->getLabel()) echo $_label->addAttributes(array()) ?>
 <?php echo $_form["text"]->getControl()->addAttributes(array('size' => 30, 'autofocus' => true)) ?>
 <?php if ($_label = $_form["userId"]->getLabel()) echo $_label->addAttributes(array()) ?>
 <?php echo $_form["userId"]->getControl()->addAttributes(array()) ?> <?php echo $_form["done"]->getControl()->addAttributes(array()) ?>
 <?php echo $_form["create"]->getControl()->addAttributes(array()) ?>

</div>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ;
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
$title = $taskList->title ?>


<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 