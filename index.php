<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

//Remove jquery shit
$headData = $doc->getHeadData();
$scripts = $headData['scripts'];
unset($scripts[JUri::root(true) . '/media/jui/js/jquery.min.js']);
unset($scripts[JUri::root(true) . '/media/jui/js/jquery-noconflict.js']);
unset($scripts[JUri::root(true) . '/media/jui/js/jquery-migrate.min.js']);
unset($scripts[JUri::root(true) . '/media/jui/js/bootstrap.min.js']);
$headData['scripts'] = $scripts;
$doc->setHeadData($headData);

$path   = JURI::base(true).'/templates/'.$app->getTemplate().'/';

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js');

if($view == 'featured')
{
	$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/twitter.js');
}

// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>

<?php
	$active = JFactory::getApplication()->getMenu()->getActive();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />

	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,700' rel='stylesheet' type='text/css'>

	<?php // Template color ?>
	<?php if ($this->params->get('templateBackgroundColor')) : ?>
	<style type="text/css">
		.backcolor
		{
			background-color: <?php echo $this->params->get('templateBackgroundColor'); ?>
		}
		.backcolor-shine
		{
			color: <?php echo $this->params->get('templateBackgroundColor'); ?>
		}
		.view-featured section > h2 {
			color:  <?php echo $this->params->get('templateBackgroundColor'); ?>
		}
		.navbar-inner
		{
			-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
		}
		.view-featured .head {
			background-image: url(<?php echo $path; ?>/media/landing-bg.jpg);
		}
	</style>
	<?php endif; ?>

</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">
  	<header>
    		<a class="site-logo" href="/"><h1>
      			<img src="<?php echo $path; ?>/media/metro-logo.svg" />
      			<span>MetropolSolar</span><span>Rhein-Neckar</span>
    		</h1></a>
    		<div class="mod-main-menu">
    			<jdoc:include type="modules" name="main-menu" title="Main Menu" style="none"/>
    		</div>
  	</header>

  	<?php if($view != 'featured'): ?>
  	<div class="main-mask">
  	<div class="main-wrapper">
  	<?php endif; ?>
		<main id="content" role="main">
			<!-- Begin Content -->
			<jdoc:include type="message" />
			<jdoc:include type="component" />

			<?php if($view != 'featured'): ?>
			<div class="mod-pre-footer">
				<jdoc:include type="modules" name="pre-footer" style="none" />
			</div>
			<?php endif; ?>
		</main>

		<?php if($view != 'featured'): ?>
		<nav class="sidebar">
			<div class="mod-search">
				<jdoc:include type="modules" name="search" style="none" />
			</div>
			<div class="mod-sidebar">
				<jdoc:include type="modules" name="sidebar" style="none" />
			</div>
		</nav>
	</div>
	</div>
	<?php endif; ?>

	<div class="cloud-catcher">
	</div>

	<footer>
  		<a class="site-logo" href="/">
      			<img class="shadow" src="<?php echo $path; ?>/media/metro-logo.svg" />

      			<h1>MetropolSolar</h1>
      			<h2>Rhein-Neckar</h2>
    		</a>

    		<div class="four-columns">
    			<div class="leftest">
 	   			<jdoc:include type="modules" name="footer-column-1" style="html5" />
    			</div>
    			<div class="left">
 	   			<jdoc:include type="modules" name="footer-column-2" style="html5" />
    			</div>
    			<div class="right">
 	   			<jdoc:include type="modules" name="footer-column-3" style="html5" />
    			</div>
    			<div class="rightest">
 	   			<jdoc:include type="modules" name="footer-column-4" style="html5" />
    			</div>
    		</div>

    		<div class="mod-footer">
    			<jdoc:include type="modules" name="footer" />
    		</div>
   	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
