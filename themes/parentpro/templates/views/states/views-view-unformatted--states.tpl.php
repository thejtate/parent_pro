<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php foreach ($rows as $id => $row): ?>
<div class="col col-<?php print $id; ?>">
  <?php if (!empty($title)): ?>
    <div class="col-hd">
      <?php print $title; ?>
    </div>
  <?php endif; ?>
    <?php print $row; ?>
</div>
<?php endforeach; ?>
