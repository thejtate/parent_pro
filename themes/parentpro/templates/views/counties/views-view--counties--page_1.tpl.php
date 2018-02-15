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
$path = base_path() . path_to_theme();
?>
<div class="content-top">
  <div class="content-top-inner">
    <h1><?php print $region_title; ?></h1>

    <div class="navigation">
      <?php print render($map_header); ?>
        <?php print render($map); ?>
    </div>
  </div>
</div>
<div class="content-inner <?php print $classes; ?>">
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
    <div class="content-bottom">
        <h3>You have several ways to get connected to services:</h3>
        <div class="item">
          <div class="img">
            <img src="<?php print $path;?>/images/tmp/form-a-item-1.png" alt="">
          </div>
          <div class="text">
            <p>
              You can look through the services listed below and call the agencies directly.
            </p>
          </div>
        </div>
        <div class="item">
          <div class="img">
            <img src="<?php print $path;?>/images/tmp/form-a-item-2.png" alt="">
          </div>
          <div class="text">
            <p>
              You can contact us via <a href="mailto:parentpro@health.ok.gove">e-mail</a> or by phone at <strong>1-877-271-7611</strong>, and a
              representative will help
              you find the services that will best serve you and your family.
            </p>
          </div>
        </div>
        <div class="item">
          <div class="img">
            <img src="<?php print $path;?>/images/tmp/form-a-item-3.png" alt="">
          </div>
          <div class="text">
            <?php if(!empty($form_link)): ?>
              <p>
                You can answer a short questionaire by <?php print $form_link;?> and a parentPRO representative will find
                the services that will best serve you and your family.
              </p>
            <?php endif; ?>
          </div>
        </div>
    <div class="cols cols-two style-c">
      <?php print $rows; ?>
    </div>
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
