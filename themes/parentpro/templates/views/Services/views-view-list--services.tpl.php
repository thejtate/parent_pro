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
<div data-maphilight-desc="<?php print $id-1; ?>" class="desc-item" data-term-link="/service/<?php print $title; ?>">
  <?php if (!empty($title)) : ?>
    <h4><?php print $title; ?></h4>
    <p class="map-c-title"><?php print t('Now choose your county:'); ?></p>
  <?php endif; ?>
  <?php print $list_type_prefix; ?>
    <?php foreach ($rows as $id => $row): ?>
      <li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
    <?php endforeach; ?>
  <?php print $list_type_suffix; ?>
<?php print $wrapper_suffix; ?>
