<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<div class="cols cols-three style-a">
  <?php foreach ($rows as $id => $row): ?>
    <div class="col col-<?php print $id + 1; ?>">
      <?php print $row; ?>
    </div>
  <?php endforeach; ?>
</div>

