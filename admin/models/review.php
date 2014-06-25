<?php

defined('_JEXEC') or die;

class ReviewsModelReview extends JModelAdmin
{

	public function getTable($type = 'Reviews', $prefix = 'ReviewsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_reviews.review', 'Review', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}


	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$app  = JFactory::getApplication();
		$data = $app->getUserState('com_reviews.edit.Review.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}
	
	public function getItem($pk = null)
	{
		$item = parent::getItem($pk);
		
		return $item;
	}
        
	public function save($data)
	{			
		return parent::save($data);
	}
	
}
