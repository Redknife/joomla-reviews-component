<?php


defined('_JEXEC') or die;


class ReviewsController extends JControllerLegacy
{
	
	protected $default_view = 'reviews';
	
	public function display($cachable = false, $urlparams = false)
	{
		
		require_once JPATH_COMPONENT.'/helpers/reviews.php';


		$view   = $this->input->get('view', 'catalogue');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');
		
		// Check for edit form.
		if ($view == 'review' && $layout == 'edit' && !$this->checkEditId('com_reviews.edit.review', $id))
		{
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_reviews&view=reviews', false));

			return false;
		}
		
		parent::display();

		return $this;
	}
}
