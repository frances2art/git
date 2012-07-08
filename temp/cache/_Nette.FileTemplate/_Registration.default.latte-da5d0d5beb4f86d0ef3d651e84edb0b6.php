<?php //netteCache[01]000403a:2:{s:4:"time";s:21:"0.66405500 1340782093";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:81:"/Applications/MAMP/htdocs/diplomka-nette/app/templates/Registration/default.latte";i:2;i:1340281842;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"eb558ae released on 2012-04-04";}}}?><?php

// source file: /Applications/MAMP/htdocs/diplomka-nette/app/templates/Registration/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '97td3zq8sw')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb43c36d4dd5_content')) { function _lb43c36d4dd5_content($_l, $_args) { extract($_args)
?><h1>Regisrace</h1>

<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("registrationForm") ? "registrationForm" : $_control["registrationForm"]), array()) ?>
<div class="sign-in-form">
<?php if (is_object($form)) $_ctrl = $form; else $_ctrl = $_control->getComponent($form); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render('errors') ?>

    <div class="pair">
<?php if ($_label = $_form["name"]->getLabel()) echo $_label->addAttributes(array()) ?>
        <div class="input"><?php echo $_form["name"]->getControl()->addAttributes(array()) ?></div>
    </div>
    
    <div class="pair">
<?php if ($_label = $_form["mail"]->getLabel()) echo $_label->addAttributes(array()) ?>
        <div class="input"><?php echo $_form["mail"]->getControl()->addAttributes(array()) ?></div>
    </div>
    
    <div class="pair">
<?php if ($_label = $_form["username"]->getLabel()) echo $_label->addAttributes(array()) ?>
        <div class="input"><?php echo $_form["username"]->getControl()->addAttributes(array()) ?></div>
    </div>
    <div class="pair">
<?php if ($_label = $_form["password"]->getLabel()) echo $_label->addAttributes(array()) ?>
        <div class="input"><?php echo $_form["password"]->getControl()->addAttributes(array()) ?></div>
    </div>
    
    <div class="pair">
<?php if ($_label = $_form["password2"]->getLabel()) echo $_label->addAttributes(array()) ?>
        <div class="input"><?php echo $_form["password2"]->getControl()->addAttributes(array()) ?></div>
    </div>
    

    <div class="pair">
        <div class="input"><?php echo $_form["registration"]->getControl()->addAttributes(array()) ?></div>
    </div>
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
$robots = 'noindex' ?>

<?php $title = 'Registrace' ?>


<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 