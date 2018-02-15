<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<div data-maphilight-desc="<?php print $id; ?>" class="desc-item">
<?php if (!empty($title)): ?>
  <h4><?php print $title; ?></h4>
  <p class="map-c-title"><?php print t('Now choose your county:'); ?></p>
<?php endif; ?>
  <?php foreach ($rows as $id => $row): ?>
      <?php print $row; ?>
  <?php endforeach; ?>
</div>
