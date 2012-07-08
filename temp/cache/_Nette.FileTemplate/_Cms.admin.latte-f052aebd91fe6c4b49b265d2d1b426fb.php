<?php //netteCache[01]000392a:2:{s:4:"time";s:21:"0.20668100 1341588789";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:70:"/Applications/MAMP/htdocs/diplomka-nette/app/templates/Cms/admin.latte";i:2;i:1341588292;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"eb558ae released on 2012-04-04";}}}?><?php

// source file: /Applications/MAMP/htdocs/diplomka-nette/app/templates/Cms/admin.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '6pgrzzho9f')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbb8e2884539_content')) { function _lbb8e2884539_content($_l, $_args) { extract($_args)
?><fieldset>


<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("cmsForm") ? "cmsForm" : $_control["cmsForm"]), array()) ?>
<div class="cms-form">
<?php if (is_object($form)) $_ctrl = $form; else $_ctrl = $_control->getComponent($form); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render('errors') ?>
    <?php if ($_label = $_form["nadpis"]->getLabel()) echo $_label->addAttributes(array()) ?>
 <?php echo $_form["nadpis"]->getControl()->addAttributes(array('size' => 50, 'autofocus' => true)) ?><br />
    <?php if ($_label = $_form["text"]->getLabel()) echo $_label->addAttributes(array()) ?>
 <?php echo $_form["text"]->getControl()->addAttributes(array('size' => 50)) ?><br />
    <?php echo $_form["create"]->getControl()->addAttributes(array()) ?>

</div>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ?>

</fieldset>

<?php
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
$title = 'Administrace textu' ?>



<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 