<?php defined('_JEXEC') or die;

JLoader::register('ReviewsHelper', JPATH_COMPONENT.'/helpers/reviews.php');

class ReviewsViewReviews extends JViewLegacy
{
    
   	protected $items;
	protected $pagination;
	protected $state;

	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		ReviewsHelper::addSubmenu('reviews');

		$this->addToolbar();
		

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		require_once JPATH_COMPONENT . '/helpers/reviews.php';
		
		$canDo = ReviewsHelper::getActions($this->state->get('filter.review_id'));

		$bar = JToolBar::getInstance('toolbar');
		
		JToolbarHelper::title(JText::_('COM_REVIEWS_MANAGER'), 'component.png');
		if ($canDo->get('core.create'))
		{
			JToolbarHelper::addNew('review.add');
		}

		if (($canDo->get('core.edit')))
		{
			JToolbarHelper::editList('review.edit');
		}

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_reviews');
		}
		
		if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'reviews.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('reviews.trash');
		}
		
		JHtmlSidebar::setAction('index.php?option=com_reviews&view=reviews');

		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true)
		);
	}

	protected function getSortFields()
	{
		return array(
			'rws.fio' => JText::_('COM_REVIEWS_FIO_LABEL'),
			'rws.date' => JText::_('COM_REVIEWS_DATE_LABEL'),
			'rws.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'rws.published' => JText::_('JSTATUS'),
			'rws.id' => JText::_('JGRID_HEADING_ID')
		);
	}
}
