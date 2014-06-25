<?php
defined('_JEXEC') or die;

class ReviewsControllerReview extends JControllerForm
{
	protected $view_list = 'Reviews';
	
	public function saveOrderAjax()
	{
		// Get the input
		$pks = $this->input->post->get('cid', array(), 'array');
		$order = $this->input->post->get('order', array(), 'array');
		
		// Sanitize the input
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		// Close the application
		JFactory::getApplication()->close();
	}
}
