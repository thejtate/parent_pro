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
<li>
  <?php if (!empty($title)) : ?>
    <div class="col-hd">
      <div class="col-inner">
        <?php print $title; ?>
      </div>
    </div>
  <?php endif; ?>

  <?php print $list_type_prefix; ?>
  <?php foreach ($rows as $id => $row): ?>
    <li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
  <?php endforeach; ?>
  <?php print $list_type_suffix; ?>

</li>