[?php if ($value): ?]
  [?php echo '<span class ="green_state">' . __('Active', array(), 'messages') . '</span>'; ?]
[?php else: ?]
  [?php echo '<span class ="red_state">' . __('Inactive', array(), 'messages') . '</span>'; ?]
[?php endif; ?]
