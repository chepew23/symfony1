  public function executeEdit(sfWebRequest $request)
  {
    if (!$id = $request->getParameter('id')) {
      $this->getUser()->setFlash('error', 'You must at least select one item.');

      $this->redirect($this->generateUrl('<?php echo $this->getUrlForAction('list') ?>', array('related_module' => $request->getParameter('related_module'))));
    }


    $<?php echo $this->getSingularName() ?> = Doctrine_Query::create()
      ->from('<?php echo $this->getModelClass() ?>')
      ->whereIn('<?php echo $this->getPrimaryKeys(true) ?>', [$id])
      ->fetchOne();

    $this-><?php echo $this->getSingularName() ?> = $<?php echo $this->getSingularName() ?>;
    $this->form = $this->configuration->getForm($<?php echo $this->getSingularName() ?>);

    $this->getContext()->getConfiguration()->loadHelpers(array('I18N'), $this->getModuleName());
    prestaBreadcrumb::getInstance()->setRoot(sfInflector::humanize($this->getModuleName()), '@<?php echo $this->getUrlForAction('list') ?>');
    prestaBreadcrumb::getInstance()->addItem(<?php echo $this->getI18NString('edit.title') ?>, '@<?php echo $this->getUrlForAction('edit') ?>', true);
  }
