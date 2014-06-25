<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_reviews
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('ReviewsHelper', JPATH_COMPONENT.'/helpers/reviews.php');

/**
 * View to edit a banner.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 * @since       1.5
 */
class ReviewsViewReview extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		
		// Initialiase variables.
		$this->form	= $this->get('Form');
		$this->item	= $this->get('Item');
		$this->state = $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		// Since we don't track these assets at the item level, use the category id.
		$canDo		= ReviewsHelper::getActions($this->item->id, 0);

		JToolbarHelper::title($isNew ? JText::_('COM_REVIEWS_MANAGER_REVIEW_NEW') : JText::_('COM_REVIEWS_MANAGER_REVIEW_EDIT'));

		// If not checked out, can save the item.
		if ($canDo->get('core.edit')){
			JToolbarHelper::apply('review.apply');
			JToolbarHelper::save('review.save');

			if ($canDo->get('core.create')) {
				JToolbarHelper::save2new('review.save2new');
			}
		}

		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')) {
			JToolbarHelper::save2copy('review.save2copy');
		}

		if (empty($this->item->id))  {
			JToolbarHelper::cancel('review.cancel');
		}
		else {
			JToolbarHelper::cancel('review.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolbarHelper::divider();
	}
}
