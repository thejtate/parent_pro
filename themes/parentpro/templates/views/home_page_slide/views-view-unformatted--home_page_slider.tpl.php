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
<div class="slider">
  <ul class="slides">
    <?php foreach ($rows as $id => $row): ?>
      <li class="slide-<?php print $id + 1; ?>">
        <?php print $row; ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>