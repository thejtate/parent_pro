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

<div class="map-wrapper <?php print $classes; ?>">
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

  <?php if ($rows): ?>
    <div class="notes">Select a region on the map to find services available in your area. Tap above to view state-wide services.</div>
    <div class="map">
      <img class="map-img" src="<?php print base_path() . path_to_theme() . '/images/tmp/map-s.png'; ?>" alt="" usemap="#map"/>
      <map name="map">
        <area data-for-desc="0" href="#" alt="" data-maphilight='{"fillColor":"4d8070"}'
              shape="poly"
              coords="293,82,285,89,267,77,261,87,249,89,225,96,223,113,212,115,206,122,204,133,212,138,209,149,202,162,213,169,222,163,234,163,243,163,262,162,289,176">
        <area data-for-desc="1" href="#" alt="" data-maphilight='{"fillColor":"68ad45"}' shape="poly"
              coords="197,0,196,11,181,17,188,23,183,31,189,41,199,47,201,70,220,73,227,83,229,95,243,90,259,86,265,77,283,89,294,84,284,31,284,1">
        <area data-for-desc="2" href="#" alt="" data-maphilight='{"fillColor":"ad4556"}' shape="poly"
              coords="58,61,65,54,75,63,82,52,84,63,117,63,117,78,130,77,130,87,138,88,137,121,147,123,162,120,162,160,151,165,142,158,137,147,129,150,124,153,117,145,112,150,103,143,94,147,94,134,86,131,84,134,74,136,65,126,56,127">
        <area data-for-desc="3" href="#" alt="" data-maphilight='{"fillColor":"ad6c2b"}' shape="poly"
              coords="158,110,187,111,193,106,210,110,210,117,205,122,205,132,213,144,205,152,203,160,196,164,186,157,181,173,175,161,168,165,161,160,160,124">
        <area data-for-desc="4" class="active" href="#" alt="" data-maphilight='{"fillColor":"923f8c"}' shape="poly"
              coords="157,45,176,44,193,40,202,43,200,71,221,71,225,81,230,92,224,106,225,115,212,117,211,109,195,108,190,112,162,112,160,120,138,121,139,87,131,87,132,67,157,68">
        <area data-for-desc="5" href="#" alt="" data-maphilight='{"fillColor":"7c7cb3"}' shape="poly"
              coords="0,28,0,0,198,0,196,12,183,18,187,23,185,30,190,39,182,42,159,45,156,65,134,67,131,75,119,77,117,63,86,63,81,54,75,62,67,55,58,63,58,30">
      </map>
    </div>
    <div class="desc">
      <?php print $rows; ?>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

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

</div><?php /* class view */ ?>
