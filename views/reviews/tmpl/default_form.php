<?php defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
$form = $this->form;
$app = JFactory::getApplication();
$params = $app->getParams();
$show_name = $params->get('review_form_showname', 0);
$show_org = $params->get('review_form_showorg', 0);
$form_desc = $params->get('review_form_desc');
?>

<div class="form-bg yellow-box">
  <form id="reviewForm" class="form-validate mail-form review-form" action="index.php" method="post">
    <div class="form-lables">
      <div class="form-header">
        <h4>
          <?php echo $params->get('review_form_header', 'Оставьте свой отзыв'); ?>
        </h4>
      </div>

      <?php if(!empty($form_desc)): ?>
        <div class="form-desc">
          <p>
            <?php echo $form_desc; ?>
          </p>
        </div>
      <?php endif; ?>

      <?php if($show_name): ?>
        <div class="controlls">
          <input type="text" name="jform[fio]" id="jform_fio" value="" placeholder="Ваше имя" class="<?php if($show_name==2): ?>required<?php endif; ?>" <?php if($show_name==2): ?>required<?php endif; ?> aria-required="true">
        </div>
      <?php endif; ?>

      <?php if($show_org): ?>
        <div class="controlls">
          <input type="text" name="jform[organization]" id="organization" value="" placeholder="Наименование организации" class="<?php if($show_org==2): ?>required<?php endif; ?>" <?php if($show_org==2): ?>required<?php endif; ?> aria-required="true">
        </div>
      <?php endif; ?>

      <div class="controlls">
        <textarea name="jform[text]" class="required" placeholder="Ваш отзыв"></textarea>
      </div>
    </div>
    <div class="controlls">
      <span class="rating-head">Качество обслуживания:</span>
      <span class="star-rating">
        <input type="radio" name="jform[rate]" value="1"><i></i>
        <input type="radio" name="jform[rate]" value="2"><i></i>
        <input type="radio" name="jform[rate]" value="3"><i></i>
        <input type="radio" name="jform[rate]" value="4"><i></i>
        <input type="radio" name="jform[rate]" value="5"><i></i>
      </span>
    </div>
    <a href="#" id="reviewSend" class="jbtn" >Отправить отзыв</a>
    <input type="hidden" name="option" value="com_reviews" />
    <input type="hidden" name="task" value="send.save" />
    <?php echo JHtml::_('form.token'); ?>
  </form>
</div>