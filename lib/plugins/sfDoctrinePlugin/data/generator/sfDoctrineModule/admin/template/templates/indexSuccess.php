[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<?php $options_bar = array(); ?>
<?php $not_actions = array('disable') // actions to ignore ?>
<?php $actions = array(); ?>

<?php if ($this->configuration->getValue('list.actions')): ?>
  <?php $actions = array_merge($actions, $this->configuration->getValue('list.actions')) ?>
<?php endif; ?>

<?php if ($this->configuration->getValue('list.object_actions')): ?>
  <?php $actions = array_merge($actions, $this->configuration->getValue('list.object_actions')) ?>
<?php endif; ?>

<?php if ($this->configuration->getValue('list.batch_actions')): ?>
  <?php $actions = array_merge($actions, $this->configuration->getValue('list.batch_actions')) ?>
<?php endif; ?>

<?php foreach ($actions as $name => $params): ?>
  <?php if ('_new' == $name): ?>
    <?php $option_action = sprintf('%s/%s', $this->getModuleName(), $params['class_suffix']) ?>
    <?php $options_bar[] = array(
      'option_str' => 'new', 'anchor_class' => 'tq_self_none', 'option_action' => $option_action,
      'option_class' => 'option_new', 'option_permission' => null
    ); ?>
  <?php elseif (!in_array($name, $not_actions)): ?>
    <?php $option_str = $params['class_suffix'] ?>
    <?php $option_class = sprintf('option_%s', $option_str) ?>
    <?php $anchor_class = isset($params['anchor_class']) ? $params['anchor_class'] : 'tq_new_multiple' ?>
    <?php $parameter_id = 'id' ?>
    <?php $template_id = '_#id#_' ?>
    <?php $haystack_confirm = array('delete', 'disable') ?>
    <?php $action = $params['class_suffix'] ?>

    <?php if ($params['class_suffix'] == 'show'): ?>
      <?php $action = 'ListShow' ?>
    <?php endif; ?>

    <?php $option_action = sprintf('%s/%s?%s=%s', $this->getModuleName(), $action, $parameter_id, $template_id) ?>

    <?php if (in_array($params['class_suffix'], $haystack_confirm)): ?>
      <?php $anchor_class = 'tq_various_confirm_standar' ?>
    <?php endif; ?>

    <?php if (substr_count($name, 'batch') > 0): ?>
      <?php $template_id = '_#ids#_' ?>
      <?php $parameter_id = 'ids' ?>
      <?php $option_action = sprintf('%s/batch/action?batch_action=%s&%s=%s', $this->getModuleName(), $name,
        $parameter_id, $template_id) ?>
    <?php endif; ?>

    <?php if (isset($params['classic_action'])): ?>
      <?php $option_action = sprintf('%s/%s', $this->getModuleName(), $params['class_suffix']) ?>
      <?php $anchor_class = 'tq_self_none'; ?>
    <?php endif; ?>

    <?php $options_bar[] = array(
      'option_str' => $option_str, 'anchor_class' => $anchor_class, 'option_action' => $option_action,
      'option_class' => $option_class, 'option_permission' => null
    ); ?>
  <?php endif; ?>
<?php endforeach; ?>

[?php include_component('framework', 'titlebar', array('optionsbar' => <?php echo $this->asPhp($options_bar) ?>, 'title_str' => <?php echo $this->getI18NString('list.title') ?>, 'title_class' => '', 'title_module' => '', 'title_action' => '')) ?]

<div id="sf_admin_container" class="row">
  [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

  <div id="sf_admin_header">
    [?php include_partial('<?php echo $this->getModuleName() ?>/list_header', array('pager' => $pager)) ?]
  </div>

<?php if ($this->configuration->hasFilterForm()): ?>
  <div id="sf_admin_bar">
    [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration)) ?]
  </div>
<?php endif; ?>

  <div id="sf_admin_content" class="col-sm-12">
    [?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort,
    'helper' => $helper)) ?]
  </div>

  <div id="sf_admin_footer">
    [?php include_partial('<?php echo $this->getModuleName() ?>/list_footer', array('pager' => $pager)) ?]
  </div>
</div>
