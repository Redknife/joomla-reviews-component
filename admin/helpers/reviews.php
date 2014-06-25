<?php
defined('_JEXEC') or die;


class ReviewsHelper
{
	
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_REVIEWS_SUBMENU_REVIEWS'),
			'index.php?option=com_reviews&view=reviews',
			$vName == 'reviews'
		);
		
	}


	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$actions = JAccess::getActions('com_reviews', 'component');

		foreach ($actions as $action) {
			$result->set($action->name,	$user->authorise($action->name, 'com_reviews'));
		}
		
		return $result;
	}
  
}
