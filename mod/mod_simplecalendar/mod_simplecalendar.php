
<?php
/*
 * @package   Joomla 2.5
 * @author    Jan Linhart
 * @authorurl http://www.escope.cz
 * @license   GNU/GPL
 *
 * simplecalendar module - main script
 */
defined('_JEXEC') or die('Restricted access');

$view = JRequest::getCmd('view',null);
$layout = JRequest::getCmd('layout',null);
$task   = JRequest::getCmd('task',null);
$catid   = JRequest::getCmd('catid',null);
$option   = JRequest::getCmd('option',null);

JRequest::setVar('view', 'events');
//JRequest::setVar('layout', 'default');
//JRequest::setVar('task', 'display');
JRequest::setVar('option', 'com_simplecalendar');
JRequest::setVar('catid', '');

$lang = JFactory::getLanguage();
$lang->load('com_simplecalendar', JPATH_ADMINISTRATOR);

if (!class_exists('SimpleCalendarController')) {
	require_once (JPATH_BASE .'/components/com_simplecalendar/controller.php');
}

//require JModuleHelper::getLayoutPath('mod_simplecalendar');

$controller = new SimpleCalendarController();
$controller->addModelPath(JPATH_SITE .'/components/com_simplecalendar/models/events.php');
//$controller->addModelPath(JPATH_SITE .'/components/com_simplecalendar/models/event.php');
$controller->setProperties(array(
    'basePath' => JPATH_SITE .'/components/com_simplecalendar',
    'paths' => array(
        'view' => array(
            JPATH_SITE .'/components/com_simplecalendar/views'
            ),
        'model' => array(
            JPATH_SITE .'/components/com_simplecalendar/models'
            )
        )
    ));
$controller->execute('display');

// revert system vars to previous state

if($view != null)
{
JRequest::setVar('view', $view);
}

if($layout != null)
{
JRequest::setVar('layout', $layout);
}

if($task != null)
{
JRequest::setVar('task', $task);
}

if($option != null)
{
JRequest::setVar('option', $option);
}

if($catid != null)
{
JRequest::setVar('catid', $catid);
}
