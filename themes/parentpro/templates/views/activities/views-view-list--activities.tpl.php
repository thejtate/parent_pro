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

<div class="col-item">
    <?php if (!empty($title)) : ?>
      <?php print $title; ?>
    <?php endif; ?>

  <div class="item-bd">
    <div class="col-inner">
      <ul class="col-list">
      <?php foreach ($rows as $id => $row): ?>
        <li
          class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
      <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>