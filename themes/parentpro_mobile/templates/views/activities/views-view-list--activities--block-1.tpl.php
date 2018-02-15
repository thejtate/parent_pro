<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */

?>

<li class="accordion-item">
  <?php if (!empty($title)) : ?>
    <?php print $title; ?>
  <?php endif; ?>
  <div class="accordion-content">
    <ul>
      <?php foreach ($rows as $id => $row): ?>
        <li><?php print $row; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</li>
