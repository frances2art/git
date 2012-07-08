<?php //netteCache[01]000392a:2:{s:4:"time";s:21:"0.59602900 1341504089";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:70:"/Applications/MAMP/htdocs/diplomka-nette/app/components/TaskList.latte";i:2;i:1341504083;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"eb558ae released on 2012-04-04";}}}?><?php

// source file: /Applications/MAMP/htdocs/diplomka-nette/app/components/TaskList.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'l84evakz8d')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block _
//
if (!function_exists($_l->blocks['_'][] = '_lb816ecc5560__')) { function _lb816ecc5560__($_l, $_args) { extract($_args); $_control->validateControl(false)
?><table class="tasks">
    <thead>
    <tr>
        <th class="created">&nbsp;</th>
<?php if ($displayTaskList): ?>        <th class="tasklist">Seznam</th>
<?php endif ?>
        <th class="text">Úkol</th>
<?php if ($displayUser): ?>        <th class="user">Přiřazeno</th>
<?php endif ;if ($user->isLoggedIn()): ?>        <th class="action">&nbsp;</th>
<?php endif ?>
    </tr>
    </thead>
    <tbody>
    
<?php $_ctrl = $_control->getComponent("paginator"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>

<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($tasks) as $task): ?>
    <tr<?php if ($_l->tmp = array_filter(array($iterator->isOdd() ? 'odd' : 'even', $task->done ? 'done':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>
        <td class="created"><?php echo Nette\Templating\Helpers::escapeHtml($template->date($task->created, 'j. n. Y'), ENT_NOQUOTES) ?></td>
<?php if ($displayTaskList): ?>        <td class="tasklist"><?php echo Nette\Templating\Helpers::escapeHtml($task->tasklist->title, ENT_NOQUOTES) ?></td>
<?php endif ?>
        <td class="text"><a href="<?php echo htmlSpecialChars($_presenter->link("Task:detail", array('task_id'=>$task->id,'id'=>$task->tasklist->id))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($task->text, ENT_NOQUOTES) ?></a></td>
<?php if ($displayUser): ?>        <td class="user"><?php echo Nette\Templating\Helpers::escapeHtml($task->user->name, ENT_NOQUOTES) ?></td>
<?php endif ;if ($user->isLoggedIn()): ?>        <td class="action"><?php if (!$task->done): ?>
<a class="icon tick ajax" href="<?php echo htmlSpecialChars($_control->link("markDone!", array($task->id))) ?>
">hotovo</a>
<?php endif ;if ($task->done): ?>                           <a class="icon tick ajax" href="<?php echo htmlSpecialChars($_control->link("markUnDone!", array($task->id))) ?>
">nehotovo</a>
<?php endif ?>
        </td>
<?php endif ?>
    </tr>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
    </tbody>
</table>
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); } ?>
<div id="<?php echo $_control->getSnippetId('') ?>"><?php call_user_func(reset($_l->blocks['_']), $_l, $template->getParameters()) ?>
</div>