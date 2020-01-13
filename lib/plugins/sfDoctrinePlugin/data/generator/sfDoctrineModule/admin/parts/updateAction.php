  public function executeUpdate(sfWebRequest $request)
  {
    $<?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();
    $this-><?php echo $this->getSingularName() ?> = $<?php echo $this->getSingularName() ?>;
    $this->form = $this->configuration->getForm($this-><?php echo $this->getSingularName() ?>);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');

    $this->getContext()->getConfiguration()->loadHelpers(array('I18N'), $this->getModuleName());
    prestaBreadcrumb::getInstance()->setRoot(sfInflector::humanize($this->getModuleName()), '@<?php echo $this->getUrlForAction('list') ?>');
    prestaBreadcrumb::getInstance()->addItem(<?php echo $this->getI18NString('edit.title') ?>, '@<?php echo $this->getUrlForAction('edit') ?>', true);
  }
