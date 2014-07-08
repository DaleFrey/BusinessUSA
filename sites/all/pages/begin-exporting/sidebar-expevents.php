<!-- This following markup is rendered from <?php print __FILE__; ?> -->
<div class="wizard-sidebarresults wizard-sidebarresults-vendors" rendersource="<?php print basename(__FILE__); ?>">
    <div class="vendors-top-section" style="padding-bottom: 20px;">
        <img src="/sites/all/themes/bizusa/images/content-type-icon-event.png" style="float: left; padding-right: 10px; padding-bottom: 10px;" alt="">
        Upcoming Events for Companies Interested in Exports 
        <a href="javascript: // Click here to learn more" title="Click here to learn more" onclick="jQuery.colorbox({ html: jQuery('.expevents-lightbox-content-container').html() });">
            [?]
        </a>
    </div>
    <div class="expevents-lightbox-content-container" style="display: none;">
        <div class="colorbox-logo">
            <div class="wizard-email-kill-colorbox" onclick="jQuery.colorbox.close();">
                Close
            </div>
            <div class="colorbox-logo-innerwrapper">
                <img src="/sites/all/themes/bizusa/images/logo.png">
            </div>
        </div>
        <div class="expevents-lightbox-content" rendersource="<?php print basename(__FILE__); ?>">
            <br/>
            The following are a list of upcoming events for <br/>
            companies interested in exports<br/>
            <br/>
        </div>
    </div>
    <div class="vendors-view-container" style="display: block;">
        <!-- Executing View exporting_events / default with parameters -->
        <?php print views_embed_view('exporting_events', 'default'); ?>
    </div>
</div>