<?php

defined('_JEXEC') or die;

class ReviewsModelReviews extends JModelList
{

	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'rws.id',
				'fio', 'rws.fio',
				'rate', 'rws.rate',
				'date', 'ct.date',
				'email','rws.email',
				'organization','rws.organization',
				'published', 'rws.published',
				'ordering', 'rws.ordering'
			);
		}
		
		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$db	= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'rws.*'
			)
		);
		$query->from($db->quoteName('#__reviews').' AS rws');

		// Filter by published state
		$state = $this->getState('filter.state');
		if (is_numeric($state)) {
			$query->where('rws.state = '.(int) $state);
		} elseif ($state === '') {
			$query->where('(rws.state IN (0, 1))');
		}
		
		// Filter by published state
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('rws.published = ' . (int) $published);
		}
		elseif ($published === '') {
			$query->where('(rws.published = 0 OR rws.published = 1)');
		}
		
		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('rws.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('(rws.fio LIKE '.$search.' OR rws.email LIKE '.$search.' OR rws.phone LIKE '.$search.')');
			}
		}

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'ordering');
		$orderDirn	= $this->state->get('list.direction', 'ASC');
		$query->order($db->escape($orderCol.' '.$orderDirn));

		//echo nl2br(str_replace('#__','jos_',$query));
		return $query;
	}


	protected function getStoreId($id = '')
	{
		// Compile the store id.
	 	$id	.= ':'.$this->getState('filter.search');
	 	$id	.= ':'.$this->getState('filter.rws_id');

	 	return parent::getStoreId($id);
	}


	public function getTable($type = 'reviews', $prefix = 'ReviewsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}


	protected function populateState($ordering = null, $direction = null)
	{
	 	$app = JFactory::getApplication('administrator');

	 	$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
	 	$this->setState('filter.search', $search);
		
		$state = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $state);
		
		$access = $this->getUserStateFromRequest($this->context.'.filter.access', 'filter_access', 0, 'int');
		$this->setState('filter.access', $access);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);
		
	 	$params = JComponentHelper::getParams('com_reviews');
	 	$this->setState('params', $params);

	 	parent::populateState('rws.date', 'asc');
	}
}
