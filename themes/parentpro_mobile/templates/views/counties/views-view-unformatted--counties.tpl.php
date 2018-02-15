<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */

?>
<div class="tab-item">
  <?php foreach ($rows as $id => $row): ?>
    <div class="content-item">
      <?php print $row; ?>
    </div>
  <?php endforeach; ?>
</div>
