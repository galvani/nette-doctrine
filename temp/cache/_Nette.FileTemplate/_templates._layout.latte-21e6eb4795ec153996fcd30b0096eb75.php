<?php //netteCache[01]000368a:2:{s:4:"time";s:21:"0.37383000 1305028615";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:46:"/var/www/nette-box/app/templates/@layout.latte";i:2;i:1305028613;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"b8b94c0 released on 2011-05-10";}}}?><?php

// source file: /var/www/nette-box/app/templates/@layout.latte

?><?php
$_l = Nette\Latte\DefaultMacros::initRuntime($template, NULL, 'fwaf9j127p'); unset($_extends);


//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbe87fa492d0_head')) { function _lbe87fa492d0_head($_l, $_args) { extract($_args)
;
}}

//
// end of blocks
//

if ($_l->extends) {
	ob_start();
} elseif (isset($presenter, $control) && $presenter->isAjax() && $control->isControlInvalid()) {
	return Nette\Latte\DefaultMacros::renderSnippets($control, $_l, get_defined_vars());
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta name="description" content="Nette Framework web application skeleton" /><?php if (isset($robots)): ?>
	<meta name="robots" content="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($robots) ?>" />
<?php endif ?>

	<title>Nette Application Skeleton</title>

	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($basePath) ?>/css/screen.css" type="text/css" />
	<link rel="stylesheet" media="print" href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($basePath) ?>/css/print.css" type="text/css" />
	<link rel="shortcut icon" href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($basePath) ?>/favicon.ico" type="image/x-icon" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($basePath) ?>/js/netteForms.js"></script>
	<?php if (!$_l->extends) { call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()); } ?>

</head>

<body><?php foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($flashes) as $flash): ?>
	<div class="flash <?php echo Nette\Templating\DefaultHelpers::escapeHtml($flash->type) ?>"><?php echo Nette\Templating\DefaultHelpers::escapeHtml($flash->message) ?></div>
<?php endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
	<a href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link("Homepage:default")) ?>">aaa</a>

<?php Nette\Latte\DefaultMacros::callBlock($_l, 'content', $template->getParams()) ?>
</body>
</html>
<?php
if ($_l->extends) {
	ob_end_clean();
	Nette\Latte\DefaultMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
