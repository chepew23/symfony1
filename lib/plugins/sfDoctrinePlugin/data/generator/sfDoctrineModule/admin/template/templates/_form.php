[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]
<script>
  $(function() {
    var getFCWords = function  (str) {
      var rcTmp = str.split(' '),
          nuCont = rcTmp.length,
          result = '';
      for (var i=0; i<nuCont; i++) {
        result += rcTmp[i].substr(0, 1);
      }
      return result.toUpperCase();
    };
    $('input[id*=name]').keyup(function() {
      $('input[id*=abbr]').attr({'value': getFCWords($('input[id*=name]').attr('value'))});
    });
  });
</script>
<div class="sf_admin_form col-sm-12">
  [?php echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>', array('class' => 'form-horizontal')) ?]
    [?php echo $form->renderHiddenFields(false) ?]

    [?php if ($form->hasGlobalErrors()): ?]
      [?php echo $form->renderGlobalErrors() ?]
    [?php endif; ?]

    [?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?]
    [?php endforeach; ?]

    [?php include_partial('<?php echo $this->getModuleName() ?>/form_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
  </form>
</div>
