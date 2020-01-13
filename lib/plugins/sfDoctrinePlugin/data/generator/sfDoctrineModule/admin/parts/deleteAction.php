  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($this->getRoute()->getObject()->delete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    } else {
      $this->getUser()->setFlash('error', 'Cannot delete because it has associated records');
    }

    $this->redirect($this->generateUrl('<?php echo $this->getUrlForAction('list') ?>', array('related_module' => $request->getParameter('related_module'))));
  }
