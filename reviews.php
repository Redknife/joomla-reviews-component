<?php

defined('_JEXEC') or die;

define('DS', DIRECTORY_SEPARATOR);

$controller = JControllerLegacy::getInstance('Reviews');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();