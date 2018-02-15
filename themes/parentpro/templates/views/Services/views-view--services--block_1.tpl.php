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

<div class="map-wrapper map-wrapper-services <?php print $classes; ?>">
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
    <div class="desc">
      <?php print $rows; ?>
    </div>
    <div class="map">
      <p class="map-r-title"><?php print t('Select your region:'); ?></p>
      <img class="map-img" src="/<?php print path_to_theme() . '/images/tmp/map-2.png'; ?>" alt="" usemap="#map"/>
      <map name="map">
        <area data-for-desc="0" class="active" href="#" alt="" data-maphilight='{"fillColor":"4d8070"}'
              shape="poly"
              coords="498, 248, 498, 117, 482, 122, 462, 112, 452, 122, 436, 125, 423, 133, 407, 134, 398, 145, 400, 165, 380, 167, 382, 173, 372, 171, 373, 190, 381, 190, 381, 208, 373, 215, 373, 232, 384, 243, 395, 236, 399, 230, 413, 235, 425, 224, 436, 236, 453, 225, 459, 234, 475, 244, 486, 249">
        <area data-for-desc="1" href="#" alt="" data-maphilight='{"fillColor":"68ad45"}' shape="poly"
              coords="487, 0, 489, 48, 498, 104, 498, 117, 486, 124, 481, 122, 461, 111, 454, 124, 437, 125, 426, 132, 410, 135, 406, 121, 401, 120, 402, 106, 396, 107, 395, 98, 369, 100, 369, 62, 358, 62, 358, 58, 350, 53, 342, 45, 348, 33, 342, 28, 342, 21, 353, 20, 360, 15, 365, 0">
        <area data-for-desc="2" href="#" alt="" data-maphilight='{"fillColor":"ad4556"}' shape="poly"
              coords="167, 180, 165, 84, 177, 80, 189, 87, 192, 85, 201, 78, 205, 91, 248, 91, 251, 109, 269, 107, 269, 124, 278, 124, 280, 172, 289, 177, 302, 173, 313, 172, 313, 228, 306, 226, 300, 236, 292, 235, 281, 217, 278, 213, 269, 211, 263, 217, 257, 218, 249, 210, 241, 214, 231, 210, 219, 210, 216, 199, 208, 191, 203, 195, 196, 191, 186, 196">
        <area data-for-desc="3" href="#" alt="" data-maphilight='{"fillColor":"ad6c2b"}' shape="poly"
              coords="339, 248, 339, 233, 346, 231, 347, 224, 353, 225, 358, 236, 370, 231, 374, 214, 382, 208, 382, 191, 375, 190, 375, 173, 382, 171, 382, 167, 382, 155, 374, 155, 361, 157, 355, 152, 351, 158, 307, 158, 307, 169, 313, 171, 313, 227, 321, 235, 332, 229">
        <area data-for-desc="4" href="#" alt="" data-maphilight='{"fillColor":"923f8c"}' shape="poly"
              coords="369, 100, 394, 101, 396, 108, 401, 107, 401, 121, 406, 120, 408, 134, 401, 142, 401, 165, 383, 166, 382, 153, 375, 155, 360, 156, 355, 152, 352, 159, 307, 159, 307, 170, 301, 171, 288, 177, 281, 171, 278, 123, 269, 123, 268, 105, 269, 94, 305, 92, 307, 63, 340, 63, 337, 57, 349, 58, 350, 54, 357, 58, 357, 63, 368, 64">
        <area data-for-desc="5" href="#" alt="" data-maphilight='{"fillColor":"7c7cb3"}' shape="poly"
              coords="-1, 1, 361, 1, 359, 15, 353, 20, 341, 22, 340, 28, 348, 33, 342, 43, 343, 50, 350, 52, 350, 56, 338, 58, 338, 62, 307, 64, 305, 92, 270, 94, 268, 107, 251, 107, 249, 91, 205, 90, 201, 78, 194, 85, 188, 86, 178, 79, 166, 83, 165, 42, -1, 42">
      </map>

      <?php if ($footer): ?>
        <div class="view-footer">
          <?php print $footer; ?>
        </div>
      <?php endif; ?>

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



  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div><?php /* class view */ ?>
