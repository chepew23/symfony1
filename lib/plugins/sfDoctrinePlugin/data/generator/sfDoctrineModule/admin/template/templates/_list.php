<div class="sf_admin_list table-responsive">
  [?php if (!$pager->getNbResults()): ?]
    <div class="alert-msg-empty col-sm-12">
      <div class="alert-msg-cloud col-sm-12">
        <p>[?php echo __('You don\'t have entries!', array(), 'messages') ?]</p>
      </div>
      <div class="alert-msg-character col-sm-12">
        <img class="img-responsive"
             src="/plugins/darumacore/img/[?php echo sfConfig::get('app_product', 'ds') ?]-alert-character.png"
             alt="Product character">
      </div>
      <div class="alert-msg-footer col-sm-12">
        <p>[?php echo __('Lets begin creating a new one', array(), 'messages') ?]</p>
      </div>
    </div>
  [?php else: ?]
    <table class="table" cellspacing="0">
      <thead>
        <tr>
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" class="check_head_input" type="checkbox"/></th>
<?php endif; ?>
          [?php include_partial('<?php echo $this->getModuleName() ?>/list_th_<?php echo $this->configuration->getValue('list.layout') ?>', array('sort' => $sort)) ?]
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="<?php echo count($this->configuration->getValue('list.display')) + ($this->configuration->getValue('list.object_actions') ? 1 : 0) + ($this->configuration->getValue('list.batch_actions') ? 1 : 0) ?>">
            [?php if ($pager->haveToPaginate()): ?]
            <div class="pagination-info pull-left">
              [?php echo __('%first_indice%-%last_indice% of %total% records (p. %page%/%last_page%)', array(
                '%first_indice%' => $pager->getFirstIndice(),
                '%last_indice%' => $pager->getLastIndice(),
                '%page%' => $pager->getPage(),
                '%last_page%' => $pager->getLastPage(),
                '%total%' => $pager->getNbResults()), 'messages') ?]
            </div>
            [?php endif; ?]

            [?php if ($pager->haveToPaginate()): ?]
              [?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('pager' => $pager)) ?]
            [?php endif; ?]
          </td>
        </tr>
      </tfoot>
      <tbody>
        [?php foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?]
          <tr class="sf_admin_row [?php echo $odd ?]">
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_batch_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
<?php endif; ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_<?php echo $this->configuration->getValue('list.layout') ?>', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
<?php if ($this->configuration->getValue('list.object_actions')): ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
<?php endif; ?>
          </tr>
        [?php endforeach; ?]
      </tbody>
    </table>
  [?php endif; ?]
</div>
