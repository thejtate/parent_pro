<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<div class="col col-<?php print $id; ?>">
  <?php if (!empty($title)): ?>
    <div class="col-hd">
      <?php print $title; ?>
    </div>
  <?php endif; ?>


  <?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
  <?php endforeach; ?>
</div>
