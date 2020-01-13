[?php slot('filter') ?]
  <form class="sf_admin_filter_form form-horizontal"
        action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter')) ?]"
        method="post">
    <div class="sf_admin_filter_title modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="ion ion-ios-close-empty"></i>
      </button>
      <h3 class="modal-title">[?php echo __('Filters', array(), 'messages') ?]</h3>
    </div>
    <div class="modal-body">
      <table class="table no-border">
      <tbody>
        [?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?]
        [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
          [?php include_partial('<?php echo $this->getModuleName() ?>/filters_field', array(
            'name'       => $name,
            'attributes' => $field->getConfig('attributes', array()),
            'label'      => $field->getConfig('label'),
            'help'       => $field->getConfig('help'),
            'form'       => $form,
            'field'      => $field,
            'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
          )) ?]
        [?php endforeach; ?]
      </tbody>
    </table>
    </div>
    <div class="modal-footer">
      <input type="submit" value="[?php echo __('Filter', array(), 'sf_admin') ?]" class="btn btn-primary btn-sm"/>
      [?php echo link_to(__('Reset', array(), 'sf_admin'), '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter'), array('query_string' => '_reset', 'class' => 'btn-filter-reset btn btn-default btn-sm')) ?]
      [?php echo $form->renderHiddenFields() ?]
    </div>
  </form>
[?php end_slot() ?]

[?php if (has_slot('filter') && $sf_request->isXmlHttpRequest()): ?]
  <textarea id="content-filter-slot" style="display:none;">
    [?php include_slot('filter') ?]
  </textarea>
[?php endif ?]
