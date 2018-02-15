<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>
<div class="<?php print $classes; ?>">

  <div class="content-title">
    <div class="content-title-inner">
      <h1><?php print t("Calendar");?></h1>
      <?php print (isset($month_link)) ? $month_link : ""; ?>
      <?php print (isset($location_link)) ? $location_link : ""; ?>
    </div>
  </div>
  <div class="month-list">
    <ul class="col-list">
      <?php foreach ($month_list as $month_link): ?>
        <li><?php print $month_link; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="locations-list">
    <ul class="col-list">
      <?php foreach ($location_list as $location_link): ?>
        <li><?php print $location_link; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="content-inner">


    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <?php print $title; ?>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if ($header): ?>
      <div class="view-header">
        <?php print $header; ?>
      </div>
    <?php endif; ?>

    <?php if ($exposed): ?>
      <div class="view-filters">
        <?php print $exposed; ?>
      </div>
    <?php endif; ?>

    <?php if ($attachment_before): ?>
      <div class="attachment attachment-before">
        <?php print $attachment_before; ?>
      </div>
    <?php endif; ?>
    <div class="view-content block-2">
    <?php if (isset($month_name)): ?>
    <h4><?php print $month_name; ?></h4>
    <?php endif; ?>

    <?php if ($rows): ?>

        <?php print $rows; ?>

    <?php elseif ($empty): ?>
      <div class="view-empty">
        <?php print $empty; ?>
      </div>
    <?php endif; ?>
    </div>

    <?php if ($pager): ?>
      <?php print $pager; ?>
    <?php endif; ?>

    <?php if ($attachment_after): ?>
      <div class="attachment attachment-after">
        <?php print $attachment_after; ?>
      </div>
    <?php endif; ?>

    <?php if ($more): ?>
      <?php print $more; ?>
    <?php endif; ?>

    <?php if ($footer): ?>
      <div class="view-footer">
        <?php print $footer; ?>
      </div>
    <?php endif; ?>

    <?php if ($feed_icon): ?>
      <div class="feed-icon">
        <?php print $feed_icon; ?>
      </div>
    <?php endif; ?>
  </div>
</div><?php /* class view */ ?>
