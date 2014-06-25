<?php


defined('_JEXEC') or die;


class ReviewsModelReviews extends JModelList
{
	
	public $_context = 'com_reviews.all';

	protected $_extension = 'com_reviews';

	private $_parent = null;

	private $_items = null;


	public function getItems()
	{
		
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('c.*');
		$query->from('#__reviews AS c');
		$query->where('c.published = 1');
		$query->order('c.date DESC');

		$db->setQuery($query);

		$this->_items = $db->loadObjectList();
		
		return $this->_items;
	}
}