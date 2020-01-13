  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this-><?php echo $this->getSingularName() ?> = $this->form->getObject();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');

    $this->getContext()->getConfiguration()->loadHelpers(array('I18N'), $this->getModuleName());
    prestaBreadcrumb::getInstance()->setRoot(sfInflector::humanize($this->getModuleName()), '@<?php echo $this->getUrlForAction('list') ?>');
    prestaBreadcrumb::getInstance()->addItem(<?php echo $this->getI18NString('new.title') ?>, '@<?php echo $this->getUrlForAction('new') ?>', true);
  }
