<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<script type="text/javascript">
  var axel = Math.random() + "";
  var a = axel * 10000000000000;
  document.write('<iframe src="https://3002430.fls.doubleclick.net/activityi;src=3002430;type=oklah0;cat=osdh-00;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
</script>
<noscript>
  <iframe src="https://3002430.fls.doubleclick.net/activityi;src=3002430;type=oklah0;cat=osdh-00;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
</noscript>
<div class="outer-wrapper">

  <header id="header" class="header">
    <div class="img-decor">
      <?php print theme('image', array('path' => path_to_theme() . '/images/bg/img-decor.jpg')); ?>
    </div>

    <div class="header-top">
      <div class="logo">
        <?php if ($logo): ?>
          <?php print l(theme('image', array('path' =>  $logo)), '<front>', array('html' => TRUE)); ?>
        <?php endif; ?>
      </div>
      <?php if (!empty($social_block)): ?>
        <div class="social-menu-wrap">
          <?php print $social_block; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="header-inner">
      <?php if ($main_menu): ?>
        <nav class="nav">
          <?php print theme('links__system_main_menu', array(
            'links' => $main_menu,
            'attributes' => array('id' => 'main-menu', 'class' => array('')),
            'heading' => t('')
          )); ?>
        </nav>
      <?php endif; ?>
      <?php print render($page['header']); ?>

    </div>
  </header>
  <div class="inner-wrapper">

    <?php print $messages; ?>

    <div class="content-wrapper">

        <!--      --><?php //print render($title_prefix); ?>
        <!--      --><?php //if ($title): ?><!--<h1 class="title"-->
        <!--                               id="page-title">--><?php //print $title; ?><!--</h1>--><?php //endif; ?>
        <!--      --><?php //print render($title_suffix); ?>
        <?php if ($tabs): ?>
          <div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
        <?php print render($page['content']); ?>
        <!-- /.section, /#content -->
      <div class="cols cols-two style-a">
        <?php if ($page['column_left']): ?>
          <div class="col col-1">
            <?php print render($page['column_left']); ?>
          </div> <!-- /.section, /#sidebar-first -->
        <?php endif; ?>

        <?php if ($page['column_right']): ?>
          <div class="col col-2">
            <?php print render($page['column_right']); ?>
          </div> <!-- /.section, /#sidebar-second -->
        <?php endif; ?>

      </div>
    </div>
  </div>
  <!-- /#main, /#main-wrapper -->
  <footer id="footer" class="footer">
    <div class="img-decor">
      <?php print theme('image', array('path' => path_to_theme() . '/images/bg/img-decor.jpg')); ?>
    </div>
    <div class="footer-inner">
      <div
        class="item"> <?php print theme('image', array('path' => path_to_theme() . '/images/tmp/logo-1.png')); ?></div>
      <div
        class="item"> <?php print theme('image', array('path' => path_to_theme() . '/images/tmp/logo-2.png')); ?></div>
      <?php print render($page['footer']); ?>
    </div>
  </footer>
  <!-- /.section, /#footer -->

</div> <!-- /#page, /#page-wrapper -->
