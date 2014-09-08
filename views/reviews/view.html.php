<?php defined('_JEXEC') or die;

class ReviewsViewReviews extends JViewLegacy
{
	protected $items;
	protected $state;
	protected $form;

	public function display($tpl = null)
	{
		$model = JModelLegacy::getInstance('Send', 'ReviewsModel', array('ignore_request' => true));
		$this->form = $model->getForm();
		
		$this->items = $this->get('Items');

		$this->assignRef('items', $this->items);
		$this->assignRef('form', $this->form);
		
		parent::display($tpl);
	}
}