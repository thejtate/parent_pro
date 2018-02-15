<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php //if (!empty($title)): ?>
<!--  <h4>--><?php //print $title; ?><!--</h4>-->
<?php //endif; ?>
<div class="content-item">
<?php foreach ($rows as $id => $row): ?>
  <div<?php if ($classes_array[$id]) {
    print ' class="' . $classes_array[$id] . '"';
  } ?>>
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
</div>
