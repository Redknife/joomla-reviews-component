<?php

defined('_JEXEC') or die;

class ReviewsTableReviews extends JTable
{

	public function __construct(&$_db)
	{
		parent::__construct('#__reviews', 'id', $_db);
	}
	
}