<?php //netteCache[01]000397a:2:{s:4:"time";s:21:"0.21897200 1341493320";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:75:"/Applications/MAMP/htdocs/diplomka-nette/app/templates/emails/contact.latte";i:2;i:1341493290;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"eb558ae released on 2012-04-04";}}}?><?php

// source file: /Applications/MAMP/htdocs/diplomka-nette/app/templates/emails/contact.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'n7u0oz96n7')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>
<html>
    <head>
        <title><?php echo Nette\Templating\Helpers::escapeHtml($title, ENT_NOQUOTES) ?></title>
    </head>
    <body>
        <ul>
            <li>Jmeno <?php echo Nette\Templating\Helpers::escapeHtml($form->values->name, ENT_NOQUOTES) ?></li>
            <li>Mail <?php echo Nette\Templating\Helpers::escapeHtml($form->values->mail, ENT_NOQUOTES) ?></li>
        </ul>
        <p><?php echo Nette\Templating\Helpers::escapeHtml($form->values->text, ENT_NOQUOTES) ?></p>
            
    </body>
    

</html>