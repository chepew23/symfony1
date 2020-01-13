  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    if (!$ids = $request->getParameter('ids'))
    {
      $this->getUser()->setFlash('error', 'You must at least select one item.');

      $this->redirect($this->generateUrl('<?php echo $this->getUrlForAction('list') ?>', array('related_module' => $request->getParameter('related_module'))));
    }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

      $this->redirect($this->generateUrl('<?php echo $this->getUrlForAction('list') ?>', array('related_module' => $request->getParameter('related_module'))));
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => '<?php echo $this->getModelClass() ?>'));
    try
    {
      // validate ids
      $ids = explode("_", $ids);
      $ids = $validator->clean($ids);

      // execute batch
      $request->setParameter('ids', $ids);
      $this->$method($request);
    }
    catch (sfValidatorError $e)
    {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items as some items do not exist anymore.');
    }

    $this->redirect($this->generateUrl('<?php echo $this->getUrlForAction('list') ?>', array('related_module' => $request->getParameter('related_module'))));
  }

  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $records = Doctrine_Query::create()
      ->from('<?php echo $this->getModelClass() ?>')
      ->whereIn('<?php echo $this->getPrimaryKeys(true) ?>', $ids)
      ->execute();

    foreach ($records as $record) {
      if ($record->delete()) {
    $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
      } else {
        $this->getUser()->setFlash('error', 'Cannot delete because it has associated records');
      }
    }

    $this->redirect($this->generateUrl('<?php echo $this->getUrlForAction('list') ?>', array('related_module' => $request->getParameter('related_module'))));
  }
