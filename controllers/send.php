<?php
defined('_JEXEC') or die;

class ReviewsControllerSend extends JControllerForm
{
    
    public function save()
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        $app = JFactory::getApplication();
        
        $mailfrom   = $app->getCfg('mailfrom');
        $fromname   = $app->getCfg('fromname');
        
        $params = $app->getParams();
        $manager_email = $params->get('reviewsemail');
        
        $data = $this->input->get('jform', array(), 'post', 'array');
        $model = $this->getModel();
        $form = $model->getForm();
        
        if ($save_id = $model->save($data))
        {
            $mail = JFactory::getMailer();
            $mail->addRecipient($manager_email);
            $mail->setSender(array($mailfrom, $fromname));
            $mail->setSubject('Новый отзыв на сайте');
            
            $body = 'Новый отзыв'."\n\n";
            $body .= "ФИО: ".$data['fio']."\n\n";
            $body .= "Организация: ".$data['organization']."\n\n";
            $body .= "Текст отзыва:\n";
            $body .= $data['text']."\n\n";
            $body .= "Рейтинг: ".$data['rate']."\n\n";
            
            $body .= 'Чтобы опубликовать отзыв перейдите по ссылке:'."\n";
            $body .= JURI::base().'/index.php?option=com_reviews&task=send.publish&id='.$save_id;
            
            $mail->setBody($body);
            $sent = $mail->Send();
            
            $menu = $app->getMenu();
            $page_redirect = $menu->getItem($params->get('review_form_redirect'))->route;
            if ($sent) $app->redirect($page_redirect, '');
        }
    }
    
    public function publish()
    {
        $id = $this->input->get('id');
        $model = $this->getModel();
        $row = $model->getItem($id);
        $publish_data = array('id' => $row->id, 'published' => 1);
        $model->save($publish_data);
        
         $this->setRedirect(JRoute::_('index.php?option=com_reviews'), 'Отзыв опубликован!');
    }
    

}