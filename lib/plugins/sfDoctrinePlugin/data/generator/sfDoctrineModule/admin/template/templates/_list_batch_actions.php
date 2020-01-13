<?php if ($listActions = $this->configuration->getValue('list.batch_actions')): ?>
<li class="sf_admin_batch_actions_choice form-group">
  <select name="batch_action" class="form-control input-sm">
    <option value="">[?php echo __('Choose an action', array(), 'sf_admin') ?]</option>
<?php foreach ((array) $listActions as $action => $params): ?>
    <?php echo $this->addCredentialCondition('<option value="'.$action.'">[?php echo __(\''.$params['label'].'\', array(), \'sf_admin\') ?]</option>', $params) ?>

<?php endforeach; ?>
  </select>
  [?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?]
    <input type="hidden" name="[?php echo $form->getCSRFFieldName() ?]" value="[?php echo $form->getCSRFToken() ?]" />
  [?php endif; ?]

  <?php if(sfConfig::get('app_batch_actions_needs_confirm')): ?>
  <input class="submit btn btn-primary btn-sm" type="button" onClick=
      "if(confirm('Está seguro?')==true)
      this.form.submit();else return false;" value="[?php echo __('go', array(), 'sf_admin') ?]" />
  <?php else: ?>
  <input type="submit" value="[?php echo __('go', array(), 'sf_admin') ?]" class="btn btn-primary btn-sm" />
  <?php endif; ?>

</li>
<?php endif; ?>
