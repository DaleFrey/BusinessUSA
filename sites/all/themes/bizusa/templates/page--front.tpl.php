<div id="navigation">
  <div class="wrapper">
    <?php print render($page['navigation']) ?>
  </div>
</div>


<div class="helpArea">
  <ul id="helpButton">
    <li>
      <a href="#" class="helpToggle" >help</a>
      <ul>
        <li><a href="http://help.business.usa.gov/ics/support/ticketnewwizard.asp?style=classic&deptID=30030&" class="ask" >Ask a Question</a></li>
        <li><a href="http://help.businessusa.gov/ics/support/ticketnewwizard.asp?style=classic&feedback=true" class="feedback" >Give Feedback</a></li>
        <li><a href="javascript: // 1-800-333-4636" class="info" >1-800-FED-INFO</a></li>
        <li><a href="http://help.business.usa.gov/ics/support/kbsplash.asp?deptID=30030&task=knowledge" class="browse" >Browse Knowledgebase</a></li>
      </ul>
    </li>
  </ul>
</div>
<div class="wrapper">

  <?php /* if ( function_exists('randomDevNote') ) { print randomDevNote(); } */ ?>

  <div class="logoSearchWrapper">
    <h1 id="logo">
        <a class="busa-logo" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
            <?php print $site_name; ?>
        </a>
        <img class="export-divider" href="/export" src="/sites/all/themes/bizusa/images/logo-divider.png" alt="" />
        <a class="export-logo" href="/export" title="Link to the Exporter Dasbhoard">
            Export Dashboard
        </a>
    </h1>
    <?php print theme('sharewidget', array()); ?>
    <div class="searchWrapper">
      <form class="sitewide-logo-and-search" rendersource="page.tpl.php" action="javascript: document.location = '/search/site/' + jQuery('#sitewide-search-input').val();">
      <input autocomplete="off" type="text" id="sitewide-search-input" placeholder="Search BusinessUSA.Gov"/>
      <input type="submit" id="sitewide-search-button" value="Search" />
    </form>
      <div class="busa-autocomplete-responce-container">

      </div>
    </div>
  </div>



  <?php if ($site_slogan): ?>
    <h2 id="slogan"><?php print $site_slogan; ?></h2>
  <?php endif; ?>

  <?php if ($page['header']): ?>
    <?php print render($page['header']); ?>
  <?php endif; ?>

  <?php print $breadcrumb; ?>

  <?php if ($page['highlight']): ?>
    <?php print render($page['highlight']) ?>
  <?php endif; ?>
  
  <div id="contentArea">
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php print $messages; ?>
      <?php print render($page['help']); ?>

      <?php if ($tabs): ?>
        <?php print render($tabs); ?>
      <?php endif; ?>

      <?php if ($action_links): ?>
        <ul><?php print render($action_links); ?></ul>
      <?php endif; ?>
      
      <div class="myusa-loading-msg" style="display: none; overflow: hidden; clear: both; padding: 25px 15px; background-color: white;" rendersource="<?php print basename(__FILE__); ?>">
          <img style="height: 35px; float: left" alt="" src="/sites/all/themes/bizusa/images/bx_loader.gif" />
          <div style="line-height: 35px; padding-left: 10px; float: left;">
              Please wait as we load your personal dashboard...
          </div>
      </div>

      <?php print render($page['frontcontent']) ?>
  </div>
  <?php //print $feed_icons; ?>

  <?php if ($page['sidebar_first']): ?>
    <?php print render($page['sidebar_first']); ?>
  <?php endif; ?> <!-- /sidebar-first -->

  <?php if ($page['sidebar_second']): ?>
    <?php print render($page['sidebar_second']); ?>
  <?php endif; ?> <!-- /sidebar-second -->

  <?php if ($page['footer']): ?>
    <?php print render($page['footer']); ?>
  <?php endif; ?>
</div>

  <div id="bottom-bizusa-footer" style="clear: both;background-color: #fff;text-align: center;padding: 15px;">
    <div id="bottom-footer-image" style="background: transparent url(/sites/all/themes/bizusa/images/footerFlag.png) no-repeat 0px 0px; width: 21px; height: 13px; display: inline-block; margin-right: 15px;">
    </div>
    <div id="bottom-footer-text"  style="display: inline-block; font-size: 11px;  text-transform: uppercase;">
      Business.USA.gov is an official website of the U.S. Government.
    </div>
  </div>

<script type="text/javascript" src="/sites/all/themes/bizusa/scripts/pages/front.js"></script>
    <script>
        if (('#sitewide-search-input').length > 0)
        {
            $('#sitewide-search-input').focus(function ()
            {
                $(this).attr('placeholder','');
            });

            $('#sitewide-search-input').focusout(function()
            {
                $(this).attr('placeholder','Search BusinessUSA.Gov');
            });
        }
    </script>
