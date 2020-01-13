  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect($this->generateUrl('<?php echo $this->getUrlForAction('list') ?>', array('related_module' => $request->getParameter('related_module'))));
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect($this->generateUrl('<?php echo $this->getUrlForAction('list') ?>', array('related_module' => $request->getParameter('related_module'))));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');

    $this->getContext()->getConfiguration()->loadHelpers(array('I18N'), $this->getModuleName());
    prestaBreadcrumb::getInstance()->setRoot(sfInflector::humanize($this->getModuleName()), '@<?php echo $this->getUrlForAction('list') ?>');
    prestaBreadcrumb::getInstance()->addItem(<?php echo $this->getI18NString('list.title') ?>, '@<?php echo $this->getUrlForAction('list') ?>', true);
  }
