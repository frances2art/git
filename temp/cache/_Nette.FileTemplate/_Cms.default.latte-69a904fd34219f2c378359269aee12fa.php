<?php //netteCache[01]000394a:2:{s:4:"time";s:21:"0.26717800 1340829852";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:72:"/Applications/MAMP/htdocs/diplomka-nette/app/templates/Cms/default.latte";i:2;i:1340829843;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"eb558ae released on 2012-04-04";}}}?><?php

// source file: /Applications/MAMP/htdocs/diplomka-nette/app/templates/Cms/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '3svw307k3a')
;
// prolog Nette\Latte\Macros\CacheMacro
Nette\Latte\Macros\CacheMacro::initRuntime($template, $_g);

// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb0a009a305c_content')) { function _lb0a009a305c_content($_l, $_args) { extract($_args)
?><h1><?php echo Nette\Templating\Helpers::escapeHtml($template->lower($cm->nadpis), ENT_NOQUOTES) ?></h1>
<?php $_ctrl = $_control->getComponent("fbToolsScript"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$_ctrl = $_control->getComponent("likeButton"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render(array('send'=>false, 'width'=>500)) ?>

<?php if (Nette\Latte\Macros\CacheMacro::createCache($netteCacheStorage, 'dupl0yol82', $_g->caches, array($cm->id, 'expire' => '+20 minutes'))) { ?>
<p><?php echo $cm->text ?></p>
<?php $_l->tmp = array_pop($_g->caches); if (!$_l->tmp instanceof stdClass) $_l->tmp->end(); } ?>


<?php $_ctrl = $_control->getComponent("comment"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>



<h2>Komentáře</h2>

<?php if ($user->isLoggedIn()): $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($comments) as $comment): ?>
<div><?php echo Nette\Templating\Helpers::escapeHtml($iterator->getCounter(), ENT_NOQUOTES) ?>
. Mail:<?php echo Nette\Templating\Helpers::escapeHtml($comment->mail, ENT_NOQUOTES) ?>
, <?php echo Nette\Templating\Helpers::escapeHtml($comment->text, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>

<fieldset>
    <legend>Komentář</legend>
<div id="<?php echo $_control->getSnippetId('form') ?>"><?php call_user_func(reset($_l->blocks['_form']), $_l, $template->getParameters()) ?>
</div>   
</fieldset>

<?php else: $_ctrl = $_control->getComponent("comments"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ?>



<?php
}}

//
// block _form
//
if (!function_exists($_l->blocks['_form'][] = '_lb27d279db54__form')) { function _lb27d279db54__form($_l, $_args) { extract($_args); $_control->validateControl('form')
;Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("commentForm") ? "commentForm" : $_control["commentForm"]), array('class' => 'ajax')) ?>
<div class="cms-form">
<?php if (is_object($form)) $_ctrl = $form; else $_ctrl = $_control->getComponent($form); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render('errors') ?>
    <?php if ($_label = $_form["mail"]->getLabel()) echo $_label->addAttributes(array()) ?>
 <?php echo $_form["mail"]->getControl()->addAttributes(array('size' => 50, 'autofocus' => true)) ?><br />
    <?php if ($_label = $_form["text"]->getLabel()) echo $_label->addAttributes(array()) ?>
 <?php echo $_form["text"]->getControl()->addAttributes(array('size' => 50)) ?><br />
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
$title = $cm->nadpis ?>




<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 