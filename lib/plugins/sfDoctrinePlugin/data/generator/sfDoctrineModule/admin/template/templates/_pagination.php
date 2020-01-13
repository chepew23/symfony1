<ul class="pagination pagination-sm no-margin pull-right">
  [?php $isFirstPage = $pager->isFirstPage() ?]
  <li[?php echo $isFirstPage ? ' class="disabled"' : '' ?]>
    <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') . '?page=1' ?]"
       title="[?php echo __('First page', array(), 'sf_admin') ?]"
       class="[?php echo $isFirstPage ? 'tq_self_more' : 'tq_self_none' ?]">&laquo;</a>
  </li>
  <li[?php echo $isFirstPage ? ' class="disabled"' : '' ?]>
    <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') . '?page=' . $pager->getPreviousPage() ?]"
       title="[?php echo __('Previous page', array(), 'sf_admin') ?]"
       class="[?php echo $isFirstPage ? 'tq_self_more' : 'tq_self_none' ?]">&lsaquo;</a>
  </li>

  [?php foreach ($pager->getLinks() as $page): ?]
    [?php $isActive = ($page == $pager->getPage()) ?]
  <li[?php echo $isActive ? ' class="active"' : '' ?]>
    <a href="[?php echo $isActive ? '#' : url_for('@<?php echo $this->getUrlForAction('list') ?>') . '?page=' . $page ?]"
       class="tq_self_none">
      [?php echo $page ?]
  </a>
  </li>
  [?php endforeach; ?]

  [?php $isLastPage = $pager->isLastPage() ?]
  <li[?php echo $isLastPage ? ' class="disabled tq_self_more"' : '' ?]>
    <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') . '?page=' . $pager->getNextPage() ?]"
       title="[?php echo __('Next page', array(), 'sf_admin') ?]"
       class="[?php echo $isLastPage ? 'tq_self_more' : 'tq_self_none' ?]">&rsaquo;</a>
  </li>
  <li[?php echo $isLastPage ? ' class="disabled tq_self_more"' : '' ?]>
    <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') . '?page=' . $pager->getLastPage() ?]"
       title="[?php echo __('Last page', array(), 'sf_admin') ?]"
       class="[?php echo $isLastPage ? 'tq_self_more' : 'tq_self_none' ?]">&raquo;</a>
  </li>
</ul>
