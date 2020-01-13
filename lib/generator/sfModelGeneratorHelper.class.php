<?php

/**
 * Model generator helper.
 *
 * @package    symfony
 * @subpackage generator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
abstract class sfModelGeneratorHelper
{
  abstract public function getUrlForAction($action);

  public function linkToNew($params)
  {
    return '<li class="sf_admin_action_new">'.link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('new')).'</li>';
  }

  public function linkToEdit($object, $params)
  {
    return '<li class="sf_admin_action_edit">'.link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('edit'), $object).'</li>';
  }

  /**
   * @param Persistent|mixed $object
   * @param array $params
   * @return string
   */
  public function linkToDelete($object, $params)
  {
    if ($object->isNew())
    {
      return '';
    }
    // CSRF protection
    $form = new BaseForm();
    return sprintf(
      '<li class="sf_admin_action_none">%s<input id="csrf_token_delete" type="hidden" name="%s" value="%s"/></li>',
      link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete'), $object, array(
        'class' => 'tq_self_none tq_delete tq_confirm btn btn-danger btn-sm',
        'title' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm']
      )),
      $form->getCSRFFieldName(),
      $form->getCSRFToken()
    );
  }

  /**
   * This function generate a link (this item is a HTML's element) to "list" register interface.
   * @param  array  $params
   * @return string
   */
  public function linkToList($params)
  {
    return '<li class="sf_admin_action_none">'.link_to(__('Back to list', array(), 'sf_admin'), '@'.$this->getUrlForAction('list'), array('class' => 'tq_self_none btn btn-default btn-sm')).'</li>';
  }

  /**
   * This function generate a link (this item is a HTML's element) to "save" register interface.
   * @param  array  $params
   * @return string
   */
  public function linkToSave($object, $params)
  {
    return '<li class=""><input class="btn btn-primary btn-sm" type="submit" value="'.__($params['label'], array(), 'sf_admin').'" /></li>';
  }

  /**
   * This function generate a link (this item is a HTML's element) to "save and add" register interface.
   * @param array $params
   * @return string
   */
  public function linkToSaveAndAdd($object, $params)
  {
    if (!$object->isNew())
    {
      return '';
    }

    return '<li class=""><input class="btn btn-primary btn-sm" type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="_save_and_add" /></li>';
  }
}
